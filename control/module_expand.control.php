<?php require_once('session_header.php');
$modules 	     = ModuleHelper::retrieveModules("AND module_parent = 0 ORDER BY module_order");
$selected_module = new Module(escape($_GET[0]));
$breadCrums		 = ModuleHelper::dumpBreadCrums(escape($_GET[0]));
?>
<div id="contenido"> 
	<h2>Modulos</h2>
	<div class="divider">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="layout">
			<tr>
			<td width="170px">
            	<div id="sidebar1"> 
					<?php echo ModuleHelper::dumpAllModules($modules)?> 	
				</div>
        	</td>
			<td>
                <div id="mainContent">
                    <div id="alertBox">
                       <?php 
                       $alert = (isset($alert)) ? $alert : array();
                       AlertHelper::placeAlerts($alert); ?>  
                    </div>
                    <a href="index.php?module_list.control/<?php echo $_GET[0]?>/<?php echo $selected_module->__get('site_id')?>" class="cont_administrar2">ADMINISTRAR</a>
                    <h3><?php echo $selected_module->__get('module_name')?></h3>
                    <div class="ruta">
                     	<? echo $breadCrums?>
                    </div>
                    <a href="#" class="sobrepanel">INFORMACI&Oacute;N B&Aacute;SICA</a>
                    <div class="panel02">
                        <div class="p_infobasica">
                            <p><span>Nombre:</span><?php echo $selected_module->__get('module_name');?></p>
                        </div>
                    </div>
                    <?php PermissionHelper::displayDocks(4, $selected_module); ?>
                </div>
	    	</td>
            </tr>
        </table>
	<div class="clear"></div>
	</div>
</div>
<?php require_once('footer.php'); ?>