<?php 
require_once('session_header.php');
$city_parent 	= (isset($_GET[0])) ? $_GET[0] : 0;
$filter			= " ORDER by city_name";
$cities 		= CityHelper::retrieveCities($filter); //MODULOS
$system_name 	= 'ciudades'; // Nombre del sistema (para efectos de permisos)
//PERMISOS
//CREAR
$order 			= PermissionHelper::checkPermission($system_name.'_order');  //ORDENAR
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
        <h3>Listado de Modulos</h3>
        <div class="ruta">
        </div>
        <table border="0" cellpadding="0" cellspacing="0">
            <tr>
                <th>&nbsp;</th>
                <th>Nombre</th>
                <th class="width80px">Estado</th>                
                <th class="widthacciones">Acciones</th>
            </tr>
            <?php
            foreach($cities as $city)
            {
                $state 			= ($city->__get('city_activated') ==  1) ? 'Activo' : 'Inactivo'; //ESTADOS
                $state_action 	= "SimpleAJAXCall('index.php?control_city.controller/changeState/".$city->__get('city_id')."', updateAlert, 'GET', 'u_state_".$city->__get('city_id')."');"; //CONTROLADOR AJAX
				$state_display 	= ($order !== false) ? '<a href="javascript:void(0)" onClick="'.$state_action.'">'.$state.'</a>' : $state;
                $name_href 		= 'index.php?city_list.control/' . $city->__get('city_id'); //EXPAND
				//PROPIEDADES MODULOS
            ?>
               <tr>
                    <td class="table03"><img src="imgcontrol/ico_tree2.gif" width="12" height="12" /></td>
                    <td><a href="<?=$name_href?>"><?=$city->__get('city_name')?></a></td>
                    <td class="table01 width80px"><div id="u_state_<?=$city->__get('city_id')?>"><?=$state_display ?></div></td>
                    <td class="widthacciones"></td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
	</div>
</div>