<?php
class DepositoVHelper
{
	public static function selectDepositos ( $extra = "", $extraTables = ""   )
	{
		$connection  = Connection::getInstance();
		$retrieveDepositosSql    = "SELECT deposito_id
							         FROM depv_depositos" . $extraTables . "
								     WHERE 1=1
								     " . $extra;
		return $connection->query($retrieveDepositosSql);		
	}
	public static function retrieveDepositos ( $extra  = "", $extraTables = ""  )
	{
		$depositos = array();
		
		$retrieveDepositosResult = self::selectDepositos ( $extra, $extraTables  );
		
		while($contacRow = mysql_fetch_assoc($retrieveDepositosResult["query"]))
			$depositos[] = new DepositoV($contacRow["deposito_id"]);
			
		return $depositos;
	}
}
?>