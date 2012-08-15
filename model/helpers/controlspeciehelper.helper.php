<?php
class ControlSpecieHelper
{
	public static function selectSpecies ( $extra = "", $extraTables = ""   )
	{
		$connection  = Connection::getInstance();
		$retrieveSpeciesSql    = "SELECT specie_id
							         FROM gzgg_species" . $extraTables . "
								     WHERE specie_state <> 'D'
								     " . $extra;
		return $connection->query($retrieveSpeciesSql);		
	}
	public static function retrieveSpecies ( $extra  = "", $extraTables = ""  )
	{
		$species = array();
		
		$retrieveSpeciesResult = self::selectSpecies ( $extra, $extraTables  );
		
		while($specieRow = mysql_fetch_assoc($retrieveSpeciesResult["query"]))
			$species[] = new Specie($specieRow["specie_id"]);
			
		return $species;
	}
}
?>