<?php
class CreditoTramiteHelper
{
	public static function selectCreditoTramites ( $extra = "", $extraTables = ""   )
	{
		$connection  = Connection::getInstance();
		$retrieveCreditoTramitesSql    = "SELECT *
							         FROM cr_tramites" . $extraTables . "
								     WHERE 1=1
								     " . $extra;
		return $connection->query($retrieveCreditoTramitesSql);		
	}
	public static function retrieveCreditoTramites ( $extra  = "", $extraTables = ""  )
	{
		$creditotramites = array();
		
		$retrieveCreditoTramitesResult = self::selectCreditoTramites ( $extra, $extraTables  );
		
		while($contacRow = mysql_fetch_assoc($retrieveCreditoTramitesResult["query"]))
			$creditotramites[] = new CreditoTramite($contacRow["tramites_id"]);
			
		return $creditotramites;
	}
}
?>