<?php
foreach ($_POST as $key=>$value)
	$_POST[$key] = str_replace(".", "", str_replace("$", "", $value));
switch ($_GET[0]):
	case '1':
		$objetivo = 'Pagar estudio propio';
	break;
	case '2':
		$objetivo = 'Crear un fondo de emergencia';
	break;
	case '3':
		$objetivo = 'Carro';
	break;						
	case '4':
		$objetivo = 'Moto';
	break;								
	case '5':
		$objetivo = 'Casa';
	break;	
	case '6':
		$objetivo = 'Matrimonio';
	break;							
	case '7':
		$objetivo = 'Tener un hijo';
	break;							
	case '8':
		$objetivo = 'Pagar estudio de mis hijos';
	break;							
	case '9':
		$objetivo = 'Empezar un negocio';
	break;							
	case '10':
		$objetivo = 'Pagar deudas';
	break;						
	case '11':
		$objetivo = 'Irme de vacaciones';
	break;							
	case '12':
		$objetivo = 'Pagar un tratamiento médico o estético';
	break;								
	case '13':
		$objetivo = 'Ahorrar dinero adicional para el retiro';
	break;							
	case '14':
		$objetivo = 'Tener plata para hacer inversiones';
	break;								
	case '16':
		$objetivo = 'Remodelar la casa';
	break;							
	case '17':
		$objetivo = 'Comprar electrodomésticos';
	break;							
	case '18':
		$objetivo = 'Tener un plática extra';
	break;							
	default:
		$objetivo = 'Otro';
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
	<meta name="viewport" content="width=device-width" />

	<title>Rocket: La forma divertida de tener el control de tus finanzas</title>

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
	<script language="JavaScript" src="<?php echo APPLICATION_URL?>javascripts/jquery.min.js" ></script>
	<script language="JavaScript" src="<?php echo APPLICATION_URL?>javascripts/jquery-ui-1.8.20.custom.min.js" ></script>
	<script language="JavaScript" src="<?php echo APPLICATION_URL?>javascripts/goals-behaviors.js" ></script>
	<script language="JavaScript" src="<?php echo APPLICATION_URL?>javascripts/global-functions.js" ></script>
	<script language="JavaScript" src="<?php echo APPLICATION_URL?>js/ajax_lib.js" ></script>
	<script language="JavaScript" src="<?php echo APPLICATION_URL?>js/ajax_helper.js" ></script>
	<script language="JavaScript" src="<?php echo APPLICATION_URL?>js/form_parser_helper.js" ></script>
	<script language="JavaScript" src="<?php echo APPLICATION_URL?>js/helpers.js" ></script>
	<script language="JavaScript" src="<?php echo APPLICATION_URL?>js/finanzas.js" ></script>
	<script language="JavaScript">
		function validateInputs() {
			var validData = true;
			data = new Array();
			if(($('#income').val() == '') || ($('#income').val() == '$') || ($('#income').val() == '$0')) {
				validData = false;
				data[data.length] = "- Debe seleccionar su ingreso neto para continuar.";
			}
			/*f(($('#time').val() == '') || ($('#time').val() == '0')) {
				validData = false;
				data[data.length] = "- Debe seleccionar el tiempo en el que quiere hacer su sueño realidad para continuar.";
			}*/
			
			if(!validData)
			{
				parseAlert(1, data);
				return false;
			}
			else {
				return true;
			}
		}
	</script>

	<!-- IE Fix for HTML5 Tags -->
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

</head>
<body>


<!--1. HEADER -->
<?php	
include_once('header.php');	
$userData 	= unserialize($user->__get('user_data'));
?>
<!--1. /HEADER -->
	




<div class="menu"><!-- 2 MENU -->
	<div class="container"><!-- Container Padding 20px -->
		<div class="row"> <!-- row -->
			<div class="two columns"> <!-- 2 col -->
				<ul class="nav-bar left"> <!-- nav-var -->
					<li>
						<a href="<?php echo APPLICATION_URL?>/private/home.html" class="main"><span class="nav-icon" aria-hidden="true" data-icon="q"></span> Inicio</a>
					</li>
				</ul> <!-- /nav-var -->
    	    </div> <!-- /2 col -->
    	    
    	    <div class="ten columns"><!-- 10 col -->
				<ul class="nav-bar right"> <!-- nav-var -->
					<li>
						<a href="/private/diagnostico-000.html" class="main">
							<span class="nav-icon" aria-hidden="true" data-icon="w"></span> 
							<span class="nav-text">Diagnóstico <br><span class="thin x-small uppercase">Análisis financiero</span></span>
						</a>
					</li>
					<li>
						<a href="/private/metas-000.html" class="main activo">
							<span class="nav-icon" aria-hidden="true" data-icon="e"></span> 
							<span class="nav-text">Metas <br><span class="thin x-small uppercase">Alcanza tu meta</span></span>
						</a>
					</li>
					
					<li>
						<a href="/private/descubra-000.html" class="main">
							<span class="nav-icon" aria-hidden="true" data-icon="r"></span> 
							<span class="nav-text">Descubra <br><span class="thin x-small uppercase">Identifica el producto</span></span>
						</a>
					</li>
					<li class="active-bread">
						<a href="/private/sobres-000.html" class="main">
							<span class="nav-icon" aria-hidden="true" data-icon="t"></span> 
							<span class="nav-text">Sobres <br><span class="thin x-small uppercase">Finanzas personales</span></span>
						</a>
					</li>
				</ul> <!-- /nav-var -->
			</div> <!-- /10 col -->
		</div><!-- /row -->
	</div><!-- /Container Padding 20px -->
</div><!-- 2. /MENU -->
<!--1. /HEADER -->
	


<!--2. MAIN-->
<form action="<?php echo APPLICATION_URL?>/private/metas-040/3.html" method="post">
<div id="main"> 
	<div class="container principal clearfix"><!-- Container Padding 20px -->


<div class="row"><!-- breadcrumb -->
		<ol class="breadcrumb-metas clearfix">
			<li class="start-li"><span aria-hidden="true" data-icon="w"></span></li>
			<li>Selección <span aria-hidden="true" class="greentxt" data-icon="f"></span></li>
			<li>Costos <span aria-hidden="true" class="greentxt" data-icon="f"><span class="dot"></span></span></li>
			<li class="active-bread">Finanzas <span aria-hidden="true" class="greentxt" data-icon="f"><span class="dot"></span></span></li>
			<li>Cuota <span aria-hidden="true" class="greentxt" data-icon="f"><span class="dot"></span></span></li>
			<li>Resultado <span aria-hidden="true" class="greentxt" data-icon="f"><span class="dot"></span></span></li>
			<li class="finish-li"><span aria-hidden="true" data-icon="a"></span></li>
		</ol>
</div><!-- /breadcrumb -->
<script type="text/javascript">
	
$(document).ready(function () {
	//console.log('Finanzas');
	$("li:contains('Finanzas')").addClass("active-bread");
	});

</script>	

		<!-- 2.2 Row: Content -->
		<div class="row">
			<div class="nine columns"><!-- Main Panel Width -->
				<div class="panel header-explorar"> <!-- panel -->
					
					<!-- Ribbon -->
					<div class="ribbon">
						<h2><span class="head-e"><span class="sprite-1 metas-icon">Icon</span></span><strong>Metas:</strong> Cómo manejas tu dinero</h2>
						<img src="/private/images/border.png" class="right border" width="12" height="44">
					</div>
					<!-- /Ribbon -->
					
						<div class="row question"><!-- Row Question 3 -->
							<br>
							<div class="eleven columns centered"><!-- 11 col -->
								<h5 class="text-center greytxt no-margin"><strong>Dependiendo de cómo manejes tu dinero, cuánto te entra y cuanto te sale, te podremos decir que productos se adaptan mejor a ti. </strong></h5>
							</div>
							<br>
							<div class="blue-shadow"><img src="/private/images/shadow-03.png" alt="" width="" height=""></div>
						</div>
					
										
					<!-- Question 1 -->
					<div class="row question">
										
					 	
						    <!-- Tooltip -->
						   	<div class="tooltip-info" style="display:none;">
						   	<a href="#" class="sprite-1 close-icon">1</a>
						    	<h6 class="greentxt"><strong>Porqué te preguntamos esto</strong></h6>
						    	<hr>
						    	<p class="greytxt"><strong>¿Cuanto es tu ingreso neto?</strong><br>
								Para poder orientarte en la mejor forma de obtener tu crédito necesitamos esta variable, la cual es muy importante.
						    	</p>
					 		</div>
					 		<!-- /Tooltip -->
				
						<div class="container margin-top-40">
								<div class="row"><!-- Row Result -->
									<div class="twelve columns">
									<div class="row">
										<h3 class="six columns"><strong>Ingresos</strong> <span class="small greytxt"><em>(lo que te entra mensualmente)</em></span></h3>
										<h5 class="six columns text-right finanzas-total bar3text"><span class="small greytxt">Total:</span><strong> $750.000</strong></h5>
										
									</div>
										<div class="total-bar">
											<div class="padding-5 clearfix bar3">
												<div class="blue-bar left round-left" style="width: 60%; ">60%</div>
												<div class="green-bar left" style="width: 20%; ">20%</div>
												<div class="orange-bar round-right left" style="width: 20%; ">20%</div>
											</div>
										</div>
									</div>
							 	</div><!-- Row Result -->
							 	
							<div class="row"><!-- Row Result -->
							 		<div class="four columns"><!-- Col 1/3 -->
							 		<h5 class="text-center greytxt no-margin txt-shadow-white"><strong><span class="bluetxt">•</span> Ingreso</strong></h5>
							 			<table class="blank-table">
											<tbody><tr>
											    <td><a href="#" class="sprite-1 less-than">less</a></td>
											    <td><input class="finanzas-input expand bluetxt" rel="bar3" type="text" placeholder="0" name="salud_28-1" id="ingresos" value="450.000"></td>
											    <td><a href="#" class="sprite-1 more-than">more</a></td>
											</tr>
										</tbody></table>
							 		<p class="text-center small">Ingreso promedio mensual.</p>
							 		</div><!-- /Col 1/3 -->
							 		<div class="four columns"><!-- Col 2/3 -->
							 		<h5 class="text-center greytxt no-margin txt-shadow-white"><strong><span class="greentxt">•</span> Pensión mensual</strong></h5>
							 			<table class="blank-table">
											<tbody><tr>
											    <td><a href="#" class="sprite-1 less-than">less</a></td>
											    <td><input class="finanzas-input expand greentxt" rel="bar3" type="text" placeholder="0" name="salud_28-2" id="pension" value="150.000"></td>
											    <td><a href="#" class="sprite-1 more-than">more</a></td>
											</tr>
										</tbody></table>
							 		<p class="text-center small">Si eres pensionado, ¿a cuanto asciende tu pensión?</p>
							 		</div><!-- /Col 2/3 -->
							 		<div class="four columns"><!-- Col 3/3 -->
							 		<h5 class="text-center greytxt no-margin txt-shadow-white"><strong><span class="orangetxt">•</span> Otros ingresos</strong></h5>
							 			<table class="blank-table">
											<tbody><tr>
											    <td><a href="#" class="sprite-1 less-than">less</a></td>
											    <td><input class="finanzas-input expand orangetxt" rel="bar3" type="text" placeholder="0" name="salud_28-3" id="otros_ingresos" value="150.000"></td>
											    <td><a href="#" class="sprite-1 more-than">more</a></td>
											</tr>
										</tbody></table>
							 		<p class="text-center small">Si tienes otros ingresos diferentes a sueldo o pensión, ingresalos acá.</p>
							 		</div><!-- /Col 3/3 -->
							 	</div><!-- /Row Result -->
							
					<!-- /Question 1 -->
					
					<!-- Question 2 -->
					
					<div class="row question">
						    <!-- Tooltip -->
						   	<div class="tooltip-info" style="display:none;">
						   	<a href="#" class="sprite-1 close-icon">1</a>
						    	<h6 class="greentxt"><strong>Porqué te preguntamos esto</strong></h6>
						    	<hr>
						    	<p class="greytxt"><strong>¿Cuantos son tus gastos mensuales diferentes a crédito?</strong><br>
								Para poder orientarte en la mejor forma de obtener tu crédito necesitamos esta variable, la cual es muy importante.</p>
					 		</div>
					 		<!-- /Tooltip -->
					
				
							<div class="row margin-top-40"><!-- Row Result -->
								<div class="twelve columns">
									<div class="row">
										<h3 class="nine columns"><strong>Gastos y ahorro</strong> <span class="small greytxt"><em>(Lo que gastas cada mes para vivir y ahorrar)</em></span></h3>
										<h5 class="three columns text-right finanzas-total bar5text"><span class="small greytxt">Total:</span><strong> $200.000</strong></h5>
									</div>
									<div class="total-bar">
										<div class="padding-5 clearfix bar5">
											<div class="blue-bar left round-left" style="width: 25%; ">25%</div>
											<div class="green-bar left" style="width: 50%; ">50%</div>
											<div class="orange-bar round-right left" style="width: 25%; ">25%</div>
										</div>
									</div>
								</div>
							 </div><!-- Row Result -->
							 	
								<div class="row"><!-- Row Result -->
							 		<div class="four columns"><!-- Col 1/3 -->
							 		<h5 class="text-center greytxt no-margin txt-shadow-white"><strong><span class="bluetxt">•</span> Servicios públicos</strong></h5>
							 			<table class="blank-table">
											<tbody><tr>
											    <td><a href="#" class="sprite-1 less-than">less</a></td>
											    <td><input class="finanzas-input expand bluetxt" rel="bar5" type="text" placeholder="0" name="salud_26" value="50.000"></td>
											    <td><a href="#" class="sprite-1 more-than">more</a></td>
											</tr>
										</tbody></table>
							 		<p class="text-center small">¿Cuánto pagas en promedio al mes por tus recibos de servicios públicos, celular, medicina prepagada y pensión del colegio?</p>
							 		</div><!-- /Col 1/3 -->
							 		<div class="four columns"><!-- Col 2/3 -->
							 		<h5 class="text-center greytxt no-margin txt-shadow-white"><strong><span class="greentxt">•</span> Otros gastos</strong></h5>
							 			<table class="blank-table">
											<tbody><tr>
											    <td><a href="#" class="sprite-1 less-than">less</a></td>
											    <td><input class="finanzas-input expand greentxt" rel="bar5" type="text" placeholder="0" name="salud_27" value="100.000"></td>
											    <td><a href="#" class="sprite-1 more-than">more</a></td>
											</tr>
										</tbody></table>
							 		<p class="text-center small">¿Cuánto suman los gastos mensuales que tienes que hacer por el resto de cosas sin incluir ahorros? (comida, transporte, hogar etc.)</p>
							 		</div><!-- /Col 2/3 -->
							 		<div class="four columns"><!-- Col 3/3 -->
							 		<h5 class="text-center greytxt no-margin txt-shadow-white"><strong><span class="orangetxt">•</span> Ahorro</strong></h5>
							 			<table class="blank-table">
											<tbody><tr>
											    <td><a href="#" class="sprite-1 less-than">less</a></td>
											    <td><input class="finanzas-input expand orangetxt" rel="bar5" type="text" placeholder="0" name="salud_29" value="50.000"></td>
											    <td><a href="#" class="sprite-1 more-than">more</a></td>
											</tr>
										</tbody></table>
							 		<p class="text-center small">¿Cuánto ahorras de tu ingreso mensual? Incluye pensiones voluntarias</p>
							 		</div><!-- /Col 3/3 -->
							 	</div><!-- /Row Result -->
							</div>
					<!-- /Question 2 -->
						<div class="otros-gastos margin-top-40"><!-- Otros Gastos -->
								<div class="row"><!-- Row Result -->
									<div class="twelve columns">
										<div class="row">
											<h3 class="nine columns"><strong>Gastos en créditos</strong> <span class="small greytxt"><em>(Lo que gastas cada mes en pagar tus créditos)</em></span></h3>
											<h5 class="three columns text-right finanzas-total bar4text"><span class="small greytxt">Total:</span><strong> $550.000</strong></h5>
										</div>
										<div class="total-bar">
											<div class="padding-5 clearfix bar4">
												<div class="blue-bar left round-left" style="width: 27.27272727272727%; ">27%</div>
												<div class="green-bar left" style="width: 36.36363636363637%; ">36%</div>
												<div class="orange-bar left" style="width: 36.36363636363637%; ">36%</div>
											</div>
										</div>
									</div>
							 	</div><!-- Row Result -->
							 	
							 	<div class="row"><!-- Row Result -->
							 		<div class="four columns"><!-- Col 3/4 -->
							 		<h5 class="text-center greytxt no-margin txt-shadow-white"><strong><span class="orangetxt">•</span> Cuota hipotecaria</strong></h5>
							 			<table class="blank-table">
											<tbody><tr>
											    <td><a href="#" class="sprite-1 less-than">less</a></td>
											    <td><input class="finanzas-input expand orangetxt" rel="bar4" type="text" placeholder="0" name="salud_24" value="150.000"></td>
											    <td><a href="#" class="sprite-1 more-than">more</a></td>
											</tr>
										</tbody></table>
							 		<p class="text-center small">¿Cuánto pagaste por tu cuota del crédito o leasing de vivienda el mes pasado?</p>
							 		</div><!-- /Col 3/4 -->
							 		<div class="four columns"><!-- Col 4/4 -->
							 		<h5 class="text-center greytxt no-margin txt-shadow-white"><strong><span class="aquatxt">•</span> Tarjeta de crédito</strong></h5>
							 			<table class="blank-table">
											<tbody><tr>
											    <td><a href="#" class="sprite-1 less-than">less</a></td>
											    <td><input class="finanzas-input expand aquatxt" rel="bar4" type="text" placeholder="0" name="salud_25" value="200.000"></td>
											    <td><a href="#" class="sprite-1 more-than">more</a></td>
											</tr>
										</tbody></table>
							 		<p class="text-center small">¿Cuánto pagas en promedio cada mes por tu crédito rotativo y/o tarjeta de crédito?</p>
							 		</div><!-- /Col 4/4 -->                                
							 		<div class="four columns"><!-- Col 1/4 -->
							 		<h5 class="text-center greytxt no-margin txt-shadow-white"><strong><span class="bluetxt">•</span> Créditos</strong></h5>
							 			<table class="blank-table">
											<tbody><tr>
											    <td><a href="#" class="sprite-1 less-than">less</a></td>
											    <td><input class="finanzas-input expand bluetxt" rel="bar4" type="text" placeholder="0" name="salud_23-1" value="200.000"></td>
											    <td><a href="#" class="sprite-1 more-than">more</a></td>
											</tr>
										</tbody></table>
							 		<p class="text-center small">¿Cúanto pagaste el mes pasado por tus créditos con entidades financieras y/o familiares o amigos?</p>
							 		</div><!-- /Col 1/4 -->
							 	</div><!-- /Row Result -->
						 </div><!-- Gastos Finacieros -->
					</div>
				</div>
				<br><br>
				<!-- Question 2 -->
				<!-- <div class="main-footer" ></div> -->
					<div class="shadow"><img src="/private/images/shadow-1.png" alt="shadow-1" width="1024" height="20"></div>
						<div class="text-center">
							   
							<a href="javascript:void(0);" onclick="window.history.go(-1);" class="pretty-btn"><span class="whitetxt large baseline" aria-hidden="true" data-icon="x"></span> Anterior</a>
							<input type="submit" value="Siguiente" class="pretty-btn submit">
						</div>
						<br><br>
					</div>
					<div class="blue-shadow"><img src="/private/images/shadow.png" alt="" width="" height=""></div>
				</div> <!-- /panel -->
			
			<div class="three columns"><!-- Sidebar -->
				<div class="bluebox-fixed box-shadow round-1"><!-- bluebox -->
				    <div class="padding-10"><!-- /Padding 10 -->
				    	<!-- title -->
						<div class="goal ui-draggable" style="position: relative; ">
							<a href="metas-020/carro.html" title=""><div class="goal-3 sprite-goals">Carro</div></a>
						</div>
						<h2>Carro</h2>
	                    <h3></h3>
	                    <br>
	                    
						<ul class="list text-center">
							<li class="whitetxt txt-shadow-black"><strong>Valor de la meta:</strong><br> <span class="big">$0</span></li>	
									                        <li class="whitetxt txt-shadow-black"><strong>Valor del préstamo:</strong><br> <span class="big">$</span></li>
	                        						</ul>
						</div>
					</div>
				</div><!-- /Sidebar -->
			</div><!-- /Main row -->
		</div>
		<!-- 2.2 /Row: Content -->
	</div><!-- /Container Padding 20px -->

</form>
<!--2. /MAIN--> 	


<div><a href="/private/private/feedback-000.html" class="feedback">Comentarios</a></div> 

<div class="footer grad1"><!--4. Block: FOOTER -->
	<div class="container"><!-- Container Padding 20px -->
		<div class="row"><!-- ROW Footer -->
		
			<div class="seven columns">
				<div class="row">
					<div class="four columns">
						<h6 class="no-top-margin greentxt"><span class="whitetxt large footer-icon" aria-hidden="true" data-icon="i"></span> <strong>Rocket </strong><span class="greentxt footer-icon large" aria-hidden="true" data-icon="c"></span></h6>
					</div>
					<div class="four columns">
						<h6 class="no-top-margin greentxt"><span class="whitetxt large footer-icon" aria-hidden="true" data-icon="o"></span> <strong>Legal </strong><span class="greentxt footer-icon large" aria-hidden="true" data-icon="c"></span></h6>
					</div>
					<div class="four columns">
						<h6 class="no-top-margin greentxt"><span class="whitetxt large footer-icon" aria-hidden="true" data-icon="p"></span> <strong>Ayuda </strong><span class="greentxt footer-icon large" aria-hidden="true" data-icon="c"></span></h6>
					</div>			
				</div>
			</div>

		<div class="five columns"><!-- Block: Credits -->
			<div class="credits right">
				<p class="no-margin"><span class="whitetxt" aria-hidden="true" data-icon="u"></span><br>
				<small class="light-greytxt">Copyright 2012 Rocket</small></p>
			</div>
		</div><!-- /Block: Credits -->



		</div><!-- /ROW Footer -->
	</div><!-- /Container Padding 20px -->
</div><!--4. /Block: FOOTER -->






<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-32778960-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<!-- Included JS Files -->
 
<script type="text/javascript">
$(document).ready(function () 
{
	calculateBar('bar3');
	calculateBar('bar4');
	calculateBar('bar5');
});

function addCommas(nStr) {
	nStr += '';
	var x = nStr.split(',');
	var x1 = x[0];
	var x2 = x.length > 1 ? ',' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + '.' + '$2');
	}
	return x1 + x2;
}	

</script>



</body></html>