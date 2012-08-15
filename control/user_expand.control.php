<?php require_once('session_header.php');
$users = ControlUserHelper::retrieveUsers();
$selected_user = new ControlUser(escape($_GET[0])); 
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
                                <a href="index.php?user_expand.control/<?php echo $user->__get('user_id')?>" class="sidebar_01">
                                    <img src="imgcontrol/ico_tree.gif" />
                                    <span><?php echo $user->__get('user_full_name')?></span>
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
                    <h3><?php echo $selected_user->__get('user_full_name')?></h3>
                    <div class="ruta">
                           <a href="index.php?home.control">Inicio</a> &gt; <a href="index.php?user_list.control">Usuarios</a> &gt; <a href="index.php?user_expand.control/<?php echo $selected_user->__get('user_id')?>"><?php echo $selected_user->__get('user_full_name')?></a> 
                    </div>
                    <a href="#" class="sobrepanel">INFORMACI&Oacute;N B&Aacute;SICA</a>
                    <div class="panel02">
                        <?php
                            $parent = ($selected_user->__get('user_parent') != 0) ? new ControlUser($selected_user->__get('user_parent')) : new User();
                        ?>
                        <div class="p_infobasica">
                            <p><span>Creado por </span><?php echo  $parent->__get('user_full_name');?></p>
                            <p><span>Fecha de Creaci&oacute;n:</span><?php echo formatDate('%d/%m/%Y', $selected_user->__get('user_creation_datetime')); ?> </p>
                            <p><span>&Uacute;ltima Modificaci&oacute;n:</span><?php echo formatDate('%d/%m/%Y', $selected_user->__get('user_update_datetime')); ?></p>
                        </div>
                    </div>
                    <?php PermissionHelper::displayDocks(3, $selected_user); ?>
                </div>
	    	</td>
            </tr>
        </table>
	<div class="clear"></div>
	</div>
</div>