<?php
class TCreditoHelper
{
	public static function selectTarjetas ( $extra = "", $extraTables = ""   )
	{
		$connection  = Connection::getInstance();
		$retrieveCreditosSql    = "SELECT tarjeta_id
							         FROM tarj_tarjetas" . $extraTables . "
								     WHERE 1=1
								     " . $extra;
		return $connection->query($retrieveCreditosSql);		
	}
	public static function retrieveTarjetas ( $extra  = "", $extraTables = ""  )
	{
		$creditos = array();
		
		$retrieveCreditosResult = self::selectTarjetas ( $extra, $extraTables  );
		
		while($contacRow = mysql_fetch_assoc($retrieveCreditosResult["query"]))
			$creditos[] = new TCredito($contacRow["tarjeta_id"]);
			
		return $creditos;
	}
}
?>