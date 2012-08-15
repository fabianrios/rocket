
$(document).ready( function () {
	$('.envelope_opener').each(function (index) {
		$(this).click(function (event) {
			event.preventDefault();
			$('.expand-box[id!="editenvelope-'+ $(this).attr("id").split('-')[1] + '"]').each(function (index) {
				if($(this).css('display') == 'block') {
					$('#pointer-' + $(this).attr("id").split('-')[1]).toggle('1000');
					$(this).animate({
						height: 'toggle'
				    }, 1000, function() {
				    });
				}
			});
			
			if( $("div:animated").length == 0 ) {
				$('#pointer-' + $(this).attr("id").split('-')[1]).toggle('1000');
				$('#editenvelope-' + $(this).attr("id").split('-')[1]).animate({
					height: 'toggle'
				  }, 1000, function() {
				    // Animation complete.
				  });
			}
			else
			{
				$('#pointer-' + $(this).attr("id").split('-')[1]).delay(1000).toggle('1000');
				$('#editenvelope-' + $(this).attr("id").split('-')[1]).delay(1000).animate({
					height: 'toggle'
				  }, 1000, function() {
				    // Animation complete.
				  });				
			}

		});
	});
	$('.priority').each(function (index) {
		$(this).click(function (event) {
			event.preventDefault();
			$(this).siblings().removeClass('selected');
			$(this).addClass('selected');
			$(this).parent().next().attr("value", $(this).attr("title"));
		});
	});
	$('.save-envelope').click(function () {
		var envelopeId = $(this).attr("id").split('-')[1];
		valid = true;
		$('.active-item-'+envelopeId+':checked').each(function (index) {
			envelopeItemId = $(this).attr('rel');
			if($('#envelope_item_name_'+envelopeItemId).val() == '')
			{
				valid = false;
			}
			if($('#envelope_item_value_'+envelopeItemId).val() == '0')
			{
				valid = false;
			}
			if($('#envelope_item_payday_'+envelopeItemId).val() == '')
			{
				valid = false;
			}
			
		});
		if($('#user_envelope_priority_'+envelopeId).val() == '0') 
		{
			valid = false;
		}
		if($('#user_envelope_budget_'+envelopeId).val() == '0') 
		{
			valid = false;
		}
		
		if(!valid) {
			alert('Por favor llene todos los campos de los items escogidos.');
			return false;
		}
		else
		{
			displayEnvelopeLoading(envelopeId);
			FormParseAJAXCall('index.php?envelopes.controller', envelopeSaved, 'POST', envelopeId, $('#envelope-form-'+envelopeId).get(0));
			FormParseAJAXCall('index.php?envelopes.controller', doNothing, 'POST', envelopeId, $('#expenses-form-'+envelopeId).get(0));
		}
	
	});
	$('.add-expense').click(function (event) {
		event.preventDefault();
		$('#add-expense').animate({
			height: 'toggle'
		  }, 1000, function() {
		    // Animation complete.
		  });	
	});
	$('.graph_button').click(function (event) {
		event.preventDefault();
		$('.budget-chart').hide();
		$('.graph_button.selected').toggleClass('selected');
		$('#chart_div_' + $(this).attr("rel")).show();
		$(this).toggleClass('selected');	
		
	});
	if($(".calendar-input").length > 0)
	{
		$(".calendar-input").datepicker({					
			dateFormat: "d" 		
		});
	}
	if($(".calendar-input2").length > 0)
	{
		$(".calendar-input2").datepicker({					
			dateFormat: "dd-mm-yy" 		
		});
	}
	$(".income-value").blur(function () {
		var sum = 0;
		$(".income-value").each (function () {
			sum += Number($(this).val().replace(/\./g,'')) * (30 / parseInt($(this).parent().prev().children()[1].value));
		});
	
		$(this).val(addCommas($(this).val()));
		$("#income-total").html('$ ' + $.formatNumber(sum, {format:"###'###,###", locale:"es"}));
	});
	$("#envelope_id").change(function () {
		SimpleAJAXCall(ApplicationUrl + 'envelope_category.controller/load_categories/' + $(this).val() + '.html', ElementStateChanged, 'GET', 'category_select');
	});
	$(".agregar-sobre").click(function (event) {
		event.preventDefault();
		$('.add-expense-div').fadeIn();
	});
	$('.add-expense-close-icon').click(function () {
		event.preventDefault();
		$('.add-expense-div').fadeOut();
	});
	setExpensesBehaviors();
});
function envelopeSaved(resp, envelopeId) {
	$('#budget-' + envelopeId).html(resp);
	$('#budget-' + envelopeId).show(1000);
	$('#check-' + envelopeId).show(1000);
	$('#envelopecontainer-' + envelopeId).addClass('sobre-active');
	$('#loading-' + envelopeId).hide();
	$('#pointer-' + envelopeId).toggle('1000');
	$('#editenvelope-' + envelopeId).animate({
		height: 'toggle'
	  }, 1000, function() {
	    // Animation complete.
	});
	
}
function displayEnvelopeLoading(envelopeId) {
	$('#loading-' + envelopeId).show();
}
function addCommas(nStr) 
{

    nStr += '';
	nStr = nStr.replace(/\./g,''); 
	var x = nStr.split(',');
    var x1 = x[0];
    var x2 = x.length > 1 ? ',' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) 
	{
        x1 = x1.replace(rgx, '$1' + '.' + '$2');
    }
    return x1 + x2;
}
function expenseCreated (response, objectId) {
	$('#' + objectId).html(response);
	setExpensesBehaviors();
}
function setExpensesBehaviors() {
	$( ".date" ).datepicker({ dateFormat: "dd-mm-yy" });
	$('.submit-expense-form').click(function(event) {
		event.preventDefault();
		FormParseAJAXCall('index.php?expense.controller', expenseCreated, 'POST', 'expenses-' + this.rel, 		$('#expense-form-'+this.rel).get(0));
	});
	$('.create-expense').click(function (event) {
		event.preventDefault();
		//$(this).parent().hide();
		$(this).parent().prev().children('div:last-child').show();
	})	
	$('.plus').click(function (event) {
		event.preventDefault();							
		object	= $($(this).parent().prev().children()[0]);
		object.val(object.val().replace(/\./g,''));		
		a		= object.val();
		a		= a.replace(/\./g,'');
		if (a == '')
			a 	= parseInt(0);
		object.val(addCommas(parseInt(a)+50000));	
		relValue	= object.attr('rel');
		//calculateBar(relValue);
		//object.trigger('change');
	});
	$('.minus').click(function (event) {
		event.preventDefault();	
		object	= $($(this).parent().next().children()[0]);
		object.val(object.val().replace(/\./g,''));		
		a		= object.val();
		a		= a.replace(/\./g,'');
		if (a == '')
			a 	= parseInt(0);
		if (a >= 50000)
			object.val(addCommas(parseInt(a)-50000));	
		relValue	= object.attr('rel');
		//calculateBar(relValue);
		//object.trigger('change');
	});	
	$('.save-checkbox').click(function (event) {
		if($(this).prop("checked"))
		{
			$('#save-div-'+$(this).attr('rel')).fadeIn();
		}
	})
	$('.save-save-days').click(function (event) {
		event.preventDefault();
		$(this).parent().parent().parent().fadeOut();
	});
	$('.periodicity').each(function (index) {
		$(this).click(function (event) {
			event.preventDefault();
			$(this).siblings().removeClass('active-cal');
			$(this).addClass('active-cal');
			$(this).parent().next().attr("value", $(this).attr("title"));
			if(parseInt($(this).attr('title')) > 30)
			{
					$('#save-div-'+$(this).attr('rel')).fadeIn();
			}
			else
			{
					$('#save-div-'+$(this).attr('rel')).fadeOut();
			
			}
			$(".income-value").trigger('blur');
		});
	});
	$('.combine-expenses').click(function (event) {
		event.preventDefault();
		$('#combine-expense-' + $(this).attr('rel')).fadeIn();
	});
	$('.envelope-input').each(function () {
		value 	= $(this).val();
		value	= value.replace(/\./g,'');
		$(this).val(addCommas(value));
	});
	$('.envelope-input').change(function (event) {
		value 	= parseInt($(this).val());
		value	= value.replace(/\./g,'');
		$(this).val(addCommas(value));
	});
}
