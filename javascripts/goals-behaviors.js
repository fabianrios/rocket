$(document).ready( function () {
	$('.submit').click(function (event) {
		return validateInputs();
	});
	if($( ".goal" ).length > 0)
	{
		$( ".goal" ).draggable({
			revert: true
		});
	}
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
	if($( ".droppable" ).length > 0)
	{
		$(".droppable").droppable({
			drop: function (event, ui) {
				var id = ui.draggable.attr("id").replace('_appended', '');
	        	$('.goal-input').each(function (index) {
	        		if($(this).val() == id.replace('goal-', ''))
	        		{
	        			$(this).val("");
	        			$("#" + $(this).attr("id") + "_term").val("");
	        		}
	        		
	        	});
				$('#'+ id+'_appended').remove();
				if($('.goal-pos').length < 1)
				{
					$(this).append('<div class="goal-pos" id="' + id + '_appended"><div class="' + id + ' sprite-goals"></div></div>');
					for(i = 1; i < 4; i++)
					{
						if($('#goal_' + i).val() == "")
						{
							$('#goal_' + i).val(id.replace('goal-', ''));
							var term = 1;
							switch($(this).attr("id")) {
								case 'first':
									term = 1;
								break;
								case 'second':
									term = 2;
								break;
								case 'third':
									term = 3;
								break;														
							}
							$('#goal_' + i + '_term').val(term);
							break;
						}
					}
					$( "#" + id + '_appended').draggable({
						revert: function (event, ui) {
				            //overwrite original position
			            	$('.goal-input').each(function (index) {
			            		if($(this).val() == id.replace('goal-', ''))
			            		{
			            			$(this).val("");
			            			$("#" + $(this).attr("id") + "_term").val("");
			            		}
			            		
			            	});
				            $(this).fadeOut('fast', function () {
				            	$(this).remove();
				            });
				            
				            //return boolean
				            return !event;
				        }
					});
				}
			}
		});
	}
});