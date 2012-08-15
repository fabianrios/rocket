<?php
$action = isset($_POST['action']) ? $_POST['action'] : $_GET[0];
$session = Security::validateSession();
switch ($action):
	case 'create':
		$zone = new Zone();
		$zone->__set('zone_title', 'Nueva Zona');
		$zone->__set('zone_datetime_create', formatDate());
		$save = $zone->save();
		$alert = array();
		$alert[0]['type'] = 'notification';
		$alert[0]['msg']  = 'Una nueva zona ha sido creada';
		$_GET[0] = (isset($_POST['zone_id'])) ? $_POST['zone_id'] : $save['insert_id'];
		require_once(CONTROL_VIEW . 'zone_expand.control.php');
	break;
	case 'update':
		$zone = (isset($_POST['zone_id'])) ? new Zone($_POST['zone_id']) : new Zone();
		foreach ($_POST as $key=>$value)
			$zone->__set($key, $value);
		$zone->__set('zone_datetime_update', formatDate());	
		$save =  (isset($_POST['zone_id'])) ? $zone->update() : $zone->save();
		$alert = array();
		$alert[0]['type'] = 'notification';
		$alert[0]['msg']  = 'Los datos para esta zona han sido modificados';
		$_GET[0] = (isset($_POST['zone_id'])) ? $_POST['zone_id'] : $save['insert_id'];
		require_once(CONTROL_VIEW . 'zone_expand.control.php');
	break;
	case 'changeState':
		$zone 	= new Zone($_GET[1]);
		$state	= ($zone->__get('zone_state') == 'A') ? 'I' : 'A';
		$response = ($zone->__get('zone_state') == 'A') ? 'Inactive |' : 'Active |';
		$zone->__set('zone_state', $state);
		$zone->__set('zone_datetime_update', formatDate());
		$save = $zone->update();			
		$alert[0]['type'] = 'notification';
		$alert[0]['msg']  = 'El estado de la zona ha sido cambiado';		
		$state_action = "SimpleAJAXCall('index.php?control_zone.controller/changeState/".$zone->__get('zone_id')."', updateAlert, 'GET', 'u_state_".$zone->__get('zone_id')."');";
		$state_display = '<a href="javascript:void(0)" onClick="'.$state_action.'">'.$response.'</a>';
		echo  $state_display; 
		$alert = AlertHelper::placeAlerts($alert);		
	break;
	case 'delete':
			$zone 	= new Zone($_GET[1]);
			$zone->__set('zone_state', 'D');
			$zone->__set('zone_datetime_update', formatDate());
			$save = $zone->update();		
			redirectUrl('index.php?zone_list.control');				
	break;	
endswitch;
?>