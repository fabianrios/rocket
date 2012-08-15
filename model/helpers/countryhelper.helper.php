<?php


class CountryHelper


{


	public static function selectCountries ( $extra = "", $extraTables = ""   )


	{


		$connection  = Connection::getInstance();


		$retrieveCountriesSql    = "SELECT country_id


							         FROM geo_countries" . $extraTables . "


								     WHERE 1 = 1


								     " . $extra;


		return $connection->query($retrieveCountriesSql);		


	}


	public static function retrieveCountries ( $extra  = "", $extraTables = ""  )


	{


		$countries = array();


		


		$retrieveCountriesResult = self::selectCountries ( $extra, $extraTables  );


		


		while($countryRow = mysql_fetch_assoc($retrieveCountriesResult["query"]))


			$countries[] = new Country($countryRow["country_id"]);


			


		return $countries;


	}


	public static function sendActivationMail($args)


	{


	}


}


?>