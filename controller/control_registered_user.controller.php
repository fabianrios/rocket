<?php
$action = isset($_POST['action']) ? $_POST['action'] : $_GET[0];
switch ($action):
	case 'updateUser':
		$user 		= ($_POST['user_id'] != '') ? new User($_POST['user_id']) : new User();
		foreach ($_POST as $key => $value)
			$user->__set($key, $value);
		$user->__set('user_date_creation', formatDate());	
		if ($_POST['password'] != '') $user->__set('user_password', md5($_POST['password']));			
		//Logo
		if($_FILES["user_avatar"]["name"] != "")
		{
			$ext	= getFileExtension($_FILES["user_avatar"]['name']);
			$name 	= md5(date("YmdHis")) . $ext;
		
			if(uploadFile('resources/images/', $_FILES["user_avatar"]['tmp_name'], $name))
			{
				$accept = array('jpg', 'gif', 'png', 'jpeg');
				$medio 	= new Medio($name , $accept, 'resources/images/');  
				$user->__set('user_image', $name);						
			}				
		}	
		//create validable code
		if ($_POST['user_id'] == '')
		{
			$validate	=	md5(date("YmdHis"));
			$user->__set('user_verification_code', $validate); 
			//Insert mail //
		}
		$action			= 'creado';
		$controlUser 	= new ControlUser($_SESSION['control_user_id']);
		if ($_POST['user_id'] != '')
		{
			$user->update();
			$nameUsers	= $user->__get('user_names').' '.$user->__get('user_surnames');
			$msgLog		= '['.date("d/m/Y H:i:s").']: '.$controlUser->__get('user_full_name').'<br />Usuario modificado: '.$nameUsers;
			$action	= 'modificado';
		}
		else 
		{
			$save = $user->save();		
			$nameUsers	=  $_POST['user_names'].' '.$_POST['user_surnames'];
			$msgLog		= '['.date("d/m/Y H:i:s").']: '.$controlUser->__get('user_full_name').'<br />Usuario Creado: '.$nameUsers;
		}
		$_POST['user_id'] = isset($_POST['user_id']) ? $_POST['user_id'] : $save['insert_id'];
		//Genero el log de creacion de universidad
		$newLog		= new CoreLog();
		$newLog->__set('object_id',$_POST['user_id']);
		$newLog->__set('log_action_name',$nameUsers);
		$newLog->__set('log_content',$msgLog);
		$newLog->__set('log_date',date('Y-m-d H:i:s'));
		$newLog->save();

		redirectUrl(APPLICATION_URL.'index.php?registered_user_list.control');
	break;
	case 'delete':
		
		$user	= new User($_GET[1]);
		$user->__set('user_state', 'D');
		$user->__set('user_datetime_update', formatDate());
		$save = $user->update();
		$action		= 'eliminado';
		
		//Genero el log de creacion de universidad
		$nameUsers	= $user->__get('user_names').' '.$user->__get('user_surnames');
		$controlUser = new ControlUser($_SESSION['control_user_id']);
		$msgLog		= '['.date("d/m/Y H:i:s").']: '.$controlUser->__get('user_full_name').'<br />Usuario eliminado : '.$nameUsers;
		$newLog		= new CoreLog();
		$newLog->__set('object_id',escape($_GET[0]));
		$newLog->__set('log_action_name',$controlUser->__get('user_id'));
		$newLog->__set('log_content',$msgLog);
		$newLog->__set('log_date',date('Y-m-d H:i:s'));
		$newLog->save();
		
		redirectUrl(APPLICATION_URL.'index.php?registered_user_list.control');
	break;	
	case 'changeState':
		$user		= new User($_GET[1]);
		$estado 	= ($user->__get('user_state') == 'I') ? 'A' : 'I';
		$response 	= ($user->__get('user_state') == 'A') ? 'Inactivo |' : 'Activo |';
		$user->__set('user_state', $estado);
		$user->__set('user_datetime_update', formatDate());
		$save 		= $user->update();	

		$action		= 'eliminado';
		
		//Genero el log de creacion de universidad
		$nameUsers	= $user->__get('user_names').' '.$user->__get('user_surnames');
		$controlUser = new ControlUser($_SESSION['control_user_id']);
		$msgLog		= '['.date("d/m/Y H:i:s").']: '.$controlUser->__get('user_full_name').'<br />Cambio de estado ('.$estado.') usuario : '.$nameUsers;
		$newLog		= new CoreLog();
		$newLog->__set('object_id',escape($_GET[0]));
		$newLog->__set('log_action_name',$controlUser->__get('user_id'));
		$newLog->__set('log_content',$msgLog);
		$newLog->__set('log_date',date('Y-m-d H:i:s'));
		$newLog->save();		
		$alert[0]['type'] = 'notification';
		$alert[0]['msg']  = 'El estado del contenido ha sido cambiado';			
		$state_action = "SimpleAJAXCall('index.php?control_registered_user.controller/changeState/".$user->__get('user_id')."', updateAlert, 'GET', 'u_state_".$user->__get('user_id')."');";
		$state_display = '<a href="javascript:void(0)" onClick="'.$state_action.'">'.$response.'</a>';
		echo  $state_display; 
		$alert = AlertHelper::placeAlerts($alert);

	break;
endswitch;
?>	