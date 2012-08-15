<?php
$action = isset($_POST['action']) ? $_POST['action'] : $_GET[0];
switch ($action):
	case 'countryChanged':
		$extra = isset($_GET[2]) ? $_GET[2] : '';
		header('Content-Type: text/html; charset=iso-8859-1'); 
		$departments		= StateHelper::retrieveStates(" AND country_id = 32 ORDER by state_name");
		?>
        <select name="department_id" id="department_id<?php echo $extra?>" class="form-select validable" onChange="SimpleAJAXCall('<?php echo APPLICATION_URL?>geo.controller/departmentChanged/'+this.value+'.html', ElementStateChanged, 'GET', 'user_geo_cityError');">
          <option value="NULL">Seleccione</option>
        <?php 
            foreach ($departments as $department)
            {
        ?>
                <option value="<?php echo $department->__get('state_id')?>"><?php echo ucfirst(strtolower($department->__get('state_name')))?></option>
        <?php
            }
        ?>                              
      </select>
	 <?php
	break;
	case 'stateChanged':
		$extra = isset($_GET[2]) ? $_GET[2] : '';
		header('Content-Type: text/html; charset=iso-8859-1'); 
		$cities		= CityHelper::retrieveCities(" AND state_id = '".escape($_GET[1])."' ORDER by city_name");
		?>
			<label>Ciudad o Municipio:</label>
            <select name="usuario_ciudad" class="validable" title="<?php echo utf8_decode('¿En dónde te gustaría solicitar o pagar tu crédito?');?>">
              <option value="NULL">Seleccione</option>
            <?php 
                foreach ($cities as $city)
                {
            ?>
                    <option value="<?php echo $city->__get('city_id')?>"><?php echo ucfirst(strtolower($city->__get('city_name')))?></option>
            <?php
                }
            ?>
                            
          </select>
	 <?php
	break;		
endswitch;
?>