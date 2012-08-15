<?php

class RoleHelper

{

	public static function selectRoles ( $extra = "", $extraTables = ""   )

	{

		$connection  = Connection::getInstance();

		$retrieveRolesSql    = "SELECT role_id

							         FROM core_roles" . $extraTables . "

								     WHERE role_state != 'D' 

								     " . $extra;

		return $connection->query($retrieveRolesSql);		

	}

	public static function retrieveRoles ( $extra  = "", $extraTables = ""  )

	{

		$roles = array();

		

		$retrieveRolesResult = self::selectRoles ( $extra, $extraTables  );

		

		while($roleRow = mysql_fetch_assoc($retrieveRolesResult["query"]))

			$roles[] = new Role($roleRow["role_id"]);

			

		return $roles;

	}

}

?>