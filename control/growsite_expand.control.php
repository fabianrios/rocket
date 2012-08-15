<?php 
require_once('session_header.php');
$sites 		= GrowsiteHelper::retrieveGrowsites("");
$selected_site= new Growsite(escape($_GET[0])); 
echo '<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>'
?>
<div id="contenido"> 
	
	<h2>Sitios</h2>
	<div class="divider">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="layout">
			<tr>
			<td width="170px">
            	<div id="sidebar1"> 
                	<ul>
                    	<li>
					<?php
                    foreach ($sites as $site)
					{
					?>
                        <a href="index.php?growsite_expand.control/<?php echo $site->__get('site_id')?>" class="sidebar_01">
                            <img src="imgcontrol/ico_tree.gif" />
                            <span><?php echo $site->__get('site_name')?></span>
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
                    <h3><?=$selected_site->__get('site_name')?></h3>
                    <div class="ruta">
                       <a href="index.php?home.control">Inicio</a> &gt; <a href="index.php?growsite_list.control">Sitios</a> &gt; <a href="index.php?gowsite_expand.control/<?=$_GET[0]?>"><?php echo $selected_site->__get('site_name');?></a>
                    </div>
                    <a href="#" class="sobrepanel2">INFORMACI&Oacute;N B&Aacute;SICA</a>
                    <div class="panel02">
                        <div class="p_infobasica">
                            <p><span>Nombre:</span><?=$site->__get('site_name');?></p>
                        </div>
                    </div>
                    <?php PermissionHelper::displayDocks(45, $selected_site); ?>
                </div>
	    	</td>
            </tr>
        </table>
	<div class="clear"></div>
	</div>
</div>
<?php require_once('footer.php'); ?>