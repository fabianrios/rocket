// JavaScript Document
$(document).ready(function () {
						
	
	$('.less-than').click(function (event) {
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
		calculateBar(relValue);
		object.trigger('change');
	});
	$('.more-than').click(function (event) {
		event.preventDefault();	
		object	= $($(this).parent().prev().children()[0]);
		object.val(object.val().replace(/\./g,''));		
		a		= object.val();
		a		= a.replace(/\./g,'');
		if (a == '')
			a 	= parseInt(0);
		object.val(addCommas(parseInt(a)+50000));	
		relValue	= object.attr('rel');
		calculateBar(relValue);
		object.trigger('change');
	});	
	
	$('.mt2').click(function (event) {
		event.preventDefault();							
		object	= $($(this).parent().prev().children()[0]);
		a		= object.val();
		if (a == '')
			a 	= parseInt(0);
		object.val(addCommas(parseInt(a)+1));	
		object.trigger('change');
	});
	$('.lt2').click(function (event) {
		event.preventDefault();																
		object	= $($(this).parent().next().children()[0]);
		a		= object.val();
		if (a == '')
			a 	= parseInt(0);
		object.val(addCommas(parseInt(a)-1));	
		object.trigger('change');
	});		
	
	$('.finanzas-input').change(function (event) 
	{
		calculateBar($(this).attr('rel'));	
		if ( (parseInt($(this).val()) < 0) || (isNaN(parseInt($(this).val()))))
			$(this).val(0);
		else
			$(this).val(parseInt($(this).val().replace(/\./g,''),10));
		$(this).val(addCommas($(this).val()));							  		
	});									  
									 

});

function calculateBar(barname)
{
	total	= 0;
	vals	= new Array();
	$('input[rel="'+barname+'"]').each(function (index) {
		if ( (parseInt($(this).val()) == '') || (isNaN(parseInt($(this).val()))))
			$(this).val(0)
		value		=  $(this).val();
		value		= parseInt(value.replace(/\./g,''),10);
		total		+= parseInt(value);
		vals[index]	= parseInt(value);
	 });
	
	$('.'+barname+'text').html("<span class='small greytxt'>Total:</span><strong> $"+addCommas(total)+"</strong>");
	
	if (total > 0)
	{
		$('.'+barname).children().each(function (index) {
			temp	= vals[index]/total*100;
			$(this).css('width',temp+'%')										 
			$(this).html(Math.round(temp)+'%');
		 });
	}
	calculateAP();
	calculateIG();
}

function calculateAP()
{
	total	= 0;
	$('input[rel="bar1"]').each(function (index) {
		if ( (parseInt($(this).val()) == '') || (isNaN(parseInt($(this).val()))))
			$(this).val(0)
		value		=  $(this).val();
		value		= parseInt(value.replace(/\./g,''),10);
		total		+= parseInt(value);
	 });
	if ($('.activolbl').length > 0)
		$($('.activolbl')[0]).html('$'+addCommas(total)); 
	total1	= 0;
	$('input[rel="bar2"]').each(function (index) {
		if ( (parseInt($(this).val()) == '') || (isNaN(parseInt($(this).val()))))
			$(this).val(0)
		value		=  $(this).val();
		value		= parseInt(value.replace(/\./g,''),10);
		total1		+= parseInt(value);
	 });
	if ($('.pasivo').length > 0)
		$($('.pasivo')[0]).html('$'+addCommas(total1)); 
	if ($('.patrimonio').length > 0)
		$($('.patrimonio')[0]).html('$'+addCommas(total - total1)); 
	totalap = ((parseInt(total) - parseInt(total1))/parseInt(total)) * 100;
	if ($('.mensaje-ap').length > 0)
	{
		if ((total - total1) >= 0) 
			$($('.mensaje-ap')[0]).html("Eres due&ntilde;o de " + Math.round(totalap) + "% de todo lo que tienes, es decir tu patrimonio es de $"+addCommas(total - total1)); 
		else
			$($('.mensaje-ap')[0]).html("Con los datos que nos diste, aparentemente debes m&aacute;s de lo que tienes."); 
		
	}
}

function calculateIG()
{
	total	= 0;
	$('input[rel="bar3"]').each(function (index) {
		if ( (parseInt($(this).val()) == '') || (isNaN(parseInt($(this).val()))))
			$(this).val(0)
		value		=  $(this).val();
		value		= parseInt(value.replace(/\./g,''),10);
		total		+= parseInt(value);
	 });
	if ($('.ingreso').length > 0)
		$($('.ingreso')[0]).html('$'+addCommas(total)); 
	total1	= 0;
	$('input[rel="bar4"]').each(function (index) {
		if ( (parseInt($(this).val()) == '') || (isNaN(parseInt($(this).val()))))
			$(this).val(0)
		value		=  $(this).val();
		value		= parseInt(value.replace(/\./g,''),10);
		total1		+= parseInt(value);
	 });
	$('input[rel="bar5"]').each(function (index) {
		if ( (parseInt($(this).val()) == '') || (isNaN(parseInt($(this).val()))))
			$(this).val(0)
		value		=  $(this).val();
		value		= parseInt(value.replace(/\./g,''),10);
		total1		+= parseInt(value);
	 });	
	if ($('.gasto').length > 0)
		$($('.gasto')[0]).html('$'+addCommas(total1)); 
	if ($('.resultado').length > 0)
		$($('.resultado')[0]).html('$'+addCommas(total - total1)); 		
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