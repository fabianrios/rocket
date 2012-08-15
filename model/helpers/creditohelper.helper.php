<?php
class CreditoHelper
{
	public static function selectCreditos ( $extra = "", $extraTables = ""   )
	{
		$connection  = Connection::getInstance();
		$retrieveCreditosSql    = "SELECT consumo_id
							         FROM cons_consumos" . $extraTables . "
								     WHERE 1=1
								     " . $extra;
		return $connection->query($retrieveCreditosSql);		
	}
	public static function retrieveCreditos ( $extra  = "", $extraTables = ""  )
	{
		$creditos = array();
		
		$retrieveCreditosResult = self::selectCreditos ( $extra, $extraTables  );
		
		while($contacRow = mysql_fetch_assoc($retrieveCreditosResult["query"]))
			$creditos[] = new Credito($contacRow["consumo_id"]);
			
		return $creditos;
	}
}
?>