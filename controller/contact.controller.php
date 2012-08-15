<?php
$action 		= isset($_POST['action']) ? $_POST['action'] : $_GET[0];
switch ($action):

	case 'newContact':
		$newContact = new Content();
		//Guardo la información
		foreach($_POST as $key => $value)
			$newContact->__set($key,$value);
		$asunto = new Content($_POST['content_extra_varchar_1']); 
		$newContact->__set('content_extra_varchar_1',$asunto->__get('content_varchar_1'));
		$newContact->__set('content_datetime_creation',date('Y-m-d H:i:s'));
		$stateName	= new State($_POST['content_varchar_4']);
		$cityName	= new City($_POST['content_varchar_5']);
		$newContact->__set('content_varchar_4',$stateName->__get('state_name'));
		$newContact->__set('content_varchar_5',$cityName->__get('city_name'));
		
		$newContact->save();
		
		
		//Envio Mail
		$html = 'Datos Cont&aacute;ctenos: <br />
				Nombre completo: '.$_POST['content_varchar_1'].'<br />
				Correo electr&oacute;nico: '.$_POST['content_varchar_2'].'<br />
				Tel&eacute;fono: '.$_POST['content_varchar_3'].'<br />
				Departamento: '.$stateName->__get('state_name').'<br />
				Ciudad: '.$cityName->__get('city_name').'<br />
				Asunto: '.$asunto->__get('content_varchar_1').'<br />
				Mensaje: '.$_POST['content_text_1'].'<br />
				';
			$headers = "MIME-Version: 1.0\r\n"; 
			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";				
			$headers .= "From: Etipress <Etipress@Etipress.com>\r\n";
			mail($asunto->__get('content_varchar_2'),'Contacto Etipress',$html,$headers);
			
			redirectUrl(APPLICATION_URL.'contactenos/Sent.html');
	break;
	
	case 'newCotizacion':
		$newContact = new Content();
		//Guardo la información
		foreach($_POST as $key => $value)
			$newContact->__set($key,$value);
		$newContact->__set('content_datetime_creation',date('Y-m-d H:i:s'));
		$stateName	= new State($_POST['content_varchar_4']);
		$cityName	= new City($_POST['content_varchar_5']);
		$newContact->__set('content_varchar_4',$stateName->__get('state_name'));
		$newContact->__set('content_varchar_5',$cityName->__get('city_name'));
		$newContact->save();
		$listSentMails	= ContentHelper::retrieveContents(' AND content_parent = 20 AND content_state = "A"');
		//Envio Mail
		$html = 'Datos Cont&aacute;to: <br />
				Nombre completo: '.$_POST['content_varchar_1'].'<br />
				Correo electr&oacute;nico: '.$_POST['content_varchar_2'].'<br />
				Tel&eacute;fono: '.$_POST['content_varchar_3'].'<br />
				Departamento: '.$stateName->__get('state_name').'<br />
				Ciudad: '.$cityName->__get('city_name').'<br />
				Servicio: '.$_POST['content_extra_varchar_1'].'<br />
				Mensaje: '.$_POST['content_text_1'].'<br />
				';
			$headers = "MIME-Version: 1.0\r\n"; 
			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";				
			$headers .= "From: Etipress <Etipress@Etipress.com>\r\n";
			
		foreach($listSentMails as $listSentMail)	
			mail($listSentMail->__get('content_varchar_2'),'Cotizaci&oacute;n Etipress',$html,$headers);
			
		redirectUrl(APPLICATION_URL.'cotice_en_linea/Sent.html');
	break;
	
	case 'changeCity':
		header('Content-Type: text/html; charset=ISO-8859-1');
		$cities	= CityHelper::retrieveCities(' AND state_id = '.escape($_GET[1]).' ORDER BY city_name');
		?>
		<label>Ciudad:</label>
		<select title="Ciudad" name="content_varchar_5">
			<option value="NULL">-Seleccione-</option>
			<?php
			foreach($cities	as $city)
			{
				?>
				<option value="<?php echo $city->__get('city_id')?>"><?php echo $city->__get('city_name')?></option>
				<?php
			}
			?>
		</select>
		<?php
	break;
endswitch;