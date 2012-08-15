<?php require_once('session_header.php');
$roles 		   = RoleHelper::retrieveRoles();
$selected_role = new Role(escape($_GET[0])); 
?>
<div id="contenido"> 
	<h2>Roles</h2>
	<div class="divider">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="layout">
			<tr>
			<td width="170px">
            	<div id="sidebar1"> 
					<ul>
						<li>
							<?php
                            foreach ($roles as $role)
                            {
                            ?>
                                <a href="index.php?role_expand.control/<?php echo $role->__get('role_id')?>" class="sidebar_01">
                                    <img src="imgcontrol/ico_tree.gif" />
                                    <span><?php echo $role->__get('role_name')?></span>
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
                    <h3><?php echo $selected_role->__get('role_name')?></h3>
                    <div class="ruta">
                           <a href="index.php?home.control">Inicio</a> &gt; <a href="index.php?role_list.control">Roles</a> &gt; <a href="index.php?role_expand.control/<?php echo $selected_role->__get('role_id')?>"><?php echo $selected_role->__get('role_name')?></a> 
                    </div>
                    <?php PermissionHelper::displayDocks(2, $selected_role); ?>
                </div>
	    	</td>
            </tr>
        </table>
	<div class="clear"></div>
	</div>
</div>