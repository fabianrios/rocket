<?php
$order 	= new Order($this->orderId);
$validable = ($order->__get('order_skip') == '0') ? "validable" : "notValidable"; 
?>
<script language="JavaScript" src="<?php echo APPLICATION_URL?>js/finanzas.js" ></script>						 	
<div class="ingresos"><!-- Ingresos -->
								<div class="row"><!-- Row Result -->
									<div class="twelve columns">
									<div class="row">
										<h5 class="six columns text-right finanzas-total bar3text"><span class="small greytxt">Total:</span><strong> $0</strong></h5>
										
									</div>
										<div class="total-bar">
											<div class="padding-5 clearfix bar3">
												<div class="blue-bar left round-left" style="width:33%">33%</div>
												<div class="green-bar left" style="width:33%">33%</div>
												<div class="orange-bar round-right left" style="width:33%">33%</div>
											</div>
										</div>
									</div>
							 	</div><!-- Row Result -->
<?php
$userData	= unserialize($this->user->__get('user_data'));
?>
<div class="row"><!-- Row Result -->
							 		<div class="four columns"><!-- Col 1/3 -->
							 		<h5 class="text-center greytxt no-margin txt-shadow-white"><strong><span class="bluetxt">&#8226;</span> Ingreso</strong></h5>
							 			<table class="blank-table">
											<tr>
											    <td><a class="less-than round-left" aria-hidden="true" data-icon="&#x6c;"></a></td>
											    <td><input class="finanzas-input expand bluetxt" rel="bar3" type="text" placeholder="0" name="salud_28-1" id="ingresos" value="<?php echo (isset($userData['salud_28-1'])) ? number_format($userData['salud_28-1'], 0, ",", ".") : '';?>" /></td>
											    <td><a class="less-than round-right" aria-hidden="true" data-icon="&#x3b;"></a></td>
											</tr>
										</table>
							 		<p class="text-center small">¿Cúantos son tus ingresos netos promedio mensuales? (despues de descontar esa tan lejana pensión, y tu costosa salud, etc.)</p>
							 		</div><!-- /Col 1/3 -->
							 		<div class="four columns"><!-- Col 2/3 -->
							 		<h5 class="text-center greytxt no-margin txt-shadow-white"><strong><span class="greentxt">&#8226;</span> Pensión mensual</strong></h5>
							 			<table class="blank-table">
											<tr>
											    <td><a class="less-than round-left" aria-hidden="true" data-icon="&#x6c;"></a></td>
											    <td><input class="finanzas-input expand greentxt" rel="bar3" type="text" placeholder="0" name="salud_28-2" id="pension" value="<?php echo (isset($userData['salud_28-2'])) ? number_format($userData['salud_28-2'], 0, ",", ".") : '';?>" /></td>
											    <td><a class="less-than round-right" aria-hidden="true" data-icon="&#x3b;"></a></td>
											</tr>
										</table>
							 		<p class="text-center small">¿Cúanto es tu ingreso mensual por esa tan merecida pensión?</p>
							 		</div><!-- /Col 2/3 -->
							 		<div class="four columns"><!-- Col 3/3 -->
							 		<h5 class="text-center greytxt no-margin txt-shadow-white"><strong><span class="orangetxt">&#8226;</span> Otros ingresos</strong></h5>
							 			<table class="blank-table">
											<tr>
											    <td><a class="less-than round-left" aria-hidden="true" data-icon="&#x6c;"></a></td>
											    <td><input class="finanzas-input expand orangetxt" rel="bar3" type="text" placeholder="0" name="salud_28-3"  id="otros_ingresos" value="<?php echo (isset($userData['salud_28-3'])) ? number_format($userData['salud_28-3'], 0, ",", ".") : '';?>" /></td>
											    <td><a class="less-than round-right" aria-hidden="true" data-icon="&#x3b;"></a></td>
											</tr>
										</table>
							 		<p class="text-center small">Si tienes otros ingresos diferentes a sueldo o pensión, ¿Cúanto suman?.</p>
							 		</div><!-- /Col 3/3 -->
							 	</div><!-- /Row Result -->
						 	</div><!-- Ingresos -->
    <input class="precision-data" type="hidden" id="ingresos-weight" name="ingresos-weight" value="<?php echo $order->__get('order_peso')?>">
    <input class="precision-data" type="hidden" id="otros_ingresos1-weight" name="otros_ingresos1-weight" value="<?php echo $order->__get('order_peso')?>">
    <input class="precision-data" type="hidden" id="otros_ingresos2-weight" name="otros_ingresos2-weight" value="<?php echo $order->__get('order_peso')?>">