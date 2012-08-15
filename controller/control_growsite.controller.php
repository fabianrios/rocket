<?php
$action  = isset($_POST['action']) ? $_POST['action'] : $_GET[0];
$session = Security::validateSession();
switch ($action):
	case 'create':
		$parent = new Growsite();
		$site   = new Growsite();
		$site->__set('site_name', 'Nuevo Sitio');
		$site->__set('site_state', 'I');
		$save = $site->save();
		$alert = array();
		$alert[0]['type'] = 'notification';
		$alert[0]['msg']  = 'Un nuevo sitio ha sido creado';
		$_GET[0] = $save["insert_id"];
		require_once(CONTROL_VIEW . 'growsite_expand.control.php');
	break;
	case 'update':
		$site   = new Growsite($_POST['site_id']);
		foreach($_POST as $key => $value)
			$site->__set($key, $value);
		//Logo
		if($_FILES["site_avatar"]["name"] != "")
		{
			$ext	= getFileExtension($_FILES["site_avatar"]['name']);
			$name 	= md5(date("YmdHis")) . $ext;
		
			if(uploadFile('resources/images/', $_FILES["site_avatar"]['tmp_name'], $name))
			{
				$accept = array('jpg', 'gif', 'png', 'jpeg');
				$medio 	= new Medio($name , $accept, 'resources/images/');  
				$site->__set('site_image', $name);						
			}				
		}				
		$save = $site->update();
		$alert = array();
		$_GET[0] =$_POST['site_id'];
		$alert[0]['type'] = 'notification';
		$alert[0]['msg']  = 'El sitio ha sido actualizado';		
		require_once(CONTROL_VIEW . 'growsite_expand.control.php');
	break;
	case 'changeState':
		$site 	= new Growsite($_GET[1]);
		$state	= ($site->__get('site_state') == 'A') ? 'I' : 'A';
		$response = ($site->__get('site_state') == 'A') ? 'Inactive |' : 'Active |';
		$site->__set('site_state', $state);
		$save = $site->update();			
		$alert[0]['type'] = 'notification';
		$alert[0]['msg']  = 'El estado del sitio ha sido cambiado';		
		$state_action = "SimpleAJAXCall('index.php?control_growsite.controller/changeState/".$site->__get('specie_id')."', updateAlert, 'GET', 'u_state_".$site->__get('specie_id')."');";
		$state_display = '<a href="javascript:void(0)" onClick="'.$state_action.'">'.$response.'</a>';
		echo  $state_display; 
		$alert = AlertHelper::placeAlerts($alert);	
	break;	
	case 'delete':
		$site = new Growsite($_GET[1]);
		$site->__set('site_state', 'D');
		$save = $site->update();		
		redirectUrl('index.php?growsite_list.control');			
	break;	
	case 'createResource':
		$parent 		  = new Growsite($_GET[1]);
		$siteResource   = new GrowsiteResource();
		$siteResource->__set('specie_resource_name', 'Nuevo Recurso');
		$siteResource->__set('specie_resource_type', $_GET[2]);
		$siteResource->__set('specie_resource_state', 'I');
		$siteResource->__set('specie_id', $_GET[1]);
		$save = $siteResource->save();
		$alert = array();
		$alert[0]['type'] = 'notification';
		$alert[0]['msg']  = 'Un nuevo recurso ha sido creado';
		$_GET[0] = $_GET[1];
		$_GET[1] = $save["insert_id"];
		require_once(CONTROL_VIEW . 'specie_resource_expand.control.php');
	break;
	case 'updateResource':
		$siteResource   = new GrowsiteResource($_POST['specie_resource_id']);
		foreach($_POST as $key => $value)
			$siteResource->__set($key, $value);
		//Logo
		if ($siteResource->__get('specie_resource_type') == 'I') 
		{
			if($_FILES["specie_resource"]["name"] != "")
			{
				$ext	= getFileExtension($_FILES["specie_resource"]['name']);
				$name 	= md5(date("YmdHis")) . $ext;
			
				if(uploadFile('resources/images/', $_FILES["specie_resource"]['tmp_name'], $name))
				{
					$accept = array('jpg', 'gif', 'png', 'jpeg');
					$medio 	= new Medio($name , $accept, 'resources/images/');  
					$siteResource->__set('specie_resource_file', $name);						
				}				
			}				
		}
		$save = $siteResource->update();
		$alert = array();
		$_GET[0] =$_POST['specie_id'];
		$_GET[1] =$_POST['specie_resource_id'];
		$alert[0]['type'] = 'notification';
		$alert[0]['msg']  = 'El recurso ha sido actualizado';		
		require_once(CONTROL_VIEW . 'specie_resource_expand.control.php');
	break;
	case 'changeStateResource':
		$siteResource 	= new GrowsiteResource($_GET[2]);
		$state				= ($siteResource->__get('specie_resource_state') == 'A') ? 'I' : 'A';
		$response 	= ($siteResource->__get('specie_resource_state') == 'A') ? 'Inactivo |' : 'Activo |';
		$siteResource->__set('specie_resource_state', $state);
		$save = $siteResource->update();			
		$alert[0]['type'] = 'notification';
		$alert[0]['msg']  = 'El estado del recurso ha sido cambiado';		
		$state_action = "SimpleAJAXCall('index.php?control_growsite.controller/changeStateResource/".$_GET[1]."/".$_GET[2]."', updateAlert, 'GET', 'u_state_".$siteResource->__get('specie_resource_id')."');";
		$state_display = '<a href="javascript:void(0)" onClick="'.$state_action.'">'.$response.'</a>';
		echo  $state_display; 
		$alert = AlertHelper::placeAlerts($alert);	
	break;	
	case 'deleteResource':
		$site = new GrowsiteResource($_GET[2]);
		$site->__set('specie_resource_state', 'D');
		$save = $site->update();		
		redirectUrl('index.php?growsite_expand.control/'.$_GET[1]);			
	break;		
endswitch;
?>