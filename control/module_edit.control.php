<?php
$modules 		= ModuleHelper::retrieveModules();
$createArray    = PermissionHelper::retrievePermissions("AND permission_system_name = '" . $object->__get('module_system_name') . "_create' AND module_id = " . $object->__get('module_id'));
$retrieveArray  = PermissionHelper::retrievePermissions("AND permission_system_name = '" . $object->__get('module_system_name') . "_retrieve' AND module_id = " . $object->__get('module_id'));
$updateArray    = PermissionHelper::retrievePermissions("AND permission_system_name = '" . $object->__get('module_system_name') . "_update' AND module_id = " . $object->__get('module_id'));
$deleteArray    = PermissionHelper::retrievePermissions("AND permission_system_name = '" . $object->__get('module_system_name') . "_delete' AND module_id = " . $object->__get('module_id'));
$orderArray     = PermissionHelper::retrievePermissions("AND permission_system_name = '" . $object->__get('module_system_name') . "_order' AND module_id = " . $object->__get('module_id'));
$create    		= (count($createArray) > 0) 	? $createArray[0] : new Permission();
$retrieve  		= (count($retrieveArray) > 0) 	? $retrieveArray[0] : new Permission();
$update    		= (count($updateArray) > 0) 	? $updateArray[0] : new Permission();
$delete    		= (count($deleteArray) > 0) 	? $deleteArray[0] : new Permission();
$order     		= (count($orderArray) > 0) 		? $orderArray[0] : new Permission();
?>
<div class="panel02">
  <form action="index.php?control_module.controller/addmodule" method="post">
  	<input type="hidden" name="module_id" value="<?php echo $object->__get('module_id')?>" />
    <div>
      <label> <span>Titulo</span>
      <input type="text" name="module_name" value="<?php echo $object->__get('module_name')?>" />
      </label>
    </div>
    <br />
    <div>
      <label> <span>Padre</span>
      <select name="module_parent">
        <option value="NULL">-</option>
        <?php 
		foreach ($modules as $module)
		{
			$selected = '';
			if($object->__get('module_parent') == $module->__get('module_id'))
				$selected = 'selected="selected"';
		?>
        <option value="<?php echo $module->__get('module_id')?>" <?php echo $selected?>>
        <?php echo $module->__get('module_name')?>
        </option>
        <?php
		}
		?>
      </select>
      </label>
    </div>
    <div>
      <label> <span>Nombre del Sistema</span>
      <input type="text" name="module_system_name" value="<?php echo $object->__get('module_system_name')?>" />
      </label>
    </div>    
    <br />
    <div>
      <label> <span>Orden</span>
      <input type="text" name="module_order" value="<?php echo $object->__get('module_order')?>" />
      </label>
    </div>
    <br />    
    <div>
      <label> <span>Contenido</span>
      <div class="rad_group">
          <label>
          <input type="radio" name="module_content" value="0" checked="checked" onClick="document.getElementById('content').style.display='none';"  /> No
          </label>
          <label>
          <input type="radio" name="module_content" value="1" <?php echo ($object->__get('module_content') == 1) ? 'checked="checked"' : '';?> onClick="document.getElementById('content').style.display=''; prefillPermissions();"/> Si
           </label>
       </div>
       </label>
    </div>
    <br />
    <div id="content" <?php if ($object->__get('module_content') != 1) echo  'style="display:none;"'; ?>>
        <div>
          <label> <span>Niveles</span>
          <input type="text" name="module_levels" value="<?php echo $object->__get('module_levels')?>" />
          </label>
        </div>
        <br />
        <div>
          <label> <span>Listar en Links</span>
          <div class="rad_group">
              <label>      
                No<input type="radio" name="module_list" value="0" checked="checked"  onClick="document.getElementById('link_list').style.display='none';" />
              </label>
              <label>
                Si<input type="radio" name="module_list" value="1" <?php echo ($object->__get('module_list') == 1) ? 'checked="checked"' : '';?> onClick="document.getElementById('link_list').style.display='';" />
              </label>
          </div>
          </label>
        </div>
        <br />
        <div id="link_list" <?php if ($object->__get('module_list') != 1) echo  'style="display:none;"'; ?>>
            <div>
              <label> <span>Pagina Inicial M&oacute;dulo</span>
              <input type="text" name="module_front" value="<?php echo $object->__get('module_front')?>" />
              </label>
            </div>
            <br />
            <div>
              <label> <span>P&aacute;gina Detalle</span>
              <input type="text" name="module_specific" value="<?php echo $object->__get('module_specific')?>" />
              </label>
            </div>
	        <br />        
		</div>
    </div>
    <div  class="panel_e_galeria"> 
      <a href="javascript:void(0);" class="inside_panel2">Permisos</a>
      <table border="0" cellpadding="0" cellspacing="0">
      	<tr>
            <th class="width80px">&nbsp;</th>
        	<th class="width80px">Acci&oacute;n</th>
            <th>Render</th>
        	<th>Restricci&oacute;n</th>
            <th>Panel</th>
            <th>Lectura</th>
        </tr>
        <tr>
        	<td><input type="checkbox" name="a_1" id="a_1" value="Agregar,create" <?php if($create->__get('permission_id') != '') { ?>checked="checked"<?php } ?> /></td>
        	<td>Crear</td>
        	<td><input type="text" name="a_1_render" id="a_1_render" value="<?php echo $create->__get('permission_render')?>" /></td>
        	<td><input type="text" name="a_1_restriction" id="a_1_restriction" value="<?php echo $create->__get('permission_restriction')?>" /></td>
        	<td><input type="checkbox" name="a_1_list" id="a_1_list" <?php echo ($create->__get('permission_list') == 1) ? 'checked="checked"' : ''?> /></td>
        	<td><input type="checkbox" name="a_1_reading" id="a_1_reading" <?php echo ($create->__get('permission_reading') == 1) ? 'checked="checked"' : ''?> /></td>                                    
      	</tr>
        <tr>
        	<td><input type="checkbox" name="a_2" id="a_2" value="Listar,retrieve" <?php if($retrieve->__get('permission_id') != '') { ?>checked="checked"<?php } ?> /></td>
        	<td>Listar</td>
        	<td><input type="text" name="a_2_render" id="a_2_render" value="<?php echo $retrieve->__get('permission_render')?>" /></td>
        	<td><input type="text" name="a_2_restriction" id="a_2_restriction" value="<?php echo $retrieve->__get('permission_restriction')?>" /></td>
        	<td><input type="checkbox" name="a_2_list"  id="a_2_list"  <?php echo ($retrieve->__get('permission_list') == 1) ? 'checked="checked"' : ''?> /></td>
        	<td><input type="checkbox" name="a_2_reading" id="a_2_reading" <?php echo ($retrieve->__get('permission_reading') == 1) ? 'checked="checked"' : ''?> /></td>   
        </tr>
        <tr>
        	<td><input type="checkbox" name="a_3" id="a_3" value="Modificar,update" <?php if($update->__get('permission_id') != '') { ?>checked="checked"<?php } ?> /></td>
        	<td>Actualizar</td>
        	<td><input type="text" name="a_3_render" id="a_3_render" value="<?php echo $update->__get('permission_render')?>" /></td>
        	<td><input type="text" name="a_3_restriction" id="a_3_restriction" value="<?php echo $update->__get('permission_restriction')?>" /></td>
        	<td><input type="checkbox" name="a_3_list" id="a_3_list" <?php echo ($update->__get('permission_list') == 1) ? 'checked="checked"' : ''?> /></td>
        	<td><input type="checkbox" name="a_3_reading" id="a_3_reading" <?php echo ($update->__get('permission_reading') == 1) ? 'checked="checked"' : ''?> /></td>   
        </tr>
        <tr>
        	<td><input type="checkbox" name="a_4" id="a_4" value="Borrar,delete" <?php if($delete->__get('permission_id') != '') { ?>checked="checked"<?php } ?> /></td>
        	<td>Borrar</td>
        	<td><input type="text" name="a_4_render" id="a_4_render" value="<?php echo $delete->__get('permission_render')?>" /></td>
        	<td><input type="text" name="a_4_restriction" id="a_4_restriction" value="<?php echo $delete->__get('permission_restriction')?>" /></td>
        	<td><input type="checkbox" name="a_4_list"  id="a_4_list" <?php echo ($delete->__get('permission_list') == 1) ? 'checked="checked"' : ''?> /></td>
        	<td><input type="checkbox" name="a_4_reading" id="a_4_reading" <?php echo ($delete->__get('permission_reading') == 1) ? 'checked="checked"' : ''?> /></td>   
        </tr>
        <tr>
        	<td><input type="checkbox" name="a_5" id="a_5" value="Ordenar,order" <?php if($order->__get('permission_id') != '') { ?>checked="checked"<?php } ?> /></td>
        	<td>Ordenar</td>
        	<td><input type="text" name="a_5_render" id="a_5_render" value="<?php echo $order->__get('permission_render')?>" /></td>
        	<td><input type="text" name="a_5_restriction" id="a_5_restriction"  value="<?php echo $order->__get('permission_restriction')?>" /></td>
        	<td><input type="checkbox" name="a_5_list" id="a_5_list" <?php echo ($order->__get('permission_list') == 1) ? 'checked="checked"' : ''?> /></td>
        	<td><input type="checkbox" name="a_5_reading" id="a_5_reading" <?php echo ($order->__get('permission_reading') == 1) ? 'checked="checked"' : ''?> /></td>   
        </tr>      
       </table>                
    </div>
    <div class="botones">
      <input name="" type="image" src="imgcontrol/bot_guardar.gif" alt="Guardar" width="170" height="42" />
      <input name="" type="image" src="imgcontrol/bot_cancelar.gif" alt="Cancelar" width="127" height="28" />
    </div>
    <input type="hidden" name="a_1_permission_id" value="<?php echo $create->__get('permission_id')?>" />
    <input type="hidden" name="a_2_permission_id" value="<?php echo $retrieve->__get('permission_id')?>" />
    <input type="hidden" name="a_3_permission_id" value="<?php echo $update->__get('permission_id')?>" />
    <input type="hidden" name="a_4_permission_id" value="<?php echo $delete->__get('permission_id')?>" />
    <input type="hidden" name="a_5_permission_id" value="<?php echo $order->__get('permission_id')?>" />               
  </form>
</div>
<a href="#" class="sobrepanel">Campos</a>
<?php 
require_once(CONTROL_VIEW.'module_fields.control.php');
?>
