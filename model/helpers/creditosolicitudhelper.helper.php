<?php
class CreditoSolicitudHelper
{
	public static function selectCreditoSolicitudes ( $extra = "", $extraTables = ""   )
	{
		$connection  = Connection::getInstance();
		$retrieveCreditoSolicitudsSql    = "SELECT *
							         FROM cr_solicitudes" . $extraTables . "
								     WHERE 1=1
								     " . $extra;
		return $connection->query($retrieveCreditoSolicitudsSql);		
	}
	public static function retrieveCreditoSolicitudes ( $extra  = "", $extraTables = ""  )
	{
		$creditosolicitudes = array();
		
		$retrieveCreditoSolicitudsResult = self::selectCreditoSolicitudes ( $extra, $extraTables  );
		
		while($contacRow = mysql_fetch_assoc($retrieveCreditoSolicitudsResult["query"]))
			$creditosolicitudes[] = new CreditoSolicitud($contacRow["solicitud_id"]);
			
		return $creditosolicitudes;
	}
}
?>