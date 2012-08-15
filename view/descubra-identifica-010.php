
<!DOCTYPE html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
	
<meta charset="ISO-8859-1" />

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
	<link rel="stylesheet" href="<?php echo APPLICATION_URL?>stylesheets/style.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo APPLICATION_URL?>stylesheets/jquery-ui-1.8.17.custom.css" type="text/css" />
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo APPLICATION_URL?>favicon.ico" />
	<script language="javascript">
		var ApplicationUrl = '<?php echo APPLICATION_URL?>';
	</script>
	<script type="text/javascript" src="<?php echo APPLICATION_URL?>js/ajax_lib.js"></script>	
	<script src="<?php echo APPLICATION_URL?>javascripts/jquery.min.js"></script>
	<script src="<?php echo APPLICATION_URL?>javascripts/modernizr.foundation.js"></script>
	<script src="<?php echo APPLICATION_URL?>javascripts/foundation.js"></script>
	<script src="<?php echo APPLICATION_URL?>javascripts/app.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo APPLICATION_URL?>javascripts/jQueryRotate.min.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo APPLICATION_URL?>javascripts/jgauge-0.3.0.a3.js"></script>

	<script type="text/javascript" src="<?php echo APPLICATION_URL?>javascripts/jquery-ui-1.8.17.custom.min.js"></script>
	<script type="text/javascript" src="<?php echo APPLICATION_URL?>javascripts/input-behaviors.js"></script>
	<script type="text/javascript" src="<?php echo APPLICATION_URL?>js/ajax_lib.js"></script>
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

$productId 		= isset($_GET[0]) ? $_GET[0] : 4;
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
					<li>1</li>
					<li class="breadcrumb-active">2 Identifica</li>
				</ul>
				<!-- END breadcrumbs -->
			</div>	
		<hr class="dotted" />
		</div>
		<!-- 2.1 END Row: title -->
		
		
		<div class="row"><!-- row -->
			<div class="panel header-explorar"> <!-- panel -->

				
				<div class="ribbon">
					<h2><span class="head-e"><span class="num">2</span></span>Identificar</h2>
					<img src="<?php echo APPLICATION_URL?>images/border.png" class="right border" width="12" height="44">
				</div>

				<div class="row">
					<div class="five columns offset-by-seven">
						<div class="respuesta"><!-- respuesta -->
							<span>Haz respondido<strong> <label id="question_num">0</label> </strong>preguntas</span>
							<div class="move"><!-- tip -->
								<div class="has-tip tip-bottom" title="Esto nos permite recomendarte con mayor precision">
									<img src="<?php echo APPLICATION_URL?>images/info.png" width="16" height="17" />
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
				<form method="post" action="<?php echo APPLICATION_URL?>question.controller.html" id="input-form">
					<input type="hidden" name="action" value="submit_user_info">
					<input type="hidden" name="product_id" value="<?php echo $productId?>">				
				<!-- orbit -->
				<div class="row"> <!-- row -->
					<div class="twelve columns centered altura">
						<div id="featured"> <!-- END featured -->

							<?php
							require_once(SITE_VIEW . "fields.php");
							?>		
		
						</div> <!-- END featured -->
						
						
						
					</div>
					<!-- orbit footer -->
					</form>					
					
					
					<div class="orbit-shadow" />
						<div class="text-center" style="display: none" id="submit_button">
							<br />
							<span>Hemos Descubierto algo!</span><br /><br />
							<span class="pretty-btn" onClick="$('#input-form').submit();">Ver Resultados</span>
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
