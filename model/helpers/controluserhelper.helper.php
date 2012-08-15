<?php

class ControlUserHelper

{

	public static function selectUsers ( $extra = "", $extraTables = ""   )

	{

		$connection  = Connection::getInstance();

		$retrieveUsersSql    = "SELECT user_id

							         FROM core_users" . $extraTables . "

								     WHERE user_state <> 'D'

								     " . $extra;

		

		return $connection->query($retrieveUsersSql);		

	}

	public static function retrieveUsers ( $extra  = "", $extraTables = ""  )

	{

		$users = array();

		

		$retrieveUsersResult = self::selectUsers ( $extra, $extraTables  );

		

		while($userRow = mysql_fetch_assoc($retrieveUsersResult["query"]))

			$users[] = new ControlUser($userRow["user_id"]);

			

		return $users;

	}

	public static function retrieveRoleUser( $extra  = "", $extraTables = "")

	{

		$connection  = Connection::getInstance();

		$retrieveUsersSql    = "SELECT role_user_id

							         FROM core_roles_users" . $extraTables . "

								     WHERE 1 = 1

								     " . $extra;

		$retrieveUsersResult = $connection->query($retrieveUsersSql);		

		$users = array();

		

		while($userRow = mysql_fetch_assoc($retrieveUsersResult["query"]))

			$users[] = new RoleUser($userRow["role_user_id"]);

			

		return $users;		

	}



}

?>