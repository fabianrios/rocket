<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
	
<meta charset="utf-8" />

	<!-- Set the viewport width to device width for mobile -->
	<meta name="viewport" content="width=device-width" />

	<title>Rocket: Herramientas inteligentes para manejar mejor tu dinero</title>

		<meta name="description" content="SITE DESCRIPTION" />
		<meta name="keywords" content="SITE KEYWORDS" />
		<meta name="copyright" content="SITE COPYRIGHT" />
		<meta name="author" content="Metaphysic"/>
		<meta name="Distribution" content="Global" />
		<meta name="Rating" content="General" />
		<meta name="Robots" content="INDEX,FOLLOW" />
		<meta name="Revisit-after" content="90 Days" />
  
	<!-- Included CSS Files -->
	<link rel="stylesheet" href="<?php echo APPLICATION_URL;?>stylesheets/foundation.css">
	<link rel="stylesheet" href="<?php echo APPLICATION_URL;?>stylesheets/style.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo APPLICATION_URL;?>stylesheets/jquery-ui-1.8.17.custom.css" type="text/css" />
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />

	<script src="<?php echo APPLICATION_URL;?>javascripts/jquery.min.js"></script>
	<script language="JavaScript" src="<?php echo APPLICATION_URL?>javascripts/diagnostics-behaviors.js" ></script>
	<script language="JavaScript" src="<?php echo APPLICATION_URL?>javascripts/global-functions.js" ></script>
	<script src="<?php echo APPLICATION_URL;?>js/jquery.knob-1.1.2.js"></script>	
    <script src="<?php echo APPLICATION_URL;?>js/diagnostico.js"></script>	
	<script language="JavaScript">
		function validateInputs() {
			String.prototype.trim = function(){return this.replace(/^\s\s*/, '').replace(/\s\s*$/, '');};
			dataArray 	= Array();
			var counter = 0;
			var index  	= 0;
			$('.blank-input').each(function (index) {
				if(parseInt($(this).val().trim()) == '')
					$(this).val(0)
				if($(this).val().trim() < 0) {
					dataArray[dataArray.length] = $(this).attr('title') + " no puede ser menor a 0.";
				}
				counter = counter+$(this).val();
			});
			if(counter == 0)
			{
				dataArray[dataArray.length] = "Debe haber al menos una persona en el hogar.";
			}
			if(($(".knob1").val() == 0) || ($(".knob1").val().trim() == '')) {
				dataArray[dataArray.length] = "Lo representativo de su ingreso al menos debe ser de 1 .";
			}
			if(dataArray.length > 0) {
				parseAlert(1, dataArray)
				return false;
			}
			else {
				document.getElementById('questions').submit();
				return true;
			}

		}
	</script>
	<script>
		$(function() {
			$(".knob1").knob();

			// Example of infinite knob, iPod click wheel
			/*var val,up=0,down=0,i=0
				,$idir = $("div.idir")
				,$ival = $("div.ival")
				,incr = function() { i++; $idir.show().html("+").fadeOut(); $ival.html(i); }
				,decr = function() { i--; $idir.show().html("-").fadeOut(); $ival.html(i); };
			$("input.infinite").knob(
								{
								'min':0
								,'max':20
								,'stopper':false
								,'change':function(v){
											if(val>v){
												if(up){
													decr();
													up=0;
												}else{up=1;down=0;}
											}else{
												if(down){
													incr();
													down=0;
												}else{down=1;up=0;}
											}
											val=v;
											
										}
								}
								);
*/

			// Automatic mode
			/*var autoVal = 0
				,timer = setInterval(function() {
					$(".knob").each(
							function(){
								$(this)
									.val(Math.round(Math.sin(autoVal)*100))
									.trigger('change');
							}
						);
					autoVal++;
				}, 100);*/

			 // Configure
			 /*$(".knob").val(25).trigger(
						"configure",
						{"min":10, "max":40, "fgColor":"#7abb45", "skin":"tron", "cursor":true}
						);*/

			 // Change example
			 /*$(".knob").knob(
							{
							'change':function(e){
									console.log(e);
								}
							}
						)
					   .val(79)
					   ;*/
		});
    </script>
	<!--[if lt IE 9]>
		<link rel="stylesheet" href="stylesheets/ie.css">
	<![endif]-->


	<!-- IE Fix for HTML5 Tags -->
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

</head>

<body>


<!--1. HEADER -->
<?php	
include_once('header.php');	
?>
<!--1. /HEADER -->
	


<!--2. MAIN-->
<div id="main"> 
	
	<div class="container principal clearfix"><!-- Container Padding 20px -->
	

		<form action="<?php echo APPLICATION_URL?>metas-020/<?php echo $_GET[0];?>.html" method="post" id="questions">
		<!-- 2.1 Row: Content -->
		<div class="row">
			
			<div class="twelve columns"><!-- Main Panel Width -->
				<div class="panel header-explorar"> <!-- panel -->
					
					<!-- Ribbon -->
					<div class="ribbon">
						<h2><span class="head-e"><span class="sprite-1 diagnostico-icon">Icon</span></span><strong>Metas:</strong> Gastos</h2>
						<img src="<?php echo APPLICATION_URL;?>images/border.png" class="right border" width="12" height="44">
					</div>
					<!-- /Ribbon -->
										
						<div class="row question"><!-- Row Question 3 -->
							<br />
							<div class="eleven columns centered"><!-- 11 col -->
								<h3 class="text-center">Para llegar a dónde quieres, debes saber realmente dónde éstas. No todos somos iguales, para saber como estas tú y no el vecino, necesitamos conocer el entorno en el que vives y cuáles son tus metas.</h3>
							</div>
							<br />
							<div class="blue-shadow"><img src="<?php echo APPLICATION_URL?>images/shadow-03.png" alt="" width="" height=""></div>
						</div>					
										
					<!-- Content -->
					<div class="descubra-main clearfix">
						<div class="container">
							<div class="row">
								<div class="five columns">
									<div class="text-center">
										<h4 class="greytxt"><strong>Gastos en el hogar</strong></h4>
										<h5 class="greytxt">¿Qué tan representativo es tu ingreso en el total de gastos de tu hogar?</h5>
										<br />								<input name="user_income_representation" class="knob1" data-width="200" data-cursor="true" value="0"/>	
									</div>
                                    
								</div>
								
								
								<div class="seven columns"><!-- Home Persons -->
									<div class="text-center">
										<h4 class="greytxt"><strong>Personas en el hogar</strong></h4>
										<h5 class="greytxt">¿Cuantas personas conforman tu hogar, incluyéndote?</h5>
									</div>

									<div class="people">
										<div class="row">
											<div class="three columns men"><!-- Men -->
												<a href="#" class="icon_add" style=""><div class="sprite-1 men-icon">Men-icon</div></a>
												<table class="blank-table">
													<tr>
														<td><a href="#" class="sprite-1 less-than lt2">less</a></td>
														<td><input title="Hombres" name="user_men" class="blank-input" type="text" placeholder="0"/></td>
														<td><a href="#" class="sprite-1 more-than mt2">more</a></td>
													</tr>
												</table>
											</div><!-- /Men -->
											
											<div class="three columns men"><!-- Women -->
												<a href="#" class="icon_add" style=""><div class="sprite-1 women-icon">Men-icon</div></a>
												<table class="blank-table">
													<tr>
														<td><a href="#" class="sprite-1 less-than lt2">less</a></td>
														<td><input title="Mujeres" name="user_women" class="blank-input" type="text" placeholder="0"/></td>
														<td><a href="#" class="sprite-1 more-than mt2">more</a></td>
													</tr>
												</table>
											</div><!-- /Women -->
											
											<div class="three columns men"><!-- Boy -->
												<a href="#" class="icon_add" style=""><div class="sprite-1 boy-icon">Men-icon</div></a>
												<table class="blank-table">
													<tr>
														<td><a href="#" class="sprite-1 less-than lt2">less</a></td>
														<td><input title="Niños" name="user_sons" class="blank-input" type="text" placeholder="0"/></td>
														<td><a href="#" class="sprite-1 more-than mt2">more</a></td>
													</tr>
												</table>
											</div><!-- /Boy -->
											
											<div class="three columns men"><!-- Girl -->
												<a href="#" class="icon_add" style=""><div class="sprite-1 girl-icon">Men-icon</div></a>
												<table class="blank-table">
													<tr>
														<td><a href="#" class="sprite-1 less-than lt2">less</a></td>
														<td><input title="Niñas" name="user_daughters" class="blank-input" type="text" placeholder="0"/></td>
														<td><a href="#" class="sprite-1 more-than mt2">more</a></td>
													</tr>
												</table>
											</div><!-- /Girl -->
										</div>
									</div>
								</div><!-- /Home Persons -->
							</div>
						</div>
					</div>
					<!-- /Content -->
					
					<div class="main-footer" />
					<div class="shadow"><img src="<?php echo APPLICATION_URL;?>images/shadow-1.png" alt="shadow-1" width="1024" height="20" /></div>
						<div class="text-center">
							<a href="javascript:void(0);" onClick="" class="pretty-btn submit">Siguiente</a>
						</div>
					</div>

				</div> <!-- /panel -->
				<div class="blue-shadow"><img src="<?php echo APPLICATION_URL;?>images/shadow.png" alt="" width="" height=""></div>

			</div><!-- /Main Panel Width -->
			
		</div>
        </form>
		<!-- 2.1 /Row: Content -->
		
	
	</div><!-- /Container Padding 20px -->
</div>
<!--2. /MAIN--> 	


<!--3. FOOTER -->
<?php	
include_once('footer.php');	
?>
<!--3. /FOOTER--> 

<!-- Included JS Files -->

		
</body>
</html>
