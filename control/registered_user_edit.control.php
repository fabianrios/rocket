<?php
$countries  = CountryHelper::retrieveCountries("ORDER BY country_name");
if($object->__get('city_id') != '')
{
	$city 	 	= new City($object->__get('city_id'));
	$state		= new State($city->__get('state_id'));
	$countryId 	= $state->__get('country_id');
	$action  	= 'update';
}
else
{
	$countryId 	= 0;
	$action  	= 'register';
	
}
?>
<div class="panel02">
	<form action="index.php?control_registered_user.controller/updateUser" method="post" id="validable" enctype="multipart/form-data">
		<input type="hidden" name="user_id" value="<?php echo $object->__get('user_id')?>" />
        <label> 
            <span>Nombres</span>
            <input type="text" name="user_names" id="user_name" value="<?php echo $object->__get('user_names')?>" title="Nombres" />
        </label>
        <label> 
            <span>Apellidos</span>
            <input type="text" name="user_surnames" id="user_name" value="<?php echo $object->__get('user_surnames')?>" title="Apellidos" />
        </label>
        <label> 
            <span>E-mail</span>
            <input type="text" name="user_email" id="user_email" class="email"   value="<?php echo $object->__get('user_email')?>" title="E-mail"/>
        </label>
        <label> 
            <span>Usuario</span>
            <input type="text" name="user_login" id="user_login" value="<?php echo $object->__get('user_login')?>" title="Nombre de Usuario" />
        </label>
        <label> 
            <span>Contrase&ntilde;a</span>
            <input type="password" name="password" id="password" title="Contraseña" class="notValidable" />
        </label>
        <label> 
            <span>Pa&iacute;s</span>
              <select name="country_id" title="Pa&iacute;s" onchange="SimpleAJAXCall('index.php?geo.controller/countryChanged/'+this.value, ElementStateChanged, 'GET', 'states');">
                <option value="NULL" selected="selected">Seleccione</option>
                <?php
                foreach($countries as $country)
                {
                    $selected = '';
                    if($countryId == $country->__get('country_id'))
                        $selected = 'selected="selected"';
                ?>
                    <option value="<?php echo $country->__get('country_id')?>" <?php echo $selected?>><?php echo $country->__get('country_name')?></option>
                <?php
                }
                ?>
              </select>
        </label>      
        <label> 
            <span>Departamento</span>
              <div id="states">
                  <select name="department_id" title="Departamento">
                    <option value="NULL">Seleccione</option>
                    <?php
                    if($object->__get('user_id') != '')
                    {
                        echo '<option value="'.$state->__get('state_id').'" selected="selected">'.$state->__get('state_name').'</option>';
                    }
                    ?>
                  </select>
              </div>     
        </label> 
        <label> 
            <span>Ciudad</span>
            <div id="cities">  
                  <select name="city_id" title="Ciudad">
                    <option value="NULL" >Seleccione</option>
                    <?php
                    if($object->__get('user_id') != '')
                    {
                        echo '<option value="'.$city->__get('city_id').'" selected="selected">'.$city->__get('city_name').'</option>';
                    }
                    ?>
                  </select>
            </div>      
        </label> 
        <label> 
            <span>Sexo</span>
            <div class="rad_group">  
				<label>
                	<input type="radio" name="user_sex" id="user_sex" value="M" <?php if ($object->__get('user_sex') == 'M') { echo 'checked="checked"'; } ?>  /> Hombre
            	</label>
				<label>
                	<input type="radio" name="user_sex" id="user_sex" value="F" <?php if ($object->__get('user_sex') == 'F') { echo 'checked="checked""'; } ?> /> Mujer
            	</label>
                
            </div>      
        </label>  
        <label> 
            <span>Fecha de nacimiento</span>
			<input type="text" name="user_birthday" id="user_birthday" onClick="displayDatePicker('user_birthday')" value="<?php echo $object->__get('user_birthday')?>" title="Fecha de nacimiento" class="notValidable" />    
        </label>                   
        <label> 
            <span>Tel&eacute;fono</span>
			<input type="text" name="user_phone" id="user_phone" value="<?php echo $object->__get('user_phone')?>" title="Telefono" class="notValidable" />    
        </label> 
        <label> 
            <span>Direcci&oacute;n</span>
			<input type="text" name="user_address" id="user_address" value="<?php echo $object->__get('user_address')?>" title="Direcci&oacute;n" class="notValidable" />    
        </label> 
        <label> 
            <span>Documento de identidad</span>
			<input type="text" name="user_document" id="user_document" value="<?php echo $object->__get('user_document')?>" title="Direcci&oacute;n" class="notValidable" />    
        </label>
        <label> 
            <span>Imagen</span>
            <?php if ($object->__get('user_image') != '') echo '<img src="'.APPLICATION_URL.'resources/images/50x50/'.$object->__get('user_image').'" />'; ?>                                
            <input type="file" name="user_avatar" class="notValidable"/>
        </label>   
        <label> 
            <span>Invitar al usuario</span>
            <select name="user_invite">
                <option value="0">No</option>
                <option value="1">Si</option>
            </select>
        </label>                
        <label> 
            <span>Activar al usuario</span>
            <select name="user_state">
                <option value="I" <?php if ($object->__get('user_state') == 'I') { echo 'selected="selected"'; } ?>>No</option>
                <option value="A" <?php if ($object->__get('user_state') == 'A') { echo 'selected="selected"'; } ?>>Si</option>
            </select>
        </label>   
        <div class="botones">
        	<input name="user_id" type="hidden" value="<?php echo $object->__get('user_id')?>" />
            <input name="user_type" type="hidden" value="P" />
            <input name="" type="image" src="imgcontrol/bot_guardar.gif" alt="Guardar" width="170" height="42" />
            <input name="" type="image" src="imgcontrol/bot_cancelar.gif" alt="Cancelar" width="127" height="28" />
        </div>
	</form>
</div>