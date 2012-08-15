<?php

class FieldHelper

{

	public static function selectFields ( $extra = "", $extraTables = ""   )

	{

		$connection  = Connection::getInstance();

		$retrieveSql    = "SELECT field_id

							         FROM cont_fields" . $extraTables . "

								     WHERE field_state <> 'D'

								     " . $extra;

		return $connection->query($retrieveSql);		

	}

	public static function retrieveFields ( $extra  = "", $extraTables = ""  )

	{

		$fields = array();

		

		$retrieveResult = self::selectFields ( $extra, $extraTables  );

		

		while($fieldRow = mysql_fetch_assoc($retrieveResult["query"]))

			$fields[] = new Field($fieldRow["field_id"]);

			

		return $fields;

	}

	public static function getFieldName($module_id, $field_title)

	{

		$extra = " AND module_id = " . $module_id . " AND field_label = '" . utf8_decode($field_title) . "'";

		$retrieveResult = self::selectFields ($extra);

		

		$fields = array();

		

		while($fieldRow = mysql_fetch_assoc($retrieveResult["query"]))

			$fields[] = new Field($fieldRow["field_id"]);

			

		if (count($fields) > 0) 

			return $fields[0]->__get('field_name');

		else

			return 'NULL';

	}

}

?>