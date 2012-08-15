<?php
$action = isset($_POST['action']) ? $_POST['action'] : $_GET[0];
$session = Security::validateSession();
switch ($action):
	case 'update_vars':
		$vars = new ShopVar(1);
		foreach($_POST as $key => $value)
			$vars->__set($key, $value);
		$vars->update();
		
		//Busco todos los productos
		$listProducts	= ProductHelper::retrieveProducts(' ORDER BY product_id');
		foreach($listProducts as $listProduct)
		{
			//MAXIMO RANGO
			$maxRanges	= ProductRangeHelper::retrieveProductRanges(' AND `product_id` = '.$listProduct->__get('product_id').' AND `product_range_number` = (SELECT MAX(`product_range_number`) FROM `shop_products_ranges` WHERE `product_id` = '.$listProduct->__get('product_id').')');
			//Valor minimo por producto
			if(count($maxRanges)>0) // verifico la existencia de un rango.
			{
				$product	= new Product($listProduct->__get('product_id'));
				$priceMinimum = ceil_hundreds(PriceHelper::calculatePrice($product, $maxRanges[0]));
				$product->__set('product_price', $priceMinimum);
				$product->update();
			}
		}
		redirectUrl('index.php?shop_variables_expand.control');
	break;
endswitch;
?>