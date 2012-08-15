<?php
$product 	= isset($_GET[0]) ? $_GET[0] : 14;
$userId		= isset($_SESSION['user_active']) ? $_SESSION['user_active'] : 1;
$user		= new User($userId);
$userData 	= unserialize($user->__get('user_data'));
$products	= array();
if ( ($product == 1) || ($product == 2) )
{
	$mastercard		= array(
	"tarjetas de credito clasica - Colpatria",
	"tarjetas de credito oro - Colpatria",
	"tarjeta de credito clasica - BCSC",
	"tarjeta de credito mastercard clasica - Citibank",
	"tarjeta de credito oro - BCSC",
	"tarjeta de credito platinum - BCSC",
	"tarjeta de credito gold - Citibank",
	"mastercard gold aadvantage - Citibank",
	"mastercard aadvantage platinum - Citibank",
	"tarjeta de credito mastercard platinum - Helm Bank",
	"tarjeta de credito mastercard clasica - Helm Bank",
	"tarjeta de credito mastercard gold - Helm Bank",
	"tarjeta platinum - Colpatria",
	"tarjeta mastercard black - Colpatria",
	"tarjeta de credito clasica de HSBC - HSBC",
	"tarjeta de credito clasica  joven - Helm Bank",
	"tarjeta de credito oro - Banco Santander",
	"tarjeta de credito oro de HSBC - HSBC",
	"tarjeta de credito platinum de HSBC - HSBC",
	"tarjeta de credito HSBC premier - HSBC",
	"tajeta de credito platinum - Banco Santander",
	"tarjeta de credito estándar - Banco Santander",
	"colsubsidio banco santander - Banco Santander",
	"tarjeta de credito mastercard basica - Citibank",
	"tarjeta de Credito credencial mastercard gold - Banco de Occidente",
	"Tarjeta de Crédito Credencial MasterCard Platinum - Banco de Occidente",
	"tarjeta de credito credencial mastercard black - Banco de Occidente",
	"Tarjeta de Credito Credencial MasterCard Clásica - Banco de Occidente",
	"Tarjeta de Credito Gold - Banco de Bogotá",
	"Tarjeta de credito Clásica - Banco de Bogotá",
	"Tarjeta de credito Gold - AV Villas",
	"Tarjeta de credito clasica - AV Villas",
	"Tarjeta de credito - Banco de Bogotá",
	);
	
	$visa 			= array(
	"tarjetas de credito oro - Colpatria",
	"tarjeta platinum - Colpatria",
	"tarjeta de credito clasica - BCSC",
	"tarjeta de credito clasica - Banco Agrario",
	"tarjeta de credito oro - BCSC",
	"tarjeta de credito platinum - BCSC",
	"tarjeta visa clasica - Citibank",
	"tarjeta de credito visa gold - Helm Bank",
	"tarjeta de credito visa platinum - Citibank",
	"visa  gold aadvantage - Citibank",
	"tatrjeta de credito clasica - Helm Bank",
	"tarjeta de credito visa platinum - Helm Bank",
	"Tarjeta de crédito Visa signature - Helm Bank",
	"tarjeta de credito oro - Banco Agrario",
	"tarjeta de credito clasica - Banco Popular",
	"tarjeta de credito oro - Banco Popular",
	"tarjeta de credito  platinum - Banco Popular",
	"tajeta de credito popular - Banco Popular",
	"tarjeta de credito clasica - Banco Santander",
	"tarjeta de credito clasica de HSBC - HSBC",
	"tarjeta clasica - GNB Sudameris",
	"tarjeta  oro - GNB Sudameris",
	"tarjeta  visa signature - Colpatria",
	"tarjeta platinum - GNB Sudameris",
	"tarjeta de credito oro - Banco Santander",
	"tajeta de credito platinum - Banco Santander",
	"tarjeta de credito platinum joven - Helm Bank",
	"tarjeta clasica de uso nacional - GNB Sudameris",
	"tarjeta de credito oro de HSBC - HSBC",
	"tarjeta de credito clasica - Banco Pichincha",
	"tarjeta de credito oro - Banco Pichincha",
	"tarjeta de credito platinum - Banco Pichincha",
	"tarjeta de credito platinum de HSBC - HSBC",
	"tarjeta de credito signature de HSBC - HSBC",
	"Tarjeta de Credito Credencial Visa Oro - Banco de Occidente",
	"Tarjeta de Credito  Platinum - Banco de Occidente",
	"Tarjeta Credencial Cuota Fija - Banco de Occidente",
	"tarjeta clasica - Colpatria",
	"Tarjetas de credito platinum - AV Villas",
	"Tarjeta de credito Clásica - Banco de Bogotá",
	"Tarjeta de Credito Gold - Banco de Bogotá",
	"Tarjeta de Crédito Platinum - Banco de Bogotá",
	"Tarjeta Credito Infinite - Banco de Bogotá",
	"Tarjeta Visa Signature - Banco de Bogotá",
	"Tarjeta de Credito Platinum - Banco de Bogotá",
	"Tarjeta de Crédito Credencial Visa Clásica - Banco de Occidente",
	"Tarjeta de credito clasica - AV Villas",
	"Tarjeta de credito Gold - AV Villas",
	
	);
	$products	= (isset($userData["usuario_franquicia"]) &&($userData["usuario_franquicia"] == 1)) ? $visa : $mastercard;
	
	
}
else if ($product == 5)
{
$products		= array("prestamo personal - Banco de Occidente",
				"credito de consumo libre inversion - Colpatria",
				"multiprestamo consumo AFC - Colpatria",
				"Multiprestamo de consumo FPV - Colpatria",
				"Credito de libre inversion - AV Villas",
				"credito educativo - AV Villas",
				"credito de libre inversion - Bancoomeva",
				"credito educar - Bancoomeva",
				"Turismo y recreacion - Bancoomeva",
				"credito si - Banco Pichincha",
				"Credi oficial - Banco Pichincha",
				"credioficial - Banco Pichincha",
				"credito educativo - Banco Pichincha",
				"Inverprimas - Banco Pichincha",
				"Libre inversion - Finamérica",
				"U Finamerica - Finamérica",
				"libre inversion - C.F.A.",
				"Prestaya - Banco Popular",
				"Prestamo Ordinario - Helm Bank",
				"Credito educativo - Helm Bank",
				"Credito Personal - Bancolombia",
				"credito  personal - Bancolombia",
				"Credito Preferencial - Bancolombia",
				"Credito de Consumo de HSBC - HSBC",
				"Credito de libre inversion - Banco BBVA",
				"credito de libre inversion - Banco BBVA",
				"credito libre inversion - Banco BBVA",
				"Credito de Consumo Cuota Regalo - Banco BBVA",
				"Prestamo personal - Citibank" );	
}
else if ($product == 4)
{
$products		= array('Occiauto - Banco  de  Occidente',
			  	'Autopropio - Coltefinanciera',
			  	'Credi vehiculo - Giros & Finanzas',
			  	'Credito para vehiculo - BCSC',
			  	'Credito Vehiculos - Bancolombia',
			  	'Credito de Vehiculo - Davivienda',	  	
				'Credito de vehiculo - Banco BBVA',
				'Credito de vehiculo nuevo - Colpatria'
			  );	
}
else if (($product == 6) || ($product == 10))
{
	if (isset($userData['usuario_veces_retiro']) && ($userData['usuario_veces_retiro'] == 2))
	{
		$banksTemp		= array('Cuenta de ahorros flexiahorro - Banco de Bogotá',
						'Cuenta tradicional - Banco Santander',
						'Cuenta Ahorrador - BCSC',
						'Cuenta Ahorrador - Bancolombia',
						'Cuenta de Ahorros Blue - BBVA',	  	
						'cuenta de ahorros occidia - Banco de Occidente',
						'cuenta rentable - Davivienda',
						'Cuenta Movil - AV Villas'
					  );
		$banks			= array_merge($banks, $banksTemp);
		if ($userData['usuario_edad'] < 26)
		{
			$banksTemp 	= array('Cuenta de ahorros joven - Banco de Bogotá',
								 'Cuenta Joven - Bancolombia');
			$banks		= array_merge($banks, $banksTemp);
		}
		if ($userData['usuario_edad'] > 60) 
		{
			$banksTemp 	= array('Cuenta Pensión  - Bancolombia');
			$banks		= array_merge($banks, $banksTemp);	
		}
	}
	else
	{
		$banksTemp		= array('Ahorro Programado - Bancolombia',
						'Cuenta de Ahorro Programado Mi Proyecto - BBVA',	  	
						'Cofibono - Coofinep' );	
		//$banks			= array_merge($banks, $banksTemp); //ESTO TIENE ERROR
		$banks			= $banksTemp; 
	}
	$products		= &$banks;
}
else if (($product == 14) || ($product == 15))
{
$products		= array('CDT Tradicional - Banco  de  Bogotá',
			  	'CDT - Banco Popular',
			  	'CDT Tasa Fija - Citibank',
			  	'CDT - Helm Bank',
			  	'CDT - Davivienda',
			  	'Dafuturo - Davivienda',	  	
				'CDT - AV Villas',
				'CDT Capitalizable - Bancolombia',
				'CDT Tasa Fija - HSBC',
				
			  );		
}


shuffle($products);
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
	<link rel="stylesheet" href="<?php echo APPLICATION_URL?>stylesheets/foundation.css">
	<!-- <link rel="stylesheet" href="<?php echo APPLICATION_URL?>stylesheets/jgauge.css"> -->
	<link rel="stylesheet" href="<?php echo APPLICATION_URL?>stylesheets/style.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo APPLICATION_URL?>stylesheets/jquery-ui-1.8.17.custom.css" type="text/css" />
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo APPLICATION_URL?>favicon.ico" />
	

	<!--[if lt IE 9]>
		<link rel="stylesheet" href="stylesheets/ie.css">
	<![endif]-->


	<!-- IE Fix for HTML5 Tags -->
	<!--[if lt IE 9]>
		<script src="<?php echo APPLICATION_URL?>http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
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
					<li><a href="#"><strong>1 </strong>Explorar</a></li>
					<li class="current-identificar azul" ><a href="#"><strong>2 </strong>Identificar</a></li>
				</ul>
				<!-- END breadcrumbs -->
			</div>
				
		</div>	<!-- END row -->
		<div class="row">
			<hr class="dotted" />
			<div class="panel header-explorar"> <!-- panel -->
				<div class="ribbon">
					<h2><span class="head-e"><span class="num">2</span></span>Identificar</h2>
					<img src="<?php echo APPLICATION_URL?>images/border.png" class="right border" width="12" height="44">
				</div>
				
				<div class="hall orbit-slide"> <!-- hall -->
					<div class="row"> <!-- row -->
							<div class="row">
								<h3 class="text-center">Selecciona tu <strong>Producto</strong><br /><span class="refran">Según lo que nos contaste estos son los productos recomendados para ti.</span></h3>
								
							</div>
							
							<div class="ten columns centered">
								<!-- COLUMNS 1/3 -->
								<div class="four columns">
									<!---img src="<?php echo APPLICATION_URL?>images/heart.png" class="corazon has-tip tip-top" data-width="169" width="57" height="57" title="Tu entidad favorita es una de las mejores opciones."--->
									<img src="<?php echo APPLICATION_URL?>images/little-gauge.png" class="right padd" width="22" height="19" >
									
									<div class="bluebox centered no-pointer" id="panel3">
										<!---p class="text-center small"><a href="">QUÉ SIGNIFICA ESTE NÚMERO</a></p--->

										<!-- cuenta -->
										<div class="text-center cuenta"> 
											<!---img src="<?php echo APPLICATION_URL?>images/davivienda.png" width="136" height="68" /--->
											<div class="row">
												<div class="ten columns">
													<span><?php echo strtoupper($products[0])?></span> 
												</div>
												<div class="two columns">
													<a href=""><span class="informacion">informacion</span></a> 
												</div>
											</div>
										</div>
										<!-- END cuenta -->
										
										<blockquote class="arrow-up"></blockquote>
										
										<!-- comentario -->
										<!---div class="comentario">
											<em>“Una cuenta de ahorros 
												para todos, muy 
												económica”</em>
												<span> Federico Parra</span>
										</div--->
										<!-- END comentario -->
										
										<p class="text-center"><a href="#" class="pretty-btn">Quiero este producto ya!</a></p>
										
										<!-- contacto-entidad -->
										<div class="contacto-entidad">
											<div class="row">
												<div class="four columns linea"></div>
												<div class="four columns"><em> o puedes</em> </div>
												<div class="four columns linea"></div>
											</div>
											<p class="text-center white"><strong>contactar a la entidad:</strong></p> 
											<ul class="entidad clearfix">
												<li class="representante">representante</li>
												<li class="telefono">telefono</li>
												<li class="face">face</li>
												<li class="twitter">twitter</li>
											</ul>
										</div>
										<!-- END contacto-entidad -->
										
									</div>									
								</div>
								<!-- END COLUMNS 1/3 -->
								
								<!-- COLUMNS 2/3 -->
								<div class="four columns">
									<!---img src="<?php echo APPLICATION_URL?>images/heart.png" class="corazon has-tip tip-top" data-width="169" width="57" height="57" title="Tu entidad favorita es una de las mejores opciones."--->
									<img src="<?php echo APPLICATION_URL?>images/little-gauge.png" class="right padd" width="22" height="19" >
									
									<div class="bluebox centered no-pointer" id="panel3">
										<!---p class="text-center small"><a href="">QUÉ SIGNIFICA ESTE NÚMERO</a></p--->

										<!-- cuenta -->
										<div class="text-center cuenta"> 
											<!---img src="<?php echo APPLICATION_URL?>images/davivienda.png" width="136" height="68" /--->
											<div class="row">
												<div class="ten columns">
													<span><?php echo strtoupper($products[1]);?></span> 
												</div>
												<div class="two columns">
													<a href=""><span class="informacion">informacion</span></a> 
												</div>
											</div>
										</div>
										<!-- END cuenta -->
										
										<blockquote class="arrow-up"></blockquote>
										
										<!-- comentario -->
										<!---div class="comentario">
											<em>“Una cuenta de ahorros 
												para todos, muy 
												económica”</em>
												<span> Federico Parra</span>
										</div--->
										<!-- END comentario -->
										<!-- END comentario -->
										
										<p class="text-center"><a href="#" class="pretty-btn">Quiero este producto ya!</a></p>
										
										<!-- contacto-entidad -->
										<div class="contacto-entidad">
											<div class="row">
												<div class="four columns linea"></div>
												<div class="four columns"><em> o puedes</em> </div>
												<div class="four columns linea"></div>
											</div>
											<p class="text-center white"><strong>contactar a la entidad:</strong></p> 
											<ul class="entidad clearfix">
												<li class="representante">representante</li>
												<li class="telefono">telefono</li>
												<li class="face">face</li>
												<li class="twitter">twitter</li>
											</ul>
										</div>
										<!-- END contacto-entidad -->
										
									</div>									
								</div>
								<!-- END COLUMNS 2/3 -->
								
								
								<!-- COLUMNS 3/3 -->
								<div class="four columns">
									<!---img src="<?php echo APPLICATION_URL?>images/heart.png" class="corazon has-tip tip-top" data-width="169" width="57" height="57" title="Tu entidad favorita es una de las mejores opciones."--->
									<img src="<?php echo APPLICATION_URL?>images/little-gauge.png" class="right padd" width="22" height="19" >
									
									<div class="bluebox centered no-pointer" id="panel3">
										<!---p class="text-center small"><a href="">QUÉ SIGNIFICA ESTE NÚMERO</a></p--->

										<!-- cuenta -->
										<div class="text-center cuenta"> 
											<!---img src="<?php echo APPLICATION_URL?>images/davivienda.png" width="136" height="68" /--->
											<div class="row">
												<div class="ten columns">
													<span><?php echo strtoupper($products[2]);?></span> 
												</div>
												<div class="two columns">
													<a href=""><span class="informacion">informacion</span></a> 
												</div>
											</div>
										</div>
										<!-- END cuenta -->
										
										<blockquote class="arrow-up"></blockquote>
										
										<!-- comentario -->
										<!---div class="comentario">
											<em>“Una cuenta de ahorros 
												para todos, muy 
												económica”</em>
												<span> Federico Parra</span>
										</div--->
										<!-- END comentario -->
										
										<p class="text-center"><a href="#" class="pretty-btn">Quiero este producto ya!</a></p>
										
										<!-- contacto-entidad -->
										<div class="contacto-entidad">
											<div class="row">
												<div class="four columns linea"></div>
												<div class="four columns"><em> o puedes</em> </div>
												<div class="four columns linea"></div>
											</div>
											<p class="text-center white"><strong>contactar a la entidad:</strong></p> 
											<ul class="entidad clearfix">
												<li class="representante">representante</li>
												<li class="telefono">telefono</li>
												<li class="face">face</li>
												<li class="twitter">twitter</li>
											</ul>
										</div>
										<!-- END contacto-entidad -->
										
									</div>									
								</div>
								<!-- END COLUMNS 3/3 -->
						</div>
					</div><!-- END row -->
					<br /><br />
				</div><!-- END hall -->
				<br />
					<!-- orbit footer -->
					<div class="row">
						<div class="text-center">
							<br />
							
						</div>	
					</div> <!--END orbit footer -->
			</div> <!-- END panel -->
			<img src="<?php echo APPLICATION_URL?>images/shadow.png" class="sombra" width="982" height="27" />
			
		</div>
	</div><!-- END Container Padding 20px -->
</div>
<!--END MAIN--> 	

<?php	
include_once('footer.php');	
?>

<!-- Included JS Files -->
	<script src="<?php echo APPLICATION_URL?>javascripts/jquery.min.js"></script>
	<script src="<?php echo APPLICATION_URL?>javascripts/modernizr.foundation.js"></script>
	<script src="<?php echo APPLICATION_URL?>javascripts/foundation.js"></script>
	<script src="<?php echo APPLICATION_URL?>javascripts/app.js"></script>
	<script src="<?php echo APPLICATION_URL?>javascripts/jQueryRotate.min.js"></script>
	<script src="<?php echo APPLICATION_URL?>javascripts/jgauge-0.3.0.a3.js"></script>
	<!-- <script type="text/javascript" src="<?php echo APPLICATION_URL?>http://use.typekit.com/eif1fjl.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script> -->
	<script type="text/javascript" src="<?php echo APPLICATION_URL?>javascripts/jquery-ui-1.8.17.custom.min.js"></script>
	<!-- <script type="text/javascript">
	     $(window).load(function() {
	      $('#featured-identifica').orbit({
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
	</script> -->

	
<!--
			<script type="text/javascript">
	
		   $(document).ready(function(){ //document ready
		   	
		   		   	// panel1	
	   	  $('#panel1').click(function(){  
	   	 // console.log($('.panel-azul').attr("id"));

			
	   	  		$(this).addClass("panel-azul-check");
	   	  		$('#panel2').removeClass("panel-azul-check");
	   	

	     });
	     //END panel1
	     
	     // panel2
	      $('#panel2').click(function(){
	      		   	  		$(this).addClass("panel-azul-check");
	   	  		$('#panel1').removeClass("panel-azul-check");
	     });
	     // END panel2
		   	
		   	  $('.bluebox').click(function(){  	
				$(this).toggleClass("blueboxCheck");
		     });
		      
		       $('.bluebox2').click(function(){  	
				$(this).toggleClass("bluebox2Check");
		     }); 
		      
		   });//END document ready
		</script>
-->
		
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
