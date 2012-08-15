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
	<link rel="stylesheet" href="stylesheets/pie-chart.css">
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
				<!-- gauge -->
				<div class="gauge">
					<div id="jGaugeDemo" class="jgauge"></div>
				</div>
				<!-- END gauge -->
				
				
				
				<!-- form -->
				<form id="FiltersForm" name="FiltersForm" method="post" action="#" class="register personality-percentages-page" lytic="Personality-Pie">
				
				<!-- pie wrapper -->
				<div class="pie-wrapper">
					<div class="pie"><!-- pie -->
						<div id="pie-chart-container">
					
						</div>
					 </div><!-- END pie -->
					<ul class="labels">
						<li class="item-Sports">
							<strong><em id="label-Sports">16</em>%</strong>
							<span>Uso</span>
						</li>
						<li class="item-Community">
							<strong><em id="label-Community">18</em>%</strong> 
							<span>Otro</span>
						</li>
						<li class="item-Family">
							<strong><em id="label-Family">15</em>%</strong> 
							<span>Otro mas</span>
						</li>
						<li class="item-Social">
							<strong><em id="label-Social">7</em>%</strong> 
							<span>Otro</span>
						</li>
						<li class="item-Nerd">
							<strong><em id="label-Nerd">21</em>%</strong> 
							<span>Uso</span>
						</li>
						<li class="item-MusicCulture">
							<strong><em id="label-MusicCulture">22</em>%</strong>
							<span>Particularidades</span>
						</li>
					</ul>
					
					<input type="hidden" name="Sports" id="Sports" value="18" style="width: 30px; "/>
					<input type="hidden" name="Community" id="Community" value="10" style="width: 30px; "/>
					<input type="hidden" name="Family" id="Family" value="15" style="width: 30px; "/>
					<input type="hidden" name="Social" id="Social" value="12" style="width: 30px; "/>
					<input type="hidden" name="Nerd" id="Nerd" value="17" style="width: 30px; "/>
					<input type="hidden" name="MusicCulture" id="MusicCulture" value="28" style="width: 30px; "/>
				</div>
				</form> <!-- END form -->
					<div class="row"><!-- row tip info -->
						<div class="one columns offset-by-eleven">
							<div class="has-tip tip-top" title="Esto nos permite recomendarte con mayor precision"><img src="images/info2.png" height="18" width="18" /> </div>
						</div>
					</div><!-- END row tip info -->
				<!-- END pie wrapper -->
				<div class="orbit-shadow">
						<div class="text-center">
							<br>
							<span>Haz Finalizado!</span><br><br>
							<span class="pretty-btn">Ver Resultados</span>
						</div>	
				</div>
			</div><!-- END panel -->
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
	<script type="text/javascript" src="javascripts/kinetic.js"></script>
	<!-- <script type="text/javascript" src="javascripts/common.js"></script>
	<script type="text/javascript" src="javascripts/resizable-pie-chart.js"></script>  -->
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
	   var myGauge = new jGauge(); // Create a new jGauge.
	   myGauge.id = 'jGaugeDemo'; // Link the new jGauge to the placeholder DIV.
	   myGauge.ticks.count = 5;
	   myGauge.ticks.end = 100;
	   myGauge.ticks.color='rgba(255, 255, 255, 0)';
	   myGauge.ticks.labelColor = 'rgba(255, 255, 255, 0.5)';
	   myGauge.range.start = -180;
	   myGauge.range.end = -135;
	   myGauge.label.color = '#e5ad04';
	   myGauge.label.suffix = '%';
	   myGauge.height = 140;
	   myGauge.width = 160;
	   myGauge.segmentStart = -180;
	   myGauge.segmentEnd = 0;
	   myGauge.range.radius = 10;
	   myGauge.ticks.labelRadius = 54;
	   myGauge.needle.yOffset = 24;
	   //myGauge.needle.yOffset = 10;  
	   // This function is called by jQuery once the page has finished loading.
	   $(document).ready(function(){
	      myGauge.init(); // Put the jGauge on the page by initialising it.
	      myGauge.setValue(75);
	      
	   });
	</script>
	
	
	<script type="text/javascript">
    function initPPChart(){
    	if(pieChartLoaded == false){
        	initPieChart('pie-chart-container',
            400, 400,
            [{percentage: 18, color: '#F58D48', label: 'Sports &amp; Recreation', percentageLabelID: 'label-Sports', fieldID: 'Sports'},{percentage: 10, color: '#FDDB02', label: 'Community Minded', percentageLabelID: 'label-Community', fieldID: 'Community'},{percentage: 15, color: '#26B8EB', label: 'Family First', percentageLabelID: 'label-Family', fieldID: 'Family'},{percentage: 12, color: '#BDCC2B', label: 'Social Butterfly', percentageLabelID: 'label-Social', fieldID: 'Social'},{percentage: 22, color: '#4C361C', label: 'Nerd &amp; Proud', percentageLabelID: 'label-Nerd', fieldID: 'Nerd'},{percentage: 23, color: '#1269B1', label: 'Music &amp; Culture', percentageLabelID: 'label-MusicCulture', fieldID: 'MusicCulture'}]);
            pieChartLoaded = true;
    	}
    }

	</script>
	
	
</body>
</html>
