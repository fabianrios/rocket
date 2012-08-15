<?php
$action = isset($_POST['action']) ? $_POST['action'] : $_GET[0];
Security::validateSession();
switch ($action):
	case 'FormSent':
		?>
		<iframe name="sentframe" style="display:none"></iframe>
		<a href="javascript:void(0);" onclick="document.getElementById('TB_overlay').style.display = 'none';document.getElementById('window01').style.display = 'none';" title="Cerrar esta ventana" class="window-close">Cerrar</a>
		<h4>Enviar por correo electr&oacute;nico</h4>
		  <form class="window-form" id="validable" action="<?php echo APPLICATION_URL?>control_sent.controller.html" method="post" target="sentframe">
			  <fieldset>
				  <legend>Llene sus datos y los de su contacto para enviar esta informaci&oacute;n</legend>
				  <div class="window-form-div">
					  <label>Su nombre</label>
					  <input title="Su nombre" name="product_share_name" type="text" class="window-form-text" />
				  </div><!--window-form-div-->
				  <div class="window-form-div">
					  <label>Su e-mail</label>
					  <input title="Su e-mail" name="product_share_email" type="text" class="window-form-text email" />
				  </div><!--window-form-div-->
				  <div class="window-form-div">
					  <label>Nombre destinatario</label>
					  <input title="Nombre destinatario" name="product_share_recipient" type="text" class="window-form-text" />
				  </div><!--window-form-div-->
				  <div class="window-form-div">
					  <label>E-mail destinatario</label>
					  <input title="E-mail destinatario" name="product_share_email_recipient" type="text" class="window-form-text" />
				  </div><!--window-form-div-->
				  <div class="window-form-div">
					  <label>Mensaje adicional</label>
					  <textarea title="Mensaje adicional" name="product_share_Message" cols="" rows="5" class="window-form-textarea notValidable"></textarea>
				  </div><!--window-form-div-->
				  <div class="window-form-buttons clearfix">
				  	<input type="hidden" name="action" value="sentForm" />
					<input type="submit" class="but-orange-128-39" value="Enviar"/>
					<a href="javascript:void(0);" onclick="document.getElementById('TB_overlay').style.display = 'none';document.getElementById('window01').style.display = 'none';" title="cancelar">cancelar</a>
				  </div><!--window-form-buttons-->
			  </fieldset>
		  </form><!--window-form-->		
		  <?php 
	break;
	
	case 'otherEmail':
		?>
		<a href="javascript:void(0);" onclick="document.getElementById('TB_overlay').style.display = 'none';document.getElementById('window01').style.display = 'none';" title="Cerrar esta ventana" class="window-close">Cerrar</a>
		<h4>Enviar por correo electr&oacute;nico</h4>
		  <div class="window-simple">
			<p>El correo ha sido enviado</p>
			<p class="centered-links"><a href="javascript:void(0);" onclick="SimpleAJAXCall('<?php echo APPLICATION_URL?>control_sent.controller/FormSent.html', ElementStateChanged, 'GET', 'window01');" title="Enviar otro correo">Enviar otro correo</a><a href="javascript:void(0);" onclick="document.getElementById('TB_overlay').style.display = 'none';document.getElementById('window01').style.display = 'none';" title="Cerrar">Cerrar</a></p>
		</div><!--window-simple-->
		<?php
	break;
	 
	case 'sentForm':
		$newSent = new ProductShare();
		foreach($_POST as $key => $value)
			$newSent->__set($key,$value);
		$newSent->save();
		$html = $_POST['product_share_name'].' te recomendo. <a target="_blank" href = "'.APPLICATION_FULL_URL.'"> IDEKO </a> <br /><br />'.$_POST['product_share_Message'];
		
				$args = array(	'to'	=> 'info@magdalenamedio.net',
							'from'    	=> $_POST['product_share_email_recipient'],
							'html'     	=> $html,
							'subject'  	=> 'te recomendaron IDEKO',
							'fromName' 	=> 'IDEKO',
							'replyTo'  	=> 'info@magdalenamedio.net');	
		EmailHelper::sendMail($args);
		?>
		<script src="<?php echo APPLICATION_URL?>js/prototype.js" type="text/javascript"></script>
		<script src="<?php echo APPLICATION_URL?>js/ajax_helper.js" type="text/javascript"></script>
		<script src="<?php echo APPLICATION_URL?>js/ajax_lib.js" type="text/javascript"></script>
		<script language="javascript">
			SimpleAJAXCall('<?php echo APPLICATION_URL?>control_sent.controller/otherEmail.html', parent.ElementStateChanged, 'GET', 'window01');
		</script> 
		<?php  
	break;
	
endswitch;