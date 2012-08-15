<?php
$object 	= ($_GET[1] != 0) ? new Content($_GET[1]) : new Content();
$level_name = ($_GET[1] != 0) ? $object->__get('content_varchar_1') : $module->__get('module_title');
$system_name = $module->__get('module_system_name');
//permissions
$level 			= ($object->__get('content_level') != '') ? ($object->__get('content_level') + 1) : 1;
$levelParent 	= ($object->__get('content_level') != '') ? $object->__get('content_level') : 1;
$create 		= 	((PermissionHelper::checkPermission($system_name.'_create', $level) !== false) && ($module->__get('module_levels') > $object->__get('content_level'))) ? "<a href=\"index.php?control_content.controller/create/".$content_type."/".$_GET[1]."\" class=\"cont_administrar2\">Adicionar Hijo</a>" : '';
$update = PermissionHelper::checkPermission($system_name.'_update', $levelParent);
$update_button = (($update !== false) && ($_GET[1] != 0)) ? "<a href=\"index.php?content_expand.control/".$content_type."/".$_GET[1]."\" class=\"cont_administrar2\">Editar</a>" : '';
$order 	= PermissionHelper::checkPermission($system_name.'_order', $level);
$order_button = ($order != false) ? "<a href=\"javascript:void(0)\" onclick=\"ParamsAJAXCall('index.php?order_popup.control/".$_GET[1]."/" . $module->__get('module_id') . "', createSortablePopup, 'GET', 'window2', 'orderContents');\" class=\"cont_administrar2\">Ordenar</a>" : "";
$delete = PermissionHelper::checkPermission($system_name.'_delete', $level);
?>
<div id="mainContent">
    <div id="alertBox">
       <?php 
       $alert = (isset($alert)) ? $alert : array();
       AlertHelper::placeAlerts($alert); 
       ?>  
    </div>
	<?=$create?>
    <?=$order_button?>
	<?=$update_button?>
	<h3><?=$level_name?></h3>
	<div class="ruta"><br />
		<?php ContentHelper::dumpBreadCrum($module, $_GET[2]); ?>
    </div>
    <table border="0" cellpadding="0" cellspacing="0">
		<tr>
			<th>&nbsp;</th>
            <th><a href="#">Nombre</a></th>
            <th class="width50px"><a href="#">Hijos</a></th>
            <th class="width80px"><a href="#">Estado</a></th>
            <th class="width50px"><a href="#">&Uacute;ltima Actualizaci&oacute;n</a></th>
            <th class="widthacciones">Acciones</th>
        </tr>
        <?php
		foreach ($contents as $content)
		{
			//sons
			$filter = " AND content_parent = " . $content->__get('content_id');
			$sons = ContentHelper::retrieveContents($filter);
			//permissions
			$state = ($content->__get('content_state') ==  'A') ? 'Activo' : 'Inactivo';
			$state_action = "SimpleAJAXCall('index.php?control_content.controller/changeState/".$content->__get('content_id')."', updateAlert, 'GET', 'u_state_".$content->__get('content_id')."');";
			$state_display = ($order !== false) ? '<a href="javascript:void(0)" onClick="'.$state_action.'">'.$state.'</a>' : $state;
			$edit_url = 'index.php?content_list.control/'.$content_type.'/'.$content->__get('content_id');
			$edit_display  = ($update !== false) ? '<a href="'.$edit_url.'" class="edit2" title="Editar"><span>Editar</span></a>' : ""; 	
			$delete_display= (($delete !== false) && ($content->__get('content_options') != 'noDelete')) ? '<a href="index.php?control_content.controller/delete/'.$content_type.'/'.$content->__get('content_id').'" class="itemdel2" onClick="return confirm(\'Esta seguro que desea borrar este contenido?\')" title="Borrar"><span>Eliminar</span></a>' : ""; 	
		?>
            <tr>
                <td class="table03"><img src="imgcontrol/ico_tree2.gif" width="12" height="12" /></td>
                <td><a href="<?=$edit_url?>"><?=str_replace("\\", "" ,$content->__get('content_varchar_1'))?></a></td>
                <td class="table01 width50px"><?=count($sons)?></td>
                <td class="table01 width80px"><div id="u_state_<?=$content->__get('content_id')?>"><?=$state_display?></div></td>
                <td class="table01 width50px"><? echo formatDate('%d/%m/%Y', $content->__get('content_datetime_update'));?></td>
                <td class="widthacciones"><?=$delete_display?><?=$edit_display?></td>
            </tr>
    	<?php
		}
		?>
    </table>
</div>