<?php
$ccProducts = ProductHelper::retrieveProducts("AND parent_id = 1 ORDER BY product_id");
$crProducts = ProductHelper::retrieveProducts("AND parent_id = 4 ORDER BY product_id");
$deProducts = ProductHelper::retrieveProducts("AND parent_id = 6 ORDER BY product_id");
$tdProducts = ProductHelper::retrieveProducts("AND parent_id = 14 ORDER BY product_id");
?>
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
	<link rel="stylesheet" href="stylesheets/foundation.css">
	<link rel="stylesheet" href="stylesheets/style.css" type="text/css" />
	<link rel="stylesheet" href="stylesheets/jquery-ui-1.8.17.custom.css" type="text/css" />
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
	<script type="text/javascript" src="<?php echo APPLICATION_URL?>js/ajax_lib.js"></script>	
	<script src="javascripts/jquery.min.js"></script>
	<script src="javascripts/modernizr.foundation.js"></script>
	<script src="javascripts/foundation.js"></script>
	<script src="javascripts/app.js"></script>

	<script type="text/javascript" src="javascripts/jquery-ui-1.8.17.custom.min.js"></script>
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
$productId 		= 4;
$tablePrefix 	= 'iden_';
?>
<!--1. End HEADER -->
	


<!--2. MAIN-->
<div id="main"> 
	<div class="container principal clearfix"><!-- Container Padding 20px -->
	
		<!-- 2.1 Row: Title -->
		<div class="row">
			<div class="six columns">
				<h2 class="title"><span class="descubra-icon2">Icon</span>Descubra</h2>
			</div>

			<div class="six columns">	
				<!-- breadcrumbs -->		
				<ul class="breadcrumbs">
					<li class="breadcrumb-active">1 - Explora</li>
					<li>2</li>
				</ul>
				<!-- END breadcrumbs -->
			</div>	
		<hr class="dotted" />
		</div>
		<!-- 2.1 END Row: title -->
		
		
		<div class="row"><!-- row -->
			<div class="panel header-explorar"> <!-- panel -->

				
				<div class="ribbon">
					<h2><span class="head-e"><span class="num">1</span></span>Explorar</h2>
					<img src="images/border.png" class="right border" width="12" height="44">
				</div>

				<div class="row">
					<div class="five columns offset-by-seven">
						<div class="respuesta"><!-- respuesta -->
							<span>Haz respondido<strong> 3 </strong>preguntas</span>
							<div class="move"><!-- tip -->
								<div class="has-tip tip-bottom" title="Esto nos permite recomendarte con mayor precision">
									<img src="images/info.png" width="16" height="17" />
								</div>
							</div><!-- END tip -->
						</div> <!-- END respuesta -->
					</div>
				</div>
				
				<!-- gauge -->
				<div class="gauge">
					<div id="jGaugeDemo" class="jgauge"></div>
				</div>
				<!-- END gauge -->				
				
				<!-- orbit -->
				<div class="row"> <!-- row -->
					<div class="twelve columns centered altura">
						<div id="featured"> <!-- END featured -->
						 	<div class="hall"> <!-- hall -->
						     	<div class="row">
						     		<h3 class="text-center">Escoge un <strong>producto</strong></h3>
								</div>	
								<div class="row"> <!-- row -->
									<div class="ten columns centered">
											
										<div class="three columns">
											<div class="bluebox centered" id="objeto">	
												<span class="text-left">Tarjeta de cr&eacute;dito</span>
												<br />
												
												<!--  formulario -->
												<div  class="formulario">
													<!-- frecuencia -->
													<div class="row">
														<label>Producto:</label><br />
															<select class="userdata" name="product_id" onChange="window.location.href = 'descubra-020/' + this.value + '.html';">
																<option>Seleccione</option>
																<?php
																foreach($ccProducts as $product)
																{
																	?>
																	<option value="1"><?php echo $product->__get('product_name')?></option>
																	<?php
																}
																?>
																
															</select>
													</div>
													<!-- END  frecuencia -->
													
												</div><!--  END formulario -->
											</div>
										</div>
										
										<div class="three columns">
											<div class="bluebox centered" id="objeto">	
												<span class="text-left">Cr&eacute;dito</span>
												<br />
												
												<!--  formulario -->
												<div  class="formulario">
													<!-- frecuencia -->
													<div class="row">
														<label>Producto:</label><br />
															<select class="userdata" name="product_id" onChange="window.location.href = 'descubra-020/' + this.value + '.html';">
																<option>Seleccione</option>
																<?php
																foreach($crProducts as $product)
																{
																	?>
																	<option value="<?php echo $product->__get('product_id')?>"><?php echo $product->__get('product_name')?></option>
																	<?php
																}
																?>
																
															</select>
													</div>
													<!-- END  frecuencia -->
													
												</div><!--  END formulario -->
											</div>
										</div>
										
										<div class="three columns">
											<div class="bluebox centered" id="objeto">	
												<span class="text-left">Dep&oacute;sitos</span>
												<br />
												
												<!--  formulario -->
												<div  class="formulario">
													<!-- frecuencia -->
													<div class="row">
														<label>Producto:</label><br />
															<select class="userdata" name="product_id" onChange="window.location.href = 'descubra-020/' + this.value + '.html';">
																<option>Seleccione</option>
																<?php
																foreach($deProducts as $product)
																{
																	?>
																	<option value="6"><?php echo $product->__get('product_name')?></option>
																	<?php
																}
																?>
																
															</select>
													</div>
													<!-- END  frecuencia -->
													
												</div><!--  END formulario -->
											</div>
										</div>
										<div class="three columns">
											<div class="bluebox centered" id="objeto">	
												<span class="text-left">Dep&oacute;sitos a t&eacute;rmino</span>
												<br />
												
												<!--  formulario -->
												<div  class="formulario">
													<!-- frecuencia -->
													<div class="row">
														<label>Producto:</label><br />
															<select class="userdata" name="product_id" onChange="window.location.href = 'descubra-020/' + this.value + '.html';">
																<option>Seleccione</option>
																<?php
																foreach($tdProducts as $product)
																{
																	?>
																	<option value="15"><?php echo $product->__get('product_name')?></option>
																	<?php
																}
																?>
																
															</select>
													</div>
													<!-- END  frecuencia -->
													
												</div><!--  END formulario -->
											</div>
										</div>
									</div>
								</div>	<!-- END row -->
							<div class="row tip"><!-- row tip info -->
								<div class="one columns offset-by-eleven">
									<div class="has-tip tip-top" title="Esto nos permite recomendarte con mayor precision">
										<img src="images/info2.png" height="18" width="18" /> 
									</div>
								</div>
							</div><!-- END row tip info -->	
						     	
						     </div><!-- END hall -->
						</div> <!-- END featured -->
						
						
						
					</div>
					<!-- orbit footer -->
					
					
					
					<div class="orbit-shadow" onClick="window_location$.href = '/descubra-identifica-010/' + $('#product_id').val() + '.html" />
						<div class="text-center" style="display:none;">
							<br />
							<span>Hemos Descubierto algo!</span><br /><br />
							<span class="pretty-btn">Ver Resultados</span>
						</div>	
					</div> <!--END orbit footer -->
				</div><!-- END row -->
				<!-- END orbit -->
			</div> <!-- END panel -->

		</div>
	</div><!-- END Container Padding 20px -->
</div>
<!--END MAIN--> 	

<?php	
include_once('footer.php');	
?>

<!-- Included JS Files -->

	<script type="text/javascript">
	     $(window).load(function() {
	      $('#featured').orbit({
		     animation: 'horizontal-slide',                  // fade, horizontal-slide, vertical-slide, horizontal-push
		     animationSpeed: 800,                // how fast animtions are
		     timer: false, 			 // true or false to have the timer 
		     pauseOnHover: true, 		 // if you hover pauses the slider
		     startClockOnMouseOut: false, 	 // if clock should start on MouseOut
		     startClockOnMouseOutAfter: 1000, 	 // how long after MouseOut should the timer start again
		     directionalNav: true, 		 // manual advancing directional navs
		     captions: false, 			 // do you want captions?
		     captionAnimation: 'fade', 		 // fade, slideOpen, none
		     captionAnimationSpeed: 800, 	 // if so how quickly should they animate in
		     bullets: true,			 // true or false to activate the bullet navigation
		     bulletThumbs: false,		 // thumbnails for the bullets
		     bulletThumbLocation: '',		 // location from this file where thumbs will be
		     afterSlideChange: function(){} 	 // empty function 
		});
	     });
	</script>
	
	<script type="text/javascript">
	/*$(function() {
		$( ".slider" ).slider({
			value:100000,
			min: 500000,
			max: 60000000,
			step: 50000,
			slide: function( event, ui ) {
				$( ".amount" ).val( "$" + ui.value );
			}
		});
		$( ".amount" ).val( "$" + $( ".slider" ).slider( "value" ) );
	
	
	});*/
	</script>
	
	
	<script type="text/javascript">
	
		$(document).ready(function(){ //document ready
		
			// toggle panel1	
			$('#panel1').click(function(){
				$(this).addClass("checked");
				$('#panel2').removeClass("checked");
			});// end toggle panel1
			
			// toggle panel2
			$('#panel2').click(function(){
				$(this).addClass("checked");
				$('#panel1').removeClass("checked");
			});// end toggle panel2
		});//END document ready
	
	</script>
	
		
</body>
</html>
