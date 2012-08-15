<?php
if (isset($_POST['usuario_ciudad']))
{
	$city		= new City($_POST['usuario_ciudad']);
	echo 		$city->__get('city_name').'<br>';
	$address_1 	= $_POST['usuario_direccion_casa_1_1'] ." ".$_POST['usuario_direccion_casa_1_2']." ". $_POST['usuario_direccion_casa_2_2'];
	echo 		$address_1.'<br>'; 
	$resolveTo1	= ColombiaHelper::selectPoints(" AND cityname = '".$city->__get('city_name')."' AND name = '".$address_1."'");
	if ($resolveTo1['num_rows'] > 0)
	{
		$lat	= mysql_result($resolveTo1['query'], 0, 1);
		$lon	= mysql_result($resolveTo1['query'], 0, 2);
		echo "Resuelto a:". $lat  . "," . $lon .'<br>';
		$latMin	= $lat - (180/pi())*(500/6378137);
		$lonMin = $lon - (180/pi())*(500/6378137)/cos($lon);
		$latMax	= $lat + (180/pi())*(500/6378137);
		$lonMax = $lon + (180/pi())*(500/6378137)/cos($lon);		
		echo "Oficinas en un radio de 500 M de este punto".'<br>';
		$connection  = Connection::getInstance();
		$sql	= 'SELECT entidad_nombre_comercial, municipio_nombre, oficina_nombre,  direccion_id, CONCAT(ugeo_vias.via_nombre, " ", direccion_numero, direccion_letra, " ", direccion_2_numero, direccion_2_letra) as dirr 
		FROM ugeo_vias, ugeo_oficinas_direcciones, ugeo_oficinas, ugeo_municipios, comp_entidades
		WHERE ugeo_vias.via_id = direccion_via_1_id
		AND ugeo_oficinas.oficina_codigo = ugeo_oficinas_direcciones.direccion_oficina_id 
		AND ugeo_oficinas.oficina_municipio_id = ugeo_municipios.municipio_id 
		AND ugeo_oficinas.oficina_entidad_id = comp_entidades.entidad_id
		AND direccion_coord_lat >=   "' . $latMin . '" 
		AND direccion_coord_lat <=   "' . $latMax . '" 
		AND direccion_coord_lon <=   "' . $lonMin . '" 
		AND direccion_coord_lon >=   "' . $lonMax . '" 		
		AND direccion_coord_lon <> direccion_coord_lat
		GROUP BY direccion_id';		
		$result  = $connection->query($sql);
		if ($result['query'] > 0)
		{
			while ($row = mysql_fetch_assoc($result['query']))
				echo $row['municipio_nombre'] . ' - ' . $row['entidad_nombre_comercial'] . ' - ' . $row['oficina_nombre'] . ' - ' . $row['dirr'].'<br>';
		}
	}
	else
		echo 'No se encontro ningún registro para esta dirección'.'<br>';
//lat = lat0 + (180/pi)*(dy/6378137)
//lon = lon0 + (180/pi)*(dx/6378137)/cos(lat0)

}
$states = StateHelper::retrieveStates("ORDER BY state_name");
?>
<br>
<hr>
<script language="javascript">
	var ApplicationUrl = '<?php echo APPLICATION_URL?>';
</script>
<script type="text/javascript" src="<?php echo APPLICATION_URL?>js/ajax_lib.js"></script>	
<script type="text/javascript" src="<?php echo APPLICATION_URL?>js/ajax_helper.js"></script>
<script type="text/javascript" src="<?php echo APPLICATION_URL?>js/helpers.js"></script>
<form action="prueba-direccion.html" method="post">
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
														    <select name="city_id">
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
			
		</div>
	
				<div class="blue-shadow"><img src="<?php echo APPLICATION_URL?>images/shadow-bluebox.png" alt="" width="" height=""></div>	
</div>
<input type="submit">
</form>