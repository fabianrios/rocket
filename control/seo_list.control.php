<?php require_once('session_header.php'); 
$_GET[0] = isset($_GET[0]) ? escape($_GET[0]) : 'meta_tag_url';
$page 	  	 = isset($_GET[1]) ? $_GET[1] : 1;
$filter   	 = " ORDER by  " . $_GET[0] ;
$metaTags 	 = MetaTagHelper::selectMetaTags($filter);
$system_name = 'SEO';
//permissions
$update	  = PermissionHelper::checkPermission($system_name.'_update');
$pager 	  = new Pager($_GET[0], '', '', 'index.php?user_list', 20, $metaTags['num_rows'], $page); 
$limit 	  = ' LIMIT ' . $pager->arrayStartNumber . ',' . $pager->resultSize; 
$metaTags = MetaTagHelper::retrieveMetaTags($filter . $limit);
?>
<div id="contenido">
	<h2>SEO</h2>
	<div class="divider" style="background:none;">
	<div class="clear"></div>
    <div id="mainContent">
		<div id="alertBox">
 	       <?php 
		   $alert = (isset($alert)) ? $alert : array();
		   AlertHelper::placeAlerts($alert); 
		   ?>  
        </div>
        <h3>Listado de Usuarios</h3>
        <div class="ruta">
           <a href="index.php?home.control">Inicio</a> &gt; <a href="javascript:void(0);">Usuarios</a>
        </div>
        <table border="0" cellpadding="0" cellspacing="0">
            <tr>
                <th>&nbsp;</th>
                <th><a href="index.php?meta_tag_list/meta_tag_url">URL</a></th>
                <th><a href="index.php?meta_tag_list/meta_tag_title_email">T&iacute;tulo</a></th>
                <th>Contenido</th>								
                <th class="widthacciones">Acciones</th>
            </tr>
            <?php
            foreach($metaTags as $metaTag)
            {
                $edit_display  = ($update !== false) ? '<a href="index.php?seo_expand.control/'.$metaTag->__get('meta_tag_id').'" class="edit2" title="Editar"><span>Editar</span></a>' : ""; 	
				$content = ($metaTag->__get('content_id') != 0) ? new Content($metaTag->__get('content_id')) : new Content();
            	?>
               <tr>
                    <td class="table03"><img src="imgcontrol/ico_tree2.gif" width="12" height="12" /></td>
                    <td><a href="index.php?seo_expand.control/<?php echo $metaTag->__get('meta_tag_id')?>"><?php echo $metaTag->__get('meta_tag_url')?></a></td>
                    <td><?=$metaTag->__get('meta_tag_title')?></td>
                    <td><?=$content->__get('content_varchar_1')?></td>						
                    <td class="widthacciones"><?=$edit_display?></td>
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