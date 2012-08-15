$(function () {
	$('.goal-toltip').hide();
	$('.goal').each(function (index) {
		$($(this).children()[1]).click(function () {
			$('.goal-toltip').fadeOut();
			$($(this).prev()).fadeIn();
		});
	});
	$('.year-select').each(function(index) {
		setMonths($(this));
	});
	$('.year-select').unbind('change');
	$('.year-select').change(function (event) {
		setMonths($(this));
	});
	$('.close-goal-tooltip').click(function (event) {
		event.preventDefault();
		$(this).parent().parent().parent().parent().parent().fadeOut();
	});
	$('.save-goal').click(function (event) {
		event.preventDefault();
		$(this).parent().parent().parent().fadeOut();
		var year 		= $('#year-' + $(this).attr('rel')).val();
		var month		= parseInt($('#month-' + $(this).attr('rel')).val() - 1);
		var ts 			= Math.round((new Date(year, month, 01)).getTime() / 1000);
		if($('#'+ts).length == 0)
		{
			var newBlock 	= $('#prime-goal-block').clone();
			newBlock.attr('id', ts);
			newBlock.addClass(ts);
			$('<table class="date-tooltip round-1"><tr><td class="whitetxt"><span class="whitetxt" aria-hidden="true" data-icon="&#x73;"></span><strong>' + returnMonth(month) + '</strong> ' + year + '</td></tr></table>').appendTo($(newBlock.children()[0]));
					
		}
		else
		{
			var newBlock	= $($('#'+ts)[0]);
		}
		var newItem = $('#prime-goal-item').clone();

		if($('#'+"item-"+$(this).parent().parent().parent().parent().attr("id")).length > 0)
		{
			
			/*if($('#'+"item-"+$(this).parent().parent().parent().parent().attr("id")).parent().children().length == 1)
			{
				$('#'+"item-"+$(this).parent().parent().parent().parent().attr("id")).parent().parent().remove();
			}
			else*/
				$('#'+"item-"+$(this).parent().parent().parent().parent().attr("id")).remove();
		}

		newItem.attr("id", "item-"+$(this).parent().parent().parent().parent().attr("id"))
		newItem.addClass($(this).parent().parent().parent().parent().attr("id"));
		
		var imgSrcLength 	= $($(this).parent().parent().parent().next().children()[0]).attr('src').split('/').length;
		var imgName			= $($(this).parent().parent().parent().next().children()[0]).attr('src').split('/')[(imgSrcLength - 1)];
		$(newItem.children()[1]).attr('src', $(newItem.children()[1]).attr('src') + imgName);
		$(newItem.children()[1]).click(function (event) {
			event.preventDefault();
			$(this).prev().fadeIn();
			$('.delete-item').unbind('click');
			$('.delete-item').click(function (event) {
				event.preventDefault();
				if($(this).parent().parent().parent().parent().parent().parent().children().length == 1)
				{
					if($(this).attr("id") != 'prime-goal-block')
						$(this).parent().parent().parent().parent().parent().parent().parent().remove();
				}
				else
				{
					$(this).parent().parent().parent().parent().parent().remove();
				}
				$('.user_goal_info').remove();
				$('.goal-16-small').each(function (index) {
					if($(this).attr("id") != 'prime-goal-item')
					{
						date 		= new Date(ts * 1000);
						firstDate	= new Date()
						$('<input type="hidden" class="user_goal_info" value="' + $(this).attr("id").replace('item-goal-', '') + '" name="user_goal_' + number + '" />').appendTo($('#diagnostics_form'));
						$('<input type="hidden" class="user_goal_info" value="' + monthDiff(new Date(), date) + '" name="user_goal_term_' + number + '" />').appendTo($('#diagnostics_form'));
						number++;
					}
				});		
				$('.goal-block').height(600 / ($('.TimeLine-bar').children().length - 2));		
	
			});
		})
		$($($($(newItem.children()[1]).prev().children()[0]).children()[0]).children()[4]).attr('rel', $(this).attr('rel'));
		 
		$($($($(newItem.children()[1]).prev().children()[0]).children()[0]).children()[4]).click(function (event) {
			event.preventDefault();
			
			$('#year-' + $(this).attr('rel')).val($(this).parent().find('select.year').val());
			$('#month-' + $(this).attr('rel')).val($(this).parent().find('select.month').val());
			$('.save-goal[rel="'+$(this).attr('rel')+'"]').trigger('click');	
		});
		newItem.appendTo($(newBlock.children()[1])).show();
		if($('.TimeLine-bar').children().length > 2)
		{
			var appended = false;
			
			$('.TimeLine-bar').children().each(function (index) {
				if(ts > parseInt($(this).attr("id")))
				{
					if(!appended)
					{
						newBlock.insertBefore($(this)).show();
						appended = true;
					}
				}		
			});
			if(!appended && (ts < parseInt($($('.TimeLine-bar').children()[($('.TimeLine-bar').children().length - 1)]).attr("id"))))
			{
					newBlock.insertAfter($($('.TimeLine-bar').children()[($('.TimeLine-bar').children().length - 1)])).show();
					appended = true;			
			}	
			
		}
		else
			newBlock.appendTo($('.TimeLine-bar')).show();	
		$('.goal-block').each(function (index) {
			if($($(this).children()[1]).children().length == 0)
			{
				if($(this).attr("id") != 'prime-goal-block')
					$(this).remove();
			}
		})
		$('.goal-block').height(600 / ($('.TimeLine-bar').children().length - 2));
		
		$('.close-goal-tooltip').unbind('click');
		$('.close-goal-tooltip').click(function (event) {
			event.preventDefault();
			$(this).parent().parent().parent().parent().parent().hide();
		});
		number = 1;
		$('.user_goal_info').remove();
		$('.goal-16-small').each(function (index) {
			if($(this).attr("id") != 'prime-goal-item')
			{
				date 		= new Date(ts * 1000);
				firstDate	= new Date()
				$('<input type="hidden" class="user_goal_info" value="' + $(this).attr("id").replace('item-goal-', '') + '" name="user_goal_' + number + '" id="user_goal_' + number + '" />').appendTo($('#diagnostics_form'));
				$('<input type="hidden" class="user_goal_info" value="' + monthDiff(new Date(), date) + '" name="user_goal_term_' + number + '" id="user_goal_term_' + number + '" />').appendTo($('#diagnostics_form'));
				number++;
			}
		});
		/*if($('#user_goal_1').val() == newItem.attr("id").replace('goal_', ''))
		{
			date = new Date(ts);
			$('#user_goal_1_term').val(returnMonth(new Date(), date));
		}
		else
		{
			$('#user_goal_1').val(newItem.attr("id").replace('item-goal-', ''));
			date 		= new Date(ts * 1000);
			firstDate	= new Date()
			$('#user_goal_1_term').val(monthDiff(firstDate, date));
		}*/
		$('.year-select').each(function(index) {
			setMonths($(this));
		});
		$('.year-select').unbind('change');
		$('.year-select').change(function (event) {
			setMonths($(this));
		});
	});
});

function setMonths(element) {

	var monthSelect = $('#month-' + element.attr("id").split('-')[1]);
	var months		= calculateMonths(element.val());
	$(monthSelect).find('option').remove();
	for(i = 0; i <= 11; i++)
	{
		if(typeof months[i] != 'undefined')
		{
			if(i < 0)
				value = '0' + (i + 1).toString();
			else
				value = (i + 1).toString();
			$(monthSelect).append('<option value="' + value + '">' + returnMonth(i) + '</option>');
		}
	}
}

function returnMonth(monthNum) {
	var monthNames = [ "ENE", "FEB", "MAR", "ABR", "MAY", "JUN",
    "JUL", "AGO", "SEP", "OCT", "NOV", "DIC" ];
    return monthNames[monthNum];
}

function monthDiff(d1, d2) {
    var months;
    months = (d2.getFullYear() - d1.getFullYear()) * 12;
    months -= d1.getMonth() + 1;
    months += d2.getMonth();
    return months;
}

function calculateMonths(year) {
	var date 	= new Date();
	var months	= Array();
	if(date.getFullYear() == year)
	{
		var month 	= (date.getMonth() + 1);
		if(month > 11)
			month = 0;
	}
	else
	{
		var month 	= 0;
	}
	for(i = month; i <= 11; i++)
	{
		months[i] = returnMonth(i);
	}	
	
	return months
} 

