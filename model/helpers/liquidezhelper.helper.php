<?php
class LiquidezHelper
{
	public static function selectLiquidez ( $extra = "", $extraTables = ""   )
	{
		$connection  = Connection::getInstance();
		$retrieveLiquidezSql    = "SELECT liquidez_id
								 FROM salu_liquidez" . $extraTables . "
								 WHERE 1 = 1 
								 " . $extra;
		return $connection->query($retrieveLiquidezSql);		
	}
	public static function retrieveLiquidez ( $extra  = "", $extraTables = ""  )
	{
		$Liquidez = array();
		
		$retrieveLiquidezResult = self::selectLiquidez ( $extra, $extraTables  );
		
		while($LiquidezRow = mysql_fetch_assoc($retrieveLiquidezResult["query"]))
			$Liquidez[] = new Liquidez($LiquidezRow["liquidez_id"]);
			
		return $Liquidez;
	}
	public static function sendActivationMail($args)
	{
	}
}
?>