<?php
$action = isset($_POST['action']) ? $_POST['action'] : $_GET[0];
switch($action):
	case 'insert_envelope_values':
		$user 				= new User($_POST['user_id']);
		$userEnvelope			= new UserEnvelope($_POST['user_envelope_id']);	
		if(isset($_POST['user_envelope_budget']))
		{
		//$recurringItems 	= explode('|', $envelope->__get('envelope_recurring_fields'));
		//$userEnvelopeArray	= UserEnvelopeHelper::retrieveUserEnvelopes("AND user_id = " . $user->__get('user_id') . " AND envelope_id = " . $envelope->__get('envelope_id') . " ORDER BY user_envelope_id DESC");
		/*if(count($userEnvelopeArray) > 0)
			$userEnvelope	=& $userEnvelopeArray[0];
		else
			$userEnvelope	= new UserEnvelope();*/
		foreach($_POST as $key => $value)
			$userEnvelope->__set($key, $value);
		
		$userEnvelope->__set('user_envelope_budget', str_replace('.', '', $_POST['user_envelope_budget']));
		if(isset($_POST['envelope_item_save']))
			$userEnvelope->__set('envelope_item_save', 1);
		else
			$userEnvelope->__set('envelope_item_save', 0);
		
		 
		 /*$recurringDataArray = array();
		
		foreach($recurringItems as $recurringItem)
		{
			if(!empty($recurringItem))
			{
							
				$recurringItemInfo	= explode('=>', $recurringItem);
				$label				= $recurringItemInfo[0];
				$field				= $recurringItemInfo[1];
				
				
				$recurringDataArray[$field . '_amount'] 		= $_POST[$field . '_amount'];
				$recurringDataArray[$field . '_periodicity'] 	= $_POST[$field . '_periodicity'];
				$recurringDataArray[$field . '_payday'] 		= $_POST[$field . '_payday'];	
			}
		}	
		$userEnvelope->__set('user_envelope_recurring_data', serialize($recurringDataArray));
		
		if(count($userEnvelopeArray) > 0)
		{*/
			$userEnvelope->update();
			$userEnvelopeId = $userEnvelope->__get('user_envelope_id');
		/*}
		else
		{
			$envelopeDate	= date('Y-m-01');
			if($userEnvelope->__get('user_envelope_periodicity') < 30)
			{
				$currentDate	= date('Y-m-d');
				while(!$foundDate)
				{
					if(strtotime($envelopeDate . "+" . $userEnvelope->__get('user_envelope_periodicity') . " days") > $strtotime($currentDate))
						$foundDate = true;
					else
						$envelopeDate = date("Y-m-d", strtotime($envelopeDate . "+" . $userEnvelope->__get('user_envelope_periodicity') . " days"));
					
				}
			}
			$userEnvelope->__set('user_envelope_date', $envelopeDate);
			$userEnvelopeResult	= $userEnvelope->save();		
			$userEnvelopeId 	= $userEnvelopeResult["insert_id"];		
		}	*/	
		//echo '<strong>$' . formatNumber($_POST['user_envelope_budget'], 0, ",", ",") . '</strong>';	
		}
		
		break;
		case 'insert_expenses_values':
			$userEnvelope = new UserEnvelope($_POST['user_envelope_id']);
			$user		  = new User($_POST['user_id']);
			$envelopeBags = EnvelopeBagHelper::retrieveEnvelopeBags("AND user_id = '" . $user->__get('user_id') . "' AND user_envelope_id = " . $userEnvelope->__get('user_envelope_id'));
			foreach($envelopeBags as $envelopeBag)
			{
				$recurringItems = EnvelopeItemHelper::retrieveEnvelopeItems("AND envelope_bag_id = " . $envelopeBag->__get('envelope_bag_id') . " LIMIT 0,1");
				
				if(count($recurringItems) > 0)
				{
					
					$envelopeItem = $recurringItems[0];
					if(isset($_POST['envelope_item_status_' . $envelopeItem->__get('envelope_item_id')]) && ($_POST['envelope_item_status_' . $envelopeItem->__get('envelope_item_id')] == 1))
					{
						foreach($_POST as $key => $value)
						{
							if(strpos($key, '_' . $envelopeItem->__get('envelope_item_id')) !== false)
							{
								if(str_replace('_' . $envelopeItem->__get('envelope_item_id'), '', $key) == 'envelope_item_value')
									$value = str_replace('.', '', $value);
								if(str_replace('_' . $envelopeItem->__get('envelope_item_id'), '', $key) == 'envelope_item_save_since')
								{
									if(intval($value) > 0)
										$envelopeItem->__set('envelope_item_save', 1);
									else
										$envelopeItem->__set('envelope_item_save', 0);
								}
								if(str_replace('_' . $envelopeItem->__get('envelope_item_id'), '', $key) == 'envelope_item_payday')
								{
									$value = date('Y-m-d', strtotime($value));
								}
									
								$envelopeItem->__set(str_replace('_' . $envelopeItem->__get('envelope_item_id'), '', $key), $value);
							}
						}
					}
					else
					{
						$envelopeItem->__set('envelope_item_status', 0);
					}
					$envelopeItem->update();
				}
			}
			break;
		case 'insert_extra_values':
			$envelopeItem  = new EnvelopeItem();
			foreach($_POST as $key => $value)
				$envelopeItem->__set($key, $value);
			$envelopeItem->__set('envelope_item_payday', date('Y-m-d', strtotime($_POST['envelope_item_payday'])));
			$envelopeItem->__set('envelope_item_status', 1);
			$envelopeItem->save();
			

			
			$userEnvelopeLogArray = UserEnvelopeLogHelper::retrieveUserEnvelopeLogs("AND user_id = " . $envelopeItem->__get('user_id') . " AND user_envelope_id = '" . $envelopeItem->__get('user_envelope_id') . "' AND user_envelope_log_date = '" . $envelopeItem->__get('envelope_item_payday') . "'");
			
			if(count($userEnvelopeLogArray) > 0)
			{
				
				$userEnvelopeLog 		= $userEnvelopeLogArray[0];
				$userEnvelopeLogData 	= unserialize($userEnvelopeLog->__get('user_envelope_log_data'));
				$userEnvelopeLogData['EnvelopeItems'][$envelopeItem->__get('envelope_item_id')] = $envelopeItem;
				$userEnvelopeLogData 	= serialize($userEnvelopeLogData);
				$userEnvelopeLog->__set('user_envelope_log_data', $userEnvelopeLogData);
				$userEnvelopeLog->update();
				
			}
			else
			{
				$userEnvelopeLogData 	= array();
				$userEnvelope 			= new UserEnvelope($envelopeItem->__get('user_envelope_id'));
				$userEnvelopeLog 		= new UserEnvelopeLog();
				$userEnvelopeLogData['UserEnvelope'] = $userEnvelope;
				$userEnvelopeLogData['EnvelopeItems'][$envelopeItem->__get('envelope_item_id')] = $envelopeItem;
				$userEnvelopeLogData 	= serialize($userEnvelopeLogData);
				$userEnvelopeLog->__set('user_envelope_log_data', $userEnvelopeLogData);
				$userEnvelopeLog->__set('user_envelope_id', $userEnvelopeLogData);
				$userEnvelopeLog->__set('user_id', $envelopeItem->__get('user_id'));
				$userEnvelopeLog->__set('user_envelope_log_date', $envelopeItem->__get('envelope_item_payday'));
				$userEnvelopeLog->save();
			}
			unset($_SESSION["updated_envelopes"]);
			redirectUrl(APPLICATION_URL . 'sobres-040.html');
			break;
		case 'delete_recurring_expense':
			$key	= escape($_GET[1]);
			$userEnvelopeArray	= UserEnvelopeHelper::retrieveUserEnvelopes("AND user_id = " . $_SESSION['user_active'] . " AND user_envelope_recurring_data LIKE '%" . $key . "%'");

			if(count($userEnvelopeArray) > 0)
			{

				$userEnvelope 			=& $userEnvelopeArray[0];
				$recurringData 			= unserialize($userEnvelope->__get('user_envelope_recurring_data'));
				$recurringData[$key] 	= '';
				$userEnvelope->__set('user_envelope_recurring_data', serialize($recurringData));
				$userEnvelope->update();
			}
			if(isset($_GET[1]) && ($_GET[1] == 'envelopes'))
				redirectUrl(APPLICATION_URL . 'sobres-010.html');
			else
				redirectUrl(APPLICATION_URL . 'sobres-040.html');
			break;
		case 'delete_envelope_item':
			$envelopeItem	= new envelopeItem(escape($_GET[1]));
			if($envelopeItem->__get('envelope_bag_id') != 0)
			{
				$envelopeItem->delete();
			}
			else
			{
				$userEnvelopeLogArray = UserEnvelopeLogHelper::retrieveUserEnvelopeLogs("AND user_id = " . $envelopeItem->__get('user_id') . " AND user_envelope_id = " . $envelopeItem->__get('user_envelope_id') . " AND user_envelope_log_date = " . $envelopeItem->__get('envelope_item_payday'));
				if(count($userEnvelopeLogArray) > 0)
				{
					$userEnvelopeLog 		= $userEnvelopeLog[0];
					$userEnvelopeLogData 	= unserialize($userEnvelopeLog->__get('user_envelope_data'));
					unset($userEnvelopeLogData['EnvelopeItems'][$envelopeItem->__get('envelope_item_id')]);
					$userEnvelopeLogData	= serialize($userEnvelopeLogData);
					$userEnvelopeLog->__set('user_envelope_data', $userEnvelopeData);
					$userEnvelopeLog->update();
				}
			}
			if(isset($_GET[2]) && ($_GET[2] == 'envelopes'))
				redirectUrl(APPLICATION_URL . 'sobres-010.html');
			else
				redirectUrl(APPLICATION_URL . 'sobres-040.html');
			break;
		case 'create_envelope':
			$userEnvelope = new UserEnvelope();
			$userEnvelope->__set('user_id', $_SESSION["user_active"]);
			$userEnvelope->__set('user_envelope_created_date', date('Y-m-d'));
			$userEnvelope->__set('user_envelope_name', $_POST["user_envelope_name"]);
			$userEnvelope->save();
			redirectUrl(APPLICATION_URL. 'sobres-010.html');
			break;
endswitch;
?>