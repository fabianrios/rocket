<?php
class DocumentHelper
{
	public static function selectDocuments ( $extra = "", $extraTables = ""   )
	{
		$connection  = Connection::getInstance();
		$retrieveDocumentsSql    = "SELECT document_id, document_pints
							         FROM prod_documents" . $extraTables . "
								     WHERE 1=1
								     " . $extra;
		return $connection->query($retrieveDocumentsSql);		
	}
	public static function retrieveDocuments ( $extra  = "", $extraTables = ""  )
	{
		$documents = array();
		
		$retrieveDocumentsResult = self::selectDocuments ( $extra, $extraTables  );
		
		while($contacRow = mysql_fetch_assoc($retrieveDocumentsResult["query"]))
			$documents[] = new Document($contacRow["document_id"]);
			
		return $documents;
	}
}
?>