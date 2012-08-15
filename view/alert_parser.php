										<?php
										foreach($alerts as $key => $value)
										{
											switch($key):
												case 'warnings':
													foreach($alerts["warnings"] as $key => $value)
													{
														switch($key):
															case 'exceded':
																foreach($alerts["warnings"]["exceded"] as $alertData)
																{
																	$alertData = explode('|', $alertData);
																	?>
																	<tr class="tr-higlight"> 
																		<td width="5%"><div class="sprite-1 alert-icon">icon</div></td>
																		<td width="80%"><p><strong class="alert-title red">Se ha pasado del limite en su sobre <?php echo $alertData[0]?></strong><br />Sus gastos suman $<?php echo $alertData[1]?> y su meta es de <?php echo $alertData[2]?></p></td>
																		<td width="15%" class="text-right"></td>
																	</tr>
																	<?php
																}
																break;
															case 'maxed':
																foreach($alerts["warnings"]["maxed"] as $alertData)
																{
																	$alertData = explode('|', $alertData);
																	?>
																	<tr class="tr-higlight"> 
																		<td width="5%"><div class="sprite-1 alert-icon">icon</div></td>
																		<td width="80%"><p><strong class="alert-title red">Ha llegado al l&iacute;mite en su sobre <?php echo $alertData[0]?></strong><br />Sus gastos suman $<?php echo $alertData[1]?> y su meta es de <?php echo $alertData[2]?></p></td>
																		<td width="15%" class="text-right"></td>
																	</tr>
																	<?php
																}
																break;
															case 'almost-maxed':
																foreach($alerts["warnings"]["almost-maxed"] as $alertData)
																{
																	$alertData = explode('|', $alertData);
																	?>
																	<tr class="tr-higlight"> 
																		<td width="5%"><div class="sprite-1 alert-icon">icon</div></td>
																		<td width="80%"><p><strong class="alert-title red">Est&aacute; llegando al l&iacute;mite en su sobre <?php echo $alertData[0]?></strong><br />Sus gastos suman $<?php echo $alertData[1]?> y su meta es de <?php echo $alertData[2]?></p></td>
																		<td width="15%" class="text-right"></td>
																	</tr>
																	<?php
																}
																break;
														endswitch;
													}
													break;
												case 'reminders':
													$count = 0;
													foreach($alerts["reminders"] as $key => $value)
													{
														if(isset($value[$count]))
														{
															$value = explode('|', $value[$count]);
														?>
														<tr>
															<td width="5%"><div class="sprite-1 reminder-icon">icon</div></td>
															<td width="80%"><p><?php echo $value[0]?></p></td>
															<td width="15%" class="text-right"><strong class="green"><?php echo date('d \d\e M', $key)?></strong></td>
														</tr>
														<?php
														}
														$count++;
													}
													break;
												case 'soon-expiring':
													$count = 0;
													foreach($alerts["soon-expiring"] as $key => $value)
													{
														
														if(isset($value[$count]))
														{
															$value = explode('|', $value[$count]);
														?>
														<tr>
															<td width="5%"><div class="sprite-1 cal-icon">icon</div></td>
															<td width="80%"><p>Su pago <?php echo $value[$count]?> vence el <strong class="blue"><?php echo date('d \d\e F', $key)?></strong></p></td>
															<td width="15%" class="text-right"></td>
														</tr>
														<?php
														}
														$count++;
													}
													break;
											endswitch;
											?>
											
											<?php
										}
										?>