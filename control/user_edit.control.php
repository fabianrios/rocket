<?php
	$roles = RoleHelper::retrieveRoles(" ORDER by role_name");
?>
<div class="panel02">
	<form action="index.php?control_user.controller/update" method="post" id="validable">
		<input type="hidden" name="user_id" value="<?php echo $object->__get('user_id')?>" />
        <label> 
            <span>Nombre y Apellidos</span>
            <input type="text" name="user_full_name" id="user_name" value="<?php echo $object->__get('user_full_name')?>" />
        </label>
        <label> 
            <span>E-mail</span>
            <input type="text" name="user_email" id="user_email" class="email"   value="<?php echo $object->__get('user_email')?>"/>
        </label>
        <label> 
            <span>Password</span>
            <input type="password" name="user_password" id="user_password" class="notValidable" />
        </label>
        <label> 
            <span>Rol</span>
			<select name="role_id">
            	<?php 
				foreach ($roles as $role)
				{
					$selected = ($role->__get('role_id') == $object->__get('role_id')) ? 'selected="selected"' : '';
				?>
                	<option value="<?php echo $role->__get('role_id')?>" <?php echo $selected?>><?php echo $role->__get('role_name')?></option>
				<?php
				}
				?>	
            </select>
        </label>
        
        <div class="botones">
            <input name="" type="image" src="imgcontrol/bot_guardar.gif" alt="Guardar" width="170" height="42" />
            <input name="" type="image" src="imgcontrol/bot_cancelar.gif" alt="Cancelar" width="127" height="28" />
        </div>
	</form>
</div>