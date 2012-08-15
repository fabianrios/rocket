<div class="panel02">
	<form action="index.php?control_site.controller/update" method="post" id="validable">
		<input type="hidden" name="site_id" value="<?=$object->__get('site_id')?>" />
        <input type="hidden" name="module_id" value="<?=$module?>" />
        <label> 
            <span>Nombre</span>
            <input type="text" name="site_name" id="site_name" value="<?=$object->__get('site_name')?>" />
        </label>
        <label> 
            <span>Hoja de Estilos (Ruta)</span>
            <input type="text" name="site_css" id="site_css" value="<?=$object->__get('site_css')?>" />
        </label>        
        <div class="botones">
            <input name="" type="image" src="imgcontrol/bot_guardar.gif" alt="Guardar" width="170" height="42" />
            <input name="" type="image" src="imgcontrol/bot_cancelar.gif" alt="Cancelar" width="127" height="28" />
        </div>
	</form>
</div>