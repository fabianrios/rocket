<?php require_once('session_header.php'); 
$_GET[0] = isset($_GET[0]) ? escape($_GET[0]) : 'user_full_name';
$page = isset($_GET[1]) ? $_GET[1] : 1;
$filter = " ORDER by  " . $_GET[0] ;
$users = ControlUserHelper::selectUsers($filter);
$system_name = 'user';
//permissions
$create = 	(PermissionHelper::checkPermission($system_name.'_create') !== false) ? "<a href=\"index.php?control_user.controller/create\" class=\"cont_administrar2\">Crear Usuario</a>" : '';
$update = PermissionHelper::checkPermission($system_name.'_update');
$order 	= PermissionHelper::checkPermission($system_name.'_order');
$delete = PermissionHelper::checkPermission($system_name.'_delete');
$pager = new Pager($_GET[0], '', '', 'index.php?user_list', 20, $users['num_rows'], $page); 
$limit = ' LIMIT ' . $pager->arrayStartNumber . ',' . $pager->resultSize; 
$users = ControlUserHelper::retrieveUsers($filter . $limit);
?>
<div id="contenido">
	<h2>Usuarios</h2>
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
        <h3>Listado de Usuarios</h3>
        <div class="ruta">
           <a href="index.php?home.control">Inicio</a> &gt; <a href="index.php?user_list.control">Usuarios</a>
        </div>
        <table border="0" cellpadding="0" cellspacing="0">
            <tr>
                <th>&nbsp;</th>
                <th><a href="index.php?user_list/user_full_name">Nombre</a></th>
                <th><a href="index.php?user_list/user_email">E-mail</a></th>
                <th class="width80px"><a href="index.php?user_list/user_state">Estado</a></th>
                <th class="width50px"><a href="index.php?user_list/user_lastlogin">&Uacute;ltimo Ingreso</a></th>
                <th class="widthacciones">Acciones</th>
            </tr>
            <?php
            foreach($users as $user)
            {
                $state = ($user->__get('user_state') ==  'A') ? 'Activo' : 'Inactivo';
                $state_action = "SimpleAJAXCall('index.php?control_user.controller/changeState/".$user->__get('user_id')."', updateAlert, 'GET', 'u_state_".$user->__get('user_id')."');";
				$state_display = ($order !== false) ? '<a href="javascript:void(0)" onClick="'.$state_action.'">'.$state.'</a>' : $state;
                $edit_display  = ($update !== false) ? '<a href="index.php?user_expand.control'.$user->__get('user_id').'" class="edit2" title="Editar"><span>Editar</span></a>' : ""; 	
                $delete_display= ($delete !== false) ? '<a href="index.php?control_user.controller/delete/'.$user->__get('user_id').'" class="itemdel2" onClick="return confirm(\'Esta seguro que desea borrar este usuario?\')" title="Borrar"><span>Eliminar</span></a>' : ""; 		
            
            ?>
               <tr>
                    <td class="table03"><img src="imgcontrol/ico_tree2.gif" width="12" height="12" /></td>
                    <td><a href="index.php?user_expand.control/<?=$user->__get('user_id')?>"><?=$user->__get('user_full_name')?></a></td>
                    <td><?=$user->__get('user_email')?></td>
                    <td class="table01 width80px"><div id="u_state_<?=$user->__get('user_id')?>"><?=$state_display ?></div></td>
                    <td class="table01 width50px"><? echo formatDate('%d/%m/%Y', $user->__get('user_datetime_last_login')); ?></td>
                    <td class="widthacciones"><?=$delete_display?><?=$edit_display?></td>
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