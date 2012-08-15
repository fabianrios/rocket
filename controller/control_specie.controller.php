<?php
$action  = isset($_POST['action']) ? $_POST['action'] : $_GET[0];
$session = Security::validateSession();
switch ($action):
	case 'create':
		$parent = new Specie();
		$specie   = new Specie();
		$specie->__set('specie_name', 'Nueva Especie');
		$specie->__set('specie_state', 'I');
		$save = $specie->save();
		$alert = array();
		$alert[0]['type'] = 'notification';
		$alert[0]['msg']  = 'Una nueva especie ha sido creada';
		$_GET[0] = $save["insert_id"];
		require_once(CONTROL_VIEW . 'specie_expand.control.php');
	break;
	case 'update':
		$specie   = new Specie($_POST['specie_id']);
		foreach($_POST as $key => $value)
			$specie->__set($key, $value);
		//Logo
		if($_FILES["specie_avatar"]["name"] != "")
		{
			$ext	= getFileExtension($_FILES["specie_avatar"]['name']);
			$name 	= md5(date("YmdHis")) . $ext;
		
			if(uploadFile('resources/images/', $_FILES["specie_avatar"]['tmp_name'], $name))
			{
				$accept = array('jpg', 'gif', 'png', 'jpeg');
				$medio 	= new Medio($name , $accept, 'resources/images/');  
				$specie->__set('specie_image', $name);						
			}				
		}				
		$save = $specie->update();
		$alert = array();
		$_GET[0] =$_POST['specie_id'];
		$alert[0]['type'] = 'notification';
		$alert[0]['msg']  = 'La especie ha sido actualizada';		
		require_once(CONTROL_VIEW . 'specie_expand.control.php');
	break;
	case 'changeState':
		$specie 	= new Specie($_GET[1]);
		$state	= ($specie->__get('specie_state') == 'A') ? 'I' : 'A';
		$response = ($specie->__get('specie_state') == 'A') ? 'Inactive |' : 'Active |';
		$specie->__set('specie_state', $state);
		$save = $specie->update();			
		$alert[0]['type'] = 'notification';
		$alert[0]['msg']  = 'El estado de la especie ha sido cambiado';		
		$state_action = "SimpleAJAXCall('index.php?control_specie.controller/changeState/".$specie->__get('specie_id')."', updateAlert, 'GET', 'u_state_".$specie->__get('specie_id')."');";
		$state_display = '<a href="javascript:void(0)" onClick="'.$state_action.'">'.$response.'</a>';
		echo  $state_display; 
		$alert = AlertHelper::placeAlerts($alert);	
	break;	
	case 'delete':
		$specie = new Specie($_GET[1]);
		$specie->__set('specie_state', 'D');
		$save = $specie->update();		
		redirectUrl('index.php?especies_list.control');			
	break;	
	case 'createResource':
//		$parent 		  = new Specie($_GET[1]);
		$specieResource   = new SpecieResource();
		$specieResource->__set('specie_resource_name', 'Nuevo Recurso');
		$specieResource->__set('specie_resource_type', $_GET[2]);
		$specieResource->__set('specie_resource_state', 'I');
		$specieResource->__set('specie_id', $_GET[1]);
		$save = $specieResource->save();
		$alert = array();
		$alert[0]['type'] = 'notification';
		$alert[0]['msg']  = 'Un nuevo recurso ha sido creado';
		$_GET[0] = $_GET[1];
		$_GET[1] = $save["insert_id"];
		require_once(CONTROL_VIEW . 'specie_resource_expand.control.php');
	break;
	case 'updateResource':
		$specieResource   = new SpecieResource($_POST['specie_resource_id']);
		foreach($_POST as $key => $value)
			$specieResource->__set($key, $value);
		//Logo
		if ($specieResource->__get('specie_resource_type') == 'I') 
		{
			if($_FILES["specie_resource"]["name"] != "")
			{
				$ext	= getFileExtension($_FILES["specie_resource"]['name']);
				$name 	= md5(date("YmdHis")) . $ext;
			
				if(uploadFile('resources/images/', $_FILES["specie_resource"]['tmp_name'], $name))
				{
					$accept = array('jpg', 'gif', 'png', 'jpeg');
					$medio 	= new Medio($name , $accept, 'resources/images/');  
					$specieResource->__set('specie_resource_file', $name);						
				}				
			}				
		}
		$save = $specieResource->update();
		$alert = array();
		$_GET[0] =$_POST['specie_id'];
		$_GET[1] =$_POST['specie_resource_id'];
		$alert[0]['type'] = 'notification';
		$alert[0]['msg']  = 'El recurso ha sido actualizado';		
		require_once(CONTROL_VIEW . 'specie_resource_expand.control.php');
	break;
	case 'changeStateResource':
		$specieResource 	= new SpecieResource($_GET[2]);
		$state				= ($specieResource->__get('specie_resource_state') == 'A') ? 'I' : 'A';
		$response 	= ($specieResource->__get('specie_resource_state') == 'A') ? 'Inactivo |' : 'Activo |';
		$specieResource->__set('specie_resource_state', $state);
		$save = $specieResource->update();			
		$alert[0]['type'] = 'notification';
		$alert[0]['msg']  = 'El estado del recurso ha sido cambiado';		
		$state_action = "SimpleAJAXCall('index.php?control_specie.controller/changeStateResource/".$_GET[1]."/".$_GET[2]."', updateAlert, 'GET', 'u_state_".$specieResource->__get('specie_resource_id')."');";
		$state_display = '<a href="javascript:void(0)" onClick="'.$state_action.'">'.$response.'</a>';
		echo  $state_display; 
		$alert = AlertHelper::placeAlerts($alert);	
	break;	
	case 'deleteResource':
		$specie = new SpecieResource($_GET[2]);
		$specie->__set('specie_resource_state', 'D');
		$save = $specie->update();		
		redirectUrl('index.php?specie_expand.control/'.$_GET[1]);			
	break;		
	
	
	case 'updateTree':

		if((isset($_FILES['admitteds'])) && ($_FILES['admitteds']['name'] != ''))
		{
			$ext = getFileExtension($_FILES['admitteds']['name']);
			if(($ext == '.xls') || ($ext == '.xlsx'))
			{
				$fileName = md5(formatDate()) . $ext;

				if(uploadFile('resources/files/', $_FILES['admitteds']['tmp_name'], $fileName))
				{
					redirectUrl("index.php?control_specie.controller/processTrees/" . $fileName . "/0");
				}
				else
					redirectUrl('index.php?tree_list.control');
			}
			else
				redirectUrl('index.php?tree_list.control');
		}
	break;	

	case 'processTrees':

		$fileName 					  = $_GET[1];

		$excel       	  	   		  = new Excel('resources/files/' . $fileName, true);

		$excel->populate();
		
		$trees       		  = $excel->getMatrix();

		sort($trees);
		$treesInitialCount  = isset($_GET[2]) ? $_GET[2] : 0;

		$treesCount  		  = $treesInitialCount;

		for($i = $treesCount; $i < count($trees); $i++)
		{
			if(isset($trees[$i][1]) && ($trees[$i][1] != ''))
			{
				$admitted  =& $trees[$i];
				$newdate	= 'NULL';
				//Transformo la fecha a formato y-m-d
				if(isset($admitted[3]))
				{
					if(strlen(trim($admitted[3])) >0)
					{
						$divdate 	= mktime(0,0,0, 01,01,1900) + (($admitted[3]-1) * 24 * 60 * 60);
						$newdate	=date("Y-m-d",$divdate);
					}
					else 
						$newdate	= 'NULL';
				}
				//$deleteUsers	= BirthdayHelper::deleteBirthdays(' AND birthday_name LIKE "%'.trim($admitted[1]).'%"');
				//if(strlen(trim($admitted[3]))>0)
				//	$deleteUsers	= BirthdayHelper::deleteBirthdays(' AND birthday_email LIKE "'.trim($admitted[3]).'"');
				
				$admitted[1] = isset($admitted[1]) ? $admitted[1] : '';
				$admitted[2] = isset($admitted[2]) ? $admitted[2] : '';
				
				$admitted1 = new Tree();
				$admitted1->__set('specie_id', $admitted[1]);
				$admitted1->__set('planting_id', $admitted[2]);
				$admitted1->__set('user_id', 0);
				$admitted1->__set('tree_date_planting', $newdate);
				$admitted1->save();
				//echo $admitted[1].'<br />';
				if($i == ($treesInitialCount + 100))
				{
					?>
					<script language="javascript">
						window.location.href = 'index.php?control_birthday.controller/processBirthday/<?=$fileName?>/<?=($i+1)?>';
					</script>
					<?php
					die();
				}
			}
		}
		redirectUrl("index.php?tree_list.control");
	break;
	
endswitch;
?>