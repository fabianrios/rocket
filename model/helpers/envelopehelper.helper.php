<?php
class EnvelopeHelper
{
	public static function selectEnvelopes ( $extra = "", $extraTables = ""   )
	{
		$connection  		= Connection::getInstance();
		$retrieveEnvelopesSql   = "SELECT envelope_id
							         FROM user_envelopes" . $extraTables . "
								     WHERE 1=1
								     " . $extra;
		return $connection->query($retrieveEnvelopesSql);		
	}
	public static function retrieveEnvelopes ( $extra  = "", $extraTables = ""  )
	{
		$envelopes = array();
		
		$retrieveEnvelopesResult = self::selectEnvelopes ( $extra, $extraTables  );
		
		while($envelopeRow = mysql_fetch_assoc($retrieveEnvelopesResult["query"]))
			$envelopes[] = new Envelope($envelopeRow["envelope_id"]);
			
		return $envelopes;
	}
	public static function getData($envelopeId, $field)
	{
		$envelope	= new Envelope($envelopeId);
		$data	= unserialize($envelope->__get('envelope_data'));
		if (isset($data[$field]))
			return	$value;
		else
			return false;
	}
	public static function setData($envelopeId, $field, $value)
	{
		$envelope			= new Envelope($envelopeId);
		$data			= unserialize($envelope->__get('envelope_data'));
		$data[$field]	=	$value;
		$envelope->__set('envelope_data', serialize($data));
		$envelope->update();
	}
	
}
?>