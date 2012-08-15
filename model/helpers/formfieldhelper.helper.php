<?php

class FormFieldHelper

{

	public static function selectFields ( $extra = "", $extraTables = ""   )

	{

		$connection  = Connection::getInstance();

		$retrieveSql    = "SELECT form_field_id

							 FROM core_forms_fields" . $extraTables . "

							 WHERE 1 = 1

							 " . $extra;

		return $connection->query($retrieveSql);		

	}

	public static function retrieveFields ( $extra  = "", $extraTables = ""  )

	{

		$fields = array();

		

		$retrieveResult = self::selectFields ( $extra, $extraTables  );

		

		while($fieldRow = mysql_fetch_assoc($retrieveResult["query"]))

			$fields[] = new FormField($fieldRow["form_field_id"]);

			

		return $fields;

	}

}

?>