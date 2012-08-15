<?php
$action = isset($_POST['action']) ? $_POST['action'] : $_GET[0];
switch ($action):
	case 'create':
		$user 			= (isset($_POST['user_id'])) ? new User($_POST['user_id']) : new User();
		foreach ($_POST as $key => $value)
			$user->__set($key, $value);
		$user->__set('user_date_creation', formatDate());
		$user->__set('user_state', 'I');
		//Logo
		if($_FILES["user_image"]["name"] != "")
		{
			$ext	= getFileExtension($_FILES["user_image"]['name']);
			$name 	= md5(date("YmdHis")) . $ext;

			if(uploadFile('resources/images/', $_FILES["user_image"]['tmp_name'], $name))
			{
				$accept = array('jpg', 'gif', 'png', 'jpeg');
				$medio 	= new Medio($name , $accept, 'resources/images/');
				$user->__set('user_image', $name);
			}
		}
		if (!isset($_POST['user_id']))
		{
			$validate	=	md5(date("YmdHis"));
			$user->__set('user_verification_code', $validate);
		}
		$action			= 'creado';
		$controlUser 	= new ControlUser($_SESSION['control_user_id']);
		if (isset($_POST['user_id']))
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

		redirectUrl(APPLICATION_URL.'registered_user_list/'.$action.'.html');
	break;
	case 'update':
		$user 	=  new User($_POST['user_id']);
		foreach ($_POST as $key => $value)
			$user->__set($key, $value);
		$user->__set('user_password', md5($_POST['user_password']));
		$user->__set('user_datetime_update', formatDate());
		$user->__set('user_validation', '');
		//Logo
		if( (isset($_FILES["user_avatar"]["name"])) && ($_FILES["user_avatar"]["name"] != ""))
		{
			$ext = getFileExtension($_FILES["user_avatar"]['name']);
			$name = md5(date("YmdHis")) . $ext;

			if(uploadFile('resources/images/', $_FILES["user_avatar"]['tmp_name'], $name))
			{
				$accept = array('jpg', 'gif', 'png', 'jpeg');
				$medio = new Medio($name , $accept, 'resources/images/');
				$user->__set('user_image', $name);
			}
		}
		if ($_POST['user_id'] == $_SESSION['user_id'])
			$user->update();

		//Genero el log de creacion de universidad
		$nameUsers	= $user->__get('user_names').' '.$user->__get('user_surnames');
		$controlUser = new ControlUser($_SESSION['control_user_id']);
		$msgLog		= '['.date("d/m/Y H:i:s").']: '.$controlUser->__get('user_full_name').'<br />Se actualizo el usuario: '.$nameUsers;
		$newLog		= new CoreLog();
		$newLog->__set('object_id',$_POST['user_id']);
		$newLog->__set('log_action_name',$nameUsers);
		$newLog->__set('log_content',$msgLog);
		$newLog->__set('log_date',date('Y-m-d H:i:s'));
		$newLog->save();

		redirectUrl(APPLICATION_URL.'user_thanks.html');
	break;
	case 'add':
		$user 			= (isset($_POST['user_id'])) ? new User($_POST['user_id']) : new User();
		foreach ($_POST as $key => $value)
			$user->__set($key, $value);
		$user->__set('user_creation_datetime', formatDate());
		$user->__set('user_datetime_update', formatDate());
		$user->__set('user_state', 'A');
		//Logo
		if($_FILES["user_avatar"]["name"] != "")
		{
			$ext = getFileExtension($_FILES["user_avatar"]['name']);
			$name = md5(date("YmdHis")) . $ext;

			if(uploadFile('resources/images/', $_FILES["user_avatar"]['tmp_name'], $name))
			{
				$accept = array('jpg', 'gif', 'png', 'jpeg');
				$medio = new Medio($name , $accept, 'resources/images/');
				$user->__set('user_image', $name);
			}
		}
		if (!isset($_POST['user_id']))
		{
			$validate	=	md5(date("YmdHis"));
			$user->__set('user_validation', $validate);
			$user2		= new User($_SESSION['user_id']);	//SESSION USER
			$type		= ($user->__get('company_id') != 0) ? 'C' : 'G';
			$html		= MailHelper::invitationMail($type, $user->__get('user_names'), APPLICATION_FULL_URL.'user_invite/'.$validate.'.html', $user2->__get('user_names'));
			$args = array('to'	=> $user->__get('user_email'),
						'from'    	=> 'contactenos@creatic.org.co',
						'html'     	=> $html,
						'subject'  	=> 'Bienvenido a CreaTiC',
						'fromName' 	=> 'CreaTiC',
						'replyTo'  	=> 'contactenos@creatic.org.co');
			EmailHelper::sendMail($args);
		}
		$action	= 'creado';
		$controlUser = new ControlUser($_SESSION['control_user_id']);
		if (isset($_POST['user_id']))
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

		if (isset($_POST['company_id']))
			redirectUrl(APPLICATION_URL.'user_list_b2/'.$action.'.html');
		else
			redirectUrl(APPLICATION_URL.'user_list_c2/'.$action.'.html');
	break;
	case 'deactivate':
		$deactivate		= true;
		$userPrimary 	= new User($_SESSION['user_id']);
		if ($userPrimary->__get('user_primary') == 0)
			$deactivate	= false;
		$user 	= new User($_GET[1]);
		if ($userPrimary->__get('group_id') != $user->__get('group_id'))
			$deactivate	= false;
		if ($userPrimary->__get('company_id') != $user->__get('company_id'))
			$deactivate	= false;
		$user->__set('user_state', 'D');
		$user->__set('user_datetime_update', formatDate());
		if ($deactivate)
			$save = $user->update();
		$action		= 'eliminado';

		//Genero el log de creacion de universidad
		$nameUsers	= $userPrimary->__get('user_names').' '.$userPrimary->__get('user_surnames');
		$controlUser = new ControlUser($_SESSION['control_user_id']);
		$msgLog		= '['.date("d/m/Y H:i:s").']: '.$controlUser->__get('user_full_name').'<br />Usuario eliminado : '.$nameUsers;
		$newLog		= new CoreLog();
		$newLog->__set('object_id',escape($_GET[0]));
		$newLog->__set('log_action_name',$userPrimary->__get('user_id'));
		$newLog->__set('log_content',$msgLog);
		$newLog->__set('log_date',date('Y-m-d H:i:s'));
		$newLog->save();

		if ($userPrimary->__get('company_id') != 0)
			redirectUrl(APPLICATION_URL.'user_list_b2/'.$action.'.html');
		else
			redirectUrl(APPLICATION_URL.'user_list_c2/'.$action.'.html');
	break;
	case 'updateProfile':
		$user 	=  new User($_POST['user_id']);
		foreach ($_POST as $key => $value)
			$user->__set($key, $value);
		$user->__set('user_datetime_update', formatDate());
		//Logo
		if( (isset($_FILES["user_avatar"]["name"])) && ($_FILES["user_avatar"]["name"] != ""))
		{
			$ext = getFileExtension($_FILES["user_avatar"]['name']);
			$name = md5(date("YmdHis")) . $ext;

			if(uploadFile('resources/images/', $_FILES["user_avatar"]['tmp_name'], $name))
			{
				$accept = array('jpg', 'gif', 'png', 'jpeg');
				$medio = new Medio($name , $accept, 'resources/images/');
				$user->__set('user_image', $name);
			}
		}
		if ($_POST['user_id'] == $_SESSION['user_id'])
			$user->update();
		//Genero el log
		$nameUsers	= $user->__get('user_names').' '.$user->__get('user_surnames');
		$controlUser = new ControlUser($_SESSION['control_user_id']);
		$msgLog		= '['.date("d/m/Y H:i:s").']: '.$controlUser->__get('user_full_name').'<br />Usuario actualizo su perfil : '.$nameUsers;
		$newLog		= new CoreLog();
		$newLog->__set('object_id',escape($_GET[0]));
		$newLog->__set('log_action_name',$user->__get('user_id'));
		$newLog->__set('log_content',$msgLog);
		$newLog->__set('log_date',date('Y-m-d H:i:s'));
		$newLog->save();
		redirectUrl(APPLICATION_URL.'user_profile_update/modificado.html');
	break;
	case 'updatePassword':
		$user 	=  new User($_POST['user_id']);
		$change	= ($user->__get('user_password') == md5($_POST['old_password'])) ? true : false;
		if ($change)
		{
			$user->__set('user_password', md5($_POST['user_password']));
			$user->__set('user_datetime_update', formatDate());
			if ($_POST['user_id'] == $_SESSION['user_active'])
				$user->update();
		}
		?>
        <script language="javascript">
			alert("Sus datos han sido actualizados.");
			window.location.href="<?php echo APPLICATION_URL;?>home.html";
        </script>
        <?php
	break;
	case 'login':
		$user 	= UserHelper::login($_POST['user_email'], $_POST['user_password']);
		
		if($user)
		{
			if ($user->__get('user_id') != '')	//user_users user
			{
				$_SESSION['user_id']	= $user->__get('user_id');
				redirectUrl(APPLICATION_URL.'feed.html');
			}
		}
		//else
			//redirectUrl(APPLICATION_URL."user_login/error.html");

	break;

	case 'RememberPassword':
		$userExist	= UserHelper::retrieveUsers(' AND user_email = "'.trim($_POST['user_email']).'"');
		if(count($userExist)>0)
		{
			$newPassword = base64_encode(strftime('%d%H%S'));
			$changeUser = new user($userExist[0]->__get('user_id'));
			$changeUser->__set('user_password',md5($newPassword));
			$changeUser->update();
			//Envio notificacion al usuario
			$name 			= $changeUser->__get('user_names').' '.$changeUser->__get('user_surnames');
			$email 			= $changeUser->__get('user_email');
			/* DESTINATARIO */
			$asunto 	= 'Recuperar clave CreaTiC';
			$mensaje 	= "Coordial saludo: $name <br />Su nueva clave es: ".$newPassword . "<br>Equipo CreaTiC";
			$headers 	=  "Content-Type: text/html; charset=ISO-8859-1\r\n";
			mail($email, $asunto, $mensaje, $headers);

			//Genero el log
			$nameUsers	= $changeUser->__get('user_names').' '.$changeUser->__get('user_surnames');
			$controlUser = new ControlUser($_SESSION['control_user_id']);
			$msgLog		= '['.date("d/m/Y H:i:s").']: '.$controlUser->__get('user_full_name').'<br />Recuperar contraseña : '.$nameUsers;
			$newLog		= new CoreLog();
			$newLog->__set('object_id',escape($_GET[0]));
			$newLog->__set('log_action_name',$changeUser->__get('user_id'));
			$newLog->__set('log_content',$msgLog);
			$newLog->__set('log_date',date('Y-m-d H:i:s'));
			$newLog->save();

			redirectUrl(APPLICATION_URL.'user_remember/Send/'.urlencode($email).'.html');
		}
		else
		{
			redirectUrl(APPLICATION_URL.'user_remember/Error.html');
		}
	break;



	case 'updateUser':
		$updateUser = new User($_POST['user_id']);
		$redirect = true;
		foreach($_POST as $key => $value)
			$updateUser->__set($key,$value);
		$updateUser->__set('user_datetime_update',date('Y-m-d H:i:s'));
		//verifico si solicito cambio de contraseña
		$updateUser->update();
		if(isset($_POST['user_password1']) && $_POST['user_password1'] != '')
		{
			if(isset($_POST['user_password1']) && $_POST['user_password1'] != '')
			{
				if($updateUser->__get('user_password') == "")
				{
					if($_POST['user_passwordNew'] != $_POST['user_passwordRetype'])
					{
						redirectUrl(APPLICATION_URL.'actualizar/Error.html');
						$redirect = false;
					}
					else
					{
						$updateUser->__set('user_password',md5($_POST['user_passwordNew']));
						$updateUser->update();
					}
				}
			}
		}
		if($redirect)
			redirectUrl(APPLICATION_URL.'actualizar/Update.html');
	break;

	case 'logoutUser':
		unset($_SESSION);
		redirectUrl('/home.html');
	break;
endswitch;
?>