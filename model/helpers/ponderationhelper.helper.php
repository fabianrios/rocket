<?php
class PonderationHelper
{
	public static function selectPonderations ( $extra = "", $extraTables = ""   )
	{
		$connection  = Connection::getInstance();
		$retrievePonderationsSql    = "SELECT ponderation_id
								 FROM salu_ponderations" . $extraTables . "
								 WHERE 1 = 1 
								 " . $extra;
		return $connection->query($retrievePonderationsSql);		
	}
	public static function retrievePonderations ( $extra  = "", $extraTables = ""  )
	{
		$Ponderations = array();
		
		$retrievePonderationsResult = self::selectPonderations ( $extra, $extraTables  );
		
		while($PonderationRow = mysql_fetch_assoc($retrievePonderationsResult["query"]))
			$Ponderations[] = new Ponderation($PonderationRow["ponderation_id"]);
			
		return $Ponderations;
	}
	public static function sendActivationMail($args)
	{
	}
}
?>