<div class="panel02">
	<form action="index.php?control_form.controller/update" method="post" id="validable">
		<input type="hidden" name="form_id" value="<?=$object->__get('form_id')?>" />
        <label> 
            <span>Nombre</span>
            <input type="text" name="form_title" id="form_name" value="<?=$object->__get('form_title')?>" />
        </label>
        <div class="botones">
            <input name="" type="image" src="imgcontrol/bot_guardar.gif" alt="Guardar" width="170" height="42" />
            <input name="" type="image" src="imgcontrol/bot_cancelar.gif" alt="Cancelar" width="127" height="28" />
        </div>
	</form>
</div>