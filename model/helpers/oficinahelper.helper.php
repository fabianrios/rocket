<?php
class OficinaHelper
{
	public static function selectOficinas ( $extra = "" )
	{
		$connection  = Connection::getInstance();
		$retrieveOficinasSql    = "SELECT direccion_id
							         FROM ugeo_oficinas
								     WHERE 1 = 1
								     " . $extra;
		return $connection->query($retrieveOficinasSql);		
	}
	public static function retrieveOficinas ( $extra  = "" )
	{
		$oficinas = array();
		
		$retrieveOficinasResult = self::selectOficinas ( $extra, $tablePrefix  );
		
		while($oficinaRow = mysql_fetch_assoc($retrieveOficinasResult["query"]))
			$oficinas[] = new Oficina($oficinaRow["oficina_id"], $tablePrefix);
			
		return $oficinas;
	}
}
?>