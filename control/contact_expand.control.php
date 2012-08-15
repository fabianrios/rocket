<?php require_once('session_header.php');
$contacts = contactHelper::retrieveContacts();
$selected_contact = new Contact(escape($_GET[0]));
?>
<div id="contenido"> 
	<h2>Contactos recibidos</h2>
	<div class="divider">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="layout">
			<tr>
			<td width="170px">
            	<div id="sidebar1"> 
					<ul>
						<li>
							<?php
                            foreach ($contacts as $contact)
                            {
                            ?>
                                <a href="index.php?contac_expand.control/<?php echo $contact->__get('contact_id')?>" class="sidebar_01">
                                    <img src="imgcontrol/ico_tree.gif" />
                                    <span><?php echo $contact->__get('contact_date')?></span>
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
                    <h3><?php echo $contact->__get('contac_name')?></h3>
                    <div class="ruta">
                           <a href="index.php?home.control">Inicio</a> &gt; <a href="index.php?contact_list.control">Contactos</a> &gt; <a href="index.php?contac_expand.control/<?php echo $contact->__get('contact_id')?>"><?php echo $contact->__get('contact_name')?></a> 
                    </div>
                    <a href="#" class="sobrepanel2">INFORMACI&Oacute;N B&Aacute;SICA</a>
                    <div class="panel02">
                       
                    </div>
                    <?php PermissionHelper::displayDocks(12, $selected_contact); ?>
                </div>
	    	</td>
            </tr>
        </table>
	<div class="clear"></div>
	</div>
</div>