<?php
class FasecoldaHelper
{
	public static function selectFasecoldas ( $extra = "", $extraTables = ""   )
	{
		$connection  = Connection::getInstance();
		$retrieveFasecoldasSql    = "SELECT fasecolda_id
								 FROM suen_fasecolda" . $extraTables . "
								 WHERE 1 = 1 
								 " . $extra;
		return $connection->query($retrieveFasecoldasSql);		
	}
	public static function retrieveFasecoldas ( $extra  = "", $extraTables = ""  )
	{
		$Fasecoldas = array();
		
		$retrieveFasecoldasResult = self::selectFasecoldas ( $extra, $extraTables  );
		
		while($FasecoldaRow = mysql_fetch_assoc($retrieveFasecoldasResult["query"]))
			$Fasecoldas[] = new Fasecolda($FasecoldaRow["fasecolda_id"]);
			
		return $Fasecoldas;
	}
	public static function sendActivationMail($args)
	{
	}
}
?>