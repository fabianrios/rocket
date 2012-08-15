<?php require_once('session_header.php'); 
$parentId	   = (isset($_GET[1]) && ($_GET[1] != '')) ? $_GET[1] : 0;
$parent		   = ($parentId != 0) ? new Site($parentId) : new Site();
$level		   = (isset($_GET[1]) && ($_GET[1] != '')) ? ($parent->__get('site_level') + 1) : 1;
$page    	   = isset($_GET[2]) ? $_GET[2] : 1;
$filter  	   = "AND site_parent = " . $parentId . " ORDER by  site_name";
$sites   	   = SiteHelper::selectSites($filter);
$system_name   = 'site';
$module		   = new Module($_GET[0]);
$inRange	   = ($module->__get('module_levels') >= $level) ? true : false;
//permissions
$create = 	((PermissionHelper::checkPermission($system_name.'_create', $level) !== false) && ($inRange)) ? "<a href=\"index.php?control_site.controller/create/" . $parentId . "/" . $_GET[0] . "\" class=\"cont_administrar2\">CREAR SITIO</a>" : '';
$update  	  = PermissionHelper::checkPermission($system_name.'_update', $level);
$updateParent = PermissionHelper::checkPermission($system_name.'_update', ($level - 1));
$order 		  = PermissionHelper::checkPermission($system_name.'_order', $level);
$delete 	  = PermissionHelper::checkPermission($system_name.'_delete', $level);
$pager  	  = new Pager((isset($_GET[1]) ? $_GET[1] : ''), '', '', 'index.php?site_list', 20, $sites['num_rows'], $page); 
$limit  	  = ' LIMIT ' . $pager->arrayStartNumber . ',' . $pager->resultSize; 
$sites  	  = SiteHelper::retrieveSites($filter . $limit);
$familyArray  = array();
$end = false;
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
		if(($level > 1) && $updateParent)
		{
		?>
        <a href="index.php?site_expand.control/<?=$_GET[0]?>/<?=$parentId?>" class="cont_administrar2">EDITAR</a>
        <?php
		}
		if(($level > 1) && $inRange)
			echo $create;
        ?>
        <h3>Listado de Sitios</h3>
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
        <table border="0" cellpadding="0" cellspacing="0">
            <tr>
                <th>&nbsp;</th>
                <th>Nombre</th>
                <th class="width80px">Estado</th>
                <th class="widthacciones">Acciones</th>
            </tr>
            <?php
            foreach($sites as $site)
            {
                $state = ($site->__get('site_state') ==  'A') ? 'Activo' : 'Inactivo';
                $state_action = "SimpleAJAXCall('index.php?control_site.controller/changeState/".$site->__get('site_id')."', updateAlert, 'GET', 'u_state_".$site->__get('site_id')."');";
				$state_display = ($order !== false) ? '<a href="javascript:void(0)" onClick="'.$state_action.'">'.$state.'</a>' : $state;
                $edit_display  = ($update !== false) ? '<a href="index.php?site_expand.control/'.$_GET[0].'/'.$site->__get('site_id').'" class="edit2" title="Editar"><span>Editar</span></a>' : ""; 	
                $delete_display= ($delete !== false) ? '<a href="index.php?control_site.controller/delete/'.$site->__get('site_id').'/'.$_GET[0].'" class="itemdel2" onClick="return confirm(\'Esta seguro que desea borrar este sitio?\')" title="Borrar"><span>Eliminar</span></a>' : ""; 		
            
				$name_href = 'index.php?site_list.control/' . $_GET[0] . '/' . $site->__get('site_id');
				$inRange = ($module->__get('module_levels') >= ($site->__get('site_level') + 1)) ? true : false;
				if(!$inRange)
					$name_href = 'index.php?site_expand.control/'.$_GET[0].'/'.$site->__get('site_id');
            ?>
               <tr>
                    <td class="table03"><img src="imgcontrol/ico_tree2.gif" width="12" height="12" /></td>
                    <td><a href="<?=$name_href?>"><?=$site->__get('site_name')?></a></td>
                    <td class="table01 width80px"><div id="u_state_<?=$site->__get('site_id')?>"><?=$state_display ?></div></td>
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