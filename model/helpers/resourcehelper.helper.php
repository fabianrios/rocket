<?php
class ResourceHelper
{
	public static function selectResources ( $extra = "", $extraTables = ""   )
	{
		$connection  = Connection::getInstance();
		$retrieveResourcesSql    = "SELECT cont_resources.resource_id
							         FROM cont_resources" . $extraTables . "
								     WHERE resource_state <> 'D'
								     " . $extra;
		return $connection->query($retrieveResourcesSql);		
	}
	public static function retrieveResources ( $extra  = "", $extraTables = ""  )
	{
		$resources = array();
		
		$retrieveResourcesResult = self::selectResources ( $extra, $extraTables  );
		
		while($resourceRow = mysql_fetch_assoc($retrieveResourcesResult["query"]))
			$resources[] = new Resource($resourceRow["resource_id"]);
			
		return $resources;
	}
	public static function retrieveTags($typeId)
	{
		$extra = '';
		if($typeId != NULL)
			$extra = "AND resource_type_id = " . escape($typeId);	
		$retrieveTagsSql = "SELECT resource_tags FROM cont_resources WHERE resource_accepted = 1 " . $extra;
		$connection  	 = Connection::getInstance();	
		$result 		 = $connection->query($retrieveTagsSql);
		$tagArray		 = array();
		while($tags = mysql_fetch_assoc($result["query"]))
		{
			$tags = explode(',', $tags["resource_tags"]);
			foreach($tags as $tag) 
				$tagArray[$tag] = $tag;
		}
		arsort($tagArray);
		return $tagArray;			
	}
	public static function getGallery($content_id, $content_resource_field_name, $limit = "")
	{
		$extra = " AND cont_contents_resources.resource_id = cont_resources.resource_id 
				   AND cont_contents_resources.content_id = " . $content_id .
				 " AND cont_contents_resources.content_resource_field_name = '" . $content_resource_field_name . "'
				   ORDER BY content_resource_order 
				 " . $limit;
		$extraTables = ", cont_contents_resources";		
		$resources = array();
		
		$retrieveResourcesResult = self::selectResources ( $extra, $extraTables  );
		
		while($resourceRow = mysql_fetch_assoc($retrieveResourcesResult["query"]))
			$resources[] = new Resource($resourceRow["resource_id"]);
			
		return $resources;			  	
	}
	public static function placeEmbed($url, $width, $height)
	{
		if(strpos($url, 'youtube') !== false)
		{
			self::place_youtube($url, $width, $height);	
		}
		if(strpos($url, 'vimeo') !== false)
		{
			self::place_vimeo($url, $width, $height);	
		}
		if(strpos($url, 'metacafe') !== false)
		{
			self::place_metacafe($url, $width, $height);	
		}
		else 
			return false;
	}
	private static function place_youtube($url, $width, $height)
	{
		$key = explode('=',$url);
		$key = $key[1];
		$object = '<object width="'.$width.'" height="'.$height.'">
					<param name="movie" value="">
					</param>				   
					<param name="allowFullScreen" value="true">
					</param>
					<param name="allowscriptaccess" value="always">
					</param>
					<embed src="http://www.youtube.com/v/'.$key.'&hl=es&fs=1&rel=0&color1=0x2b405b&color2=0x6b8ab6" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="'.$width.'" height="'.$height.'"></embed>
				  </object>';
		echo $object;	
	}
	private static function place_vimeo($url, $width, $height)
	{
		$key = explode('com/',$url);
		$key = $key[1];
		$object = '<object width="'.$width.'" height="'.$height.'"><param name="allowfullscreen" value="true" /><param name="allowscriptaccess"value="always" />
				<param name="movie" value="http://www.vimeo.com/moogaloop.swf?clip_id=5225011&amp;server=vimeo.com&amp;show_title=1&amp;show_byline=1&amp;show_portrait=0&amp;color=&amp;fullscreen=1" />
				<embed src="http://vimeo.com/moogaloop.swf?clip_id='.$key.'&amp;server=vimeo.com&amp;show_title=1&amp;show_byline=1&amp;show_portrait=0&amp;color=&amp;fullscreen=1" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="'.$width.'" height="'.$height.'"></embed></object>';
		echo $object;
	}	
	private static function place_metacafe($url, $width, $height)
	{
		$key = explode('watch/',$url);
		$key = explode('/',$key[1]);
		
		$object = '
					<embed src="http://www.metacafe.com/fplayer/'.$key[0].'/'.$key[1].'.swf" 
					width="'.$width.'" height="'.$height.'" wmode="transparent" allowFullScreen="true" allowScriptAccess="always" 
					name="Metacafe_'.$key.'" pluginspage="http://www.macromedia.com/go/getflashplayer" 
					type="application/x-shockwave-flash"> 
					</embed>
					<br>';
		echo $object;
	}
	public static function retrieveThumbFolders()
	{
		$path = 'resources/images/';
		$directories = array();
		if ($handle = opendir($path)) 
			while (($file = readdir($handle)) !== false) 
				if (is_dir($path.$file)) 
					if (($file != '.') && ($file != '..')) 
						$directories[] = $file;
	
		return $directories;
	}
}
?>