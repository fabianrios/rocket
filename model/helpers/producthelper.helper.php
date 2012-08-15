<?php
class ProductHelper
{
	public static function selectProducts ( $extra = "", $extraTables = ""   )
	{
		$connection  = Connection::getInstance();
		$retrieveProductsSql    = "SELECT product_id
							         FROM iden_products" . $extraTables . "
								     WHERE 1 = 1
								     " . $extra;
		return $connection->query($retrieveProductsSql);		
	}
	public static function retrieveProducts ( $extra  = "", $extraTables = ""  )
	{
		$products = array();
		
		$retrieveProductsResult = self::selectProducts ( $extra, $extraTables  );
		
		while($productRow = mysql_fetch_assoc($retrieveProductsResult["query"]))
			$products[] = new Product($productRow["product_id"]);
			
		return $products;
	}
}
?>