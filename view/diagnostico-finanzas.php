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

	<script src="<?php echo APPLICATION_URL;?>javascripts/jquery.min.js"></script>
	<script language="JavaScript" src="<?php echo APPLICATION_URL?>javascripts/diagnostics-behaviors.js" ></script>
	<script language="JavaScript" src="<?php echo APPLICATION_URL?>javascripts/global-functions.js" ></script>
	<script src="<?php echo APPLICATION_URL;?>js/jquery.knob-1.1.2.js"></script>	
    <script src="<?php echo APPLICATION_URL?>js/finanzas.js"></script>
    <script src="<?php echo APPLICATION_URL?>js/helpers.js"></script>
	<script language="JavaScript">
		function validateInputs() {
			var validData = true;
			data = new Array();
			if(isNaN(parseInt($('#ingresos').val().replace('.', '').replace('$', ''), 10)))
			{
				$('#ingresos').val(0);
			}
			if(isNaN(parseInt($('#pension').val().replace('.', '').replace('$', ''), 10)))
			{
				$('#pension').val(0);
			}
			if(isNaN(parseInt($('#otros_ingresos').val().replace('.', '').replace('$', ''), 10)))
			{
				$('#otros_ingresos').val(0);
			}
			if((parseInt($('#ingresos').val().replace('.', '').replace('$', ''), 10) + parseInt($('#pension').val().replace('.', '').replace('$', ''), 10) + parseInt($('#otros_ingresos').val().replace('.', '').replace('$', ''), 10)) <= 0) {
				validData = false;
				data[data.length] = "Los ingresos deben sumar mas de 0 para continuar.";
			}
			
			if(!validData)
			{
				parseAlert(1, data);
				return false;
			}
			else {
				document.getElementById('questions').submit();
				return true;
			}
		}
	</script>
</head>

<body>


<!--1. HEADER -->
<?php	
include_once('header.php');	
foreach ($_POST as $key=>$value)
{
	$userData 	= UserHelper::setData($user->__get('user_id'), $key, $value);
}
$userData 	= unserialize($user->__get('user_data'));
if (!isset($userData['user_income_representation']))
	javascriptExecute("window.location.href='".APPLICATION_URL."diagnostico-010.html'");
?>
<!--1. /HEADER -->
	


<!--2. MAIN-->
<div id="main"> 
	<div class="container principal clearfix"><!-- Container Padding 20px -->
	
<?php	
	$bread_name = array("Finanzas");
	$js_array = json_encode($bread_name);
	include_once('breadcrumbs.php');	
?>

		<form action="<?php echo APPLICATION_URL?>diagnostico-050.html" method="post" id="questions">
		<!-- 2.1 Row: Content -->
		<div class="row">
			<div class="twelve columns"><!-- Main Panel Width -->
				<div class="panel whitebg clearfix"> <!-- panel -->
					
					<!-- Ribbon -->
					<div class="ribbon">
						<h2><span class="head-e"><span class="sprite-1 diagnostico-icon">Icon</span></span><strong>Diagnóstico:</strong> Salud Financiera</h2>
						<img src="images/border.png" class="right border" width="12" height="44">
					</div>
					<!-- /Ribbon -->

						<div class="row question"><!-- Row -->
							<br />
							<div class="eleven columns centered"><!-- 11 col -->
								<h5 class="text-center greytxt no-margin"><strong>Muchas veces es difícil saber cómo estas manejando tu dinero, contesta estas preguntas para saber qué aspectos de tu salud financiera debes mejorar.</strong></h5>
							</div>
							<br />
							<div class="blue-shadow"><img src="<?php echo APPLICATION_URL?>images/shadow-03.png" alt="" width="" height=""></div>
						</div>	
										
					<!-- Content -->
					<div class="finanzas-main clearfix">
						<div class="container"><!-- Container -->
							
							
							<div class="pasivos"><!-- Activos -->
								<div class="row"><!-- Row Result -->
									<div class="twelve columns">
									<div class="row">
										<h4 class="six thin columns greytxt">Activos <span class="small greytxt"><em>(Lo que has trabajado, te han regalado o te has ganado)</em></span></h4>
										<h5 class="six columns text-right finanzas-total bar1text"><span class="small greytxt">Total:</span><strong> $0</strong></h5>
										
									</div>
										<div class="total-bar">
											<div class="padding-5 clearfix bar1">
												<div class="blue-bar left round-left" style="width:50%">50%</div>
												<div class="green-bar round-right left" style="width:50%">50%</div>
											</div>
										</div>
									</div>
							 	</div><!-- Row Result -->
							 	
							 	<div class="row"><!-- Row Result -->
									 <div class="eight columns centered">
									 	<div class="row">
									 		<div class="six columns"><!-- Col 1/2 -->
									 		<h5 class="text-center greytxt no-margin txt-shadow-white"><strong><span class="bluetxt">&#8226;</span> Activos líquido</strong></h5>
									 			<div class="text-center"> 
									 				<span class="small greytxt text-center"><em>(lo que puedes convertir en dinero facilmente)</em></span>
									 			</div>
									 			<table class="blank-table center">
													<tr>
													    <td><a class="less-than round-left" aria-hidden="true" data-icon="&#x6c;"></a></td>
													    <td><input class="finanzas-input expand bluetxt" rel="bar1" type="text" placeholder="0" name="salud_18" value="<?php echo (isset($userData['salud_18'])) ? number_format($userData['salud_18'], 0, ",", ".") : '';?>"/></td>
													    <td><a class="more-than round-right" aria-hidden="true" data-icon="&#x3b;"></a></td>
													</tr>
												</table>
									 		<p class="text-center small">¿Cuánto suma lo que tienes en efectivo, cuentas de ahorro, CDTs, carteras colectivas a la vista, cesantías, ahorro en fondos de empleados y pensiones voluntarias?</p>
									 		</div><!-- /Col 1/2 -->
									 		<div class="six columns"><!-- Col 2/2 -->
									 		<h5 class="text-center greytxt no-margin txt-shadow-white"><strong><span class="greentxt">&#8226;</span> Resto de activos</strong></h5>
									 			<div class="text-center"> 
									 				<span class="small greytxt text-center"><em>(lo que puedes vender)</em></span>
									 			</div>
									 			<table class="blank-table center">
													<tr>
													    <td><a class="less-than round-left" aria-hidden="true" data-icon="&#x6c;"></a></td>
													    <td><input class="finanzas-input expand greentxt" rel="bar1" type="text" placeholder="0" name="salud_19" value="<?php echo (isset($userData['salud_19'])) ? number_format($userData['salud_19'], 0, ",", ".") : '';?>"/></td>
													    <td><a class="more-than round-right" aria-hidden="true" data-icon="&#x3b;"></a></td>
													</tr>
												</table>
									 		<p class="text-center small">¿A cuánto asciende todo lo que has comprado durante la vida? (casa, carro o moto, electrodomésticos, muebles y enseres, computadores, Mp3, tabletas, joyas,  acciones, etc.)</p>
									 		</div><!-- /Col 2/2 -->
									 	</div>
									 </div>
							 	</div><!-- /Row Result -->
						 	</div><!-- /Activos -->
							
							<br
							<div class="pasivos"><!-- Pasivos -->
								<div class="row"><!-- Row Result -->
									<div class="twelve columns">
									<div class="row">
										<h4 class="six thin columns greytxt">Pasivos <span class="small greytxt"><em>(Lo que debes)</em></span></h4>
										<h5 class="six columns text-right finanzas-total bar2text"><span class="small greytxt">Total:</span><strong> $0</strong></h5>
										
									</div>
										<div class="total-bar">
											<div class="padding-5 clearfix bar2">
												<div class="blue-bar left round-left" style="width:25%">25%</div>
												<div class="green-bar left" style="width:25%">25%</div>
												<div class="orange-bar left" style="width:25%">25%</div>
												<div class="aqua-bar left round-right" style="width:25%">25%</div>
											</div>
										</div>
									</div>
							 	</div><!-- Row Result -->
							 	
							 	<div class="row"><!-- Row Result -->
							 		<div class="three columns"><!-- Col 1/4 -->
							 		<h5 class="text-center greytxt no-margin txt-shadow-white"><strong><span class="bluetxt">&#8226;</span> Deuda hipotecaria</strong></h5>
							 			<table class="blank-table">
											<tr>
											    <td><a class="less-than round-left" aria-hidden="true" data-icon="&#x6c;"></a></td>
											    <td><input class="finanzas-input expand bluetxt" rel="bar2" type="text" placeholder="0" name="salud_22" value="<?php echo (isset($userData['salud_22'])) ? number_format($userData['salud_22'], 0, ",", ".") : '';?>" /></td>
											    <td><a class="more-than round-right" aria-hidden="true" data-icon="&#x3b;"></a></td>
											</tr>
										</table>
							 		<p class="text-center small">¿Cuánto debes por el credito de tu casa hoy?</p>
							 		</div><!-- /Col 1/4 -->
							 		<div class="three columns"><!-- Col 2/4 -->
							 		<h5 class="text-center greytxt no-margin txt-shadow-white"><strong><span class="greentxt">&#8226;</span> Tarjetas y rotativos</strong></h5>
							 			<table class="blank-table">
											<tr>
											    <td><a class="less-than round-left" aria-hidden="true" data-icon="&#x6c;"></a></td>
											    <td><input class="finanzas-input expand greentxt" rel="bar2" type="text" placeholder="0" name="salud_21" value="<?php echo (isset($userData['salud_21'])) ? number_format($userData['salud_21'], 0, ",", ".") : '';?>"/></td>
											    <td><a class="more-than round-right" aria-hidden="true" data-icon="&#x3b;"></a></td>
											</tr>
										</table>
							 		<p class="text-center small">¿Cuánto debes entre tus tarjetas de crédito y créditos rotativos a hoy?</p>
							 		</div><!-- /Col 2/4 -->
							 		<div class="three columns"><!-- Col 3/4 -->
							 		<h5 class="text-center greytxt no-margin txt-shadow-white"><strong><span class="orangetxt">&#8226;</span>Otros Creditos</strong></h5>
							 			<table class="blank-table">
											<tr>
											    <td><a class="less-than round-left" aria-hidden="true" data-icon="&#x6c;"></a></td>
											    <td><input class="finanzas-input expand orangetxt" rel="bar2"  type="text" placeholder="0" name="salud_20-1" value="<?php echo (isset($userData['salud_20-1'])) ? number_format($userData['salud_20-1'], 0, ",", ".") : '';?>"/></td>
											    <td><a class="more-than round-right" aria-hidden="true" data-icon="&#x3b;"></a></td>
											</tr>
										</table>
							 		<p class="text-center small">¿Cuánto debes a entidades financieras, familiare amigos u otros? (carro, moto, estudio, libre inversión, etc... diferentes a vivienda y tarjetas). </p>
							 		</div><!-- /Col 3/4 -->
							 		<div class="three columns"><!-- Col 4/4 -->
							 		<h5 class="text-center greytxt no-margin txt-shadow-white"><strong><span class="aquatxt">&#8226;</span> Otros prestamos</strong></h5>
							 			<table class="blank-table">
											<tr>
											    <td><a class="less-than round-left" aria-hidden="true" data-icon="&#x6c;"></a></td>
											    <td><input class="finanzas-input expand aquatxt" rel="bar2" type="text" placeholder="0" name="salud_20-2" value="<?php echo (isset($userData['salud_20-2'])) ? number_format($userData['salud_20-2'], 0, ",", ".") : '';?>"/></td>
											    <td><a class="more-than round-right" aria-hidden="true" data-icon="&#x3b;"></a></td>
											</tr>
										</table>
							 		<p class="text-center small">¿Cuánto debes a familiares, amigos y demas hoy?</p>
							 		</div><!-- /Col 4/4 -->
							 	</div><!-- /Row Result -->
						 	</div><!-- Pasivos -->
						 	

						 	
						</div><!--/container-->
						
						 <div class="result-block"><!--result block-->
						 	<div class="container"><!--container-->
			                    <p class="mensaje-ap"></p>
							 	<div class="row"><!--row-->
								 	<div class="three columns">
								 		<h5><strong class="greytxt no-margin txt-shadow-white">Lo que tienes</strong> <span class="small greytxt"><em class="size-10">(ACTIVO)</em></span></h5>
								 		<h3 class="bluetxt activolbl">$345,324.905</h3>
								 	</div>
								 	
								 	<div class="one columns">
								 		<div class="sprite-1 substract">-</div>
								 	</div>
			
								 	<div class="three columns">
								 		<h5><strong class="greytxt no-margin txt-shadow-white">Lo que debes</strong> <span class="small greytxt"><em class="size-10">(PASIVO)</em></span></h5>
								 		<h3 class="greytxt pasivo">$345,324.905</h3>
								 	</div>
								 	
								 	<div class="one columns">
								 		<div class="sprite-1 equal">=</div>
								 	</div>
								 	
								 	<div class="four columns">
								 		<h5><strong class="greytxt no-margin txt-shadow-white">Lo que es tuyo realmente</strong> <span class="small greytxt"><em class="size-10">(PATRIMONIO)</em></span></h5>
								 		<h3 class="greentxt patrimonio">$345,324.905</h3>
								 	</div>
							 	</div><!--/row-->
						 	</div><!--/container-->
						 	<div class="shadow"><img src="<?php echo APPLICATION_URL?>images/shadow-03.png" alt="shadow-1" width="1024" height="20" /></div>
						 </div><!--/result block-->

					</div>
					<!-- /Content -->
					

					
					
					<!-- Content -->
					<div class="finanzas-main clearfix">
						<div class="container"><!-- Container -->
							
							
							<div class="ingresos"><!-- Ingresos -->
								<div class="row"><!-- Row Result -->
									<div class="twelve columns">
									<div class="row">
										<h4 class="six thin columns greytxt">Ingresos <span class="small greytxt"><em>(lo que te entra mensualmente)</em></span></h4>
										<h5 class="six columns text-right finanzas-total bar3text"><span class="small greytxt">Total:</span><strong> $0</strong></h5>
										
									</div>
										<div class="total-bar">
											<div class="padding-5 clearfix bar3">
												<div class="blue-bar left round-left" style="width:33%">33%</div>
												<div class="green-bar left" style="width:33%">33%</div>
												<div class="orange-bar round-right left" style="width:34%">34%</div>
											</div>
										</div>
									</div>
							 	</div><!-- Row Result -->
							 	
<div class="row"><!-- Row Result -->
							 		<div class="four columns"><!-- Col 1/3 -->
							 		<h5 class="text-center greytxt no-margin txt-shadow-white"><strong><span class="bluetxt">&#8226;</span> Ingresos por sueldo</strong></h5>
							 			<table class="blank-table">
											<tr>
											    <td><a class="less-than round-left" aria-hidden="true" data-icon="&#x6c;"></a></td>
											    <td><input class="finanzas-input expand bluetxt" rel="bar3" type="text" placeholder="0" name="salud_28-1" id="ingresos" value="<?php echo (isset($userData['salud_28-1'])) ? number_format($userData['salud_28-1'], 0, ",", ".") : '';?>" /></td>
											    <td><a class="more-than round-right" aria-hidden="true" data-icon="&#x3b;"></a></td>
											</tr>
										</table>
							 		<p class="text-center small">¿Cuántos son tus ingresos netos promedio mensuales? (despues de descontar esa tan lejana pensión, y tu costosa salud, etc.)</p>
							 		</div><!-- /Col 1/3 -->
							 		<div class="four columns"><!-- Col 2/3 -->
							 		<h5 class="text-center greytxt no-margin txt-shadow-white"><strong><span class="greentxt">&#8226;</span> Pensión mensual</strong></h5>
							 			<table class="blank-table">
											<tr>
											    <td><a class="less-than round-left" aria-hidden="true" data-icon="&#x6c;"></a></td>
											    <td><input class="finanzas-input expand greentxt" rel="bar3" type="text" placeholder="0" name="salud_28-2" id="pension" value="<?php echo (isset($userData['salud_28-2'])) ? number_format($userData['salud_28-2'], 0, ",", ".") : '';?>" /></td>
											    <td><a class="more-than round-right" aria-hidden="true" data-icon="&#x3b;"></a></td>
											</tr>
										</table>
							 		<p class="text-center small">¿Cuánto es tu ingreso mensual por esa tan merecida pensión?</p>
							 		</div><!-- /Col 2/3 -->
							 		<div class="four columns"><!-- Col 3/3 -->
							 		<h5 class="text-center greytxt no-margin txt-shadow-white"><strong><span class="orangetxt">&#8226;</span> Otros ingresos</strong></h5>
							 			<table class="blank-table">
											<tr>
											    <td><a class="less-than round-left" aria-hidden="true" data-icon="&#x6c;"></a></td>
											    <td><input class="finanzas-input expand orangetxt" rel="bar3" type="text" placeholder="0" name="salud_28-3"  id="otros_ingresos" value="<?php echo (isset($userData['salud_28-3'])) ? number_format($userData['salud_28-3'], 0, ",", ".") : '';?>" /></td>
											    <td><a class="more-than round-right" aria-hidden="true" data-icon="&#x3b;"></a></td>
											</tr>
										</table>
							 		<p class="text-center small">Si tienes otros ingresos diferentes a sueldo o pensión, ¿Cuánto suman?.</p>
							 		</div><!-- /Col 3/3 -->
							 	</div><!-- /Row Result -->
						 	</div><!-- Ingresos -->
							
							
							<div class="otros-gastos margin-top-30"><!-- Otros Gastos -->
								<div class="row"><!-- Row Result -->
									<div class="twelve columns">
									<div class="row">
										<h4 class="eight thin columns greytxt">Gastos en créditos <span class="small greytxt"><em>(Lo que gastas mensualemente en pagar tus créditos)</em></span></h3>
										<h5 class="four columns text-right finanzas-total bar4text"><span class="small greytxt ">Total:</span><strong> $0</strong></h5>
										
									</div>
										<div class="total-bar">
											<div class="padding-5 clearfix bar4">
												<div class="blue-bar left round-left" style="width:25%">25%</div>
												<div class="green-bar left" style="width:25%">25%</div>
												<div class="orange-bar left" style="width:25%">25%</div>
												<div class="aqua-bar left round-right" style="width:25%">25%</div>
											</div>
										</div>
									</div>
							 	</div><!-- Row Result -->
							 	
							 	<div class="row"><!-- Row Result -->
							 		<div class="three columns"><!-- Col 3/4 -->
							 		<h5 class="text-center greytxt no-margin txt-shadow-white"><strong><span class="bluetxt">&#8226;</span> Cuota hipotecaria</strong></h5>
							 			<table class="blank-table">
											<tr>
											    <td><a class="less-than round-left" aria-hidden="true" data-icon="&#x6c;"></a></td>
											    <td><input class="finanzas-input expand bluetxt" rel="bar4" type="text" placeholder="0" name="salud_24" value="<?php echo (isset($userData['salud_24'])) ? number_format($userData['salud_24'], 0, ",", ".") : '';?>"/></td>
											    <td><a class="more-than round-right" aria-hidden="true" data-icon="&#x3b;"></a></td>
											</tr>
										</table>
							 		<p class="text-center small">¿Cuánto pagaste por tu cuota del crédito o leasing de vivienda el mes pasado?</p>
							 		</div><!-- /Col 3/4 -->
							 		<div class="three columns"><!-- Col 4/4 -->
							 		<h5 class="text-center greytxt no-margin txt-shadow-white"><strong><span class="greentxt">&#8226;</span> Tarjeta de crédito</strong></h5>
							 			<table class="blank-table">
											<tr>
											    <td><a class="less-than round-left" aria-hidden="true" data-icon="&#x6c;"></a></td>
											    <td><input class="finanzas-input expand greentxt" rel="bar4" type="text" placeholder="0" name="salud_25" value="<?php echo (isset($userData['salud_25'])) ? number_format($userData['salud_25'], 0, ",", ".") : '';?>"/></td>
											    <td><a class="more-than round-right" aria-hidden="true" data-icon="&#x3b;"></a></td>
											</tr>
										</table>
							 		<p class="text-center small">¿Cuánto pagas en promedio cada mes por tu crédito rotativo y/o tarjeta de crédito?</p>
							 		</div><!-- /Col 4/4 -->                                
							 		<div class="three columns"><!-- Col 1/4 -->
							 		<h5 class="text-center greytxt no-margin txt-shadow-white"><strong><span class="orangetxt">&#8226;</span>Otros créditos</strong></h5>
							 			<table class="blank-table">
											<tr>
											    <td><a class="less-than round-left" aria-hidden="true" data-icon="&#x6c;"></a></td>
											    <td><input class="finanzas-input expand orangetxt" rel="bar4" type="text" placeholder="0" name="salud_23-1" value="<?php echo (isset($userData['salud_23-1'])) ? number_format($userData['salud_23-1'], 0, ",", ".") : '';?>"/></td>
											    <td><a class="more-than round-right" aria-hidden="true" data-icon="&#x3b;"></a></td>
											</tr>
										</table>
							 		<p class="text-center small">¿Cuánto pagaste en promedio cada mes por créditos con entidades financieras, familiares, amigos u otros?</p>
							 		</div><!-- /Col 1/4 -->
							 		<div class="three columns"><!-- Col 2/4 -->
							 		<h5 class="text-center greytxt no-margin txt-shadow-white"><strong><span class="aquatxt">&#8226;</span> Otros prestamos</strong></h5>
							 			<table class="blank-table">
											<tr>
											    <td><a class="less-than round-left" aria-hidden="true" data-icon="&#x6c;"></a></td>
											    <td><input class="finanzas-input expand aquatxt" rel="bar4" type="text" placeholder="0" name="salud_23-2" value="<?php echo (isset($userData['salud_23-2'])) ? number_format($userData['salud_23-2'], 0, ",", ".") : '';?>"/></td>
											    <td><a class="more-than round-right" aria-hidden="true" data-icon="&#x3b;"></a></td>
											</tr>
										</table>
							 		<p class="text-center small">¿Cuál es el valor de los pagos que realizaste el mes pasado por tus deudas con familiares, amigos y otros?</p>
							 		</div><!-- /Col 2/4 -->

							 	</div><!-- /Row Result -->
						 	</div><!-- Gastos Finacieros -->
						 	
						 	<div class="ingresos margin-top-30"><!-- Ingresos -->
								<div class="row"><!-- Row Result -->
									<div class="twelve columns">
									<div class="row">
										<h4 class="eight thin columns greytxt">Gastos y ahorro <span class="small greytxt"><em>(Lo que gastas mensualmente para vivir y ahorrar)</em></span></h4>
										<h5 class="four columns text-right finanzas-total bar5text"><span class="small greytxt"></span><strong> $0</strong></h5>
										
									</div>
										<div class="total-bar">
											<div class="padding-5 clearfix bar5">
												<div class="blue-bar left round-left" style="width:33%">33%</div>
												<div class="green-bar left" style="width:33%">33%</div>
												<div class="orange-bar round-right left" style="width:34%">34%</div>
											</div>
										</div>
									</div>
							 	</div><!-- Row Result -->
							 	
<div class="row"><!-- Row Result -->
							 		<div class="four columns"><!-- Col 1/3 -->
							 		<h5 class="text-center greytxt no-margin txt-shadow-white"><strong><span class="bluetxt">&#8226;</span> Pagos recurrentes</strong></h5>
							 			<table class="blank-table">
											<tr>
											    <td><a class="less-than round-left" aria-hidden="true" data-icon="&#x6c;"></a></td>
											    <td><input class="finanzas-input expand bluetxt" rel="bar5" type="text" placeholder="0" name="salud_26" value="<?php echo (isset($userData['salud_26'])) ? number_format($userData['salud_26'], 0, ",", ".") : '';?>"/></td>
											    <td><a class="more-than round-right" aria-hidden="true" data-icon="&#x3b;"></a></td>
											</tr>
										</table>
							 		<p class="text-center small">¿Cuánto pagas en promedio mensualmente por tus recibos de servicios públicos, celular, medicina prepagada y pensión del colegio?</p>
							 		</div><!-- /Col 1/3 -->
							 		<div class="four columns"><!-- Col 2/3 -->
							 		<h5 class="text-center greytxt no-margin txt-shadow-white"><strong><span class="greentxt">&#8226;</span> Otros gastos</strong></h5>
							 			<table class="blank-table">
											<tr>
											    <td><a class="less-than round-left" aria-hidden="true" data-icon="&#x6c;"></a></td>
											    <td><input class="finanzas-input expand greentxt" rel="bar5" type="text" placeholder="0" name="salud_27" value="<?php echo (isset($userData['salud_27'])) ? number_format($userData['salud_27'], 0, ",", ".") : '';?>"/></td>
											    <td><a class="more-than round-right" aria-hidden="true" data-icon="&#x3b;"></a></td>
											</tr>
										</table>
							 		<p class="text-center small">¿Cuánto suman los gastos mensuales que tienes que hacer por el resto de cosas sin incluir ahorros? (comida, transporte, vestuario, hogar, arriendo y diversión, etc.)</p>
							 		</div><!-- /Col 2/3 -->
							 		<div class="four columns"><!-- Col 3/3 -->
							 		<h5 class="text-center greytxt no-margin txt-shadow-white"><strong><span class="orangetxt">&#8226;</span> Ahorros planeados</strong></h5>
							 			<table class="blank-table">
											<tr>
											    <td><a class="less-than round-left" aria-hidden="true" data-icon="&#x6c;"></a></td>
											    <td><input class="finanzas-input expand orangetxt" rel="bar5" type="text" placeholder="0" name="salud_29" value="<?php echo (isset($userData['salud_29'])) ? number_format($userData['salud_29'], 0, ",", ".") : '';?>"/></td>
											    <td><a class="more-than round-right" aria-hidden="true" data-icon="&#x3b;"></a></td>
											</tr>
										</table>
							 		<p class="text-center small">¿Cuánto ahorras de tu ingreso mensual? Incluye pensiones voluntarias</p>
							 		</div><!-- /Col 3/3 -->
							 	</div><!-- /Row Result -->
						 	</div><!-- Otros Gastos -->
						</div><!-- /Container -->
					 	
					 	<div class="result-block"><!--result block-->
					 	
					 		<div class="container">
						 		<div class="row">
								 	<div class="three columns">
								 		<h5><strong class="greytxt no-margin txt-shadow-white">INGRESO</strong></h5>
								 		<h3 class="bluetxt ingreso">$345,324.905</h3>
								 	</div>
								 	
								 	<div class="one columns">
								 		<div class="sprite-1 substract">-</div>
								 	</div>
			
								 	<div class="three columns">
								 		<h5><strong class="greytxt no-margin txt-shadow-white">GASTO <span class="small greytxt"><em>(Financiero + Otros)</em></span></strong></h5>
								 		<h3 class="greytxt gasto">$345,324.905</h3>
								 	</div>
								 	
								 	<div class="one columns">
								 		<div class="sprite-1 equal">=</div>
								 	</div>
								 	
								 	<div class="four columns">
								 		<h5><strong class="greytxt no-margin txt-shadow-white">POSIBILIDAD ADICIONAL DE AHORRO</strong></h5>
								 		<h3 class="greentxt resultado">$345,324.905</h3>
								 	</div>
						 		</div>
						 	</div>
						
					
					 	</div><!--/result block-->

					</div>
					<!-- /Content -->
										
					
					<div class="main-footer"><!--main footer-->
						<div class="shadow"><img src="<?php echo APPLICATION_URL;?>images/shadow-1.png" alt="shadow-1" width="1024" height="20" /></div>
						<div class="container clearfix"><!--container-->
							<div class="text-left left-btn left">
								<a href="<?php echo APPLICATION_URL?>diagnostico-planeacion.html" class="greytxt"> <strong>Volver</strong></a>					
								

							</div>

							<div class="text-right right right-btn">
								<a href="javascript:void(0);" onClick="document.getElementById('questions').action='<?php echo APPLICATION_URL?>diagnostico-050.html';" class="pretty-btn-1 submit">Ver resultados </a>

							</div>
						</div><!--/container-->
					</div><!--/main footer-->
					
				</div> <!-- /panel -->
				<div class="shadow"><img src="<?php echo APPLICATION_URL?>images/shadow.png" alt="" width="" height=""></div>

			</div><!-- /Main Panel Width -->
		</div>
		<!-- 2.1 /Row: Content -->
          </form>
		
		
	</div><!-- /Container Padding 20px -->
</div>
<!--2. /MAIN--> 	
<script language="javascript">
$(document).ready(function () 
{
	calculateBar('bar1');
	calculateBar('bar2');
	calculateBar('bar3');
	calculateBar('bar4');
	calculateBar('bar5');
});
</script>
<?php	
include_once('footer.php');	
?>
<?php	
	
	include_once('menu-script.php');
	?>
</body>
</html>
