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
	
	<?php	
	
	include_once('menu-script.php');
	?>
	
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
foreach ($_POST as $key=>$value)
{
	$userData 	= UserHelper::setData($user->__get('user_id'), $key, $value);
}
?>
<!--1. /HEADER -->
	


<!--2. MAIN-->
<div id="main"> 
	<div class="container principal clearfix"><!-- Container Padding 20px -->
	
<?php	
$bread_name = "Selección";
include_once('breadcrumbs-metas.php');	
?>

		<!-- 2.1 Row: Content -->
		<div class="row">
			<div class="twelve columns"><!-- Main Panel Width -->
				<div class="panel-1 grad2"> <!-- panel -->
					
				    	<div class="row"><!-- Row innerheader -->
				    	    <div class="innerheader clearfix">
				    	    	<div class="inner-ribbon">
				    	    		<div class="inner-title left"><h2 class="left white txt-shadow-black"><strong class="whitetxt"><span class="nav-icon" aria-hidden="true" data-icon="&#x65;"></span></span> Metas</strong></h2></div><div class="sprite-1 ribbon-detail left">icon</div>
				    	    		</div>
				    	    </div>
				    	</div><!-- /Row innerheader -->
					

										
					<!-- Content -->
					<div class="descubra-main clearfix margin-top-60">
						<div class="container"><!-- Container -->
							<div class="row"><!-- Row -->
								<div class="twelve columns"><!-- 12 col -->
								
								<h5 class="greytxt no-margin"><strong>Selecciona tu meta</strong></h5>
					        	<p class="no-margin">Las metas nos dan una razón mas para levantarnos cada día a trabajar duro, ¿cuál es la tuya?</p>	

									
									<div class="goals-block"><!-- Goals -->
										
										<div class="row"><!--/row-->
											<div class="two columns"><!-- Goal 1 -->
												<div class="goal"><!--goal-->
													<a href="<?php echo APPLICATION_URL?>metas-020/1.html"><div id="goal-1" class="goal-1">
														<img src="<?php echo APPLICATION_URL?>/images/goals/big/estudio.png" alt="estudio" width="" height="" /></div>
													</a>
													<h6 class="text-center greytxt"><a href="<?php echo APPLICATION_URL?>metas-020/1.html">Estudio</a></h6>
												</div><!--goal-->
											</div><!-- /Goal 1 -->
											
											<div class="two columns"><!-- Goal 2 -->
												<div class="goal"><!--goal-->
													<a href="<?php echo APPLICATION_URL?>metas-020/2.html"><div id="goal-2" class="goal-2">
														<img src="<?php echo APPLICATION_URL?>/images/goals/big/emergencia.png" alt="estudio" width="" height="" /></div>
													</a>
													<h6 class="text-center greytxt"><a href="<?php echo APPLICATION_URL?>metas-020/2.html">Fondo de emergencia</a></h6>
												</div><!--goal-->
											</div><!-- /Goal 2 -->
											
											<div class="two columns"><!-- Goal 3 -->
												<div class="goal"><!--goal-->
													<a href="<?php echo APPLICATION_URL?>metas-020/3.html"><div id="goal-3" class="goal-3">
														<img src="<?php echo APPLICATION_URL?>/images/goals/big/carro.png" alt="estudio" width="" height="" /></div>
													</a>
													<h6 class="text-center greytxt"><a href="<?php echo APPLICATION_URL?>metas-020/3.html">Carro</a></h6>
												</div><!--goal-->
											</div><!-- /Goal 3 -->
											
											<div class="two columns"><!-- Goal 4 -->
												<div class="goal"><!--goal-->
													<a href="<?php echo APPLICATION_URL?>metas-020/4.html"><div id="goal-4" class="goal-4">
														<img src="<?php echo APPLICATION_URL?>/images/goals/big/moto.png" alt="estudio" width="" height="" /></div>
													</a>
													<h6 class="text-center greytxt"><a href="<?php echo APPLICATION_URL?>metas-020/4.html">Moto</a></h6>
												</div><!--goal-->
											</div><!-- /Goal 4 -->
											
											<!-- Goal 5 <div class="two columns">
												<div class="goal">
													<a href="<?php echo APPLICATION_URL?>metas-020/5.html"><div id="goal-5" class="goal-5">
														<img src="<?php echo APPLICATION_URL?>/images/goals/big/casa.png" alt="estudio" width="" height="" /></div>
													</a>
													<h6 class="text-center greytxt"><a href="<?php echo APPLICATION_URL?>metas-020/4.html">Carro</a></h6>
												</div>
											</div> /Goal 5 -->
											
											<div class="two columns"><!-- Goal 6 -->
												<div class="goal"><!--goal-->
													<a href="<?php echo APPLICATION_URL?>metas-020/6.html"><div id="goal-6" class="goal-6">
														<img src="<?php echo APPLICATION_URL?>/images/goals/big/matrimonio.png" alt="estudio" width="" height="" /></div>
													</a>
													<h6 class="text-center greytxt"><a href="<?php echo APPLICATION_URL?>metas-020/4.html">Matrimonio</a></h6>
												</div><!--goal-->
											</div><!-- /Goal 6 -->
											
											<div class="two columns"><!-- Goal 7 -->
												<div class="goal"><!--goal-->
													<a href="<?php echo APPLICATION_URL?>metas-020/7.html"><div id="goal-7" class="goal-7">
														<img src="<?php echo APPLICATION_URL?>/images/goals/big/tener-hijo.png" alt="estudio" width="" height="" /></div>
													</a>
													<h6 class="text-center greytxt"><a href="<?php echo APPLICATION_URL?>metas-020/7.html">Tener un hijo</a></h6>
												</div><!--goal-->
											</div><!-- /Goal 7 -->

										</div><!--/row-->
										
										
										<div class="row"><!--row-->
										
											<div class="two columns"><!-- Goal 8 -->
												<div class="goal"><!--goal-->
													<a href="<?php echo APPLICATION_URL?>metas-020/8.html"><div id="goal-8" class="goal-8">
														<img src="<?php echo APPLICATION_URL?>/images/goals/big/estudio-hijos.png" alt="estudio" width="" height="" /></div>
													</a>
													<h6 class="text-center greytxt"><a href="<?php echo APPLICATION_URL?>metas-020/8.html">Estudio hijos</a></h6>
												</div><!--goal-->
											</div><!-- /Goal 8 -->
											
											<div class="two columns"><!-- Goal 9 -->
												<div class="goal"><!--goal-->
													<a href="<?php echo APPLICATION_URL?>metas-020/9.html"><div id="goal-9" class="goal-9">
														<img src="<?php echo APPLICATION_URL?>/images/goals/big/empezar-negocio.png" alt="estudio" width="" height="" /></div>
													</a>
													<h6 class="text-center greytxt"><a href="<?php echo APPLICATION_URL?>metas-020/9.html">Empezar negocio</a></h6>
												</div><!--goal-->
											</div><!-- /Goal 9 -->

											<div class="two columns"><!-- Goal 10 -->
												<div class="goal"><!--goal-->
													<a href="<?php echo APPLICATION_URL?>metas-020/10.html"><div id="goal-10" class="goal-10">
														<img src="<?php echo APPLICATION_URL?>/images/goals/big/pagar-deudas.png" alt="estudio" width="" height="" /></div>
													</a>
													<h6 class="text-center greytxt"><a href="<?php echo APPLICATION_URL?>metas-020/10.html">Pagar deudas</a></h6>
												</div><!--goal-->
											</div><!-- /Goal 10 -->		
											
											<div class="two columns"><!-- Goal 11 -->
												<div class="goal"><!--goal-->
													<a href="<?php echo APPLICATION_URL?>metas-020/11.html"><div id="goal-11" class="goal-11">
														<img src="<?php echo APPLICATION_URL?>/images/goals/big/vacaciones.png" alt="estudio" width="" height="" /></div>
													</a>
													<h6 class="text-center greytxt"><a href="<?php echo APPLICATION_URL?>metas-020/11.html">Vacaciones</a></h6>
												</div><!--goal-->
											</div><!-- /Goal 11 -->	
											
											<div class="two columns"><!-- Goal 12 -->
												<div class="goal"><!--goal-->
													<a href="<?php echo APPLICATION_URL?>metas-020/12.html"><div id="goal-12" class="goal-12">
														<img src="<?php echo APPLICATION_URL?>/images/goals/big/tratamiento-medico.png" alt="estudio" width="" height="" /></div>
													</a>
													<h6 class="text-center greytxt"><a href="<?php echo APPLICATION_URL?>metas-020/12.html">Tratamiento médico</a></h6>
												</div><!--goal-->
											</div><!-- /Goal 12 -->	
											
											<div class="two columns"><!-- Goal 13 -->
												<div class="goal"><!--goal-->
													<a href="<?php echo APPLICATION_URL?>metas-020/13.html"><div id="goal-13" class="goal-13">
														<img src="<?php echo APPLICATION_URL?>/images/goals/big/retiro.png" alt="estudio" width="" height="" /></div>
													</a>
													<h6 class="text-center greytxt"><a href="<?php echo APPLICATION_URL?>metas-020/13.html">Retiro</a></h6>
												</div><!--goal-->
											</div><!-- /Goal 13 -->											
											
										</div><!--row-->
										
										<div class="row">
										
											<div class="two columns"><!-- Goal 14 -->
												<div class="goal"><!--goal-->
													<a href="<?php echo APPLICATION_URL?>metas-020/14.html"><div id="goal-14" class="goal-14">
														<img src="<?php echo APPLICATION_URL?>/images/goals/big/inversiones.png" alt="estudio" width="" height="" /></div>
													</a>
													<h6 class="text-center greytxt"><a href="<?php echo APPLICATION_URL?>metas-020/14.html">Inversiones</a></h6>
												</div><!--goal-->
											</div><!-- /Goal 14 -->	
											
											<!-- Goal 15<div class="two columns">
												<div class="goal">
													<a href="<?php echo APPLICATION_URL?>metas-020/15.html"><div id="goal-15" class="goal-15">
														<img src="<?php echo APPLICATION_URL?>/images/goals/big/inversion.png" alt="estudio" width="" height="" /></div>
													</a>
													<h6 class="text-center greytxt"><a href="<?php echo APPLICATION_URL?>metas-020/14.html">Comprar segunda casa</a></h6>
												</div>
											</div> -->	
											
											<div class="two columns"><!-- Goal 16 -->
												<div class="goal"><!--goal-->
													<a href="<?php echo APPLICATION_URL?>metas-020/16.html"><div id="goal-16" class="goal-16">
														<img src="<?php echo APPLICATION_URL?>/images/goals/big/remodelar.png" alt="estudio" width="" height="" /></div>
													</a>
													<h6 class="text-center greytxt"><a href="<?php echo APPLICATION_URL?>metas-020/17.html">Remodelar</a></h6>
												</div><!--goal-->
											</div><!-- /Goal 16 -->		
											
	
											<div class="two columns"><!-- Goal 17 -->
												<div class="goal"><!--goal-->
													<a href="<?php echo APPLICATION_URL?>metas-020/17.html"><div id="goal-17" class="goal-17">
														<img src="<?php echo APPLICATION_URL?>/images/goals/big/electrodomesticos.png" alt="estudio" width="" height="" /></div>
													</a>
													<h6 class="text-center greytxt"><a href="<?php echo APPLICATION_URL?>metas-020/17.html">Electrodomésticos</a></h6>
												</div><!--goal-->
											</div><!-- /Goal 17 -->	
											
											<div class="two columns"><!-- Goal 18 -->
												<div class="goal"><!--goal-->
													<a href="<?php echo APPLICATION_URL?>metas-020/18.html"><div id="goal-18" class="goal-18">
														<img src="<?php echo APPLICATION_URL?>/images/goals/big/plata-extra.png" alt="estudio" width="" height="" /></div>
													</a>
													<h6 class="text-center greytxt"><a href="<?php echo APPLICATION_URL?>metas-020/17.html">Plata extra</a></h6>
												</div><!--goal-->
											</div><!-- /Goal 18 -->	
											
											<div class="two columns"><!-- Goal 19 -->
												<div class="goal"><!--goal-->
													<a href="<?php echo APPLICATION_URL?>metas-020/19.html"><div id="goal-19" class="goal-19">
														<img src="<?php echo APPLICATION_URL?>/images/goals/big/otro.png" alt="estudio" width="" height="" /></div>
													</a>
													<h6 class="text-center greytxt"><a href="<?php echo APPLICATION_URL?>metas-020/17.html">Otro</a></h6>
												</div><!--goal-->
											</div><!-- /Goal 19 -->	

										</div>

									</div><!-- /Goals -->
								</div><!-- /12 col -->
							</div><!-- /Row -->
						</div><!-- /Container -->
					</div>
					<!-- /Content -->
					
					
					<div>
						<form id="diagnostics_form" action="<?php echo APPLICATION_URL?>diagnostico-planeacion.html" method="post">
							<input type="hidden" class="goal-input" name="user_goal_1" id="goal_1" />
							<input type="hidden" class="term-input" name="user_goal_1_term" id="goal_2_term" />
							<input type="hidden" class="goal-input" name="user_goal_2" id="goal_2" />
							<input type="hidden" class="term-input" name="user_goal_2_term" id="goal_3_term" />
							<input type="hidden" class="goal-input" name="user_goal_3" id="goal_3" />
							<input type="hidden" class="term-input" name="user_goal_3_term" id="goal_1_term" />
							<input type="hidden" name="">
						</form>
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
