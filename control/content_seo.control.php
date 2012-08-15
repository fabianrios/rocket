<?php
$metaTagArray = MetaTagHelper::retrieveMetaTags("AND content_id = " . $object->__get('content_id'));
if(count($metaTagArray) > 0)
	$metaTag =& $metaTagArray[0];
else
	$metaTag = new MetaTag();;	
?>
<div class="panel02">
	<form action="index.php?control_seo.controller/update" method="post" id="validable">
		<?php
		if($metaTag->__get('meta_tag_id') != '')
		{
		?>
			<input type="hidden" name="meta_tag_id" value="<?=$metaTag->__get('meta_tag_id')?>" />
        <?php
		}
		?>
		<label> 
            <span>T&iacute;tulo</span>
            <input type="text" name="meta_tag_title" id="meta_tag_title" value="<?=$metaTag->__get('meta_tag_title')?>" />
        </label>
        <label> 
            <span>Descripci&oacute;n</span>
            <textarea rows="5" cols="50" name="meta_tag_description"><?=$metaTag->__get('meta_tag_description')?></textarea>
        </label>
        <label> 
            <span>Palabras clave</span>
            <textarea rows="5" cols="50" name="meta_tag_keywords"><?=$metaTag->__get('meta_tag_keywords')?></textarea>
        </label>
        <label> 
            <span>Frases clave</span>
            <textarea rows="5" cols="50" name="meta_tag_keyphrases"><?=$metaTag->__get('meta_tag_keyphrases')?></textarea>
        </label>        
        <div class="botones">
            <input name="" type="image" src="imgcontrol/bot_guardar.gif" alt="Guardar" width="170" height="42" />
            <input name="" type="image" src="imgcontrol/bot_cancelar.gif" alt="Cancelar" width="127" height="28" />
        </div>
		<input type="hidden" name="content_id" value="<?php echo $object->__get('content_id')?>" />
	</form>
</div>