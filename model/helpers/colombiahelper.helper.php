<?php
class ColombiaHelper
{
	public static function selectPoints ( $extra = "", $extraTables = ""   )
	{
		$connection = Connection::getInstance();
		$retrievePointsSql    = "SELECT OGR_FID, Y(SHAPE) as lat, X(SHAPE) as lon
								 FROM geo_colombia" . $extraTables . "
								 WHERE 1 = 1 
								 " . $extra;
		return $connection->query($retrievePointsSql);		
	}
	
	public static function retrievePoints ( $extra  = "", $extraTables = ""  )
	{
		$Points = array();
		
		$retrievePointsResult = self::selectPoints ( $extra, $extraTables  );
		
		while($PointRow = mysql_fetch_assoc($retrievePointsResult["query"]))
			$Points[] = new Colombia($PointRow["OGR_FID"]);
			
		return $Points;
	}
}
?>