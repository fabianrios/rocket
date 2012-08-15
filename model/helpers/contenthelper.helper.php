<?php
class ContentHelper
{
	public static function selectContents ( $extra = "", $extraTables = "", $query = false)
	{
		$connection  = Connection::getInstance();
		$retrieveSql    = "SELECT cont_contents.content_id
							         FROM cont_contents" . $extraTables . "
								     WHERE cont_contents.content_state <> 'D'
									 AND cont_contents.content_state <> 'L'
									 AND (cont_contents.language_parent = '' OR cont_contents.language_parent IS NULL)
								     " . $extra;
									 
		if($query)
			echo $retrieveSql;					 
		
		return $connection->query($retrieveSql);		
	}
	public static function retrieveContents ( $extra  = "", $extraTables = "", $query = false)
	{
		$contents = array();
		
		$retrieveResult = self::selectContents ( $extra, $extraTables, $query );
		
		while($contentRow = mysql_fetch_assoc($retrieveResult["query"]))
			$contents[] = new Content($contentRow["content_id"]);
			
		return $contents;
	}
	public static function selectAllContents ( $extra = "", $extraTables = ""   )
	{
		$connection  = Connection::getInstance();
		$retrieveSql    = "SELECT cont_contents.content_id
							         FROM cont_contents" . $extraTables . "
								     WHERE content_state <> 'D'
								     " . $extra;
							 
		return $connection->query($retrieveSql);		
	}
	public static function retrieveAllContents ( $extra  = "", $extraTables = ""  )
	{
		$contents = array();
		
		$retrieveResult = self::selectAllContents ( $extra, $extraTables  );
		
		while($contentRow = mysql_fetch_assoc($retrieveResult["query"]))
			$contents[] = new Content($contentRow["content_id"]);
			
		return $contents;
	}
	public static function dumpAllContents($contents, $module) 
	{
		if (count($contents) > 0) {
			echo '<ul>';
			foreach ($contents as $content) 
			{
				$url = 'index.php?content_expand.control/'.$module.'/'.$content->__get('content_id');
				$filter = " AND content_parent = ".$content->__get('content_id');
				$next_contents 			= ContentHelper::retrieveContents($filter);
				$image = (count($next_contents) > 0) ?  "imgcontrol/ico_tree.gif" : "imgcontrol/ico_page.gif";
 				?> 
					<li><a href=<?=$url?> class="sidebar_02">
						<img src="<?=$image?>" />
						<span><?=str_replace("\\", "" ,$content->__get('content_varchar_1'))?></span>
						</a>
                        
                 <?php
						if (count($next_contents) > 0) self::dumpAllContents($next_contents, $module);			
				?>
				</li>
                <?php
			}
			?>
			</ul>
            <?php
		}	
	}
	public static function dumpBreadCrum(&$module, $content_id)
	{
		$module_url = 'index.php?content_list.control/'.$module->__get('module_id');
		echo "<a href=\"index.php?home.control\">Inicio</a> &gt; <a href=\"".$module_url."\">".$module->__get('module_name')."</a> ";
		if ($content_id != 0):
			$parents = array();
			$content = new Content($content_id);
			$counter = 0;	
			for ($i = 0; $i < 3; $i++)
			{
				if ($content->__get('content_parent') != 0)
				{
					$parents[] = $content;
					$content = new Content($content->__get('content_parent'));
				}
				else
					break;
			}
			$parents[] = $content;
			for ($i = count($parents) - 1; $i >= 0; $i--)
			{
				$url = 'index.php?content_list.control/'.$module->__get('module_id') . '/' 
				. $parents[$i]->__get('content_id');	
				echo "&gt; <a href=\"".$url."\">" . str_replace("\\", "" ,$parents[$i]->__get('content_varchar_1')) . "</a> ";
			}
		endif;
	}
	public static function dumpFrontBreadCrum(&$module, $content_id, $page)
	{
		$module_url = 'index.php?'.$page.'/'.$module->__get('module_id').'/0/'.$module->__get('module_name');
		echo "<a href=\"index.php\">Inicio</a> &gt; <a href=\"".$module_url."\">".$module->__get('module_name')."</a> ";
		if ($content_id != 0):
			$parents = array();
			$content = new Content($content_id);
			$counter = 0;	
			for ($i = 0; $i < 3; $i++)
			{
				if ($content->__get('content_parent') != 0)
				{
					$parents[] = $content;
					$content = new Content($content->__get('content_parent'));
				}
				else
					break;
			}
			$parents[] = $content;
			for ($i = count($parents) - 1; $i >= 0; $i--)
			{
				$url = 'index.php?'.$page.'/'.$module->__get('module_id').'/'
				. $parents[$i]->__get('content_id') . '/'. $parents[$i]->__get('content_varchar_1') ;	
				echo "&gt; <a href=\"".$url."\">".$parents[$i]->__get('content_varchar_1')."</a> ";
			}
		endif;
	}
	public static function siteContent($extra  = "", $extraTables = "")
	{
		$connection  = Connection::getInstance();
		$retrieveSql    = "SELECT content_site_id
						 FROM cont_contents_sites" . $extraTables . "
								     WHERE 1=1
								     " . $extra;
		$query = $connection->query($retrieveSql);	
		$contents = array();
		
		while($contentRow = mysql_fetch_assoc($query["query"]))
			$contents[] = new ContentSite($contentRow["content_site_id"]);
			
		return $contents;					
	}
/*FRONT-END */
/* MENUS */
	public static function getMenus($site_id=0, $parent_id=0, $module_id=0)
	{
		$extraTables 	= ($site_id != 0) ? ", cont_contents_sites" : ''; 
		$extra	 		= ($module_id != 0) ? " AND cont_contents.module_id =" . $module_id : "";
		$extra			.= ($site_id != 0) ?   " AND cont_contents.content_id = cont_contents_sites.content_id AND cont_contents_sites.site_id	= " . $site_id : '';
		$extra			.= " AND cont_contents.content_parent = ". $parent_id;
		$extra			.= " AND content_state = 'A' ORDER by content_order "; 
		$retrieveResult = self::selectContents ( $extra, $extraTables  );
		$contents = array();
		while($contentRow = mysql_fetch_assoc($retrieveResult["query"]))
			$contents[] = new Content($contentRow["content_id"]);
		return $contents; 		
	}
	public static function dumpMenus($site_id=0, $parent_id=0, $class = '')
	{
		$contents = self::getMenus(0, $parent_id, 6);
		if (count($contents) > 0):
			$class = ($class != '') ? 'id="'.$class.'"' : '';
			echo '<ul '.$class.'>';
				echo '<li class="home"><a href="index.php" title="Inicio">Inicio</a>';
				foreach ($contents as $content)
				{	
					$target = (trim($content->__get('content_varchar_4')) != '') ? $content->__get('content_varchar_4') : '_self';
					$url 	= self::retrieveUrl($content, 'content_varchar_2', $site_id);
					$class 	= ($content->__get('content_varchar_5') != '') ? 'class="'. $content->__get('content_varchar_5') .'"' : '';
					echo '<li '.$class.'>';
					echo '<a href="'.$url.'" target="' . $target . '" title="' . $content->__get('content_varchar_1') . '">' . $content->__get('content_varchar_1') . '</a>';
					self::dumpMenus($site_id, $content->__get('content_id'), 6);
					echo '</li>';
				}
			echo '</ul>';
		endif;
	}
	public static function retrieveUrl(&$content, $link_field = 'content_varchar_2', $site_id = 0)
	{
		$value = explode(':', $content->__get($link_field));
		if (strpos($content->__get($link_field), 'URL:') !== false)
			$url = str_replace('URL:', '', $content->__get($link_field));
		if (strpos($content->__get($link_field), 'SITE:') !== false)
			$url = APPLICATION_URL . 'index.php?show_site/' . $value[1] . '/' . urlencode($content->__get('content_varchar_1'));			
		if (strpos($content->__get($link_field), 'MOD:') !== false)
		{
			$module = new Module($value[1]);
			$show_site = ($site_id != 0) ? $site_id : 1;
			$url = APPLICATION_URL . 'index.php?'. $module->__get('module_front') .'/' . $show_site . '/' . $value[1] . '/' . urlencode($module->__get('module_name'));
		}																		
		if (strpos($content->__get($link_field), 'ID:') !== false)
		{
			$menuContent = new Content($value[1]);
			$module = new Module($menuContent->__get('module_id'));						
			$url = APPLICATION_URL . 'index.php?'. $module->__get('module_specific') .'/' . $value[1] . '/' . urlencode($menuContent->__get('content_varchar_1'));
		}	
		
		return $url;	
	}
	public static function retrieveLanguageContentId($contentId, $languageId)
	{
		$connection  = Connection::getInstance();
		$retrieveSql    = "SELECT content_id
						   FROM cont_contents
						   WHERE language_parent = " . escape($contentId) . "
						   AND language_id = " . escape($languageId);
		$query = $connection->query($retrieveSql);	
			
		if($query["num_rows"] > 0)
			return mysql_result($query["query"], 0, 0);					
		else
		{
			$retrieveSql    = "SELECT content_id
						  	   FROM cont_contents
						   	   WHERE content_id = " . escape($contentId) . "
						   	   AND language_id = " . escape($languageId);
			$query = $connection->query($retrieveSql);	
			
			if($query["num_rows"] > 0)
				return $contentId;	
			else
				return false;
		}
	}
	public static function getZone($zone_name)
	{
		 $zone = ZoneHelper::retrieveZones(" AND zone_code = '" . escape($zone_name) . "'"); 
		 if (count($zone) > 0)
		 {
			 $link = $zone[0]->__get('zone_link');
			 $link = explode(':', $link);
			 if (count($link) > 1)
			 {
			 	$content = self::retrieveContents(" AND content_id = " . $link[1] . "  AND content_state = 'A'");
				return $content;
			 }
			 else 
			 	return array();	 
		 }
		 else
		 	return array();
	}
	public static function retrieveFieldsResult ()
	{
		$connection  = Connection::getInstance();
		return $connection->query("SHOW COLUMNS FROM cont_contents");
	}	
	public static function retrievePressNotesDates()
	{
		$connection  = Connection::getInstance();
		$retrieveSql = "SELECT DISTINCT(YEAR(content_date_1)) as content_date_1
						FROM cont_contents
						WHERE module_id = 45
						ORDER BY content_date_1";
		
		$result = $connection->query($retrieveSql);				
		
		$years  = array();
		
		while($yearRow = mysql_fetch_assoc($result["query"]))
			$years[] = $yearRow["content_date_1"];
		
     	return $years;
	}
	public static function makeUrlId($str, $replace=array(), $delimiter='-')
	{
			if( !empty($replace) ) 
			{
				$str = str_replace((array)$replace, ' ', $str);
			}
		
			$clean = iconv('ISO-8859-1', 'ASCII//TRANSLIT', $str);
			$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
			$clean = strtolower(trim($clean, '-'));
			$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
		
			return $clean;
	}
}
?>