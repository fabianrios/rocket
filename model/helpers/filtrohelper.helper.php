<?php
class FiltroHelper
{
	public static function selectFiltros ( $extra = "", $extraTables = ""   )
	{
		$connection  = Connection::getInstance();
		$retrieveFiltrosSql    = "SELECT filtro_id, filtro_producto_id
								 FROM comp_filtros" . $extraTables . "
								 WHERE 1 = 1 
								 " . $extra;
		return $connection->query($retrieveFiltrosSql);		
	}
	public static function retrieveFiltros ( $extra  = "", $extraTables = ""  )
	{
		$Filtros = array();
		
		$retrieveFiltrosResult = self::selectFiltros ( $extra, $extraTables  );
		
		while($FiltroRow = mysql_fetch_assoc($retrieveFiltrosResult["query"]))
			$Filtros[] = new Filtro($FiltroRow["financiero_id"]);
			
		return $Filtros;
	}
	public static function sendActivationMail($args)
	{
	}
}
?>