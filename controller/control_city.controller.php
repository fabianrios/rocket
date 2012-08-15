<?php
header('Content-Type: text/html; charset=ISO-8859-1'); 
$action = isset($_POST['action']) ? $_POST['action'] : $_GET[0];
switch ($action):
	case 'changeState':
		$city 			= new City($_GET[1]);
		$state			= ($city->__get('city_activated') == '1') ? 0 : 1;
		$city->__set('city_activated', $state);
		$city->update();
		$state_display 	= ($state == 0) ? 'Inactivo' : 'Activo';
		echo  $state_display; 
	break;	
	case 'changeDeparments':
		if($_GET[1] == 82) //Colombia
		{
			$states	= StateHelper::retrieveStates(' ORDER BY state_name');
			?>
			<div class="wide-form-div">
				<label id="liststates_1">Departamento / Estado</label>
				<select name="liststates" class="wide-form-select" onchange="SimpleAJAXCall(ApplicationUrl + 'control_city.controller/changeCity/'+this.value+'.html', ElementStateChanged, 'GET', 'listCities'); validInst = new Validator(3, '', true);">
					<option value="NULL">- seleccione - </option>
					<?php
					foreach($states as $state)
					{
						?>
						<option value="<?php echo $state->__get('state_id')?>"><?php echo $state->__get('state_name')?></option>
						<?php
					}
					?>
				</select>
			</div>
			<!--wide-form-div-->
			<div class="wide-form-div" id="listCities">
				<label id="city_id_1">Ciudad</label>
				<select name="city_id" class="wide-form-select">
					<option value="NULL">- seleccione - </option>
				</select>
			</div>
			<?php
		}
		else
		{
			?>
			<div class="wide-form-div">
				<label id="user_deparment_1">Departamento / Estado</label>
				<input type="text" name="user_deparment" alt="user_deparment_1" title="Departamento / Estado" class="wide-form-text" />
			</div>
			<!--wide-form-div-->
			<div class="wide-form-div">
				<label id="user_city_1">Ciudad</label>
				<input type="text" name="user_city" alt="user_city_1" title="Ciudad" class="wide-form-text" />
			</div>
			<?php
		}
	break;
	
	case 'changeCity':
		$cities	= CityHelper::retrieveCities(' AND state_id = '.escape($_GET[1]).' ORDER BY city_name');
		?>
		<label id="city_id_1">Ciudad</label>
		<select name="city_id" class="wide-form-select">
			<option value="NULL">- seleccione - </option>
			<?php
			foreach($cities as $city)
			{
				?>
				<option value="<?php echo $city->__get('city_id')?>"><?php echo $city->__get('city_name')?></option>
				<?php
			}
			?>
		</select>
		<?php
	break;
endswitch;	
?>