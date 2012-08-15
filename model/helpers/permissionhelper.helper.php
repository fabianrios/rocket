<?php
class PermissionHelper
{
	public static function checkPermission($permission, $level = 1)
	{
		$retrievePermissionsSql = "SELECT permission_render
								   FROM core_permissions, core_roles_permissions, core_roles, core_users
								   WHERE user_id = " . $_SESSION['control_user_id'] . "
								   AND core_users.role_id = core_roles.role_id
								   AND core_roles.role_id = core_roles_permissions.role_id
								   AND core_roles_permissions.permission_id = core_permissions.permission_id
								   AND core_roles.role_state = 'A'
								   AND (core_permissions.permission_restriction NOT LIKE '%," . escape($level) . ",%'
								   OR core_permissions.permission_restriction IS NULL)
								   AND permission_system_name = '" . escape($permission) . "'";
		$connection = Connection::getInstance();
		$result		 = $connection->query($retrievePermissionsSql);	
		
		if($result["num_rows"] == 1)
			return mysql_result($result["query"], 0, 0);
		else
			return false;
	}
	
	public static function checkRolePermission($permissionId, $roleId)
	{
		$retrievePermissionsSql = "SELECT permission_render
								   FROM core_permissions, core_roles_permissions, core_roles
								   WHERE core_roles.role_id = " . escape($roleId) . "
								   AND core_roles.role_id = core_roles_permissions.role_id 
								   AND core_roles_permissions.permission_id = core_permissions.permission_id
								   AND core_permissions.permission_id = '" . escape($permissionId) . "'";
								
		$connection = Connection::getInstance();
		$result		 = $connection->query($retrievePermissionsSql);	
		
		if($result["num_rows"] == 1)
			return true;
		else
			return false;
	}	
	
	public static function selectPermissions ( $extra = "", $extraTables = ""   )
	{
		$connection = Connection::getInstance();
		$retrievePermissionsSql    = "SELECT core_permissions.permission_id
							         FROM core_permissions" . $extraTables . "
								     WHERE 1 = 1 
								     " . $extra;
		return $connection->query($retrievePermissionsSql);		
	}
	public static function retrievePermissions ( $extra  = "", $extraTables = ""  )
	{
		$permissions = array();
		
		$retrievePermissionsResult = self::selectPermissions ( $extra, $extraTables  );
		
		while($permissionsRow = mysql_fetch_assoc($retrievePermissionsResult["query"]))
			$permissions[] = new Permission($permissionsRow["permission_id"]);
			
		return $permissions;
	}	
	public static function displayDocks($module, &$object, $specific = false, $level = 1)
	{
		$extra = "	AND core_users.role_id = core_roles_permissions.role_id
					AND core_roles_permissions.permission_id = core_permissions.permission_id
					AND core_permissions.module_id = core_modules.module_id
					AND core_permissions.permission_list = 1
					AND core_users.user_id = " . $_SESSION['control_user_id'] . "
					AND core_modules.module_id 	 = " . escape($module);
		if($specific !== false)
		{
			$extra .= " AND (";
			foreach($specific as $permission_system_name)
			{
				if(self::checkPermission($permission_system_name, $level) !== false);
				 	$extra .= "core_permissions.permission_system_name = '" . $permission_system_name . "'
				 OR ";
			}
			$extra .= " 1 = 2)";
		}
		
		$extra .= " ORDER BY permission_id";
		
		$extraTables	= ", core_modules, core_roles_permissions, core_users";
		$activePermissions = self::retrievePermissions($extra, $extraTables);
		foreach ($activePermissions as $dock)
		{
			echo "<a href=\"#\" class=\"sobrepanel\">".$dock->__get('permission_title')."</a>";
			require_once(CONTROL_VIEW . $dock->__get('permission_render').".control.php");
		}
	}
	
	public static function deletePermissions($roleId)
	{
		$deletePermissionsSql = "DELETE FROM core_roles_permissions 
								 WHERE role_id = " . escape($roleId);
		
		$connection = Connection::getInstance();
		$connection->query($deletePermissionsSql);	
	} 
	
	public static function deletePermission($permissionId)
	{
		$deletePermissionsSql = "DELETE FROM core_roles_permissions 
								 WHERE permission_id = " . escape($permissionId);
		
		$connection = Connection::getInstance();
		$connection->query($deletePermissionsSql);	
	} 
	public static function recursivePermissions($modules, $level, &$permissions, &$object)
	{	
		$color = false;
		switch ($level):
			case 1:
				$color = '#CCCCCC';
				break;
			case 2:
				$color = '#BBBBBB';
				break;
			case 3:
				$color = '#ABABAB';
				break;
		endswitch;
		foreach ($modules as $module)
		{
		?>
            <tr>
              <td <?php if ($color) echo 'style="background-color:'.$color.'"' ?>><?php echo  $module->__get('module_name')?></td>
              <?php
			  foreach($permissions as $permission)
			  {
			  	?>
                <td class="width80px" <?php if ($color) echo 'style="background-color:'.$color.'"' ?>>
                <?php
					$permissionArray = PermissionHelper::retrievePermissions("AND permission_title = '" . $permission->__get('permission_title') . "' AND module_id = " . $module->__get('module_id'));
					if(count($permissionArray) == 1)
					{
						$actualPermission =& $permissionArray[0];
						$checked = '';
						if(PermissionHelper::checkRolePermission($actualPermission->__get('permission_id'), $object->__get('role_id')))
							$checked = 'checked';
					  ?>
						<input <?php echo $checked?> type="checkbox" name="permission<?php echo $actualPermission->__get('permission_id')?>_<?php echo $module->__get('module_id')?>" />
					  <?php
					}
					else
						echo 'N/A';
			  	?>
                </td>
				<?php
			  }
			  ?>
            </tr>        
		<?php            
			$moduleSons	 = ModuleHelper::retrieveModules("AND module_parent = ".$module->__get('module_id')." AND module_state = 'A' ORDER BY module_order");
			if (count($moduleSons) > 0)
				PermissionHelper::recursivePermissions($moduleSons, $level + 1, $permissions, $object);
		}
	}
}
?>