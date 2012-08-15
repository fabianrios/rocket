<?php 
foreach ($_POST as $key=>$value)
	$_POST[$key] = str_replace(".", "", str_replace("$", "", $value));
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

function getDiagram($ahorro, $credito, $cuota_inicial, $ahorromes, $ahorrototal, $plazomaximo, $tiemposueno, $cuota, $total, $mensaje= '', $divName)
{
	$ahorro_pct		= number_format(($ahorro/($ahorro+$credito))*100);
	$credito_pct	= number_format(($credito/($ahorro+$credito))*100);
	$gauge_ahorro	= floor($ahorro_pct/10);
	$gauge_credito	= floor($credito_pct/10);	
?>
<div  id="<?php echo $divName;?>" class="container_all">                    
    <div class="row"><!--Negative result-->
        <div class="container">
            <h3 class="greytxt no-margin thin resume margin-top-60"><?php echo $mensaje;?></h3>
        </div>
    </div>                        
    <div class="relative"> 
        <div class="route-1"><img src="<?php echo APPLICATION_URL?>images/route-1.png" alt="" width="" height=""></div>
        <div class="route-2"><img src="<?php echo APPLICATION_URL?>images/route-2.png" alt="" width="" height=""></div>
        <div class="row"><!-- row -->
        
            <div class="result-1 four columns"><!-- Result: Save -->
            
                <div class="padding-10"><!-- Padding 10 -->

                    <div class="total-result-2 save-gauge-<?php echo $gauge_ahorro;?>  clearfix"><!-- Total Result -->
                        <p class="total-result-diagnostico yellowtxt"><?php echo $ahorro_pct;?><span class="x-small light-greytxt">%</span></p>
                    </div><!-- /Total Result -->
                    
                    <div class="calification-1"><!-- Calification -->
                        <h6 class="text-center large greytxt"><span class="yellowtxt large-dot">&bull;</span>AHORRO</h6>
                    </div><!-- Calification -->
                    
                    <p class="text-center explain-1 no-margin">Ahorrar un <?php echo $ahorro_pct;?>% durante <?php echo number_format($tiemposueno);?> meses.</p>

                    <p class="text-center"> <!-- Inactive note -->
                        <a href="diagnostico-planeacion/once.html" class="greentxt small"><strong>Ver detalle de ahorro</strong> <span class="greentxt footer-icon large" aria-hidden="true" data-icon="&#x63;"></span></a>					 					
                    </p><!-- Inactive note -->                                         

                </div> <!-- Padding 10 -->       
            </div><!-- /Result: Save -->
            
            <div class="result-1 four columns"><!-- Result: Credit -->
                <div class="padding-10"><!-- Padding 10 -->

                    <div class="total-result-2 credit-gauge-<?php echo $gauge_credito;?> clearfix"><!-- Total Result -->
                        <p class="total-result-diagnostico cyantxt"><?php echo $credito_pct;?><span class="x-small light-greytxt">%</span></p>
                    </div><!-- /Total Result -->
                    
                    <div class="calification-1"><!-- Calification -->
                        <h6 class="text-center large greytxt"><span class="cyantxt large-dot">&bull;</span>CRÉDITO</h6>
                    </div><!-- Calification -->
                    
                    <p class="text-center explain-1 no-margin">Solicitar un crédito por <?php echo $credito_pct;?>% del valor del bien.</p>

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

    <div class="row result"><!-- Row Result Save -->
        <div class="title-grey"><!--title-->
            <div class="container">
                <h5 class="whitetxt no-margin"><span class="yellowtxt large-dot">&bull;</span> <strong>AHORRO</strong></h5>
            </div>
        </div><!--/title-->
        <div class="arrow-down-1"></div>
        
        <div class="container margin-top-10">
            <h6 class="small greytxt">El <strong><?php echo $ahorro_pct;?>%</strong> ($<?php echo number_format($ahorro)?>) del valor de tu meta lo consigues con la <strong>couta inicial</strong> y con un <strong>ahorro</strong>.</h6>
            
            
            <div class="row save-way"><!-- Row safe way -->
                        
                        <?php 
                        $style	=  ($cuota_inicial != 0) ? 'orangetxt' : 'light-greytxt';
                        ?>
                        
                        
                        <div class="four columns save"><!-- 4 col -->
                            <div class="padding-30">
                                <h6 class="uppercase small greytxt little-title">Cuota inicial</h6>
                                <h5 class="<?php echo $style;?>">$<?php echo number_format($cuota_inicial);?></h5>
                            </div>
                        </div><!-- /4 col -->

                        <?php 
    
                        $style	=  ($ahorromes != 0) ? 'orangetxt' : 'light-greytxt';
                        ?>										
                        
                        <div class="four columns during"><!-- 4 col -->
                            <div class="padding-30">
                                <h6 class="uppercase small greytxt little-title">Ahorras</h6>
                                <h5 class="<?php echo $style;?>">$<?php echo number_format($ahorrototal);?></h5>
                            </div>
                            <small class="light-greytxt">Ahorando <strong>$<?php echo number_format($ahorromes);?></strong> mensuales durante <strong><?php echo number_format($tiemposueno);?> meses</strong> y con rendimiento de <strong>$<?php echo number_format($ahorrototal-($ahorromes*$tiemposueno));?></strong>.</small>
                        </div><!-- /4 col -->
                        
                        <div class="four columns total-save"><!-- 4 col -->
                            <div class="padding-30">
                                <h6 class="uppercase small greytxt little-title">Total Ahorro</h6>
                                <h5 class="orangetxt">$<?php echo number_format($ahorro);?></h5>
                            </div>
                        </div><!-- /4 col -->


            </div><!-- Row safe way -->


            
        </div>
    </div>

    
    
    <div class="row result"><!-- Row Result credit -->
        <div class="title-grey"><!--title-->
            <div class="container">
                <h5 class="whitetxt no-margin"><span class="cyantxt large-dot">&bull;</span> <strong>CRÉDITO</strong></h5>
            </div>
        </div><!--/title-->
        <div class="arrow-down-1"></div>
        
        <div class="container margin-top-10">
            <h6 class="small greytxt">Para El <strong><?php echo $credito_pct;?>%</strong> ($<?php echo number_format($credito)?>) te presentamos varias opciones, entre más tiempo menor monto mensual</h6>
            <div class="row save-way"><!-- Row safe way -->
                
                <div class="icon-col left">
                
                    <div class="icon-box-cal">
                        <h6 class="uppercase small greytxt little-title">Duración</h6>
                    </div>
                    <div class="icon-box-cuota">
                        <h6 class="uppercase small greytxt little-title">Cuota mensual</h6>
                    </div>
                    <div class="icon-box-total">
                        <h6 class="uppercase small greytxt little-title">Total crédito</h6>
                    </div>

                </div>
                
                <div class="result-col left">
                <div class="block-grid mobile four-up">
                                    <li>
                                    <div class="padding-10">
                                    <h6 class="text-center small greytxt"><strong><span class="greentxt" aria-hidden="true" data-icon="k"></span></strong></h6>
    
                                            <div class="circle-1">
                                                <p class="meses-number text-center thin cyantxt"><?php echo $plazomaximo?><br />
                                                <span class="small no-margin greytxt"><strong>MESES</strong></span>
                                                </p>
                                            </div>
                                            <ul class="metas-result-ul">
                                                <li class="text-center">
                                                    <h6 class="thin">
                                                        <span class="cyantxt">$<?php echo number_format($cuota);?></span>
                                                    </h6>
                                                </li>
                                                <li class="text-center dotted-line">
                                                    <h6 class="thin">
                                                        <span class="cyantxt">$<?php echo number_format($total);?></span>
                                                    </h6>
                                                </li>
                                            </ul>
                                            
                                    </div>
                                    </li>
                </div>
                </div>
            </div><!-- Row safe way -->
        </div>
    </div><!-- /Row Result credit -->
</div>                     
<?	
}

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
	<script src="<?php echo APPLICATION_URL?>javascripts/jquery.min.js"></script>
	<script src="<?php echo APPLICATION_URL?>javascripts/modernizr.foundation.js"></script>
	<script src="<?php echo APPLICATION_URL?>javascripts/foundation.js"></script>
	<script src="<?php echo APPLICATION_URL?>javascripts/app.js"></script>
	<script type="text/javascript" src="<?php echo APPLICATION_URL?>javascripts/jquery-ui-1.8.17.custom.min.js"></script>
	

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

$sueno->addFilter('show_work', 1);

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
		
<?php	
	$bread_name = array("Selección", "Costo", "Finanzas", "Cuota", "Resultado");
	$js_array = json_encode($bread_name);
	include_once('breadcrumbs-metas.php');	
?>
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
                if ($resultado != 'positivo')
                {
                ?>		
                
				<div class="row"><!--Negative result-->
					<div class="container">
						<!--<h6 class="greytxt no-margin resume-title"><strong>Resumen</strong></h6>-->	
						<h2 class="greytxt no-margin thin resume">Con los datos que nos proporcionaste no es posible alcanzar tu meta, te sugerimos los siguientes caminos.</h2>
						</div>
						<br/>
						<div class="shadow"><img src="<?php echo APPLICATION_URL?>images/shadow-1.png" alt="" width="" height=""></div>
						
						<div class="negative-ways">
							<ul class="block-grid four-up">
                            	<?php 
								if (isset($salidas['ahorro']))
								{
									$ahorro	= number_format(($sueno->getValue('cuota_ini_calc') / $salidas['ahorro']['ahorro_total'])* 100);
								?>
								<li>
									<div class="padding-10"><!-- Padding 10 -->
			
										<div class="clearfix"><!-- Total Result -->
											<div class="aumentar-ahorro">Aumentar Ahorro</div>
										</div><!-- /Total Result -->
										
										<div class="calification-1"><!-- Calification -->
										    <h6 class="text-center greytxt"> Aumentar ahorro</h6>
										</div><!-- Calification -->
										<?php
											$text 	= ""; 
											if ($sueno->getValue('cuota_inicial') != 0)
											{
												if (($sueno->getValue('tiempo_sueno') > 0) && ($sueno->getValue('suen_porcentaje_ahorro') != 0))
													$text =  'Adicional a lo planeado, deberas ahorrar $'.number_format($salidas['ahorro']['ahorro_mes'], 0, ',', '.').' por '.number_format($salidas['ahorro']['tiempo']).' meses mas.';
												else
													$text =  'Adicional a la cuota inicial, deberas ahorrar $'.number_format($salidas['ahorro']['ahorro_mes'], 0, ',', '.').' por '.number_format($salidas['ahorro']['tiempo']).' meses mas.';
											}
											else
											{
												if (($sueno->getValue('tiempo_sueno') > 0) && ($sueno->getValue('suen_porcentaje_ahorro') != 0))
													$text =  'Adicional a lo planeado, deberas ahorrar $'.number_format($salidas['ahorro']['ahorro_mes'], 0, ',', '.').' por '.number_format($salidas['ahorro']['tiempo']).' meses mas.';
												else
													$text =  'Debes ahorrar $'.number_format($salidas['ahorro']['ahorro_mes'], 0, ',', '.').' por '.number_format($salidas['ahorro']['tiempo']).' meses.';
												
											}
										?>
										<p class="text-center explain-1 no-margin"><?php echo $text;?></p>
			
									    <p class="text-center no-margin"> <!-- Inactive note -->
									        <a href="javascript:void(0)" class="greentxt small" onClick="openDiv('ahorro');"><strong>Ver camino</strong> <span class="greentxt footer-icon large" aria-hidden="true" data-icon="&#x63;"></span></a>					 					
									    </p><!-- Inactive note -->                                         
			
			                        </div> <!-- Padding 10 -->  
								</li>
                                <?php
								}
								if (isset($salidas['increment']))
								{								
									$ingreso	= number_format(($sueno->getValue('salud_28')/$salidas['increment']['cuota'])* 100);
								?>
								<li>
									<div class="padding-10"><!-- Padding 10 -->
			
										<div class="clearfix"><!-- Total Result -->
											<div class="aumentar-ingresos">Aumentar ingreso</div>
										</div><!-- /Total Result -->
										
										<div class="calification-1"><!-- Calification -->
										    <h6 class="text-center greytxt"> Aumentar ingresos</h6>
										</div><!-- Calification -->
										
										<p class="text-center explain-1 no-margin">Aumentar tus ingresos de $<?php echo number_format($sueno->getValue('salud_28'), 0, ',', '.');?> a $<?php echo number_format($salidas['increment']['cuota'], 0, ',', '.');?>.</p>
			
									    <p class="text-center no-margin"> <!-- Inactive note -->
									        <a href="javascript:void(0)" class="greentxt small" onClick="openDiv('increment');"><strong>Ver camino</strong> <span class="greentxt footer-icon large" aria-hidden="true" data-icon="&#x63;"></span></a>					 					
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
										
										<p class="text-center explain-1 no-margin">Disminuye tus gastos de $<?php echo $salidas['reduce']['tiempo'];?> a $<?php echo number_format($sueno->getValue('gastos_financieros') + $sueno->getValue('gastos_no_financieros'), 0, ',', '.');?>.</p>
			
									    <p class="text-center no-margin"> <!-- Inactive note -->
									        <a href="javascript:void(0)" class="greentxt small" onClick="openDiv('reduce');"><strong>Ver camino</strong> <span class="greentxt footer-icon large" aria-hidden="true" data-icon="&#x63;"></span></a>					 					
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
										
										<p class="text-center explain-1 no-margin">Disminuir el valor de su meta de $<?php echo number_format($sueno->getValue('valor_credito'), 0, ',', '.');?> a $<?php echo number_format($salidas['inferior']['total']-$sueno->getValue('cuota_ini_calc'), 0, ',', '.');?>.</p>
			
									    <p class="text-center no-margin"> <!-- Inactive note -->
									        <a href="javascript:void(0)" class="greentxt small" onClick="openDiv('inferior');"><strong>Ver camino</strong> <span class="greentxt footer-icon large" aria-hidden="true" data-icon="&#x63;"></span></a>					 					
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
				
				</div>
                <?php
				}
				?>
				<!--Negative result-->
				<div class="whitebg collpase-box" style="height:100%;">
				
				



<?php // ACA EMPIEZAN LOS OTROS DIVS ?>

					<!-- /Row Result Save -->
<?php
if ($resultado == 'positivo')
{
	
	$ahorro 		= $sueno->getValue('cuota_ini_calc');
	$credito 		= $sueno->getValue('valor_credito');
	$ahorro_pct		= number_format(($ahorro/($ahorro+$credito))*100);
	$credito_pct	= number_format(($credito/($ahorro+$credito))*100);
	$gauge_ahorro	= floor($ahorro_pct/10);
	$gauge_credito	= floor($credito_pct/10);

?>

					<div class="row"><!-- Row Result -->
						<div class="container"><!-- Container Padding 20px -->
							<!--<h6 class="greytxt no-margin resume-title"><strong>Resumen</strong></h6>-->
							<h2 class="greytxt no-margin thin resume"><?php echo $msg;?></h2>
					 	</div><!--/Container Padding 20px -->
					</div><!-- /Row Result -->

					<div class="relative"> 
						<div class="route-1"><img src="<?php echo APPLICATION_URL?>images/route-1.png" alt="" width="" height=""></div>
						<div class="route-2"><img src="<?php echo APPLICATION_URL?>images/route-2.png" alt="" width="" height=""></div>
						<div class="row"><!-- row -->
						
				 			<div class="result-1 four columns"><!-- Result: Save -->
				 			
				 			    <div class="padding-10"><!-- Padding 10 -->
		
									<div class="total-result-2 save-gauge-<?php echo $gauge_ahorro;?>  clearfix"><!-- Total Result -->
									    <p class="total-result-diagnostico yellowtxt"><?php echo $ahorro_pct;?><span class="x-small light-greytxt">%</span></p>
									</div><!-- /Total Result -->
									
									<div class="calification-1"><!-- Calification -->
									    <h6 class="text-center large greytxt"><span class="yellowtxt large-dot">&bull;</span>AHORRO</h6>
									</div><!-- Calification -->
									
									<p class="text-center explain-1 no-margin">Ahorrar un <?php echo $ahorro_pct;?>% durante <?php echo number_format($sueno->getValue('tiempo_sueno'));?> meses.</p>
		
								    <p class="text-center"> <!-- Inactive note -->
								        <a href="diagnostico-planeacion/once.html" class="greentxt small"><strong>Ver detalle de ahorro</strong> <span class="greentxt footer-icon large" aria-hidden="true" data-icon="&#x63;"></span></a>					 					
								    </p><!-- Inactive note -->                                         
		
		                        </div> <!-- Padding 10 -->       
		                    </div><!-- /Result: Save -->
		                    
				 			<div class="result-1 four columns"><!-- Result: Credit -->
				 			    <div class="padding-10"><!-- Padding 10 -->
		
									<div class="total-result-2 credit-gauge-<?php echo $gauge_credito;?> clearfix"><!-- Total Result -->
									    <p class="total-result-diagnostico cyantxt"><?php echo $credito_pct;?><span class="x-small light-greytxt">%</span></p>
									</div><!-- /Total Result -->
									
									<div class="calification-1"><!-- Calification -->
									    <h6 class="text-center large greytxt"><span class="cyantxt large-dot">&bull;</span>CRÉDITO</h6>
									</div><!-- Calification -->
									
									<p class="text-center explain-1 no-margin">Solicitar un crédito por <?php echo $credito_pct;?>% del valor del bien.</p>
		
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

					<div class="row result"><!-- Row Result Save -->
						<div class="title-grey"><!--title-->
							<div class="container">
								<h5 class="whitetxt no-margin"><span class="yellowtxt large-dot">&bull;</span> <strong>AHORRO</strong></h5>
							</div>
						</div><!--/title-->
						<div class="arrow-down-1"></div>
						
						<div class="container margin-top-10">
							<h6 class="small greytxt">El <strong><?php echo $ahorro_pct;?>%</strong> ($<?php echo number_format( $sueno->getValue('cuota_ini_calc'),0)?>) del valor de tu meta lo consigues con la <strong>couta inicial</strong> y con un <strong>ahorro</strong>.</h6>
							<!--<?php
							if ($resultado == 'positivo')
							{
							?>
									<h5 class="text-left greytxt"><strong>Para <?php echo $objetivo;?> de $<?php echo number_format($_POST['valor_bien'], 0, ",", ".");?> necesitas</strong></h5>						
							<?php
							}
							else
							{
							?>
									<h5 class="text-left greytxt"><strong>Hoy <?php echo $objetivo;?> de $<?php echo number_format($_POST['valor_bien'], 0, ",", ".");?> no est&aacute; acorde a tus posibilidades financieras, pero podr&iacute;as intentar esto para lograrlo.</strong></h5>						                                                    
							<?php
							}
							?>-->
							
							
							<div class="row save-way"><!-- Row safe way -->
										
                                        <?php 
										$style	=  ($sueno->getValue('cuota_inicial') != 0) ? 'orangetxt' : 'light-greytxt';
										?>
										
										
										<div class="four columns save"><!-- 4 col -->
											<div class="padding-30">
												<h6 class="uppercase small greytxt little-title">Cuota inicial</h6>
												<h5 class="<?php echo $style;?>">$<?php echo number_format($sueno->getValue('cuota_inicial'));?></h5>
											</div>
										</div><!-- /4 col -->

                                        <?php 
					
										$style	=  ($sueno->getValue('ahorromes') != 0) ? 'orangetxt' : 'light-greytxt';
										?>										
                                        
										<div class="four columns during"><!-- 4 col -->
											<div class="padding-30">
												<h6 class="uppercase small greytxt little-title">Ahorras</h6>
												<h5 class="<?php echo $style;?>">$<?php echo number_format($sueno->getValue('ahorrototal'));?></h5>
											</div>
											<small class="light-greytxt">Ahorando <strong>$<?php echo number_format($sueno->getValue('ahorromes'));?></strong> mensuales durante <strong><?php echo number_format($sueno->getValue('tiempo_sueno'));?> meses</strong> y con rendimiento de <strong>$<?php echo number_format($sueno->getValue('ahorrototal')-($sueno->getValue('ahorromes')*$sueno->getValue('tiempo_sueno')));?></strong>.</small>
										</div><!-- /4 col -->
										
										<div class="four columns total-save"><!-- 4 col -->
											<div class="padding-30">
												<h6 class="uppercase small greytxt little-title">Total Ahorro</h6>
												<h5 class="orangetxt">$<?php echo number_format($sueno->getValue('cuota_ini_calc'));?></h5>
											</div>
										</div><!-- /4 col -->

		
							</div><!-- Row safe way -->


							
						</div>
					</div>

					
                    
					<div class="row result"><!-- Row Result credit -->
						<div class="title-grey"><!--title-->
							<div class="container">
								<h5 class="whitetxt no-margin"><span class="cyantxt large-dot">&bull;</span> <strong>CRÉDITO</strong></h5>
							</div>
						</div><!--/title-->
						<div class="arrow-down-1"></div>
						
						<div class="container margin-top-10">
							<h6 class="small greytxt">Para El <strong><?php echo $credito_pct;?>%</strong> ($<?php echo number_format( $sueno->getValue('valor_credito'),0)?>) te presentamos varias opciones, entre más tiempo menor monto mensual</h6>
							<div class="row save-way"><!-- Row safe way -->
								
								<div class="icon-col left">
								
									<div class="icon-box-cal">
										<h6 class="uppercase small greytxt little-title">Duración</h6>
									</div>
									<div class="icon-box-cuota">
										<h6 class="uppercase small greytxt little-title">Cuota mensual</h6>
									</div>
									<div class="icon-box-total">
										<h6 class="uppercase small greytxt little-title">Total crédito</h6>
									</div>
		
								</div>
								
								<div class="result-col left">
								<div class="block-grid mobile four-up">
									  <?php
										$i = 1;
										$first = true;
										
										foreach ($salidas as $salida)
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
											if ($salida['tipo']	  == 'positivo')
											{
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
										<?php
											}
											else if ($salida['tipo'] == 'nocando')
											{
										?>		
                                        									
                                            <li>
                                            <div class="padding-10">
                                            <h6 class="text-center small greytxt"><strong><span class="redtxt" aria-hidden="true" data-icon="&#x6a;"></span>La opci&oacute;n que seleccionaste.</strong></h6>
            
                                                    <div class="circle-1">
                                                        <p class="meses-number text-center thin light-greytxt"><?php echo $salida['tiempo']?><br />
                                                        <span class="small no-margin light-greytxt"><strong>MESES</strong></span>
                                                        </p>
                                                    </div>
                                                    <!-- <p class="justified"><?php echo ucfirst(strtolower($salida))?></p> -->
                                                    <ul class="metas-result-ul">
                                                        <li class="text-center">
                                                            <h6 class="thin">
                                                                <span class="light-greytxt"></span>
                                                            </h6>
                                                        </li>
                                                        <li class="text-center dotted-line">
                                                            <h6 class="thin">
                                                                <span class="light-greytxt"></span>
                                                            </h6>
                                                        </li>
                                                    </ul>
                                                    
                                            </div>
                                            </li>
														 								 				
				 					<?php
											}
											$i++;
									}
									?>  
							

				 				</div>
				 				</div>
							</div><!-- Row safe way -->
						</div>
					</div><!-- /Row Result credit -->

<?php
}
else
{
	$ahorro 		= $sueno->getValue('cuota_ini_calc');
	$credito 		= $sueno->getValue('valor_credito');
	$ahorro_pct		= number_format(($ahorro/($ahorro+$credito))*100);
	$credito_pct	= number_format(($credito/($ahorro+$credito))*100);
	$gauge_ahorro	= floor($ahorro_pct/10);
	$gauge_credito	= floor($credito_pct/10);	
	//function getDiagram($ahorro, $credito, $cuota_inicial, $ahorromes, $ahorrototal, $plazomaximo, $tiemposueno)
	foreach ($salidas as $salida)
	{
		if ($salida['tipo'] == 'ahorro')
		{
			
			$time		= intval($sueno->getValue('tiempo_sueno')) + intval($salidas['ahorro']['tiempo']);
			$nextDate	= strtotime(date("Y-m-d", strtotime(date('Y-m-d'))) . " +".$time." month");
			if ($sueno->getValue('tiempo_sueno') > 0)
			{
				if ($sueno->getValue('cuota_inicial') != 0)
				{
					if (($sueno->getValue('tiempo_sueno') > 0) && ($sueno->getValue('suen_porcentaje_ahorro') != 0))
						$text =  'Tu meta será posible en '.date("M", $nextDate).' de '.date("Y", $nextDate).'.   El ahorro que planeas hacer mas tu cuota inicial no son suficientes, debes ahorrar otros '.number_format($salidas['ahorro']['tiempo']).' y entonces podrás solicitar un credito por '.$salida['plazomax'].' meses.';
					else
						$text =  'Tu meta será posible en '.date("M", $nextDate).' de '.date("Y", $nextDate).'.  Tu cuota inicial no es suficiente, debes ahorrar otros '.number_format($salidas['ahorro']['tiempo']).' meses y en ese entonces podras solicitar un credito a '.$salida['plazomax'].' meses.';
				}
				else
				{
					if (($sueno->getValue('tiempo_sueno') > 0) && ($sueno->getValue('suen_porcentaje_ahorro') != 0))
						$text =  'Tu meta será posible en '.date("M", $nextDate).' de '.date("Y", $nextDate).'.   El ahorro que planeas hacer mas tu cuota inicial no son suficientes, debes ahorrar otros '.number_format($salidas['ahorro']['tiempo']).' y entonces podrás solicitar un credito por '.$salida['plazomax'].' meses.';
					else
						$text =  'Tu meta será posible en '.date("M", $nextDate).' de '.date("Y", $nextDate).'.   Debes ahorrar '.number_format($salidas['ahorro']['tiempo']).' meses y entonces podrás solicitar un credito por '.$salida['plazomax'].' meses.';
					
				}				
			}
			else
			{
				if ($sueno->getValue('cuota_inicial') != 0)
				{
						$text =  'Tu meta será posible en '.date("M", $nextDate).' de '.date("Y", $nextDate).'.  Tu cuota inicial no es suficiente, debes ahorrar otros '.number_format($salidas['ahorro']['tiempo']).' meses y en ese entonces podras solicitar un credito a '.$salida['plazomax'].' meses.';
				}
				else
				{
						$text =  'Tu meta será posible en '.date("M", $nextDate).' de '.date("Y", $nextDate).'.   Debes ahorrar '.number_format($salidas['ahorro']['tiempo']).' meses y entonces podrás solicitar un credito por '.$salida['plazomax'].' meses.';					
				}					
			}
			//function getDiagram($ahorro, $credito, $cuota_inicial, $ahorromes, $ahorrototal, $plazomaximo, $tiemposueno)
			getDiagram($salida['ahorro_total'], $salida['creditocuota']*$salida['plazomax'], $sueno->getValue('cuota_inicial'), $salida['ahorro_mes'], $salida['ahorro_total'], $salida['plazomax'], $salida['tiempo'], $salida['creditocuota'], $salida['creditocuota']*$salida['plazomax'], $text, $salida['tipo']);
		}			
		if ($salida['tipo'] == 'inferior')
		{
			if ($sueno->getValue('tiempo_sueno') > 0)
			{
				$time		= intval($sueno->getValue('tiempo_sueno'));
				$nextDate	= strtotime(date("Y-m-d", strtotime(date('Y-m-d'))) . " +".$time." month");				
				if ($sueno->getValue('cuota_inicial') != 0)
				{
					if (($sueno->getValue('tiempo_sueno') > 0) && ($sueno->getValue('suen_porcentaje_ahorro') != 0))
						$text =  'Tus condiciones actuales dificultan que puedas cumplir tu meta especifica cuando y como quieres pese a lo que logras ahorrar hasta '.date("M", $nextDate).' de '.date("Y", $nextDate).'  y lo que tienes de cuota inicial. Sin embargo para esa fecha podrías disminuir el monto específico de tu meta y solicitar un crédito a '.$salida['tiempo'].' pagando una cuota mensual de $'.number_format($salida['cuota'], 0, ',', '.');
					else
						$text =  'Tus condiciones actuales dificultan que puedas cumplir tu meta especifica cuando y como quieres pese a lo que tienes de cuota inicial. Puedes disminuir tu meta especifica para que en '.date("M", $nextDate).' de '.date("Y", $nextDate).' puedas solicitar un crédito a '.$salida['tiempo'].' pagando una cuota mensual de $'.number_format($salida['cuota'], 0, ',', '.');
				}
				else
				{
					if (($sueno->getValue('tiempo_sueno') > 0) && ($sueno->getValue('suen_porcentaje_ahorro') != 0))
						$text =  'Tus condiciones actuales dificultan que puedas cumplir tu meta especifica cuando y como quieres pese a lo que logras ahorrar hasta '.date("M", $nextDate).' de '.date("Y", $nextDate).'. Sin embargo para esa fecha podrías disminuir el monto específico de tu meta y solicitar un crédito a '.$salida['tiempo'].' pagando una cuota mensual de $'.number_format($salida['cuota'], 0, ',', '.');
					else
						$text =  'Tus condiciones actuales dificultan que puedas cumplir tu meta especifica cuando y como quieres. Puedes disminuir tu meta especifica para que en '.date("M", $nextDate).' de '.date("Y", $nextDate).' puedas solicitar un crédito a '.$salida['tiempo'].' pagando una cuota mensual de $'.number_format($salida['cuota'], 0, ',', '.');
					
				}				
			}
			else
			{
				if ($sueno->getValue('cuota_inicial') != 0)
				{
						$text =  'Tus condiciones actuales dificultan que puedas cumplir tu meta especifica cuando y como quieres pese a lo que tienes de cuota inicial. Puedes disminuir tu meta especifica para que puedas solicitar un crédito a '.$salida['tiempo'].' pagando una cuota mensual de $'.number_format($salida['cuota'], 0, ',', '.');
				}
				else
				{
						$text =  'Tus condiciones actuales dificultan que puedas cumplir tu meta especifica cuando y como quieres. Puedes disminuir tu meta especifica para que puedas solicitar un crédito a '.$salida['tiempo'].' pagando una cuota mensual de $'.number_format($salida['cuota'], 0, ',', '.');
				}					
			}					
			getDiagram($sueno->getValue('cuota_ini_calc'), $salida['total']-$sueno->getValue('cuota_ini_calc'), $sueno->getValue('cuota_inicial'), $sueno->getValue('ahorromes'), $sueno->getValue('ahorrototal'), $salida['tiempo'], $sueno->getValue('tiempo_sueno'), $salida['cuota'], $salida['cuota']*$salida['tiempo'], $text, $salida['tipo']);			
		}
		if ($salida['tipo'] == 'increment')
		{
			if ($sueno->getValue('tiempo_sueno') > 0)
			{
				$time		= intval($sueno->getValue('tiempo_sueno'));
				$nextDate	= strtotime(date("Y-m-d", strtotime(date('Y-m-d'))) . " +".$time." month");				
				if ($sueno->getValue('cuota_inicial') != 0)
				{
					if (($sueno->getValue('tiempo_sueno') > 0) && ($sueno->getValue('suen_porcentaje_ahorro') != 0))
						$text =  'Tus ingresos actuales, no son suficientes para cumplir tu meta cuando y como quieres pese a lo que logras ahorrar hasta '.date("M", $nextDate).' de '.date("Y", $nextDate).'  y lo que tienes de cuota inicial. Para conseguir tu meta, puedes aumentar tus ingreso en '.number_format($salida['cuota'], 0, ',', '.').' y solicitar un crédito a '.$salida['tiempo'];
					else
						$text =  'Tus ingresos actuales, no son suficientes para cumplir tu meta cuando y como quieres pese a tu cuota inicial. Para  conseguir tu meta en '.date("M", $nextDate).' de '.date("Y", $nextDate).', puedes aumentar tus ingreso en '.number_format($salida['cuota'], 0, ',', '.').' y solicitar un crédito a '.$salida['tiempo'];
				}
				else
				{
					if (($sueno->getValue('tiempo_sueno') > 0) && ($sueno->getValue('suen_porcentaje_ahorro') != 0))
						$text =  'Tus ingresos actuales, no son suficientes para cumplir tu meta cuando y como quieres pese a lo que logras ahorrar hasta '.date("M", $nextDate).' de '.date("Y", $nextDate).'. Para conseguir tu meta, puedes aumentar tus ingreso en '.number_format($salida['cuota'], 0, ',', '.').' y solicitar un crédito a '.$salida['tiempo'];
					else
						$text =  'Tus ingresos actuales, no son suficientes para cumplir tu meta cuando y como quieres . Para conseguir tu meta, puedes aumentar tus ingreso en '.number_format($salida['cuota'], 0, ',', '.').' y solicitar un crédito a '.$salida['tiempo'];
					
				}				
			}
			else
			{
				if ($sueno->getValue('cuota_inicial') != 0)
				{
						$text =  'Tus ingresos actuales, no son suficientes para cumplir tu meta cuando y como quieres pese a lo que tienes de cuota inicial. Para conseguir tu meta, puedes aumentar tus ingreso en '.number_format($salida['cuota'], 0, ',', '.').' y solicitar un crédito a '.$salida['tiempo'];
				}
				else
				{
						$text =  'Tus ingresos actuales, no son suficientes para cumplir tu meta cuando y como quieres . Para conseguir tu meta, puedes aumentar tus ingreso en '.number_format($salida['cuota'], 0, ',', '.').' y solicitar un crédito a '.$salida['tiempo'];
				}					
			}				
			getDiagram($sueno->getValue('cuota_ini_calc'), $salida['total']*$salida['tiempo'], $sueno->getValue('cuota_inicial'), $sueno->getValue('ahorromes'), $sueno->getValue('ahorrototal'), $salida['tiempo'], $sueno->getValue('tiempo_sueno'), $salida['total'], $salida['total']*$salida['tiempo'], $text, $salida['tipo']);
		}
		if ($salida['tipo'] == 'reduce')
		{
			if ($sueno->getValue('tiempo_sueno') > 0)
			{
				$time		= intval($sueno->getValue('tiempo_sueno'));
				$nextDate	= strtotime(date("Y-m-d", strtotime(date('Y-m-d'))) . " +".$time." month");				
				if ($sueno->getValue('cuota_inicial') != 0)
				{
					if (($sueno->getValue('tiempo_sueno') > 0) && ($sueno->getValue('suen_porcentaje_ahorro') != 0))
						$text =  'Tu forma actual de consumo y gasto reducen tus alternativas para conseguir tu meta cuando y como quieres pese a lo que logras ahorrar hasta '.date("M", $nextDate).' de '.date("Y", $nextDate).'  y lo que tienes de cuota inicial. Para remediar esto, puedes disminuir tus gastos de la siguiente manera: el financiero en '.number_format($salida['tiempo'], 0, ',', '.').' y el no financiero en '.number_format($salida['cuota'], 0, ',', '.').' y solicitar un crédito a '.$salida['tiempo'].' pagando una cuota mensual de $'.number_format($sueno->getValue('valor_credito'), 0, ',', '.');
					else
						$text =  'Tus ingresos actuales, no son suficientes para cumplir tu meta cuando y como quieres pese a lo que tienes de cuota inicial '.date("M", $nextDate).' de '.date("Y", $nextDate).'. Para conseguir tu meta, puedes aumentar tus ingreso en '.number_format($salida['cuota'], 0, ',', '.').' y solicitar un crédito en '.date("M", $nextDate).' de '.date("Y", $nextDate).'  a '.$salida['tiempo'].' pagando una cuota mensual de $'.number_format($salida['total'], 0, ',', '.');
				}
				else
				{
					if (($sueno->getValue('tiempo_sueno') > 0) && ($sueno->getValue('suen_porcentaje_ahorro') != 0))
						$text =  'Tus ingresos actuales, no son suficientes para cumplir tu meta cuando y como quieres pese a lo que logras ahorrar hasta '.date("M", $nextDate).' de '.date("Y", $nextDate).'. Para conseguir tu meta, puedes aumentar tus ingreso en '.number_format($salida['cuota'], 0, ',', '.').' y solicitar un crédito a '.$salida['tiempo'].' pagando una cuota mensual de $'.number_format($salida['total'], 0, ',', '.');
					else
						$text =  'Tus ingresos actuales, no son suficientes para cumplir tu meta cuando y como quieres. Para conseguir tu meta, puedes aumentar tus ingreso en '.number_format($salida['cuota'], 0, ',', '.').' y solicitar un crédito en '.date("M", $nextDate).' de '.date("Y", $nextDate).'  a '.$salida['tiempo'].' pagando una cuota mensual de $'.number_format($salida['total'], 0, ',', '.');
					
				}				
			}
			else
			{
				if ($sueno->getValue('cuota_inicial') != 0)
				{
						$text =  'Tus ingresos actuales, no son suficientes para cumplir tu meta cuando y como quieres pese a lo que tienes de cuota inicial. Para conseguir tu meta, puedes aumentar tus ingreso en '.number_format($salida['cuota'], 0, ',', '.').' y solicitar un crédito a '.$salida['tiempo'].' pagando una cuota mensual de $'.number_format($salida['total'], 0, ',', '.');
				}
				else
				{
						$text =  'Tus ingresos actuales, no son suficientes para cumplir tu meta cuando y como quieres. Para conseguir tu meta, puedes aumentar tus ingreso en '.number_format($salida['cuota'], 0, ',', '.').' y solicitar un crédito en '.date("M", $nextDate).' de '.date("Y", $nextDate).'  a '.$salida['tiempo'].' pagando una cuota mensual de $'.number_format($salida['total'], 0, ',', '.');
				}					
			}			
			//function getDiagram($ahorro, $credito, $cuota_inicial, $ahorromes, $ahorrototal, $plazomaximo, $tiemposueno, $cuota, $total, $mensaje= '', $divName)

			getDiagram($sueno->getValue('cuota_ini_calc'), $salida['cuota-mes']*$salida['plazomax'], $sueno->getValue('cuota_inicial'), $sueno->getValue('ahorromes'), $sueno->getValue('ahorrototal'), $salida['plazomax'], $sueno->getValue('tiempo_sueno'), $salida['cuota-mes'], $salida['cuota-mes']*$salida['plazomax'], $text, $salida['tipo']);			
		}
		//echo '<pre>';
		//print_r($salida);
		//echo '</pre>';
		
	}	
?>

<?php
}
?>
                    
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
				  	
				    	<div class="goal margin-top-10">
							<div class="row">
								<div class="five columns">
									<img src="<?php echo APPLICATION_URL?>/images/goals/big/carro.png" alt="estudio" width="" height="" />
								</div>
								
								
								<div class="seven columns">
									<h6 class="whitetxt txt-shadow-black uppercase"><strong><?php echo $objetivo;?></strong></h6>
								</div>
								
								<div class="row text-left">
								
									<hr class="white" />
									<h6 class="whitetxt thin txt-shadow-black">Tiempo:<br /> <strong class="uppercase large"><?php echo $_POST['tiempo_sueno'];?> MESES</strong><br /></h6>
									<h6 class="whitetxt thin txt-shadow-black">Valor: <br /><strong class="uppercase large">$<?php echo number_format($_POST['valor_bien']);?></strong><br /></h6>
									<h6 class="whitetxt thin txt-shadow-black">Préstamo:<br /><strong class="uppercase large">$<?php echo number_format(intval($_POST['valor_bien'])-intval($_POST['cuota_inicial']));?></strong><br /></h6>
								</div>
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
<script type="text/javascript">
	
$(document).ready(function () 
{
<?php
	foreach ($salidas as $salida)
	{		
		if (($salida['tipo'] == 'ahorro') || ($salida['tipo'] == 'inferior') || ($salida['tipo'] == 'increment') || ($salida['tipo'] == 'reduce'))
			echo '	$("#'.$salida['tipo'].'").slideUp();
';
	}
?>
});

function openDiv(obj)
{
	$(".container_all").slideUp()
	$("#"+obj).slideDown();
}

</script>
		
		
</body>
</html>
