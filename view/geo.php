<?php
$states = StateHelper::retrieveStates("ORDER BY state_name");
$order = new Order($this->orderId);
$validable = ($order->__get('order_skip') == '0') ? "validable" : "notValidable"; 
?>
<table width="50%" class="centered table-questions">
					<tr>		
						<td>
							<div class="box">
								<a class="bluebox-1">
									<div class="box-select text-center">				
													<label class="whitetxt txt-shadow-black"><strong>Departamento:</strong></label>
													    <select onchange="SimpleAJAXCall('<?php echo APPLICATION_URL?>geo.controller/stateChanged/'+this.value+'.html', ElementStateChanged, 'GET', 'city')" id="department_geo" class="<?php echo $validable?>" title="Departamento">
													    	<option value"0">Seleccione</option>
													    	<?php
													    	foreach($states as $state)
															{
																?>
																<option value="<?php echo $state->__get('state_id')?>"><?php echo ucfirst(strtolower(utf8_encode($state->__get('state_name'))))?></option>
																<?php
															}
															?>
													    </select>
													    <div id="city">
															<label class="whitetxt txt-shadow-black"><strong>Ciudad o Municipio:</strong></label>
														    <select>
														    	<option>Seleccione</option>
														    </select>
													    </div>
												</div>
									</a>
									</div>
									<div class="blue-shadow"><img src="<?php echo APPLICATION_URL?>images/shadow-bluebox.png" alt="" width="" height=""></div>
									</td>
									</tr>
									</table>
    <input class="precision-data" type="hidden" id="department_geo-weight" name="department_geo-weight" value="<?php echo $order->__get('order_peso')?>">