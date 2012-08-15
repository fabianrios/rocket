<div class="panel02">
	<form action="index.php?control_specie.controller/update" method="post" id="validable" enctype="multipart/form-data">
		<input type="hidden" name="specie_id" value="<?php echo $object->__get('specie_id')?>" />
        <label> 
            <span>Nombre Com&uacute;n</span>
            <input type="text" name="specie_name" id="specie_name" value="<?php echo $object->__get('specie_name')?>" />
        </label>
        <label> 
            <span>Nombre Cient&iacute;fico</span>
            <input type="text" name="specie_scientific_name" id="specie_scientific_name" value="<?php echo $object->__get('specie_scientific_name')?>" />
        </label>
        <label> 
            <span>Resumen</span>
			<?php
            $oFCKeditor             = new FCKeditor('specie_abstract') ;
            $oFCKeditor->BasePath   = MONTANA_FCK_BASE ;
            $oFCKeditor->Value      = $object->__get('specie_abstract');
            $oFCKeditor->Width      = 700 ;	
            $oFCKeditor->Height     = 300 ;					
            $oFCKeditor->Create();
            ?>
        </label>
        <label> 
            <span>Resumen</span>
			<?php
            $oFCKeditor             = new FCKeditor('specie_description') ;
            $oFCKeditor->BasePath   = MONTANA_FCK_BASE ;
            $oFCKeditor->Value      = $object->__get('specie_description');
            $oFCKeditor->Width      = 700 ;	
            $oFCKeditor->Height     = 300 ;					
            $oFCKeditor->Create();
            ?>
        </label>             
        <label> 
            <span>Imagen</span>
            <?php if ($object->__get('specie_image') != '') echo '<img src="'.APPLICATION_URL.'resources/images/50x50/'.$object->__get('specie_image').'" />'; ?>                                
            <input type="file" name="specie_avatar" class="notValidable"/>
        </label> 
        <label> 
            <span>Absorci&oacute;n de CO2</span>
            <input type="text" name="specie_carbon_offset" id="specie_carbon_offset" value="<?php echo $object->__get('specie_carbon_offset')?>" />
        </label>                                  
        <div class="botones">
            <input name="" type="image" src="imgcontrol/bot_guardar.gif" alt="Guardar" width="170" height="42" />
            <input name="" type="image" src="imgcontrol/bot_cancelar.gif" alt="Cancelar" width="127" height="28" />
        </div>
	</form>
</div>
<?php
$system_name = 'especies_';
//permissions
$create = 	(PermissionHelper::checkPermission($system_name.'_create') !== false) ? "<a href=\"index.php?control_specie.controller/create\" class=\"cont_administrar2\">Crear Especie</a>" : '';
$update = PermissionHelper::checkPermission($system_name.'_update');
$order 	= PermissionHelper::checkPermission($system_name.'_order');
$delete = PermissionHelper::checkPermission($system_name.'_delete');
?>
<a href="#" class="sobrepanel">Imagenes</a>
<?php
	$resources	= SpecieResourceHelper::retrieveSpecieResources(" AND specie_id = ".$object->__get('specie_id'). " AND specie_resource_type = 'I' ORDER by specie_resource_name"); 
?>
<div class="panel02">
	<div class="divider" style="background:none;">
	<div class="clear"></div>
    <div id="mainContent">
		<?php 
            echo "<a href=\"index.php?control_specie.controller/createResource/".$object->__get('specie_id')."/I\" class=\"cont_administrar2\">A&ntilde;adir recurso</a>";

        ?>
        <h3>Listado de Imagenes</h3>
        <table border="0" cellpadding="0" cellspacing="0">
            <tr>
                <th class="table03">&nbsp;</th>
                <th><a href="index.php?specie_list.control/specie_name">Nombre</a></th>
                <th class="width80px"><a href="index.php?specie_list.control/specie_state">Estado</a></th>
                <th class="widthacciones">Acciones</th>
            </tr>
            <?php
            foreach($resources as $resource)
            {
                $state 			= ($resource->__get('specie_resource_state') ==  'A') ? 'Activo' : 'Inactivo';
                $state_action 	= "SimpleAJAXCall('index.php?control_specie.controller/changeStateResource/".$resource->__get('specie_id')."/".$resource->__get('specie_resource_id')."', updateAlert, 'GET', 'u_state_".$resource->__get('specie_resource_id')."');";
				$state_display 	= ($order !== false) ? '<a href="javascript:void(0)" onClick="'.$state_action.'">'.$state.'</a>' : $state;
                $edit_display  	= ($update !== false) ? '<a href="index.php?specie_resource_expand.control/'.$resource->__get('specie_id')."/".$resource->__get('specie_resource_id').'" class="edit2" title="Editar"><span>Editar</span></a>' : ""; 	
                $delete_display	= ($delete !== false) ? '<a href="index.php?control_specie.controller/deleteResource/'.$resource->__get('specie_id')."/".$resource->__get('specie_resource_id').'" class="itemdel2" onClick="return confirm(\'Esta seguro que desea borrar este recurso?\')" title="Borrar"><span>Eliminar</span></a>' : ""; 
				$edit_link	   	= ($update !== false) 	? '<a href="index.php?specie_resource_expand.control/'.$resource->__get('specie_id')."/".$resource->__get('specie_resource_id').'">'.$resource->__get('specie_resource_name').'</a>' : $resource->__get('specie_resource_name');
            
            ?>
               <tr>
                    <td class="table03"><img src="imgcontrol/ico_tree2.gif" width="12" height="12" /></td>
                    <td><?php echo $edit_link?></a></td>
                    <td class="table01 width80px"><div id="u_state_<?php echo $resource->__get('specie_resource_id')?>"><?php echo $state_display ?></div></td>
                    <td class="widthacciones"><?php echo $delete_display?><?php echo $edit_display?></td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
	</div>
</div>
<a href="#" class="sobrepanel">V&iacute;nculos</a>
<div class="panel02">
<?php
	$resources	= SpecieResourceHelper::retrieveSpecieResources(" AND specie_id = ".$object->__get('specie_id'). " AND specie_resource_type = 'L' ORDER by specie_resource_name"); 
?>
	<div class="divider" style="background:none;">
	<div class="clear"></div>
    <div id="mainContent">
		<?php 
            echo "<a href=\"index.php?control_specie.controller/createResource/".$object->__get('specie_id')."/L\" class=\"cont_administrar2\">A&ntilde;adir recurso</a>";

        ?>
        <h3>Listado de Vinculos</h3>
        <table border="0" cellpadding="0" cellspacing="0">
            <tr>
                <th class="table03">&nbsp;</th>
                <th><a href="index.php?specie_list.control/specie_name">Nombre</a></th>
                <th class="width80px"><a href="index.php?specie_list.control/specie_state">Estado</a></th>
                <th class="widthacciones">Acciones</th>
            </tr>
            <?php
            foreach($resources as $resource)
            {
                $state 			= ($resource->__get('specie_resource_state') ==  'A') ? 'Activo' : 'Inactivo';
                $state_action 	= "SimpleAJAXCall('index.php?control_specie.controller/changeStateResource/".$resource->__get('specie_id')."/".$resource->__get('specie_resource_id')."', updateAlert, 'GET', 'u_state_".$resource->__get('specie_resource_id')."');";
				$state_display 	= ($order !== false) ? '<a href="javascript:void(0)" onClick="'.$state_action.'">'.$state.'</a>' : $state;
                $edit_display  	= ($update !== false) ? '<a href="index.php?specie_resource_expand.control/'.$resource->__get('specie_id')."/".$resource->__get('specie_resource_id').'" class="edit2" title="Editar"><span>Editar</span></a>' : ""; 	
                $delete_display	= ($delete !== false) ? '<a href="index.php?control_specie.controller/deleteResource/'.$resource->__get('specie_id')."/".$resource->__get('specie_resource_id').'" class="itemdel2" onClick="return confirm(\'Esta seguro que desea borrar este recurso?\')" title="Borrar"><span>Eliminar</span></a>' : ""; 
				$edit_link	   	= ($update !== false) 	? '<a href="index.php?specie_resource_expand.control/'.$resource->__get('specie_id')."/".$resource->__get('specie_resource_id').'">'.$resource->__get('specie_resource_name').'</a>' : $resource->__get('specie_resource_name');
            
            ?>
               <tr>
                    <td class="table03"><img src="imgcontrol/ico_tree2.gif" width="12" height="12" /></td>
                    <td><?php echo $edit_link?></a></td>
                    <td class="table01 width80px"><div id="u_state_<?php echo $resource->__get('specie_resource_id')?>"><?php echo $state_display ?></div></td>
                    <td class="widthacciones"><?php echo $delete_display?><?php echo $edit_display?></td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
	</div>
</div>
