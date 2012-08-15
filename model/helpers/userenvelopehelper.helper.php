<?php
class UserEnvelopeHelper
{
	public static function selectUserEnvelopes ( $extra = "", $extraTables = ""   )
	{
		$connection  		= Connection::getInstance();
		$retrieveUserEnvelopesSql   = "SELECT user_envelope_id
							         FROM user_users_envelopes" . $extraTables . "
								     WHERE 1=1
								     " . $extra;
		return $connection->query($retrieveUserEnvelopesSql);		
	}
	public static function retrieveUserEnvelopes ( $extra  = "", $extraTables = ""  )
	{
		$userEnvelopes = array();
		
		$retrieveUserEnvelopesResult = self::selectUserEnvelopes ( $extra, $extraTables  );
		
		while($userEnvelopeRow = mysql_fetch_assoc($retrieveUserEnvelopesResult["query"]))
			$userEnvelopes[] = new UserEnvelope($userEnvelopeRow["user_envelope_id"]);
			
		return $userEnvelopes;
	}
	public static function getPeriodExpenses(&$userEnvelope, $expenseType = 'all', $startDate = null, $endDate = null)
	{
		if(is_null($startDate))
		{
			$userIncomes = IncomeHelper::retrieveIncomes("AND user_id = " . $userEnvelope->__get('user_id') . " ORDER BY income_day DESC LIMIT 0,1");
			
			if(count($userIncomes) == 1)
			{
				$startDay = $userIncomes[0]->__get('income_day');
			}
			else
				$startDay = 1;

			if($startDay > date('d'))
				$startDate = date('Y-m-', strtotime(date('Y-m-d') . "-1 month")) . $startDay;
			else
				$startDate = date('Y-m-') . $startDay;

			$endDate = date('Y-m-d', strtotime($startDate . '+1 month'));
		}
		elseif(is_null($endDate))
		{
			$endDate = date('Y-m-d', strtotime($startDate . '+1 month'));
		}

		$envelopeLogs = UserEnvelopeLogHelper::retrieveUserEnvelopeLogs("AND user_envelope_log_date >= '" . $startDate . "' AND user_envelope_log_date <= '" . $endDate . "' AND user_envelope_id = " . $userEnvelope->__get('user_envelope_id'));

		$totalSpent = 0;
		foreach($envelopeLogs as $envelopeLog)
		{
			
			$envelopeInfo = unserialize($envelopeLog->__get('user_envelope_log_data'));
			if(isset($envelopeInfo["EnvelopeItems"]))
			{
				
				$add = false;
				foreach($envelopeInfo["EnvelopeItems"] as $envelopeItem)
				{
					if($expenseType == 'all')
						$add = true;
					elseif($expenseType == 'recurring')
					{
						if(($envelopeItem->__get('envelope_bag_id') != '0') && ($envelopeItem->__get('envelope_bag_id') != ''))
						{
							echo $envelopeItem->__get('envelope_bag_id');
						}
					}
					elseif($expenseType == 'daily')
					{
						if(($envelopeItem->__get('envelope_bag_id') == '0') || ($envelopeItem->__get('envelope_bag_id') == ''))
						{
							$add = true;
						}
					}
					if($add)
						$totalSpent += intval($envelopeItem->__get('envelope_item_value'));
				}
			}
		}
		
		return $totalSpent;
	}
	public static function getPeriodItems(&$userEnvelope, $expenseType = 'all', $startDate = null, $endDate = null)
	{
		$envelopeItems = array();
		if(is_null($startDate))
		{
			$userIncomes = IncomeHelper::retrieveIncomes("AND user_id = " . $userEnvelope->__get('user_id') . " ORDER BY income_day DESC LIMIT 0,1");
			
			if(count($userIncomes) == 1)
			{
				$startDay = $userIncomes[0]->__get('income_day');
			}
			else
				$startDay = 1;

			if($startDay > date('d'))
				$startDate = date('Y-m-', strtotime(date('Y-m-d') . "-1 month")) . $startDay;
			else
				$startDate = date('Y-m-') . $startDay;

			$endDate = date('Y-m-d');
		}

		$envelopeLogs = UserEnvelopeLogHelper::retrieveUserEnvelopeLogs("AND user_envelope_log_date >= '" . $startDate . "' AND user_envelope_log_date <= '" . $endDate . "' AND user_envelope_id = " . $userEnvelope->__get('user_envelope_id'));

		
		$totalSpent = 0;
		foreach($envelopeLogs as $envelopeLog)
		{
			
			$envelopeInfo = unserialize($envelopeLog->__get('user_envelope_log_data'));
			if(isset($envelopeInfo["EnvelopeItems"]))
			{
				$add = false;
				foreach($envelopeInfo["EnvelopeItems"] as $envelopeItem)
				{
					if($expenseType == 'all')
						$add = true;
					elseif($expenseType == 'recurring')
					{
						if(($envelopeItem->__get('envelope_bag_id') != '0') && ($envelopeItem->__get('envelope_bag_id') != ''))
						{
							$add = true;
						}
					}
					elseif($expenseType == 'daily')
					{
						if(($envelopeItem->__get('envelope_bag_id') == '0') || ($envelopeItem->__get('envelope_bag_id') == ''))
						{
							$add = true;
						}
					}
					if($add)
						$envelopeItems[] = $envelopeItem;
				}
			}
		}
		
		return $envelopeItems;
	}
	public static function getEnvelopePeriodExpenses(&$userEnvelope)
	{
		$firstEnvelopeArray	= self::retrieveUserEnvelopes("AND user_id = " . $userEnvelope->__get('user_id') . " ORDER BY user_envelope_id LIMIT 0,1"); 
		$firstEnvelope		=& $firstEnvelopeArray[0];
		$recurringData 		= unserialize($userEnvelope->__get('user_envelope_recurring_data'));
		
		switch($userEnvelope->__get('user_envelope_periodicity')):
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
		$envelopeInitialDate	= strtotime($userEnvelope->__get('user_envelope_date'));
		$envelopeFinalDate		= strtotime($userEnvelope->__get('user_envelope_date') . $addValue);
		$firstEnvelopeDate		= strtotime($firstEnvelope->__get('user_envelope_date'));
		$currentDate			= strtotime(date('Y-m-d'));
		
		$totalExpenses = 0;
		foreach($recurringData as $key => $value)
		{
			if((strpos($key, '_amount') !== false) && ($value != ''))
			{
				$globalKey = str_replace('_amount', '', $key);
				$firstEnvelopeDate = strtotime(date('Y-m-', $firstEnvelopeDate) . $recurringData[$globalKey . '_payday']);
				/*while($firstEnvelopeDate < $envelopeFinalDate)
				{*/
					switch($recurringData[$globalKey . '_periodicity']):
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
					//if(($firstEnvelopeDate>=$envelopeInitialDate) && ($firstEnvelopeDate<=$envelopeFinalDate))
						$totalExpenses += $recurringData[$globalKey . '_amount'] * ($userEnvelope->__get('user_envelope_periodicity') / $recurringData[$globalKey . '_periodicity']);
					
					$firstEnvelopeDate = strtotime(date('Y-m-d', $firstEnvelopeDate) . $addValue);
				/*}*/
			}
		}
		$envelopeExtras			= EnvelopeExtraHelper::retrieveEnvelopeExtras("AND user_id = " . $userEnvelope->__get('user_id') . " AND envelope_id = " . $userEnvelope->__get('envelope_id') . " AND (envelope_extra_date >= '" . $userEnvelope->__get('user_envelope_date') . "' AND envelope_extra_date <= '" . date('Y-m-d', strtotime($userEnvelope->__get('user_envelope_date') . $addValue)) . "') ORDER BY envelope_extra_date DESC");
		foreach($envelopeExtras as $envelopeExtra)
		{
			$totalExpenses += $envelopeExtra->__get('envelope_extra_amount');
		}
		return $totalExpenses;
	}
	public static function getNextPayments(&$userEnvelope, $days, $fromDay = 0)
	{
		$firstEnvelopeArray	= self::retrieveUserEnvelopes("AND user_id = " . $userEnvelope->__get('user_id') . " ORDER BY user_envelope_id LIMIT 0,1"); 
		$firstEnvelope		=& $firstEnvelopeArray[0];
		$recurringData 		= array();;
		
		switch($days):
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
		$envelopeInitialDate	= strtotime($userEnvelope->__get('user_envelope_date'));

		$firstEnvelopeDate		= strtotime($firstEnvelope->__get('user_envelope_date'));
		$currentDate			= strtotime(date('Y-m-d') . "+" . $fromDay . " days");
		$envelopeFinalDate		= strtotime(date('Y-m-d', $currentDate) . $addValue);
		$nextPayments = array();
		foreach($recurringData as $key => $value)
		{

			if((strpos($key, '_amount') !== false) && ($value != ''))
			{

				$globalKey = str_replace('_amount', '', $key);
				$firstEnvelopeDate = strtotime(date('Y-m-', $firstEnvelopeDate) . $recurringData[$globalKey . '_payday']);
				$count = 0;
				while($firstEnvelopeDate < $envelopeFinalDate)
				{
					switch($recurringData[$globalKey . '_periodicity']):
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
					if(($firstEnvelopeDate>=$currentDate) && ($firstEnvelopeDate<=$envelopeFinalDate))
					{
						if(!isset($nextPayments[$firstEnvelopeDate]))
							$nextPayments[$firstEnvelopeDate] = array();
						$nextPayments[$firstEnvelopeDate][] = self::getItemName($key) . '|' .  $recurringData[str_replace("_amount", "", $key) . '_periodicity'] . '|' . $value;
						
					}
					$firstEnvelopeDate = strtotime(date('Y-m-d', $firstEnvelopeDate) . $addValue);
					
					$count++;
					
				}
				
				$firstEnvelopeDate		= strtotime($firstEnvelope->__get('user_envelope_date'));
			}
		}
		return $nextPayments;		
	}
	public static function getPreviousPayments(&$userEnvelope, $days, $fromDay = 0)
	{
		$firstEnvelopeArray	= self::retrieveUserEnvelopes("AND user_id = " . $userEnvelope->__get('user_id') . " ORDER BY user_envelope_id LIMIT 0,1"); 
		$firstEnvelope		=& $firstEnvelopeArray[0];
		$recurringData 		= array();
		
		switch($days):
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
		$envelopeInitialDate	= strtotime($userEnvelope->__get('user_envelope_date'));

		$firstEnvelopeDate		= strtotime($firstEnvelope->__get('user_envelope_date'));
		$currentDate			= strtotime(date('Y-m-d') . "-" . $fromDay . " days");
		$envelopeFinalDate		= strtotime(date('Y-m-d', $currentDate) . $addValue);
		$nextPayments = array();
		foreach($recurringData as $key => $value)
		{
			if((strpos($key, '_amount') !== false) && ($value != ''))
			{
				$globalKey = str_replace('_amount', '', $key);
				$firstEnvelopeDate = strtotime(date('Y-m-', $firstEnvelopeDate) . $recurringData[$globalKey . '_payday']);
				while($firstEnvelopeDate < $envelopeFinalDate)
				{
					switch($recurringData[$globalKey . '_periodicity']):
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
					if(($firstEnvelopeDate>=$currentDate) && ($firstEnvelopeDate<=$envelopeFinalDate))
					{
						
						if(!isset($nextPayments[$firstEnvelopeDate]))
							$nextPayments[$firstEnvelopeDate] = array();
						$nextPayments[$firstEnvelopeDate][] = self::getItemName($key) . '|' .  $recurringData[str_replace("_amount", "", $key) . '_periodicity'] . '|' . $value . '|' . $key;
					}
					$firstEnvelopeDate = strtotime(date('Y-m-d', $firstEnvelopeDate) . $addValue);
				}
			}
		}
		return $nextPayments;		
	}
	public static function getItemName($key) 
	{
		$envelopeArray = EnvelopeHelper::retrieveEnvelopes("AND envelope_recurring_fields LIKE '%" . str_replace("_amount", "", $key) . "%' LIMIT 0,1");
		if(count($envelopeArray) > 0)
		{
			$envelope 					=& $envelopeArray[0];
			$envelopeRecurringFields 	= explode('|', $envelope->__get('envelope_recurring_fields'));
			foreach($envelopeRecurringFields as $envelopeRecurringField)
			{
				$recurringFieldsValues = explode('=>', $envelopeRecurringField);
				if($recurringFieldsValues[1] == str_replace("_amount", "", $key))
				{
					
					return $recurringFieldsValues[0];
				}
			}
		}
		else
			return '';
	}
	public static function retrievePeriod($number)
	{
		switch($number):
			case 7:
				$period = 'Semanal';
				break; 
			case 15:
				$period = 'Bisemanal';
				break; 
			case 30:
				$period = 'Mensual';
				break; 
			case 60:
				$period = 'Bimensual';
				break; 
			case 180:
				$period = 'Trimestral';
				break; 
			case 360:
				$period = 'Anual';
				break; 
			default:
				$period = '';
				break;
		endswitch;
		return $period;
	}
}
?>