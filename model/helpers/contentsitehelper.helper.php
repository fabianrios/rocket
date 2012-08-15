<?php

class ContentSiteHelper

{

	public static function selectContentSites ( $extra = "", $extraTables = ""   )

	{

		$connection  = Connection::getInstance();

		$retrieveContentSitesSql    = "SELECT content_site_id

							         FROM cont_contents_sites" . $extraTables . "

								     WHERE 1 = 1

								     " . $extra;

		return $connection->query($retrieveContentSitesSql);		

	}

	public static function retrieveContentSites ( $extra  = "", $extraTables = ""  )

	{

		$contentSites = array();

		

		$retrieveContentSitesResult = self::selectContentSites ( $extra, $extraTables  );

		

		while($contentSiteRow = mysql_fetch_assoc($retrieveContentSitesResult["query"]))

			$contentSites[] = new ContentSite($contentSiteRow["content_site_id"]);

			

		return $contentSites;

	}

}

?>