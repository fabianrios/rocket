<?php 

	class Stmp 

	{

		private $stmp; 									//OBJECT 

		private $boundary; 								//BOUNDARY

		public $eventHandlers;

		

		public function __construct($to, $from, $subject) 

		{ 

			$this->stmp = array('to'       => $to, 		//Recipient email address

								'toName'   => '',  		//Recipient Name

								'from'     => $from, 	//Sender email address

								'fromName' => '', 		//Sender Name

								'replyTo' => '', 		//Reply-To email Address

								'replyToName' => '', 	//Reply-To Name

								'subject'  => $subject, //Subject

								'html'     => '', 		//HTML version of mail

								'plain'    => '', 		//PLAIN version of mail 

								'log'      => 0, 		//LOG IN DB MAIL SENT OR FAILED	

								'trace'    => 0, 		//TRACE FOR VIEW AND CLICK

								'headers'  => '');		//E-mail Headers

			$this->boundary = uniqid('montana');

			

			RegisterEventHandlers($this);

		}

		

		public function __get($field) 

		{

			if (array_key_exists($field, $this->stmp)) 

				return $this->stmp[$field];

		}

		

		public function __set($field, $value) 

		{

			if (array_key_exists($field, $this->stmp)) 

				$this->stmp[$field] = $value;	

		}

		

		private function doHeaders() 

		{ 

			$headers = '';	

			/*if ($this->stmp['toName'] != '') 							//TO HEADERES

				$headers .= "To: ".$this->stmp['toName']." <".$this->stmp['to'].">\r\n";

			else 

				$headers .= "To: ".$this->stmp['to']."\r\n";*/

			$headers .= "Subject: ".$this->stmp['subject']." \r\n";		//SUBJECT

			$headers .= "Sender: ".$this->stmp['from']." \r\n";		//SENDER

			if ($this->stmp['fromName'] != '') 							//FROM HEADERS

				$headers .= "From: ".$this->stmp['fromName']." <".$this->stmp['from'].">\r\n";

			else 

				$headers .= "From: ".$this->stmp['from']."\r\n";	

			/*if ($this->stmp['replyTo'] != '') 							//REPLY-TO 

			{ 

				if ($this->stmp['replyToName'] != '') 

					$headers .= "Reply-To: ".$this->stmp['replyToName']." <".$this->stmp['replyTo']."> \r\n";

				else

					$headers .= "Reply-To: ".$this->stmp['replyTo']." \r\n";			

			}*/

			$headers .= "MIME-Version: 1.0\r\n";

			$headers .= "Content-Type: multipart/mixed; boundary=" . $this->boundary . "\r\n\r\n";

			return ($headers);

		}

		

		private function doBody() 

		{

			$body = 'This is a MIME encoded message.';

			if 	($this->stmp['html'] != '')							//HTML

			{

				$body .= "\r\n\r\n--". $this->boundary ."\r\n" .

				   "Content-Type: text/html; charset=ISO-8859-1\r\n" .

				   "Content-Transfer-Encoding: base64\r\n\r\n";

				$body .= chunk_split(base64_encode($this->stmp['html']));			

			}

			if  ($this->stmp['plain'] != '')						//PLAIN

			{

				$body .= "\r\n\r\n--". $this->boundary ."\r\n" .

				   "Content-Type: text/html; charset=ISO-8859-1\r\n" .

				   "Content-Transfer-Encoding: base64\r\n\r\n";

				$body .= chunk_split(base64_encode($this->stmp['plain']));			

			}

			return $body;

		}

		

		public function send() 

		{ 

			$headers = $this->doHeaders();

			$body = $this->doBody();

			return $this->sendMail($headers, $body);

		}		

		

		private function sendMail($headers, $body) 

		{

			if (mail($this->stmp['to'], $this->stmp['subject'], $body, $headers))

			{

				//TriggerEvent('OnMailSend', array('action' => 'mailSent', 'type' => 3, 'user_id' => USER_ID), $this);					

				return true;

			}

			else

			{

				//TriggerEvent('OnMailSend', array('action' => 'mailFailed', 'type' => 3, 'user_id' => USER_ID), $this);			

				return false;

			}

		}

	}

	

	/*$mail = new Mail('bernardo.restrepo@magdalenamedio.net', 'casatoro@corp.magdalenamedio.net', 'Prueba de correo');

	$mail->__set('fromName', 'Magdalena Medio Bogota');

	$mail->__set('toName', 'Andres');

	$mail->__set('replyTo', 'felipe.machado@magdalenamedio.net');

	$mail->__set('replyToName', 'Felipe Machado Luna');

	$html = "<body>" .

			"	<table width='200' cellpadding='0' cellspacing='0' border='0' bgcolor='#000000'>" .

			"	  <tr>" .

			"		<td rowspan='4' valign='top'><img src='images/chacha_mail_1.jpg' /></td>" .

			"		<td valign='top'><img src='images/chacha_mail_2.jpg' /></td>" .

			"	  </tr>" .

			"	  <tr>" .

			"		<td valign='top'><img src='images/chacha_mail_3.jpg' /></td>" .

			"	  </tr>" .

			"	  <tr>" .

			"		<td bgcolor='#000000'>" .

			"		<font color='#33CCFF' face='Arial' size='3'><strong>Nicolas Nieto,</strong></font><br />" .

			"		<font color='#999999' face='Arial' size='-1'>Has sido invitado a conocer www.elchacha.com</font><br />" .

			"		</td>" .

			"	  </tr>" .

			"	  <tr>" .

			"		<td valign='bottom'><img src='images/chacha_mail_4.jpg' /></td>" .

			"	  </tr>" .

			"	</table>" .

			"</body>";

	$mail->__set('html', $html);

	if ($mail->send())

		echo ('sent');*/



?>

