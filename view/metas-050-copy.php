<?php 
switch ($_GET[0]):
	case '1':
		$objetivo = 'pagar estudio propio';
	break;
	case '2':
		$objetivo = 'crear un fondo de emergencia';
	break;
	case '3':
		$objetivo = 'comprar carro';
	break;						
	case '4':
		$objetivo = 'comprar moto';
	break;								
	case '5':
		$objetivo = 'comprar casa';
	break;	
	case '6':
		$objetivo = 'Casarme';
	break;							
	case '7':
		$objetivo = 'tener un hijo';
	break;							
	case '8':
		$objetivo = 'pagar estudio de mis hijos';
	break;							
	case '9':
		$objetivo = 'empezar un negocio';
	break;							
	case '10':
		$objetivo = 'pagar deudas';
	break;						
	case '11':
		$objetivo = 'irme de vacaciones';
	break;							
	case '12':
		$objetivo = 'pagar un tratamiento médico o estético';
	break;								
	case '13':
		$objetivo = 'ahorrar dinero adicional para el retiro';
	break;							
	case '14':
		$objetivo = 'tener plata para hacer inversiones';
	break;								
	case '16':
		$objetivo = 'remodelar la casa';
	break;							
	case '17':
		$objetivo = 'comprar electrodomésticos';
	break;							
	case '18':
		$objetivo = 'tener un platica extra';
	break;							
	default:
		$objetivo = 'otro meta';
	break;
endswitch;

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
	<link rel="stylesheet" href="<?php echo APPLICATION_URL?>stylesheets/foundation.css">
	<link rel="stylesheet" href="<?php echo APPLICATION_URL?>stylesheets/style.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo APPLICATION_URL?>stylesheets/jquery-ui-1.8.20.custom.css" type="text/css" />
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
	

	<!--[if lt IE 9]>
		<link rel="stylesheet" href="<?php echo APPLICATION_URL?>stylesheets/ie.css">
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
	if (strpos($key, 'salud') !== false)
		$userData 	= UserHelper::setData($user->__get('user_id'), $key, $value);
	else
		$userData 	= UserHelper::setData($user->__get('user_id'), $key.'-'.escape($_GET[0]), $value);
}
foreach ($_POST as $key=>$value)
	$_POST[$key] = str_replace(".", "", str_replace("$", "", $value));
	
$sueno 	= new Sueno($user);	
foreach ($_POST as $key=>$value)
{
	$sueno->addFilter($key, str_replace("$", "", $value));
}
$sueno->addFilter('sueno_tipo', $_GET[0]);

//$sueno->addFilter('show_work', 1);

$salidas	= $sueno->calculate();
$msg		= $sueno->getMsg();
$resultado	= $sueno->getResult();

function cmpBySort($a, $b) 
{
    return $a['sort'] - $b['sort'];
}

if ($resultado == 'positivo')
	usort($salidas, 'cmpBySort');
?>
<!--1./HEADER -->
	


<!--2. MAIN-->
<div id="main"> 
	<div class="container principal clearfix"><!-- Container Padding 20px -->
		
		<div class="row"><!-- breadcrumb -->
				<ol class="breadcrumb-metas clearfix">
					<li class="start-li"><span aria-hidden="true" data-icon="e"></span></li>
					<li>Selección <span aria-hidden="true" class="greentxt" data-icon="f"></span></li>
					<li>Costo <span aria-hidden="true" class="greentxt" data-icon="f"><span class="dot"></span></span></li>
					<li>Finanzas <span aria-hidden="true" class="greentxt" data-icon="f"><span class="dot"></span></span></li>
					<li>Cuotas <span aria-hidden="true" class="greentxt" data-icon="f"><span class="dot"></span></span></li>
					<li>Resultado <span aria-hidden="true" class="greentxt" data-icon="f"><span class="dot"></span></span></li>
					<li class="finish-li"><span aria-hidden="true" data-icon="a"></span></li>
				</ol>
		</div><!-- /breadcrumb -->
		
		
		<!-- 2.2 Row: Content -->
        <?php
			$bg	= ($resultado == 'negativo') ? 'pinkbg' : 'whitebg'; 
		?>
		<div class="row">
			<div class="nine columns"><!-- 9 col -->
				<div class="panel-1 <?php echo $bg;?>"> <!-- panel o whitebg -->
					
				<!-- Row -->
				<div class="row">
				    <div class="innerheader clearfix"><!-- innerheader -->
				    	<div class="inner-ribbon"><!-- inner-ribbon -->
				    		<div class="budget-title left">
				    			<h2 class="left white txt-shadow-black"><!-- ribbon title -->
				    				<div class="icon-ribbon">
				    					<span class="whitetxt" aria-hidden="true" data-icon="e"></span> 
				    				</div>
				    				<div class="title-ribbon">
				    					<p class="whitetxt small-1 txt-shadow-black no-margin">Metas</p>
				    					<strong class="whitetxt title-txt">Resultado</strong>
				    				</div>
				    			</h2><!-- /ribbon title -->
				    		</div>
				    		<div class="sprite-1 ribbon-detail left">icon</div>
				    	</div><!-- /inner-ribbon -->
				    </div><!-- /innerheader -->
				</div>
				<!--/Row -->
			

				<!-- Content -->
				<div class="descubra-main clearfix margin-top-60">
				
				<?php
				if ($resultado == 'negativo')
				{
				?>
				<div class="row"><!--Negative result-->
					<div class="container">
						<h6 class="greytxt no-margin resume-title"><strong>Resumen</strong></h6>	
						<h2 class="greytxt no-margin thin resume">Con los datos que nos proporcionasts no es posible alcanzar tu meta, te sugeimos los siguientes caminos.</h2>
						</div>
						<br/>
						<div class="shadow"><img src="<?php echo APPLICATION_URL?>images/shadow-1.png" alt="" width="" height=""></div>
						
						<div class="negative-ways">
							<ul class="block-grid four-up">
                            	<?php 
								if (isset($salidas['ahorro']))
								{
								?>
								<li>
									<div class="padding-10"><!-- Padding 10 -->
			
										<div class="clearfix"><!-- Total Result -->
											<div class="aumentar-ahorro">Aumentar Ahorro</div>
										</div><!-- /Total Result -->
										
										<div class="calification-1"><!-- Calification -->
										    <h6 class="text-center greytxt"> Aumentar ahorro</h6>
										</div><!-- Calification -->
										
										<p class="text-center explain-1 no-margin">Ahorrar un 30% durante dos meses.</p>
			
									    <p class="text-center no-margin"> <!-- Inactive note -->
									        <a href="diagnostico-planeacion/once.html" class="greentxt small"><strong>Ver camino</strong> <span class="greentxt footer-icon large" aria-hidden="true" data-icon="&#x63;"></span></a>					 					
									    </p><!-- Inactive note -->                                         
			
			                        </div> <!-- Padding 10 -->  
								</li>
                                <?php
								}
								if (isset($salidas['increment']))
								{								
								?>
								<li>
									<div class="padding-10"><!-- Padding 10 -->
			
										<div class="clearfix"><!-- Total Result -->
											<div class="aumentar-ingresos">Aumentar ingreso</div>
										</div><!-- /Total Result -->
										
										<div class="calification-1"><!-- Calification -->
										    <h6 class="text-center greytxt"> Aumentar ingresos</h6>
										</div><!-- Calification -->
										
										<p class="text-center explain-1 no-margin">Ahorrar un 30% durante dos meses.</p>
			
									    <p class="text-center no-margin"> <!-- Inactive note -->
									        <a href="diagnostico-planeacion/once.html" class="greentxt small"><strong>Ver camino</strong> <span class="greentxt footer-icon large" aria-hidden="true" data-icon="&#x63;"></span></a>					 					
									    </p><!-- Inactive note -->                                         
			
			                        </div> <!-- Padding 10 -->  
								</li>
                                <?php
								}
								if (isset($salidas['reduce']))
								{								
								?>
								<li>
									<div class="padding-10"><!-- Padding 10 -->
			
										<div class="clearfix"><!-- Total Result -->
											<div class="disminuir-gastos">Disminuir gastos</div>
										</div><!-- /Total Result -->
										
										<div class="calification-1"><!-- Calification -->
										    <h6 class="text-center greytxt"> Disminuir gastos</h6>
										</div><!-- Calification -->
										
										<p class="text-center explain-1 no-margin">Ahorrar un 30% durante dos meses.</p>
			
									    <p class="text-center no-margin"> <!-- Inactive note -->
									        <a href="diagnostico-planeacion/once.html" class="greentxt small"><strong>Ver camino</strong> <span class="greentxt footer-icon large" aria-hidden="true" data-icon="&#x63;"></span></a>					 					
									    </p><!-- Inactive note -->                                         
			
			                        </div> <!-- Padding 10 -->  
								</li>
                                <?php
								}
								if (isset($salidas['inferior']))
								{								
								?>								
								<li>
									<div class="padding-10"><!-- Padding 10 -->
			
										<div class="clearfix"><!-- Total Result -->
											<div class="disminuir-meta">Disminuir meta</div>
										</div><!-- /Total Result -->
										
										<div class="calification-1"><!-- Calification -->
										    <h6 class="text-center greytxt"> Disminuir meta</h6>
										</div><!-- Calification -->
										
										<p class="text-center explain-1 no-margin">Ahorrar un 30% durante dos meses.</p>
			
									    <p class="text-center no-margin"> <!-- Inactive note -->
									        <a href="diagnostico-planeacion/once.html" class="greentxt small"><strong>Ver camino</strong> <span class="greentxt footer-icon large" aria-hidden="true" data-icon="&#x63;"></span></a>					 					
									    </p><!-- Inactive note -->                                         
			
			                        </div> <!-- Padding 10 -->  
								</li>
                                <?php
								}
								?>							
							</ul>
							
						<!--Pointer-->	
						<div class="arrow-down-2 pos-1a"></div>
						<!--/Pointer-->
						</div>
				
				</div><!--Negative result-->

			
				<div class="whitebg collpase-box" style="height:100%;">
				
				
					<div class="row margin-top-60"><!-- Row Result -->
						<div class="container"><!-- Container Padding 20px -->
							<h6 class="greytxt no-margin resume-title"><strong>Resumen</strong></h6>
							<h2 class="greytxt no-margin thin resume"><?php echo $msg;?></h2>
					 	</div><!--/Container Padding 20px -->
					</div><!-- /Row Result -->


					<!--Opción 1 todos las opciones activadas-->
					<div class="relative"> 
						<div class="route-1"><img src="<?php echo APPLICATION_URL?>images/route-1.png" alt="" width="" height=""></div>
						<div class="route-2"><img src="<?php echo APPLICATION_URL?>images/route-2.png" alt="" width="" height=""></div>
						<div class="row"><!-- row -->
						
				 			<div class="result-1 four columns"><!-- Result: Save -->
				 			
				 			    <div class="padding-10"><!-- Padding 10 -->
		
									<div class="total-result-2 save-gauge-3 clearfix"><!-- Total Result -->
									    <p class="total-result-diagnostico yellowtxt">30<span class="x-small light-greytxt">%</span></p>
									</div><!-- /Total Result -->
									
									<div class="calification-1"><!-- Calification -->
									    <h6 class="text-center large greytxt"><span class="yellowtxt large-dot">&bull;</span>AHORRO</h6>
									</div><!-- Calification -->
									
									<p class="text-center explain-1 no-margin">Ahorrar un 30% durante dos meses.</p>
		
								    <p class="text-center"> <!-- Inactive note -->
								        <a href="diagnostico-planeacion/once.html" class="greentxt small"><strong>Ver detalle de ahorro</strong> <span class="greentxt footer-icon large" aria-hidden="true" data-icon="&#x63;"></span></a>					 					
								    </p><!-- Inactive note -->                                         
		
		                        </div> <!-- Padding 10 -->       
		                    </div><!-- /Result: Save -->
		                    
				 			<div class="result-1 four columns"><!-- Result: Credit -->
				 			    <div class="padding-10"><!-- Padding 10 -->
		
									<div class="total-result-2 credit-gauge-7 clearfix"><!-- Total Result -->
									    <p class="total-result-diagnostico cyantxt">70<span class="x-small light-greytxt">%</span></p>
									</div><!-- /Total Result -->
									
									<div class="calification-1"><!-- Calification -->
									    <h6 class="text-center large greytxt"><span class="cyantxt large-dot">&bull;</span>CRÉDITO</h6>
									</div><!-- Calification -->
									
									<p class="text-center explain-1 no-margin">Solicitar un crédito por 70% del valor del bien.</p>
		
								    <p class="text-center"> <!-- Inactive note -->
								        <a href="diagnostico-planeacion/once.html" class="greentxt small"><strong>Ver detalle de crédito</strong> <span class="greentxt footer-icon large" aria-hidden="true" data-icon="&#x63;"></span></a>					 					
								    </p><!-- Inactive note -->                                         
		
		                        </div> <!-- Padding 10 -->       
		                    </div><!-- /Result: Credit -->
		                    
				 			<div class="result-1 four columns"><!-- Result: Goal -->
				 			    <div class="padding-10"><!-- Padding 10 -->
		
									<div class="total-result-img clearfix"><!-- Total Result -->
										<img src="<?php echo APPLICATION_URL?>images/goals/big/carro.png" alt="" width="" height="">
									    <p class="total-result-diagnostico-txt whitetxt">100<span class="x-small whitetxt">%</span></p>
									</div><!-- /Total Result -->
									
									<div class="calification-1"><!-- Calification -->
									    <h6 class="text-center large greytxt">CARRO</h6>
									</div><!-- Calification -->
									
									<p class="text-center explain-1 no-margin">Logras tu meta.</p>
			
		                        </div> <!-- Padding 10 -->       
		                    </div><!-- /Result: Goal -->
						</div><!-- /row -->
					</div>
					<!--/Opción 1 todos las opciones activadas-->
					
			<!--Opción 2 Sólo ahorro activado-->
			<div class="relative"> 
				<div class="route-1"><img src="<?php echo APPLICATION_URL?>images/route-1.png" alt="" width="" height=""></div>
				<div class="route-2"><img src="<?php echo APPLICATION_URL?>images/route-2.png" alt="" width="" height=""></div>
				<div class="row"><!-- row -->
				
		 			<div class="result-1 four columns"><!-- Result: Save -->
		 			
		 			    <div class="padding-10"><!-- Padding 10 -->

							<div class="total-result-2 save-gauge-10 clearfix"><!-- Total Result -->
							    <p class="total-result-diagnostico yellowtxt">100<span class="x-small light-greytxt">%</span></p>
							</div><!-- /Total Result -->
							
							<div class="calification-1"><!-- Calification -->
							    <h6 class="text-center large light-greytxt"><span class="yellowtxt large-dot">&bull;</span>AHORRO</h6>
							</div><!-- Calification -->
							
							<p class="text-center explain-1 no-margin">Ahorrar un 100% durante dos meses.</p>

						    <p class="text-center"> <!-- Inactive note -->
						        <a href="diagnostico-planeacion/once.html" class="greentxt small"><strong>Ver detalle de ahorro</strong> <span class="greentxt footer-icon large" aria-hidden="true" data-icon="&#x63;"></span></a>					 					
						    </p><!-- Inactive note -->                                         

                        </div> <!-- Padding 10 -->       
                    </div><!-- /Result: Save -->
                    
		 			<div class="result-1 four columns"><!-- Result: Credit -->
		 			    <div class="padding-10"><!-- Padding 10 -->

							<div class="total-result-2 credit-gauge-0 clearfix"><!-- Total Result -->
							    <p class="total-result-diagnostico light-greytxt">0<span class="x-small light-greytxt">%</span></p>
							</div><!-- /Total Result -->
							
							<div class="calification-1"><!-- Calification -->
							    <h6 class="text-center large light-greytxt"><span class="light-greytxt large-dot">&bull;</span>CRÉDITO</h6>
							</div><!-- Calification -->
							                                     

                        </div> <!-- Padding 10 -->       
                    </div><!-- /Result: Credit -->
                    
		 			<div class="result-1 four columns"><!-- Result: Goal -->
		 			    <div class="padding-10"><!-- Padding 10 -->

							<div class="total-result-img clearfix"><!-- Total Result -->
								<img src="<?php echo APPLICATION_URL?>images/goals/big/carro.png" alt="" width="" height="">
							    <p class="total-result-diagnostico-txt whitetxt">100<span class="x-small whitetxt">%</span></p>
							</div><!-- /Total Result -->
							
							<div class="calification-1"><!-- Calification -->
							    <h6 class="text-center large greytxt">CARRO</h6>
							</div><!-- Calification -->
							
							<p class="text-center explain-1 no-margin">Logras tu meta.</p>
	
                        </div> <!-- Padding 10 -->       
                    </div><!-- /Result: Goal -->
				</div><!-- /row -->
			</div>
			<!--/Opción 2 Solo Ahorro activado-->
			
			<!--Opción 3 Sólo crédito activado-->
			<div class="relative"> 
				<div class="route-1"><img src="<?php echo APPLICATION_URL?>images/route-1.png" alt="" width="" height=""></div>
				<div class="route-2"><img src="<?php echo APPLICATION_URL?>images/route-2.png" alt="" width="" height=""></div>
				<div class="row"><!-- row -->
				
		 			<div class="result-1 four columns"><!-- Result: Save -->
		 			
		 			    <div class="padding-10"><!-- Padding 10 -->

							<div class="total-result-2 save-gauge-0 clearfix"><!-- Total Result -->
							    <p class="total-result-diagnostico light-greytxt">0<span class="x-small light-greytxt">%</span></p>
							</div><!-- /Total Result -->
							
							<div class="calification-1"><!-- Calification -->
							    <h6 class="text-center large light-greytxt"><span class="light-greytxt large-dot">&bull;</span>AHORRO</h6>
							</div><!-- Calification -->
							
                                        

                        </div> <!-- Padding 10 -->       
                    </div><!-- /Result: Save -->
                    
		 			<div class="result-1 four columns"><!-- Result: Credit -->
		 			    <div class="padding-10"><!-- Padding 10 -->

							<div class="total-result-2 credit-gauge-10 clearfix"><!-- Total Result -->
							    <p class="total-result-diagnostico cyantxt">100<span class="x-small light-greytxt">%</span></p>
							</div><!-- /Total Result -->
							
							<div class="calification-1"><!-- Calification -->
							    <h6 class="text-center large greytxt"><span class="cyantxt large-dot">&bull;</span>CRÉDITO</h6>
							</div><!-- Calification -->
							
							<p class="text-center explain-1 no-margin">Solicitar un crédito por 100% del valor del bien.</p>

						    <p class="text-center"> <!-- Inactive note -->
						        <a href="diagnostico-planeacion/once.html" class="greentxt small"><strong>Ver detalle de crédito</strong> <span class="greentxt footer-icon large" aria-hidden="true" data-icon="&#x63;"></span></a>					 					
						    </p><!-- Inactive note -->                                         

                        </div> <!-- Padding 10 -->       
                    </div><!-- /Result: Credit -->
                    
		 			<div class="result-1 four columns"><!-- Result: Goal -->
		 			    <div class="padding-10"><!-- Padding 10 -->

							<div class="total-result-img clearfix"><!-- Total Result -->
								<img src="<?php echo APPLICATION_URL?>images/goals/big/carro.png" alt="" width="" height="">
							    <p class="total-result-diagnostico-txt whitetxt">100<span class="x-small whitetxt">%</span></p>
							</div><!-- /Total Result -->
							
							<div class="calification-1"><!-- Calification -->
							    <h6 class="text-center large greytxt">CARRO</h6>
							</div><!-- Calification -->
							
							<p class="text-center explain-1 no-margin">Logras tu meta.</p>
	
                        </div> <!-- Padding 10 -->       
                    </div><!-- /Result: Goal -->
				</div><!-- /row -->
			</div>
			<!--/Opción 3 Solo Crédito activado-->
					


					<div class="row result"><!-- Row Result Save -->
						<div class="title-grey"><!--title-->
							<div class="container">
								<h5 class="whitetxt no-margin"><span class="yellowtxt large-dot">&bull;</span> <strong>AHORRO</strong> durante dos meses</h5>
							</div>
						</div><!--/title-->
						<div class="arrow-down-1"></div>
						
						<div class="container margin-top-10">
							<h6 class="small greytxt">El <strong>30%</strong> ($940.285) del valor de tu meta lo consigues con la <strong>couta inicial</strong> y con un <strong>ahorro</strong>.</h6>

							
							
							<div class="row save-way"><!-- Row safe way -->
									
										<div class="four columns save"><!-- 4 col -->
											<div class="padding-30">
												<h6 class="uppercase small greytxt little-title">Cuota inicial</h6>
												<h5 class="orangetxt">$800.000</h5>
											</div>
										</div><!-- /4 col -->
										
										<div class="four columns during"><!-- 4 col -->
											<div class="padding-30">
												<h6 class="uppercase small greytxt little-title">Ahorras</h6>
												<h5 class="orangetxt">$140.000</h5>
												<small class="light-greytxt">Ahorando <strong>$70.000</strong> mensuales durante <strong>2 meses</strong> y con rendimiento de <strong>$285</strong>.</small>
											</div>
										</div><!-- /4 col -->
										
										<div class="four columns total-save"><!-- 4 col -->
											<div class="padding-30">
												<h6 class="uppercase small greytxt little-title">Total Ahorro</h6>
												<h5 class="orangetxt">$940.000</h5>
											</div>
										</div><!-- /4 col -->

		
							</div><!-- Row safe way -->

							<div class="row save-way"><!-- Row safe way -->
									
										<div class="four columns save"><!-- 4 col -->
											<div class="padding-30">
												<h6 class="uppercase small greytxt little-title">Cuota inicial</h6>
												<h5 class="orangetxt">$800.000</h5>
											</div>
										</div><!-- /4 col -->
										
										<div class="four columns during"><!-- 4 col -->
											<div class="padding-30">
												<h6 class="uppercase small light-greytxt little-title">Ahorras</h6>
												<h5 class="light-greytxt">$0</h5>
											</div>
											<div class="redtxt reminder-icon-1" aria-hidden="true" data-icon="&#xe05f;"></div><small class="greytxt">Como quieres tu meta ahora no tienes tiempo para ahorrar.</small>
										</div><!-- /4 col -->
										
										<div class="four columns total-save"><!-- 4 col -->
											<div class="padding-30">
												<h6 class="uppercase small greytxt little-title">Total Ahorro</h6>
												<h5 class="orangetxt">$800.000</h5>
											</div>
										</div><!-- /4 col -->

		
							</div><!-- Row safe way -->
							
							<div class="row save-way"><!-- Row safe way -->
									
										<div class="four columns save"><!-- 4 col -->
											<div class="padding-30">
												<h6 class="uppercase small light-greytxt little-title">Cuota inicial</h6>
												<h5 class="light-greytxt">$0</h5>
											</div>
											<div class="redtxt reminder-icon-1" aria-hidden="true" data-icon="&#xe05f;"></div><small class="greytxt">Sin cuota inicial.</small>
										</div><!-- /4 col -->
										
										<div class="four columns during"><!-- 4 col -->
											<div class="padding-30">
												<h6 class="uppercase small greytxt little-title">Ahorras</h6>
												<h5 class="orangetxt">$140.000</h5>
											</div>
										</div><!-- /4 col -->
										
										<div class="four columns total-save"><!-- 4 col -->
											<div class="padding-30">
												<h6 class="uppercase small greytxt little-title">Total Ahorro</h6>
												<h5 class="orangetxt">$140.000</h5>
											</div>
										</div><!-- /4 col -->

		
							</div><!-- Row safe way -->
							
							<div class="row save-way"><!-- Row safe way -->
									
										<div class="four columns save"><!-- 4 col -->
											<div class="padding-30">
												<h6 class="uppercase small light-greytxt little-title">Cuota inicial</h6>
												<h5 class="light-greytxt">$0</h5>
											</div>
											<div class="redtxt reminder-icon-1" aria-hidden="true" data-icon="&#xe05f;"></div><small class="greytxt">Sin cuota inicial.</small>
										</div><!-- /4 col -->
										
										<div class="four columns during"><!-- 4 col -->
											<div class="padding-30">
												<h6 class="uppercase small light-greytxt little-title">Ahorras</h6>
												<h5 class="light-greytxt">$0</h5>
											</div>
											<div class="redtxt reminder-icon-1" aria-hidden="true" data-icon="&#xe05f;"></div><small class="greytxt">Como quieres tu meta ahora no tienes tiempo para ahorrar.</small>
										</div><!-- /4 col -->
										
										<div class="four columns total-save"><!-- 4 col -->
											<div class="padding-30">
												<h6 class="uppercase small light-greytxt little-title">Total Ahorro</h6>
												<h5 class="light-greytxt">$0</h5>
											</div>
										</div><!-- /4 col -->

		
							</div><!-- Row safe way -->
							
							
							
						</div>
					</div><!-- /Row Result Save -->
                    
                    
               <?php
				}
				?>
					
					<div class="row result"><!-- Row Result credit -->
						<div class="title-grey"><!--title-->
							<div class="container">
								<h5 class="whitetxt no-margin"><span class="cyantxt large-dot">&bull;</span> <strong>CRÉDITO</strong></h5>
							</div>
						</div><!--/title-->
						<div class="arrow-down-1"></div>
						
						<div class="container margin-top-10">
							<h6 class="small greytxt">Para El <strong>70%</strong> ($40.040.303) te presentamos varias opciones, entre más tiempo menor monto mensual</h6>
							<div class="row save-way"><!-- Row safe way -->
								
								<div class="icon-col left">
								
									<div class="icon-box-cal">
										<h6 class="uppercase small greytxt little-title">Durante</h6>
									</div>
									<div class="icon-box-cuota">
										<h6 class="uppercase small greytxt little-title">Cuota</h6>
									</div>
									<div class="icon-box-total">
										<h6 class="uppercase small greytxt little-title">Total</h6>
									</div>
		
								</div>
								
								<div class="result-col left">
								<div class="block-grid mobile four-up">
									  <?php
										$i = 1;
										$first = true;
										foreach ($salidas as $salida)
										{
										
										if ($salida['tipo'] == 'positivo')
										{
											
											switch ($i):
												case 1:
													$titulo	= 	'Tu opci&oacute;n a m&aacute;s corto plazo';											
												break;
												case 2:
													$titulo	= 	'Opci&oacute;n intermedia';											
												break;
												case 3:
													$titulo	= 	'Opci&oacute;n intermedia';											
												break;
												case 4:
													$titulo	= 	'Tu opci&oacute;n con cuota m&aacute;s baja';											
												break;
											endswitch;	
											
											if ($salida['tiempo'] == $_POST['cuotas'])
												$titulo = "El tiempo que escog&iacute;ste";
											
									?>

						 				<li>
						 				<div class="padding-10">
						 				<h6 class="text-center small greytxt"><strong><span class="greentxt" aria-hidden="true" data-icon="k"></span><?php echo $titulo;?></strong></h6>
		
						 						<div class="circle-1">
													<p class="meses-number text-center thin cyantxt"><?php echo $salida['tiempo']?><br />
													<span class="small no-margin greytxt"><strong>MESES</strong></span>
													</p>
												</div>
						 						<!-- <p class="justified"><?php echo ucfirst(strtolower($salida))?></p> -->
						 						<ul class="metas-result-ul">
						 							<li class="text-center">
						 								<h6 class="thin">
						 									<span class="cyantxt">$<?php echo $salida['cuota'];?></span>
						 								</h6>
						 							</li>
						 							<li class="text-center dotted-line">
						 								<h6 class="thin">
						 									<span class="cyantxt">$<?php echo $salida['total'];?></span>
						 								</h6>
						 							</li>
						 						</ul>
						 						
						 				</div>
						 				</li>
						 				
						 				<li>
						 				<div class="padding-10">
						 				<h6 class="text-center small greytxt"><strong><span class="redtxt" aria-hidden="true" data-icon="&#x6a;"></span><?php echo $titulo;?></strong></h6>
		
						 						<div class="circle-4">
													<p class="meses-number text-center thin light-greytxt"><?php echo $salida['tiempo']?><br />
													<span class="small no-margin light-greytxt"><strong>MESES</strong></span>
													</p>
												</div>
						 						<!-- <p class="justified"><?php echo ucfirst(strtolower($salida))?></p> -->
						 						<ul class="metas-result-ul">
						 							<li class="text-center">
						 								<h6 class="thin">
						 									<span class="light-greytxt">$<?php echo $salida['cuota'];?></span>
						 								</h6>
						 							</li>
						 							<li class="text-center dotted-line">
						 								<h6 class="thin">
						 									<span class="light-greytxt">$<?php echo $salida['total'];?></span>
						 								</h6>
						 							</li>
						 						</ul>
						 						
						 				</div>
						 				</li>
				 								 				
				 					<?php
											$i++;
										}
										else if (($salida['tipo'] == 'tiempo') && ($resultado == 'negativo'))
										{
									?>
					 					<div class="">
					 					    <div class="padding-10">
					 					    	<p><b><?php echo utf8_encode($salida['text']);?></b></p>
										    	
					 					    </div>
					 					</div>										
									<?php	
										$first = false;
										}											
										else
										{
									?>
					 					<div class="">
					 					    <div class="padding-10">
					 					    	<p><?php echo utf8_encode($salida['text']);?></p>
										    	
					 					    </div>
					 					</div>										
									<?php	
										$first = false;
										}
									}
									?>  
							

				 				</div>
				 				</div>
							</div><!-- Row safe way -->
						</div>
					</div><!-- /Row Result credit -->
					
					</div>
					</div>
					<!-- /Content -->

				</div> <!--/panel -->
				<div class="shadow"><img src="<?php echo APPLICATION_URL?>images/shadow.png" alt="" width="" height=""></div>
			</div><!--/9 col -->
			
			<div class="three columns"><!-- Sidebar -->
	
				<div class="bluebox-fixed box-shadow round-1"><!-- bluebox -->
				    <div class="padding-10"><!-- /Padding 10 -->
				    	<!-- title -->
				    	<h6 class="thin whitetxt text-center large txt-shadow-black">TU <strong>META</strong></h6>
				    	<!-- /title -->
						<div class="row margin-top-30">
							<div class="four columns">
								<img src="<?php echo APPLICATION_URL?>images/goals/big/carro.png" alt="" width="" height="">
							</div>
							<div class="eight columns">
								<h6 class="whitetxt">Carro</h6>
								<h6 class="whitetxt thin">Marca</h6>
								<h6 class="whitetxt thin">Módelo<span>/Año</span></h6>
								<h6 class="whitetxt">Precio</h6>
							</div>
						</div>
						

	

					</div><!-- /Padding 10 -->
				</div><!-- bluebox -->
	
				<div class="shadow"><!-- bluebox tail -->
					<img src="<?php echo APPLICATION_URL?>images/sidebar-tail.png" alt="sidebar-tail" width="" height="" />
				</div><!-- bluebox tail -->
					
									
				<div class="next-steps-block clearfix"><!-- Next steps -->
					<!-- title -->
					<h6 class="next-step-title dark-greytxt txt-shadow-white">Próximos <strong>Pasos</strong></h6>
					<p class="greytxt explain-1">Según tu meta te recomendamos usar las siguientes herramientas</p>
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
			

		</div>
		<!-- 2.2/Row: Content -->
		
	</div><!-- /Container Padding 20px -->	
</div>
<!--2./MAIN--> 	

<?php	
include_once('footer.php');	
?>


<!-- Included JS Files -->
	<script src="<?php echo APPLICATION_URL?>javascripts/jquery.min.js"></script>
	<script src="<?php echo APPLICATION_URL?>javascripts/modernizr.foundation.js"></script>
	<script src="<?php echo APPLICATION_URL?>javascripts/foundation.js"></script>
	<script src="<?php echo APPLICATION_URL?>javascripts/app.js"></script>
	<script type="text/javascript" src="<?php echo APPLICATION_URL?>javascripts/jquery-ui-1.8.17.custom.min.js"></script>
	
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
	<script type="text/javascript">
	
$(document).ready(function () {
	});

</script>
		
		
</body>
</html>
