<?php
$action = isset($_POST['action']) ? $_POST['action'] : $_GET[0];
switch ($action):
	case 'create':
		$session = Security::validateSession();
		if ($session)
		{
			$role = new Role();
			$role->__set('role_name', 'Nuevo Rol');
			$role->__set('role_state', 'I');
			$save = $role->save();
			$alert = array();
			$alert[0]['type'] = 'notification';
			$alert[0]['msg']  = 'Un nuevo rol ha sido creado';
			$_GET[0] = (isset($_POST['rol_id'])) ? $_POST['rol_id'] : $save['insert_id'];
			require_once(CONTROL_VIEW . 'role_expand.control.php');
		}	
	break;
	case 'update':
		$session = Security::validateSession();
		if ($session)
		{
			$role = (isset($_POST['role_id'])) ? new Role($_POST['role_id']) : new Role();
			foreach ($_POST as $key => $value)
				$role->__set($key, $value);
			if (isset($_POST['role_id']))
				$role->update();
			else 
				$save = $role->save();
			$permissions = PermissionHelper::retrievePermissions("GROUP BY permission_title ORDER BY permission_title");
			$modules	 = ModuleHelper::retrieveModules("ORDER BY module_name");
			$_GET[0] 	 = (isset($_POST['role_id'])) ? $_POST['role_id'] : $save['insert_id'];
			PermissionHelper::deletePermissions($_GET[0]);
			foreach($modules as $module)
			{
			  foreach($permissions as $permission)
			  {
	
				$permissionArray = PermissionHelper::retrievePermissions("AND permission_title = '" . $permission->__get('permission_title') . "' AND module_id = " . $module->__get('module_id'));
					if(count($permissionArray) == 1)
					{
						$actualPermission =& $permissionArray[0];
						if(isset($_POST['permission' . $actualPermission->__get('permission_id') . '_' . $module->__get('module_id')]))
						{
							$RolePermission = new RolePermission();
							$RolePermission->__set('role_id', $_GET[0]);
							$RolePermission->__set('permission_id', $actualPermission->__get('permission_id'));
							$RolePermission->save();
						}
					}
			   }
			}	
			$alert = array();
			$alert[0]['type'] = 'notification';
			$alert[0]['msg']  = (isset($_POST['role_id'])) ? 'El rol ha sido actualizado' : 'Un nuevo rol ha sido creado';
			require_once(CONTROL_VIEW . 'role_expand.control.php');
		}
	break;
	case 'changeState':
		$session = Security::validateSession();
		if ($session)
		{
			$role 	= new Role($_GET[1]);
			$state	= ($role->__get('role_state') == 'A') ? 'I' : 'A';
			$response = ($role->__get('role_state') == 'A') ? 'Inactive |' : 'Active |';
			$role->__set('role_state', $state);
			$save = $role->update();			
			$alert[0]['type'] = 'notification';
			$alert[0]['msg']  = 'El estado del rol ha sido cambiado';		
			$state_action = "SimpleAJAXCall('index.php?control_role.controller/changeState/".$role->__get('role_id')."', updateAlert, 'GET', 'u_state_".$role->__get('role_id')."');";
			$state_display = '<a href="javascript:void(0)" onClick="'.$state_action.'">'.$response.'</a>';
			echo  $state_display; 
			$alert = AlertHelper::placeAlerts($alert);	
		}
	break;	
	case 'delete':
		$session = Security::validateSession();
		if ($session)
		{
			$role 	= new Role($_GET[1]);
			$role->__set('role_state', 'D');
			$save = $role->update();		
			redirectUrl('index.php?role_list.control');			
		}	
	break;
endswitch;
?>