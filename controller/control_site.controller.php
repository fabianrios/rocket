<?php
$action  = isset($_POST['action']) ? $_POST['action'] : $_GET[0];
$session = Security::validateSession();
switch ($action):
	case 'create':
		$parent = new Site($_GET[1]);
		$site   = new Site();
		$site->__set('site_name', 'Nuevo Site');
		$site->__set('site_state', 'I');
		$site->__set('site_parent', $_GET[1]);
		$site->__set('site_level', ($parent->__get('site_level') + 1));
		$save = $site->save();
		$alert = array();
		$alert[0]['type'] = 'notification';
		$alert[0]['msg']  = 'Un nuevo sitio ha sido creado';
		$_GET[0] = $_GET[2];
		$_GET[1] = $save["insert_id"];
		require_once(CONTROL_VIEW . 'site_expand.control.php');
	break;
	case 'update':
		$site   = new Site($_POST['site_id']);
		foreach($_POST as $key => $value)
			$site->__set($key, $value);
		$save = $site->update();
		$alert = array();
		$_GET[0] = $_POST['module_id'];
		$_GET[1] = $_POST['site_id'];
		$alert[0]['type'] = 'notification';
		$alert[0]['msg']  = 'El sitio ha sido actualizado';
		
		require_once(CONTROL_VIEW . 'site_expand.control.php');
	break;
	case 'changeState':
		$site 	= new Site($_GET[1]);
		$state	= ($site->__get('site_state') == 'A') ? 'I' : 'A';
		$response = ($site->__get('site_state') == 'A') ? 'Inactive |' : 'Active |';
		$site->__set('site_state', $state);
		$save = $site->update();			
		$alert[0]['type'] = 'notification';
		$alert[0]['msg']  = 'El estado del sitio ha sido cambiado';		
		$state_action = "SimpleAJAXCall('index.php?control_site.controller/changeState/".$site->__get('site_id')."', updateAlert, 'GET', 'u_state_".$site->__get('site_id')."');";
		$state_display = '<a href="javascript:void(0)" onClick="'.$state_action.'">'.$response.'</a>';
		echo  $state_display; 
		$alert = AlertHelper::placeAlerts($alert);	
	break;	
	case 'delete':
		$site = new Site($_GET[1]);
		$site->__set('site_state', 'D');
		$save = $site->update();		
		redirectUrl('index.php?site_list.control/' . $_GET[2] . '/' . $site->__get('site_parent'));			
	break;	
endswitch;
?>