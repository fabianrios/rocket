<?php
$module    = new Module($object->__get('module_id'));
$parent	   = new Content($object->__get('language_parent'));
$languages = LanguageHelper::retrieveLanguages("ORDER BY language_name");
?>
<div class="panel02">
    <div  class="panel_e_galeria"> <a href="#" class="inside_panel2">Lenguajes Disponibles</a>
      <table border="0" cellpadding="0" cellspacing="0">
        <tr>
            <th class="width80px">&nbsp;</th>
            <th>Nombre</th>
            <th class="widthacciones">Acciones</th>
        </tr>
        <?php
		foreach($languages as $language)
		{	
			if($language->__get('language_id') == $parent->__get('language_id'))
			{
				$contentId = $parent->__get('content_id');
				$content   =& $parent;
			}
			else
			{
				$contentId = ContentHelper::retrieveLanguageContentId($object->__get('content_id'), $language->__get('language_id'));
				$content   = new Content($contentId);
			}
			$edit_href = ($contentId === false) ? 'index.php?control_content.controller/addLanguageChild/' . $object->__get('content_id') . '/' . $language->__get('language_id') : 'index.php?content_expand.control/' . $module->__get('module_id') . '/' . $contentId . '/' . $object->__get('content_id');
		?>
          <tr>
        	<td class="width80px"><a href="<?=$edit_href?>"><img src="imgcontrol/ico_page.gif" /></a></td>
            <td><a href="<?=$edit_href?>"><?=$language->__get('language_name')?></a></td>
            <td class="widthacciones"><a href="<?=$edit_href?>" class="edit2"><span>Editar</span></a>
            <?php
			if(($contentId !== false) && ($content->__get('language_parent') != ''))
			{
			?>
            	<a href="index.php?control_content.controller/deleteLanguageChild/<?=$contentId?>" class="itemunlink"><span>Desvincular</span></a>
			<?php
			}
			?>
            </td>
          </tr>
		<?php
		}
		?>
      </table>
    </div>
</div>