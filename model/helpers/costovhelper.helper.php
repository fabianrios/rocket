<?php
class CostovHelper
{
	public static function selectCostos ( $extra = "", $extraTables = ""   )
	{
		$connection  = Connection::getInstance();
		$retrieveCostosSql    = "SELECT deposito_id
								 FROM depv_costos" . $extraTables . "
								 WHERE 1 = 1 
								 " . $extra;
		return $connection->query($retrieveCostosSql);		
	}
	public static function retrieveCostos ( $extra  = "", $extraTables = ""  )
	{
		$Costos = array();
		
		$retrieveCostosResult = self::selectCostos ( $extra, $extraTables  );
		
		while($CostoRow = mysql_fetch_assoc($retrieveCostosResult["query"]))
			$Costos[] = new Costov($CostoRow["costo_id"]);
			
		return $Costos;
	}
	public static function sendActivationMail($args)
	{
	}
}
?>