<?php require_once('session_header.php'); 
$_GET[0] = isset($_GET[0]) ? escape($_GET[0]) : 'contact_date DESC';
$page = isset($_GET[1]) ? $_GET[1] : 1;
$filter = " ORDER BY  " . $_GET[0] ;
$contacts = ContactHelper::selectContacts($filter);
$system_name = 'user';
//permissions
$create = 	'';
$update = PermissionHelper::checkPermission($system_name.'_update');
$order 	= PermissionHelper::checkPermission($system_name.'_order');
$delete = PermissionHelper::checkPermission($system_name.'_delete');
$pager = new Pager($_GET[0], '', '', 'index.php?user_list', 20, $contacts['num_rows'], $page); 
$limit = ' LIMIT ' . $pager->arrayStartNumber . ',' . $pager->resultSize; 
$contacts = ContactHelper::retrieveContacts($filter . $limit);
?>
<div id="contenido">
	<h2>Contactos recibidos</h2>
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
        <h3>Listado de Contactos</h3>
        <div class="ruta">
           <a href="index.php?home.control">Inicio</a> &gt; <a href="index.php?user_list.control">Usuarios</a>
        </div>
        <table border="0" cellpadding="0" cellspacing="0">
            <tr>
                <th>&nbsp;</th>
                <th><a href="index.php?user_list/contact_date">Fecha</a></th>
                <th><a href="index.php?user_list/contact_name">Nombre</a></th>
                <th><a href="index.php?user_list/contact_surname">Apellido</a></th>
                <th>Documento</th>
				<th>Tel&eacute;fono</th>
				<th>Celular</th>
				<th>Mensaje</th>
            </tr>
            <?php
            foreach($contacts as $contact)
            {	
                $edit_display  	= ($update !== false) ? '<a href="index.php?contact_expand.control/'.$contact->__get('contact_id').'" class="edit2" title="Editar"><span>Editar</span></a>' : ""; 	
                $delete_display	= ($delete !== false) ? '<a href="index.php?contact.controller/delete/'.$contact->__get('contact_id').'" class="itemdel2" onClick="return confirm(\'Esta seguro que desea borrar este comentario?\')" title="Borrar"><span>Eliminar</span></a>' : ""; 		
            	
            ?>
               <tr>
                    <td class="table03"><img src="imgcontrol/ico_tree2.gif" width="12" height="12" /></td>
                    <td class="table01 width50px"><? echo formatDate('%d/%m/%Y', $contact->__get('contact_date')); ?></td> 
                    <td><a href="index.php?contact_expand.control/<?=$contact->__get('contact_id')?>"><?=$contact->__get('contact_name')?></a></td>
                    <td><?=$contact->__get('contact_surname')?></td>
                    <td><?=$contact->__get('contact_document')?></td>
                    <td><?=$contact->__get('contact_phone')?></td>
                    <td><?=$contact->__get('contact_mobile')?></td>
                    <td><?=$contact->__get('contact_message')?></td>
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