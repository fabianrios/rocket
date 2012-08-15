<?php
$form 	= new Form('index.php?control_content.controller/update/'.$object->__get('module_id').'/'.$object->__get('content_id'), 'POST', $object->__get('content_id'),'', 'form', 'validable');
$fields = FieldHelper::retrieveFields( " AND module_id = " . $object->__get('module_id') . " ORDER by field_order");
?>
<div class="panel02">
<?php 
$form->startForm(); 
foreach ($fields as $field)
{
	if (strpos($field->__get('field_restriction'), $object->__get('content_level')) === false) 
	{
		$value = str_replace("\\", "" ,$object->__get($field->__get('field_name')));
		$options = $field->__get('field_options')
?>
<label> 
	<span><?=$field->__get('field_label');?></span>
    <div id="<?=$field->__get('field_name')?>">
		<?php $form->putField($field->__get('field_type'), $field->__get('field_name'), $value, $options, '', $field->__get('field_class'), $field->__get('field_required')); ?>
	</div>
</label>
<?php
	}
}
?>
<div class="botones">
<input name="" type="image" src="imgcontrol/bot_guardar.gif" alt="Guardar" width="170" height="42" />
<input name="" type="image" onClick="javascript:void(0);" src="imgcontrol/bot_cancelar.gif" alt="Cancelar" width="127" height="28" />
</div>
<?php
$form->endForm(); 
?>
</div>
<!---
<label> <span>Color Favorito</span>
<select name="select" id="select">
<option>- seleccione -</option>
<option>Rojo</option>
<option>Amarillo</option>
<option>Naranja</option>
<option>Negro</option>
</select>
</label>
<label>
<span>Fruta Favorita</span>
<div class="rad_group">
<label>
<input type="radio" name="RadioGroup1" value="radio" id="RadioGroup1_0" />
Manzana</label>
<label>
<input type="radio" name="RadioGroup1" value="radio" id="RadioGroup1_1" />
Banano </label>
<label>
<input type="radio" name="RadioGroup1" value="radio" id="RadioGroup1_2" />
Piña </label>
</div>
</label>
<label>
--->
