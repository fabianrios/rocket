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
<!--1. /HEADER -->
	


<!--2. MAIN-->
<div id="main"> 
	<div class="container principal clearfix"><!-- Container Padding 20px -->
	


		<!-- 2.1 Row: Content -->
		<div class="row">
			<div class="twelve columns"><!-- Main Panel Width -->
				<div class="panel header-explorar"> <!-- panel -->
					
					<!-- Ribbon -->
					<div class="ribbon">
						<h2><span class="head-e"><span class="sprite-1 diagnostico-icon">Icon</span></span><strong>Diagnóstico:</strong> Gastos</h2>
						<img src="images/border.png" class="right border" width="12" height="44">
					</div>
					<!-- /Ribbon -->
										
					<!-- Content -->
					<div class="descubra-main clearfix">
						<div class="container">
							<div class="row">
								<div class="five columns">
									<div class="text-center">
										<h4 class="greytxt"><strong>Gastos en el hogar</strong></h4>
										<h5 class="greytxt">¿Qué tan representativo es tu ingreso en el total de gastos de tu hogar?</h5>			
									</div>
									
									<div class="knob">
										<a href="#" class="knob-btn sprite-1">Knob-btn</a>
										<p class="knob-number text-center">100%</p>
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
												<div class="sprite-1 men-icon">Men-icon</div>
												<table class="blank-table">
													<tr>
														<td><a href="#" class="sprite-1 less-than">less</a></td>
														<td><input class="blank-input" type="text" placeholder="0"/></td>
														<td><a href="#" class="sprite-1 more-than">more</a></td>
													</tr>
												</table>
											</div><!-- /Men -->
											
											<div class="three columns men"><!-- Women -->
												<div class="sprite-1 men-icon">Men-icon</div>
												<table class="blank-table">
													<tr>
														<td><a href="#" class="sprite-1 less-than">less</a></td>
														<td><input class="blank-input" type="text" placeholder="0"/></td>
														<td><a href="#" class="sprite-1 more-than">more</a></td>
													</tr>
												</table>
											</div><!-- /Women -->
											
											<div class="three columns men"><!-- Boy -->
												<div class="sprite-1 men-icon">Men-icon</div>
												<table class="blank-table">
													<tr>
														<td><a href="#" class="sprite-1 less-than">less</a></td>
														<td><input class="blank-input" type="text" placeholder="0"/></td>
														<td><a href="#" class="sprite-1 more-than">more</a></td>
													</tr>
												</table>
											</div><!-- /Boy -->
											
											<div class="three columns men"><!-- Girl -->
												<div class="sprite-1 men-icon">Men-icon</div>
												<table class="blank-table">
													<tr>
														<td><a href="#" class="sprite-1 less-than">less</a></td>
														<td><input class="blank-input" type="text" placeholder="0"/></td>
														<td><a href="#" class="sprite-1 more-than">more</a></td>
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
					<div class="shadow"><img src="images/shadow-1.png" alt="shadow-1" width="1024" height="20" /></div>
						<div class="text-center">
							<a href="diagnostico-000.php" class="pretty-btn"><span class="whitetxt large baseline" aria-hidden="true" data-icon="x"> Anterior</a>
							<a href="diagnostico-020.php" class="pretty-btn">Siguiente</a>
						</div>
					</div>

				</div> <!-- /panel -->
				<div class="blue-shadow"><img src="images/shadow.png" alt="" width="" height=""></div>

			</div><!-- /Main Panel Width -->
		</div>
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
	<script src="javascripts/jquery.min.js"></script>
	<script src="javascripts/modernizr.foundation.js"></script>
	<script src="javascripts/foundation.js"></script>
	<script src="javascripts/app.js"></script>
		
</body>
</html>
