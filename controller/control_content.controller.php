<?php
$action  	 = isset($_POST['action']) ? $_POST['action'] : $_GET[0];
$controlUser = Security::validateSession();
switch ($action):
	case 'create':
		$content = new Content();
		$parentId = $_GET[2];
		if($parentId == 0)
			$level = 1;
		else
		{
			$parentContent = new  Content($parentId);
			$level 		   = $parentContent->__get('content_level') + 1; 
		}
		$content->__set('content_varchar_1', 'Contenido nuevo');
		$content->__set('content_url_id', 'contenido-nuevo');
		$content->__set('content_datetime_creation', formatDate());
		$content->__set('content_datetime_update', formatDate());
		$content->__set('content_level', $level);		
		$content->__set('content_state', 'I');		
		$content->__set('user_id', $controlUser->__get('user_id'));
		$content->__set('module_id', $_GET[1]);
		$content->__set('content_parent', $_GET[2]);		
		$content->__set('language_id', 1);	
		$save = $content->save();
		$id   = $save['insert_id'];
		redirectUrl('index.php?content_expand.control/' . $_GET[1] . '/' . $id);
	break;
	case 'update':
		$content = isset($_GET[2]) ? new Content($_GET[2]) : new Content();
		foreach($_POST as $key => $value)
			$content->__set($key, $value);
		$contentUrlId = ContentHelper::makeUrlId($content->__get('content_varchar_1'));
		$contentResult = ContentHelper::selectContents("AND content_url_id = '" . $contentUrlId . "' AND content_id != " . $content->__get('content_id'));
		if($contentResult["num_rows"] > 0)
		{
			$unique 	  = false;
			$count		  = 1;
			while(!$unique)
			{
				$newContentUrlId = $contentUrlId . '-' . $count;
				$contentResult = ContentHelper::selectContents("AND content_url_id = '" . $newContentUrlId . "' AND content_id != " . $content->__get('content_id'));
				if($contentResult["num_rows"] == 0)
				{
					$unique = true;
					$contentUrlId = $newContentUrlId;
				}
				$count++;
			} 
		}
		$content->__set('content_url_id', $contentUrlId);
		$fields = FieldHelper::retrieveFields( " AND module_id = " . $content->__get('module_id') . " ORDER by field_order");
		foreach ($fields as $field)
		{
			if ($field->__get('field_type') == 'checkbox') 		// CHECKBOXES
			{
				$fieldValue	= ',';
				$fieldName	= $field->__get('field_name');
				$options 	= $field->__get('field_options');
				$i			= 0;
				foreach (explode('|', $options) as $option)
				{			
					if(trim($option) != '')
					{				
						$option 	= explode("=>", $option);
						if (isset($_POST[$fieldName.'_'.$i]))
						{
							$fieldValue	.= $option[0].',';
						}
					}
					$i++;
				}
				$content->__set($fieldName, $fieldValue);
			}												    // / CHECKBOXES
		}
		$content->__set('content_datetime_update', formatDate());
		$result  = isset($_GET[2]) ? $content->update() : $content->save();
		$_GET[0] = $_GET[1];
		$_GET[1] = isset($_GET[2]) ? $_GET[2] : $result["insert_id"];
		$alert = array();
		$alert[0]['type'] = 'notification';
		$alert[0]['msg']  = (isset($_GET[2])) ? 'El contenido ha sido actualizado' : 'Un nuevo contenido ha sido creado';
		require_once(CONTROL_VIEW . 'content_expand.control.php');
	break;
	case 'changeState':
			$content  = new Content($_GET[1]);
			$state	  = ($content->__get('content_state') == 'A') ? 'I' : 'A';
			$response = ($content->__get('content_state') == 'A') ? 'Inactivo |' : 'Activo |';
			$content->__set('content_state', $state);
			$save = $content->update();			
			$alert[0]['type'] = 'notification';
			$alert[0]['msg']  = 'El estado del contenido ha sido cambiado';		
			$state_action = "SimpleAJAXCall('index.php?control_content.controller/changeState/".$content->__get('content_id')."', updateAlert, 'GET', 'u_state_".$content->__get('content_id')."');";
			$state_display = '<a href="javascript:void(0)" onClick="'.$state_action.'">'.$response.'</a>';
			echo  $state_display; 
			$alert = AlertHelper::placeAlerts($alert);	
	break;	
	case 'delete':
			$content 	= new Content($_GET[2]);
			$content->__set('content_state', 'D');
			$save = $content->update();		
			redirectUrl('index.php?content_list.control/' . $_GET[1]);			
	break;	
	case 'editField':
		$content   = new Content($_POST['content_id']);
		$fieldName = $_POST['fieldName'];
		$value	   = str_replace('||', '&', $_POST[$fieldName]);
		$content->__set($fieldName, $value);
		$content->__set('content_datetime_update', formatDate());
		$content->update();
	break;
	case 'orderContent':
			$content  = new Content($_POST['content_id']);
			$state	  = ($_POST['content_state'] == 'A') ? 'A' : 'I';
			$content->__set('content_state', $state);
			$save = $content->update();				
			$sites = ContentHelper::siteContent( " AND content_id = " . escape($_POST['content_id']));
			foreach ($sites as $site)
			{
				$site->delete();
			}
			$module = new Module($content->__get('module_id'));
			$type = $module->__get('module_site_connection');
			switch ($type):
				case 1:
					if (isset($_POST['site_id']))
					{
						$contentSite = new ContentSite();
						$contentSite->__set('content_id', $_POST['content_id']);
						$contentSite->__set('site_id', $_POST['site_id']);
					 	$contentSite->save();
					 }
				break;
				case 2:
					$sites = SiteHelper::retrieveSites(" ORDER BY site_id");
					foreach ($sites as $site)
					{
						if (isset($_POST['site_'.$site->__get('site_id')]))
						{
							$contentSite = new ContentSite();
							$contentSite->__set('content_id', $_POST['content_id']);
							$contentSite->__set('site_id',$_POST['site_'.$site->__get('site_id')]);
							$contentSite->save();							
						}
					}
				break;
			endswitch;
			redirectUrl('index.php?content_expand.control/' . $_GET[0] . '/' . $_POST['content_id']);
	break;
	case 'setOrder':
		$parentId = $_POST['parentId'];
		$moduleId = $_POST['moduleId'];
		if(isset($_POST['serializedArray']) && ($_POST['serializedArray'] != ''))
		{
			$contentsArray = explode('&', $_POST['serializedArray']);
			$order		   = 1;
			foreach($contentsArray as $contentKey)
			{
				$contentKeyArray = explode("=", $contentKey);
				$content	 = new Content($contentKeyArray[1]);
				$content->updateField('content_order', $order);
				$order++;
			}			
		}
		redirectUrl("index.php?content_list.control/" . $moduleId . "/" . $parentId);
	break;
	case 'addLanguageChild':
		$parentId 	= $_GET[1];
		$languageId = $_GET[2];
		$parent   = new Content($parentId);
		$parent->__set('language_parent', $parentId);
		$parent->__set('language_id', $languageId);
		$parent->__set('content_state', 'L');
		$save = $parent->save();
		redirectUrl("index.php?content_expand.control/" . $parent->__get('module_id') . "/" . $save["insert_id"]);
	break;
	case 'deleteLanguageChild':
		$contentId 	= $_GET[1];
		$content    = new Content($contentId);
		$parentId	= $content->__get('language_parent');
		$content->delete();
		redirectUrl("index.php?content_expand.control/" . $content->__get('module_id') . "/" . $parentId);
	break;	
endswitch
?>