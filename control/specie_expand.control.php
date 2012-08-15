<?php 
require_once('session_header.php');
$species 		= SpecieHelper::retrieveSpecies("");
$selected_specie= new Specie(escape($_GET[0])); 
?>
<div id="contenido"> 
	<h2>Especies</h2>
	<div class="divider">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="layout">
			<tr>
			<td width="170px">
            	<div id="sidebar1"> 
                	<ul>
                    	<li>
					<?php
                    foreach ($species as $specie)
					{
					?>
                        <a href="index.php?specie_expand.control/<?php echo $specie->__get('specie_id')?>" class="sidebar_01">
                            <img src="imgcontrol/ico_tree.gif" />
                            <span><?php echo $specie->__get('specie_name')?></span>
                        </a>                    
                    <?php	
					}
					?> 	
                    	</li>
                    </ul>
				</div>
        	</td>
			<td>
                <div id="mainContent">
                    <div id="alertBox">
                       <?php 
                       $alert = (isset($alert)) ? $alert : array();
                       AlertHelper::placeAlerts($alert); ?>  
                    </div>
                    <h3><?=$selected_specie->__get('specie_name')?></h3>
                    <div class="ruta">
                       <a href="index.php?home.control">Inicio</a> &gt; <a href="index.php?especies_list.control">Librer&iacute;a de especies</a> &gt; <a href="index.php?specie_expand.control/<?=$_GET[0]?>"><?php echo $selected_specie->__get('specie_name');?></a>
                    </div>
                    <a href="#" class="sobrepanel2">INFORMACI&Oacute;N B&Aacute;SICA</a>
                    <div class="panel02">
                        <div class="p_infobasica">
                            <p><span>Nombre:</span><?=$specie->__get('specie_name');?></p>
                        </div>
                    </div>
                    <?php PermissionHelper::displayDocks(39, $selected_specie); ?>
                </div>
	    	</td>
            </tr>
        </table>
	<div class="clear"></div>
	</div>
</div>
<?php require_once('footer.php'); ?>