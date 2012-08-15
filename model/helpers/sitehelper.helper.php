<?php

class SiteHelper

{

	public static function selectSites ( $extra = "", $extraTables = ""   )

	{

		$connection  = Connection::getInstance();

		$retrieveSitesSql    = "SELECT site_id

							         FROM core_sites" . $extraTables . "

								     WHERE site_state <> 'D'

								     " . $extra;

		return $connection->query($retrieveSitesSql);		

	}

	public static function retrieveSites ( $extra  = "", $extraTables = ""  )

	{

		$sites = array();

		

		$retrieveSitesResult = self::selectSites ( $extra, $extraTables  );

		

		while($siteRow = mysql_fetch_assoc($retrieveSitesResult["query"]))

			$sites[] = new Site($siteRow["site_id"]);

			

		return $sites;

	}

	public static function dumpAllSites(&$sites, $module) 

	{

		if (count($sites) > 0) {

			echo '<ul>';

			foreach ($sites as $site) 

			{

				$url = 'index.php?site_expand.control/'.$module.'/'.$site->__get('site_id');

				$filter = " AND site_parent = ".$site->__get('site_id');

				$next_sites 			= SiteHelper::retrieveSites($filter);

				$image = (count($next_sites) > 0) ?  "imgcontrol/ico_tree.gif" : "imgcontrol/ico_page.gif";

 				echo "

					<li><a href=\"".$url."\" class=\"sidebar_02\">

						<img src=\"".$image."\" />

						<span>".$site->__get('site_name')."</span>

						</a>";

						if (count($next_sites) > 0) self::dumpAllSites($next_sites, $module);			

				echo "</li>";

			}

			echo '</ul>';

		}	

	}	

}

?>