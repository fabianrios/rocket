function parseAlert(type, data){
	var message ="";
	for(i = 0; i < data.length; i++) {
		message += data[i] + '\r\n';
	}
	switch(type){
		case 1:
		alert(message);
		break;
	}
}
function changePaymentValue (resp) {
	$( ".payment-amount" ).val( "$" + addCommas(parseInt(resp)));
}
$(function () {
	if($('.more-info').length > 0)
	{
		$('.more-info').click(function (event) {
			event.preventDefault();
			$(this).next().fadeIn();
		});
		$('.close-icon').click(function (event) {
			event.preventDefault();
			$(this).parent().fadeOut();
		});
	}
});
