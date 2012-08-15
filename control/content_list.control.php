<?php
$content_type = escape($_GET[0]);
$_GET[1] = isset($_GET[1]) ? $_GET[1] : 0;
//Modulo
$module = new Module(escape($content_type));
//Lista Contenido
$filter = " AND content_parent = ".escape($_GET[1])." AND module_id = " . escape ($content_type);
$order	= ($module->__get('module_order_by') == '') ? 'content_order' : $module->__get('module_order_by'); 
$_GET[2] = isset($_GET[2]) ? $_GET[2] : $order;
$order = " ORDER by ". escape($_GET[2]);
$contents 	  = ContentHelper::retrieveContents($filter . $order);
$query		  = ($module->__get('module_order_by') == '') ? "AND content_parent = 0 AND module_id = " . escape ($content_type) . " ORDER BY content_order" : "AND content_parent = 0 AND module_id = " . escape ($content_type) . " ORDER BY ". $module->__get('module_order_by');
$all_contents = ContentHelper::retrieveContents($query);
require_once(CONTROL_VIEW.'session_header.php'); 
?>
<div id="contenido"> 
	<h2><?=$module->__get('module_name')?></h2>
	<div class="divider">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="layout">
			<tr>
				<td width="170px">
 	               <div id="sidebar1"> 
                	<?php  
						ContentHelper::dumpAllContents($all_contents, $content_type);
					?>
					</div>
                </td>
                <td>
					<?php
						require_once('content_list_level.control.php');
					?>
	            </td>
			</tr>
		</table>
		<div class="clear"></div>
	</div>
</div>
<?php
require_once(CONTROL_VIEW . "footer.php");
?>