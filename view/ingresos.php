<?php
$order 	= new Order($this->orderId);
$validable = ($order->__get('order_skip') == '0') ? "validable" : "notValidable"; 
$userData	= unserialize($this->user->__get('user_data'));

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
			
                                                <div class="aqua-bar round-right left" style="width:34%">34%</div>
											</div>
										</div>
									</div>
							 	</div><!-- Row Result -->
							 	
<div class="row"><!-- Row Result -->
							 		<div class="four columns"><!-- Col 1/3 -->
							 		<h5 class="text-center greytxt no-margin txt-shadow-white"><strong><span class="bluetxt">&#8226;</span> Ingreso</strong></h5>
							 			<table class="blank-table">
											<tr>
											    <td><a href="#" class="sprite-1 less-than">less</a></td>
											    <td><input class="finanzas-input expand bluetxt <?php echo $validable?>" rel="bar3" type="text" placeholder="0" name="salud_28-1" id="ingresos" title="Ingreso"  alue="<?php echo (isset($userData['salud_28-1'])) ? number_format($userData['salud_28-1'], 0, ",", ".") : '';?>"/></td>
											    <td><a href="#" class="sprite-1 more-than">more</a></td>
											</tr>
										</table>
							 		<p class="text-center small">Ingreso promedio mensual.</p>
							 		</div><!-- /Col 1/3 -->
							 		<div class="four columns"><!-- Col 3/3 -->
							 		<h5 class="text-center greytxt no-margin txt-shadow-white"><strong><span class="orangetxt">&#8226;</span> Otros ingresos</strong></h5>
							 			<table class="blank-table">
											<tr>
											    <td><a href="#" class="sprite-1 less-than">less</a></td>
											    <td><input class="finanzas-input expand orangetxt <?php echo $validable?>" rel="bar3" type="text" placeholder="0" name="salud_28-3"  id="otros_ingresos1" title="Ingreso promedio mensual"  value="<?php echo (isset($userData['salud_28-3'])) ? number_format($userData['salud_28-3'], 0, ",", ".") : '';?>" /></td>
											    <td><a href="#" class="sprite-1 more-than">more</a></td>
											</tr>
										</table>
							 		<p class="text-center small">Si tienes otros ingresos diferentes a sueldo o pensión, ingresalos acá.</p>
							 		</div><!-- /Col 3/3 -->
									<div class="four columns"><!-- Col 3/3 -->
							 		<h5 class="text-center greytxt no-margin txt-shadow-white"><strong><span class="aquatxt">&#8226;</span> Familiares</strong></h5>
							 			<table class="blank-table">
											<tr>
											    <td><a href="#" class="sprite-1 less-than">less</a></td>
											    <td><input class="finanzas-input expand orangetxt" rel="bar3" type="text" placeholder="0" name="usuario_ingresos_familiares"  id="otros_ingresos2"   value="<?php echo (isset($userData['usuario_ingresos_familiares'])) ? number_format($userData['usuario_ingresos_familiares'], 0, ",", ".") : '';?>" /></td>
											    <td><a href="#" class="sprite-1 more-than">more</a></td>
											</tr>
										</table>
							 		<p class="text-center small">Algunos bancos permiten que se sumen los ingresos de familiares, esto ayuda a que te den el producto y a que este sea mucho mejor (mas ventajas y mas cupo)</p>
							 		</div><!-- /Col 3/3 -->                                    
							 	</div><!-- /Row Result -->
						 	</div><!-- Ingresos -->
    <input class="precision-data" type="hidden" id="ingresos-weight" name="ingresos-weight" value="<?php echo $order->__get('order_peso')?>">
    <input class="precision-data" type="hidden" id="otros_ingresos1-weight" name="otros_ingresos1-weight" value="<?php echo $order->__get('order_peso')?>">
    <input class="precision-data" type="hidden" id="otros_ingresos2-weight" name="otros_ingresos2-weight" value="<?php echo $order->__get('order_peso')?>">