<?php
class UserHelper
{
	public static function selectUsers ( $extra = "", $extraTables = ""   )
	{
		$connection  		= Connection::getInstance();
		$retrieveUsersSql   = "SELECT user_id
							         FROM user_users" . $extraTables . "
								     WHERE user_state <> 'D'
								     " . $extra;
		return $connection->query($retrieveUsersSql);		
	}
	public static function retrieveUsers ( $extra  = "", $extraTables = ""  )
	{
		$users = array();
		
		$retrieveUsersResult = self::selectUsers ( $extra, $extraTables  );
		
		while($userRow = mysql_fetch_assoc($retrieveUsersResult["query"]))
			$users[] = new User($userRow["user_id"]);
			
		return $users;
	}
	public static function getData($userId, $field)
	{
		$user	= new User($userId);
		$data	= unserialize($user->__get('user_data'));
		if (isset($data[$field]))
			return	$value;
		else
			return false;
	}
	public static function setData($userId, $field, $value)
	{
		$user			= new User($userId);
		$data			= unserialize($user->__get('user_data'));
		$data[$field]	=	$value;
		$user->__set('user_data', serialize($data));
		$user->update();
	}
	
}
?>