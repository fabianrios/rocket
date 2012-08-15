<?php
class Security
{
	public static function login ($userName, $password)
	{
		$connection = Connection::getInstance();
		$loginSql = sprintf("SELECT user_id 
					 		 FROM core_users 
					 		 WHERE user_email = '%s' 
					 		 AND user_password = '%s' 
							 AND user_state = 'A'", 
					 		 escape($userName), 
					 		 md5(escape($password)));
		$loginQry   = $connection->query($loginSql);
		echo $loginSql;
		$return     = ($loginQry["num_rows"] == 1) ? mysql_result($loginQry["query"], 0, 0) : false;
		return $return;
	}
	
	public static function validateSession ()
	{
		$validSession = true;
		if((isset($_SESSION['control_user_id'])) && (isset($_SESSION['key']))) 
		{
			$controlUser = new ControlUser($_SESSION['control_user_id']);			
			if($_SESSION['key'] != $controlUser->__get('user_session_carry'))
				$validSession = false;
		}
		else
			$validSession = false;	
		if(!$validSession)
		{
			redirectUrl("index.php?log_out.control");
			die();
		}
		else
			return $controlUser;
	}
}
?>