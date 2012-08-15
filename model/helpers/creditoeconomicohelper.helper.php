<?php
class CreditoEconomicoHelper
{
	public static function selectCreditoEconomicos ( $extra = "", $extraTables = ""   )
	{
		$connection  = Connection::getInstance();
		$retrieveCreditoEconomicosSql    = "SELECT *
							         FROM cr_economico" . $extraTables . "
								     WHERE 1=1
								     " . $extra;
		return $connection->query($retrieveCreditoEconomicosSql);		
	}
	public static function retrieveCreditoEconomicos ( $extra  = "", $extraTables = ""  )
	{
		$creditoeconomicos = array();
		
		$retrieveCreditoEconomicosResult = self::selectCreditoEconomicos ( $extra, $extraTables  );
		
		while($contacRow = mysql_fetch_assoc($retrieveCreditoEconomicosResult["query"]))
			$creditoeconomicos[] = new CreditoEconomico($contacRow["economico_id"]);
			
		return $creditoeconomicos;
	}
}
?>