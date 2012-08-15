<script language="JavaScript" src="<?php echo APPLICATION_URL?>js/ajax_lib.js" ></script>
<script language="JavaScript" src="<?php echo APPLICATION_URL?>js/ajax_helper.js" ></script>
<script language="JavaScript" src="<?php echo APPLICATION_URL?>js/form_parser_helper.js" ></script>
<script language="JavaScript" src="<?php echo APPLICATION_URL?>js/helpers.js" ></script>
<?php
$order = new Order($this->orderId);
$validable = ($order->__get('order_skip') == '0') ? "validable" : "notValidable"; 
?>
<div class="ten columns centered">
    <div class="slider-time"></div>
    <table class="blank-table">
        <tr>
            <td><label for="amount" class="cantidad-inline text-center"><input type="text" name="cuotas" class="amount time-amount" /></label></td>
            <td>=</td>
            <td id="payment_value"><label for="amount" class="cantidad-inline text-center"><input type="text" name="costo" class="amount payment-amount" value="" /></label></td>
        
        </tr>
    
    </table>    
    <input class="precision-data <?php echo $validable?>" type="hidden" id="cuotas-weight" name="cuotas-weight" value="<?php echo $order->__get('order_peso')?>">
</div>
<script type="text/javascript">
function addCommas(nStr) {
    nStr += '';
    var x = nStr.split(',');
    var x1 = x[0];
    var x2 = x.length > 1 ? ',' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + '.' + '$2');
    }
    return x1 + x2;
	
}

	var value = $(".usuario_prestamo").val();
			$(function() {
		//$(".payment-amount").val( "$" + addCommas(parseInt(0)));
		$( ".slider-time" ).slider({
			range: "min",
			value: 36,
			min: 6,
			max: 72,
			slide: function( event, ui ) {
				$( ".time-amount" ).val( ui.value + " meses" );
			},
			change: function ( event, ui ) 
			{
				val = $("#usuario_prestamo").val();
				if ($("#usuario_cuota_inicial").length > 0)
					cuota = $("#usuario_cuota_inicial").val();
				else
					cuota = 0;		
				SimpleAJAXCall('<?php echo APPLICATION_URL?>credit_payment.controller/update_payment_value2/' + val +'/' + cuota +'/' + ui.value + '.html', changePaymentValue, 'GET', '');
			},			
			stop: function ( event, ui ) {
				$( "#cuotas" ).trigger('change');
			}
		});
		$( ".time-amount" ).val( $( ".slider-time" ).slider( "value" ) + " meses" );
	});
</script>    