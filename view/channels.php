<?php
$options = "1=>OFICINA|2=>CAJERO| 3=>CNB| 4=>CENTRO DE RECAUDO| 5=>GRANDES SUPERFICIES| 6=>OTROS CENTROS FISICOS| 7=>AUDIORESPUESTA| 8=>BANCAMOVIL| 9=>DEBITOS AUTOMATICOS| 10=>PSE| 11=>INTERNET";
$optionArray = explode('|', $options);
$order = new Order($this->orderId);
$validable = ($order->__get('order_skip') == '0') ? "validable" : "notValidable"; 
?>

<br />
<br />	
<div class="row"> <!-- row -->
<div class="eleven columns centered clearfix">

	
	<div class="four columns">
		<div class="bluebox" id="channelPanel1">
		<div class="padding-10">			
			<label class="whitetxt text-center txt-shadow-black"><strong>Canal 1</strong></label>
			<div class="row">
				    <select name="usuario_canal_preferido_1" onchange="if(this.value == 1) { $('#employmentPanel2').show(); $('#employmentPanel3').hide();} else if(this.value == 5) { $('#employmentPanel2').hide(); $('#employmentPanel3').show();}" class="userdata <?php echo $validable?>" title="Por favor lista los 3 canales que mas te gustaría utilizar para pagar tu crédito en orden de importancia" id="channel">
				    	<option value="NULL">Seleccione</option>
				    	<?php
				    	foreach($optionArray as $option)
						{
							$values = explode('=>', $option);
							?>
							<option value="<?php echo $values[0]?>"><?php echo $values[1]?></option>
							<?php
						}
						?>
				    </select>
			</div>
		</div>						
		</div>
		<div class="blue-shadow"><img src="<?php echo APPLICATION_URL?>images/shadow-bluebox.png" alt="" width="" height=""></div>
	</div>
	
	
	<div class="four columns">

		<div class="bluebox centered" id="channelPanel2">
		<div class="padding-10">		
			<label class="whitetxt text-center txt-shadow-black"><strong>Canal 2</strong></label>
				<div class="row">
				
				    <select class="userdata" name="usuario_canal_preferido_2" onchange="">
				    	<option value"0">Seleccione</option>
				    	<?php
				    	foreach($optionArray as $option)
						{
							$values = explode('=>', $option);
							?>
							<option value="<?php echo $values[0]?>"><?php echo $values[1]?></option>
							<?php
						}
						?>
				    </select>
					
				</div>
			</div>
			</div>
			<div class="blue-shadow"><img src="<?php echo APPLICATION_URL?>images/shadow-bluebox.png" alt="" width="" height=""></div>
	</div>
	
	<div class="four columns">

		<div class="bluebox centered" id="channelPanel3">
		<div class="padding-10">		
			<label class="whitetxt text-center txt-shadow-black"><strong>Canal 3</strong></label>
				<div class="row">
				
				    <select class="userdata" name="usuario_canal_preferido_3" onchange="">
				    	<option value"0">Seleccione</option>
				    	<?php
				    	foreach($optionArray as $option)
						{
							$values = explode('=>', $option);
							?>
							<option value="<?php echo $values[0]?>"><?php echo $values[1]?></option>
							<?php
						}
						?>
				    </select>
					
				</div>
			</div>
		</div>
		<div class="blue-shadow"><img src="<?php echo APPLICATION_URL?>images/shadow-bluebox.png" alt="" width="" height=""></div>
		</div>
	</div>
    <input class="precision-data" type="hidden" id="channel-weight" name="channel-weight" value="<?php echo $order->__get('order_peso')?>">
</div>	<!-- END row -->