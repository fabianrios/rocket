<?php
class CreditoCondicionHelper
{
	public static function selectCreditoCondiciones ( $extra = "", $extraTables = ""   )
	{
		$connection  = Connection::getInstance();
		$retrieveCreditoCondicionsSql    = "SELECT credito_id
							         FROM cr_condiciones" . $extraTables . "
								     WHERE 1=1
								     " . $extra;
		return $connection->query($retrieveCreditoCondicionsSql);		
	}
	public static function retrieveCreditoCondiciones ( $extra  = "", $extraTables = ""  )
	{
		$creditocondiciones = array();
		
		$retrieveCreditoCondicionsResult = self::selectCreditoCondiciones ( $extra, $extraTables  );
		
		while($contacRow = mysql_fetch_assoc($retrieveCreditoCondicionsResult["query"]))
			$creditocondiciones[] = new CreditoCondicion($contacRow["condicion_id"]);
			
		return $creditocondiciones;
	}
}
?>