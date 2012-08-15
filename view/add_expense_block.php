							<div class="ultimo-gasto-block" id="add-expense" style="display:none;">								
								<div class="ultimos-gasto-items"><!-- Ultimos gastos Table -->
									<div class="container-2">
									<p class="grey no-margin"><strong>Agregar Nuevo Gasto</strong></p>
									<form name="form-1" id="expenses-form" action="<?php echo APPLICATION_URL?>envelopes.controller.html" method="post">
										<input type="hidden" name="action" value="insert_extra_values" />
										<input type="hidden" name="user_id" value="<?php echo $user->__get('user_id')?>" />
										<table summary="Table summary" width="100%" class="table-gastos">
											 <thead>
											 <tr>
											  <th scope="col" width="30%">Nombre</th>
											  <th scope="col" width="20%">Sobre</th>
											  <th scope="col" width="15%">Categor&iacute;a</th>
											  <th scope="col" width="20%">Monto</th>
											  <th scope="col" width="10%">Fecha</th>
											  <th scope="col" width="5%"></th>
											</tr>
											</thead>
											<tr>
												<td><input type="text" name="envelope_item_name" class="input-nice-2 sprite-1 pencil-icon" value=""/></td>
												<td>							
													<select name="user_envelope_id" id="envelope_id">
														<option>Seleccione</option>
														<?php
														
														foreach($userEnvelopes as $userEnvelope)
														{
															$selected = "";
															if(isset($selectedUserEnvelope) && ($selectedUserEnvelope->__get('user_envelope_id') == $userEnvelope->__get('user_envelope_id')))
															{
																$selected = 'selected="selected"';
															}
																
															?>
															<option <?php echo $selected?> value="<?php echo $userEnvelope->__get('user_envelope_id')?>"><?php echo $userEnvelope->__get('user_envelope_name') ?></option>
															<?php
														}
														?>
													</select>
												</td>	
												<td id="category_select">	
													<?php 
													$envelopeCategories = array();
													if(isset($selectedUserEnvelope))
														$envelopeCategories = EnvelopeCategoryHelper::retrieveEnvelopeCategories("AND envelope_id = " . $selectedUserEnvelope->__get('envelope_id'));
													?>									
													<select name="envelope_category_id">
														<option>Seleccione</option>
														<?php
														foreach($envelopeCategories as $envelopeCategory)
														{
															?>
															<option value="<?php echo $envelopeCategory->__get('envelope_category_id')?>"><?php echo $envelopeCategory->__get('envelope_category_name')?></option>
															<?php
														}
														?>
													</select>
												</td>
												<td><input type="text" name="envelope_item_value" class="input-nice-2 sprite-1 dollar-icon" value=""/></td>
												<td>			
													<input type="text" name="envelope_item_payday" class="calendar-input2" />							
												</td>
											  	<td><a href="javascript:void(0);" onclick="$('#expenses-form').submit();" class="button-small radious green-bg">Agregar</a></td>
											</tr>

										</table>
									</form>
									</div>
								</div><!-- end Ultimos gastos Table -->
								</div>