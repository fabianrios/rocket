<?php
$action 		= isset($_POST['action']) ? $_POST['action'] : $_GET[0];
switch ($action):
	case 'facebookConnect':
		$unionName	=  	escape($_GET[1]).' '.escape($_GET[6]);
		$exitsUsers = UserHelper::retrieveUsers(' AND facebook_id = "'.escape($_GET[2]).'"');
		if(count($exitsUsers)>0) //existe
			$newUser =& $exitsUsers[0];
		else //no existe
		{
			$exitsUsers	= UserHelper::retrieveUsers(' AND user_names LIKE "%'.trim($unionName).'%" AND user_surnames LIKE "%'.trim(escape($_GET[5])).'%"');
			$newUser 	= (count($exitsUsers)>0) ? $exitsUsers[0] : new User();	
		}
		$imagesReplace = str_replace('|','/',escape($_GET[3]));
		$newUser->__set('user_names',$unionName);
		//$newUser->__set('user_email',escape($_GET[4]));	
		$newUser->__set('user_surnames',escape($_GET[5]));	
		if(strlen($newUser->__get('user_image'))<=0)
			$newUser->__set('user_image',$imagesReplace);
		$newUser->__set('user_state','A');	
		$newUser->__set('user_datetime_update',date('Y-m-d H:i:s'));	
		$newUser->__set('facebook_id',escape($_GET[2]));	
		if(count($exitsUsers)>0) //existe
		{
			$idUser['insert_id'] = $newUser->__get('user_id');
 			$newUser->update();
		}
		else //no existe
		{
			$newUser->__set('user_date_creation',date('Y-m-d H:i:s'));	
			$idUser = $newUser->save();	
		}
		$_SESSION['user_id'] = 	$idUser['insert_id'];
		?>
		Vis&iacute;tanos en: <a href="http://www.facebook.com" title="Go Zero Go Green - Facebook" target="_blank"><img src="<?php echo APPLICATION_URL?>img/web/header/ico-facebook.gif" height="15" width="15" alt="Logo Facebook" /></a><a href="http://www.twitter.com/gozerogogreen" title="Go Zero Go Green - Twitter" target="_blank"><img src="<?php echo APPLICATION_URL?>img/web/header/ico-twitter.gif" height="15" width="15" alt="Logo Twitter" /></a><a href="http://www.linkedin.com" title="Go Zero Go Green - LinkedIn" target="_blank"><img src="<?php echo APPLICATION_URL?>img/web/header/ico-linkedin.gif" height="15" width="15" alt="Logo LinkedIn" /></a>&nbsp;&nbsp;Hola <?php echo escape($_GET[1])?>: <a href="<?php echo APPLICATION_URL?>tu_bosque.html" title="Ver tu bosque">Ver tu bosque</a> <em>|</em> <a href="<?php echo APPLICATION_URL?>actualizar.html" title="Actualizar tus datos">Actualizar tus datos</a> <em>|</em> <a href="javascript:void(0);" onclick="FB.logout();" title="Salir">Salir</a>
		<?php
	break;
	
	case 'facebookDesConnect':
		unset($_SESSION['user_id']);
		?>
		Vis&iacute;tanos en: <a href="http://www.facebook.com" title="Go Zero Go Green - Facebook" target="_blank"><img src="<?php echo APPLICATION_URL?>img/web/header/ico-facebook.gif" height="15" width="15" alt="Logo Facebook" /></a><a href="http://www.twitter.com/gozerogogreen" title="Go Zero Go Green - Twitter" target="_blank"><img src="<?php echo APPLICATION_URL?>img/web/header/ico-twitter.gif" height="15" width="15" alt="Logo Twitter" /></a><a href="http://www.linkedin.com" title="Go Zero Go Green - LinkedIn" target="_blank"><img src="<?php echo APPLICATION_URL?>img/web/header/ico-linkedin.gif" height="15" width="15" alt="Logo LinkedIn" /></a>&nbsp;&nbsp;Ingresa usando:&nbsp;&nbsp;<a href="javascript:void(0);" onclick="FB.login();" class="faceconnect"><img src="<?php echo APPLICATION_URL?>img/web/header/btn_facebook connect.png" width="93" height="22" alt="conectar con facebook" /></a>	
		<?php		
	break;
	
endswitch;
