<?php
$action = isset($_POST['action']) ? $_POST['action'] : $_GET[0];
Security::validateSession();
switch ($action):
	case 'create':
		$form = new FormContent();
		$form->__set('form_title', 'Nuevo Formulario');
		$form->__set('form_state', 'I');
		$save = $form->save();
		$alert = array();
		$alert[0]['type'] = 'notification';
		$alert[0]['msg']  = 'Un nuevo formulario ha sido creado';
		$_GET[0] = (isset($_POST['form_id'])) ? $_POST['form_id'] : $save['insert_id'];
		require_once(CONTROL_VIEW . 'form_expand.control.php');
	break;
	case 'update':
		$form = (isset($_POST['form_id'])) ? new FormContent($_POST['form_id']) : new FormContent();
		foreach ($_POST as $key => $value)
			$form->__set($key, $value);
			 
		$form->update();
		$_GET[0] = (isset($_POST['form_id'])) ? $_POST['form_id'] : $save['insert_id'];
		$alert = array();
		$alert[0]['type'] = 'notification';
		$alert[0]['msg']  = (isset($_POST['form_id'])) ? 'El formulario ha sido actualizado' : 'Un nuevo formulario ha sido creado';
		
		require_once(CONTROL_VIEW . 'form_expand.control.php');
	break;	
	case 'changeState':
		$form 	= new FormContent($_GET[1]);
		$state	= ($form->__get('form_state') == 'A') ? 'I' : 'A';
		$response = ($form->__get('form_state') == 'A') ? 'Inactive |' : 'Active |';
		$form->__set('form_state', $state);
		$save = $form->update();			
		$alert[0]['type'] = 'notification';
		$alert[0]['msg']  = 'El estado del formulario ha sido cambiado';		
		$state_action = "SimpleAJAXCall('index.php?control_form.controller/changeState/".$form->__get('form_id')."', updateAlert, 'GET', 'u_state_".$form->__get('form_id')."');";
		$state_display = '<a href="javascript:void(0)" onClick="'.$state_action.'">'.$response.'</a>';
		echo  $state_display; 
		$alert = AlertHelper::placeAlerts($alert);	
	break;
	case 'delete':
		$form 	= new FormContent($_GET[1]);
		$form->__set('form_state', 'D');
		$save = $form->update();		
		redirectUrl('index.php?form_list.control');			
	break;	
endswitch;