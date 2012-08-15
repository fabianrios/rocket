<?php
class CityHelper
{
	public static function selectCities ( $extra = "", $extraTables = ""   )
	{
		$connection  = Connection::getInstance();
		$retrieveCitiesSql    = "SELECT city_id
								 FROM geo_cities" . $extraTables . "
								 WHERE 1 = 1 
								 " . $extra;
		return $connection->query($retrieveCitiesSql);		
	}
	public static function retrieveCities ( $extra  = "", $extraTables = ""  )
	{
		$cities = array();
		
		$retrieveCitiesResult = self::selectCities ( $extra, $extraTables  );
		
		while($cityRow = mysql_fetch_assoc($retrieveCitiesResult["query"]))
			$cities[] = new City($cityRow["city_id"]);
			
		return $cities;
	}
	public static function sendActivationMail($args)
	{
	}
}
?>