<?php
if(!isset($envelopeBags))
{
	$envelopeBags = EnvelopeBagHelper::retrieveEnvelopeBags("AND user_id = '" . $user->__get('user_id') . "' AND user_envelope_id = " . $userEnvelope->__get('user_envelope_id'));
}
?>
				<form id="expenses-form-<?php echo $userEnvelope->__get('user_envelope_id')?>">
		
				    <!-- hidden: buuuhaaahaa! -->
				    <input type="hidden" name="action" value="insert_expenses_values" />
				    <input type="hidden" name="user_envelope_id" value="<?php echo $userEnvelope->__get('user_envelope_id')?>" />
				    <input type="hidden" name="user_id" value="<?php echo $user->__get('user_id')?>" />
		    	<?php
		    	foreach($envelopeBags as $envelopeBag)
		    	{
		    		$recurringItems = EnvelopeItemHelper::retrieveEnvelopeItems("AND envelope_bag_id = " . $envelopeBag->__get('envelope_bag_id'));
					if(count($recurringItems) > 0)
					{
						$envelopeItem = $recurringItems[0];
	    	    	?>
<!-- Expenses Element -->
					<!-- new expense -->
					<div class="new-expense combine-expenses" style="display:none;" id="combine-expense-<?php echo $envelopeBag->__get('envelope_bag_id')?>" >
						<!-- new expense box -->
						<div class="new-expense-box round-1">
						<p class="text-right no-margin"><span aria-hidden="true" class="icon-cancel bluetxt"></span></p>
							<!-- container -->
							<div class="container">
							<!--form action="" method="post" id=""-->
								<a href=""><p aria-hidden="true" class="icon-x-altx-alt text-right close-icon combine-expenses-close-icon"></p></a>
								<br />
								<h6 class="greentxt">Unir Gastos</h6>
								<hr class="dotted-1" />
								<table class="blank-table centered" width="100%">
								
									<tr>
										<td>
						    			   <span class="thin">Unir</span> <strong>1</strong>
										</td>
										<td>con:</td>
										<td>
											<select>
												<option>2</option>
											</select>
										</td>
									</tr>
								</table>
								<hr class="dotted-1" />
										<input type="submit" value="Unir Gastos" class="small pretty-btn" /> o <a href="#">cancelar</a>
										<input type="hidden" name="envelope_item_recurrence" value="7" id="">
						    			<input type="hidden" name="user_id" value="<?php echo $user->__get('user_id')?>" id="">
						    			<input type="hidden" name="user_envelope_id" value="<?php echo $userEnvelope->__get('user_envelope_id')?>" id="">
								<!--/form-->		
				
							</div>
							<!-- /container -->
						</div>
						<!-- /new expense box -->
					</div>
					<!-- /new expense -->
                        <div class="expenses-box">
                        
                            <!-- sobre li tooltip -->
                              <div class="sobre-li-tooltip round-1" style="display:none" id="save-div-<?php echo $envelopeItem->__get('envelope_item_id')?>">
                                  <div class="padding-10">
                                <h6 class="text-center greytxt"><strong><span aria-hidden="true" class="icon-clock"></span> Ahorro Programado</strong></h6>
                                <hr class="dotted">
                                <p></p>
                                <!-- date -->
                                <p class="text-center">
                                    <label><span class="fs1" aria-hidden="true" data-icon="&#x76;"></span>  Inicio del ahorro</label>
                                    
                                    <select name="envelope_item_save_since_<?php echo $envelopeItem->__get('envelope_item_id')?>">
                                    	<?php
                                    	foreach(range(0, 12) as $number)
										{
											?>
											<option value="<?php echo $number?>"><?php echo $number?></option>
											<?php
										}
										?>
                                    </select>
                                    <label>Meses de anterioridad</label>
                                </p>
                                <!-- date -->
                                
                                <!-- save --> 
                                <p class="text-center"><a href="#" class="small-pretty-btn save-save-days">Guardar ahorro <span aria-hidden="true" class="icon-arrow-4"></span></a></p>
                                <!-- save -->
                                
                                </div>
                            </div>
                            <!-- sobre li tooltip -->	    			
			    			<!-- Expenses Element -->
			    			<div class="gasto-box">
			    			    <div class="gatos-recurrente-1"><!-- Expenses -->
		
			    			    
			    			    	<!-- inner padding -->
			    			    	<div class="padding-10">

		    			    				<span class="delete"><a href="<?php echo APPLICATION_URL?>envelopes.controller/delete_envelope_item/<?php echo $envelopeItem->__get('envelope_item_id')?>/envelopes.html" onclick="return confirm('<?php echo utf8_decode('¿Está seguro que desea eliminar este item?')?>')"><span class="fs1" aria-hidden="true" data-icon="&#x62;"></span> </a></span>	
			    			    		<!-- Expenses title -->
		    			    			<p class="text-left">
		    			    				<label> <strong class="title"><?php echo $envelopeItem->__get('envelope_item_name')?></strong></label>
		    			    				<input type="text" id="envelope_item_name_<?php echo $envelopeItem->__get('envelope_item_id')?>" name="envelope_item_name_<?php echo $envelopeItem->__get('envelope_item_id')?>" class="date-input" value="<?php echo $envelopeItem->__get('envelope_item_name')?>"/>
		    			    			</p>
			    			    		<hr class="dotted-1" />
			    			    		<!-- /Expenses title -->
			    			    		
			    			    		<!-- row -->
			    			    		<div class="row">
			    			    			
			    			    			<!-- value -->
			    			    			<p class="text-left">
			    			    				<label><span class="fs1" aria-hidden="true" data-icon="&#xe08c;"></span> <strong> Valor</strong></label>
								    			    <table class="blank-table-2" width="100%">
								    	    	    	<tr>
								    	    	        	<td><a href="#" class="round-left minus"><span class="fs1" aria-hidden="true" data-icon="&#x6c;"></span> </a></td>
								    	    	        	<td><input type="text" class="envelope-input" value="<?php echo formatNumber($envelopeItem->__get('envelope_item_value'), "0", ".", ".")?>" id="envelope_item_value_<?php echo $envelopeItem->__get('envelope_item_id')?>"  name="envelope_item_value_<?php echo $envelopeItem->__get('envelope_item_id')?>"/></td>
								    	    	        	<td><a href="#" class="round-right plus"><span class="fs1" aria-hidden="true" data-icon="&#x3b;"></span> </a></td>
								    					</tr>
								    	    	    </table>
			    			    			</p>
			    			    			<!-- value -->
			    			    			
			    			    			<!-- date -->
			    			    			<p class="text-left">
			    			    				<label><span class="fs1" aria-hidden="true" data-icon="&#xe086;"></span>  <strong>Fecha de ejecuci&oacute;n</strong></label>
			    			    				<input type="text" name="envelope_item_payday_<?php echo $envelopeItem->__get('envelope_item_id')?>" id="envelope_item_payday_<?php echo $envelopeItem->__get('envelope_item_id')?>" class="date-input date" value="<?php echo ($envelopeItem->__get('envelope_item_payday') !== '0000-00-00') ? formatDate('%d-%m-%Y', $envelopeItem->__get('envelope_item_payday')) : '';?>"/>
			    			    			</p>
			    			    			<!-- date -->
			    			    			
			    			    			<!-- cycle -->
			    			    			<p class="text-left clearfix">
			    			    				<label><span class="fs1" aria-hidden="true" data-icon="&#xe087;"></span>  <strong>Ciclos</strong></label>
			    			    				<a rel="<?php echo $envelopeItem->__get('envelope_item_id')?>" title="7" src="<?php echo APPLICATION_URL?>#" class="sprite-1 seven-days-small periodicity <?php if($envelopeItem->__get('envelope_item_recurrence') == 7) echo 'active-cal'?>">Siete días</a>
			    			    				<a rel="<?php echo $envelopeItem->__get('envelope_item_id')?>" title="15" src="<?php echo APPLICATION_URL?>#" class="sprite-1 fifty-days-small periodicity <?php if($envelopeItem->__get('envelope_item_recurrence') == 15) echo 'active-cal'?>">Quince días</a>
			    			    				<a rel="<?php echo $envelopeItem->__get('envelope_item_id')?>" title="30" src="<?php echo APPLICATION_URL?>#" class="sprite-1 thirty-days-small periodicity <?php if($envelopeItem->__get('envelope_item_recurrence') == 30) echo 'active-cal'?>">Treinta días</a>
			    			    				<a rel="<?php echo $envelopeItem->__get('envelope_item_id')?>" title="60" src="<?php echo APPLICATION_URL?>#" class="sprite-1 sixty-days-small periodicity <?php if($envelopeItem->__get('envelope_item_recurrence') == 60) echo 'active-cal'?>">Sesenta días</a>
			    			    				<a rel="<?php echo $envelopeItem->__get('envelope_item_id')?>" title="180" src="<?php echo APPLICATION_URL?>#" class="sprite-1 one-eighty-days-small periodicity <?php if($envelopeItem->__get('envelope_item_recurrence') == 180) echo 'active-cal'?>">Cientochenta días</a>
			    			    				<a rel="<?php echo $envelopeItem->__get('envelope_item_id')?>" title="360" src="<?php echo APPLICATION_URL?>#" class="sprite-1 three-sixty-days-small periodicity <?php if($envelopeItem->__get('envelope_item_recurrence') == 360) echo 'active-cal'?>">Trescientossenta días</a>								
			    			    			</p>
			    			    			<!-- cycle -->
			    			    			
			    			    			<label><input type="checkbox" class="active-item-<?php echo $userEnvelope->__get('user_envelope_id')?>" rel="<?php echo $envelopeItem->__get('envelope_item_id')?>" name="envelope_item_status_<?php echo $envelopeItem->__get('envelope_item_id')?>" value="1" <?php if($envelopeItem->__get('envelope_item_status') == '1') { echo "checked"; }?> /> Activar item</label>
			    			    			
			    			    			<!-- hidden: buuuhaaahaa! -->
			    			    			<input type="hidden" name="envelope_item_recurrence_<?php echo $envelopeItem->__get('envelope_item_id')?>" id="envelope_item_recurrence_<?php echo $envelopeItem->__get('envelope_item_id')?>" value="<?php echo $envelopeItem->__get('envelope_item_recurrence')?>" id="">
			    			    			<!-- /hidden: buuuhaaahaa! -->			    			    		
			    			    		</div>
			    			    		<!-- /row -->
			    			    		
			    			    	</div>
			    			    	<!-- inner padding -->
			    			    </div><!-- Expenses -->
			    			    <!--a href="#" class="button-unir grey combine-expenses" rel="<?php echo $envelopeBag->__get('envelope_bag_id')?>">Unir gastos</a-->
			    			</div>
			    			<!-- /Expenses Element -->
		    			</div>
	    			<?php
	    			}
		    	}
		    	?>
		    	</form>
				<div class="expenses-box" style="display:none;">
						<!-- Expenses Element -->
		    			<form name="expense_form" id="expense-form-<?php echo $userEnvelope->__get('user_envelope_id')?>">
                              <div class="sobre-li-tooltip round-1" style="display:none" id="save-div-prime<?php echo $userEnvelope->__get('user_envelope_id')?>">
                                  <div class="padding-10">
                                <h6 class="text-center greytxt"><strong><span class="fs1" aria-hidden="true" data-icon="&#xe087;"></span>  Ahorro Programado</strong></h6>
                                <hr class="dotted">
                                <p></p>
                                <!-- date -->
                                <p class="text-center">
                                    <label><span aria-hidden="true" class="icon-calendar"></span> Inicio del ahorro</label>
                                    
                                    <select name="envelope_item_save_since">
                                    	<?php
                                    	foreach(range(0, 12) as $number)
										{
											?>
											<option value="<?php echo $number?>"><?php echo $number?></option>
											<?php
										}
										?>
                                    </select>
                                    <label>Meses de anterioridad</label>
                                </p>
                                <!-- date -->
                                
                                <!-- save --> 
                                <p class="text-center"><a href="#" class="small-pretty-btn save-save-days">Guardar ahorro <span aria-hidden="true" class="icon-arrow-4"></span></a></p>
                                <!-- save -->
                                
                                </div>
                            </div>
		    			<div class="gasto-box">

		    			    <div class="gatos-recurrente-1"><!-- Expenses -->
	
		    			    
		    			    	<!-- inner padding -->
		    			    	<div class="padding-10">
		    			
		    			    		<!-- Expenses title -->
		    			    		<h6 class="text-left greytxt recurrente-title"><input type="text" name="envelope_item_name" class="date-input" placeholder="Nombre del Gasto"/></h6>
		    			    		<hr class="dotted-1" />
		    			    		<!-- /Expenses title -->
		    			    		
		    			    		<!-- row -->
		    			    		<div class="row">
		    			    			
		    			    			<!-- value -->
		    			    			<p class="text-left">
		    			    				<label><span class="fs1" aria-hidden="true" data-icon="&#xe08c;"></span> <strong> Valor</strong></label>
							    			    <table class="blank-table-2" width="100%">
							    	    	    	<tr>
							    	    	        	<td><a href="#" class="round-left minus"><span aria-hidden="true" class="icon-plus"></span></a></td>
							    	    	        	<td><input type="text" name="envelope_item_value" class="envelope-input" value="0"/></td>
							    	    	        	<td><a href="#" class="round-right plus"><span aria-hidden="true" class="icon-minus"></span></a></td>
							    					</tr>
							    	    	    </table>
		    			    			</p>
		    			    			<!-- value -->
		    			    			
		    			    			<!-- date -->
		    			    			<p class="text-left">
		    			    				<label><span class="fs1" aria-hidden="true" data-icon="&#xe086;"></span>  <strong>Fecha de ejecuci&oacute;n</strong></label>
		    			    				<input type="text" name="envelope_item_payday" class="date-input date" value=""/>
		    			    			</p>
		    			    			<!-- date -->
		    			    			

		    			    			
		    			    			<!-- cycle -->
		    			    			<p class="text-left clearfix">
		    			    				<label><span class="fs1" aria-hidden="true" data-icon="&#xe087;"></span>  <strong>Ciclos</strong></label>
		    			    				<a title="7" src="<?php echo APPLICATION_URL?>#" class="sprite-1 seven-days-small periodicity " rel="prime<?php echo $userEnvelope->__get('user_envelope_id')?>">Siete días</a>
		    			    				<a title="15" src="<?php echo APPLICATION_URL?>#" class="sprite-1 fifty-days-small periodicity " rel="prime<?php echo $userEnvelope->__get('user_envelope_id')?>">Quince días</a>
		    			    				<a title="30" src="<?php echo APPLICATION_URL?>#" class="sprite-1 thirty-days-small periodicity active-cal" rel="prime<?php echo $userEnvelope->__get('user_envelope_id')?>">Treinta días</a>
		    			    				<a title="60" src="<?php echo APPLICATION_URL?>#" class="sprite-1 sixty-days-small periodicity " rel="prime<?php echo $userEnvelope->__get('user_envelope_id')?>">Sesenta días</a>
		    			    				<a title="180" src="<?php echo APPLICATION_URL?>#" class="sprite-1 one-eighty-days-small periodicity " rel="prime<?php echo $userEnvelope->__get('user_envelope_id')?>">Cientochenta días</a>
		    			    				<a title="360" src="<?php echo APPLICATION_URL?>#" class="sprite-1 three-sixty-days-small periodicity " rel="prime<?php echo $userEnvelope->__get('user_envelope_id')?>">Trescientossenta días</a>								
		    			    			</p>
		    			    			<!-- cycle -->
		    			    			
		    			    			<!-- hidden: buuuhaaahaa! -->
		    			    			<input type="hidden" name="envelope_item_recurrence" value="30" id="">
		    			    			<input type="hidden" name="user_id" value="<?php echo $user->__get('user_id')?>" id="">
		    			    			<input type="hidden" name="user_envelope_id" value="<?php echo $userEnvelope->__get('user_envelope_id')?>" id="">
		    			    			<input type="hidden" name="action" value="createExpense" />
		    			    			<!-- /hidden: buuuhaaahaa! -->	
		    			    		</div>
		    			    		<!-- /row -->
		    			    		
		    			    	</div>
		    			    	<!-- inner padding -->
		    			    </div><!-- Expenses -->
		    			   
		    			   <a href="#" class="button-unir grey submit-expense-form" rel="<?php echo $userEnvelope->__get('user_envelope_id')?>">Crear Gasto</a>
		    			</div>
		    			<!-- /Expenses Element -->
		    			</form>
					</div>