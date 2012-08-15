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
	<link rel="stylesheet" href="stylesheets/jquery-ui-1.8.20.custom.css" type="text/css" />
	
	<script language="JavaScript" src="<?php echo APPLICATION_URL?>javascripts/jquery.min.js" ></script>
	<script language="JavaScript" src="<?php echo APPLICATION_URL?>javascripts/jquery-ui-1.8.20.custom.min.js" ></script>
	<script language="JavaScript" src="<?php echo APPLICATION_URL?>javascripts/diagnostics-behaviors.js" ></script>
	<script language="JavaScript" src="<?php echo APPLICATION_URL?>javascripts/global-functions.js" ></script>
	<script language="JavaScript" src="<?php echo APPLICATION_URL?>js/ajax_lib.js" ></script>
	<script language="JavaScript" src="<?php echo APPLICATION_URL?>js/ajax_helper.js" ></script>
	<script language="JavaScript" src="<?php echo APPLICATION_URL?>js/form_parser_helper.js" ></script>
	<script language="JavaScript" src="<?php echo APPLICATION_URL?>js/helpers.js" ></script>
	<script language="JavaScript">
		function validateInputs() {
			if(($('#goal_1').val() == '') && ($('#goal_2').val() == '') && ($('#goal_3').val() == '')) {
				parseAlert(1, Array("Debe escoger al menos una meta."))
				
				return false;
			}
			else {
				return true;
			}
		}
	</script>
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
						<h2><span class="head-e"><span class="sprite-1 diagnostico-icon">Icon</span></span><strong>Diagnóstico:</strong> Metas</h2>
						<img src="images/border.png" class="right border" width="12" height="44">
					</div>
					<!-- /Ribbon -->
										
					<!-- Content -->
					<div class="descubra-main clearfix">
						<div class="container"><!-- Container -->
							<div class="row"><!-- Row -->
								<div class="twelve columns"><!-- 12 col -->
									<div class="text-center">
										<h4 class="greytxt"><strong>¿Cuéntanos tres metas que tengas y cuando quieres realizarlas?</strong></h4>
										<h5 class="greytxt">Arrastra tus metas al punto apropiado de inicio en la línea de tiempo.</h5>			
									</div>
									
									<div class="goals-block"><!-- Goals -->
										<div class="row">
											<div class="two columns"><!-- Goal 1 -->
												<div class="goal" id="goal-1">
													<div id="goal-1" class="goal-1 sprite-goals">Carro</div>
													<h6 class="text-center">Carro</h6>
												</div>
											</div><!-- /Goal 1 -->
											
											<div class="two columns"><!-- Goal 2 -->
												<div class="goal" id="goal-2">
													<div class="goal-2 sprite-goals">Carro</div>
													<h6 class="text-center">Moto</h6>
												</div>
											</div><!-- /Goal 2 -->
											
											<div class="two columns"><!-- Goal 3 -->
												<div class="goal" id="goal-3">
													<div class="goal-3 sprite-goals">Carro</div>
													<h6 class="text-center">Ahorro</h6>
												</div>
											</div><!-- /Goal 3 -->
											
											<div class="two columns"><!-- Goal 4 -->
												<div class="goal" id="goal-4">
													<div class="goal-4 sprite-goals">Carro</div>
													<h6 class="text-center">Casa</h6>
												</div>
											</div><!-- /Goal 4 -->
											
											<div class="two columns"><!-- Goal 5 -->
												<div class="goal" id="goal-5">
													<div class="goal-5 sprite-goals">Carro</div>
													<h6 class="text-center">Estudio</h6>
												</div>
											</div><!-- /Goal 5 -->
											
											<div class="two columns"><!-- Goal 6 -->
												<div class="goal" id="goal-6">
													<div class="goal-6 sprite-goals">Carro</div>
													<h6 class="text-center">Matrimonio</h6>
												</div>
											</div><!-- /Goal 6 -->

										</div>
									</div><!-- /Goals -->
								</div><!-- /12 col -->
							</div><!-- /Row -->
						</div><!-- /Container -->
					</div>
					<!-- /Content -->
					
					<div class="timeline-block"><!-- Timeline -->
						<div class="container">
								<div class="text-center">
									<h5 class="greytxt">Arrastra tus metas seleccionadas en la línea de tiempo.</h5>			
								</div>
								
								<div class="timeline clearfix">
									<div class="start">
										<div class="start-point sprite-1">today</div>
										<h6>HOY</h6>
									</div>
									<div class="finish">
										<div class="finish-point sprite-1">finish</div>
									</div>
									<div class="droppable" style="position: absolute; height: 100%; width: 33%; margin-left: 7px;" id="first"></div>
									<div class="droppable" style="position: absolute; height: 100%; width: 33%; margin-left: 7px; left: 33%;" id="second"></div>
									<div class="droppable" style="position: absolute; height: 100%; width: 33%; margin-left: 7px; left: 66%;" id="third"></div>
									<hr class="timeline-bar" />
								</div>
							</div>
						</div>
					</div><!-- /Timeline -->
					
					
					<div class="main-footer">
					<div class="shadow"><img src="images/shadow-1.png" alt="shadow-1" width="1024" height="20" /></div>
						<div class="text-center">
							<form id="diagnostics_form" action="" method="post">
								<input type="hidden" class="goal-input" name="user_goal_1" id="goal_1" />
								<input type="hidden" class="term-input" name="user_goal_1_term" id="goal_2_term" />
								<input type="hidden" class="goal-input" name="user_goal_1" id="goal_2" />
								<input type="hidden" class="term-input" name="user_goal_1_term" id="goal_3_term" />
								<input type="hidden" class="goal-input" name="user_goal_1" id="goal_3" />
								<input type="hidden" class="term-input" name="user_goal_1_term" id="goal_1_term" />
							<a href="diagnostico-010.php" class="pretty-btn"><span class="whitetxt large baseline" aria-hidden="true" data-icon="x"> Anterior</a>
							<input type="submit" value="Siguiente" class="pretty-btn submit" />
							<input type="hidden" name="">
							</form>
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
		
</body>
</html>
