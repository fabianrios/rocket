<?php
class CreditoCanalHelper
{
	public static function selectCreditoCanals ( $extra = "", $extraTables = ""   )
	{
		$connection  = Connection::getInstance();
		$retrieveCreditoCanalsSql    = "SELECT *
							         FROM cr_canales" . $extraTables . "
								     WHERE 1=1
								     " . $extra;
		return $connection->query($retrieveCreditoCanalsSql);		
	}
	public static function retrieveCreditoCanals ( $extra  = "", $extraTables = ""  )
	{
		$creditocanals = array();
		
		$retrieveCreditoCanalsResult = self::selectCreditoCanals ( $extra, $extraTables  );
		
		while($contacRow = mysql_fetch_assoc($retrieveCreditoCanalsResult["query"]))
			$creditocanals[] = new CreditoCanal($contacRow["canals_id"]);
			
		return $creditocanals;
	}
}
?>