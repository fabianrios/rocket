<?php
class CoreLogHelper
{
	public static function selectCoreLogs ( $extra = "", $extraTables = ""   )
	{
		$connection = Connection::getInstance();
		$retrieveCoreLogsSql    = "SELECT log_id
								 FROM core_log" . $extraTables . "
								 WHERE 1 = 1 
								 " . $extra;
		return $connection->query($retrieveCoreLogsSql);		
	}
	
	public static function retrieveCoreLogs ( $extra  = "", $extraTables = ""  )
	{
		$CoreLogs = array();
		
		$retrieveCoreLogsResult = self::selectCoreLogs ( $extra, $extraTables  );
		
		while($CoreLogRow = mysql_fetch_assoc($retrieveCoreLogsResult["query"]))
			$CoreLogs[] = new CoreLog($CoreLogRow["log_id"]);
			
		return $CoreLogs;
	}
}
?>