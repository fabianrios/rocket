<?php
class LogHelper
{
	public static function selectLogs ( $extra = "", $extraTables = ""   )
	{
		$connection		= Connection::getInstance();
		$retrieveSql    = "SELECT log_id
						   FROM input_logs" . $extraTables . "
						   WHERE 1 = 1 " . $extra;
		return $connection->query($retrieveSql);		
	}
	public static function retrieveLogs ( $extra  = "", $extraTables = ""  )
	{
		$Logs = array();
		
		$retrieveLogsResult = self::selectLogs ( $extra, $extraTables  );
		
		while($row = mysql_fetch_assoc($retrieveLogsResult["query"]))
			$Logs[] = new Log($row["log_id"]);
			
		return $Logs;
	}
}
?>