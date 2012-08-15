<?php
$action  	 = isset($_POST['action']) ? $_POST['action'] : $_GET[0];
$controlUser = Security::validateSession();
switch ($action):
	case 'SentContact':	
		$newContact = new Content();
		foreach($_POST as $key => $value)
			$newContact->__set($key,$value);
		$newContact->__set('module_id',18);
		$newContact->__set('content_datetime_creation',$value);
		$newContact->__set('content_datetime_update',$value);
		$newContact->__set('content_state','A');
		$newContact->save();
		
		$html = "Se registro un contacto con la siguient informacion: <br />
				Nombres y apellidos: ".$_POST['content_varchar_1']."<br />
				E-mail: ".$_POST['content_varchar_2']."<br />
				Telefono: ".$_POST['content_varchar_3']."<br />
				Ciudad: ".$_POST['content_varchar_4']."<br />
				Empresa: ".$_POST['content_varchar_5']."<br />
				Comentarios : <p>".$_POST['content_text_1']."</p>";
		
				$args = array(	'to'	=> 'info@magdalenamedio.net',
							'from'    	=> 'info@ideko.net',
							'html'     	=> $html,
							'subject'  	=> 'Contacto',
							'fromName' 	=> 'IDEKO',
							'replyTo'  	=> 'info@magdalenamedio.net');	
		EmailHelper::sendMail($args);
		
		redirectUrl(APPLICATION_URL.'contact/Sent.html');
	break;
	
	case 'exportContact':
		$contents	  = ContentHelper::retrieveContents("AND module_id = 18 ORDER BY content_id DESC");
		$contentArray = array();
		foreach($contents as $content)
		{
			if($content->__get('content_varchar_1') != '')
			{
				$contentArray[] = array("Nombres y apellidos"  	=> $content->__get('content_varchar_1'),
										"E-mail"				=> $content->__get('content_varchar_2'),
										"Telefono"				=> $content->__get('content_varchar_3'),
										"Ciudad"				=> $content->__get('content_varchar_4'),
										"Empresa"				=> $content->__get('content_varchar_5'),
										"Comentarios"			=> $content->__get('content_text_1'));						
			}
		}
		ExcelHelper::export($contentArray);
	break;
endswitch
?>