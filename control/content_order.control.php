<?php
$module = new Module($object->__get('module_id'));
?>
<div class="panel02">
<form action="index.php?control_content.controller/<?=$object->__get('module_id')?>" method="POST">
    <label> 
        <span>Estado</span>
        <select name="content_state" id="content_state">
            <option value="I" <?php echo ($object->__get('content_state') == 'I') ? 'selected="selected"' : '';  ?>>Inactivo</option>
            <option value="A" <?php echo ($object->__get('content_state') == 'A') ? 'selected="selected"' : '';  ?>>Activo</option>
        </select>
    </label>
<?php
	$sites = SiteHelper::retrieveSites(" ORDER BY site_id");
	switch ($module->__get('module_site_connection')):
		case '1': //exclusive
			$type = 'radio';
			$field_name = 'site_id';
		break;
		case '2': //exclusive
			$type = 'checkbox';
			$field_name = '';
		break;
		default;
			$type = '';
		break;
	endswitch;
	if ($type != '')
	{
?>
		<label>
            <span>Sitio(s)</span>
            <div class="rad_group">
<?php
			foreach ($sites as $site)
			{
				$name = ($field_name != '') ? $field_name : 'site_'.$site->__get('site_id');
				$checked = (count(ContentHelper::siteContent(" AND content_id = " . $object->__get('content_id') . " AND site_id = " . $site->__get('site_id'))) > 0) ? 'checked="checked"' : '';
				echo "<label>";
				echo "<input type='".$type."' name='".$name."' id='".$name."' value='".$site->__get('site_id')."' ".$checked."/>";		
				echo $site->__get('site_name')."</label>";
			}
?>
            </div>
        </label>
<?php
	}
?>
                  <div class="botones">
                  	<input  type="hidden" name="content_id" value="<?=$object->__get('content_id')?>"/>
                  	<input  type="hidden" name="action" value="orderContent"/>
                    <input name="" type="image" src="imgcontrol/bot_guardar.gif" alt="Guardar" width="170" height="42" />
                    <input name="" type="image" src="imgcontrol/bot_cancelar.gif" alt="Cancelar" width="127" height="28" onClick="javascript:void(0); this.form.reset(); " />
                  </div>
</form>
</div>