<?php
class EnvelopeItemHelper
{
	public static function selectEnvelopeItems ( $extra = "", $extraTables = ""   )
	{
		$connection  = Connection::getInstance();
		$retrieveUsersSql    = "SELECT envelope_item_id
							         FROM user_envelopes_items" . $extraTables . "
								     WHERE envelope_item_status != 2
								     " . $extra;
		return $connection->query($retrieveUsersSql);		
	}
	public static function retrieveEnvelopeItems ( $extra  = "", $extraTables = ""  )
	{
		$users = array();
		
		$retrieveUsersResult = self::selectEnvelopeItems ( $extra, $extraTables  );
		
		while($userRow = mysql_fetch_assoc($retrieveUsersResult["query"]))
			$users[] = new EnvelopeItem($userRow["envelope_item_id"]);
			
		return $users;
	}
}
?>