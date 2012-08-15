<?php require_once('session_header.php');
$sites 		   = SiteHelper::retrieveSites("AND site_parent = 0");
$selected_site = new Site(escape($_GET[1])); 
$parentId 	   = $_GET[1];
$parent		   =& $selected_site;
$familyArray   = array();
$module		   = new Module($_GET[0]);
while($end == false)
{
	if($parentId != 0)
	{
		$familyArray[$parent->__get('site_level')] = $parent->__get('site_id');
		if($parent->__get('site_parent') != 0)
		{
			$parentSite = new Site($parent->__get('site_parent'));
			$parent =& $parentSite;
		}
		else
			$end = true;
	}
	else
		$end = true;
}
ksort($familyArray);
?>
<div id="contenido"> 
	<h2>Sitios</h2>
	<div class="divider">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="layout">
			<tr>
			<td width="170px">
            	<div id="sidebar1"> 
					<?=SiteHelper::dumpAllSites(&$sites, $_GET[0])?> 	
				</div>
        	</td>
			<td>
                <div id="mainContent">
                    <div id="alertBox">
                       <?php 
                       $alert = (isset($alert)) ? $alert : array();
                       AlertHelper::placeAlerts($alert); ?>  
                    </div>
                    <?php
					if($module->__get('module_levels') > $selected_site->__get('site_level'))
					{
					?>
                    <a href="index.php?site_list.control/<?=$_GET[0]?>/<?=$selected_site->__get('site_id')?>" class="cont_administrar2">ADMINISTRAR</a>
                    <?php
					}
					?>
                    <h3><?=$selected_site->__get('site_name')?></h3>
                    <div class="ruta">
                       <a href="index.php?home.control">Inicio</a> &gt; <a href="index.php?site_list.control/<?=$_GET[0]?>">Sitios</a>
                       <?php
                       foreach($familyArray as $siteId)
                       {
                        $site = new Site($siteId);
                       ?>
                        &gt; <a href="index.php?site_list.control/<?=$_GET[0]?>/<?=$site->__get('site_id')?>"><?=$site->__get('site_name')?></a>
                       <?php
                       }
                       ?>
                    </div>
                    <a href="#" class="sobrepanel2">INFORMACI&Oacute;N B&Aacute;SICA</a>
                    <div class="panel02">
                        <div class="p_infobasica">
                            <p><span>Nombre:</span><?=$site->__get('site_name');?></p>
                        </div>
                    </div>
                    <?php PermissionHelper::displayDocks(4, $selected_site); ?>
                </div>
	    	</td>
            </tr>
        </table>
	<div class="clear"></div>
	</div>
</div>
<?php require_once('footer.php'); ?>