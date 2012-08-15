<?php
$order 	= new Order($this->orderId);
$userData	= unserialize($this->user->__get('user_data'));
?>
<div class="otros-gastos margin-top-60"><!-- Otros Gastos -->
<div class="row"><!-- Row Result -->
    <div class="twelve columns">
    <div class="row">
        <h5 class="six columns text-right finanzas-total bar4text"><span class="small greytxt ">Total:</span><strong> $0</strong></h5>
        
    </div>
        <div class="total-bar">
            <div class="padding-5 clearfix bar4">
                <div class="blue-bar left round-left" style="width:25%">25%</div>
                <div class="green-bar left" style="width:25%">25%</div>
                <div class="orange-bar left" style="width:25%">25%</div>
                <div class="aqua-bar left round-right" style="width:25%">25%</div>
            </div>
        </div>
    </div>
</div><!-- Row Result -->
<div class="row"><!-- Row Result -->
       <div class="three columns"><!-- Col 3/4 -->
							 		<h5 class="text-center greytxt no-margin txt-shadow-white"><strong><span class="bluetxt">&#8226;</span> Cuota hipotecaria</strong></h5>
							 			<table class="blank-table">
											<tr>
											    <td><a class="less-than round-left" aria-hidden="true" data-icon="&#x6c;"></a></td>
											    <td><input class="finanzas-input expand bluetxt" rel="bar4" type="text" placeholder="0" name="salud_24" value="<?php echo (isset($userData['salud_24'])) ? number_format($userData['salud_24'], 0, ",", ".") : '';?>"/></td>
											    <td><a class="less-than round-right" aria-hidden="true" data-icon="&#x3b;"></a></td>
											</tr>
										</table>
							 		<p class="text-center small">¿Cuánto pagaste por tu cuota del crédito o leasing de vivienda el mes pasado?</p>
							 		</div><!-- /Col 3/4 -->
							 		<div class="three columns"><!-- Col 4/4 -->
							 		<h5 class="text-center greytxt no-margin txt-shadow-white"><strong><span class="greentxt">&#8226;</span> Tarjeta de crédito</strong></h5>
							 			<table class="blank-table">
											<tr>
											    <td><a class="less-than round-left" aria-hidden="true" data-icon="&#x6c;"></a></td>
											    <td><input class="finanzas-input expand greentxt" rel="bar4" type="text" placeholder="0" name="salud_25" value="<?php echo (isset($userData['salud_25'])) ? number_format($userData['salud_25'], 0, ",", ".") : '';?>"/></td>
											    <td><a class="less-than round-right" aria-hidden="true" data-icon="&#x3b;"></a></td>
											</tr>
										</table>
							 		<p class="text-center small">¿Cuánto pagas en promedio cada mes por tu crédito rotativo y/o tarjeta de crédito?</p>
							 		</div><!-- /Col 4/4 -->                                
							 		<div class="three columns"><!-- Col 1/4 -->
							 		<h5 class="text-center greytxt no-margin txt-shadow-white"><strong><span class="orangetxt">&#8226;</span> Créditos</strong></h5>
							 			<table class="blank-table">
											<tr>
											    <td><a class="less-than round-left" aria-hidden="true" data-icon="&#x6c;"></a></td>
											    <td><input class="finanzas-input expand orangetxt" rel="bar4" type="text" placeholder="0" name="salud_23-1" value="<?php echo (isset($userData['salud_23-1'])) ? number_format($userData['salud_23-1'], 0, ",", ".") : '';?>"/></td>
											    <td><a class="less-than round-right" aria-hidden="true" data-icon="&#x3b;"></a></td>
											</tr>
										</table>
							 		<p class="text-center small">¿Cuál es el valor de los pagos que realizaste el mes pasado por tus créditos con entidades financieras?</p>
							 		</div><!-- /Col 1/4 -->
							 		<div class="three columns"><!-- Col 2/4 -->
							 		<h5 class="text-center greytxt no-margin txt-shadow-white"><strong><span class="aquatxt">&#8226;</span> Otros prestamos</strong></h5>
							 			<table class="blank-table">
											<tr>
											    <td><a class="less-than round-left" aria-hidden="true" data-icon="&#x6c;"></a></td>
											    <td><input class="finanzas-input expand aquatxt" rel="bar4" type="text" placeholder="0" name="salud_23-2" value="<?php echo (isset($userData['salud_23-2'])) ? number_format($userData['salud_23-2'], 0, ",", ".") : '';?>"/></td>
											    <td><a class="less-than round-right" aria-hidden="true" data-icon="&#x3b;"></a></td>
											</tr>
										</table>
							 		<p class="text-center small">¿Cuál es el valor de los pagos que realizaste el mes pasado por tus deudas con familiares, amigos y otros?</p>
							 		</div><!-- /Col 2/4 -->

    </div><!-- /Row Result -->
</div><!-- Gastos Finacieros -->

<div class="ingresos margin-top-60"><!-- Ingresos -->
    <div class="row"><!-- Row Result -->
        <div class="twelve columns">
        <div class="row">
            <h5 class="six columns text-right finanzas-total bar5text"><span class="small greytxt">Total:</span><strong> $0</strong></h5>
            
        </div>
            <div class="total-bar">
                <div class="padding-5 clearfix bar5">
                    <div class="blue-bar left round-left" style="width:33%">33%</div>
                    <div class="green-bar left" style="width:33%">33%</div>
                    <div class="orange-bar round-right left" style="width:34%">34%</div>
                </div>
            </div>
        </div>
    </div><!-- Row Result -->
    
<div class="row"><!-- Row Result -->
        <div class="four columns"><!-- Col 1/3 -->
							 		<h5 class="text-center greytxt no-margin txt-shadow-white"><strong><span class="bluetxt">&#8226;</span> Servicios públicos</strong></h5>
							 			<table class="blank-table">
											<tr>
											    <td><a class="less-than round-left" aria-hidden="true" data-icon="&#x6c;"></a></td>
											    <td><input class="finanzas-input expand bluetxt" rel="bar5" type="text" placeholder="0" name="salud_26" value="<?php echo (isset($userData['salud_26'])) ? number_format($userData['salud_26'], 0, ",", ".") : '';?>"/></td>
											    <td><a class="less-than round-right" aria-hidden="true" data-icon="&#x3b;"></a></td>
											</tr>
										</table>
							 		<p class="text-center small">¿Cuánto pagas en promedio mensualmente por tus recibos de servicios públicos, celular, medicina prepagada y pensión del colegio?</p>
							 		</div><!-- /Col 1/3 -->
							 		<div class="four columns"><!-- Col 2/3 -->
							 		<h5 class="text-center greytxt no-margin txt-shadow-white"><strong><span class="greentxt">&#8226;</span> Otros gastos</strong></h5>
							 			<table class="blank-table">
											<tr>
											    <td><a class="less-than round-left" aria-hidden="true" data-icon="&#x6c;"></a></td>
											    <td><input class="finanzas-input expand greentxt" rel="bar5" type="text" placeholder="0" name="salud_27" value="<?php echo (isset($userData['salud_27'])) ? number_format($userData['salud_27'], 0, ",", ".") : '';?>"/></td>
											    <td><a class="less-than round-right" aria-hidden="true" data-icon="&#x3b;"></a></td>
											</tr>
										</table>
							 		<p class="text-center small">¿Cuánto suman los gastos mensuales que tienes que hacer por el resto de cosas sin incluir ahorros? (comida, transporte, vestuario, hogar, arriendo y diversión, etc.)</p>
							 		</div><!-- /Col 2/3 -->
							 		<div class="four columns"><!-- Col 3/3 -->
							 		<h5 class="text-center greytxt no-margin txt-shadow-white"><strong><span class="orangetxt">&#8226;</span> Ahorro</strong></h5>
							 			<table class="blank-table">
											<tr>
											    <td><a class="less-than round-left" aria-hidden="true" data-icon="&#x6c;"></a></td>
											    <td><input class="finanzas-input expand orangetxt" rel="bar5" type="text" placeholder="0" name="salud_29" value="<?php echo (isset($userData['salud_29'])) ? number_format($userData['salud_29'], 0, ",", ".") : '';?>"/></td>
											    <td><a class="less-than round-right" aria-hidden="true" data-icon="&#x3b;"></a></td>
											</tr>
										</table>
							 		<p class="text-center small">¿Cuánto ahorras de tu ingreso mensual? Incluye pensiones voluntarias</p>
							 		</div><!-- /Col 3/3 -->
    </div><!-- /Row Result -->
</div>
    <input class="precision-data" type="hidden" id="department_geo_all-weight" name="department_geo_all-weight" value="<?php echo $order->__get('order_peso')?>">
<input class="precision-data" type="hidden" id="salud_24-weight" name="salud_24-weight" value="<?php echo $order->__get('order_peso')?>">
<input class="precision-data" type="hidden" id="salud_25-weight" name="salud_25-weight" value="<?php echo $order->__get('order_peso')?>">
<input class="precision-data" type="hidden" id="salud_23-1-weight" name="salud_23-1-weight" value="<?php echo $order->__get('order_peso')?>">
<input class="precision-data" type="hidden" id="salud_23-2-weight" name="salud_23-2-weight" value="<?php echo $order->__get('order_peso')?>">
<input class="precision-data" type="hidden" id="salud_26-weight" name="salud_26-weight" value="<?php echo $order->__get('order_peso')?>">
<input class="precision-data" type="hidden" id="salud_27-weight" name="salud_27-weight" value="<?php echo $order->__get('order_peso')?>">
<input class="precision-data" type="hidden" id="salud_29-weight" name="salud_29-weight" value="<?php echo $order->__get('order_peso')?>">