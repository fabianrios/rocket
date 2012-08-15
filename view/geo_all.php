<?php
$states = StateHelper::retrieveStates("ORDER BY state_name");
$order 	= new Order($this->orderId);
$validable = ($order->__get('order_skip') == '0') ? "validable" : "notValidable"; 
?>
<table width="50%" class="centered table-questions">
					<tr>		
						<td>
							<div class="box">
								<a class="bluebox-1">
									<div class="box-select text-center">				
													<label class="whitetxt txt-shadow-black"><strong>Departamento:</strong></label>
													    <select onchange="SimpleAJAXCall('<?php echo APPLICATION_URL?>geo.controller/stateChanged/'+this.value+'.html', ElementStateChanged, 'GET', 'city')" id="department_geo_all" class="<?php echo $validable?>" title="¿En dónde te gustaría solicitar o pagar tu crédito?">
													    	<option value="NULL">Seleccione</option>
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
														    	<option value ="NULL">Seleccione</option>
														    </select>
													    </div>
												</div>
									</a>
									</div>
									<div class="blue-shadow"><img src="<?php echo APPLICATION_URL?>images/shadow-bluebox.png" alt="" width="" height=""></div>
									</td>
									</tr>
									</table>
<p><strong>Ingresa una direcci&oacute;n aprox&iacute;mada</strong>, por ejemplo: Unicentro (Avenida 15 # 124) o Plaza de las Americas (Transversal 71D # 26S) </p>                                    
<div class="eight columns centered">
	
	<br />
	<br />
	<div class="bluebox centered" id="">
	<div class="padding-10">
			<label class="whitetxt txt-shadow-black"><strong>Un lugar cercano a tu casa al cual te guste ir caminando</strong></label>
			
			<div class="row">
			
				<div class="three columns">
					    <select name="usuario_direccion_casa_1_1" class="userdata validable" rel="geo" title="¿En dónde te gustaría solicitar o pagar tu crédito - direccion?">
					    	<option>Seleccione</option>
					    	<option value="Calle">Calle</option>
					    	<option value="Carrera">Carrera</option>
					    	<option value="Diagonal">Diagonal</option>
					    	<option value="Transversal">Transversal</option>
					    	<option value="Avenida">Avenida</option>
					    </select>
				</div>
				<div class="four columns">
					    <input type="text"  class="input-blue userdata validable" name="usuario_direccion_casa_1_2" value="" rel="geo" title="¿En dónde te gustaría solicitar o pagar tu crédito - direccion?"/>

				</div>
				<div class="one columns">
					<span class="whitetxt txt-shadow-black">#</span>
				</div>
				<div class="four columns">
					    <input type="text"  class="input-blue userdata validable" name="usuario_direccion_casa_2_2" value="" rel="geo" title="¿En dónde te gustaría solicitar o pagar tu crédito - direccion?" />
				</div>
				
			</div>
			<hr class="dark"/>
			<label class="whitetxt txt-shadow-black"><strong>Tu lugar preferido para ir a almorzar cercano al trabajo</strong></label>
			<div class="row">
			
				<div class="three columns">
					    <select name="usuario_direccion_trabajo_1_1" class="userdata notValidable">
					    	<option>Seleccione</option>
					    	<option value="Calle">Calle</option>
					    	<option value="Carrera">Carrera</option>
					    	<option value="Diagonal">Diagonal</option>
					    	<option value="Transversal">Transversal</option>
					    	<option value="Avenida">Avenida</option>
					    </select>
				</div>
				<div class="four columns">
					    <input type="text"  class="input-blue userdata notValidable" name="usuario_direccion_trabajo_1_2" value=""/>
				</div>
				<div class="one columns">
						<span class="whitetxt txt-shadow-black">#</span>
				</div>
				<div class="four columns">
					<input type="text"  class="input-blue userdata notValidable" name="usuario_direccion_trabajo_2_2" value=""/>
				</div>
				
			</div>
			<hr class="dark"/>
			<label class="whitetxt txt-shadow-black"><strong>Otro sitio que frecuentes</strong></label>
			<div class="row">
			
				<div class="three columns">
					    <select name="usuario_direccion_otra_1_1" class="userdata notValidable">
					    	<option>Seleccione</option>
					    	<option value="Calle">Calle</option>
					    	<option value="Carrera">Carrera</option>
					    	<option value="Diagonal">Diagonal</option>
					    	<option value="Transversal">Transversal</option>
					    	<option value="Avenida">Avenida</option>
					    </select>
				</div>
				<div class="four columns">
					    <input type="text"  class="input-blue userdata notValidable" name="usuario_direccion_otra_1_2" value=""/>
				</div>
				<div class="one columns">
					<span class="whitetxt txt-shadow-black">#</span>
				</div>
				<div class="four columns">
					<input type="text"  class="input-blue userdata notValidable" name="usuario_direccion_otra_2_2" value=""/>
				</div>
				
			</div>
			</div>
		</div>
	
				<div class="blue-shadow"><img src="<?php echo APPLICATION_URL?>images/shadow-bluebox.png" alt="" width="" height=""></div>	
</div>
    <input class="precision-data" type="hidden" id="department_geo_all-weight" name="department_geo_all-weight" value="<?php echo $order->__get('order_peso')?>">
												