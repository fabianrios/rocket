<?php
class EnvelopeExtraHelper
{
	public static function selectEnvelopeExtras ( $extra = "", $extraTables = ""   )
	{
		$connection  = Connection::getInstance();
		$retrieveEnvelopeExtrasSql    = "SELECT *
							         FROM user_envelopes_extras" . $extraTables . "
								     WHERE 1=1
								     " . $extra;
		return $connection->query($retrieveEnvelopeExtrasSql);		
	}
	public static function retrieveEnvelopeExtras ( $extra  = "", $extraTables = ""  )
	{
		$creditotramites = array();
		
		$retrieveEnvelopeExtrasResult = self::selectEnvelopeExtras ( $extra, $extraTables  );
		
		while($contacRow = mysql_fetch_assoc($retrieveEnvelopeExtrasResult["query"]))
			$creditotramites[] = new EnvelopeExtra($contacRow["envelope_extra_id"]);
			
		return $creditotramites;
	}
}
?>