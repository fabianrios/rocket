<?php
class AvailableFieldHelper
{
	public static function selectAvailableFields ( $extra = "", $extraTables = ""   )
	{
		$connection  = Connection::getInstance();
		$retrieveUsersSql    = "SELECT available_field_id
							         FROM cont_available_fields" . $extraTables . "
								     WHERE 1 = 1
								     " . $extra;
		return $connection->query($retrieveUsersSql);		
	}
	public static function retrieveAvailableFields ( $extra  = "", $extraTables = ""  )
	{
		$users = array();
		
		$retrieveUsersResult = self::selectAvailableFields ( $extra, $extraTables  );
		
		while($userRow = mysql_fetch_assoc($retrieveUsersResult["query"]))
			$users[] = new AvailableField($userRow["available_field_id"]);
			
		return $users;
	}
}
?>