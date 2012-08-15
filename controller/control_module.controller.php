<?php
$action = isset($_POST['action']) ? $_POST['action'] : $_GET[0];
$session = Security::validateSession();
switch ($action):
	case 'create':
		$session = Security::validateSession();
		if ($session)
		{	
			$module = new Module();
			$module->__set('module_name', 'Nuevo Modulo');
			$module->__set('module_state', 'I');
			$module->__set('module_parent', $_GET[1]);
			$save = $module->save();
			redirectUrl("index.php?module_expand.control/".$save['insert_id']);
		}
	break;
	case 'addmodule':
		$session = Security::validateSession();
		if ($session)
		{	
			$module = new Module($_POST['module_id']);
			foreach ($_POST as $key => $value)
				$module->__set($key, $value);
			$save = $module->update();
			$id = $_POST['module_id'];
			for ($i=1; $i<6; $i++) 
			{
				if (isset($_POST['a_'.$i]))
				{
					$pid = ($_POST['a_'.$i.'_permission_id'] != '') ? $_POST['a_'.$i.'_permission_id'] : NULL;
					$perm = new Permission($pid);
					$name = explode(',',$_POST['a_'.$i]);
					$perm->__set('permission_title', $name[0]);
					$perm->__set('module_id', $id);
					$perm->__set('permission_system_name', $_POST['module_system_name'].'_'.$name[1]);
					$perm->__set('permission_render', $_POST['a_'.$i.'_render']);
					$perm->__set('permission_restriction', $_POST['a_'.$i.'_restriction']);
					$list		= (isset($_POST['a_'.$i.'_list'])) ? 1 : 0; 
					$perm->__set('permission_list', $list);
					$reading	= (isset($_POST['a_'.$i.'_reading'])) ? 1 : 0; 
					$perm->__set('permission_reading', $reading);
					$save = ($pid != NULL) ? $perm->update() : $perm->save();
					
				}
				else
				{
					$pid = ($_POST['a_'.$i.'_permission_id'] != '') ? $_POST['a_'.$i.'_permission_id'] : NULL;
					if($pid != NULL)
					{
						$perm = new Permission($pid);
						$perm->delete();
						PermissionHelper::deletePermission($pid);
					}
				}
			}
			$alert = array();
			$alert[0]['type'] = 'notification';
			$alert[0]['msg']  = 'El modulo se ha actualizado';
			$_GET[0] = $_POST['module_id'];
			require_once(CONTROL_VIEW . 'module_expand.control.php');		
		}
	break;
	case 'update':
		$session = Security::validateSession();
		if ($session)
		{	
			$module = new Module($_POST['module_id']);
			foreach ($_POST as $key => $value)
				$module->__set($key, $value);
			$module->update();
		}
	break;
	case 'changeState':
		$session = Security::validateSession();
		if ($session)
		{
			$module 	= new Module($_GET[1]);
			$state		= ($module->__get('module_state') == 'A') ? 'I' : 'A';
			$response 	= ($module->__get('module_state') == 'A') ? 'Inactivo |' : 'Activo |';
			$module->__set('module_state', $state);
			$save = $module->update();			
			$alert[0]['type'] = 'notification';
			$alert[0]['msg']  = 'El estado del modulo ha sido cambiado';		
			$state_action = "SimpleAJAXCall('index.php?control_module.controller/changeState/".$module->__get('module_id')."', updateAlert, 'GET', 'u_state_".$module->__get('module_id')."');";
			$state_display = '<a href="javascript:void(0)" onClick="'.$state_action.'">'.$response.'</a>';
			echo  $state_display; 
			$alert = AlertHelper::placeAlerts($alert);	
		}
	break;	
	case 'delete':
		$session = Security::validateSession();
		if ($session)
		{
			$module 	= new Module($_GET[1]);
			$module->__set('module_state', 'D');
			$save = $module->update();		
			redirectUrl('index.php?module_list.control');			
		}	
	break;	
endswitch;	
?>