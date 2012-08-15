<?php
class FinancieroHelper
{
	public static function selectFinancieros ( $extra = "", $extraTables = ""   )
	{
		$connection  = Connection::getInstance();
		$retrieveFinancierosSql    = "SELECT financiero_id
								 FROM salu_financieros" . $extraTables . "
								 WHERE 1 = 1 
								 " . $extra;
		return $connection->query($retrieveFinancierosSql);		
	}
	public static function retrieveFinancieros ( $extra  = "", $extraTables = ""  )
	{
		$Financieros = array();
		
		$retrieveFinancierosResult = self::selectFinancieros ( $extra, $extraTables  );
		
		while($FinancieroRow = mysql_fetch_assoc($retrieveFinancierosResult["query"]))
			$Financieros[] = new Financiero($FinancieroRow["financiero_id"]);
			
		return $Financieros;
	}
	public static function sendActivationMail($args)
	{
	}
}
?>