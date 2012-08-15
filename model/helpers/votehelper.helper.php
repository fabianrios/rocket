<?php

class VoteHelper

{

	public static function selectVotes ( $extra = "", $extraTables = ""   )

	{

		$connection  = Connection::getInstance();

		$retrieveVotesSql    = "SELECT vote_id

							         FROM cont_votes" . $extraTables . "

								     WHERE 1 = 1

								     " . $extra;

		return $connection->query($retrieveVotesSql);		

	}

	public static function retrieveVotesInformation ( $contentId  )

	{

		$retrieveVotesSql    = "SELECT vote_value

								FROM cont_votes

								WHERE content_id = " . $contentId;



		$connection = Connection::getInstance();

		$result 	= $connection->query($retrieveVotesSql);

		$total		= $result["num_rows"];

		$sum 		= 0;

		while($vote = mysql_fetch_assoc($result["query"]))

			$sum = $sum + $vote["vote_value"];

		

		$average = formatNumber(($sum/$total), 1, '.', '.');

		

		return array($total, $average);

	}

}

?>