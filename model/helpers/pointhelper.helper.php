<?php
class PointHelper
{
	public static function selectPoints ( $extra = "", $extraTables = ""   )
	{
		$connection  = Connection::getInstance();
		$retrievePointsSql    = "SELECT point_id
								 FROM salu_points" . $extraTables . "
								 WHERE 1 = 1 
								 " . $extra;
		return $connection->query($retrievePointsSql);		
	}
	public static function retrievePoints ( $extra  = "", $extraTables = ""  )
	{
		$Points = array();
		
		$retrievePointsResult = self::selectPoints ( $extra, $extraTables  );
		
		while($PointRow = mysql_fetch_assoc($retrievePointsResult["query"]))
			$Points[] = new Point($PointRow["point_id"]);
			
		return $Points;
	}
	public static function sendActivationMail($args)
	{
	}
}
?>