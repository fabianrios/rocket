// JavaScript Document
$(document).ready(function () {

	$('.icon_add').click(function (event) {
		event.preventDefault();		
		object	= $($($($($(this).next().children()[0]).children()[0]).children()[1]).children()[0]);
		if (object.val() == 0)
			object.val(1);
		else 
		{
			var val	= parseInt(object.val())+1;
			object.val(val);		
		}
	});
	
	$('.more-than').click(function (event) {
		event.preventDefault();							
		object	= $($(this).parent().prev().children()[0]);
		a		= object.val();
		a		= a.replace(/\./g,'');
		if (a == '')
			a 	= parseInt(0);
		object.val(parseInt(a)+1);	
		relValue	= object.attr('rel');
		//calculateBar(relValue);
	});
	$('.less-than').click(function (event) {
		event.preventDefault();																
		object	= $($(this).parent().next().children()[0]);
		a		= object.val();
		a		= a.replace(/\./g,'');
		if (a == '')
			a 	= parseInt(0);
		if (a > 0)
		object.val(parseInt(a)-1);	
		relValue	= object.attr('rel');
		//calculateBar(relValue);
	});	
		
	$('.blank-input').change(function (event) {
		$(this).val($(this).val());							  		
	});									  
									 

});

