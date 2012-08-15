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
	<script language="JavaScript" src="<?php echo APPLICATION_URL?>javascripts/metas-goals.js" ></script>
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
			if($('#user_goal_1').length == 0) {
				parseAlert(1, Array("Debe escoger al menos una meta."))
				
				return false;
			}
			else {
				$('#diagnostics_form').attr("action", '<?php echo APPLICATION_URL?>metas-020/'+$('#user_goal_1').val()+'/'+$('#user_goal_term_1').val()+'.html')
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
	$bread_name = array("Selección");
	$js_array = json_encode($bread_name);
	include_once('breadcrumbs-metas.php');	
?>
		<!-- 2.1 Row: Content -->
		<div class="row">
			<div class="twelve columns"><!-- Main Panel Width -->
				<div class="panel-1 grad3"> <!-- panel -->

					<div class="row"><!-- Main Row -->
					    <div class="goal-block-main3 grad2 left clearfix"><!-- 8 col -->
					    
					        <div class="container margin-top-30"><!-- container -->
					       		 <h5 class="greytxt no-margin"><strong>¿Cúales es tu meta y cuando la quieres hacer realidad?</strong></h5>
					        	<p class="no-margin">Haz click en tu meta y programala</p>

					        	<div class="goals-block"><!-- Goals -->
					        		
					        		<div class="row">	
					        			<div class="three columns"><!-- Goal 1 -->
					        				<div class="goal" id="goal-1">
							        			<!-- tooltip -->
							        			<div class="goal-toltip box-shadow-1 round-1" style="display:none;" >
							        				<div class="tooltip-block">
							        					<div class="padding-5">
							        						<h6 class="text-left whitetxt small">¿Cuando realizarías tu meta?
							        						<div class="right">
							        							<a href="" class="light-greytxt close-goal-tooltip">
							        								<span class="small" aria-hidden="true" data-icon="&#x6a;"></span>
							        							</a>
							        						</div>
							        						</h6>
							        						<table class="date-select">
							        							<tr>

							        								<td>
							        								<strong class="whitetxt">Año</strong>
							        								<select class="year-select" id="year-1">
							        									<?php 
							        									foreach(range(date('Y'), (date('Y') + 15)) as $number)
																		{
																			if($number < 10)
																				$number = '0' . $number;
																			?>
																			<option value="<?php echo $number?>"><?php echo $number?></option>
																			<?php
																		}
																		?>
							        								</select>
							        								</td>
							        								
							        								<td>
							        								<strong class="whitetxt">Mes</strong>
							        								<select id="month-1">
							        									<?php 
							        									foreach(range(1, 12) as $number)
																		{
																			if($number < 10)
																				$number = '0' . $number;
																			?>
																			<option value="<?php echo $number?>"><?php echo date('M', strtotime('2012-' . $number . '-01')); ?></option>
																			<?php
																		}
																		?>
							        								
							        								</select>
							        								</td>
							        							</tr>
							        						</table>
							        						
							        						 
							        						<hr class="dotted-2" />
							        						<a href="" class="small-pretty-btn right save-goal" rel="1">Guardar meta</a>
							        					 <div class="arrow-left"></div>
							        					 </div>
							        					
							        				</div>
							        			</div>
							        			<!--/tooltip -->						        				
					        					<div id="goal-1" class="goal-1"><img src="<?php echo APPLICATION_URL?>/images/goals/big/estudio.png" alt="estudio" width="" height="" /></div>
					        					<h6 class="text-center greytxt">Estudio</h6>
					        					<!--p class="text-center no-margin small light-greytext"><span class="greentxt" aria-hidden="true" data-icon="&#x73;"></span> 30 de julio</p-->
					        				</div>
					        			</div><!-- /Goal 1 -->
					        			
					        			<div class="three columns"><!-- Goal 2 -->
					        				<div class="goal" id="goal-2">
												<!-- tooltip -->
												<div class="goal-toltip box-shadow-1 round-1" style="display:none;" >
													<div class="tooltip-block">
														<div class="padding-5">
															<h6 class="text-left whitetxt small">¿Cuando realizarías tu meta?
															<div class="right">
																<a href="" class="light-greytxt close-goal-tooltip">
																	<span class="small" aria-hidden="true" data-icon="&#x6a;"></span>
																</a>
															</div>
															</h6>
															<table class="date-select">
																<tr>

							        								<td>
							        								<strong class="whitetxt">Año</strong>
							        								<select class="year-select" id="year-2">
							        									<?php 
							        									foreach(range(date('Y'), (date('Y') + 15)) as $number)
																		{
																			if($number < 10)
																				$number = '0' . $number;
																			?>
																			<option value="<?php echo $number?>"><?php echo $number?></option>
																			<?php
																		}
																		?>
																	</select>
																	</td>
																	<td>
																	<strong class="whitetxt">Mes</strong>
							        								<select id="month-2">
							        									<?php 
							        									foreach(range(1, 12) as $number)
																		{
																			if($number < 10)
																				$number = '0' . $number;
																			?>
																			<option value="<?php echo $number?>"><?php echo date('M', strtotime('2012-' . $number . '-01')); ?></option>
																			<?php
																		}
																		?>
							        								
							        								</select>
							        								</td>
																</tr>
															</table>
															
															 
															<hr class="dotted-2" />
															<a href="" class="small-pretty-btn right save-goal" rel="2">Guardar meta</a>
														 <div class="arrow-left"></div>
														 </div>
														
													</div>
												</div>
												<!--/tooltip -->	
					        					<div id="goal-2" class="goal-2"><img src="<?php echo APPLICATION_URL?>/images/goals/big/emergencia.png" alt="emergencia" width="" height="" /></div>
					        					<h6 class="text-center greytxt">Emergencias</h6>
					        				</div>
					        			</div><!-- /Goal 2 -->
					        			
					        			<div class="three columns"><!-- Goal 3 -->
					        				<div class="goal" id="goal-3">
							        			<!-- tooltip -->
							        			<div class="goal-toltip box-shadow-1 round-1" style="display:none;" >
							        				<div class="tooltip-block">
							        					<div class="padding-5">
							        						<h6 class="text-left whitetxt small">¿Cuando realizarías tu meta?
							        						<div class="right">
							        							<a href="" class="light-greytxt close-goal-tooltip">
							        								<span class="small" aria-hidden="true" data-icon="&#x6a;"></span>
							        							</a>
							        						</div>
							        						</h6>
							        						<table class="date-select">
							        							<tr>
							        								
							        								<td>
							        								<strong class="whitetxt">Año</strong>
							        								<select class="year-select" id="year-3">
							        									<?php 
							        									foreach(range(date('Y'), (date('Y') + 15)) as $number)
																		{
																			if($number < 10)
																				$number = '0' . $number;
																			?>
																			<option value="<?php echo $number?>"><?php echo $number?></option>
																			<?php
																		}
																		?>
							        								</select>
							        								</td>
							        								<td>
							        								<strong class="whitetxt">Mes</strong>
							        								<select id="month-3">
							        									<?php 
							        									foreach(range(1, 12) as $number)
																		{
																			if($number < 10)
																				$number = '0' . $number;
																			?>
																			<option value="<?php echo $number?>"><?php echo date('M', strtotime('2012-' . $number . '-01')); ?></option>
																			<?php
																		}
																		?>
							        								
							        								</select>
							        								</td>
							        							</tr>
							        						</table>
							        						
							        						 
							        						<hr class="dotted-2" />
							        						<a href="" class="small-pretty-btn right save-goal" rel="3">Guardar meta</a>
							        					 <div class="arrow-left"></div>
							        					 </div>
							        					
							        				</div>
							        			</div>
							        			<!--/tooltip -->	
					        					<div class="goal-3"><img src="<?php echo APPLICATION_URL?>/images/goals/big/carro.png" alt="carro" width="" height="" /></div>
					        					<h6 class="text-center greytxt">Carro</h6>
					        				</div>
					        			</div><!-- /Goal 3 -->
					        			
					        			<div class="three columns"><!-- Goal 4 -->
					        				<div class="goal" id="goal-4">
							        			<!-- tooltip -->
							        			<div class="goal-toltip box-shadow-1 round-1" style="display:none;" >
							        				<div class="tooltip-block">
							        					<div class="padding-5">
							        						<h6 class="text-left whitetxt small">¿Cuando realizarías tu meta?
							        						<div class="right">
							        							<a href="" class="light-greytxt close-goal-tooltip">
							        								<span class="small" aria-hidden="true" data-icon="&#x6a;"></span>
							        							</a>
							        						</div>
							        						</h6>
							        						<table class="date-select">
							        							<tr>
							        								
							        								<td>
							        								<strong class="whitetxt">Año</strong>
							        								<select class="year-select" id="year-4">
							        									<?php 
							        									foreach(range(date('Y'), (date('Y') + 15)) as $number)
																		{
																			if($number < 10)
																				$number = '0' . $number;
																			?>
																			<option value="<?php echo $number?>"><?php echo $number?></option>
																			<?php
																		}
																		?>
							        								</select>
							        								</td>
							        								
							        								<td>
							        								<strong class="whitetxt">Mes</strong>
							        								<select id="month-4">
							        									<?php 
							        									foreach(range(1, 12) as $number)
																		{
																			if($number < 10)
																				$number = '0' . $number;
																			?>
																			<option value="<?php echo $number?>"><?php echo date('M', strtotime('2012-' . $number . '-01')); ?></option>
																			<?php
																		}
																		?>
							        								
							        								</select>
							        								</td>
							        							</tr>
							        						</table>
							        						
							        						 
							        						<hr class="dotted-2" />
							        						<a href="" class="small-pretty-btn right save-goal" rel="4">Guardar meta</a>
							        					 <div class="arrow-left"></div>
							        					 </div>
							        					
							        				</div>
							        			</div>
							        			<!--/tooltip -->	
					        					<div class="goal-4"><img src="<?php echo APPLICATION_URL?>/images/goals/big/moto.png" alt="moto" width="" height="" /></div>
					        					<h6 class="text-center greytxt">Moto</h6>
					        				</div>
					        			</div><!-- /Goal 4 -->
					        		</div>

					        		<div class="row">
					        			<div class="three columns"><!-- Goal 6 -->
					        				<div class="goal" id="goal-6">
							        			<!-- tooltip -->
							        			<div class="goal-toltip box-shadow-1 round-1" style="display:none;" >
							        				<div class="tooltip-block">
							        					<div class="padding-5">
							        						<h6 class="text-left whitetxt small">¿Cuando realizarías tu meta?
							        						<div class="right">
							        							<a href="" class="light-greytxt close-goal-tooltip">
							        								<span class="small" aria-hidden="true" data-icon="&#x6a;"></span>
							        							</a>
							        						</div>
							        						</h6>
							        						<table class="date-select">
							        							<tr>
		
							        								<td>
							        								<strong class="whitetxt">Año</strong>
							        								<select class="year-select" id="year-5">
							        									<?php 
							        									foreach(range(date('Y'), (date('Y') + 15)) as $number)
																		{
																			if($number < 10)
																				$number = '0' . $number;
																			?>
																			<option value="<?php echo $number?>"><?php echo $number?></option>
																			<?php
																		}
																		?>
							        								</select>
							        								</td>
							        								<td>
							        								<strong class="whitetxt">Mes</strong>
							        								<select id="month-5">
							        									<?php 
							        									foreach(range(1, 12) as $number)
																		{
																			if($number < 10)
																				$number = '0' . $number;
																			?>
																			<option value="<?php echo $number?>"><?php echo date('M', strtotime('2012-' . $number . '-01')); ?></option>
																			<?php
																		}
																		?>
							        								
							        								</select>
							        								</td>
							        							</tr>
							        						</table>
							        						
							        						 
							        						<hr class="dotted-2" />
							        						<a href="" class="small-pretty-btn right save-goal" rel="5">Guardar meta</a>
							        					 <div class="arrow-left"></div>
							        					 </div>
							        					
							        				</div>
							        			</div>
							        			<!--/tooltip -->	
					        					<div class="goal-6"><img src="<?php echo APPLICATION_URL?>/images/goals/big/matrimonio.png" alt="matrimonio" width="" height="" /></div>
					        					<h6 class="text-center greytxt">Matrimonio</h6>
					        				</div>
					        			</div><!-- /Goal 6 -->
	
					        			<div class="three columns"><!-- Goal 7 -->
					        				<div class="goal" id="goal-7">
							        			<!-- tooltip -->
							        			<div class="goal-toltip box-shadow-1 round-1" style="display:none;" >
							        				<div class="tooltip-block">
							        					<div class="padding-5">
							        						<h6 class="text-left whitetxt small">¿Cuando realizarías tu meta?
							        						<div class="right">
							        							<a href="" class="light-greytxt close-goal-tooltip">
							        								<span class="small" aria-hidden="true" data-icon="&#x6a;"></span>
							        							</a>
							        						</div>
							        						</h6>
							        						<table class="date-select">
							        							<tr>

							        								<td>
							        								<strong class="whitetxt">Año</strong>
							        								<select class="year-select" id="year-6">
							        									<?php 
							        									foreach(range(date('Y'), (date('Y') + 15)) as $number)
																		{
																			if($number < 10)
																				$number = '0' . $number;
																			?>
																			<option value="<?php echo $number?>"><?php echo $number?></option>
																			<?php
																		}
																		?>
							        								</select>
							        								</td>
							        								
							        								<td>
							        								<strong class="whitetxt">Mes</strong>
							        								<select id="month-6">
							        									<?php 
							        									foreach(range(1, 12) as $number)
																		{
																			if($number < 10)
																				$number = '0' . $number;
																			?>
																			<option value="<?php echo $number?>"><?php echo date('M', strtotime('2012-' . $number . '-01')); ?></option>
																			<?php
																		}
																		?>
							        								
							        								</select>
							        								</td>
							        							</tr>
							        						</table>
							        						
							        						 
							        						<hr class="dotted-2" />
							        						<a href="" class="small-pretty-btn right save-goal" rel="6">Guardar meta</a>
							        					 <div class="arrow-left"></div>
							        					 </div>
							        					
							        				</div>
							        			</div>
							        			<!--/tooltip -->	
					        					<div class="goal-7"><img src="<?php echo APPLICATION_URL?>/images/goals/big/tener-hijo.png" alt="Tener un hijo" width="" height="" /></div>
					        					<h6 class="text-center greytxt">Tener un hijo</h6>
					        				</div>
					        			</div><!-- /Goal 7 -->										
					        		
					        			
					        			<div class="three columns"><!-- Goal 8 -->
					        				<div class="goal" id="goal-8">
							        			<!-- tooltip -->
							        			<div class="goal-toltip box-shadow-1 round-1" style="display:none;" >
							        				<div class="tooltip-block">
							        					<div class="padding-5">
							        						<h6 class="text-left whitetxt small">¿Cuando realizarías tu meta?
							        						<div class="right">
							        							<a href="" class="light-greytxt close-goal-tooltip">
							        								<span class="small" aria-hidden="true" data-icon="&#x6a;"></span>
							        							</a>
							        						</div>
							        						</h6>
							        						<table class="date-select">
							        							<tr>

							        								<td>
							        								<strong class="whitetxt">Año</strong>
							        								<select class="year-select" id="year-7">
							        									<?php 
							        									foreach(range(date('Y'), (date('Y') + 15)) as $number)
																		{
																			if($number < 10)
																				$number = '0' . $number;
																			?>
																			<option value="<?php echo $number?>"><?php echo $number?></option>
																			<?php
																		}
																		?>
							        								</select>
							        								</td>
							        								<td>
							        								<strong class="whitetxt">Mes</strong>
							        								<select id="month-7">
							        									<?php 
							        									foreach(range(1, 12) as $number)
																		{
																			if($number < 10)
																				$number = '0' . $number;
																			?>
																			<option value="<?php echo $number?>"><?php echo date('M', strtotime('2012-' . $number . '-01')); ?></option>
																			<?php
																		}
																		?>
							        								
							        								</select>
							        								</td>
							        							</tr>
							        						</table>
							        						
							        						 
							        						<hr class="dotted-2" />
							        						<a href="" class="small-pretty-btn right save-goal" rel="7">Guardar meta</a>
							        					 <div class="arrow-left"></div>
							        					 </div>
							        					
							        				</div>
							        			</div>
							        			<!--/tooltip -->	
					        					<div class="goal-8"><img src="<?php echo APPLICATION_URL?>/images/goals/big/estudio-hijos.png" alt="Estudio hijos" width="" height="" /></div>
					        					<h6 class="text-center greytxt">Estudio de hijos</h6>
					        				</div>
					        			</div><!-- /Goal 8 -->
					        			
					        		
					        			<div class="three columns"><!-- Goal 9 -->
					        				<div class="goal" id="goal-9">
					        				
							        			<!-- tooltip -->
							        			<div class="goal-toltip box-shadow-1 round-1" style="display:none;" >
							        				<div class="tooltip-block">
							        					<div class="padding-5">
							        						<h6 class="text-left whitetxt small">¿Cuando realizarías tu meta?
							        						<div class="right">
							        							<a href="" class="light-greytxt close-goal-tooltip">
							        								<span class="small" aria-hidden="true" data-icon="&#x6a;"></span>
							        							</a>
							        						</div>
							        						</h6>
							        						<table class="date-select">
							        							<tr>

							        								<td>
							        								<strong class="whitetxt">Año</strong>
							        								<select class="year-select" id="year-8">
							        									<?php 
							        									foreach(range(date('Y'), (date('Y') + 15)) as $number)
																		{
																			if($number < 10)
																				$number = '0' . $number;
																			?>
																			<option value="<?php echo $number?>"><?php echo $number?></option>
																			<?php
																		}
																		?>
							        								</select>
							        								</td>
							        								<td>
							        								<strong class="whitetxt">Mes</strong>
							        								<select id="month-8">
							        									<?php 
							        									foreach(range(1, 12) as $number)
																		{
																			if($number < 10)
																				$number = '0' . $number;
																			?>
																			<option value="<?php echo $number?>"><?php echo date('M', strtotime('2012-' . $number . '-01')); ?></option>
																			<?php
																		}
																		?>
							        								
							        								</select>
							        								</td>
							        							</tr>
							        						</table>
							        						
							        						 
							        						<hr class="dotted-2" />
							        						<a href="" class="small-pretty-btn right save-goal" rel="8">Guardar meta</a>
							        					 <div class="arrow-left"></div>
							        					 </div>
							        					
							        				</div>
							        			</div>
							        			<!--/tooltip -->	
							        			
					        					<div class="goal-9"><img src="<?php echo APPLICATION_URL?>/images/goals/big/empezar-negocio.png" alt="Empezar negocio" width="" height="" /></div>
					        					<h6 class="text-center greytxt">Empezar un negocio</h6>
					        				</div>
					        			</div><!-- /Goal 9 -->
					        			
					        		</div>
					        		
					        		<div class="row">
					        			<div class="three columns"><!-- Goal 10 -->
					        				<div class="goal" id="goal-10">
							        			<!-- tooltip -->
							        			<div class="goal-toltip box-shadow-1 round-1" style="display:none;" >
							        				<div class="tooltip-block">
							        					<div class="padding-5">
							        						<h6 class="text-left whitetxt small">¿Cuando realizarías tu meta?
							        						<div class="right">
							        							<a href="" class="light-greytxt close-goal-tooltip">
							        								<span class="small" aria-hidden="true" data-icon="&#x6a;"></span>
							        							</a>
							        						</div>
							        						</h6>
							        						<table class="date-select">
							        							<tr>

							        								<td>
							        								<strong class="whitetxt">Año</strong>
							        								<select class="year-select" id="year-9">
							        									<?php 
							        									foreach(range(date('Y'), (date('Y') + 15)) as $number)
																		{
																			if($number < 10)
																				$number = '0' . $number;
																			?>
																			<option value="<?php echo $number?>"><?php echo $number?></option>
																			<?php
																		}
																		?>
							        								</select>
							        								</td>
							        								
							        								<td>
							        								<strong class="whitetxt">Mes</strong>
							        								<select id="month-9">
							        									<?php 
							        									foreach(range(1, 12) as $number)
																		{
																			if($number < 10)
																				$number = '0' . $number;
																			?>
																			<option value="<?php echo $number?>"><?php echo date('M', strtotime('2012-' . $number . '-01')); ?></option>
																			<?php
																		}
																		?>
							        								
							        								</select>
							        								</td>
							        							</tr>
							        						</table>
							        						
							        						 
							        						<hr class="dotted-2" />
							        						<a href="" class="small-pretty-btn right save-goal" rel="9">Guardar meta</a>
							        					 <div class="arrow-left"></div>
							        					 </div>
							        					
							        				</div>
							        			</div>
							        			<!--/tooltip -->	
					        			
					        					<div class="goal-10"><img src="<?php echo APPLICATION_URL?>/images/goals/big/pagar-deudas.png" alt="PAgar deudas" width="" height="" /></div>
					        					<h6 class="text-center greytxt">Pagar deudas</h6>
					        				</div>
					        			</div><!-- /Goal 10 -->
					        			<div class="three columns"><!-- Goal 11 -->
					        				<div class="goal" id="goal-11">
							        			<!-- tooltip -->
							        			<div class="goal-toltip box-shadow-1 round-1" style="display:none;" >
							        				<div class="tooltip-block">
							        					<div class="padding-5">
							        						<h6 class="text-left whitetxt small">¿Cuando realizarías tu meta?
							        						<div class="right">
							        							<a href="" class="light-greytxt close-goal-tooltip">
							        								<span class="small" aria-hidden="true" data-icon="&#x6a;"></span>
							        							</a>
							        						</div>
							        						</h6>
							        						<table class="date-select">
							        							<tr>

							        								<td>
							        								<strong class="whitetxt">Año</strong>
							        								<select class="year-select" id="year-10">
							        									<?php 
							        									foreach(range(date('Y'), (date('Y') + 15)) as $number)
																		{
																			if($number < 10)
																				$number = '0' . $number;
																			?>
																			<option value="<?php echo $number?>"><?php echo $number?></option>
																			<?php
																		}
																		?>
							        								</select>
							        								</td>
							        								
							        								<td>
							        								<strong class="whitetxt">Mes</strong>
							        								<select id="month-10">
							        									<?php 
							        									foreach(range(1, 12) as $number)
																		{
																			if($number < 10)
																				$number = '0' . $number;
																			?>
																			<option value="<?php echo $number?>"><?php echo date('M', strtotime('2012-' . $number . '-01')); ?></option>
																			<?php
																		}
																		?>
							        								
							        								</select>
							        								</td>
							        							</tr>
							        						</table>
							        						
							        						 
							        						<hr class="dotted-2" />
							        						<a href="" class="small-pretty-btn right save-goal" rel="10">Guardar meta</a>
							        					 <div class="arrow-left"></div>
							        					 </div>
							        					
							        				</div>
							        			</div>
							        			<!--/tooltip -->	
					        					<div class="goal-11"><img src="<?php echo APPLICATION_URL?>/images/goals/big/vacaciones.png" alt="Vacaciones" width="" height="" /></div>
					        					<h6 class="text-center greytxt">Vacaciones</h6>
					        				</div>
					        			</div><!-- /Goal 11 -->
					        			<div class="three columns"><!-- Goal 12 -->
					        				<div class="goal" id="goal-12">
							        			<!-- tooltip -->
							        			<div class="goal-toltip box-shadow-1 round-1" style="display:none;" >
							        				<div class="tooltip-block">
							        					<div class="padding-5">
							        						<h6 class="text-left whitetxt small">¿Cuando realizarías tu meta?
							        						<div class="right">
							        							<a href="" class="light-greytxt close-goal-tooltip">
							        								<span class="small" aria-hidden="true" data-icon="&#x6a;"></span>
							        							</a>
							        						</div>
							        						</h6>
							        						<table class="date-select">
							        							<tr>

							        								<td>
							        								<strong class="whitetxt">Año</strong>
							        								<select class="year-select" id="year-11">
							        									<?php 
							        									foreach(range(date('Y'), (date('Y') + 15)) as $number)
																		{
																			if($number < 10)
																				$number = '0' . $number;
																			?>
																			<option value="<?php echo $number?>"><?php echo $number?></option>
																			<?php
																		}
																		?>
							        								</select>
							        								</td>
							        								
							        								<td>
							        								<strong class="whitetxt">Mes</strong>
							        								<select id="month-11">
							        									<?php 
							        									foreach(range(1, 12) as $number)
																		{
																			if($number < 10)
																				$number = '0' . $number;
																			?>
																			<option value="<?php echo $number?>"><?php echo date('M', strtotime('2012-' . $number . '-01')); ?></option>
																			<?php
																		}
																		?>
							        								
							        								</select>
							        								</td>
							        							</tr>
							        						</table>
							        						
							        						 
							        						<hr class="dotted-2" />
							        						<a href="" class="small-pretty-btn right save-goal" rel="11">Guardar meta</a>
							        					 <div class="arrow-left"></div>
							        					 </div>
							        					
							        				</div>
							        			</div>
							        			<!--/tooltip -->	
					        					<div class="goal-12"><img src="<?php echo APPLICATION_URL?>/images/goals/big/tratamiento-medico.png" alt="Tratamiento médico" width="" height="" /></div>
					        					<h6 class="text-center greytxt">Tratamiento médico</h6>
					        				</div>
					        			</div>
					        		
					        			<div class="three columns"><!-- Goal 13 -->
					        				<div class="goal" id="goal-13">
							        			<!-- tooltip -->
							        			<div class="goal-toltip box-shadow-1 round-1" style="display:none;" >
							        				<div class="tooltip-block">
							        					<div class="padding-5">
							        						<h6 class="text-left whitetxt small">¿Cuando realizarías tu meta?
							        						<div class="right">
							        							<a href="" class="light-greytxt close-goal-tooltip">
							        								<span class="small" aria-hidden="true" data-icon="&#x6a;"></span>
							        							</a>
							        						</div>
							        						</h6>
							        						<table class="date-select">
							        							<tr>

							        								<td>
							        								<strong class="whitetxt">Año</strong>
							        								<select class="year-select" id="year-12">
							        									<?php 
							        									foreach(range(date('Y'), (date('Y') + 15)) as $number)
																		{
																			if($number < 10)
																				$number = '0' . $number;
																			?>
																			<option value="<?php echo $number?>"><?php echo $number?></option>
																			<?php
																		}
																		?>
							        								</select>
							        								</td>
							        								
							        								<td>
							        								<strong class="whitetxt">Mes</strong>
							        								<select id="month-12">
							        									<?php 
							        									foreach(range(1, 12) as $number)
																		{
																			if($number < 10)
																				$number = '0' . $number;
																			?>
																			<option value="<?php echo $number?>"><?php echo date('M', strtotime('2012-' . $number . '-01')); ?></option>
																			<?php
																		}
																		?>
							        								
							        								</select>
							        								</td>
							        							</tr>
							        						</table>
							        						
							        						 
							        						<hr class="dotted-2" />
							        						<a href="" class="small-pretty-btn right save-goal" rel="12">Guardar meta</a>
							        					 <div class="arrow-left"></div>
							        					 </div>
							        					
							        				</div>
							        			</div>
							        			<!--/tooltip -->	
					        					<div class="goal-13"><img src="<?php echo APPLICATION_URL?>/images/goals/big/retiro.png" alt="Retiro" width="" height="" /></div>
					        					<h6 class="text-center greytxt">Retiro</h6>
					        				</div>
					        			</div><!-- /Goal 13 -->										
					        		</div>
					        		
					        		<div class="row">
	

	
					        			<div class="three columns"><!-- Goal 16 -->
					        				<div class="goal" id="goal-16">
							        			<!-- tooltip -->
							        			<div class="goal-toltip box-shadow-1 round-1" style="display:none;" >
							        				<div class="tooltip-block">
							        					<div class="padding-5">
							        						<h6 class="text-left whitetxt small">¿Cuando realizarías tu meta?
							        						<div class="right">
							        							<a href="" class="light-greytxt close-goal-tooltip">
							        								<span class="small" aria-hidden="true" data-icon="&#x6a;"></span>
							        							</a>
							        						</div>
							        						</h6>
							        						<table class="date-select">

							        								<td>
							        								<strong class="whitetxt">Año</strong>
							        								<select class="year-select" id="year-13">
							        									<?php 
							        									foreach(range(date('Y'), (date('Y') + 15)) as $number)
																		{
																			if($number < 10)
																				$number = '0' . $number;
																			?>
																			<option value="<?php echo $number?>"><?php echo $number?></option>
																			<?php
																		}
																		?>
							        								</select>
							        								</td>
							        								
							        								<tr>
							        								<td>
							        								<strong class="whitetxt">Mes</strong>
							        								<select id="month-13">
							        									<?php 
							        									foreach(range(1, 12) as $number)
																		{
																			if($number < 10)
																				$number = '0' . $number;
																			?>
																			<option value="<?php echo $number?>"><?php echo date('M', strtotime('2012-' . $number . '-01')); ?></option>
																			<?php
																		}
																		?>
							        								
							        								</select>
							        								</td>
							        							</tr>
							        						</table>
							        						
							        						 
							        						<hr class="dotted-2" />
							        						<a href="" class="small-pretty-btn right save-goal" rel="13">Guardar meta</a>
							        					 <div class="arrow-left"></div>
							        					 </div>
							        					
							        				</div>
							        			</div>
							        			<!--/tooltip -->	
					        					<div class="goal-16"><img src="<?php echo APPLICATION_URL?>/images/goals/big/remodelar.png" alt="Remodelar" width="" height="" /></div>
					        					<h6 class="text-center greytxt">Remodelar</h6>
					        				</div>
					        			</div><!-- /Goal 16 -->
					        			<div class="three columns"><!-- Goal 17 -->
					        				<div class="goal" id="goal-17">
							        			<!-- tooltip -->
							        			<div class="goal-toltip box-shadow-1 round-1" style="display:none;" >
							        				<div class="tooltip-block">
							        					<div class="padding-5">
							        						<h6 class="text-left whitetxt small">¿Cuando realizarías tu meta?
							        						<div class="right">
							        							<a href="" class="light-greytxt close-goal-tooltip">
							        								<span class="small" aria-hidden="true" data-icon="&#x6a;"></span>
							        							</a>
							        						</div>
							        						</h6>
							        						<table class="date-select">
							        							<tr>
	
							        								<td>
							        								<strong class="whitetxt">Año</strong>
							        								<select class="year-select" id="year-14">
							        									<?php 
							        									foreach(range(date('Y'), (date('Y') + 15)) as $number)
																		{
																			if($number < 10)
																				$number = '0' . $number;
																			?>
																			<option value="<?php echo $number?>"><?php echo $number?></option>
																			<?php
																		}
																		?>
							        								</select>
							        								</td>
							        								
							        								<td>
							        								<strong class="whitetxt">Mes</strong>
							        								<select id="month-14">
							        									<?php 
							        									foreach(range(1, 12) as $number)
																		{
																			if($number < 10)
																				$number = '0' . $number;
																			?>
																			<option value="<?php echo $number?>"><?php echo date('M', strtotime('2012-' . $number . '-01')); ?></option>
																			<?php
																		}
																		?>
							        								
							        								</select>
							        								</td>
							        							</tr>
							        						</table>
							        						
							        						 
							        						<hr class="dotted-2" />
							        						<a href="" class="small-pretty-btn right save-goal" rel="14">Guardar meta</a>
							        					 <div class="arrow-left"></div>
							        					 </div>
							        					
							        				</div>
							        			</div>
							        			<!--/tooltip -->	
					        					<div class="goal-17"><img src="<?php echo APPLICATION_URL?>/images/goals/big/electrodomesticos.png" alt="Comprar electrodomésticos" width="" height="" /></div>
					        					<h6 class="text-center  greytxt">Electrodomésticos</h6>
					        				</div>
					        			</div><!-- /Goal 17 -->
					        			
					        			<div class="three columns"><!-- Goal 18 -->
					        				<div class="goal" id="goal-18">
							        			<!-- tooltip -->
							        			<div class="goal-toltip box-shadow-1 round-1" >
							        				<div class="tooltip-block">
							        					<div class="padding-5">
							        						<h6 class="text-left whitetxt small">¿Cuando realizarías tu meta?
							        						<div class="right">
							        							<a href="" class="light-greytxt close-goal-tooltip">
							        								<span class="small" aria-hidden="true" data-icon="&#x6a;"></span>
							        							</a>
							        						</div>
							        						</h6>
							        						<table class="date-select">
							        							<tr>

							        								<td>
							        								<strong class="whitetxt">Año</strong>
							        								<select class="year-select" id="year-15">
							        									<?php 
							        									foreach(range(date('Y'), (date('Y') + 15)) as $number)
																		{
																			if($number < 10)
																				$number = '0' . $number;
																			?>
																			<option value="<?php echo $number?>"><?php echo $number?></option>
																			<?php
																		}
																		?>
							        								</select>
							        								</td>
							        								<td>
							        								<strong class="whitetxt">Mes</strong>
							        								<select id="month-15">
							        									<?php 
							        									foreach(range(1, 12) as $number)
																		{
																			if($number < 10)
																				$number = '0' . $number;
																			?>
																			<option value="<?php echo $number?>"><?php echo date('M', strtotime('2012-' . $number . '-01')); ?></option>
																			<?php
																		}
																		?>
							        								
							        								</select>
							        								</td>
							        							</tr>
							        						</table>
							        						
							        						 
							        						<hr class="dotted-2" />
							        						<a href="" class="small-pretty-btn right save-goal" rel="15">Guardar meta</a>
							        					 <div class="arrow-left"></div>
							        					 </div>
							        					
							        				</div>
							        			</div>
							        			<!--/tooltip -->	
					        					<div class="goal-18"><img src="<?php echo APPLICATION_URL?>/images/goals/big/plata-extra.png" alt="Plata Extra" width="" height="" /></div>
					        					<h6 class="text-center greytxt">Plata extra</h6>
					        				</div>
					        			</div><!-- /Goal 18 -->
					        		
						        		<div class="three columns"><!-- Goal 14 -->
						        			<div class="goal" id="goal-15">
												<!-- tooltip -->
												<div class="goal-toltip box-shadow-1 round-1" style="display:none;" >
													<div class="tooltip-block">
														<div class="padding-5">
															<h6 class="text-left whitetxt small">¿Cuando realizarías tu meta?
															<div class="right">
																<a href="" class="light-greytxt close-goal-tooltip">
																	<span class="small" aria-hidden="true" data-icon="&#x6a;"></span>
																</a>
															</div>
															</h6>
															<table class="date-select">
																<tr>

							        								<td>
							        								<strong class="whitetxt">Año</strong>
							        								<select class="year-select" id="year-16">
							        									<?php 
							        									foreach(range(date('Y'), (date('Y') + 15)) as $number)
																		{
																			if($number < 10)
																				$number = '0' . $number;
																			?>
																			<option value="<?php echo $number?>"><?php echo $number?></option>
																			<?php
																		}
																		?>
																	</select>
																	</td>
																	
																	<td>
																	<strong class="whitetxt">Mes</strong>
							        								<select id="month-16">
							        									<?php 
							        									foreach(range(1, 12) as $number)
																		{
																			if($number < 10)
																				$number = '0' . $number;
																			?>
																			<option value="<?php echo $number?>"><?php echo date('M', strtotime('2012-' . $number . '-01')); ?></option>
																			<?php
																		}
																		?>
							        								
							        								</select>
							        								</td>
																</tr>
															</table>
															
															 
															<hr class="dotted-2" />
															<a href="" class="small-pretty-btn right save-goal" rel="16">Guardar meta</a>
														 <div class="arrow-left"></div>
														 </div>
														
													</div>
												</div>
												<!--/tooltip -->
						        				<div class="goal-15"><img src="<?php echo APPLICATION_URL?>/images/goals/big/otro.png" alt="Otro" width="" height="" /></div>
						        				<h6 class="text-center greytxt">Otro</h6>
						        			</div>
						        		</div><!-- /Goal 14 -->	
					        		
					        		</div>
					        		
					        		
	
					        	</div><!-- /Goals -->
					        </div><!-- container -->
					    </div><!-- /8 col -->

						<div class="TimeLine-block2 left clearfix"><!-- 4 col -->
							<div class="container"><!-- container -->
							    <div class="TimeLine clearfix"><!-- Timeline -->
							        
							        <div class="TimeLine-bar"><!-- Timeline Bar -->
							            <div class="start-timeline">
							            	<h6 class="greentxt uppercase">AHORA</h6>
							            </div>
							        

	
							            <div class="finish-timeline">
							            	<h6 class="greentxt uppercase">FUTURO</h6>
							            </div>
							        </div><!-- /Timeline Bar -->
						
							    </div><!-- Timeline Bar -->
							</div><!-- /container -->
						</div><!-- /4 col -->

					</div><!-- /Row -->
					
					
					<div class="main-footer"><!--main footer-->
					<div class="shadow"><img src="<?php echo APPLICATION_URL?>images/shadow-1.png" alt="shadow-1" width="1024" height="20" /></div>
						<div class="container clearfix"><!--container-->
							<div class="text-right right right-btn"><!--action-->
								<form id="diagnostics_form" action="<?php echo APPLICATION_URL?>diagnostico-planeacion.html" method="post" onsubmit="return validateInputs();">
									
									<a href="<?php echo APPLICATION_URL?>metas-000.html" class="greytxt"> <strong>Anterior</strong></a>
									<input type="submit" value="Costo de tu meta" class="pretty-btn-1" />
									<input type="hidden" name="">
									

								</form>

							</div><!--action-->
						</div><!--container-->
					</div><!--main footer-->
					

				</div> <!-- /panel -->
				<div class="shadow"><img src="images/shadow.png" alt="" width="" height=""></div>

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
<div class="goal-block" id="prime-goal-block" style="display:none;"><!--goal block-->
	<div class="goal-legend"><!--goal legend-->

		<div class="arrow-left-1"></div>
	</div><!--/goal legend-->
	
		
    <div class="goal-small" ><!--goal small-->											    				
    </div><!--goal small-->
</div><!--goal block-->	
        
        <div class="goal-16-small" id="prime-goal-item" style="display:none;"><!--Goal item-->
	        <!-- tooltip -->
	        <div class="goal-toltip-1 box-shadow-1 round-1" style="display:none;">
	        	<div class="tooltip-block">
	        		<div class="padding-5">
	        			<h6 class="text-left whitetxt small">Editar tu meta
    	        			<div class="right">
    	        				<a href="" class="light-greytxt close-goal-tooltip">
    	        					<span class="small" aria-hidden="true" data-icon="&#x6a;"></span>
    	        				</a>
    	        			</div>
	        			</h6>
	        			
	        			<table class="date-select">
	        				<tr>
	        					<td>
	        					<strong class="whitetxt">Año</strong>
	        					<select name="year" id="year-0" class="year-select">
								<?php 
								foreach(range(date('Y'), (date('Y') + 15)) as $number)
								{
									if($number < 10)
										$number = '0' . $number;
									?>
									<option value="<?php echo $number?>"><?php echo $number?></option>
									<?php
								}
								?>
	        					</select>
	        					</td>
	        					<td>
	        					<strong class="whitetxt">Mes</strong>
	        					<select name="month" id="month-0" class="month">
								<?php 
								foreach(range(1, 12) as $number)
								{
									if($number < 10)
										$number = '0' . $number;
									?>
									<option value="<?php echo $number?>"><?php echo date('M', strtotime('2012-' . $number . '-01')); ?></option>
									<?php
								}
								?>
	        					
	        					</select>
	        					</td>
	        				</tr>
	        			</table>

	        			<hr class="dotted-2" />
	        			<div class="left">
	        				<a href="" class="light-greytxt delete-item">
	        					<span class="small" aria-hidden="true" data-icon="&#x62;"></span>
	        				</a>
	        			</div>
	        			<a href="" class="small-pretty-btn right save-goal">Guardar meta</a>
	        		 <div class="arrow-down"></div>
	        		 </div>
	        		
	        	</div>
	        </div>
	        <!--/tooltip -->
        <img src="<?php echo APPLICATION_URL?>images/goals/small/" alt="goal" width="" height="" />
        
        </div><!--/Goal item-->	
</body>
</html>
