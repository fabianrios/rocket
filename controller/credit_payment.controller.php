<?php
$action = isset($_POST["action"]) ? $_POST["action"] : $_GET[0];
switch($action):
	case 'update_payment_value':
	
		echo Sueno::calculatePayment($_GET[1], $_GET[2]);
		break;
	case 'update_payment_value2':
		$valor	= intval(str_replace(".", "", $_GET[1])) - intval(str_replace(".", "", $_GET[2]));	
		echo Sueno::calculatePayment($valor, $_GET[3]);
	break;		
endswitch;
?>