<?php

class ZoneHelper

{

	public static function selectZones ( $extra = "", $extraTables = ""   )

	{

		$connection  = Connection::getInstance();

		$retrieveZonesSql    = "SELECT zone_id

							         FROM core_zones" . $extraTables . "

								     WHERE zone_state <> 'D'

								     " . $extra;

		return $connection->query($retrieveZonesSql);		

	}

	public static function retrieveZones ( $extra  = "", $extraTables = ""  )

	{

		$zones = array();

		

		$retrieveZonesResult = self::selectZones ( $extra, $extraTables  );

		

		while($zoneRow = mysql_fetch_assoc($retrieveZonesResult["query"]))

			$zones[] = new Zone($zoneRow["zone_id"]);

			

		return $zones;

	}

}

?>