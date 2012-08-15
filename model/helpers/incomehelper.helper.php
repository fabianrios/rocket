<?php
class IncomeHelper
{
	public static function selectIncomes ( $extra = "", $extraTables = ""   )
	{
		$connection  		= Connection::getInstance();
		$retrieveIncomesSql   = "SELECT income_id
							         FROM user_incomes" . $extraTables . "
								     WHERE 1 = 1
								     " . $extra;
		return $connection->query($retrieveIncomesSql);		
	}
	public static function retrieveIncomes ( $extra  = "", $extraTables = ""  )
	{
		$incomes = array();
		
		$retrieveIncomesResult = self::selectIncomes ( $extra, $extraTables  );
		
		while($incomeRow = mysql_fetch_assoc($retrieveIncomesResult["query"]))
			$incomes[] = new Income($incomeRow["income_id"]);
			
		return $incomes;
	}
	public static function deleteIncomes ( $extra  = "", $extraTables = ""  )
	{
		if($extra != '')
		{
			$connection  		= Connection::getInstance();
			$retrieveIncomesSql   = "DELETE
								         FROM user_incomes" . $extraTables . "
									     WHERE 1 = 1
									     " . $extra;
			return $connection->query($retrieveIncomesSql);	
		}
	}
	public static function getData($incomeId, $field)
	{
		$income	= new Income($incomeId);
		$data	= unserialize($income->__get('income_data'));
		if (isset($data[$field]))
			return	$value;
		else
			return false;
	}
	public static function setData($incomeId, $field, $value)
	{
		$income			= new Income($incomeId);
		$data			= unserialize($income->__get('income_data'));
		$data[$field]	=	$value;
		$income->__set('income_data', serialize($data));
		$income->update();
	}
	
}
?>