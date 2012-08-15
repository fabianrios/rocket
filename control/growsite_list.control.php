<?php 
require_once('session_header.php'); 
$_GET[0] 			= isset($_GET[0]) ? escape($_GET[0]) : 'site_name';
$page 				= isset($_GET[1]) ? $_GET[1] : 1;
$filter 			= " ORDER by  " . $_GET[0] ;
$sites 				= GrowsiteHelper::selectGrowsites($filter);
$system_name 	= 'growsite_';
//permissions
$create 			= (PermissionHelper::checkPermission($system_name.'_create') !== false) ? "<a href=\"index.php?control_growsite.controller/create\" class=\"cont_administrar2\">Crear Sitio</a>" : '';
$update 			= PermissionHelper::checkPermission($system_name.'_update');
$order 				= PermissionHelper::checkPermission($system_name.'_order');
$delete				= PermissionHelper::checkPermission($system_name.'_delete');
$pager 				= new Pager($_GET[0], '', '', 'index.php?growsite_list.control', 20, $sites['num_rows'], $page); 
$limit 				= ' LIMIT ' . $pager->arrayStartNumber . ',' . $pager->resultSize; 
$sites 				= GrowsiteHelper::retrieveGrowsites($filter . $limit);
?>
<div id="contenido">
	<h2>Librer&iacute;a de Sitios</h2>
	<div class="divider" style="background:none;">
	<div class="clear"></div>
    <div id="mainContent">
		<div id="alertBox">
 	       <?php 
		   $alert = (isset($alert)) ? $alert : array();
		   AlertHelper::placeAlerts($alert); 
		   ?>  
        </div>
		<?php 
            echo $create;
        ?>
        <h3>Listado de sitios</h3>
        <div class="ruta">
           <a href="index.php?home.control">Inicio</a> &gt; <a href="index.php?growsite_list.control">Sitios</a>
        </div>
        <table border="0" cellpadding="0" cellspacing="0">
            <tr>
                <th class="table03">&nbsp;</th>
                <th class="width80px"><a href="index.php?growsite_list.control/site_id">ID</a></th>
                <th><a href="index.php?growsite_list.control/site_name">Nombre</a></th>
                <th class="width80px"><a href="index.php?growsite_list.control/site_state">Estado</a></th>
                <th class="widthacciones">Acciones</th>
            </tr>
            <?php
            foreach($sites as $site)
            {
                $state 			= ($site->__get('site_state') ==  'A') ? 'Activo' : 'Inactivo';
                $state_action 	= "SimpleAJAXCall('index.php?control_growsite.controller/changeState/".$site->__get('site_id')."', updateAlert, 'GET', 'u_state_".$site->__get('site_id')."');";
								$state_display 	= ($order !== false)	? '<a href="javascript:void(0)" onClick="'.$state_action.'">'.$state.'</a>' : $state;
                $edit_display  	= ($update !== false) ? '<a href="index.php?growsite_expand.control/'.$site->__get('site_id').'" class="edit2" title="Editar"><span>Editar</span></a>' : ""; 	
                $delete_display	= ($delete !== false) ? '<a href="index.php?control_growsite.controller/delete/'.$site->__get('site_id').'" class="itemdel2" onClick="return confirm(\'Esta seguro que desea borrar esta sitio?\')" title="Borrar"><span>Eliminar</span></a>' : ""; 
								$edit_link	   	= ($update !== false) ? '<a href="index.php?growsite_expand.control/'.$site->__get('site_id').'">'.$site->__get('site_name').'</a>' : $site->__get('site_name');

							?>
								<tr>
											<td class="table03"><img src="imgcontrol/ico_tree2.gif" width="12" height="12" /></td>
											<td><?php echo $site->__get('site_id')?></td>
											<td><?php echo $edit_link?></a></td>
											<td class="table01 width80px"><div id="u_state_<?php echo $site->__get('site_id')?>"><?php echo $state_display ?></div></td>
											<td class="widthacciones"><?php echo $delete_display?><?php echo $edit_display?></td>
									</tr>
							<?php
            }
            ?>
        </table>
        <?php $pager->display() ?>
    </div>
	</div>
</div>
<?php require_once('footer.php'); ?>