<?php

class ContentResourceHelper

{

	public static function selectContentResources ( $extra = "", $extraTables = ""   )

	{

		$connection  = Connection::getInstance();

		$retrieveContentResourcesSql    = "SELECT content_resource_id

							         FROM cont_contents_resources" . $extraTables . "

								     WHERE 1 = 1

								     " . $extra;

		return $connection->query($retrieveContentResourcesSql);		

	}

	public static function retrieveContentResources ( $extra  = "", $extraTables = ""  )

	{

		$contentResources = array();

		

		$retrieveContentResourcesResult = self::selectContentResources ( $extra, $extraTables  );

		

		while($contentResourceRow = mysql_fetch_assoc($retrieveContentResourcesResult["query"]))

			$contentResources[] = new ContentResource($contentResourceRow["content_resource_id"]);

			

		return $contentResources;

	}

}

?>