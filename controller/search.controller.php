<?php
$action = isset($_POST['action']) ? $_POST['action'] : $_GET[0];
switch ($action):
	case 'keyWord':
		unset($_SESSION['results_id']);
		$_SESSION['results_id'] = '0';
		$contentIdArray = array();
		//Buscando Servicios
			/*NOMBRES*/
		$contents = ContentHelper::selectContents(' AND content_parent = 4 AND content_state = "A" AND content_varchar_1 LIKE "%'.trim(escape($_POST['searchKeyWord'])).'%"');
		while($contentRow = mysql_fetch_assoc($contents["query"]))
			$contentIdArray[$contentRow["content_id"]] = $contentRow["content_id"];
			/*DESCRIPCION*/
		$contents = ContentHelper::selectContents(' AND content_parent = 4 AND content_state = "A" AND content_text_1 LIKE "%'.trim(escape($_POST['searchKeyWord'])).'%"');
		while($contentRow = mysql_fetch_assoc($contents["query"]))
			$contentIdArray[$contentRow["content_id"]] = $contentRow["content_id"];	
			
		//Buscando Casos
			/*NOMBRES*/
		$contents = ContentHelper::selectContents(' AND content_parent = 5 AND content_state = "A" AND content_varchar_1 LIKE "%'.trim(escape($_POST['searchKeyWord'])).'%"');
		while($contentRow = mysql_fetch_assoc($contents["query"]))
			$contentIdArray[$contentRow["content_id"]] = $contentRow["content_id"];
			/*DESCRIPCION*/
		$contents = ContentHelper::selectContents(' AND content_parent = 5 AND content_state = "A" AND content_text_1 LIKE "%'.trim(escape($_POST['searchKeyWord'])).'%"');
		while($contentRow = mysql_fetch_assoc($contents["query"]))
			$contentIdArray[$contentRow["content_id"]] = $contentRow["content_id"];	
			
		/*Buscando Glosario
			/*NOMBRES*
		$contents = ContentHelper::selectContents(' AND module_id = 10 AND content_level = 3 AND content_state = "A" AND content_varchar_1 LIKE "%'.trim(escape($_POST['searchKeyWord'])).'%"');
		while($contentRow = mysql_fetch_assoc($contents["query"]))
			$contentIdArray[$contentRow["content_id"]] = $contentRow["content_id"];
			/*DESCRIPCION*
		$contents = ContentHelper::selectContents(' AND module_id = 10 AND content_level = 3 AND content_state = "A" AND content_text_1 LIKE "%'.trim(escape($_POST['searchKeyWord'])).'%"');
		while($contentRow = mysql_fetch_assoc($contents["query"]))
			$contentIdArray[$contentRow["content_id"]] = $contentRow["content_id"];	*/
		foreach($contentIdArray as $valueId)
			$_SESSION['results_id'] .= ','.$valueId;
		unset($contentIdArray);
		redirectUrl(APPLICATION_URL.'resultados.html');
	break;
endswitch;
?>