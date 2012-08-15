<?php
class ContentRelationHelper
{

	public static function selectContentRelationsQuery ($extra, $extraTables, $field, $echo = false)
	{
		$connection  = Connection::getInstance();
		$retrieveContentRelationsSql    = "SELECT ". $field . " as field
							         FROM cont_relalation_contents " . $extraTables . "
								     WHERE 1 = 1 ". $extra;		 	
		if ($echo) echo $retrieveContentRelationsSql;
		$arra_query = $connection->query($retrieveContentRelationsSql);
		$contents = array();
		while($content_id = mysql_fetch_assoc($arra_query['query']))
			$contents[] = $content_id['field'];
		return $contents;		
	}

	public static function selectContentRelations ($content_id,$key)
	{
		$connection  = Connection::getInstance();
		$retrieveContentRelationsSql    = "SELECT *
							         FROM cont_relalation_contents
								     WHERE content_id = " . $content_id .' AND relationship_key = "' . $key . '"';
									 
		$arra_query = $connection->query($retrieveContentRelationsSql);
		$contents = array();
		
		while($content_id = mysql_fetch_assoc($arra_query['query']))
			$contents[] = $content_id['content_id_1'];
		
		return $contents;		
	}
	
	public static function selectContentRelation ($content_id,$content_id_1,$key)
	{
		$connection  = Connection::getInstance();
		$retrieveContentRelationsSql    = "SELECT content_id
							         FROM cont_relalation_contents
								     WHERE content_id = " . $content_id .' AND content_id_1 = ' . $content_id_1 . ' AND relationship_key = "' . $key . '"';
		
		
		return $connection->query($retrieveContentRelationsSql);;		
	}
	
	public static function numContentRelation($content_id,$key)
	{
		$connection  = Connection::getInstance();
		$retrieveContentRelationsSql    = "SELECT content_id
							         FROM cont_relalation_contents
								     WHERE content_id = " . $content_id .' AND relationship_key = "' . $key . '"';
		
				
		return $connection->query($retrieveContentRelationsSql);;		
	}
	
	public static function deleteContentRelation($content_id_1,$key)
	{
		$connection  = Connection::getInstance();
		$retrieveContentRelationsSql    = "DELETE FROM cont_relalation_contents WHERE content_id_1 = " . $content_id_1 . ' AND relationship_key = "' . $key . '"';
				
		$connection->query($retrieveContentRelationsSql);		
	}
	
	public static function insertContentRelation($content_id,$content_id_1,$key)
	{
		$connection  = Connection::getInstance();
		$retrieveContentRelationsSql    = "INSERT INTO cont_relalation_contents (content_id,content_id_1,relationship_key) VALUES ('" . $content_id . "','" . $content_id_1 . "','" . $key . "')";
				
		$connection->query($retrieveContentRelationsSql);		
	}
	
	public static function deleteFullContentRelation($content_id,$key)
	{
		$connection  = Connection::getInstance();
		$retrieveContentRelationsSql    = "DELETE FROM cont_relalation_contents WHERE content_id = " . $content_id . ' AND relationship_key = "' . $key . '"';
				
		$connection->query($retrieveContentRelationsSql);		
	}
	
	public static function selectContentPRelations ($content_id,$key)
	{
		$connection  = Connection::getInstance();
		$retrieveContentRelationsSql    = "SELECT DISTINCT content_id
							         FROM cont_relalation_contents
								     WHERE content_id_1 = ".$content_id." AND relationship_key = '" . $key . "'";
									 
		$arra_query = $connection->query($retrieveContentRelationsSql);
		$contents = array();
		
		while($content_id = mysql_fetch_assoc($arra_query['query']))
			$contents[] = $content_id['content_id'];
		
		return $contents;		
	}
}
?>