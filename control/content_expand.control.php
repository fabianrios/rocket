<?php require_once('session_header.php');
$content_type = $_GET[0];
//Modulo
$module = new Module(escape($content_type));
//Lista Contenido
$filter 			 = " AND content_parent = 0 AND module_id = " . escape ($content_type) . " ORDER BY content_order";
$contents 			 = ContentHelper::retrieveContents($filter);
$selected_content    = new Content(escape($_GET[1]));
$childrenResult	 	 = ContentHelper::selectContents("AND content_parent = " . escape($_GET[1]));
$administrate_button = ($module->__get('module_levels') > $selected_content->__get('content_level')) ? "<a href=\"index.php?content_list.control/".$content_type."/".$_GET[1]."\" class=\"cont_administrar2\">Administrar</a>" : '';
$specific = (($selected_content->__get('language_parent') != 0) && ($selected_content->__get('language_parent') != ''))  ? array($module->__get('module_system_name') . '_update', $module->__get('module_system_name') . '_translate') : false;
?>
<div id="contenido"> 
	<h2><?php echo $module->__get('module_name')?></h2>
	<div class="divider">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="layout">
			<tr>
			<td width="170px">
            	<div id="sidebar1"> 
                	<?php  
						ContentHelper::dumpAllContents($contents, $content_type);
					?>
				</div>
        	</td>
			<td>
                <div id="mainContent">
                    <div id="alertBox">
                       <?php 
                       $alert = (isset($alert)) ? $alert : array();
                       AlertHelper::placeAlerts($alert); ?>  
                    </div>
                    <?=$administrate_button?>
                    <h3><?=str_replace("\\", "" ,$selected_content->__get('content_varchar_1'))?></h3>
                    <div class="ruta">
                          <?php ContentHelper::dumpBreadCrum($module, $_GET[1]); ?>
                    </div>
                    <a href="#" class="sobrepanel">INFORMACI&Oacute;N B&Aacute;SICA</a>
                    <div class="panel02">
                        <?php
                            $user_id = new User($selected_content->__get('user_id'));
                        ?>
                        <div class="p_infobasica">
                            <p><span>Creado por </span><?=$user_id->__get('user_full_name');?></p>
                            <p><span>Fecha de Creaci&oacute;n:</span><?php echo formatDate('%d/%m/%Y', $selected_content->__get('content_datetime_creation')); ?> </p>
                            <p><span>&Uacute;ltima Modificaci&oacute;n:</span><?php echo formatDate('%d/%m/%Y', $selected_content->__get('content_datetime_update')); ?></p>
                        </div>
                    </div>
                    <?php PermissionHelper::displayDocks(escape($_GET[0]), $selected_content, $specific); ?>
                </div>
	    	</td>
            </tr>
        </table>
	<div class="clear"></div>
	</div>
</div>
<?php require_once('footer.php');
?>