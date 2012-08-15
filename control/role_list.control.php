<?php require_once('session_header.php'); 
$_GET[0] 	 = isset($_GET[0]) ? escape($_GET[0]) : 'role_name';
$page 	     = isset($_GET[1]) ? $_GET[1] : 1;
$filter      = " ORDER BY " . escape($_GET[0]) ;
$roles   	 = RoleHelper::selectRoles($filter);
$system_name = 'config_permission';
//permissions
$create = 	(PermissionHelper::checkPermission($system_name.'_create') !== false) ? "<a href=\"index.php?control_role.controller/create\" class=\"cont_administrar2\">Crear Rol</a>" : '';
$update = PermissionHelper::checkPermission($system_name.'_update');
$order 	= PermissionHelper::checkPermission($system_name.'_order');
$delete = PermissionHelper::checkPermission($system_name.'_delete');
$pager  = new Pager($_GET[0], '', '', 'index.php?role_list.control', 20, $roles['num_rows'], $page); 
$limit  = ' LIMIT ' . $pager->arrayStartNumber . ',' . $pager->resultSize; 
$roles  = RoleHelper::retrieveRoles($filter . $limit);
?>
<div id="contenido">
	<h2>Usuarios</h2>
	<div class="divider" style="background:none;">
	<div class="clear"></div>
    <div id="mainContent">
		<div id="alertBox">
 	       <?php 
		   $alert = (isset($alert)) ? $alert : array();
		   AlertHelper::placeAlerts($alert); ?>  
        </div>
		<?php 
            echo $create;
        ?>
        <h3>Listado de Roles</h3>
        <div class="ruta">
           <a href="index.php?home.control">Inicio</a> &gt; <a href="index.php?role_list.control">Roles</a>
        </div>
        <table border="0" cellpadding="0" cellspacing="0">
            <tr>
                <th>&nbsp;</th>
                <th><a href="index.php?role_list.control/role_name">Nombre</a></th>
                <th class="width80px"><a href="index.php?role_list.control/role_state">Estado</a></th>
                <th class="widthacciones">Acciones</th>
            </tr>
            <?php
            foreach($roles as $role)
            {
                $state 		   	= ($role->__get('role_state') ==  'A') ? 'Activo' : 'Inactivo';
                $state_action 	= "SimpleAJAXCall('index.php?control_role.controller/changeState/".$role->__get('role_id')."', updateAlert, 'GET', 'u_state_".$role->__get('role_id')."');";
				$state_display 	= ($order !== false) 	? '<a href="javascript:void(0)" onClick="'.$state_action.'">'.$state.'</a>' : $state;
                $edit_display  	= ($update !== false) 	? '<a href="index.php?role_expand.control/" class="edit2" title="Editar"><span>Editar</span></a>' : ""; 	
                $delete_display	= ($delete !== false) 	? '<a href="index.php?control_role.controller/delete/'.$role->__get('role_id').'" class="itemdel2" onClick="return confirm(\'Esta seguro que desea borrar este rol?\')" title="Borrar"><span>Eliminar</span></a>' : ""; 
				$edit_link	   	= ($update !== false) 	? '<a href="index.php?role_expand.control/'.$role->__get('role_id').'">'.$role->__get('role_name').'</a>' : $role->__get('role_name');
            
            ?>
                <tr>
                    <td class="table03"><img src="imgcontrol/ico_tree2.gif" width="12" height="12" /></td>
                    <td><?php echo $edit_link ?></a></td>
                    <td class="table01 width80px"><div id="u_state_<?php echo $role->__get('role_id')?>"><?php echo $state_display?></div></td>
                    <td class="widthacciones"><?php echo $edit_display?><?php echo $delete_display?></td>
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