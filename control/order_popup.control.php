<?php
header('Content-Type: text/html; charset=ISO-8859-1'); 
$parentId = $_GET[0];
$moduleId = $_GET[1];
$contents = ContentHelper::retrieveContents("AND content_parent = " . $parentId . " AND module_id = " . $moduleId . " ORDER BY content_order");
?>
  <h3>ORDENAR CONTENIDOS</h3>
  <p>Arrastre los contenidos para ordenarlos</p>
  <div class="medio_selector">
    <ul id="orderContents" class="sortableList">
      <?
		foreach($contents as $content) {
		?>
      <li id="item_<?=$content->__get('content_id')?>"> <a href="javascript:void(0);"><img src="imgcontrol/ico_page.gif" />
        <?=$content->__get('content_varchar_1');?>
        </a> </li>
      <?
		}
		?>
    </ul>
  </div>
<form id="serializeForm" method="post" action="index.php?control_content.controller">
	<input type="hidden" name="serializedArray" value="" />
	<input type="hidden" name="action" value="setOrder" />
    <input type="hidden" name="parentId" value="<?=$_GET[0]?>" />
    <input type="hidden" name="moduleId" value="<?=$_GET[1]?>" />
    <div class="botones2"> <a href="javascript:void(0);" onClick="document.getElementById('serializeForm').submit();"><img src="imgcontrol/bot_l_guardar.gif" border="0" /></a> </div>
</form>