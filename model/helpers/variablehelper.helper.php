<?php
class VariableHelper
{
	public static function selectVariables ( $extra = "", $extraTables = ""   )
	{
		$connection  = Connection::getInstance();
		$retrieveVariablesSql    = "SELECT variable_id
								 FROM suen_datos_variables" . $extraTables . "
								 WHERE 1 = 1 
								 " . $extra;
		return $connection->query($retrieveVariablesSql);		
	}
	public static function retrieveVariables ( $extra  = "", $extraTables = ""  )
	{
		$Variables = array();
		
		$retrieveVariablesResult = self::selectVariables ( $extra, $extraTables  );
		
		while($VariableRow = mysql_fetch_assoc($retrieveVariablesResult["query"]))
			$Variables[] = new Variable($VariableRow["variable_id"]);
			
		return $Variables;
	}
	public static function sendActivationMail($args)
	{
	}
}
?>