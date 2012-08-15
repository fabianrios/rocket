<?php
class EnvelopeCategoryHelper
{
	public static function selectEnvelopeCategories ( $extra = "", $extraTables = ""   )
	{
		$connection  		= Connection::getInstance();
		$retrieveEnvelopeCategoriesSql   = "SELECT envelope_category_id
							         FROM user_envelopes_categories" . $extraTables . "
								     WHERE 1=1
								     " . $extra;
		return $connection->query($retrieveEnvelopeCategoriesSql);		
	}
	public static function retrieveEnvelopeCategories ( $extra  = "", $extraTables = ""  )
	{
		$envelopeCategories = array();
		
		$retrieveEnvelopeCategoriesResult = self::selectEnvelopeCategories ( $extra, $extraTables  );
		
		while($envelopeCategoryRow = mysql_fetch_assoc($retrieveEnvelopeCategoriesResult["query"]))
			$envelopeCategories[] = new EnvelopeCategory($envelopeCategoryRow["envelope_category_id"]);
			
		return $envelopeCategories;
	}
}
?>