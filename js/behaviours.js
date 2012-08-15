/* comportamientos de animacion del menu principal*/
$(document).ready(function(){


	  $('.info_puntos').animate({'width': 0}, 10, 'easeOutExpo');
      $('.info_puntos > *').animate({'opacity': 0}, 10, 'easeOutExpo'); 


     $('.main_nav li a').append('<span class="hover"></span>');      
     $('.main_nav li a').hover(function() {
	
		// Stuff that happens when you hover on + the stop()
		$('.hover', this).stop().animate({'opacity': 1}, 700, 'easeOutSine')
	
	},function() {
	
		// Stuff that happens when you unhover + the stop()
		$('.hover', this).stop().animate({'opacity': 0}, 500, 'easeOutExpo')
	})


    $(".close_btn").click(function () { 
      $(".welcome_box").slideUp(); 
    });

 $(".close_btn_puntos").click(function () {      
 	  $('.info_puntos').stop().animate({'width': 0}, 500, 'easeOutExpo');
      $('.info_puntos > *').stop().animate({'opacity': 0}, 400, 'easeOutExpo'); 
    });




/*ANIMACION DE LA CAJA DE PUNTOS*/
     $('.boton_puntos').hover(function() {
	
		// Stuff that happens when you hover on + the stop()
		$('.info_puntos').stop().animate({'width': 273}, 700, 'easeOutSine');
		$('.info_puntos > *').animate({'opacity': 1}, 400, 'easeOutExpo'); 
		$('.info_puntos').animate({'opacity': 1}, 400, 'easeOutExpo');

	
	},function() {
	
		// Stuff that happens when you unhover + the stop()
	//	$('.info_puntos').stop().animate({'width': 0}, 500, 'easeOutExpo')
	})



 $('.game_stage .sub_nav li a').append('<span class="hover"></span>');      
     $('.game_stage .sub_nav li a').hover(function() {
	
		// Stuff that happens when you hover on + the stop()
		$('.hover', this).stop().animate({'opacity': 1}, 700, 'easeOutSine')

	
	},function() {
	
		// Stuff that happens when you unhover + the stop()
		$('.hover', this).stop().animate({'opacity': 0}, 500, 'easeOutExpo')
	})



});
