<?php
$action = isset($_POST['action']) ? $_POST['action'] : $_GET[0];

switch($action):
	case 'save_product_type':
		$userData = isset($_SESSION["product_data"]) ? unserialize($_SESSION["product_data"]) : array();
		$userData["product_type"] = $_POST["product_type"];
		$_SESSION["user_data"] = serialize($userData);
		redirectUrl(APPLICATION_URL . 'descubra-0210.html');
		break;
endswitch;
?>