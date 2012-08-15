<?php
	class EmailHelper 
	{
		public static function sendMail($args)
		{	
	
			$mail = new Stmp($args['to'],$args['from'],$args['subject']);
			
			$mail->__set('fromName', $args['fromName']);
			$mail->__set('replyTo', $args['replyTo']);
			$mail->__set('html', $args['html']);
			
			if($mail->send())
				return true;
			else
				return false;		
		}

		public static function resetPassword($args)
		{	
			$mail = new Stmp($args['email'],'incube@magdalenamedio.net','Incube');
			
			$mail->__set('fromName', 'Incube');
			$mail->__set('replyTo', 'admin@incube.com');
			
			$html ="
				   <body>
					<img src='http://incube.com.co/img/logo.gif' width='282' height='91' alt='Incube.com.co'/>
						<p>
							<font face='Georgia, Times New Roman, Times, serif'>
								".$args['name']." ".$args['lastName'].", se ha reseteado el password 
								tu nuevo password es: . <br/>
								".$args['password']."
							</font>
						</p>
						<font face='Georgia, Times New Roman, Times, serif'>
							<p>Para acceder, ház clic en el siguiente vinculo:</p>
							<p>
								<a href='http://www.magdalenamedio.net/examples/incube/index.php'>
									http://www.magdalenamedio.net/examples/incube/index.php</a>
							</p>
						<p>Incube Producciones</p>
						</font>
					</body>	";
			$mail->__set('html', $html);
			
			if($mail->send())
				return true;
			else
				return false;
		}

		public static function mailRequestKeyNote($args)
		{	
			
			$mail = new Stmp($args['emailTo'],'incube@magdalenamedio.net','Incube');
			
			$mail->__set('fromName', 'Incube');
			$mail->__set('replyTo', 'admin@incube.com');

			$html ="
				   <body>
					<img src='http://www.magdalenamedio.net/examples/incube/img/logo.gif' width='282' height='91' alt='Incube.com'/>
						<p>
							<font face='Georgia, Times New Roman, Times, serif'>
								".$args['name']." ".$args['lastName'].", ha  solicitado el siguiente KeyNote :
								<br/> ".$args['keyName']."<br/>
								para contactar con el interesado en el siguiente email : 
								<br/>".$args['emailFrom']."<br/> 
							</font>
						</p>
					</body>	";
					
			$mail->__set('html', $html);
			
			if($mail->send())
				return true;
			else
				return false;		
		}
		
		public static function mailSendPassword($args)
		{	
			$mail = new Stmp($args['email'],'incube@magdalenamedio.net','Incube');
			
			$mail->__set('fromName', 'Incube');
			$mail->__set('replyTo', 'admin@incube.com');
			
			$html ="
				   <body>
					<img src='http://www.incube.com.co/img/logo.gif' width='282' height='91' alt='Incube.com.co'/>
						<p>
							<font face='Georgia, Times New Roman, Times, serif'>
								".$args['name']." ".$args['lastName'].", se ha generado un nuevo password 
								tu nuevo password es: . <br/>
								".$args['password']."
							</font>
						</p>
						<font face='Georgia, Times New Roman, Times, serif'>
							<p>Para acceder, h&aacute;z clic en el siguiente vinculo:</p>
							<p>
								<a href='http://www.magdalenamedio.net/examples/incube/index.php'>
									http://www.magdalenamedio.net/examples/incube/index.php</a>
							</p>
						<p>Incube Producciones</p>
						</font>
					</body>	";
			$mail->__set('html', $html);
			if($mail->send())
				return true;
			else
				return false;
		}

	}
?>