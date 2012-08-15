<?php

class LanguageHelper

{

	public static function selectLanguages ( $extra = "", $extraTables = ""   )

	{

		$connection  = Connection::getInstance();

		$retrieveLanguagesSql    = "SELECT language_id

							         FROM core_languages" . $extraTables . "

								     WHERE language_state <> 'D'

								     " . $extra;

		return $connection->query($retrieveLanguagesSql);		

	}

	public static function retrieveLanguages ( $extra  = "", $extraTables = ""  )

	{

		$languages = array();

		

		$retrieveLanguagesResult = self::selectLanguages ( $extra, $extraTables  );

		

		while($languageRow = mysql_fetch_assoc($retrieveLanguagesResult["query"]))

			$languages[] = new Language($languageRow["language_id"]);

			

		return $languages;

	}



}

?>