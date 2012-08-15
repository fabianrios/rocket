<?php
class ContactHelper
{
	public static function selectContacts ( $extra = "", $extraTables = ""   )
	{
		$connection  = Connection::getInstance();
		$retrieveContactsSql    = "SELECT contact_id
							         FROM cont_contacts" . $extraTables . "
								     WHERE 1=1
								     " . $extra;
		return $connection->query($retrieveContactsSql);		
	}
	public static function retrieveContacts ( $extra  = "", $extraTables = ""  )
	{
		$contacts = array();
		
		$retrieveContactsResult = self::selectContacts ( $extra, $extraTables  );
		
		while($contacRow = mysql_fetch_assoc($retrieveContactsResult["query"]))
			$contacts[] = new Contact($contacRow["contact_id"]);
			
		return $contacts;
	}
}
?>