<?php
$fields = FieldHelper::retrieveFields ("AND module_id = " . $object->__get('module_id'))
?>
<div class="panel02">
    <div  class="panel_e_galeria"> <a href="#" class="inside_panel2">Campos Disponibles</a>
      <div class="crear_asociar"> <a href="javascript:void(0);" onclick="SimpleAJAXCall('index.php?form_popup.control/fieldForm//<?php echo $object->__get('module_id')?>', loadFormLayer, 'GET', 'window2');">Crear Nuevo</a></div>
      <table border="0" cellpadding="0" cellspacing="0">
        <tr>
            <th>Label</th>
            <th>Nombre</th>
            <th>Restricci&oacute;n</th>
            <th>Tipo</th>
            <th>Opciones</th>
            <th>Acciones</th>
        </tr>
        <?php
		foreach($fields as $field)
		{
		?>
        	<tr>
            	<td><?php echo $field->__get('field_label')?></td>
            	<td><?php echo $field->__get('field_name')?></td>
            	<td><?php echo $field->__get('field_restriction')?></td>
            	<td><?php echo $field->__get('field_type')?></td>
            	<td><?php echo $field->__get('field_options')?></td>
                <td class="widthacciones"><a href="javascript:void(0);" onclick="SimpleAJAXCall('index.php?form_popup.control/fieldForm/<?php echo $field->__get('field_id')?>/<?php echo $object->__get('module_id')?>', loadFormLayer, 'GET', 'window2');" class="edit2"><span>Editar</span></a><a href="index.php?control_field.controller/delete/<?php echo $field->__get('field_id')?>/<?php echo $object->__get('module_id')?>" onclick="return confirm('Esta seguro que desea eliminar este item?');" class="itemunlink"><span>Eliminar</span></a></td>                                                                
            </tr>
		<?php
		}
		?>
      </table>
      <div class="crear_asociar"> <a href="javascript:void(0);" onclick="SimpleAJAXCall('index.php?form_popup.control/fieldForm//<?php echo $object->__get('module_id')?>', loadFormLayer, 'GET', 'window2');">Crear Nuevo</a> </div>      
    </div>
</div>