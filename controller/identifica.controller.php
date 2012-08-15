<?php
$action  	 = isset($_POST['action']) ? $_POST['action'] : $_GET[0];
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
endswitch;	
?>