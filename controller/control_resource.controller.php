<?php
header('Content-Type: text/html; charset=ISO-8859-1'); 
$action  	 = isset($_POST['action']) ? $_POST['action'] : $_GET[0];
ini_set('memory_limit', '256M');
switch ($action):
	case 'uploadResource':
		$resource = new Resource();
		foreach($_POST as $key => $value)
			$resource->__set($key, $value);
		
		$contentId	  =& $_POST['contentId'];
		$single 	  =& $_POST['single'];
		$typeId 	  =& $_POST['typeId'];
		$fieldName	  =& $_POST['fieldName'];	
		$key		  =& $_POST['key'];			
		
		$resource->__set('resource_type_id', $typeId);
		$resource->__set('resource_upload_key', $key);
		
		$resourceType = new ResourceType($typeId );
		
		if($_FILES['resource_file']['name'] != '')
		{
			$ext = getFileExtension($_FILES['F']['name']);
			if(strpos($resourceType->__get('resource_type_extensions'), str_replace('.', '', $ext)) !== false)
			{
				$name = md5(date("YmdHis")) . $ext;
				
				if(!is_dir('resources/' . $resourceType->__get('resource_type_directory')))
					mkdir('resources/' . $resourceType->__get('resource_type_directory'), 0755);
				if(uploadFile('resources/' . $resourceType->__get('resource_type_directory') . '/', $_FILES['resource_file']['tmp_name'], $name))
				{
					if($resourceType->__get('resource_type_action') == 'create_thumbs')
					{
						$accept = array('jpg', 'gif', 'png', 'jpeg');
						$medio = new Medio($name , $accept, 'resources/' . $resourceType->__get('resource_type_directory') . '/');  
					}
					$resource->__set('resource_file', $name);
					
					$result = $resource->save();
					
					if($single == 1)
					{
						$contentResources = ContentResourceHelper::retrieveContentResources("AND content_id = " . $contentId . " 
																	  						 AND content_resource_field_name = '" . $fieldName . "'");
						foreach($contentResources as $contentResource)
							$contentResource->delete();
																				
						$contentResource = new ContentResource();
						$contentResource->__set('content_id', $contentId);
						$contentResource->__set('resource_id', $result["insert_id"]);
						$contentResource->__set('content_resource_field_name', $fieldName);
						
						$contentResource->save();
						
						javascriptExecute("parent.SimpleAJAXCall('index.php?control_resource.controller/acceptResources/" . $key . "', parent.doNothing, 'GET', ''); 
										   parent.SimpleAJAXCall('index.php?control_resource.controller/refreshResourceList/" . $contentId . "/" . $fieldName . "/" . $single . "/" . $typeId . "', parent.ElementStateChanged, 'GET', '" . $fieldName . "'); 
										   parent.closeFormLayer('window2');");
					}
					else
						javascriptExecute("parent.SimpleAJAXCall('index.php?control_resource.controller/refreshLayerResourceList/" . $key . "', parent.ElementStateChanged, 'GET', 'layerResourceList'); parent.document.resourceForm.reset();");
				}
				else
					echo 'Couldn\'t upload the file';	
			}
			else
				javascriptExecute("parent.document.getElementById('layerMessageDiv').innerHTML = 'El tipo de archivo no es valido. (" . $resourceType->__get('resource_type_extensions') . ")';
								   parent.document.getElementById('loadingImage').style.display = 'none';");		
		}
	break;
	case 'uploadNCResource':
		$objectVars   = unserialize(urldecode($_POST['object_vars'])); 
		eval('$resource = new ' . $objectVars['resource_object'] . '();');
		foreach($_POST as $key => $value)
			$resource->__set($key, $value);
		
		$objectId	  =& $_POST['objectId'];
		$single 	  =& $_POST['single'];
		$typeId 	  =& $_POST['typeId'];
		$fieldName	  =& $_POST['fieldName'];	
		$key		  =& $_POST['key'];			
		
		$resource->__set('resource_type_id', $typeId);
		$resource->__set('resource_upload_key', $key);
		
		$resourceType = new ResourceType($typeId );
		
		if($_FILES['resource_file']['name'] != '')
		{
			$ext = getFileExtension($_FILES['resource_file']['name']);
			if(strpos($resourceType->__get('resource_type_extensions'), str_replace('.', '', $ext)) !== false)
			{
				$name = md5(date("YmdHis")) . $ext;
				
				if(!is_dir('resources/' . $resourceType->__get('resource_type_directory')))
					mkdir('resources/' . $resourceType->__get('resource_type_directory'), 0755);
				if(uploadFile('resources/' . $resourceType->__get('resource_type_directory') . '/', $_FILES['resource_file']['tmp_name'], $name))
				{
					if($resourceType->__get('resource_type_action') == 'create_thumbs')
					{
						$accept = array('jpg', 'gif', 'png', 'jpeg');
						$medio = new Medio($name , $accept, 'resources/' . $resourceType->__get('resource_type_directory') . '/');  
					}
					$resource->__set('resource_file', $name);
					
					$result = $resource->save();
					
						eval('$objectResources = ' . $objectVars['object'] . 'Helper::retrieve' . $objectVars['object'] . 's("AND ' . $objectVars['field_prefix'] . '_id = ' . $objectId . ' 
																	  						 AND ' . $objectVars['field_prefix'] . '_resource_field_name = \'' . $fieldName . '\'");');
						if($single == 1)
						{
							foreach($objectResources as $objectResource)
								$objectResource->delete();
						}
																				
						eval('$objectResource = new ' . $objectVars['object'] . '();');
						$objectResource->__set($objectVars['field_prefix'] . '_id', $objectId);
						$objectResource->__set('resource_id', $result["insert_id"]);
						$objectResource->__set($objectVars['field_prefix'] . '_resource_field_name', $fieldName);
						
						$objectResource->save();
					
						if($single == 1)
						{
							javascriptExecute("parent.SimpleAJAXCall('index.php?control_resource.controller/refreshNCResourceList/" . $objectId . "/" . $fieldName . "/" . $single . "/" . $typeId . "/" . $_POST['object_vars'] . "', parent.ElementStateChanged, 'GET', '" . $fieldName . "');
											  parent.SimpleAJAXCall('index.php?control_resource.controller/acceptNCResources/" . $key . "/" . $_POST['object_vars'] . "', parent.doNothing, 'GET', '');
											  parent.closeFormLayer('window2');");
						} 
						else
							javascriptExecute("parent.SimpleAJAXCall('index.php?control_resource.controller/refreshLayerNCResourceList/" . $key . "/" . $_POST['object_vars'] . "', parent.ElementStateChanged, 'GET', 'layerResourceList'); parent.document.resourceForm.reset();");
				}
				else
					echo 'Couldn\'t upload the file';	
			}
			else
				javascriptExecute("parent.document.getElementById('layerMessageDiv').innerHTML = 'El tipo de archivo no es valido. (" . $resourceType->__get('resource_type_extensions') . ")';
								   parent.document.getElementById('loadingImage').style.display = 'none';");		
		}
	break;	
	case 'refreshLayerResourceList':
		$resources = ResourceHelper::retrieveResources("AND resource_accepted = 0 AND resource_upload_key = '" . $_GET[1] . "'");
		?>
		  <ul>
          <?php
		  foreach($resources as $resource)
		  {
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
			<li><a href="SimpleAJAXCall('index.php?control_resource.controller/deleteResource/<?=$resource->__get('resource_id')?>/<?=$_GET[1]?>, ElementStateChanged, 'GET', 'layerResourceList');">[ eliminar ]</a><img src="<?=$imgSrc?>" /><span><?=$resource->__get('resource_name')?></span></li>
		  <?php
		  }
		  ?>
            <li style="display:none" id="loadingImage"><img src="imgcontrol/loading.gif" /><span>Cargando...</span></li>
		  </ul>
        <?php
	break;
	case 'refreshLayerNCResourceList':
		$objectVars = unserialize(urldecode($_GET[2]));
		eval('$resources  = ' . $objectVars['resource_object'] . 'Helper::retrieveShopResources("AND resource_accepted = 0 AND resource_upload_key = \'' . $_GET[1] . '\'");');
		?>
		  <ul>
          <?php
		  foreach($resources as $resource)
		  {
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
			<li><a href="SimpleAJAXCall('index.php?control_resource.controller/deleteNCResource/<?=$resource->__get('resource_id')?>/<?=$_GET[1]?>/<?=$_GET[2]?>, ElementStateChanged, 'GET', 'layerResourceList');">[ eliminar ]</a><img src="<?=$imgSrc?>" /><span><?=$resource->__get('resource_name')?></span></li>
		  <?php
		  }
		  ?>
            <li style="display:none" id="loadingImage"><img src="imgcontrol/loading.gif" /><span>Cargando...</span></li>
		  </ul>
        <?php
	break;	
	case 'deleteResource':
		$key 	  = $_GET[2];
		$resource = new Resource($_GET[1]);
		$resource->updateField('resource_state', 'D');
		javascriptExecute("parent.SimpleAJAXCall('index.php?control_resource.controller/refreshLayerResourcelist/" . $key . "', parent.ElementStateChanged, 'GET', 'layerResourceList');");
	break;
	case 'deleteNCResource':
		$key 	  = $_GET[2];
		$objectVars = unserialize(urldecode($_GET[3]));
		eval("$resource 	= new " . $objectVars['resource_object'] . "(" . $_GET[1] . ");");		
		$resource->updateField('resource_state', 'D');
		javascriptExecute("parent.SimpleAJAXCall('index.php?control_resource.controller/refreshLayerNCResourcelist/" . $key . "', parent.ElementStateChanged, 'GET', 'layerResourceList');");
	break;	
	case 'acceptResources':
		$key = $_GET[1];
		$resources = ResourceHelper::retrieveResources("AND resource_upload_key = '" . $key . "'");
		foreach($resources as $resource)
			$resource->updateField('resource_accepted', 1);
	break;
	case 'acceptNCResources':
		$key = $_GET[1];
		$objectVars = unserialize(urldecode($_GET[2]));
		eval('$resources = ' . $objectVars['resource_object'] . 'Helper::retrieve' . $objectVars['resource_object'] . 's("AND resource_upload_key = \'' . $key . '\'");');
		foreach($resources as $resource)
			$resource->updateField('resource_accepted', 1);
	break;	
	case 'notAcceptResources':
		$key = $_GET[1];
		$resources = ResourceHelper::retrieveResources("AND resource_upload_key = '" . $key . "'");
		foreach($resources as $resource)
			$resource->delete();
	break;
	case 'notAcceptNCResources':
		$key = $_GET[1];
		$objectVars = unserialize(urldecode($_GET[2]));
		eval("$resources = " . $objectVars['resource_object'] . "Helper::retrieveResources(\"AND resource_upload_key = '" . $key . "'\");");
		foreach($resources as $resource)
			$resource->delete();
	break;	
	case 'refreshResourceList':
		$form 	= new Form('', '', $_GET[1],'');
		$form->putField('gallery', $_GET[2], '', $_GET[3] . '|' . $_GET[4]);
	break;
	case 'refreshNCResourceList':
		$objectVars = unserialize(urldecode($_GET[5]));	
		eval('$resources 	 = ' . $objectVars['object'] . 'Helper::retrieve' . $objectVars['object'] . 's("AND ' . $objectVars['field_prefix'] . '_id = ' . $_GET[1] . ' AND '.$objectVars['field_prefix'].'_resource_field_name = \'' . $_GET[2] . '\'  ORDER BY ' . $objectVars['field_prefix'] . '_resource_order");');
		Form::put_NC_gallery($resources, $_GET[3] . '|' . $_GET[4], $_GET[2], $_GET[1], $objectVars['field_prefix'], $objectVars['object'], $objectVars['resource_object'], $objectVars['expand_page'])	;
	break;
	case 'deleteResourceRelation':
		$resourceId  = $_GET[1];
		$contentId   = $_GET[2];
		$fieldName   = $_GET[3];
		$resource	 = new Resource($resourceId);
		$typeId		 = $resource->__get('resource_type_id');
		
		$contentResources = ContentResourceHelper::retrieveContentResources("AND content_id = " . escape($contentId) . " 
																	  			 	AND content_resource_field_name = '" . escape($fieldName) . "'
																					AND resource_id = " . $resourceId);
		foreach($contentResources as $contentResource)
			$contentResource->delete();

		$onclick = "SimpleAJAXCall('index.php?control_resource.controller/addResourceRelation/" . $resourceId . "/" . $contentId . "/" . $fieldName . "/" . $_GET[4] . "', ElementStateChanged, 'GET', 'resource" . $resourceId . "'); SimpleAJAXCall('index.php?control_resource.controller/refreshResourceList/" . $contentId . "/" . $fieldName . "/" . $_GET[4] . "/" . $typeId . "', ElementStateChanged, 'GET', '" . $fieldName . "'); ";
		$message = "[ agregar ]";
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
	break;
	case 'deleteNCResourceRelation':
		$resourceId  = $_GET[1];
		$objectId   = $_GET[2];
		$fieldName   = $_GET[3];
		$objectVars  = unserialize(urldecode($_GET[5]));
		eval('$resource	 = new ' . $objectVars['resource_object'] . '(' . $resourceId . ');');
		$typeId		 = $resource->__get('resource_type_id');
		
		eval('$objectResources = ' . $objectVars['object'] . 'Helper::retrieve' . $objectVars['object'] . 's("AND ' . $objectVars['field_prefix'] . '_id = ' . escape($objectId) . ' 
																	  			 	AND ' . $objectVars['field_prefix'] . '_resource_field_name = \'' . escape($fieldName) . '\'
																					AND resource_id = ' . $resourceId . '");');
		foreach($objectResources as $objectResource)
			$objectResource->delete();

		$onclick = "SimpleAJAXCall('index.php?control_resource.controller/addNCResourceRelation/" . $resourceId . "/" . $objectId . "/" . $fieldName . "/" . $_GET[4] . "/" . $_GET[5] . "', ElementStateChanged, 'GET', 'resource" . $resourceId . "'); SimpleAJAXCall('index.php?control_resource.controller/refreshNCResourceList/" . $objectId . "/" . $fieldName . "/" . $_GET[4] . "/" . $typeId . "/" . $_GET[5] . "', ElementStateChanged, 'GET', '" . $fieldName . "'); ";
		$message = "[ agregar ]";
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
	break;	
	case 'deleteResourceRelation1':
		$resourceId  	 = $_GET[1];
		$contentId   	 = $_GET[2];
		$fieldName   	 = $_GET[3];
		$contentResource = new ContentResource($resourceId);
		
		$contentResources = ContentResourceHelper::retrieveContentResources("AND content_resource_id = " . $resourceId);
		foreach($contentResources as $contentResource)
			$contentResource->delete();
	break;
	case 'deleteNCResourceRelation1':
		$resourceId  	 = $_GET[1];
		$objectId   	 = $_GET[2];
		$fieldName   	 = $_GET[3];
		$objectVars  	 = unserialize(urldecode($_GET[5]));		
		eval('$objectResource = new ' . $objectVars["object"] . '(' . $resourceId . ');');
		
		eval('$objectResources = ' . $objectVars["object"] . 'Helper::retrieve' . $objectVars["object"] . 's("AND ' . $objectVars['field_prefix'] . '_resource_id = ' . $resourceId . ' AND ' . $objectVars['field_prefix'] . '_id = ' . $objectId . '");');
		foreach($objectResources as $objectResource)
			$objectResource->delete();
	break;	case 'addResourceRelation':
		$resourceId  = $_GET[1];
		$contentId   = $_GET[2];
		$fieldName   = $_GET[3];
		$resource	 = new Resource($resourceId);
		$typeId		 = $resource->__get('resource_type_id');
		if($_GET[4] == '1')
		{
			$contentResources = ContentResourceHelper::retrieveContentResources("AND content_id = " . escape($contentId) . " 
																	  			 AND content_resource_field_name = '" . escape($fieldName) . "'");
			foreach($contentResources as $contentResource)
				$contentResource->delete();
		}
		
		$contentResource = new ContentResource();
		$contentResource->__set('resource_id', $resourceId);
		$contentResource->__set('content_id', $contentId);
		$contentResource->__set('content_resource_field_name', $fieldName);
		$contentResource->save();
		
		$onclick = "SimpleAJAXCall('index.php?control_resource.controller/deleteResourceRelation/" . $resourceId . "/" . $contentId . "/" . $fieldName . "/" . $_GET[4] . "', ElementStateChanged, 'GET', 'resource" . $resourceId . "'); SimpleAJAXCall('index.php?control_resource.controller/refreshResourceList/" . $contentId . "/" . $fieldName . "/" . $_GET[4] . "/" . $typeId . "', ElementStateChanged, 'GET', '" . $fieldName . "'); ";
		$message = "[ quitar ]";
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
	break;
	break;	case 'addNCResourceRelation':
		$resourceId  = $_GET[1];
		$objectId    = $_GET[2];
		$fieldName   = $_GET[3];
		$objectVars	 = unserialize(urldecode($_GET[5]));
		eval('$resource	 = new ' . $objectVars["resource_object"] . '(' . $resourceId . ');');
		$typeId		 = $resource->__get('resource_type_id');
		if($_GET[4] == '1')
		{
			eval('$objectResources = ' . $objectVars["object"] . 'Helper::retrieve' . $objectVars["object"] . 's("AND ' . $objectVars["field_prefix"] . '_id = ' . escape($objectId) . ' 
																	  			 AND ' . $objectVars["field_prefix"] . '_resource_field_name = \'' . escape($fieldName) . '\'");');
			foreach($objectResources as $objectResource)
				$objectResource->delete();
		}
		
		eval('$objectResource = new ' . $objectVars["object"] . '();');
		$objectResource->__set('resource_id', $resourceId);
		$objectResource->__set($objectVars["field_prefix"] . '_id', $objectId);
		$objectResource->__set($objectVars["field_prefix"] . '_resource_field_name', $fieldName);
		$objectResource->save();
		
		$onclick = "SimpleAJAXCall('index.php?control_resource.controller/deleteNCResourceRelation/" . $resourceId . "/" . $objectId . "/" . $fieldName . "/" . $_GET[4] . "/" . $_GET[5] . "', ElementStateChanged, 'GET', 'resource" . $resourceId . "'); SimpleAJAXCall('index.php?control_resource.controller/refreshResourceList/" . $objectId . "/" . $fieldName . "/" . $_GET[4] . "/" . $typeId . "/" . $_GET[5] . "', ElementStateChanged, 'GET', '" . $fieldName . "'); ";
		$message = "[ quitar ]";
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
	break;	
	case 'addResourcesRelation':
		$key		 = $_GET[1];
		$contentId   = $_GET[2];
		$fieldName   = $_GET[3];
		
		$resources = ResourceHelper::retrieveResources("AND resource_upload_key = '" . $key . "'");
		foreach($resources as $resource)
		{
			$contentResource = new ContentResource();
			$contentResource->__set('resource_id', $resource->__get('resource_id'));
			$contentResource->__set('content_id', $contentId);
			$contentResource->__set('content_resource_field_name', $fieldName);
			$contentResource->save();
		}
	break;
	case 'addNCResourcesRelation':
		$key		 = $_GET[1];
		$contentId   = $_GET[2];
		$fieldName   = $_GET[3];
		$objectVars  = unserialize(urldecode($_GET[4]));		
		
		eval("$resources = " . $objectVars["resource_object"] . "Helper::retrieve" . $objectVars["resource_object"] . "s(\"AND resource_upload_key = '" . $key . "'\");");
		foreach($resources as $resource)
		{
			eval("$objectResource = new " . $objectVars["object"] . "();");
			$objectResource->__set('resource_id', $resource->__get('resource_id'));
			$objectResource->__set('content_id', $contentId);
			$objectResource->__set($objectVars["table_prefix"] . '_resource_field_name', $fieldName);
			$objectResource->save();
		}
	break;	
	case 'updateResource':
		$resource = new Resource($_POST['resource_id']);
		foreach($_POST as $key => $value)
			$resource->__set($key, $value);
		$resource->update();
	break;
	case 'updateNCResource':
		$objectVars = unserialize(urldecode($_POST['object_vars']));
		eval('$resource = new ' . $objectVars["resource_object"] . '(' . $_POST['resource_id'] . ');');
		foreach($_POST as $key => $value)
			$resource->__set($key, $value);
		$resource->update();
	break;
	case 'setOrder':
		$contentId = $_POST['contentId'];
		$fieldName = $_POST['fieldName'];
		if(isset($_POST['serializedArray']) && ($_POST['serializedArray'] != ''))
		{
			$resourcesArray = explode('&', $_POST['serializedArray']);
			$order		    = 1;
			foreach($resourcesArray as $resourceKey)
			{
				$resourceKeyArray = explode("=", $resourceKey);
				$contentResource  = new ContentResource($resourceKeyArray[1]);
				$contentResource->updateField('content_resource_order', $order);
				$order++;
			}			
		}
		$content = new Content($contentId);
		redirectUrl("index.php?content_expand.control/" . $content->__get('module_id') . "/" . $contentId);
	break;	
	case 'setOrderNC':
		$objectId  = $_POST['contentId'];
		$fieldName  = $_POST['fieldName'];
		$objectVars = unserialize(urldecode($_POST['object_vars']));
		if(isset($_POST['serializedArray']) && ($_POST['serializedArray'] != ''))
		{
			$resourcesArray = explode('&', $_POST['serializedArray']);
			$order		    = 1;
			foreach($resourcesArray as $resourceKey)
			{
				$resourceKeyArray = explode("=", $resourceKey);
				eval('$objectResource  = new ' . $objectVars["object"] . '(' . $resourceKeyArray[1] . ');');
				$objectResource->updateField($objectVars["field_prefix"] . '_resource_order', $order);
				$order++;
			}			
		}
		$content = new Content($contentId);
		redirectUrl("index.php?" . $objectVars["expand_page"] . ".control/" . $objectId);
	break;	
	case 'createThumbs':
		$folder = $_GET[1];
		$count  = 0;
		if ($handle = opendir('resources/images/')) 
		{
			while (($file = readdir($handle)) !== false) 
			{		
				if (is_file('resources/images/'.$file) && (!file_exists('resources/images/'.$folder.'/'.$file))) 
				{
					if (($file != '.') && ($file != '..')) 
					{
						$res = (count(explode('x',$folder)) > 1) ? explode('x',$folder) : explode('r',$folder) ;
						$width = $res[0];
						$height = $res[1];
						
						$image = new Image('resources/images/'.$file);
						$image->newSize = array($width, $height);
						if(($width != 0) && ($height != 0))
							$image->autocrop(true);
						else
							$image->resize();	
						$dest = 'resources/images/'.$folder.'/'.$file;
						$image->save($dest);
						$count++;
					}				
				}
			}
		}
		echo $count . ' thumbs were created in resources/images/' . $folder;		
	break;		
endswitch;
?>