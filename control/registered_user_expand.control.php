<?php require_once('session_header.php');
$users 		   = UserHelper::retrieveUsers();
$selected_user = (isset($_GET[0])) ? new User(escape($_GET[0])) : new User(); 
?>
<div id="contenido"> 
	<h2>Usuarios</h2>
	<div class="divider">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="layout">
			<tr>
			<td width="170px">
            	<div id="sidebar1"> 
					<ul>
						<li>
							<?php
                            foreach ($users as $user)
                            {
                            ?>
                                <a href="index.php?registered_user_expand.control/<?=$user->__get('user_id')?>" class="sidebar_01">
                                    <img src="imgcontrol/ico_tree.gif" />
                                    <span><?=$user->__get('user_names')?></span>
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
                    <h3><?=$selected_user->__get('user_names')?></h3>
                    <div class="ruta">
                           <a href="index.php?home.control">Inicio</a> &gt; <a href="index.php?registered_user_list.control">Usuarios</a> &gt; <a href="index.php?registered_user_expand.control/<?=$selected_user->__get('user_id')?>"><?=$selected_user->__get('user_names')?></a> 
                    </div>
                    <a href="#" class="sobrepanel2">INFORMACI&Oacute;N B&Aacute;SICA</a>
                    <div class="panel02">
                        <?php
                            $parent = new User($selected_user->__get('user_parent'));
                        ?>
                        <div class="p_infobasica">
                            <p><span>Creado por </span><?=$parent->__get('user_full_name');?></p>
                            <p><span>Fecha de Creaci&oacute;n:</span><?php echo formatDate('%d/%m/%Y', $selected_user->__get('user_datetime_creation')); ?> </p>
                            <p><span>&Uacute;ltima Modificaci&oacute;n:</span><?php echo formatDate('%d/%m/%Y', $selected_user->__get('user_datetime_update')); ?></p>
                            <p><span>&Uacute;ltima Ingreso: </span><?php echo formatDate('%d/%m/%Y', $selected_user->__get('user_datetime_last_login')); ?></p>
                        </div>
                    </div>
                    <?php PermissionHelper::displayDocks(38, $selected_user); ?>
                </div>
	    	</td>
            </tr>
        </table>
	<div class="clear"></div>
	</div>
</div>