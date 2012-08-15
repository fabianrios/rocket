<?php
$fields = FormFieldHelper::retrieveFields ("AND form_id = " . $object->__get('form_id'));
$order_button = "<a href=\"javascript:void(0)\" onclick=\"ParamsAJAXCall('index.php?formfieldfield_order_popup.control/".$object->__get('form_id')."', createSortablePopup, 'GET', 'window2', 'contents');\" class=\"cont_administrar2\">Ordenar</a>";
?>
<div class="panel02">
    <div  class="panel_e_galeria"> <a href="#" class="inside_panel2">Campos Disponibles</a>
      <div class="crear_asociar"> <a href="javascript:void(0);" onclick="SimpleAJAXCall('index.php?form_popup.control/formFieldForm//<?=$object->__get('form_id')?>', loadFormLayer, 'GET', 'window2');">Crear Nuevo</a></div>
      <table border="0" cellpadding="0" cellspacing="0">
        <tr>
            <th>Titulo</th>
            <th>Tipo</th>
            <th>Opciones</th>
            <th>Acciones</th>
        </tr>
        <?php
		foreach($fields as $field)
		{
		?>
        	<tr>
            	<td><?=$field->__get('form_field_title')?></td>
            	<td><?=$field->__get('form_field_type')?></td>
            	<td><?=$field->__get('form_field_options')?></td>
                <td class="widthacciones"><a href="javascript:void(0);" onclick="SimpleAJAXCall('index.php?form_popup.control/formFieldForm/<?=$field->__get('form_field_id')?>/<?=$object->__get('form_id')?>', loadFormLayer, 'GET', 'window2');" class="edit2"><span>Editar</span></a><a href="index.php?control_formfield.controller/delete/<?=$field->__get('form_field_id')?>/<?=$object->__get('form_id')?>" onclick="return confirm('Esta seguro que desea eliminar este item?');" class="itemunlink"><span>Eliminar</span></a></td>                                                                
            </tr>
		<?php
		}
		?>
      </table>
      <div class="crear_asociar"> <a href="javascript:void(0);" onclick="SimpleAJAXCall('index.php?form_popup.control/formFieldForm//<?=$object->__get('form_id')?>', loadFormLayer, 'GET', 'window2');">Crear Nuevo</a> </div>      
    </div>
</div>