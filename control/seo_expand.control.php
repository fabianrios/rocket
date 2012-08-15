<?php require_once('session_header.php');
$metaTags = MetaTagHelper::retrievemetaTags();
$selected_metaTag = new metaTag(escape($_GET[0])); 
$content = ($selected_metaTag->__get('content_id') != 0) ? new Content($selected_metaTag->__get('content_id')) : new Content();
?>
<div id="contenido"> 
	<h2>SEO</h2>
	<div class="divider">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="layout">
			<tr>
			<td width="170px">
            	<div id="sidebar1"> 
					<ul>
						<li>
							<?php
                            foreach ($metaTags as $metaTag)
                            {
                            ?>
                                <a href="index.php?seo_expand.control/<?=$metaTag->__get('meta_tag_id')?>" class="sidebar_01">
                                    <img src="imgcontrol/ico_tree.gif" />
                                    <span><?=$metaTag->__get('meta_tag_title')?></span>
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
                    <h3><?=$selected_metaTag->__get('meta_tag_url')?></h3>
                    <div class="ruta">
                           <a href="index.php?home.control">Inicio</a> &gt; <a href="index.php?seo_list.control">SEO</a> &gt; <a href="javascript:void(0);"><?=$selected_metaTag->__get('meta_tag_url')?></a> 
                    </div>
                    <a href="#" class="sobrepanel2">INFORMACI&Oacute;N B&Aacute;SICA</a>
                    <div class="panel02">
                        <div class="p_infobasica">
                            <p><span>URL: </span><?php echo $selected_metaTag->__get('meta_tag_url')?></p>
                            <p><span>T&iacute;tulo: </span><?php echo $selected_metaTag->__get('meta_tag_title')?> </p>
                            <p><span>Descripci&oacute;n: </span><?php echo $selected_metaTag->__get('meta_tag_description')?></p>
                            <p><span>Palabras clave: </span><?php echo $selected_metaTag->__get('meta_tag_keywords')?></p>
                            <p><span>Frases clave: </span><?php echo $selected_metaTag->__get('meta_tag_keyphrases')?></p>	
                            <p><span>Contentido: </span><?php echo $content->__get('content_varchar_1')?></p>														
                        </div>
                    </div>
                    <?php PermissionHelper::displayDocks(13, $selected_metaTag); ?>
                </div>
	    	</td>
            </tr>
        </table>
	<div class="clear"></div>
	</div>
</div>