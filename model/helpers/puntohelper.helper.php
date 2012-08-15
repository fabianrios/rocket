<?php
class PuntoHelper
{
	public static function selectPuntos ( $extra = "", $extraTables = ""   )
	{
		$connection  = Connection::getInstance();
		$retrievePuntosSql    = "SELECT punto_id
								 FROM geo_puntos" . $extraTables . "
								 WHERE 1 = 1 
								 " . $extra;
		return $connection->query($retrievePuntosSql);		
	}
	public static function retrievePuntos ( $extra  = "", $extraTables = ""  )
	{
		$Puntos = array();
		
		$retrievePuntosResult = self::selectPuntos ( $extra, $extraTables  );
		
		while($PuntoRow = mysql_fetch_assoc($retrievePuntosResult["query"]))
			$Puntos[] = new Punto($PuntoRow["punto_id"]);
			
		return $Puntos;
	}
}
?>