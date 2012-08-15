<?php
class MetaTagHelper
{
	public static function selectMetaTags ( $extra = "", $extraTables = ""   )
	{
		$connection  = Connection::getInstance();
		$retrieveMetaTagsSql    = "SELECT meta_tag_id
							         FROM cont_meta_tags" . $extraTables . "
								     WHERE 1 = 1
								     " . $extra;
		return $connection->query($retrieveMetaTagsSql);		
	}
	public static function retrieveMetaTags ( $extra  = "", $extraTables = ""  )
	{
		$metaTags = array();
		
		$retrieveMetaTagsResult = self::selectMetaTags ( $extra, $extraTables  );
		
		while($metaTagRow = mysql_fetch_assoc($retrieveMetaTagsResult["query"]))
			$metaTags[] = new metaTag($metaTagRow["meta_tag_id"]);
			
		return $metaTags;
	}
}
?>