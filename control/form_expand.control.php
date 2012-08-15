<?php require_once('session_header.php');
$forms = FormHelper::retrieveForms();
$selected_form = new FormContent(escape($_GET[0])); 
?>
<div id="contenido"> 
	<h2>Formularios</h2>
	<div class="divider">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="layout">
			<tr>
			<td width="170px">
            	<div id="sidebar1"> 
					<ul>
						<li>
							<?php
                            foreach ($forms as $form)
                            {
                            ?>
                                <a href="index.php?form_expand.control/<?=$form->__get('form_id')?>" class="sidebar_01">
                                    <img src="imgcontrol/ico_tree.gif" />
                                    <span><?=$form->__get('form_title')?></span>
                                </a>
                            <?php
                            }
                            ?>
	                    </li>
					</ul>	
				</div>
        	</td>
			<td>
                <div id="mainContent">
                    <div id="alertBox">
                       <?php 
                       $alert = (isset($alert)) ? $alert : array();
                       AlertHelper::placeAlerts($alert); ?>  
                    </div>
                    <h3><?=$selected_form->__get('form_title')?></h3>
                    <div class="ruta">
                           <a href="index.php?home.control">Inicio</a> &gt; <a href="index.php?form_list.control">Formularios</a> &gt; <a href="index.php?form_expand.control/<?=$selected_form->__get('form_id')?>"><?=$selected_form->__get('form_title')?></a> 
                    </div>
                    <a href="#" class="sobrepanel2">INFORMACI&Oacute;N B&Aacute;SICA</a>
                    <div class="panel02">
                        <div class="p_infobasica">
                            <p><span>Nombre </span><?=$form->__get('form_title');?></p>
                        </div>
                    </div>
                    <?php PermissionHelper::displayDocks(8, $selected_form); ?>
                </div>
	    	</td>
            </tr>
        </table>
	<div class="clear"></div>
	</div>
</div>
<?php require_once('footer.php'); ?>