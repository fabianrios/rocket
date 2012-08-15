<?php
class UserEnvelopeLogHelper
{
	public static function selectUserEnvelopeLogs ( $extra = "", $extraTables = ""   )
	{
		$connection  = Connection::getInstance();
		$retrieveUsersSql    = "SELECT user_envelope_log_id
							         FROM user_users_envelopes_logs" . $extraTables . "
								     WHERE 1 = 1
								     " . $extra;
		return $connection->query($retrieveUsersSql);		
	}
	public static function retrieveUserEnvelopeLogs ( $extra  = "", $extraTables = ""  )
	{
		$users = array();
		
		$retrieveUsersResult = self::selectUserEnvelopeLogs ( $extra, $extraTables  );
		
		while($userRow = mysql_fetch_assoc($retrieveUsersResult["query"]))
			$users[] = new UserEnvelopeLog($userRow["user_envelope_log_id"]);
			
		return $users;
	}
}
?>