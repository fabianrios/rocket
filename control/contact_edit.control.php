<?php
	$contac = new Contac(escape($_GET[0]));
?>
<div class="panel02">
	<form action="index.php?control_user.controller/update" method="post" id="validable">
		<input type="hidden" name="contac_id" value="<?=$contac->__get('contac_id')?>" />
        <label> 
            <span>Fecha</span>
            <input type="text" readonly name="" id="" value="<?=$contac->__get('contac_date')?>" />
        </label>
        <label> 
            <span>Nombres</span>
            <input type="text" name="contac_name" id="contact_name" value="<?=$contac->__get('contac_name')?>" />
        </label>
        <label> 
            <span>E-mail</span>
            <input type="text" name="contac_mail" id="contac_name" class="email"   value="<?=$contac->__get('contac_mail')?>"/>
        </label>
        <label> 
            <span>Asunto</span>
			<select name="role_id">
            	<option <?php if($contac->__get('contac_subject') == 'Ayuda'){?> selected <?php }?> value="Ayuda">Ayuda</option>
                <option <?php if($contac->__get('contac_subject') == 'Informaci&oacute;n General'){?> selected <?php }?> value="Informaci&oacute;n General">Informaci&oacute;n General</option>
                <option <?php if($contac->__get('contac_subject') == 'Quejas'){?> selected <?php }?> value="Quejas">Quejas</option>
                <option <?php if($contac->__get('contac_subject') == 'Felicitaciones'){?> selected <?php }?> value="Felicitaciones">Felicitaciones</option>
                <option <?php if($contac->__get('contac_subject') == 'Otros'){?> selected <?php }?> value="Otros">Otros</option>
            </select>
        </label>
        <label>
        	<span>Comentario</span>
            <textarea cols="100" rows="5" name="contac_message"><?=$contac->__get('contac_message')?></textarea>
        </label>
	</form>
</div>