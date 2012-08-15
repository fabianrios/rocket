<?php

class FormHelper

{

	public static function selectForms ( $extra = "", $extraTables = ""   )

	{

		$connection  = Connection::getInstance();

		$retrieveFormsSql    = "SELECT form_id

							         FROM core_forms" . $extraTables . "

								     WHERE form_state <> 'D'

								     " . $extra;

		return $connection->query($retrieveFormsSql);		

	}

	public static function retrieveForms ( $extra  = "", $extraTables = ""  )

	{

		$forms = array();

		

		$retrieveFormsResult = self::selectForms ( $extra, $extraTables  );

		

		while($formRow = mysql_fetch_assoc($retrieveFormsResult["query"]))

			$forms[] = new FormContent($formRow["form_id"]);

			

		return $forms;

	}

}

?>