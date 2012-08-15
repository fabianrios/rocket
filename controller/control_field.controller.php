<?php
$action  	 = isset($_POST['action']) ? $_POST['action'] : $_GET[0];
$controlUser = Security::validateSession();
switch ($action):
	case 'create':
		$field = new Field();
		foreach($_POST as $key => $value)
			$field->__set($key, $value);
		$field->__set('field_state', 'A');
		$field->__set('module_id', $_POST['moduleId']);
		$field->save();
		redirectUrl("index.php?module_expand.control/" . $_POST['moduleId']);
	break;
	case 'update':
		$field = new Field($_POST['fieldId']);
		foreach($_POST as $key => $value)
			$field->__set($key, $value);
		$field->update();
		redirectUrl("index.php?module_expand.control/" . $_POST['moduleId']);
	break;	
	case 'delete':
		$field = new Field($_GET[1]);
		$field->delete();
		redirectUrl("index.php?module_expand.control/" . $_GET[2]);
	break;	
endswitch;