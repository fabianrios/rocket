<?php
class IncomeCategoryHelper
{
	public static function selectIncomeCategories ( $extra = "", $extraTables = ""   )
	{
		$connection  		= Connection::getInstance();
		$retrieveIncomeCategoriesSql   = "SELECT income_category_id
							         FROM user_incomes_categories" . $extraTables . "
								     WHERE 1=1
								     " . $extra;
		return $connection->query($retrieveIncomeCategoriesSql);		
	}
	public static function retrieveIncomeCategories ( $extra  = "", $extraTables = ""  )
	{
		$incomeCategories = array();
		
		$retrieveIncomeCategoriesResult = self::selectIncomeCategories ( $extra, $extraTables  );
		
		while($incomeCategoryRow = mysql_fetch_assoc($retrieveIncomeCategoriesResult["query"]))
			$incomeCategories[] = new IncomeCategory($incomeCategoryRow["income_category_id"]);
			
		return $incomeCategories;
	}
}
?>