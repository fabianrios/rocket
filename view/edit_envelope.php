<?php
require(SITE_VIEW . "envelope_date_checker.php");
$envelope = new Envelope($userEnvelope->__get('envelope_id'));
?>
<!-- Envelope Block-->
<div class="expand-box left" style="display:none;" id="editenvelope-<?php echo $userEnvelope->__get('user_envelope_id')?>">
	
	<!-- Loading -->
	<div class="loading-sobre" id="loading-<?php echo $userEnvelope->__get('user_envelope_id')?>" style="display:none;">icon</div>
	<!-- /Loading -->
							
	<div class="sobre-expand left"><!-- Expanded Envelope -->
		
		<!-- Pointer -->
		<div class="sprite-1 pointer pos-<?php echo $count?>" id="pointer-<?php echo $userEnvelope->__get('user_envelope_id')?>" style="display:none;">Pointer</div>
		<!-- /Pointer -->
		
		<div class="shadow"><img src="<?php echo APPLICATION_URL?>images/shadow-02.png" alt="shadow-1" width="750" height="18" /></div>
		
		<!-- form -->

		    <!-- /hidden: buuuhaaahaa! -->
		
		    
		    <!-- Row: Title, Envelope Description, Budget & Priority -->
		    <div class="row">
		    	<!-- Inner container 20px padding -->
		   		 <div class="container">
		    
		    		<!-- Envelope Title -->
		    		<h4>
		    			<div aria-hidden="true" class="btn-envelope left" data-icon="&#x74;"></div>
		    			<strong class="grey"><?php echo $userEnvelope->__get('user_envelope_name')?></strong>
		    			<span class="explain"><?php echo $envelope->__get('envelope_text')?></span>

		    		</h4>
		    		<hr class="dotted" />

		    		<!-- /Envelope Title -->
		    		<!-- /row -->
		    		<form id="envelope-form-<?php echo $userEnvelope->__get('user_envelope_id')?>">
		    	    <div class="row">
		    	    	<!-- Envelope Description Block -->
		    	    	<div class="envelope-description three columns">
		    	    		<blockquote>"As&iacute;gnale un valor a cada sobre, es recomendable hacerlo para poder llevar una trayectoria de tus gastos"</blockquote>
		    	    	</div>
		    	    	<!-- Envelope Description Block -->
		    	    	
		    	    	<!-- Budget Block -->
		    	    	<div class="budget four columns">
		    	    	    <label class="no-margin"><span class="fs1" aria-hidden="true" data-icon="&#xe08c;"></span><strong> Monto para los gastos del mes</strong></label>
		    	    	    <small class="explain-2">Cuanto dinero tienes planeado asignar a este sobre</small>
		    	    	    
		    	    	    <table class="blank-table-2" width="100%">
		    	    	    	<tr>
		    	    	        	<td><a href="#" class="round-left minus"><span aria-hidden="true" data-icon="l"></span></a></td>
		    	    	        	<td><input class="envelope-input expand bluetxt"  type="text" value="<?php echo $userEnvelope->__get('user_envelope_budget')?>" name="user_envelope_budget" id="_<?php echo $userEnvelope->__get('user_envelope_id')?>" placeholder="Monto"/></td>
		    	    	        	<td><a href="#" class="round-right plus"><span aria-hidden="true" data-icon=";"></span></a></td>
		    					</tr>
		    	    	    </table>
		    	    	</div>
		    	    	<!-- /Budget Block -->
		    			
		    			<!-- hidden: buuuhaaahaa! -->
		    			<input type="hidden" name="user_envelope_periodicity" value="30" id="user_envelope_periodicity_<?php echo $userEnvelope->__get('user_envelope_id')?>">
		    			<!-- hidden: buuuhaaahaa! -->
		    	    			
		    	    	<!-- Priority Block -->
		    	    	<div class="clearfix four columns priority-block">
		    	    	    <label class="no-margin"><span class="fs1" aria-hidden="true" data-icon="&#x61;"></span> <strong>Prioridad</strong></label>
		    	    	    <small class="explain-2">Cuanto dinero tienes planeado asignar a este sobre</small>
		    	    	    	<a title="3" src="<?php echo APPLICATION_URL?>#" class="prioridad-baja  round-left priority <?php if($userEnvelope->__get('user_envelope_priority') == 3) echo 'selected'?>">Baja</a>
		    	    	    	<a title="2" src="<?php echo APPLICATION_URL?>#" class="prioridad-media  priority <?php if($userEnvelope->__get('user_envelope_priority') == 2) echo 'selected'?>">Media</a>
		    	    	    	<a title="1" src="<?php echo APPLICATION_URL?>#" class="prioridad-alta  round-right priority <?php if($userEnvelope->__get('user_envelope_priority') == 1) echo 'selected'?>">Alta</a>
		    	    	</div>
		    	    	<input type="hidden" name="user_envelope_priority" value="<?php echo $userEnvelope->__get('user_envelope_priority')?>" id="user_envelope_priority_<?php echo $userEnvelope->__get('user_envelope_id')?>">
		    	    	 <!-- /Priority Block -->
		    		</div>
		    		<input type="hidden" name="envelope_item_recurrence" value="7" id="">
		    			<!--input type="submit" value="Unir Gastos" class="small pretty-btn" /> o <a href="#">cancelar</a-->
						<input type="hidden" value="insert_envelope_values" name="action" />
		    			<input type="hidden" name="user_id" value="<?php echo $user->__get('user_id')?>" id="">
		    			<input type="hidden" name="user_envelope_id" value="<?php echo $userEnvelope->__get('user_envelope_id')?>" id="">
		    		</form>
		    		<!-- /row -->
		    	</div>
		    	<!-- /Inner container 20px padding -->
		    	
		    	<!-- hidden: buuuhaaahaa! -->
		    	
		    	<!-- /hidden: buuuhaaahaa! -->
		    	    
		    </div>
		    <!-- Row: Title, Envelope Description, Budget & Priority -->

			<!-- Row: Recurring Expenses -->
			<div class="row recurring-expense clearfix">
		    	
		    	<!-- Recurring Expenses title -->
		    	<h5 class="text-center greytxt"><span class="fs1" aria-hidden="true" data-icon="&#xe086;"></span> Gastos Programados</strong></h5>
		    	<br />
		    	<!-- /Recurring Expenses title -->
		    	
		    	<div class="row">
		    		<div class="container">
						<!--div class="total-bar-expenses">
					    	<div class="clearfix bar2-expenses">
					    	    <div class="green-bar-expenses left round-left" style="width:0%">
					    	    	<div class="padding-5 clearfix bar2-expenses">
					    	    		0% Gastos <strong class="grey"><?php echo $userEnvelope->__get('user_envelope_name')?></strong>
					    	    	</div>
					    	    </div>
					    	</div>
					    </div-->	
					    <h6 class="text-right thin greytxt">Monto para los gastos del mes: <strong>$<?php echo formatNumber($userEnvelope->__get('user_envelope_budget'), "0", ".", ".")?></strong></h6>
					    <hr class="dotted" />	    	
		    		</div>
		    		
		    	</div>
				<div id="expenses-<?php echo $userEnvelope->__get('user_envelope_id')?>">
				<?php
				require(SITE_VIEW . 'expenses_div.php');
				?>	
				</div>		
		    	<!-- New Expenses Element -->
		    		<div class="gastos-recurrente-new"><!-- New Expenses -->
		    			<a href="#" class="agregar-gasto create-expense">+</a>
		    			<br />
		    			<h6 rel="<?php echo $userEnvelope->__get('envelope_id')?>" class="greentxt text-center">Agregar Gasto</h6>
		    		</div><!-- New Expenses -->
				<!-- /New Expenses Element -->					
			</div>
			<!-- Row: Recurring Expenses -->
		
		   <!--  Save button -->
		    <div class="btn-action clearfix text-center">
		    	<a src="<?php echo APPLICATION_URL?>#" class="pretty-btn save-envelope" id="save-<?php echo $userEnvelope->__get('user_envelope_id')?>">Guardar</a>
		    </div>
		    <!--  Save button -->
		    
		<div class="shadow"><img src="<?php echo APPLICATION_URL?>images/shadow-03.png" alt="shadow-1" width="750" height="18" /></div>

	</div><!-- Expanded Envelope -->
</div>
<!-- /Envelope Block-->