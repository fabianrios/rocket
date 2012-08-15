<?php 
require_once('session_header.php');
$parent				= new Specie($_GET[0]);
$selected_resource	= new SpecieResource(escape($_GET[1])); 
$resources 			= SpecieResourceHelper::retrieveSpecieResources(" AND specie_id = " . $_GET[0] . " AND specie_resource_type = '".$selected_resource->__get('specie_resource_type')."'");
?>
<div id="contenido"> 
	<h2>Recursos de especies</h2>
	<div class="divider">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="layout">
			<tr>
			<td width="170px">
            	<div id="sidebar1"> 
                	<ul>
                    	<li>
					<?php
                    foreach ($resources as $resource)
					{
					?>
                        <a href="index.php?specie_resource_expand.control/<?php echo $resource->__get('specie_id')?>/<?php echo $resource->__get('specie_resource_id')?>" class="sidebar_01">
                            <img src="imgcontrol/ico_tree.gif" />
                            <span><?php echo $resource->__get('specie_resource_name')?></span>
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
                    <h3><?=$selected_resource->__get('specie_resource_name')?></h3>
                    <div class="ruta">
                       <a href="index.php?home.control">Inicio</a> &gt; <a href="index.php?especies_list.control">Librer&iacute;a de especies</a> &gt; <a href="index.php?specie_expand.control/<?=$_GET[0]?>"><?php echo $parent->__get('specie_name');?></a> &gt; <a href="index.php?specie_resource_expand.control/<?=$_GET[0]?>/<?=$_GET[1]?>"><?php echo $selected_resource->__get('specie_resource_name');?></a>
                    </div>
                    <a href="#" class="sobrepanel2">INFORMACI&Oacute;N B&Aacute;SICA</a>
                    <div class="panel02">
                        <div class="p_infobasica">
                            <p><span>Nombre:</span><?=$selected_resource->__get('specie_resource_name')?></p>
                        </div>
                    </div>
                    <a href="#" class="sobrepanel">Modificar</a>
                    <div class="panel02">
                        <form action="index.php?control_specie.controller/updateResource" method="post" id="validable" enctype="multipart/form-data">
                            <input type="hidden" name="specie_id" value="<?php echo $parent->__get('specie_id')?>" />
                            <input type="hidden" name="specie_resource_id" value="<?php echo $selected_resource->__get('specie_resource_id')?>" />
                            <label> 
                                <span>Nombre</span>
                                <input type="text" name="specie_resource_name" id="specie_resource_name" value="<?php echo $selected_resource->__get('specie_resource_name')?>" />
                            </label>
                            <?php
							if ($selected_resource->__get('specie_resource_type') == 'I')
							{
							?>
                                <label> 
                                    <span>Imagen</span>
                                    <?php if ($selected_resource->__get('specie_resource_file') != '') echo '<img src="'.APPLICATION_URL.'resources/images/50x50/'.$selected_resource->__get('specie_resource_file').'" />'; ?>                                
                                    <input type="file" name="specie_resource" class="notValidable"/>
                                </label> 
                            <?php
							}
							else
							{
							?>
                                <label> 
                                    <span>Vínculo</span>
                                    <input type="text" name="specie_resource_link" id="specie_resource_link" value="<?php echo $selected_resource->__get('specie_resource_link')?>" />
                                </label>   
                            <?php
							}
							?>
                            <div class="botones">
                                <input name="" type="image" src="imgcontrol/bot_guardar.gif" alt="Guardar" width="170" height="42" />
                                <input name="" type="image" src="imgcontrol/bot_cancelar.gif" alt="Cancelar" width="127" height="28" />
                            </div>
                        </form>                    	
                    </div>
                </div>
	    	</td>
            </tr>
        </table>
	<div class="clear"></div>
	</div>
</div>
<?php require_once('footer.php'); ?>