<?php
class EnvelopeBagHelper
{
	public static function selectEnvelopeBags ( $extra = "", $extraTables = ""   )
	{
		$connection  = Connection::getInstance();
		$retrieveUsersSql    = "SELECT envelope_bag_id
							         FROM user_envelopes_bags" . $extraTables . "
								     WHERE 1 = 1
								     " . $extra;
		return $connection->query($retrieveUsersSql);		
	}
	public static function retrieveEnvelopeBags ( $extra  = "", $extraTables = ""  )
	{
		$users = array();
		
		$retrieveUsersResult = self::selectEnvelopeBags ( $extra, $extraTables  );
		
		while($userRow = mysql_fetch_assoc($retrieveUsersResult["query"]))
			$users[] = new EnvelopeBag($userRow["envelope_bag_id"]);
			
		return $users;
	}
}
?>