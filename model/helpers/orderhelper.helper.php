<?php
class OrderHelper
{
	public static function selectOrders ( $extra = "", $tablePrefix = "iden_"   )
	{
		$connection  = Connection::getInstance();
		$retrieveOrdersSql    = "SELECT order_id
							         FROM " . $tablePrefix . "orders
								     WHERE 1 = 1
								     " . $extra;
		return $connection->query($retrieveOrdersSql);		
	}
	public static function retrieveOrders ( $extra  = "", $tablePrefix = "iden_"  )
	{
		$orders = array();
		
		$retrieveOrdersResult = self::selectOrders ( $extra, $tablePrefix  );
		
		while($orderRow = mysql_fetch_assoc($retrieveOrdersResult["query"]))
			$orders[] = new Order($orderRow["order_id"], $tablePrefix);
			
		return $orders;
	}
}
?>