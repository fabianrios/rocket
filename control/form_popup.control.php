<?php
$form = isset($_GET[0]) ? $_GET[0] : $_POST['form'];
header('Content-Type: text/html; charset=ISO-8859-1'); 
switch($form):
	case 'fck':
		$content   = new Content($_GET[1]);
		$fieldName = $_GET[2];
		$fieldType = $_GET[3];
	?>
        <h3>EDITAR CAMPO</h3>
		<form enctype="multipart/form-data" name="contentForm" id="contentForm">
		  <div class="panel_layer">
			<?php
		$oFCKeditor             = new FCKeditor($fieldName) ;
		$oFCKeditor->BasePath   = MONTANA_FCK_BASE ;
		$oFCKeditor->Value      = $content->__get($fieldName) ;
		$oFCKeditor->ToolbarSet = $fieldType ;
		$oFCKeditor->Width      = 700 ;	
		$oFCKeditor->Height     = 300 ;					
		$oFCKeditor->Create();
		
						?>
		  </div>
		  <input type="hidden" name="fieldName" value="<?=$fieldName?>" />
		  <input type="hidden" name="content_id" value="<?=$_GET[1]?>" />
		  <input type="hidden" name="action" value="editField" />
		  <div class="botones2"> <a href="javascript:void(0);" onClick="FormParseAJAXCall('index.php?control_content.controller', doNothing, 'POST', '', contentForm, true); closeFormLayer('window2');"><img src="imgcontrol/bot_l_guardar.gif" border="0" /></a> <a href="javascript:void(0);" onClick="closeFormLayer('window2');"><img src="imgcontrol/bot_l_cancelar.gif" border="0" /></a> </div>
		</form>	
	<?php
    break;
	case 'addResource':
		$contentId 		  		= $_GET[1];
		$single	  		  		= ($_GET[2] == 1) ? true : false;
		$typeId	   		  		= ($_GET[3] != '') ? $_GET[3] : NULL;
		$fieldName 		  		= $_GET[4];
		$tags 	   		  		= ResourceHelper::retrieveTags($typeId);
		$extra					= ($typeId != NULL) ? " AND resource_type_id = " . escape($typeId) : '';		
		$contentResourcesResult = ContentResourceHelper::selectContentResources("AND content_id = " . $contentId . " 
																	  		 AND content_resource_field_name = '" . $fieldName . "'");
		?>
		  <h3>ASOCIAR ARCHIVOS</h3>
		  <div class="medio_selector_search">
			<form>
				<input name="" type="text" />
		<input name="" type="submit" value="Buscar" />    
		</form>
		  </div>
		  <form>
			<div class="medio_selector" id="layerResourceList">
			  <ul>
              <?php
			  foreach($tags as $tag)
			  {
			  	$resourceResult = ResourceHelper::selectResources($extra . " AND resource_tags LIKE '%" . $tag . "%'");
			  ?>
				<li><a href="javascript:void(0);" onclick="SimpleAJAXCall('index.php?form_popup.control/listResources/<?=urlencode($tag)?>/<?=$_GET[1]?>/<?=$_GET[2]?>/<?=$_GET[3]?>/<?=$_GET[4]?>', ElementStateChanged, 'GET', 'window2');"><img src="imgcontrol/iconos_sistema/dir.gif" /><span><strong><?=$tag?></strong> (<?=$resourceResult["num_rows"]?> archivos)</span></a></li>
              <?php
			  }
			  ?>
			  </ul>
			</div>
			<a href="javascript:void(0);" onclick="SimpleAJAXCall('index.php?form_popup.control/uploadResource/<?=$_GET[1]?>/<?=$_GET[2]?>/<?=$_GET[3]?>/<?=$_GET[4]?>', loadFormLayer, 'GET', 'window2');" class="agregar_a_medio">[ + CARGAR ARCHIVO ]</a>
			<p><?=$contentResourcesResult["num_rows"]?> archivo(s) agregados</p>
		  </form>	
		<?php
    break;
	case 'listResources':
		$tag 	   	= urldecode($_GET[1]);
		$contentId 	= $_GET[2];
		$single	  	= ($_GET[3] != '') ? $_GET[3] : NULL;
		$typeId	   	= ($_GET[4] == 1) ? true : false;
		$fieldName 	= $_GET[5];
		$extra		= ($typeId != NULL) ? " AND resource_type_id = " . escape($typeId) : '';
		$contentResourcesResult = ContentResourceHelper::selectContentResources("AND content_id = " . escape($contentId) . " 
																	  			 AND content_resource_field_name = '" . escape($fieldName) . "'");
		$resources = ResourceHelper::retrieveResources("AND resource_tags LIKE '%" . escape($tag) . "%'" . $extra . " ORDER BY resource_name");
		?>
      <h3>ASOCIAR ARCHIVOS</h3>
      <div class="medio_selector_search">
        <form>
            <input name="" type="text" />
    <input name="" type="submit" value="Buscar" />    
    </form>
      </div> 
        <p><strong>Tag:</strong> <?=$tag?></p>
        <a href="javascript:void(0);" onclick="SimpleAJAXCall('index.php?form_popup.control/addResource/<?=$_GET[2]?>/<?=$_GET[3]?>/<?=$_GET[4]?>/<?=$_GET[5]?>', ElementStateChanged, 'GET', 'window2');" class="agregar_a_medio">[ &lt; ATR&Aacute;S ]</a>
      <form>
        <div class="medio_selector">
          <ul>
          <?php
		  foreach($resources as $resource)
		  {
		  	$contentResourceResult = ContentResourceHelper::selectContentResources("AND content_id = " . escape($contentId) . " 
																	  			 	AND content_resource_field_name = '" . escape($fieldName) . "'
																					AND resource_id = " . $resource->__get('resource_id'));
		  	if($contentResourceResult["num_rows"] > 0)
			{
				$onclick = "SimpleAJAXCall('index.php?control_resource.controller/deleteResourceRelation/" . $resource->__get('resource_id') . "/" . $contentId . "/" . $fieldName . "/" . $_GET[3] . "', ElementStateChanged, 'GET', 'resource" . $resource->__get('resource_id') . "'); SimpleAJAXCall('index.php?control_resource.controller/refreshResourceList/" . $contentId . "/" . $fieldName . "/" . $_GET[3] . "/" . $typeId . "', ElementStateChanged, 'GET', '" . $fieldName . "'); ";
				$message = "[ quitar ]";
			}
			else
			{
				$onclick = "SimpleAJAXCall('index.php?control_resource.controller/addResourceRelation/" . $resource->__get('resource_id') . "/" . $contentId . "/" . $fieldName . "/" . $_GET[3] . "', ElementStateChanged, 'GET', 'resource" . $resource->__get('resource_id') . "'); SimpleAJAXCall('index.php?control_resource.controller/refreshResourceList/" . $contentId . "/" . $fieldName . "/" . $_GET[3] . "/" . $typeId . "', ElementStateChanged, 'GET', '" . $fieldName . "'); ";
				$message = "[ agregar ]";
			}
			$resourceType = new ResourceType($resource->__get('resource_type_id'));
			if($resourceType->__get('resource_type_name') == 'Image')
			{
				$imgSrc 	 = 'resources/images/50x50/' . $resource->__get('resource_file');
			}
			else
			{
				$imgSrc 	 = 'imgcontrol/iconos_sistema/' . $resourceType->__get('resource_type_icon');
			}			
		  ?>
            <li id="resource<?=$resource->__get('resource_id')?>"><a href="javascript:void(0);" onclick="<?=$onclick?>"><img src="<?=$imgSrc?>" /><span><?=$resource->__get('resource_name')?></span><span id="rstatus_<?=$resource->__get('resource_id')?>"><?=$message?></span></a></li>
          <?php
		  }
		  ?>
          </ul>
        </div>
        <a href="javascript:void(0);" onclick="SimpleAJAXCall('index.php?form_popup.control/uploadResource/<?=$_GET[2]?>/<?=$_GET[3]?>/<?=$_GET[4]?>/<?=$_GET[5]?>', loadFormLayer, 'GET', 'window2');" class="agregar_a_medio">[ + CARGAR ARCHIVO ]</a>
        <p><?=$contentResourcesResult["num_rows"]?> archivo(s) agregados</p>
      </form>
		<?php
    break;
	case 'uploadResource':
		$contentId 		  		= $_GET[1];
		$single	  		  		= ($_GET[2] == 1) ? true : false;
		$typeId	   		  		= ($_GET[3] != '') ? $_GET[3] : NULL;
		$fieldName 		  		= $_GET[4];	
		$key 					= md5(date("YmdHis"));
	?>
	  <h3>CARGAR ARCHIVO</h3>
	  <p>Cargar un archivo desde su computador</p>
	  <form enctype="multipart/form-data" id="validable" method="post" target="imageFrame" action="index.php?control_resource.controller" name="resourceForm" onsubmit="document.getElementById('loadingImage').style.display = '';">
		<input type="hidden" name="contentId" value="<?=$contentId?>" />
		<input type="hidden" name="single" value="<?=$_GET[2]?>" />
        <input type="hidden" name="typeId" value="<?=$typeId?>" />
        <input type="hidden" name="fieldName" value="<?=$fieldName?>" />
        <input type="hidden" name="key" value="<?=$key?>" />
        <input type="hidden" name="action" value="uploadResource" />
		<div class="medio_list" id="layerResourceList">
		  <ul>
			<li style="display:none" id="loadingImage"><img src="imgcontrol/loading.gif" /><span>Cargando...</span></li>
		  </ul>
		</div>
		<h4 id="layerMessageDiv" style="display:none">Archivo cargado exitosamente</h4>
		<div class="panel_layer">
		  <label> <span>Nombre</span>
		  <input type="text" name="resource_name" title="Nombre" />
		  </label>
		  <label> <span>Descripci&oacute;n</span>
		  <textarea name="resource_description" title="Descripcion" cols="45" rows="5"></textarea>
		  </label>
		  <label> <span>Tags</span>
		  <input type="text" name="resource_tags" title="Tags" />
		  </label>
		  <label> <span>Buscar Archivo</span>
		  <input type="file" name="resource_file" id="fileField" />
		  </label>
		  <label> <span>&nbsp;</span>
		  <input type="submit" name="submit" value="Aceptar" />
		  </label>
		</div>
        <iframe name="imageFrame" style="display:none"></iframe>
        <div class="botones2"> <a href="javascript:void(0);" onClick="SimpleAJAXCall('index.php?control_resource.controller/acceptResources/<?=$key?>', doNothing, 'GET', ''); SimpleAJAXCall('index.php?control_resource.controller/addResourcesRelation/<?=$key?>/<?=$contentId?>/<?=$fieldName?>', doNothing, 'GET', ''); SimpleAJAXCall('index.php?control_resource.controller/refreshResourceList/<?=$contentId?>/<?=$fieldName?>/<?=$_GET[2]?>/<?=$typeId?>', ElementStateChanged, 'GET', '<?=$fieldName?>'); closeFormLayer('window2');"><img src="imgcontrol/bot_l_guardar.gif" border="0" /></a> <a href="javascript:void(0);" onClick="SimpleAJAXCall('index.php?control_resource.controller/notAcceptResources/<?=$key?>', doNothing, 'GET', ''); closeFormLayer('window2');"><img src="imgcontrol/bot_l_cancelar.gif" border="0" /></a> </div>      
          
		<a href="javascript:void(0);" onclick="SimpleAJAXCall('index.php?form_popup.control/addResource/<?=$_GET[1]?>/<?=$_GET[2]?>/<?=$_GET[3]?>/<?=$_GET[4]?>', ElementStateChanged, 'GET', 'window2');" class="agregar_a_medio">[ o SELECCIONAR UN ARCHIVO]</a>
	  </form>
	<?php
    break;
	case 'updateResource':
		$contentResource = new ContentResource($_GET[1]);
		$resource 		 = new Resource($contentResource->__get('resource_id'));
		$fieldName		 = $_GET[2];
		$contentId		 = $_GET[3];
		?>
          <h3>EDITAR RECURSO</h3>
          <form enctype="multipart/form-data" id="validable1" method="post" target="imageFrame" action="javascript:void(0);">
            <input type="hidden" name="action" value="updateResource"  />
            <input type="hidden" name="resource_id" value="<?=$resource ->__get('resource_id')?>" />
            <div class="panel_layer">
              <label> <span>Nombre</span>
              <input type="text" name="resource_name" title="Nombre" value="<?=$resource->__get('resource_name')?>" />
              </label>
              <label> <span>Descripci&oacute;n</span>
              <textarea name="resource_description" title="Descripcion" cols="45" rows="5"><?=$resource->__get('resource_description')?></textarea>
              </label>
              <label> <span>Tags</span>
              <input type="text" name="resource_tags" title="Tags" value="<?=$resource->__get('resource_tags')?>" />
              </label>

            </div>
            <iframe name="imageFrame" style="display:none"></iframe>
            <div class="botones2"> <a href="javascript:void(0);" onClick="FormParseAJAXCall('index.php?control_resource.controller', doNothing, 'POST', '', document.getElementById('validable1')); SimpleAJAXCall('index.php?control_resource.controller/refreshResourceList/<?=$contentId?>/<?=$fieldName?>/1/<?=$resource->__get('resource_type_id')?>', ElementStateChanged, 'GET', '<?=$fieldName?>'); closeFormLayer('window2');"><img src="imgcontrol/bot_l_guardar.gif" border="0" /></a> <a href="javascript:void(0);" onClick="closeFormLayer('window2');"><img src="imgcontrol/bot_l_cancelar.gif" border="0" /></a> </div>      
          </form>
        <?php
	break;	
	case 'setLinkModule':
		$modules = ModuleHelper::retrieveModules("AND module_list = 1 ORDER BY module_title");
		$sites	 = SiteHelper::retrieveSites("AND site_parent = 0 ORDER BY site_name");
		$inputId = $_GET[1];
		?>
		  <h3>LINKS (MODULOS)</h3>
		  <form>
			<div class="medio_selector" id="layerResourceList">
			  <ul>
              <?php
			  foreach($modules as $module)
			  {
			   ?>
				<li><a href="javascript:void(0);" onclick="SimpleAJAXCall('index.php?form_popup.control/listContents/<?=$module->__get('module_id')?>/0/<?=$inputId?>', ElementStateChanged, 'GET', 'window2');"><img src="imgcontrol/iconos_sistema/dir.gif" /><span><strong><?=$module->__get('module_title')?></strong></span></a><a href="javascript:void(0);" onclick="setLinkValue('MOD:', '<?=$inputId?>', '<?=$module->__get('module_id')?>')">[ agregar ]</a></li>
              <?php
			  }
			  ?>
			  </ul>
			</div>
            </form>
		  <h3>LINKS (SITIOS)</h3>
		  <form>
			<div class="medio_selector" id="layerResourceList">
			  <ul>
              <?php
			  foreach($sites as $site)
			  {
			  	$sitesResult = SiteHelper::selectSites("AND site_parent = " . escape($site->__get('site_id')));
				if($sitesResult["num_rows"] > 0)
					$siteOnClick = "SimpleAJAXCall('index.php?form_popup.control/listSites/" . $site->__get('site_id') . "/" . $inputId . "', ElementStateChanged, 'GET', 'window2');";
				else
					$siteOnClick = "";			  
			   ?>
				<li><a href="javascript:void(0);" onclick="<?=$siteOnClick?>"><img src="imgcontrol/iconos_sistema/dir.gif" /><span><strong><?=$site->__get('site_name')?></strong> (<?=$sitesResult["num_rows"]?> hijos)</span></a><a href="javascript:void(0);" onclick="setLinkValue('SITE:', '<?=$inputId?>', '<?=$site->__get('site_id')?>')">[ agregar ]</a></li>
              <?php
			  }
			  ?>
			  </ul>
			</div>
            </form>
            <form>
            <div class="panel_layer">
              <label> <span>URL:</span>
              <input type="text" name="resource_name" id="customUrl" title="Nombre" />
              </label>
              <label> <span>&nbsp;</span>
              <input type="button" name="submit" value="Aceptar" onclick="setLinkValue('URL:', '<?=$inputId?>', document.getElementById('customUrl').value)" />
              </label>              
            </div>
		  </form>	
		<?php
	break;
	case 'setLinkContent':
		$modules = ModuleHelper::retrieveModules("AND module_content = 1 AND module_list = 1 ORDER BY module_title");
		$sites	 = SiteHelper::retrieveSites("AND site_parent = 0 ORDER BY site_name");
		$inputId = $_GET[1];
		?>
		  <h3>LINKS (MODULOS)</h3>
		  <form>
			<div class="medio_selector" id="layerResourceList">
			  <ul>
              <?php
			  foreach($modules as $module)
			  {
			   ?>
				<li><a href="javascript:void(0);" onclick="SimpleAJAXCall('index.php?form_popup.control/listContents/<?=$module->__get('module_id')?>/0/<?=$inputId?>/contents', ElementStateChanged, 'GET', 'window2');"><img src="imgcontrol/iconos_sistema/dir.gif" /><span><strong><?=$module->__get('module_title')?></strong></span></a></li>
              <?php
			  }
			  ?>
			  </ul>
			</div>
            </form>
		<?php
	break;
	case 'listContents':
		$moduleId  = $_GET[1];
		$parentId  = $_GET[2];
		$inputId   = $_GET[3];
		if($parentId == 0)
		{
			if(!isset($_GET[4]))
				$backOnclick = "SimpleAJAXCall('index.php?form_popup.control/setLinkModule/" . $inputId . "', ElementStateChanged, 'GET', 'window2');";
			else
				$backOnclick = "SimpleAJAXCall('index.php?form_popup.control/setLinkContent/" . $inputId . "', ElementStateChanged, 'GET', 'window2');";			
		}
		else
		{
			$extra = '';
			if(isset($_GET[4]))
				$extra = '/' . $_GET[4];
				
			$parentContent = new Content($parentId);
			$backOnclick = "SimpleAJAXCall('index.php?form_popup.control/listContents/" . $moduleId . "/" . $parentContent->__get('content_parent') . "/" . $inputId . $extra . "', ElementStateChanged, 'GET', 'window2');";
		}
		$contents  = ContentHelper::retrieveContents("AND content_parent = " . escape($parentId) . " AND module_id = " . escape($moduleId) . " ORDER BY content_varchar_1");
		?>
		  <h3>LINKS</h3>
		  <form>
			<div class="medio_selector" id="layerResourceList">
			  <ul>
              <?php
			  foreach($contents as $content)
			  {
				$extra = '';
				if(isset($_GET[4]))
					$extra = '/' . $_GET[4];
			  	$contentsResult = ContentHelper::selectContents("AND content_parent = " . escape($content->__get('content_id')) . " AND module_id = " . escape($moduleId));
				if($contentsResult["num_rows"] > 0)
					$contentOnClick = "SimpleAJAXCall('index.php?form_popup.control/listContents/" . $moduleId . "/" . $content->__get('content_id') . "/" . $inputId . $extra . "', ElementStateChanged, 'GET', 'window2');";
				else
					$contentOnClick = "";
			   ?>
				<li><a href="javascript:void(0);" onclick="<?=$contentOnClick?>"><img src="imgcontrol/ico_page.gif" /><span><strong><?=$content->__get('content_varchar_1')?></strong> (<?=$contentsResult["num_rows"]?> hijos)</span></a><a href="javascript:void(0);" onclick="setLinkValue('ID:', '<?=$inputId?>', '<?=$content->__get('content_id')?>')">[ agregar ]</a></li>
              <?php
			  }
			  ?>
			  </ul>
			</div>
            </form>
            <form>
            <div class="panel_layer">
              <label> <span>URL:</span>
              <input type="text" name="resource_name" id="customUrl" title="Nombre" />
              </label>
              <label> <span>&nbsp;</span>
              <input type="button" name="submit" value="Aceptar" onclick="setLinkValue('URL:', '<?=$inputId?>', document.getElementById('customUrl').value)" />
              </label>              
            </div>
<a href="javascript:void(0);" onclick="<?=$backOnclick?>" class="agregar_a_medio">[ REGRESAR ]</a>            
		  </form>	
		<?php		
	break;
	case 'listSites':
		$parentId   = $_GET[1];
		$inputId    = $_GET[2];
		$parentSite = new Site($parentId); 
		if($parentSite->__get('site_parent') == 0)
			$backOnclick = "SimpleAJAXCall('index.php?form_popup.control/setLinkModule/" . $inputId . "', ElementStateChanged, 'GET', 'window2');";
		else
		{
			$backOnclick = "SimpleAJAXCall('index.php?form_popup.control/listSites/" . $parentSite->__get('site_parent') . "/" . $inputId . "', ElementStateChanged, 'GET', 'window2');";
		}
		$sites  = SiteHelper::retrieveSites("AND site_parent = " . escape($parentId) . " ORDER BY site_name");
		?>
		  <h3>LINKS</h3>
		  <form>
			<div class="medio_selector" id="layerResourceList">
			  <ul>
              <?php
			  foreach($sites as $site)
			  {
			  	$sitesResult = SiteHelper::selectSites("AND site_parent = " . escape($site->__get('site_id')));
				if($sitesResult["num_rows"] > 0)
					$siteOnClick = "SimpleAJAXCall('index.php?form_popup.control/listSites/" . $site->__get('site_id') . "/" . $inputId . "', ElementStateChanged, 'GET', 'window2');";
				else
					$siteOnClick = "";	
			   ?>
				<li><a href="javascript:void(0);" onclick="<?=$siteOnClick?>"><img src="imgcontrol/ico_page.gif" /><span><strong><?=$site->__get('site_name')?></strong> (<?=$sitesResult["num_rows"]?> hijos)</span></a><a href="javascript:void(0);" onclick="setLinkValue('SITE:', '<?=$inputId?>', '<?=$site->__get('site_id')?>')">[ agregar ]</a></li>
              <?php
			  }
			  ?>
			  </ul>
			</div>
            </form>
            <form>
            <div class="panel_layer">
              <label> <span>URL:</span>
              <input type="text" name="resource_name" id="customUrl" title="Nombre" />
              </label>
              <label> <span>&nbsp;</span>
              <input type="button" name="submit" value="Aceptar" onclick="setLinkValue('URL:', '<?=$inputId?>', document.getElementById('customUrl').value)" />
              </label>              
            </div>
<a href="javascript:void(0);" onclick="<?=$backOnclick?>" class="agregar_a_medio">[ REGRESAR ]</a>            
		  </form>	
		<?php		
	break;	
	case 'fieldForm':
		$field	  = (isset($_GET[1]) && ($_GET[1] != '')) ? new Field($_GET[1]) : new Field();
		$action	  = (isset($_GET[1]) && ($_GET[1] != '')) ? 'update' : 'create';
		$moduleId = $_GET[2];
		$types 	  = AvailableFieldHelper::retrieveAvailableFields("ORDER BY available_field_name");
		$fields   = ContentHelper::retrieveFieldsResult();
		?>
          <h3>EDITAR CAMPO</h3>
          <form enctype="multipart/form-data" id="validable1" method="post" action="index.php?control_field.controller">
          	<input type="hidden" name="action" value="<?=$action?>" />
            <input type="hidden" name="moduleId" value="<?=$moduleId?>" />
            <input type="hidden" name="fieldId" value="<?=$field->__get('field_id')?>" />
            <div class="panel_layer">
              <label> <span>Label</span>
              <input type="text" name="field_label" title="Label" value="<?=$field->__get('field_label')?>" />
              </label>
              <label> <span>Nombre de campo</span>
              <select name="field_name" title="Tipo">
              	<?php
				while($fieldsRow = mysql_fetch_assoc($fields["query"]))
				{
					$selected = '';
					if($fieldsRow["Field"] == $field->__get('field_name'))
						$selected = 'selected="selected"';
				?>
                	<option value="<?=$fieldsRow["Field"]?>" <?=$selected?>><?=$fieldsRow["Field"]?></option>
                <?php
				}
				?>
                	<?php $selected = ''; if('content_gallery_1' == $field->__get('field_name')) $selected = 'selected="selected"'; ?><option value="content_gallery_1" <?=$selected?>>content_gallery_1</option>
                    <?php $selected = ''; if('content_gallery_2' == $field->__get('field_name')) $selected = 'selected="selected"'; ?><option value="content_gallery_2" <?=$selected?>>content_gallery_2</option>
              </select>
              </label>
              <label> <span>Restriccion</span>
              <input type="text" name="field_restriction" title="Label" value="<?=$field->__get('field_restriction')?>" />
              </label>
              <label> <span>Tipo</span>
			  <select name="field_type" title="Tipo">
              	<?php
				foreach($types as $type)
				{
					$selected = '';
					if($type->__get('available_field_name') == $field->__get('field_type'))
						$selected = 'selected="selected"';
				?>
                	<option value="<?=$type->__get('available_field_name')?>" <?=$selected?>><?=$type->__get('available_field_name')?></option>
                <?php
				}
				?>	
              </select>
              </label>     
			  <label> <span>Clase</span>
               <input type="text" name="field_class" title="Label" value="<?=$field->__get('field_class')?>" />
              </label>  
              <label> <span>Opciones</span>
               <input type="text" name="field_options" title="Label" value="<?=$field->__get('field_options')?>" />
              </label>                                      
            </div>
            <div class="botones2"><input type="image" src="imgcontrol/bot_l_guardar.gif" border="0" /> <a href="javascript:void(0);" onClick="closeFormLayer('window2');"><img src="imgcontrol/bot_l_cancelar.gif" border="0" /></a> </div>
        <?php	
	break;
	case 'formFieldForm':
		$field	  = (isset($_GET[1]) && ($_GET[1] != '')) ? new FormField($_GET[1]) : new FormField();
		$action	  = (isset($_GET[1]) && ($_GET[1] != '')) ? 'update' : 'create';
		$formId   = $_GET[2];
		$types 	  = AvailableFieldHelper::retrieveAvailableFields("ORDER BY available_field_title");
		?>
          <h3>CREAR CAMPO</h3>
          <form enctype="multipart/form-data" id="validable1" method="post" action="index.php?control_formfield.controller">
          	<input type="hidden" name="action" value="<?=$action?>" />
            <input type="hidden" name="formId" value="<?=$formId?>" />
            <input type="hidden" name="fieldId" value="<?=$field->__get('form_field_id')?>" />
            <input type="hidden" name="fieldName" value="<?=$field->__get('form_field_name')?>" />
            <div class="panel_layer">
              <label> <span>T&iacute;tulo</span>
              <input type="text" name="form_field_title" title="Label" value="<?=$field->__get('form_field_title')?>" />
              </label>
              <label> <span>Tipo</span>
			  <select name="form_field_type" title="Tipo">
              	<?php
				foreach($types as $type)
				{
					$selected = '';
					if($type->__get('available_field_name') == $field->__get('form_field_type'))
						$selected = 'selected="selected"';
				?>
                	<option value="<?=$type->__get('available_field_name')?>" <?=$selected?>><?=$type->__get('available_field_title')?></option>
                <?php
				}
				?>	
              </select>
              </label> 
              <label> <span>Opciones</span>
              <input type="text" name="form_field_options" title="Label" value="<?=$field->__get('form_field_options')?>" />
              </label>                  
            </div>
            <div class="botones2"><input type="image" src="imgcontrol/bot_l_guardar.gif" border="0" /> <a href="javascript:void(0);" onClick="closeFormLayer('window2');"><img src="imgcontrol/bot_l_cancelar.gif" border="0" /></a> </div>
        <?php	
	break;	
	case 'thumbForm':
	if(isset($_POST['crop']))
	{
		$newSize   = explode(',', $_POST['newSize']);
		$sourceXY  = explode(',', $_POST['sourceXY']);
		$size      = explode(',', $_POST['size']);
		$image     = $_POST['image'];
		$imageDest = $_POST['imageDest'];
		$pathPieces = explode('/', $imageDest);
		$waterMark 		 = false;
		$waterMarkFolder = '';
		
		if(is_file($pathPieces[0] . '/' . $pathPieces[1] . '/' . $pathPieces[2] . '/watermarked.mgmd'))
		{
			$waterMark 		 = true;				
			$waterMarkFolder = $pathPieces[0] . '/' . $pathPieces[1] . '/' . $pathPieces[2] . '/';
		}

		
	
		$imagen = new Image($image, $waterMark, $waterMarkFolder);
		$imagen->newSize  = $newSize;
		$imagen->sourceXY = $sourceXY;
		$imagen->size     = $size;
		//$imagen->crop();
		$imagen->save($imageDest);
	}	
	$contentResourceId =  isset($_GET[1]) ? $_GET[1] : $_POST['resource_id'];
	$contentResource = new ContentResource($contentResourceId);
	$resourceId = $contentResource->__get('resource_id');	
	$thumb = isset($_GET[2]) ? urldecode($_GET[2]) : NULL;
	$resource = new Resource($resourceId);
	if($thumb != NULL)
	{
		$size  = explode('x', $thumb);
		?>
	  <h3>ALISTAMIENTO DE IMAGENES</h3>
		<form name="form" action="javascript:void(0);" method="post" id="resourceForm">
			 <div class="medio_selector2">
				 <div class="previsualizar"  id="previewArea"></div>
				 <div class="areadecorte"> <img src="resources/images/<?=$resource->__get('resource_file')?>" id="imagen" /></div>
			 </div>
			<input type="hidden" name="imageDest" value="resources/images/<?=$thumb?>/<?=$resource->__get('resource_file')?>" />
			<input type="hidden" name="image" value="resources/images/<?=$resource->__get('resource_file')?>" />                
			<input id="sourceXY" name="sourceXY" readonly="readonly" type="hidden" />
			<input id="size" name="size" readonly="readonly" type="hidden" />
			<input id="newSize" name="newSize" value="<?=$size[0]?>,<?=$size[1]?>" readonly="readonly" type="hidden" />
			<input type="hidden" name="crop" value="1" />
            <input type="hidden" name="form" value="thumbForm" />
			<input type="hidden" name="resource_id" value="<?=$contentResourceId?>" />
			<p>Ajuste las imagenes para la presentaci&oacute;n en el sitio web</p>
			<div class="botones2">
			  <input name="" type="image" onclick="FormParseAJAXCall('index.php?form_popup.control', ElementStateChanged, 'POST', 'window2', document.getElementById('resourceForm'));" src="imgcontrol/bot_l_guardar.gif" alt="Guardar" width="160" height="28" />
			</div>
			   
		</form>
        <?php
	}
	else
	{
		$thumbs   = ResourceHelper::retrieveThumbFolders();
		echo '<div class="medio_selector"><ul>';
        foreach($thumbs as $thumb)
        {
            if($thumb['thumb_type'] != 'resize')
            {
                echo '<li><a href="javascript:void(0)" onclick="ParamsAJAXCall(\'index.php?form_popup.control/thumbForm/' . $contentResourceId . '/' . urlencode($thumb) . '\', createCropperPopup, \'GET\', \'window2\', \'' . $thumb . '\')"><img src="resources/images/' . $thumb . '/' . $resource->__get('resource_file') . '?' . rand(0,9999) . '" width="100" /><span>' . $resource->__get('resource_name') . ' - ' . $thumb . '</span></a></li>';	
            }
        }
        echo '</ul></div>    <p>Ajuste las imagenes para la presentaci&oacute;n en el sitio web</p>
				<div class="botones2">
				  <input name="" type="image" src="imgcontrol/bot_l_guardar.gif" alt="Guardar" width="160" height="28" onclick="closeFormLayer(\'window2\')" />
				</div>';
    }
	?>
</div>
    <?php
	break;
	case 'listRelationContents':
		$type 			= $_GET[1];
		$module_id 		= $_GET[2];
		$relationship 	= $_GET[3];
		$name			= $_GET[4];
		$field_id		= $_GET[5];
		$content_id		= $_GET[6];		
		$level			= $_GET[7];	
		$option8		= isset($_GET[8]) ? '/'.$_GET[8] : '';	
	 	$filter			= ($level != 0) ? ' AND content_level = ' . $level : '';
		if(isset($_GET[8]) && $_GET[8] != '')
			$contents_relationship = contentHelper::retrieveContents(' AND module_id =' . $module_id .' AND content_state = "A" AND content_parent = '. escape($_GET[8]).' ORDER BY content_varchar_1');
		else
			$contents_relationship = contentHelper::retrieveContents(' AND module_id =' . $module_id .' AND content_state = "A" '. $filter.' ORDER BY content_varchar_1');
		$relationship_num	   = ContentRelationHelper::numContentRelation($content_id,$relationship);
		?>
      <h3>ASOCIAR ARCHIVOS</h3>
      <div class="medio_selector_search">
        <form>
            <input name="" type="text" />
    <input name="" type="submit" value="Buscar" />    
    </form>
      </div> 
        
       
      <form>
        <div class="medio_selector">
          <ul>
          <?php
		  foreach($contents_relationship as $content)
		  {
		  	
			$relatedContent = ContentRelationHelper::selectContentRelation($content_id,$content->__get('content_id'),$relationship);
			if($relatedContent["num_rows"] > 0)
			{
				$onclick = "SimpleAJAXCall('index.php?control_content_related.controller/deleteContentRelation/" . $content->__get('content_id') . "/" . $content_id . "/" . $relationship . "/" . $module_id ."/" . $type . "/" . $field_id . "/" . $name . "', ElementStateChanged, 'GET', 'content" . $content->__get('content_id') . "'); SimpleAJAXCall('index.php?control_content_related.controller/refreshContentList/" . $content->__get('content_id') . "/" . $content_id . "/" . $type  . "/" . $field_id . "/" . $name . "/" . $module_id . "/" . $relationship ."/".$level. "', ElementStateChanged, 'GET', '" . $name . "'); ";
				$message = $content->__get('content_varchar_1') . "[ quitar ]";
			}
			else
			{
				$onclick = "SimpleAJAXCall('index.php?control_content_related.controller/addContentRelation/" . $content->__get('content_id') . "/" . $content_id . "/" . $relationship . "/" . $module_id ."/" . $type . "/" . $field_id . "/" . $name . "', ElementStateChanged, 'GET', 'content" . $content->__get('content_id') . "'); SimpleAJAXCall('index.php?control_content_related.controller/refreshContentList/" . $content->__get('content_id') . "/" . $content_id . "/" . $type  . "/" . $field_id . "/" . $name . "/" . $module_id . "/" . $relationship ."/".$level. "', ElementStateChanged, 'GET', '" . $name . "'); ";
				$message = $content->__get('content_varchar_1') . "[ agregar ]";
			}
			if($level == 0 || isset($_GET[8]))
			{			
		  ?>
            	<li id="content<?=$content->__get('content_id')?>"><a href="javascript:void(0);" onclick="<?=$onclick?>"><span><?=$content->__get('content_varchar_4')?></span><span id="rstatus_<?=$content->__get('content_id')?>"><?=$message?></span></a></li>
          <?php
			}
			else
			{
				$onclick = "SimpleAJAXCall('index.php?form_popup.control/listRelationContents/".$type."/".$module_id."/".$relationship."/".$name."/".$field_id."/".$content_id."/".$level."/".$content->__get('content_id')."', loadFormLayer, 'GET', 'window2');";
				?>
				<li id="content<?=$content->__get('content_id')?>"><a href="javascript:void(0);" onclick="<?=$onclick?>"><span><?=$content->__get('content_varchar_4')?></span><span id="rstatus_<?=$content->__get('content_id')?>"><?=$message?></span></a></li>
				<?php
			}
		  }
		  ?>
          </ul>
        </div>
        
        <p><li id="content<?=$content_id?>"><?=$relationship_num["num_rows"]?> link(s) agregados</li></p>
      </form>
		<?php
    break;
	case 'resourceOrderPopup':
		header('Content-Type: text/html; charset=ISO-8859-1'); 
		$contentId = $_GET[1];
		$fieldName = $_GET[2];

		$contentResources = ContentResourceHelper::retrieveContentResources("AND content_id = " . escape($contentId) . " 

																	  AND content_resource_field_name = '" . escape($fieldName) . "' ORDER BY content_resource_order");
		
	
		?>
		  <h3>ORDENAR RECURSOS</h3>
		  <p>Arrastre los recursos para ordenarlos</p>
		  <div class="medio_selector">
			<ul id="orderContents" class="sortableList">
			  <?
        foreach($contentResources as $contentResource)
		{
			$resource 	  = new Resource($contentResource->__get('resource_id'));

			$resourceType = new ResourceType($resource->__get('resource_type_id'));
			if($resourceType->__get('resource_type_name') == 'Image')
				$imgSrc 	 = 'resources/images/50x50/' . $resource->__get('resource_file');
			else
				$imgSrc 	 = 'imgcontrol/iconos_sistema/' . $resourceType->__get('resource_type_icon');
			?>
		  <li id="item_<?=$contentResource->__get('content_resource_id')?>"> <a href="javascript:void(0);"><img src="<?=$imgSrc?>" />
			<?=$resource->__get('resource_name');?>
			</a> </li>
			<?php
		}				  
		?>
			</ul>
		  </div>
		<form id="serializeForm" method="post" action="index.php?control_resource.controller">
			<input type="hidden" name="serializedArray" value="" />
			<input type="hidden" name="action" value="setOrder" />
			<input type="hidden" name="contentId" value="<?=$_GET[1]?>" />
			<input type="hidden" name="fieldName" value="<?=$_GET[2]?>" />
			<div class="botones2"> <a href="javascript:void(0);" onClick="document.getElementById('serializeForm').submit();"><img src="imgcontrol/bot_l_guardar.gif" border="0" /></a> </div>
		</form>
	<?php
	break;
	case 'setCoords':
		$parentId   	= $_GET[1];
		$content		= new Content($parentId);
		?>
        
          <h3>ESTABLECER COORDENADA</h3>
          <form  enctype="multipart/form-data" name="contentForm" id="contentForm" >
            <input type="hidden" id="coords" name="content_extra_varchar_4" value="" />
            <div class="panel_layer">
              <label> 
              
			<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="668" height="512">>
			    <param name="movie" value="swf/setCoords.swf" />
                <param name="quality" value="high" />
                <embed src="swf/setCoords.swf" width="668" height="512" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash"></embed>
              </object>
</label>
            </div>
            <div class="botones2">
            <input type="hidden" name="fieldName" value="content_extra_varchar_4" />
            <input type="hidden" name="content_id" value="<?=$parentId?>" />
            <input type="hidden" name="action" value="editField" />
		  <div class="botones2"> <a href="javascript:void(0);" onClick="FormParseAJAXCall('index.php?control_content.controller', doNothing, 'POST', '', contentForm, true); closeFormLayer('window2');"><img src="imgcontrol/bot_l_guardar.gif" border="0" /></a> <a href="javascript:void(0);" onClick="closeFormLayer('window2');"><img src="imgcontrol/bot_l_cancelar.gif" border="0" /></a> </div>
         <?php
	break;	
	
	case 'setGogleMaps':
		$parentId   = $_GET[1];
		$name   = $_GET[2];
		$value		= $_GET[4];
		$options	= $_GET[3];
?>
          <h3>ESTABLECER COORDENADA</h3>
          <form  enctype="multipart/form-data" name="contentForm" id="contentForm">
            <div class="panel_layer">
              	
					<div id="map_canvas" style="width: 780px; height: 300px"></div>	  
				
            </div>
            
            <input type="hidden" name="fieldName" value="<?php echo $name?>" />
			<input type="hidden" id="by_value" name="<?php echo $name?>" value="<?php echo $value?>" />
            <input type="hidden" name="content_id" value="<?=$parentId?>" />
            <input type="hidden" name="action" value="editField" />
			
		  <div class="botones2"> <a href="javascript:void(0);" onClick="FormParseAJAXCall('index.php?control_content.controller', doNothing, 'POST', '', contentForm, true); closeFormLayer('window2');"><img src="imgcontrol/bot_l_guardar.gif" border="0" /></a> <a href="javascript:void(0);" onClick="closeFormLayer('window2');"><img src="imgcontrol/bot_l_cancelar.gif" border="0" /></a> </div>
         <?php
	break;
endswitch;
?>