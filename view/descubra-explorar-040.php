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
	<link rel="stylesheet" href="stylesheets/jgauge.css">
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
	<div class="container main clearfix"><!-- Container Padding 20px -->
		<div class="row"> <!-- row -->
			<div class="six columns">
				<h2 class="title"><span class="descubra-icon2">Icon</span>Descubra</h2>
			</div>	
			<div class="three columns offset-by-three gris ">			
				<a class="text-right gray"><strong>&nbsp; 1 </strong>Explorar</a>
				<a class="azul2"><strong>2 </strong>Identificar</a>
			</div>
				
		</div>	<!-- END row -->
		<div class="row">
			<hr class="dotted" />
			<div class="panel header-explorar"> <!-- panel -->
				<h2 class="otro"><span class="head-e"><span class="num">2</span></span>Identificar</h2>
				<div class="respuesta text-right">

					<div class="row">
						<div class="three columns offset-by-five">
							
						</div>
						<div class="four columns gauge">
							<div id="jGaugeDemo" class="jgauge"></div>
						</div>
					</div>
				</div>
				
					<!-- orbit -->
				<div class="row"> <!-- row -->
					<div class="twelve columns centered altura">
						<div id="featured"> <!-- END featured -->
						     <div class="hall"> <!-- hall -->
						     	<div class="row">
						     		<h3 class="text-center"> Selecciona tu <strong>Producto</strong></h3>
						     		<p class="text-center">Según lo que nos contaste estos son los productos recomendados para ti.</p>
								</div>	
								<div class="row"> <!-- row -->
									<div class="three columns">
										
									</div>
									<div class="three columns">
										
									</div>
									<div class="three columns">
										
									</div>
									<div class="three columns">
										
									</div>
								</div>	<!-- END row -->
						     	
						     </div><!-- END hall -->
						</div> <!-- END featured -->
					</div>
					<!-- orbit footer -->
					<div class="footer minus40" />
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
	<script src="javascripts/jQueryRotate.min.js"></script>
	<script src="javascripts/jgauge-0.3.0.a3.js"></script>
	<script type="text/javascript" src="http://use.typekit.com/eif1fjl.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
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
	   var myGauge = new jGauge(); // Create a new jGauge.
	   myGauge.id = 'jGaugeDemo'; // Link the new jGauge to the placeholder DIV.
	   myGauge.ticks.count = 5;
	   myGauge.ticks.end = 100;
	   myGauge.ticks.labelColor = 'rgba(255, 255, 255, 0.5)';
	   myGauge.range.start = -175;
	   myGauge.range.end = -130;
	   myGauge.label.color = '#e5ad04';
	   myGauge.label.suffix = '%';
	   myGauge.height = 140;
	   myGauge.segmentStart = -175;
	   myGauge.segmentEnd = -10;
	   myGauge.range.radius = 40;
	   myGauge.ticks.labelRadius = 54;
	   //myGauge.needle.yOffset = 10;
	   // This function is called by jQuery once the page has finished loading.
	   $(document).ready(function(){
	      myGauge.init(); // Put the jGauge on the page by initialising it.
	      myGauge.setValue(75);
	      
	   });
	</script>
	
		
</body>
</html>
