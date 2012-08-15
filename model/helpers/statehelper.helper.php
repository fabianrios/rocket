<?php

class StateHelper

{

	public static function selectStates ( $extra = "", $extraTables = ""   )

	{

		$connection  = Connection::getInstance();

		$retrieveStatesSql    = "SELECT state_id

								 FROM geo_states" . $extraTables . "

								 WHERE 1=1

								 " . $extra;

		return $connection->query($retrieveStatesSql);		

	}

	public static function retrieveStates ( $extra  = "", $extraTables = ""  )

	{

		$states = array();

		

		$retrieveStatesResult = self::selectStates ( $extra, $extraTables  );

		

		while($stateRow = mysql_fetch_assoc($retrieveStatesResult["query"]))

			$states[] = new State($stateRow["state_id"]);

			

		return $states;

	}

}

?>