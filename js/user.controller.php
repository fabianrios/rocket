<?php
$action = isset($_POST['action']) ? $_POST['action'] : $_GET[0];
switch ($action):
	case 'login':
		$userArray = UserHelper::retrieveUsers("AND user_email = '" . escape($_POST['user_email']) . "' AND user_password = '" . md5(escape($_POST['user_password'])) . "'");
		if(count($userArray) == 1)
		{
			$_SESSION['user_id'] = $userArray[0]->__get('user_id');
			redirectUrl("index.php");
		}
		else
			redirectUrl("index.php?registration_login_form/error");
	break;
	case 'sign_out':
		session_destroy();
		redirectUrl("index.php");
	break;
endswitch;
?>