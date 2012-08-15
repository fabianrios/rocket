<div class="panel02">
	<form action="index.php?control_seo.controller/update" method="post" id="validable">
		<input type="hidden" name="meta_tag_id" value="<?=$object->__get('meta_tag_id')?>" />
        <label> 
            <span>T&iacute;tulo</span>
            <input type="text" name="meta_tag_title" id="meta_tag_title" value="<?=$object->__get('meta_tag_title')?>" />
        </label>
        <label> 
            <span>Descripci&oacute;n</span>
            <textarea rows="5" cols="50" name="meta_tag_description"><?=$object->__get('meta_tag_description')?></textarea>
        </label>
        <label> 
            <span>Palabras clave</span>
            <textarea rows="5" cols="50" name="meta_tag_keywords"><?=$object->__get('meta_tag_keywords')?></textarea>
        </label>
        <label> 
            <span>Frases clave</span>
            <textarea rows="5" cols="50" name="meta_tag_keyphrases"><?=$object->__get('meta_tag_keyphrases')?></textarea>
        </label>        
        <div class="botones">
            <input name="" type="image" src="imgcontrol/bot_guardar.gif" alt="Guardar" width="170" height="42" />
            <input name="" type="image" src="imgcontrol/bot_cancelar.gif" alt="Cancelar" width="127" height="28" />
        </div>
	</form>
</div>