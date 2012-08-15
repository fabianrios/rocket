<?php
header('Content-Type: text/html; charset=ISO-8859-1'); 
$action = isset($_POST['action']) ? $_POST['action'] : $_GET[0];
switch ($action):
	case 'InsertRegister':
		$newUser		= new User();
		$groupTaxes	= '';
		foreach($_POST as $key => $value)
		{
			$newUser->__set($key,$value);
			//Regimen contributivo 
			$findTaxes = strrpos($key,'Grupo_');
			if($findTaxes !== false)
				$groupTaxes .= $value.',';
		}
		$newUser->__set('user_password',md5(trim($_POST['password2'])));
		$newUser->__set('user_contributory_scheme',$groupTaxes);
		$newUser->__set('user_creation_datetime',date('Y-m-d H:i:s'));
		$newUser->__set('user_update_datetime',date('Y-m-d H:i:s'));
		$newUser->__set('user_state','A');
		$UserID = $newUser->save();
		//INCIO SESION
		$_SESSION['user_id'] 	= $UserID['insert_id'];
		//ENVIO CORREO CON LOS DATOS DEL USUARIO
		$html = "Nombre: " . $_POST['user_names'] . "<br>
				E-mail: " . $_POST['user_email'] . "<br><br />
				Usuario: " . $_POST['user_document'] . "<br>
				Contraseña: " . trim($_POST['password2']) . "<br>";
				
				$args = array(	'to'	=> $_POST['user_email'],
							'from'    	=> 'info@magdalenamedio.net',
							'html'     	=> $html,
							'subject'  	=> 'Registro Ideko',
							'fromName' 	=> 'Ideko',
							'replyTo'  	=> 'info@magdalenamedio.net');	
		EmailHelper::sendMail($args);
		redirectUrl(APPLICATION_URL."register_complete.html");
	break;	
	
	case 'loginUser':
		$login	= UserHelper::retrieveUsers(' AND TRIM(user_document) = "'.trim($_POST['user_document']).'" AND user_password = "'.md5(trim($_POST['user_password'])).'" AND user_state = "A"');
		if(count($login)>0)
		{
			$_SESSION['user_id'] = $login[0]->__get('user_id');
			redirectUrl(APPLICATION_URL."home.html");
		}
		else
			redirectUrl(APPLICATION_URL."login/Error.html");
	break;
	
	case 'recover_password':
		if(isset($_GET[1]))
			$recovers 	=  UserHelper::retrieveUsers(' AND user_id = "'.escape($_GET[1]).'"');
		else
			$recovers 	=  UserHelper::retrieveUsers(' AND TRIM(user_email) = "'.trim($_POST['user_email']).'"');
		if(count($recovers)>0)
		{
			$recover 		=& $recovers[0];
			$newPassword 	= date('njSs');
			$chagePassword	= new User($recover->__get('user_id'));
			$chagePassword->__set('user_password',md5($newPassword)); 
			$chagePassword->update();
			$html = "Nombre: " . $recover->__get('user_names') . "<br>
				E-mail: " . $recover->__get('user_email') . "<br><br />
				Usuario: " . $recover->__get('user_document') . "<br>
				Nueva Contraseña: " . $newPassword . "<br>";
				
				$args = array('to'	=> $recover->__get('user_email'),
							'from'    	=> 'info@magdalenamedio.net',
							'html'     	=> $html,
							'subject'  	=> 'Recuperar contraseña Ideko',
							'fromName' 	=> 'Ideko',
							'replyTo'  	=> 'info@magdalenamedio.net');	
			EmailHelper::sendMail($args);
			redirectUrl(APPLICATION_URL."recover/Recover/".$recover->__get('user_id').".html");
		}
		else
			redirectUrl(APPLICATION_URL."recover/Error.html");
	break;
	case 'updateAccount':
		//Verifico la clave del usuario. para poder actualizar.
		$login	= UserHelper::retrieveUsers(' AND user_id = '.$_SESSION['user_id'].' AND user_password = "'.md5(trim($_POST['comfirm_password'])).'"');
		if(count($login)>0)
		{
			$updateUser = new User($_SESSION['user_id']);
			$groupTaxes	= '';
			foreach($_POST as $key => $value)
			{
				$updateUser->__set($key,$value);
				//Regimen contributivo 
				$findTaxes = strrpos($key,'Grupo_');
				if($findTaxes !== false)
					$groupTaxes .= $value.',';
			}
			$updateUser->__set('user_contributory_scheme',$groupTaxes);
			$updateUser->__set('user_update_datetime',date('Y-m-d H:i:s'));
			if($_POST['password2'] != '')
				$updateUser->__set('user_password',md5(trim($_POST['password2'])));			
			$UserID = $updateUser->update();				
			redirectUrl(APPLICATION_URL."your_account.html");
		}
		else
			redirectUrl(APPLICATION_URL."your_account/Error.html");
	break;
	
	case 'logOut':
		session_destroy();
		redirectUrl(APPLICATION_URL."home.html");
	break;
endswitch;	
?>