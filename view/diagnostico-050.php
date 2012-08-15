<!DOCTYPE html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
	
<meta charset="utf-8" />

	<!-- Set the viewport width to device width for mobile -->
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />

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
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
	

	<!--[if lt IE 9]>
		<link rel="stylesheet" href="<?php echo APPLICATION_URL?>stylesheets/ie.css">
	<![endif]-->


	<!-- IE Fix for HTML5 Tags -->
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

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

</head>

<body>


<!--1. HEADER -->
<?php	
include_once('header.php');	
foreach ($_POST as $key=>$value)
{
	$userData 	= UserHelper::setData($user->__get('user_id'), $key, str_replace("$", "", str_replace(".", "", $value)));
}
$user			= new User($_SESSION['user_active']);
$diagnostico	= new Diagnostico($user);
//$salidas		= $diagnostico->calculate();
$diagnostico->calculateAll();
$tips			= $diagnostico->getTips();

$user			= new User($_SESSION['user_active']);
$userData 		= unserialize($user->__get('user_data'));
?>
<!--1. /HEADER -->
	


<!--2. MAIN-->
<div id="main"> 
	<div class="container principal clearfix"><!-- Container Padding 20px -->
	
<?php	
	$bread_name = array("Selección","Planeación","Consumo","Finanzas","1");
	$js_array = json_encode($bread_name);
	include_once('breadcrumbs.php');	
?>

	<!-- 2.1 Row: Content -->
	<div class="row">
		<div class="nine columns"><!-- 9 col -->
			<div class="panel-1 whitebg"><!-- panel -->
					

				
				<!-- Row -->
				<div class="row">
				    <div class="innerheader clearfix"><!-- innerheader -->
				    	<div class="inner-ribbon"><!-- inner-ribbon -->
				    		<div class="budget-title left">
				    			<h2 class="left white txt-shadow-black"><!-- ribbon title -->
				    				<div class="icon-ribbon">
				    					<span class="whitetxt" aria-hidden="true" data-icon="&#x77;"></span> 
				    				</div>
				    				<div class="title-ribbon">
				    					<p class="whitetxt small-1 txt-shadow-black no-margin">Diagnóstico</p>
				    					<strong class="whitetxt title-txt">Resultado</strong>
				    				</div>
				    			</h2><!-- /ribbon title -->
				    		</div>
				    		<div class="sprite-1 ribbon-detail left">icon</div>
				    	</div><!-- /inner-ribbon -->
				    </div><!-- /innerheader -->
				</div>
				<!--/Row -->

				<div class="descubra-main clearfix margin-top-30"><!-- Content -->
					<div class="container"><!-- Container Padding 20px -->
						<div class="row"><!-- Row Result -->

					 		<h2 class="answer"><?php echo utf8_encode($userData['salu_final_text']);?></h2>

							<div class="row"><!-- row -->

								<?php 
									$inactive = ($userData['salu_planning_final'] === "") ? true : false; 
									$gauge 	  = ($inactive) ? 0 : floor($userData['salu_planning_calification']/10);
								?>
					 			<div class="result-1 four columns <?php echo ($inactive) ? 'inactive-result' : ''; ?>"><!-- Result: Planning -->
					 			    <div class="padding-10"><!-- Padding 10 -->

										<div class="total-result-1 gauge-<?php echo $gauge;?> clearfix"><!-- Total Result -->
										    <p class="total-result-diagnostico <?php echo ($inactive) ? 'light-greytxt' : 'greytxt'; ?>"><?php echo round($userData['salu_planning_calification'], 0);?><span class="x-small light-greytxt">/100</span></p>
										</div><!-- /Total Result -->
										
										<div class="calification"><!-- Calification -->
										    <p class="light-greytxt text-center small-1 no-margin">Calificación</p>
										    <h6 class="text-center large  <?php echo ($inactive) ? 'light-greytxt' : 'greytxt'; ?>">PLANEACIÓN</h6>
										</div><!-- Calification -->
										
	            						<?php
											if (!$inactive) 
											{
										?>
										   <!--  planning text -->
										   <p class="text-center explain-1"><?php echo utf8_encode($userData['salu_planning_text'])?></p>
										   <!--  planning text -->
										<?php
											}
											else
											{
										?>
	            						   
	            						    <p class="text-center"> <!-- Inactive note -->
	            						        <a href="diagnostico-planeacion/once.html" class="greentxt"><strong>Házte un diagnóstico</strong> <span class="greentxt footer-icon large" aria-hidden="true" data-icon="&#x63;"></span></a>					 					
	            						    </p><!-- Inactive note -->                                         
	            						<?php
										}
										?>
	                                </div> <!-- Padding 10 -->       
	                            </div><!-- /Result: Planning -->
	                                
								<?php 
						
									$inactive = ($userData['salu_consumption_final'] === "") ? true : false; 
									$gauge 	  = ($inactive) ? 0 : floor($userData['salu_consumption_calification']/10);
								?>
					 			<div class="result-1 four columns <?php echo ($inactive) ? 'inactive-result' : ''; ?>"><!-- Result: Consumption -->
					 			    <div class="padding-10"><!-- Padding 10 -->

										<div class="total-result-1 gauge-<?php echo $gauge;?> clearfix"><!-- Total Result -->
										    <p class="total-result-diagnostico <?php echo ($inactive) ? 'light-greytxt' : 'greytxt'; ?>"><?php echo round($userData['salu_consumption_calification'], 0);?><span class="x-small light-greytxt">/100</span></p>
										</div><!-- /Total Result -->
										
										<div class="calification"><!-- Calification -->
										    <p class="light-greytxt text-center small-1 no-margin">Calificación</p>
										    <h6 class="text-center large  <?php echo ($inactive) ? 'light-greytxt' : 'greytxt'; ?>">CONSUMO</h6>
										</div><!-- Calification -->
										
	            						<?php
											if (!$inactive) 
											{
										?>
										   <!--  planning text -->
										   <p class="text-center explain-1"><?php echo utf8_encode($userData['salu_consumption_text'])?></p>
										   <!--  planning text -->
										<?php
											}
											else
											{
										?>
	            						   
	            						    <p class="text-center"> <!-- Inactive note -->
	            						        <a href="diagnostico-consumo/once.html" class="greentxt"><strong>Házte un diagnóstico</strong> <span class="greentxt footer-icon large" aria-hidden="true" data-icon="&#x63;"></span></a>					 					
	            						    </p><!-- Inactive note -->
	            						<?php
										}
										?>
									</div> <!-- Padding 10 -->       
								</div><!-- /Result: Consumption -->
					 				
								<?php 
									$inactive = ($userData['salu_financial_final'] === "") ? true : false; 
									$gauge 	  = ($inactive) ? 0 : floor($userData['salu_financial_calification']/10);
								?>
					 			<div class="result-1 four columns <?php echo ($inactive) ? 'inactive-result' : ''; ?>"><!-- Result: Financial -->
					 			    <div class="padding-10"><!-- Padding 10 -->

										<div class="total-result-1 gauge-<?php echo $gauge;?> clearfix"><!-- Total Result -->
										    <p class="total-result-diagnostico <?php echo ($inactive) ? 'light-greytxt' : 'greytxt'; ?>"><?php echo round($userData['salu_financial_calification'], 0);?><span class="x-small light-greytxt">/100</span></p>
										</div><!-- /Total Result -->
										
										<div class="calification"><!-- Calification -->
										    <p class="light-greytxt text-center small-1 no-margin">Calificación</p>
										    <h6 class="text-center large  <?php echo ($inactive) ? 'light-greytxt' : 'greytxt'; ?>">FINANZAS</h6>
										</div><!-- Calification -->
										
	            						<?php
											if (!$inactive) 
											{
										?>
										   <!--  planning text -->
										   <p class="text-center explain-1"><?php echo utf8_encode($userData['salu_financial_text'])?></p>
										   <!--  planning text -->
										<?php
											}
											else
											{
										?>
	            						   
	            						    <p class="text-center"> <!-- Inactive note -->
	            						        <a href="diagnostico-finanzas/once.html" class="greentxt"><strong>Házte un diagnóstico</strong> <span class="greentxt footer-icon large" aria-hidden="true" data-icon="&#x63;"></span></a>					 					
	            						    </p><!-- Inactive note -->                                         
	            						<?php
										}
										?>
									</div> <!-- /Padding 10 -->       
								</div><!-- /Result: Financial -->
							</div><!-- /row -->
					 	</div><!-- Row Result -->
					</div><!-- /Container Padding 20px -->
					
                    <?php
					if (isset($tips['ahorro']))
				  	{
						$caminos 	=  (isset($tips['prestamo'])) ? 'dos' : 'uno';
						$tipos 		=  (isset($tips['prestamo'])) ? '<strong>ahorro</strong> y <strong>crédito</strong>' : '<strong>ahorro</strong>';
					?>
					<div class="row blue-ribbon"><!-- Row Ribbon -->
						<div class="container"><!-- Container Padding 20px -->
							<div class="goal-img left">
								<img src="<?php echo APPLICATION_URL?>/images/goals/big/carro.png" alt="carro" width="94" height="94" />											</div>
							<div class="goal-way-txt left">
								<h6 class="whitetxt thin">CAMINO <strong>PARA ALCANZAR TU META</strong></h6>
								<h6 class="whitetxt thin">Para alcanzar tu meta te recomendamos <?php echo $caminos;?> caminos: <?php echo $tipos;?></h6>
							</div>
						</div><!-- /Container Padding 20px -->
					</div><!-- Row blue ribbon -->
                    <?php
					}
					if (isset($tips['ahorro']))
					{
					?>
					<div class="row save-way"><!-- Row safe way -->
						<div class="container"><!-- /Container Padding 20px -->	
							<h6 class="dark-greytxt thin"><span aria-hidden="true" data-icon="&#xe06a;"></span> CAMINO <strong>DE AHORRO</strong></h6>
							<hr />
							<h5 class="greytxt tip"><?php echo $tips['ahorro'][0]?></h5>
						
							<div class="row"><!-- Row -->
								<div class="four columns save"><!-- 4 col -->
									<div class="padding-30">
										<h6 class="uppercase greytxt">Ahorrando</h6>
										<h5 class="bluetxt">$<?php echo $tips['ahorro'][1]?></h5>
										<small class="light-greytxt">En un producto financiero de bajo riesgo</small>
									</div>
								</div><!-- /4 col -->
								
								<div class="four columns during"><!-- 4 col -->
									<div class="padding-30">
										<h6 class="uppercase greytxt">Durante</h6>
										<h5 class="bluetxt"><?php echo $tips['ahorro'][2]?></h5>
									</div>
								</div><!-- /4 col -->
								
								<div class="four columns total-save"><!-- 4 col -->
									<div class="padding-30">
										<h6 class="uppercase greytxt">Ahorras</h6>
										<h5 class="bluetxt">$<?php echo $tips['ahorro'][3]?></h5>
										<small class="light-greytxt">Con una rentabilidad de <strong>$<?php echo $tips['ahorro'][4]?></strong></small>
									</div>
								</div><!-- /4 col -->
							</div><!-- Row -->
							
							<p class="text-right"><strong><a href="" class="greentxt">Recorrer este camino <span class="greentxt footer-icon large" aria-hidden="true" data-icon="&#x63;"></span></strong></a></p>

						</div><!-- /Container Padding 20px -->	
					</div><!-- Row safe way -->
                    <?php
					}
					?>
                    <?php
					if (isset($tips['prestamo']))
					{
					?>
                    					
					<div class="row save-way"><!-- Row safe way -->
						<div class="container"><!-- /Container Padding 20px -->	
							<h6 class="dark-greytxt thin"><span aria-hidden="true" data-icon="&#xe06a;"></span> CAMINO <strong>DE CRÉDITO</strong></h6>
							<hr />
							<h5 class="greytxt tip"><?php echo $tips['prestamo'][0];?></h5>
						
							<div class="row"><!-- Row -->
								<div class="four columns save"><!-- 4 col -->
									<div class="padding-30">
										<h6 class="uppercase greytxt">Cuota</h6>
										<h5 class="bluetxt">$<?php echo $tips['prestamo'][1];?></h5>
										<small class="light-greytxt">Con una tasa de interes del 20% E.A.</small>
									</div>
								</div><!-- /4 col -->
								
								<div class="four columns during"><!-- 4 col -->
									<div class="padding-30">
										<h6 class="uppercase greytxt">Durante</h6>
										<h5 class="bluetxt"><?php echo $tips['prestamo'][2];?></h5>
									</div>
								</div><!-- /4 col -->
								
								<div class="four columns total-save"><!-- 4 col -->
									<div class="padding-30">
										<h6 class="uppercase greytxt">Crédito por</h6>
										<h5 class="bluetxt">$<?php echo $tips['prestamo'][3];?></h5>
										<small class="light-greytxt">Con un pago de intereses total de <strong>$<?php echo $tips['prestamo'][4];?></strong></small>
									</div>
								</div><!-- /4 col -->
							</div><!-- Row -->
							
							<p class="text-right"><strong><a href="" class="greentxt">Recorrer este camino <span class="greentxt footer-icon large" aria-hidden="true" data-icon="&#x63;"></span></strong></a></p>

						</div><!-- /Container Padding 20px -->	
					</div><!-- Row safe way -->
                    <?php
					}
					?>
					
				</div><!-- /Content -->
					


 
					
					


			</div> <!-- /panel -->
			<div class="shadow"><img src="<?php echo APPLICATION_URL?>images/shadow.png" alt="" width="" height=""></div>
		</div><!-- /9 col -->
			
		<div class="three columns"><!-- Sidebar -->

			<div class="bluebox-fixed box-shadow round-1"><!-- bluebox -->
			    <div class="padding-10"><!-- /Padding 10 -->
			    	<!-- title -->
			    	<h6 class="thin whitetxt text-center large txt-shadow-black">PROMEDIO <strong>GENERAL</strong></h6>
			    	<p class="whitetxt text-center small-1 txt-shadow-black no-margin">(Planeación, consumo, finanzas)</p>
			    	<!-- /title -->
			     	<?php
					$inactive	= ($userData['salu_final_final'] === "") ?  true : false;
					$gauge 		= ($inactive) ? 0 : floor($userData['salu_final_final']/10);
					?>
			     	<!-- total result -->
			     	<div class="total-result-1 clearfix  gauge-<?php echo $gauge;?>">
			     		<p class="whitetxt total-result-diagnostico"><?php echo ($userData['salu_final_final'] == 0) ? 0 : round($userData['salu_final_final'], 0);?><span class="x-small">/100</span></p>
			     	</div>
			     	<!-- total result -->

			     	<!-- calification -->
			     	<div class="calification">
			     		<p class="light-greytxt text-center small-1 txt-shadow-black no-margin">Calificación</p>
			     		<h6 class="whitetxt text-center large txt-shadow-black">DIAGNÓSTICO</h6>
			     	</div><!-- calification -->
				</div><!-- /Padding 10 -->
			</div><!-- bluebox -->

			<div class="shadow"><!-- bluebox tail -->
				<img src="<?php echo APPLICATION_URL?>images/sidebar-tail.png" alt="sidebar-tail" width="" height="" />
			</div><!-- bluebox tail -->
				
								
			<div class="next-steps-block clearfix"><!-- Next steps -->
				<!-- title -->
				<h6 class="next-step-title dark-greytxt txt-shadow-white">Próximos <strong>Pasos</strong></h6>
				<p class="greytxt explain-1">Según tu diagnóstico te recomendamos usar las siguientes herramientas</p>
				<!-- /title -->	
				
				<ul class="next-steps"> <!-- nav-var -->
					<li>
					    <a href="<?php echo APPLICATION_URL?>metas-000.html">
					    	<span class="nav-icon dark-greytxt" aria-hidden="true" data-icon="&#x65;"></span> 
					    	<span class="nav-text dark-greytxt"><strong>Metas</strong> <span class="dark-greytxt footer-icon large" aria-hidden="true" data-icon="&#x63;"></span> <br /><span class="thin x-small uppercase">Alcanza tu meta</span></span>
					    </a>
					</li>
					
					<li>
					    <a href="<?php echo APPLICATION_URL?>descubra-000.html">
					    	<span class="nav-icon dark-greytxt" aria-hidden="true" data-icon="&#x72;"></span> 
					    	<span class="nav-text dark-greytxt"><strong>Descubra</strong> <span class="dark-greytxt footer-icon large" aria-hidden="true" data-icon="&#x63;"></span> <br /><span class="thin x-small uppercase">Identifica el producto</span></span>
					    </a>
					</li>
					<li>
					    <a href="<?php echo APPLICATION_URL?>sobres-000.html">
					    	<span class="nav-icon dark-greytxt" aria-hidden="true" data-icon="&#x74;"></span> 
					    	<span class="nav-text dark-greytxt"><strong>Sobres</strong> <span class="dark-greytxt footer-icon large" aria-hidden="true" data-icon="&#x63;"></span> <br /><span class="thin x-small uppercase">Finanzas personales</span></span>
					    </a>
					</li>
				</ul> <!-- /nav-var -->

			</div><!-- Next steps -->

		</div><!-- /Sidebar -->

	</div><!-- /Row: Content -->

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
