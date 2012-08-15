<?php
$action = isset($_POST['action']) ? $_POST['action'] : $_GET[0];
switch ($action):
	case 'update':
		$session = Security::validateSession();
		if ($session)
		{
			$metaTag = (isset($_POST['meta_tag_id'])) ? new MetaTag($_POST['meta_tag_id']) : new MetaTag();
			foreach ($_POST as $key => $value)
				$metaTag->__set($key, $value);
			if (isset($_POST['meta_tag_id']))
				$metaTag->update();
			else 
				$save = $metaTag->save();
			$_GET[0] = (isset($_POST['meta_tag_id'])) ? $_POST['meta_tag_id'] : $save['insert_id'];
	 
			$alert = array();
			$alert[0]['type'] = 'notification';
			$alert[0]['msg']  = (isset($_POST['meta_tag_id'])) ? 'El meta tag ha sido actualizado' : 'Un nuevo meta tag ha sido creado';
			if (isset($_POST['content_id']))
			{
				$content = new Content($_POST['content_id']);
				$_GET[0] = $content->__get('module_id');
				$_GET[1] = $content->__get('content_id');		
				require_once(CONTROL_VIEW . 'content_expand.control.php');
			}
			else
				require_once(CONTROL_VIEW . 'seo_expand.control.php');
		}
	break;
endswitch;
?>