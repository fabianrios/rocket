<?php
$action = isset($_POST['action']) ? $_POST['action'] : $_GET[0];
switch ($action):
	case 'preselect':
		$specie = new Specie(escape($_GET[1]));
		$cart 	 = new Cart();
		$cart->addItem($specie->__get('specie_id'), array('specie_id' => $specie->__get('specie_id'),
															'specie_name' => $specie->__get('specie_name'),
															'specie_price' => $specie->__get('specie_price')));
		$url  	 = APPLICATION_URL . 'especies.html';
		redirectUrl($url);
	break;
	
	case 'deleteItem':
		$cart  = new Cart();
		$cart->deleteItem(escape($_GET[1]));
		redirectUrl(APPLICATION_URL . 'especies.html');
	break;
	
	case 'delete_items':
		$cart  = new Cart();
		foreach($cart->cartVars as $cartVar)
		{
			if(isset($_POST['product' . $cartVar['product_id']]))
			{
				$cart->deleteItem($cartVar['product_id']);
			}
		}
		redirectUrl(APPLICATION_URL . 'shop_cart.html');
	break;
	case 'recalculate_items':
		$cart  = new Cart();
		foreach($cart->cartVars as $cartVar)
		{
			$cartVar['product_quantity'] = $_POST['product_quantity' . $cartVar['product_id']];
			$cart->addItem($cartVar['product_id'], $cartVar);
		}
		
		//verifico la existencia de un bono de descuento.
		if(strlen(trim($_POST['coupon_code']))>0)
		{
			$existCoupon	= CouponHelper::retrieveCoupons(' AND coupon_code = "'.$_POST['coupon_code'].'" AND coupon_state = "A"');
			if(count($existCoupon)>0)
			{
				$cart->addItem($cartVar['coupon_id'], $existCoupon[0]->__get('coupon_id'));	
				redirectUrl(APPLICATION_URL . 'shop_cart.html');		
			}
			else
				redirectUrl(APPLICATION_URL . 'shop_cart/Cuopon.html');	
		}
		else
			redirectUrl(APPLICATION_URL . 'shop_cart.html');		
		
	break;
	case 'submit_order':
		$order = new Order();
		$cart  = new Cart();
		$order->__set('user_id', $_SESSION['user_id']);
		$order->__set('order_status', 0);
		$order->__set('order_datetime', date('Y-m-d H:i:s'));
		$order->__set('order_freight_value', $_POST['order_freight_value']);
   		$order->__set('order_tax', $_POST['order_tax']);
		$order->__set('order_data', serialize($cart));
		$save = $order->save();
		//Guardo el codigo
		$order = new Order($save['insert_id']);
		$order->__set('order_code',$save['insert_id'].substr(md5(date('sdiymH')),0,7));
		$order->update();
		redirectUrl(APPLICATION_URL . 'shop_order_confirm/'.$save['insert_id'].'.html');
	break;
	case 'submit_order_foreign_user':
		$order = new Order();
		$cart  = new Cart();
		$order->__set('user_id', $_SESSION['user_id']);
		$order->__set('order_status', 1);
		$order->__set('order_datetime', date('Y-m-d H:i:s'));
		$order->__set('order_freight_value', $_POST['order_freight_value']);
    $order->__set('order_tax', $_POST['order_tax']);
		$order->__set('order_data', serialize($cart));
		$save = $order->save();
		//Guardo el codigo
		$order = new Order($save['insert_id']);
		$order->__set('order_code',$save['insert_id'].substr(md5(date('sdiymH')),0,7));
		$order->update();
		redirectUrl(APPLICATION_URL . 'shop_cart/overseas.html');	
	break;
	case 'confirm_pol_order':
		$order = new Order($_POST['order_id']);
		$order->__set('order_status',1);
		$order->update();
		$user  = new User($order->__get('order_id'));
		// POL
		$password  	   = "12afc2de8bd";
		$user_id   	   = "62810";
		$reference 	   = "GZGG-" . $order->__get('order_code');
		$currency  	   = "COP";
		$cart          = unserialize($order->__get('order_data'));   
		$total         = 0;
		$tax           = $order->__get('order_tax'); 
		foreach($cart->cartVars as $cartVar)
		{
		  $total += $cartVar['product_price'] * $cartVar['product_quantity'];
		}    
		$total         = $total + $tax + $order->__get('order_freight_value');
		$signature     = "$password~$user_id~$reference~" . $total . "~$currency";    
		$signatureHash = md5($signature);     
		
		?>    
		<body onLoad="document.getElementById('polForm').submit();">
			<form name="polForm" id="polForm" method="post" action="https://gateway2.pagosonline.net/apps/gateway/index.html">
				<input type="hidden" name="prueba" value="1" />
				<input type="hidden" name="usuarioId" value="<?=$user_id?>" />
				<input type="hidden" name="descripcion" value="Compra Gzgg" />
				<input type="hidden" name="refVenta" value="<?=$reference?>" />
				<input type="hidden" name="baseDevolucionIva" value="<?php echo $total - $tax?>" />
				<input type="hidden" name="valor" value="<?=$total?>" />
				<input type="hidden" name="iva" value="<?php echo $tax?>" />
				<input type="hidden" name="moneda" value="<?=$currency?>" />
				<input type="hidden" name="url_respuesta" value="<?php echo APPLICATION_FULL_URL . 'shop_order_save/'.$_POST['order_id'].'.html?'?>" />
				<input type="hidden" name="url_confirmacion" value="<?php echo APPLICATION_FULL_URL . 'shop_pol_process.html'?>" />
				<input type="hidden" name="firma" value="<?=$signatureHash?>" />
				<input type="hidden" name="emailComprador" value="<?=$user->__get('user_email')?>" />
				<input type="hidden" name="extra1" value="<?=$user->__get('user_id')?>" />
			</form>
		</body>		
		<?php
		//Envio Mails
		$cuerpo = '<b>Codigo Orden:</b> GZGG-'.$order->__get('order_code').'<br>
				   <b>Fecha:</b>'.$order->__get('order_datetime').'<br>
				   <b>Total:</b>'.$total;
				   
		$headers = "MIME-Version: 1.0\r\n"; 
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers .= "From: GZGG <info@gzgg.com.co>\r\n";
		$headers .= "Bcc: info@gzgg.com.co\r\n";
		$asunto = 'Compra Gzgg - '.$order->__get('order_code');
		
		mail('comercial@gzgg.com.co',$asunto,$cuerpo,$headers);
		unset($_SESSION['cart']);
	break;
	case 'confirm_order':
		$order = new Order($_POST['order_id']);
		$order->__set('order_status',1);
		$order->update();
		unset($_SESSION['cart']);
		
		//Envio Mails
		$user	 = new User($_SESSION['user_id']); //vendedor.
		
		$cuerpo = '<b>Codigo Orden:</b> '.$order->__get('order_code').'<br>
				   <b>Fecha:</b>'.$order->__get('order_datetime');
		$headers = "MIME-Version: 1.0\r\n"; 
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers .= "From: GZGG <info@gzgg.com.co>\r\n";
		$asunto = 'Orden Generada Gzgg '.$order->__get('order_code');
		mail($user->__get('user_email'),$asunto,$cuerpo,$headers);
		
		$headers .= "Bcc: info@gzgg.com.co\r\n";
		mail('comercial@gzgg.com.co',$asunto,$cuerpo,$headers);
		
		redirectUrl(APPLICATION_URL . 'shop_order_save/'.$_POST['order_id'].'.html');	
	break;
	case 'confirm_credit':
		$order = new Order($_POST['order_id']);
		$order->__set('order_status',4);
		$order->update();
		unset($_SESSION['cart']);
		
		//Envio Mails
		$cuerpo = '<b>Codigo Orden:</b> GZGG-'.$order->__get('order_code').'<br>
				   <b>Fecha:</b>'.$order->__get('order_datetime');
				   
		$headers  = "MIME-Version: 1.0\r\n"; 
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers .= "From: GZGG <info@gzgg.com.co>\r\n";
		$headers .= "Bcc: info@gzgg.com.co\r\n";
		$asunto   = 'Credito Gzgg - '.$order->__get('order_code');
		
		mail('comercial@gzgg.com.co',$asunto,$cuerpo,$headers);
		
		redirectUrl(APPLICATION_URL . 'shop_order_save/'.$_POST['order_id'].'.html');
	break;
endswitch;
?>