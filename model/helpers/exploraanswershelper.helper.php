<?php
class ExploraAnswersHelper
{
	public static function selectExplora ( $extra = "", $extraTables = ""   )
	{
		$connection  = Connection::getInstance();
		$retrieveExploraSql    = "SELECT answer_id
							         FROM iden_explora_answers" . $extraTables . "
								     WHERE 1=1
								     " . $extra;
		return $connection->query($retrieveExploraSql);		
	}
	public static function retrieveExplora ( $extra  = "", $extraTables = ""  )
	{
		$explora = array();
		
		$retrieveExploraResult = self::selectExplora ( $extra, $extraTables  );
		
		while($contacRow = mysql_fetch_assoc($retrieveExploraResult["query"]))
			$explora[] = new ExploraAnswer($contacRow["answer_id"]);
			
		return $explora;
	}
}
?>