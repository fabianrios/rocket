<?php
$permissions = PermissionHelper::retrievePermissions("GROUP BY permission_title ORDER BY permission_title");
$modules	 = ModuleHelper::retrieveModules("AND module_parent = 0 AND module_state = 'A' ORDER BY module_order");
?>
<div class="panel02">
  <form action="index.php?control_role.controller/update" method="post" id="validable">
    <input type="hidden" name="role_id" value="<?php echo $object->__get('role_id')?>" />
    <label> <span>Nombre</span>
    <input type="text" name="role_name" id="role_name" value="<?php echo $object->__get('role_name')?>" />
    </label>
    <div class="panel_e_galeria"> <a href="#" class="inside_panel2">Permisos</a>
      <table border="0" cellpadding="0" cellspacing="0">
        <tr>
          <th><a href="#">M&oacute;dulo</a></th>
		  <?php
		  foreach($permissions as $permission)
		  {
		  ?>
          	<th><?php echo $permission->__get('permission_title')?></th>
          <?php
		  }
		  ?>
        </tr>
        <?php
			PermissionHelper::recursivePermissions($modules, 0, $permissions, $object);
		?>
      </table>
    </div>
    <div class="botones">
      <input name="" type="image" src="imgcontrol/bot_guardar.gif" alt="Guardar" width="170" height="42" />
      <input name="" type="image" src="imgcontrol/bot_cancelar.gif" alt="Cancelar" width="127" height="28" />
    </div>
  </form>
</div>
