<?php
class IptableHelper
{
	public static function selectIptables ( $extra = "", $extraTables = ""   )
	{
		$connection  = Connection::getInstance();
		$retrieveIptablesSql    = "SELECT iptable_id
							         FROM geo_iptables" . $extraTables . "
								     WHERE 1=1
								     " . $extra;
		return $connection->query($retrieveIptablesSql);		
	}
	public static function retrieveIptables ( $extra  = "", $extraTables = ""  )
	{
		$iptables = array();
		
		$retrieveIptablesResult = self::selectIptables ( $extra, $extraTables  );
		
		while($iptableRow = mysql_fetch_assoc($retrieveIptablesResult["query"]))
			$iptables[] = new Iptable($iptableRow["iptable_id"]);
			
		return $iptables;
	}
}
?>