<?php
$action  	 = isset($_POST['action']) ? $_POST['action'] : $_GET[0];
switch ($action):
	case 'readfirstfile':
	
		if($_FILES['resource_file']['name'] != '')
		{
			$ext = getFileExtension($_FILES['resource_file']['name']);
			$name = md5(date("YmdHis")) . $ext;		
			if(uploadFile('resources/', $_FILES['resource_file']['tmp_name'], $name))
			{			
				$file		= 'resources/'.$name;
				$fp 		= fopen($file, 'r');		
				$lastline	= '';
				while ( ($line = fgets($fp)) !== false) {
				  $lastline = $line;
				}
				echo 
				$hato	= new Hato();		
				$hato->__set('hato_codigo',substr($lastline, 1, 6));
				$hato->__set('hato_nombre',substr($lastline, 7, 30));
				$hato->__set('hato_propietario',substr($lastline, 37, 50));
				$hato->save();
			}
		}
		//redirectURL('index.php?usuarios.admin');
	break;
endswitch
?>