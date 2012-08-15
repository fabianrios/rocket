<div class="ten columns centered">											
	<div class="row">
		<label>&iquest;Meses?</label>
			<div class="ten columns centered">
			<div class="slider slider-time"></div>
				<label for="amount" class="cantidad text-center"><input type="text" class="amount time-amount" name="usuario_cantidad_meses_pagar" /></label>
			</div>  
		</div>
</div>
</div>
<div class="row">
									<div class="ten columns centered">											
	<div class="row">
		<label>&iquest;Cuota?</label>
			<div class="ten columns centered">
			<div class="slider slider-payment"></div>
				<label for="amount" class="cantidad text-center">$<input type="text" name="usuario_cantidad_quiere_pagar" class="amount payment-amount" /></label>
			</div>  
		</div>
</div>
<script type="text/javascript">
$('#usuario_cuota_inicial').change( function () {
var value = ((500000 - $('#usuario_cuota_inicial').val()) - $('#usuario_asciende_valor_necesidad').val());

var quoteValue = value / 36;

			$(function() {
		$( ".slider-time" ).slider({
			range: "min",
			value: 36,
			min: 12,
			max: 72,
			slide: function( event, ui ) {
				$( ".time-amount" ).val( ui.value );
				$( ".payment-amount" ).val( (Math.round((value/ui.value) * 1.13)));
				$( ".slider-payment" ).slider( "option" , "value" , Math.round(value/ui.value) )
			}
		});
		$( ".time-amount" ).val( $( ".slider-time" ).slider( "value" ) );
		$( ".slider-payment" ).slider({
			range: "min",
			value: quoteValue,
			min: 100000,
			max: 2000000,
			slide: function( event, ui ) {
				$( ".payment-amount" ).val( Math.round((ui.value * 1.13)));
				$( ".time-amount" ).val( Math.round(value/ui.value) );
				$( ".slider-time" ).slider( "option" , "value" , Math.round(value/ui.value) )
			}
		});
		$( ".payment-amount" ).val( (Math.round((($( ".slider-payment" ).slider( "value" ) * 1.13)))));		
	});	
});
$('#usuario_asciende_valor_necesidad').change( function () {
var value = ((500000 - $('#usuario_cuota_inicial').value) - $('#usuario_asciende_valor_necesidad').value);
var quoteValue = value / 36;
			$(function() {
		$( ".slider-time" ).slider({
			range: "min",
			value: 36,
			min: 12,
			max: 72,
			slide: function( event, ui ) {
				$( ".time-amount" ).val( ui.value );
				$( ".payment-amount" ).val( (Math.round((value/ui.value) * 1.13)));
				$( ".slider-payment" ).slider( "option" , "value" , Math.round(value/ui.value) )
			}
		});
		$( ".time-amount" ).val( $( ".slider-time" ).slider( "value" ) );
		$( ".slider-payment" ).slider({
			range: "min",
			value: quoteValue,
			min: 100000,
			max: 2000000,
			slide: function( event, ui ) {
				$( ".payment-amount" ).val( Math.round((ui.value * 1.13)));
				$( ".time-amount" ).val( Math.round(value/ui.value) );
				$( ".slider-time" ).slider( "option" , "value" , Math.round(value/ui.value) )
			}
		});
		$( ".payment-amount" ).val( (Math.round((($( ".slider-payment" ).slider( "value" ) * 1.13)))));		
	});	
});
	</script>	