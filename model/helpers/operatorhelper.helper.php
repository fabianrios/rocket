<?php
class OperatorHelper
{
	public static function selectOperators ( $extra = "", $extraTables = ""   )
	{
		$connection  = Connection::getInstance();
		$retrieveOperatorsSql    = "SELECT Operator_id
								 FROM gzgg_Operators" . $extraTables . "
								 WHERE 1 = 1 
								 " . $extra;
		return $connection->query($retrieveOperatorsSql);		
	}
	public static function retrieveOperators ( $extra  = "", $extraTables = ""  )
	{
		$Operators = array();
		
		$retrieveOperatorsResult = self::selectOperators ( $extra, $extraTables  );
		
		while($OperatorRow = mysql_fetch_assoc($retrieveOperatorsResult["query"]))
			$Operators[] = new Operator($OperatorRow["Operator_id"]);
			
		return $Operators;
	}
	public static function sendActivationMail($args)
	{
	}
}
?>