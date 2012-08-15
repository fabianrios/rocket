<?php
unset($_SESSION["verifyed_envelopes"]);
unset($_SESSION["updated_envelopes"]);

if(!isset($_SESSION["verifyed_envelopes"]) && isset($_SESSION["user_active"]))
{

	$envelopes = EnvelopeHelper::retrieveEnvelopes();
	// VERIFICO QUE LOS SOBRES POR DEFECTO EXISTAN PARA EL USUARIO
	foreach($envelopes as $envelope)
	{
		$userEnvelopeArray = UserEnvelopeHelper::retrieveUserEnvelopes("AND user_id = " . $user->__get('user_id') . " AND envelope_id = " . $envelope->__get('envelope_id')); 
		if(count($userEnvelopeArray) == 0)
		{

			// SI EL SOBRE NO EXISTE, CREO EL SOBRE DEL USUARIO
			$userEnvelope = new UserEnvelope();
			$userEnvelope->__set('user_envelope_name', $envelope->__get('envelope_name'));
			$userEnvelope->__set('user_envelope_created_date', date('Y-m-d H:i:s'));
			$userEnvelope->__set('envelope_id', $envelope->__get('envelope_id'));
			$userEnvelope->__set('user_id', $user->__get('user_id'));
			$userEnvelopeResult = $userEnvelope->save();
			
			// ITEMS RECURRENTE POR DEFECTO DE CADA SOBRE
			$envelopeDefaultItems = explode('|', $envelope->__get('envelope_recurring_fields'));
			
			foreach($envelopeDefaultItems as $envelopeDefaultItem)
			{
				if(trim($envelopeDefaultItem) != '')
				{					
					// CREO BOLSAS DE ITEMS POR DEFECTO
					$envelopeBag		= new EnvelopeBag();
					$envelopeBag->__set('envelope_bag_name', $envelopeDefaultItem);
					$envelopeBag->__set('user_id', $user->__get('user_id'));
					$envelopeBag->__set('user_envelope_id', $userEnvelopeResult['insert_id']);
					$envelopeBagResult	= $envelopeBag->save();
					
					// CREO ITEM DE LA BOLSA				
					$envelopeItem		= new EnvelopeItem();
					$envelopeItem->__set('envelope_item_name', $envelopeDefaultItem);
					$envelopeItem->__set('envelope_bag_id', $envelopeBagResult["insert_id"]);
					$envelopeItem->__set('user_id', $user->__get('user_id'));
					$envelopeItem->__set('user_envelope_id', $userEnvelopeResult['insert_id']);
					$envelopeItem->__set('envelope_item_status', 0);
					$envelopeItem->save();
				}
			}
		}
	}
$_SESSION['verifyed_envelopes'] = true;
}
// ACTUALIZACIÓN DE ESTADO
if(!isset($_SESSION["updated_envelopes"]) && isset($_SESSION["user_active"]))
{
	$userEnvelopes	= UserEnvelopeHelper::retrieveUserEnvelopes("AND user_id = " . $user->__get('user_id'));
	
	foreach($userEnvelopes as $userEnvelope)
	{
		// BUSCO LOS ÚLTIMOS LOGS
		
		$userEnvelopeLogArray = UserEnvelopeLogHelper::retrieveUserEnvelopeLogs("AND user_id = " . $user->__get('user_id') . " AND user_envelope_id = " . $userEnvelope->__get('user_envelope_id') . " ORDER BY user_envelope_log_date DESC LIMIT 0,1");
		
		// HAY LOGS ANTERIORES
		if(count($userEnvelopeLogArray) > 0)
		{
			$userEnvelopeLog = $userEnvelopeLogArray[0];
			$date = $userEnvelopeLog->__get('user_envelope_log_date');
		}
		// NO HAY LOGS ANTERIORES
		else
		{
			$date = date('Y-m-d');
		}
		
		// ESTABLEZCO FECHA DE INICIO DE LOGS Y FECHA FINAL
		$startTime 			= strtotime($date);
		$endTime 			= strtotime(date('Y-m-d'));
		$recurringItemDates = array();
		
		// BUSCO GASTOS DIARIOS DESDE EL ÚLTIMO LOG
		for ($i = $startTime; $i <= $endTime; $i = $i + 86400) 
		{
			// ASIGNO FECHA ACTUAL
			$currentDate = date('Y-m-d', $i);
			
			// SACO ITEMS DE LA FECHA
			$userEnvelopeItemArray	= EnvelopeItemHelper::retrieveEnvelopeItems("AND user_id = " . $user->__get('user_id') . " AND user_envelope_id = " . $userEnvelope->__get('user_envelope_id') . " AND envelope_item_payday LIKE '%" . date('-d', $i) . "' AND envelope_item_last_log_date <= '" . date('Y-m-d') . "' AND envelope_item_save != 1 AND envelope_item_status = 1");
			
			// SACO EXTRAS DE LA FECHA PARA LOGUEARLOS
			$userEnvelopeExtraItemArray	= EnvelopeItemHelper::retrieveEnvelopeItems("AND user_id = " . $user->__get('user_id') . " AND user_envelope_id = " . $userEnvelope->__get('user_envelope_id') . " AND envelope_item_payday = '" . date('Y-m-d', $i) . "' AND envelope_bag_id = 0 AND envelope_item_save != 1 AND envelope_item_save != 1 AND envelope_item_status = 1");		
	
			$envelopeInfo 					= array();				
			// ENTRA SI HAY ITEMS PARA ESTA FECHA
			if(count($userEnvelopeItemArray) > 0)
			{
				$envelopeInfo['UserEnvelope']	= $userEnvelope;
				
				// RECORRO LOS ITEMS DE LA FECHA
				foreach($userEnvelopeItemArray as $userEnvelopeItem)
				{
					if($userEnvelopeItem->__get('envelope_item_last_log_date') == '0000-00-00 00:00:00')
						$userEnvelopeItem->__set('envelope_item_last_log_date', strtotime(date('Y-m-d', $currentItemDate) . "-1 days"));
					// ENTRA SI LA ÚLTIMA FECHA DE LOG ES MENOR QUE LA FECHA FINAL
					if(strtotime($userEnvelopeItem->__get('envelope_item_last_log_date')) <= $endTime)
					{
						// SI LA RECURRENCIA ES MENOR/IGUAL A 30
						if($userEnvelopeItem->__get('envelope_item_recurrence') <= 30)
						{
							
							// SI LA RECURRENCIA ES MENOR A 30
							if($userEnvelopeItem->__get('envelope_item_recurrence') < 30)
							{
								if($userEnvelopeItem->__get('envelope_item_recurrence') == 0)
								{
									$envelopeInfo['EnvelopeItems'][$userEnvelopeItem->__get('envelope_item_id')] = $userEnvelopeItem;
									$userEnvelopeItem->__set('envelope_item_last_log_date', date('Y-m-d', strtotime(date('Y-m-d') . '+10 years')));
									$userEnvelopeItem->update();
								}
								else
								{
									$currentItemDate	= strtotime($userEnvelopeItem->__get('envelope_item_last_log_date') . "+" . $userEnvelopeItem->__get('envelope_item_recurrence') . " days");
									$count = 0;
									while($endTime <= $currentItemDate)
									{
										switch($userEnvelopeItem->__get('envelope_item_recurrence')):
											case 7:
												$addValue = "+7 days";
												break;
											case 15:
												$addValue = "+15 days";
												break;
											case 30:
												$addValue = "+1 month";
												break;
											case 60:
												$addValue = "+2 months";
												break;
											case 180:
												$addValue = "+6 months";
												break;
											case 360:
												$addValue = "+1 year";
												break;
										endswitch;
										$recurringItemDates[$currentItemDate][]	= $userEnvelopeItem;
										$currentItemDate	= strtotime(date('Y-m-d', $currentItemDate) . $addValue);
										$count++;
										if($count > 50)
										{
											echo 1;
											break;
										}
									}
								}
							}
							else
							{
								$envelopeInfo['EnvelopeItems'][$userEnvelopeItem->__get('envelope_item_id')] = $userEnvelopeItem;
								$userEnvelopeItem->__set('envelope_item_last_log_date', date('Y-m-d', $i));
								$userEnvelopeItem->update();
							}
						}
						// SI LA RECURRENCIA ES MAYOR A 30
						else
						{
							$currentItemDate	= strtotime($userEnvelopeItem->__get('envelope_item_last_log_date') . "+" . $userEnvelopeItem->__get('envelope_item_recurrence') . " days");
							if($userEnvelopeItem->__get('envelope_item_save') == 0)
							{
								$count = 0;
								while($endTime >= $currentItemDate)
								{
									switch($userEnvelopeItem->__get('envelope_item_recurrence')):
										case 7:
											$addValue = "+7 days";
											break;
										case 15:
											$addValue = "+15 days";
											break;
										case 30:
											$addValue = "+1 month";
											break;
										case 60:
											$addValue = "+2 months";
											break;
										case 180:
											$addValue = "+6 months";
											break;
										case 360:
											$addValue = "+1 year";
											break;
									endswitch;
									$recurringItemDates[$currentItemDate][]	= $userEnvelopeItem;
									$currentItemDate	= strtotime(date('Y-m-d', $currentItemDate) . $addValue);
									$count++;
									if($count > 50)
									{
										echo 2;
										break;
									}
								}							
							}
							
						}
					}
					
				}
			}
	
			$userEnvelopesSaveItems = EnvelopeItemHelper::retrieveEnvelopeItems("AND user_id = " . $user->__get('user_id') . " AND user_envelope_id = " . $userEnvelope->__get('user_envelope_id') . " AND envelope_item_last_log_date < '" . date('Y-m-d') . "' AND envelope_item_save != 0 AND envelope_item_status = 1");
			
			if(count($userEnvelopesSaveItems) > 0)
			{
				$envelopeInfo['UserEnvelope']	= $userEnvelope;
				foreach($userEnvelopesSaveItems as $userEnvelopeSaveItem)
				{
					$payDate	= $userEnvelopeSaveItem->__get('envelope_item_payday');
					$startDate 	= strtotime($payDate . "-" . $userEnvelopeSaveItem->__get('envelope_item_save_since') . " months");
					$count = 0;
					while(strtotime($payDate) < $i)
					{
						switch($userEnvelopeSaveItem->__get('envelope_item_recurrence')):
							case 7:
								$addValue = "+7 days";
								break;
							case 15:
								$addValue = "+15 days";
								break;
							case 30:
								$addValue = "+1 month";
								break;
							case 60:
								$addValue = "+2 months";
								break;
							case 180:
								$addValue = "+6 months";
								break;
							case 360:
								$addValue = "+1 year";
								break;
						endswitch;
						$payDate	= date('Y-m-d', strtotime($payDate . $addValue));
						$startDate 	= strtotime($payDate . "-" . $userEnvelopeSaveItem->__get('envelope_item_save_since') . " months");			
						$count++;
						if($count > 50)
						{
							echo 3;
							break;
						}				
					} 
					$count = 0;
					while($startDate <= $i)
					{
						if($startDate <= $payDate)
						{
							$newValue							= $userEnvelopeSaveItem->__get('envelope_item_value') / $userEnvelopeSaveItem->__get('envelope_item_save_since');
							$userEnvelopeSaveItem->__set('envelope_item_value', $newValue);
							$recurringItemDates[$startDate][]	= $userEnvelopeSaveItem;
							$startDate							= strtotime(date('Y-m-d', $startDate) . "+1 months");
						}
						else
							break;
						$count++;
						if($count > 50)
						{
							echo 4;
							break;
						}	
					}
				}
			}
			
			if(isset($recurringItemDates[$i]))
			{
				foreach($recurringItemDates[$i] as $recurringItem)
				{
					$envelopeInfo['EnvelopeItems'][$recurringItem->__get('envelope_item_id')] = $recurringItem;
					$recurringItem->__set('envelope_item_last_log_date', date('Y-m-d', $i));
					$recurringItem->update();
				}
			}
	
			if(count($userEnvelopeExtraItemArray) > 0)
			{
				$envelopeInfo['UserEnvelope']	= $userEnvelope;
				// INGRESO ITEMS EXTRAS
				foreach($userEnvelopeExtraItemArray as $userEnvelopeExtraItem)
				{
					$envelopeInfo['EnvelopeItems'][$userEnvelopeExtraItem->__get('envelope_item_id')] = $userEnvelopeExtraItem;
				}		
			}
			if(isset($envelopeInfo['UserEnvelope']) && (count($envelopeInfo['UserEnvelope']) > 0))
			{
				$previousLogs 	 = UserEnvelopeLogHelper::retrieveUserEnvelopeLogs("AND user_envelope_log_date = '" . date('Y-m-d') . "'");
				if(count($previousLogs) == 0)
				{
					$userEnvelopeLog = new UserEnvelopeLog();
					$userEnvelopeLog->__set('user_id', $user->__get('user_id'));
					$userEnvelopeLog->__set('user_envelope_id', $userEnvelope->__get('user_envelope_id'));
					$userEnvelopeLog->__set('user_envelope_log_data', serialize($envelopeInfo));
					$userEnvelopeLog->__set('user_envelope_log_date', date('Y-m-d', $i));
					$userEnvelopeLog->save();
				}
				else
				{
					
					$userEnvelopeLog = $previousLogs[0];
					$userEnvelopeLog->__set('user_id', $user->__get('user_id'));
					$userEnvelopeLog->__set('user_envelope_id', $userEnvelope->__get('user_envelope_id'));
					$userEnvelopeLog->__set('user_envelope_log_data', serialize($envelopeInfo));
					$userEnvelopeLog->__set('user_envelope_log_date', date('Y-m-d', $i));
					$userEnvelopeLog->update();					
				}
			}
			unset($envelopeInfo);
		}
		
	}
	$_SESSION["updated_envelopes"] = true;
}
?>