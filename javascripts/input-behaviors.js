/*function addCommas(str) {
    var amount = new String(str);
    amount = amount.split("").reverse();

    var output = "";
    for ( var i = 0; i <= amount.length-1; i++ ){
        output = amount[i] + output;
        if ((i+1) % 3 == 0 && (amount.length-1) !== i)output = '.' + output;
    }
    return output;
}
function createSlider(inputName, min, max, userId, productId, orderId) {
	var startInt = min;
	var step 	 = Math.ceil((max/200));
		$( "#slider"+inputName ).slider({
			value:startInt,
			min: min,
			max: max,
			step: step,
			slide: function( event, ui ) {
				$( "#"+inputName ).val( addCommas(ui.value) );
			},
			change: function ( event, ui ) {
				SimpleAJAXCall(ApplicationUrl + 'index.php?question.controller/' + productId + '/' + userId + '/' + orderId + '/' + ui.value, loadQuestion, 'GET', 'question_form'+inputName );
			}
		});
		$( "#"+inputName ).val( addCommas($( "#slider"+inputName ).slider( "value" )) );
}
function observeRadio(inputName, min, max, userId, productId, orderId) {
	$('input[name=' + inputName + ']').change(function () {
		var checkedValue = $('input[name=' + inputName + ']:checked').val()
		SimpleAJAXCall(ApplicationUrl + 'index.php?question.controller/' + productId + '/' + userId + '/' + orderId + '/' + checkedValue, loadQuestion, 'GET', 'question_form'+inputName );
	});
}
function observeSelect(inputName, min, max, userId, productId, orderId) {
	$('select[name=' + inputName + ']').change(function () {
		var selectedValue = $('select[name=' + inputName + ']').val()
		SimpleAJAXCall(ApplicationUrl + 'index.php?question.controller/' + productId + '/' + userId + '/' + orderId + '/' + selectedValue, loadQuestion, 'GET', 'question_form'+inputName );
	});
}
function observeTextBox(inputName, min, max, userId, productId, orderId) {
	$('input[name=' + inputName + ']').click(function () {
		$(this).val('');
	});
	$('input[name=' + inputName + ']').change(function () {
		var value = encodeURIComponent($(this).val()).replace(/\%20/g, '+');
		SimpleAJAXCall(ApplicationUrl + 'index.php?question.controller/' + productId + '/' + userId + '/' + orderId + '/' + value, loadQuestion, 'GET', 'question_form'+inputName );
	});
}
function loadQuestion(response, elementId) {
	var splitResponse = response.split('|||');
	if(splitResponse.length > 1) {
		response = splitResponse[7];
		document.getElementById(elementId).innerHTML = response;
		switch(splitResponse[6]){
			case 'slider':
				createSlider($.trim(splitResponse[2]), parseInt($.trim(splitResponse[0])), parseInt($.trim(splitResponse[1])), $.trim(splitResponse[3]), $.trim(splitResponse[4]), $.trim(splitResponse[5]));
				break;
			case 'radio':
				observeRadio($.trim(splitResponse[2]), parseInt($.trim(splitResponse[0])), parseInt($.trim(splitResponse[1])), $.trim(splitResponse[3]), $.trim(splitResponse[4]), $.trim(splitResponse[5]));				
				break;
			case 'text':
				observeTextBox($.trim(splitResponse[2]), parseInt($.trim(splitResponse[0])), parseInt($.trim(splitResponse[1])), $.trim(splitResponse[3]), $.trim(splitResponse[4]), $.trim(splitResponse[5]));				
				break;
			case 'select':
				observeSelect($.trim(splitResponse[2]), parseInt($.trim(splitResponse[0])), parseInt($.trim(splitResponse[1])), $.trim(splitResponse[3]), $.trim(splitResponse[4]), $.trim(splitResponse[5]));				
				break;
		}
		
	}
	else {
		$('.last-step').css('display', '');
	}
}*/
   // This function is called by jQuery once the page has finished loading.
   var myGauge = new jGauge(); // Create a new jGauge.
   myGauge.id = 'jGaugeDemo'; // Link the new jGauge to the placeholder DIV.
   myGauge.ticks.count = 5;
   myGauge.ticks.end = 100;
   myGauge.ticks.labelColor = 'rgba(255, 255, 255, 0.5)';
   myGauge.range.start = -175;
   myGauge.range.end = -130;
   myGauge.label.color = '#e5ad04';
   myGauge.label.suffix = '%';
   myGauge.height = 140;
   myGauge.segmentStart = -175;
   myGauge.segmentEnd = -10;
   myGauge.range.radius = 40;
   myGauge.ticks.labelRadius = 54;
   //myGauge.needle.yOffset = 10;
   // This function is called by jQuery once the page has finished loading.
   $(document).ready(function(){
      myGauge.init(); // Put the jGauge on the page by initialising it.
      myGauge.setValue(0);
      
   });
Object.size = function(obj) {
    var size = 0, key;
    for (key in obj) {
        if (obj.hasOwnProperty(key)) size++;
    }
    return size;
};
var answeredInputs = new Object();
$(document).ready(function(){ 
	$('.userdata').each( function (index) {
		switch($('.userdata')[index].tagName) {
			case 'DIV':
				$(this).click(function () {
					answeredInputs[this.name] = this.name;
					recordAnswered($(this));
				});
				break;
			default:
				switch($(this).attr('type')){
	
					default:
						$(this).change(function () {
							answeredInputs[this.name] = this.name;
							recordAnswered($(this));
						});
						break;
				}
				break;
		}		

	});
});
function recordAnswered() {
	$('#question_num').html(Object.size(answeredInputs));
	inputQuantity = $('.userdata').length;
	if(Object.size(answeredInputs) > (inputQuantity / 2))
	{
		$('#submit_button').show();
	}
	var answeredPercentaje = (Object.size(answeredInputs) / inputQuantity) * 100;
	//console.log(answeredPercentaje.toFixed(2));
	myGauge.setValue(answeredPercentaje.toFixed(2));	
}
