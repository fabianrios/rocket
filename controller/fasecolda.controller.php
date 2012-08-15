<?php
$action = isset($_POST['action']) ? $_POST['action'] : $_GET[0];
switch ($action):
	case 'changeYear':
		$cars	= FasecoldaHelper::retrieveFasecoldas(" AND fasecolda_ano = " . escape($_GET[1]) . " AND fasecolda_tipo = 'A' GROUP by fasecolda_marca ORDER by fasecolda_marca");
		?>
		<div class="four columns text-right"><p class="greytxt">Fabricante:</p></div>
		<div class="eight columns">
			<select onChange="SimpleAJAXCall('<?php echo APPLICATION_URL;?>fasecolda.controller/changeMaker/'+this.value+'.html', ElementStateChanged, 'GET', 'referencias');">
				<option value="0">Escoge un Fabricante</option>
                <?php foreach ($cars as $car)
				{
				?>
                	<option value="<?php echo $car->__get('fasecolda_marca');?>$<?php echo $_GET[1];?>"><?php echo $car->__get('fasecolda_marca');?></option>
                <?php
				}
				?>
			</select>
		</div>
        <?php
	break;

	case 'changeMaker':
		$properties	= explode("$", $_GET[1]);
		$cars	= FasecoldaHelper::retrieveFasecoldas(" AND fasecolda_marca = '" . escape($properties[0]) . "' AND fasecolda_tipo = 'A'  AND fasecolda_ano = ".escape($properties[1])." GROUP by fasecolda_referencia ORDER by fasecolda_referencia");
		?>
		<div class="four columns text-right"><p class="greytxt">Referencia:</p></div>
		<div class="eight columns">
			<select onChange="changeValues(this.value);">
				<option value="0">Escoge una referencia</option>
                <?php foreach ($cars as $car)
				{
				?>
                	<option value="<?php echo $car->__get('fasecolda_precio');?>"><?php echo $car->__get('fasecolda_referencia');?></option>
                <?php
				}
				?>
			</select>
		</div>
        <?php
	break;

	case 'changeYearM':
		$cars	= FasecoldaHelper::retrieveFasecoldas(" AND fasecolda_ano = " . escape($_GET[1]) . " AND fasecolda_tipo = 'M'  GROUP by fasecolda_marca ORDER by fasecolda_marca");
		?>
		<div class="four columns text-right"><p class="greytxt">Fabricante:</p></div>
		<div class="eight columns">
			<select onChange="SimpleAJAXCall('<?php echo APPLICATION_URL;?>fasecolda.controller/changeMakerM/'+this.value+'.html', ElementStateChanged, 'GET', 'referencias');">
				<option value="0">Escoge un Fabricante</option>
                <?php foreach ($cars as $car)
				{
				?>
                	<option value="<?php echo $car->__get('fasecolda_marca');?>$<?php echo $_GET[1];?>"><?php echo $car->__get('fasecolda_marca');?></option>
                <?php
				}
				?>
			</select>
		</div>
        <?php
	break;

	case 'changeMakerM':
		$properties	= explode("$", $_GET[1]);
		$cars	= FasecoldaHelper::retrieveFasecoldas(" AND fasecolda_marca = '" . escape($properties[0]) . "' AND fasecolda_tipo = 'M'  AND fasecolda_ano = ".escape($properties[1])." GROUP by fasecolda_referencia ORDER by fasecolda_referencia");
		?>
		<div class="four columns text-right"><p class="greytxt">Referencia:</p></div>
		<div class="eight columns">
			<select onChange="changeValues(this.value);">
				<option value="0">Escoge una referencia</option>
                <?php foreach ($cars as $car)
				{
				?>
                	<option value="<?php echo $car->__get('fasecolda_precio');?>"><?php echo $car->__get('fasecolda_referencia');?></option>
                <?php
				}
				?>
			</select>
		</div>
        <?php
	break;

endswitch;
?>