<?php
class PressTypeHelper
{
	public static function selectPressTypes ( $extra = "", $extraTables = ""   )
	{
		$connection  = Connection::getInstance();
		$retrievePressTypesSql    = "SELECT press_type_id
							         FROM user_press_types" . $extraTables . "
								     WHERE 1 = 1
								     " . $extra;
		return $connection->query($retrievePressTypesSql);		
	}
	public static function retrievePressTypes ( $extra  = "", $extraTables = ""  )
	{
		$pressTypes = array();
		
		$retrievePressTypesResult = self::selectPressTypes ( $extra, $extraTables  );
		
		while($pressTypeRow = mysql_fetch_assoc($retrievePressTypesResult["query"]))
			$pressTypes[] = new PressType($pressTypeRow["press_type_id"]);
			
		return $pressTypes;
	}
}
?>