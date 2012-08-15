<?php
$action  	 = isset($_POST['action']) ? $_POST['action'] : $_GET[0];
$controlUser = Security::validateSession();
switch ($action):
	case 'create':
		$field = new FormField();
		foreach($_POST as $key => $value)
			$field->__set($key, $value);
		$field->__set('form_id', $_POST['formId']);
		$field->save();
		redirectUrl("index.php?form_expand.control/" . $_POST['formId']);
	break;
	case 'update':
		$field = new FormField($_POST['fieldId']);
		foreach($_POST as $key => $value)
			$field->__set($key, $value);
		$field->update();
		redirectUrl("index.php?form_expand.control/" . $_POST['formId']);
	break;	
	case 'delete':
		$field = new FormField($_GET[1]);
		$field->delete();
		redirectUrl("index.php?form_expand.control/" . $_GET[2]);
	break;	
endswitch;