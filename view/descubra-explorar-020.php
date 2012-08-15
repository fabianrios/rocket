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
<!--1. End HEADER -->
	


<!--2. MAIN-->
<div id="main"> 
	<div class="container principal clearfix"><!-- Container Padding 20px -->
		<div class="row"> <!-- row -->
			<div class="six columns">
				<h2 class="title"><span class="descubra-icon2">Icon</span>Descubra</h2>
			</div>	
			<div class="three columns offset-by-three">			
				<!-- breadcrumbs -->		
				<ul class="breadcrumbs">
					<li class="current azul"><a href="#"><strong>1 </strong>Explorar</a></li>
					<li><a href="#"><strong>2 </strong>Identificar</a></li>
				</ul>
				<!-- END breadcrumbs -->
			</div>
				
		</div>	<!-- END row -->
		<div class="row">
			<hr class="dotted" />
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


				<!-- orbit -->
				<div class="row"> <!-- row -->
					<div class="twelve columns centered altura">
						<div id="featured"> <!-- END featured -->
						     <div class="hall"> <!-- hall -->
						     	<div class="row">
						     		<h3 class="text-center">Tarjetas de crédito / <strong>Compras</strong></h3>
								</div>	
								<div class="row"> <!-- row -->
								<div class="ten columns centered">
									<form><!-- form -->
										
									<div class="four columns">
											<div class="bluebox centered">	
												<div class="uncheck"></div>
												<span class="text-center">Retiros de Dinero<br /></span>
												<br />
												
												<!--  formulario -->
												<div  class="formulario">
													<!-- Selection -->
													<div class="row">
														<div class="four columns"><label>Cajero:</label></div>
														<div class="eight columns">
															<select>
																<option>Seleccion</option>
															</select>
														</div>
													</div>
													<!-- END  Selection -->
													<!-- diferido -->
													<div class="row">
														<div class="four columns"><label>Oficina:</label></div>
														<div class="eight columns">
															<select>
																<option>Selecciona</option>
															</select>
														</div>
													</div>
													<!-- END diferido -->
													
													<!-- diferido -->
													<div class="row">
														<div class="four columns"><label>Internet:</label></div>
														<div class="eight columns">
															<select>
																<option>Seleccione</option>
															</select>
														</div>
													</div>
													<!-- END diferido -->
													<!-- diferido -->
													<div class="row">
														<div class="four columns"><label> Audio Respuesta:</label></div>
														<div class="eight columns">
															<select>
																<option>Seleccione</option>
															</select>
														</div>
													</div>
													<!-- END diferido -->
													
												</div><!--  END formulario -->
											</div>
									</div>
										
									<div class="four columns">
											<div class="uncheck"></div>
											<div class="bluebox centered">	
												<span class="text-center">Por Internet</span>
												<br />
												
												<!--  formulario -->
												<div  class="formulario">
													<!-- frecuencia -->
													<div class="row">
														<div class="four columns"><label> Frecuencia:</label></div>
														<div class="eight columns">
															<select>
																<option>Quincenal</option>
															</select>
														</div>
													</div>
													<!-- END  frecuencia -->
													<!-- diferido -->
													<div class="row">
														<div class="four columns"><label>Diferido a:</label></div>
														<div class="eight columns">
															<select>
																<option>36 Meses</option>
															</select>
														</div>
													</div>
													<!-- END diferido -->
													<!-- diferido -->
													<div class="row">
														<div class="four columns"><label> Monto:</label></div>
														<div class="eight columns">
															<input type="text" value="$17.900.000">
														</div>
													</div>
													<!-- END diferido -->
												</div><!--  END formulario -->
											</div>
									</div>
									<div class="four columns">
											<div class="uncheck"></div>
											<div class="bluebox centered">
												<span class="margin-30">Internacionales</span>
											</div>
										</div>

									</form>
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
						     
						     <div class="hall"> <!-- hall -->
								<div class="row">
									<h3 class="text-center"> Una Columna.</h3>
								</div>	
								
								<div class="row"> <!-- row -->
									<div class="ten columns centered">
										<div class="bluebox centered" id="panel1">
												<div class="row">
													<div class="four columns">
														<div class="row">
															<label>Nombre:</label>
																<select>
																	<option>Seleccione</option>
																</select>
																<label>Nombre:</label>
																<select>
																	<option>Seleccione</option>
																</select>
																<label>Nombre:</label>
																<select>
																	<option>Seleccione</option>
																</select>
																<label>Nombre:</label>
																<select>
																	<option>Seleccione</option>
																</select>
														</div>
													</div>
													<div class="four columns">
														<div class="row">
															<label>Nombre:</label>
																<select>
																	<option>Seleccione</option>
																</select>
																<label>Nombre:</label>
																<select>
																	<option>Seleccione</option>
																</select>
																<label>Nombre:</label>
																<select>
																	<option>Seleccione</option>
																</select>
																<label>Nombre:</label>
																<select>
																	<option>Seleccione</option>
																</select>
														</div>
													</div>
													<div class="four columns">
														<div class="row">
															<label>Nombre:</label>
																<select>
																	<option>Seleccione</option>
																</select>
																<label>Nombre:</label>
																<select>
																	<option>Seleccione</option>
																</select>
																<label>Nombre:</label>
																<select>
																	<option>Seleccione</option>
																</select>
																<label>Nombre:</label>
																<select>
																	<option>Seleccione</option>
																</select>
														</div>
													</div>
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
						     
						      <div class="hall"> <!-- hall -->
						     	<div class="row">
						     		<h3 class="text-center"> Dos Columnas.</h3>
								</div>	
								<div class="row"> <!-- row -->
									<div class="ten columns centered">
										<div class="six columns">
											<div class="bluebox centered" id="panel1">
												<span>1.</span>
											</div>
										</div>
										
										<div class="six columns">
											<div class="bluebox centered" id="panel2">
												<span>2.</span>
											</div>
										</div>
									</div>
								</div>	<!-- END row -->
						     </div><!-- END hall -->
						     
						     <div class="hall"> <!-- hall -->
						     	<div class="row">
						     		<h3 class="text-center"> Tres Columnas.</h3>
								</div>	
								<div class="row"> <!-- row -->
									<div class="ten columns centered">
										<div class="four columns">
											<div class="bluebox centered" id="panel1">
												<span>1.</span>
											</div>
										</div>
										
										<div class="four columns">
											<div class="bluebox centered" id="panel2">
												<span>2.</span>
											</div>
										</div>
										
										<div class="four columns">
											<div class="bluebox centered" id="panel3">
												<span>3.</span>
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
						     
						     <div class="hall"> <!-- hall -->
						     	<div class="row">
						     		<h3 class="text-center"> Cuatro Columnas</h3>
								</div>	
								<div class="row"> <!-- row -->
									<div class="ten columns centered">											
										<div class="three columns">
											<div class="bluebox centered" id="objeto">	
												<span class="text-center">1.</span>
											</div>
										</div>
										
										<div class="three columns">
											<div class="bluebox centered" id="objeto">	
												<span class="text-center">2.</span>
											</div>
										</div>
										
										<div class="three columns">
											<div class="bluebox centered" id="objeto">	
												<span class="text-center">3.</span>
											</div>
										</div>
										
										<div class="three columns">
											<div class="bluebox bluebox-panel centered" id="objeto">	
												<span class="text-center">4.</span>
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
						     
						     <div class="hall"> <!-- hall -->
						     	<div class="row">
						     		<h3 class="text-center"> Slider</h3>
								</div>	
								<div class="row"> <!-- row -->
									<div class="ten columns centered">											
										<div class="row">
												<div class="ten columns centered">
												<div class="slider"></div>
													<label for="amount" class="cantidad text-center"><input type="text" class="amount" /></label>
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
						     
						     <div class="hall"> <!-- hall -->
						     	<div class="row">
						     		<h3 class="text-center">Input.</h3>
								</div>	
								<div class="row"> <!-- row -->
									<div class="ten columns centered">
										<input type="text" class="input-nice" value=""/>
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
					<div class="orbit-shadow" />
						<div class="text-center">
							<br />
							<span>Hemos Descubierto algo!</span><br /><br />
							<span class="pretty-btn">Ver Resultados</span>
						</div>	
					</div> <!--END orbit footer -->
				</div><!-- END row -->
				<!-- END orbit -->
			</div> <!-- END panel -->
			<img src="images/shadow.png" class="sombra" width="982" height="27" />
		</div>
	</div><!-- END Container Padding 20px -->
</div>
<!--END MAIN--> 	

<?php	
include_once('footer.php');	
?>

<!-- Included JS Files -->
	<script src="javascripts/jquery.min.js"></script>
	<script src="javascripts/modernizr.foundation.js"></script>
	<script src="javascripts/foundation.js"></script>
	<script src="javascripts/app.js"></script>
	<!-- <script type="text/javascript" src="http://use.typekit.com/eif1fjl.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script> -->
	<script type="text/javascript" src="javascripts/jquery-ui-1.8.17.custom.min.js"></script>
	<script type="text/javascript">
	     $(window).load(function() {
	      $('#featured').orbit({
		     animation: 'horizontal-slide',                  // fade, horizontal-slide, vertical-slide, horizontal-push
		     animationSpeed: 800,                // how fast animtions are
		     timer: false, 			 // true or false to have the timer
		     advanceSpeed: 4000, 		 // if timer is enabled, time between transitions 
		     pauseOnHover: false, 		 // if you hover pauses the slider
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
	
		$(document).ready(function(){ //document ready
		
			// toggle	
			$('.uncheck').click(function(){
				$(this).toggleClass("checked");
			});// end toggle
		});//END document ready
		</script>
		
	<script type="text/javascript">
	$(function() {
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
	
	
	});
	</script>
	
		
</body>
</html>
