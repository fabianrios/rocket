var totalPresicionWeight 	= 0;
var registeredQuestions		= new Array();
$(function () {
	totalPresicionWeight 			+= parseInt($('#answered_questions_weight').val());
	$('.precision-data').each(function (index) {
		var fieldId = $(this).attr('id').split('-')[0];
		$('#'+fieldId).change(function () {
			if(($(this).val() != '') && ($(this).val() != '0') && ($(this).val() != '$0') && ($(this).val() != 'NULL') && ($(this).val() != '0 meses'))
			{
				if((typeof registeredQuestions[$(this).attr('name')] == "undefined") && (typeof registeredQuestions[$(this).attr('rel')] == "undefined"))
				{
					if(typeof $(this).attr('rel') != 'undefined')
						registeredQuestions[$(this).attr('rel')] = $(this).val();
					else
						registeredQuestions[$(this).attr('name')] = $(this).val();
					totalPresicionWeight += parseInt($('#' + $(this).attr("id") + '-weight').val()); 
					calculatePercentage();
				}
			}
			else
			{
				if(typeof registeredQuestions[$(this).attr('name')] != "undefined")
				{
					delete registeredQuestions[$(this).attr('name')];
					delete registeredQuestions[$(this).attr('rel')];
					totalPresicionWeight -= parseInt($('#' + $(this).attr("id") + '-weight').val()); 
					calculatePercentage();
				}
			}
		});
	});
	calculatePercentage();
});
function calculatePercentage() {
	var questionsWeight		= $('#total_questions_weight').val();	
	var percentage 			= (totalPresicionWeight / questionsWeight) * 100;
	$('#answered_questions_weight').val(totalPresicionWeight);
	var percentaje = Math.round(percentage);
	if(percentaje > 100)
		percentaje = 100;
	$('.giant').html(percentaje + '<span class="percentage">%</span>');
}
