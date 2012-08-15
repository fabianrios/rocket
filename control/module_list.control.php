<?php 
require_once('session_header.php');
$module_parent = (isset($_GET[0])) ? $_GET[0] : 0;
$filter 		= "AND module_parent = " . escape($module_parent); 
$filter			.= " ORDER by module_order";
$modules 		= ModuleHelper::retrieveModules($filter); //MODULOS
$system_name 	= 'config_module'; // Nombre del sistema (para efectos de permisos)
//PERMISOS
$create 		= 	(PermissionHelper::checkPermission($system_name.'_create') !== false) ? "<a href=\"index.php?control_module.controller/create/" . $module_parent . "\" class=\"cont_administrar2\">Crear Modulo</a>" : ''; //CREAR
$update 		= PermissionHelper::checkPermission($system_name.'_update'); //ACTUALIZAR
$editButton		= (($update !== false) && ($module_parent != 0)) ? '<a href="index.php?module_expand.control/'.$module_parent.'" class="cont_administrar2">EDITAR</a>' : '';
$order 			= PermissionHelper::checkPermission($system_name.'_order');  //ORDENAR
$delete 		= PermissionHelper::checkPermission($system_name.'_delete'); //BORRAR
$breadCrums		= ModuleHelper::dumpBreadCrums($module_parent);
?>
<div id="contenido">
	<h2>Modulos</h2>
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
			   echo $editButton;
        ?>
        <h3>Listado de Modulos</h3>
        <div class="ruta">
        	<? echo $breadCrums?>
        </div>
        <table border="0" cellpadding="0" cellspacing="0">
            <tr>
                <th>&nbsp;</th>
                <th>Nombre</th>
                <th class="width80px">Contenido</th>
                <th class="width80px">Estado</th>                
                <th class="widthacciones">Acciones</th>
            </tr>
            <?php
            foreach($modules as $module)
            {
                $state 			= ($module->__get('module_state') ==  'A') ? 'Activo' : 'Inactivo'; //ESTADOS
                $state_action 	= "SimpleAJAXCall('index.php?control_module.controller/changeState/".$module->__get('module_id')."', updateAlert, 'GET', 'u_state_".$module->__get('module_id')."');"; //CONTROLADOR AJAX
				$state_display 	= ($order !== false) ? '<a href="javascript:void(0)" onClick="'.$state_action.'">'.$state.'</a>' : $state;
                $edit_display  	= ($update !== false) ? '<a href="index.php?module_expand.control/'.$module->__get('module_id').'" class="edit2" title="Editar"><span>Editar</span></a>' : ""; 	//BOTON EDITAR
                $delete_display	= ($delete !== false) ? '<a href="index.php?control_module.controller/delete/'.$module->__get('module_id').'" class="itemdel2" onClick="return confirm(\'Esta seguro que desea borrar este sitio?\')" title="Borrar"><span>Eliminar</span></a>' : ""; //BOTON BORRAR
         		$name_href 		= 'index.php?module_list.control/' . $module->__get('module_id'); //EXPAND
				//PROPIEDADES MODULOS
				$contentType = ($module->__get('module_content') == 1) ? 'Si' : 'No';
            ?>
               <tr>
                    <td class="table03"><img src="imgcontrol/ico_tree2.gif" width="12" height="12" /></td>
                    <td><a href="<?php echo $name_href?>"><?php echo $module->__get('module_name')?></a></td>
                    <td><?php echo $contentType?></td>
                    <td class="table01 width80px"><div id="u_state_<?php echo $module->__get('module_id')?>"><?php echo $state_display ?></div></td>
                    <td class="widthacciones"><?php echo $delete_display?><?php echo $edit_display?></td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
	</div>
</div>
<?php 
require_once('footer.php');
?>