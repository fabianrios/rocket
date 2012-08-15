<?php
header('Content-Type: text/html; charset=ISO-8859-1'); 
$action  	 = isset($_POST['action']) ? $_POST['action'] : $_GET[0];

switch ($action):
	case 'deleteContentRelation':
		$content_id_1 	= $_GET[1];
		$content_id		= $_GET[2];
		$relationship	= $_GET[3];
		$module_id	 	= $_GET[4]; 
		$type			= $_GET[5];
		$field_id		= $_GET[6];
		$name			= $_GET[7];
	
		$content		= new  Content($content_id_1);
		ContentRelationHelper::deleteContentRelation($content_id_1,$relationship);

		$onclick = "SimpleAJAXCall('index.php?control_content_related.controller/addContentRelation/" . $content_id_1 . "/" . $content_id . "/" . $relationship . "/" . $module_id . "/" . $type . "/" . $field_id . "/" . $name . "', ElementStateChanged, 'GET', 'content" . $content_id_1 . "'); SimpleAJAXCall('index.php?control_content_related.controller/refreshContentList/" . $content_id_1 . "/" . $content_id . "/" . $type  . "/" . $field_id . "/" . $name . "/" . $module_id . "/" . $relationship . "', ElementStateChanged, 'GET', '" . $name . "'); ";
		$message = $content->__get('content_varchar_1') . "[ agregar ]";
						
		?>
		<li id="content<?=$content->__get('content_id')?>"><a href="javascript:void(0);" onclick="<?=$onclick?>"><span><?=$content->__get('content_name')?></span><span id="rstatus_<?=$content->__get('content_id')?>"><?=$message?></span></a></li>
		<?php 	
	break;
	case 'addContentRelation':
		$content_id_1 	= $_GET[1];
		$content_id		= $_GET[2];
		$relationship	= $_GET[3];
		$module_id	 	= $_GET[4]; 
		$type			= $_GET[5];
		$field_id		= $_GET[6];
		$name			= $_GET[7];
		
		if($type != 0)
			ContentRelationHelper::deleteFullContentRelation($content_id,$relationship);	
		
		$content		= new  Content($content_id_1);
		ContentRelationHelper::insertContentRelation($content_id,$content_id_1,$relationship);
		
		$onclick = "SimpleAJAXCall('index.php?control_content_related.controller/deleteContentRelation/" . $content_id_1 . "/" . $content_id . "/" . $relationship . "/" . $module_id . "/" . $type . "/" . $field_id . "/" . $name . "', ElementStateChanged, 'GET', 'content" . $content_id_1 . "'); SimpleAJAXCall('index.php?control_content_related.controller/refreshContentList/" . $content_id_1 . "/" . $content_id . "/" . $type  . "/" . $field_id . "/" . $name . "/" . $module_id . "/" . $relationship . "', ElementStateChanged, 'GET', '" . $name . "');";
		$message = $content->__get('content_varchar_1') . "[ quitar ]";
		
		
						
		?>
		<li id="content<?=$content->__get('content_id')?>"><a href="javascript:void(0);" onclick="<?=$onclick?>"><span><?=$content->__get('content_name')?></span><span id="rstatus_<?=$content->__get('content_id')?>"><?=$message?></span></a></li>
		<?php 	
		
		
		break;
		case 'refreshContentList':
		$form 	= new Form('', '', $_GET[2],'');
		$form->putField('content_gallery', $_GET[5], '', $_GET[3] . '|' . $_GET[6] . '|' . $_GET[7],$_GET[4]);
		//putField($type, $name, $value="", $options="", $field_id = '', $field_class='');
		break;
		
		case 'deleteContentRelation1':
		$content_id_1  	 = $_GET[1];
		$type   	 	 = $_GET[3];

		ContentRelationHelper::deleteContentRelation($content_id_1,$type);
		break;
		
endswitch;