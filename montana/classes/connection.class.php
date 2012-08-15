<?php	
class Connection{
		
	private static $instance; 
	private static $connected = false;
	public $host;
	public $user;
	public $password;
	public $database;
	public $link;


	public static function getInstance()
	{
		if (!isset(self::$instance)) {            	
			self::$instance = new Connection();
		} 
		return self::$instance;
	}
	private function __construct()
	{	
		$this->host     = DB_HOST;
		$this->user     = DB_USER;
		$this->password = DB_PASSWORD;	
		$this->database = DB_NAME;			
		$this->connect();			
	}
	private function connect()
	{
		if(!self::$connected)
		{
			$this->link = mysql_connect($this->host,$this->user,$this->password) 
				   or trigger_error(mysql_error(),E_USER_ERROR);
			mysql_select_db($this->database,$this->link);
			$this->connected = true;
		}
		if (DEBUG)
			$GLOBALS['database_initialization']++;
		return $this->link;
	}
	
	public function query($query)
	{
		if (DEBUG)
		{
			$conn			= array();
			$conn['query']  = $query;
			$conn['insert_id'] 		=  '';
			$conn['num_rows'] 		=  '';
			$conn['num_fields'] 	=  '';
			$conn['affected_rows'] 	=  '';
			$conn['time'] 			=  '';
			$conn['error'] = 0;
			$queries		= ($GLOBALS['queries'] == '') ? array() : unserialize($GLOBALS['queries']);
		}
		if((strpos(strtoupper($query), "ALTER") === false) || (strpos(strtoupper($query), "DROP") === false))
		{
			$time_start_query = microtime(true); 
			$result = mysql_query($query);
			if(!$result)
			{
				echo '<br /><strong>MySQL error:</strong> ' . mysql_error() . '<br /><strong>MySQL Query:</strong> <pre>' . $query . '</pre>';
				if (DEBUG)
				{
					$conn['error'] = debug_backtrace();
					$queries[]	= $conn;
					$GLOBALS['queries'] = serialize($queries);					
				}
				
			}
			else
			{
				
				
				
				
				$id           = '';
				$resultNumber = '';
				$fieldNumber  = '';
				$affectedRows = '';
				if(strpos(strtoupper($query), "SELECT") === 0)
				{
					$resultNumber = mysql_num_rows($result);
					$fieldNumber  = mysql_num_fields($result);
				}
				elseif(strpos(strtoupper($query), "INSERT") === 0)
				{											
					$id = mysql_insert_id();
				}
				elseif(strpos(strtoupper($query), "UPDATE") === 0 || strpos(strtoupper($query), "DELETE") === 0)
				{
					$affectedRows = mysql_affected_rows();
				}
				$time_end_query	= microtime(true);
				$time_diff_query 		= ($time_end_query - $time_start_query);				
				if (DEBUG)
				{
					$conn['insert_id'] 		=  $id;
					$conn['num_rows'] 		=  $resultNumber;
					$conn['num_fields'] 	=  $fieldNumber;
					$conn['affected_rows'] 	=  $affectedRows;
					$conn['time'] 			=  $time_diff_query;
					$queries[]	= $conn;
					$GLOBALS['queries'] = serialize($queries);
				}
				return array('query' => $result, 
							 'insert_id' => $id, 
							 'num_rows' => $resultNumber, 
							 'num_fields' => $fieldNumber, 
							 'affected_rows' => $affectedRows);
			}
		}
		else
			return array('query' => false);
	}
}
?>