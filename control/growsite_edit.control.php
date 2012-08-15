<?php
$value = (strlen(trim($object->__get('site_coordinates')))>0) ? $object->__get('site_coordinates') : '4.601172, -74.073279,5';
$coords = explode(',',$value);
if (count($coords) == 3)
{
	$center = $coords[0].','.$coords[1];
	$zoom = $coords[2];
}
?>
<div class="panel02">
	<form action="index.php?control_growsite.controller/update" method="post" id="validable" enctype="multipart/form-data">
		<input type="hidden" name="site_id" value="<?php echo $object->__get('site_id')?>" />
        <label> 
            <span>Nombre del sitio</span>
            <input type="text" name="site_name" id="site_name" value="<?php echo $object->__get('site_name')?>" />
        </label>
        <label> 
            <span>Comentarios</span>
						<?php
            $oFCKeditor             = new FCKeditor('site_comments') ;
            $oFCKeditor->BasePath   = MONTANA_FCK_BASE ;
            $oFCKeditor->Value      = $object->__get('site_comments');
            $oFCKeditor->Width      = 700 ;	
            $oFCKeditor->Height     = 300 ;					
            $oFCKeditor->Create();
            ?>
        </label>
        <label> 
            <span>Imagen</span>
            <?php if ($object->__get('site_image') != '') echo '<img src="'.APPLICATION_URL.'resources/images/50x50/'.$object->__get('site_image').'" />'; ?>                                
            <input type="file" name="site_avatar" class="notValidable"/>
        </label>
         <label> 
            <span>Ubicacion google maps</span>
			<?php
				$action = "ParamsAJAXCall('index.php?form_popup.control/setGogleMapsOther/".$object->__get('site_id')."/site_coordinates/_/".$value."', loadGoogleMaps, 'GET', 'window2', '" . $center . "');";
				echo '<a onClick="'.$action.'" href="javascript:void(0)"><img height="25" width="113" border="0" alt="Editar" src="imgcontrol/M_editar.gif"/></a>';
			?>
		</label>	

		<div class="botones">
						<input type="hidden" id="by_value" name="site_coordinates" value="<?php echo $value?>" />
            <input name="" type="image" src="imgcontrol/bot_guardar.gif" alt="Guardar" width="170" height="42" />
            <input name="" type="image" src="imgcontrol/bot_cancelar.gif" alt="Cancelar" width="127" height="28" />
        </div>
	</form>
</div>

<script languaje="javascript">
	initialize('<?php echo $center?>');
</script>