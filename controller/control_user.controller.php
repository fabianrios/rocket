<?php
$action = isset($_POST['action']) ? $_POST['action'] : $_GET[0];
switch ($action):
	case 'login':
		$userId = Security::login($_POST['user_email'], $_POST['user_password']);
		if($userId !== false)
		{
			$key 		 = md5(formatDate());
			$controlUser = new ControlUser($userId);
			$controlUser->__set('user_session_carry', $key);
			$controlUser->__set('user_last_login', formatDate());
			$controlUser->update();
			$_SESSION['control_user_id'] = $userId;
			$_SESSION['key'] = $key;
			redirectUrl("index.php?home.control");
		}
		else
		{
			redirectUrl("index.php?login.control");
			die();
		}
	break;
	case 'create':
		$session = Security::validateSession();
		if ($session)
		{
			$user = new ControlUser();
			$user->__set('user_full_name', 'Nuevo Usuario');
			$user->__set('user_state', 'I');
			$user->__set('user_parent', $_SESSION['control_user_id']);
			$user->__set('user_datetime_creation', formatDate());
			$user->__set('user_datetime_update', formatDate());
			$save = $user->save();
			$alert = array();
			$alert[0]['type'] = 'notification';
			$alert[0]['msg']  = 'Un nuevo usuario ha sido creado';
			$_GET[0] = (isset($_POST['user_id'])) ? $_POST['user_id'] : $save['insert_id'];
			require_once(CONTROL_VIEW . 'user_expand.control.php');
		}	
	break;
	case 'update':
		$session = Security::validateSession();
		if ($session)
		{
			$user = (isset($_POST['user_id'])) ? new ControlUser($_POST['user_id']) : new ControlUser();
			$old_password = $user->__get('user_password');
			foreach ($_POST as $key => $value)
				$user->__set($key, $value);
			
			if ($_POST['user_password']) 
				$user->__set('user_password', md5($_POST['user_password']));		
			else
				$user->__set('user_password', $old_password);					 
			$user->__set('user_datetime_update', formatDate());
			if (isset($_POST['user_id']))
				$user->update();
			else 
				$save = $user->save();
			$_GET[0] = (isset($_POST['user_id'])) ? $_POST['user_id'] : $save['insert_id'];
			$user_role = ControlUserHelper::retrieveRoleUser (" AND user_id = " . $user->__get('user_id'));
			if (count($user_role) > 0) foreach ($user_role as $role) 
				$role->delete();	
			$role = new RoleUser();
			$role->__set('user_id', $_GET[0]);
			$role->__set('role_id', $_POST['role_id']);
			$role->save();			 
			$alert = array();
			$alert[0]['type'] = 'notification';
			$alert[0]['msg']  = (isset($_POST['user_id'])) ? 'El usuario ha sido actualizado' : 'Un nuevo usuario ha sido creado';
			
			require_once(CONTROL_VIEW . 'user_expand.control.php');
		}
	break;
	case 'changeState':
		$session = Security::validateSession();
		if ($session)
		{
			$user 	= new ControlUser($_GET[1]);
			$state	= ($user->__get('user_state') == 'A') ? 'I' : 'A';
			$response = ($user->__get('user_state') == 'A') ? 'Inactive |' : 'Active |';
			$user->__set('user_state', $state);
			$user->__set('user_datetime_update', formatDate());
			$save = $user->update();			
			$alert[0]['type'] = 'notification';
			$alert[0]['msg']  = 'El estado del usuario ha sido cambiado';		
			$state_action = "SimpleAJAXCall('index.php?control_user.controller/changeState/".$user->__get('user_id')."', updateAlert, 'GET', 'u_state_".$user->__get('user_id')."');";
			$state_display = '<a href="javascript:void(0)" onClick="'.$state_action.'">'.$response.'</a>';
			echo  $state_display; 
			$alert = AlertHelper::placeAlerts($alert);	
		}
	break;
	case 'delete':
		$session = Security::validateSession();
		if ($session)
		{
			$user 	= new ControlUser($_GET[1]);
			$user->__set('user_state', 'D');
			$user->__set('user_datetime_update', formatDate());
			$save = $user->update();		
			redirectUrl('index.php?user_list.control');			
		}	
	break;
	case 'transfer_carry':
		$user	= base64_decode(urldecode($_GET[1]));
		$carry	= base64_decode(urldecode($_GET[2]));
		$user	= new ControlUser($user);
		$user->__set('user_key', $carry);
		$user->update();
		redirectUrl(APPLICATION_URL.'index.php?home.control');
	break;

endswitch;
?>