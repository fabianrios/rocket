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
		<link rel="stylesheet" href="<?php echo APPLICATION_URL?>stylesheets/ie.css">
	<![endif]-->


	<!-- IE Fix for HTML5 Tags -->
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<script src="<?php echo APPLICATION_URL?>javascripts/jquery.min.js"></script>
	<script src="<?php echo APPLICATION_URL?>javascripts/modernizr.foundation.js"></script>
	<script src="<?php echo APPLICATION_URL?>javascripts/foundation.js"></script>
	<script src="<?php echo APPLICATION_URL?>javascripts/app.js"></script>
    <script src="<?php echo APPLICATION_URL?>js/finanzas.js"></script>
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
	

		<form action="<?php echo APPLICATION_URL?>diagnostico-050.html" method="post" id="questions">
		<!-- 2.1 Row: Content -->
		<div class="row">
			<div class="twelve columns"><!-- Main Panel Width -->
				<div class="panel header-explorar clearfix"> <!-- panel -->
					
					<!-- Ribbon -->
					<div class="ribbon">
						<h2><span class="head-e"><span class="sprite-1 diagnostico-icon">Icon</span></span><strong>Diagnóstico:</strong> Finanzas</h2>
						<img src="images/border.png" class="right border" width="12" height="44">
					</div>
					<!-- /Ribbon -->
										
					<!-- Content -->
					<div class="finanzas-main clearfix">
						<div class="container"><!-- Container -->
							
							
							<div class="pasivos"><!-- Activos -->
								<div class="row"><!-- Row Result -->
									<div class="twelve columns">
									<div class="row">
										<h3 class="six columns">Activos</h3>
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
									 			<table class="blank-table center">
													<tr>
													    <td><a href="#" class="sprite-1 less-than">less</a></td>
													    <td><input class="finanzas-input expand bluetxt" rel="bar1" type="text" placeholder="0" name="salud_18"/></td>
													    <td><a href="#" class="sprite-1 more-than">more</a></td>
													</tr>
												</table>
									 		<p class="text-center small">A cuanto asciende todo lo que has trabajado y comprado durante la vida: casa, carro, computadores, etc.</p>
									 		</div><!-- /Col 1/2 -->
									 		<div class="six columns"><!-- Col 2/2 -->
									 		<h5 class="text-center greytxt no-margin txt-shadow-white"><strong><span class="greentxt">&#8226;</span> Resto de activos</strong></h5>
									 			<table class="blank-table center">
													<tr>
													    <td><a href="#" class="sprite-1 less-than">less</a></td>
													    <td><input class="finanzas-input expand greentxt" rel="bar1" type="text" placeholder="0" name="salud_19"/></td>
													    <td><a href="#" class="sprite-1 more-than">more</a></td>
													</tr>
												</table>
									 		<p class="text-center small">A cuanto asciende todo lo que has trabajado y comprado durante la vida: casa, carro, computadores, etc.</p>
									 		</div><!-- /Col 2/2 -->
									 	</div>
									 </div>
							 	</div><!-- /Row Result -->
						 	</div><!-- /Activos -->
							
							
							<div class="pasivos margin-top-60"><!-- Pasivos -->
								<div class="row"><!-- Row Result -->
									<div class="twelve columns">
									<div class="row">
										<h3 class="six columns">Pasivos</h3>
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
											    <td><a href="#" class="sprite-1 less-than">less</a></td>
											    <td><input class="finanzas-input expand bluetxt" rel="bar2" type="text" placeholder="0" name="salud_22" /></td>
											    <td><a href="#" class="sprite-1 more-than">more</a></td>
											</tr>
										</table>
							 		<p class="text-center small">Por favor ingrese el monto total de deudas que tengas por: libre inversión, carro, que le debas a tu familia amigos, agiotistas, bancos etc.</p>
							 		</div><!-- /Col 1/4 -->
							 		<div class="three columns"><!-- Col 2/4 -->
							 		<h5 class="text-center greytxt no-margin txt-shadow-white"><strong><span class="greentxt">&#8226;</span> Tarjeta y crédito</strong></h5>
							 			<table class="blank-table">
											<tr>
											    <td><a href="#" class="sprite-1 less-than">less</a></td>
											    <td><input class="finanzas-input expand greentxt" rel="bar2" type="text" placeholder="0" name="salud_21"/></td>
											    <td><a href="#" class="sprite-1 more-than">more</a></td>
											</tr>
										</table>
							 		<p class="text-center small">Por favor ingrese el monto total de las deudas que tiene por concepto de tarjeta de crédito y crédito rotativos</p>
							 		</div><!-- /Col 2/4 -->
							 		<div class="three columns"><!-- Col 3/4 -->
							 		<h5 class="text-center greytxt no-margin txt-shadow-white"><strong><span class="orangetxt">&#8226;</span> Entidades financieras</strong></h5>
							 			<table class="blank-table">
											<tr>
											    <td><a href="#" class="sprite-1 less-than">less</a></td>
											    <td><input class="finanzas-input expand orangetxt" rel="bar2"  type="text" placeholder="0" name="salud_20-1"/></td>
											    <td><a href="#" class="sprite-1 more-than">more</a></td>
											</tr>
										</table>
							 		<p class="text-center small">Ingrese el valor total de la deuda hipotecaria en caso de tenerla.</p>
							 		</div><!-- /Col 3/4 -->
							 		<div class="three columns"><!-- Col 4/4 -->
							 		<h5 class="text-center greytxt no-margin txt-shadow-white"><strong><span class="aquatxt">&#8226;</span> Otros prestamos</strong></h5>
							 			<table class="blank-table">
											<tr>
											    <td><a href="#" class="sprite-1 less-than">less</a></td>
											    <td><input class="finanzas-input expand aquatxt" rel="bar2" type="text" placeholder="0" name="salud_20-2"/></td>
											    <td><a href="#" class="sprite-1 more-than">more</a></td>
											</tr>
										</table>
							 		<p class="text-center small">A cuanto asciende todo lo que has trabajado y comprado durante la vida: casa, carro, computadores, etc.</p>
							 		</div><!-- /Col 4/4 -->
							 	</div><!-- /Row Result -->
						 	</div><!-- Pasivos -->
						 	
						 	<!---div class="result-block">
						 	<h3 class="greentxt">Manejas bien tus finanzas</h3>
						 	<p>Tu realmente eres dueño de un X% de lo que tienes". El X% equivale a la relacion Patrimonio/Activo. Esto indica de todo lo que el usuario tiene, que tanto realmente le pertenece.</p>
						 	<div class="row">

						 	
							 	<div class="three columns">
							 		<h5><strong class="greytxt no-margin txt-shadow-white">ACTIVO</strong></h5>
							 		<h3 class="bluetxt">$345,324.905</h3>
							 	</div>
							 	
							 	<div class="one columns">
							 		<div class="sprite-1 substract">-</div>
							 	</div>
	
							 	<div class="three columns">
							 		<h5><strong class="greytxt no-margin txt-shadow-white">PASIVO</strong></h5>
							 		<h3 class="greytxt">$345,324.905</h3>
							 	</div>
							 	
							 	<div class="one columns">
							 		<div class="sprite-1 equal">=</div>
							 	</div>
							 	
							 	<div class="four columns">
							 		<h5><strong class="greytxt no-margin txt-shadow-white">PATRIMONIO</strong></h5>
							 		<h3 class="greentxt">$345,324.905</h3>
							 	</div>


						 	</div>
						 	</div--->
						 	
						</div><div class="blue-shadow"><img src="<?php echo APPLICATION_URL?>images/shadow-03.png" alt="shadow-1" width="1024" height="20" /></div>
					</div>
					<!-- /Content -->
					
					
					
					
					<!-- Content -->
					<div class="finanzas-main clearfix">
						<div class="container"><!-- Container -->
							
							
							<div class="ingresos"><!-- Ingresos -->
								<div class="row"><!-- Row Result -->
									<div class="twelve columns">
									<div class="row">
										<h3 class="six columns">Ingresos <span class="small greytxt"><em>(promedio mensual)</em></span></h3>
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
							 		<h5 class="text-center greytxt no-margin txt-shadow-white"><strong><span class="bluetxt">&#8226;</span> Ingreso</strong></h5>
							 			<table class="blank-table">
											<tr>
											    <td><a href="#" class="sprite-1 less-than">less</a></td>
											    <td><input class="finanzas-input expand bluetxt" rel="bar3" type="text" placeholder="0" name="salud_28-1"/></td>
											    <td><a href="#" class="sprite-1 more-than">more</a></td>
											</tr>
										</table>
							 		<p class="text-center small">Por favor ingrese el monto total de deudas que tengas por: libre inversión, carro, que le debas a tu familia amigos, agiotistas, bancos etc.</p>
							 		</div><!-- /Col 1/3 -->
							 		<div class="four columns"><!-- Col 2/3 -->
							 		<h5 class="text-center greytxt no-margin txt-shadow-white"><strong><span class="greentxt">&#8226;</span> Pensión por jubilación</strong></h5>
							 			<table class="blank-table">
											<tr>
											    <td><a href="#" class="sprite-1 less-than">less</a></td>
											    <td><input class="finanzas-input expand greentxt" rel="bar3" type="text" placeholder="0" name="salud_28-2"/></td>
											    <td><a href="#" class="sprite-1 more-than">more</a></td>
											</tr>
										</table>
							 		<p class="text-center small">Por favor ingrese el monto total de las deudas que tiene por concepto de tarjeta de crédito y crédito rotativos</p>
							 		</div><!-- /Col 2/3 -->
							 		<div class="four columns"><!-- Col 3/3 -->
							 		<h5 class="text-center greytxt no-margin txt-shadow-white"><strong><span class="orangetxt">&#8226;</span> Otros Ingresos</strong></h5>
							 			<table class="blank-table">
											<tr>
											    <td><a href="#" class="sprite-1 less-than">less</a></td>
											    <td><input class="finanzas-input expand orangetxt" rel="bar3" type="text" placeholder="0" name="salud_28-3"/></td>
											    <td><a href="#" class="sprite-1 more-than">more</a></td>
											</tr>
										</table>
							 		<p class="text-center small">Ingrese el valor total de la deuda hipotecaria en caso de tenerla.</p>
							 		</div><!-- /Col 3/3 -->
							 	</div><!-- /Row Result -->
						 	</div><!-- Ingresos -->
							
							
							<div class="otros-gastos margin-top-60"><!-- Otros Gastos -->
								<div class="row"><!-- Row Result -->
									<div class="twelve columns">
									<div class="row">
										<h3 class="six columns">Gastos financieros <span class="small greytxt"><em>(promedio mensual)</em></span></h3>
										<h5 class="six columns text-right finanzas-total bar4text"><span class="small greytxt ">Total:</span><strong> $0</strong></h5>
										
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
							 		<div class="three columns"><!-- Col 1/4 -->
							 		<h5 class="text-center greytxt no-margin txt-shadow-white"><strong><span class="bluetxt">&#8226;</span> Créditos</strong></h5>
							 			<table class="blank-table">
											<tr>
											    <td><a href="#" class="sprite-1 less-than">less</a></td>
											    <td><input class="finanzas-input expand bluetxt" rel="bar4" type="text" placeholder="0" name="salud_23-1"/></td>
											    <td><a href="#" class="sprite-1 more-than">more</a></td>
											</tr>
										</table>
							 		<p class="text-center small">Por favor ingrese el monto total de deudas que tengas por: libre inversión, carro, que le debas a tu familia amigos, agiotistas, bancos etc.</p>
							 		</div><!-- /Col 1/4 -->
							 		<div class="three columns"><!-- Col 2/4 -->
							 		<h5 class="text-center greytxt no-margin txt-shadow-white"><strong><span class="greentxt">&#8226;</span> Prestamos</strong></h5>
							 			<table class="blank-table">
											<tr>
											    <td><a href="#" class="sprite-1 less-than">less</a></td>
											    <td><input class="finanzas-input expand greentxt" rel="bar4" type="text" placeholder="0" name="salud_23-2"/></td>
											    <td><a href="#" class="sprite-1 more-than">more</a></td>
											</tr>
										</table>
							 		<p class="text-center small">Por favor ingrese el monto total de las deudas que tiene por concepto de tarjeta de crédito y crédito rotativos</p>
							 		</div><!-- /Col 2/4 -->
							 		<div class="three columns"><!-- Col 3/4 -->
							 		<h5 class="text-center greytxt no-margin txt-shadow-white"><strong><span class="orangetxt">&#8226;</span> Cuota hipotecaria</strong></h5>
							 			<table class="blank-table">
											<tr>
											    <td><a href="#" class="sprite-1 less-than">less</a></td>
											    <td><input class="finanzas-input expand orangetxt" rel="bar4" type="text" placeholder="0" name="salud_24"/></td>
											    <td><a href="#" class="sprite-1 more-than">more</a></td>
											</tr>
										</table>
							 		<p class="text-center small">Ingrese el valor total de la deuda hipotecaria en caso de tenerla.</p>
							 		</div><!-- /Col 3/4 -->
							 		<div class="three columns"><!-- Col 4/4 -->
							 		<h5 class="text-center greytxt no-margin txt-shadow-white"><strong><span class="aquatxt">&#8226;</span> Tarjeta de crédito</strong></h5>
							 			<table class="blank-table">
											<tr>
											    <td><a href="#" class="sprite-1 less-than">less</a></td>
											    <td><input class="finanzas-input expand aquatxt" rel="bar4" type="text" placeholder="0" name="salud_25"/></td>
											    <td><a href="#" class="sprite-1 more-than">more</a></td>
											</tr>
										</table>
							 		<p class="text-center small">A cuanto asciende todo lo que has trabajado y comprado durante la vida: casa, carro, computadores, etc.</p>
							 		</div><!-- /Col 4/4 -->
							 	</div><!-- /Row Result -->
						 	</div><!-- Gastos Finacieros -->
						 	
						 	<div class="ingresos margin-top-60"><!-- Ingresos -->
								<div class="row"><!-- Row Result -->
									<div class="twelve columns">
									<div class="row">
										<h3 class="six columns">Otros Gastos <span class="small greytxt"><em>(promedio mensual)</em></span></h3>
										<h5 class="six columns text-right finanzas-total bar5text"><span class="small greytxt">Total:</span><strong> $0</strong></h5>
										
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
							 		<h5 class="text-center greytxt no-margin txt-shadow-white"><strong><span class="bluetxt">&#8226;</span> Servicios Públicos</strong></h5>
							 			<table class="blank-table">
											<tr>
											    <td><a href="#" class="sprite-1 less-than">less</a></td>
											    <td><input class="finanzas-input expand bluetxt" rel="bar5" type="text" placeholder="0" name="salud_26"/></td>
											    <td><a href="#" class="sprite-1 more-than">more</a></td>
											</tr>
										</table>
							 		<p class="text-center small">A cuanto asciende todo lo que has trabajado y comprado durante la vida: casa, carro, computadores, etc.</p>
							 		</div><!-- /Col 1/3 -->
							 		<div class="four columns"><!-- Col 2/3 -->
							 		<h5 class="text-center greytxt no-margin txt-shadow-white"><strong><span class="greentxt">&#8226;</span> Otros gastos</strong></h5>
							 			<table class="blank-table">
											<tr>
											    <td><a href="#" class="sprite-1 less-than">less</a></td>
											    <td><input class="finanzas-input expand greentxt" rel="bar5" type="text" placeholder="0" name="salud_27"/></td>
											    <td><a href="#" class="sprite-1 more-than">more</a></td>
											</tr>
										</table>
							 		<p class="text-center small">A cuanto asciende todo lo que has trabajado y comprado durante la vida: casa, carro, computadores, etc</p>
							 		</div><!-- /Col 2/3 -->
							 		<div class="four columns"><!-- Col 3/3 -->
							 		<h5 class="text-center greytxt no-margin txt-shadow-white"><strong><span class="orangetxt">&#8226;</span> Ahorro</strong></h5>
							 			<table class="blank-table">
											<tr>
											    <td><a href="#" class="sprite-1 less-than">less</a></td>
											    <td><input class="finanzas-input expand orangetxt" rel="bar5" type="text" placeholder="0" name="salud_29"/></td>
											    <td><a href="#" class="sprite-1 more-than">more</a></td>
											</tr>
										</table>
							 		<p class="text-center small">A cuanto asciende todo lo que has trabajado y comprado durante la vida: casa, carro, computadores, etc.</p>
							 		</div><!-- /Col 3/3 -->
							 	</div><!-- /Row Result -->
						 	</div><!-- Otros Gastos -->
						 	
						 	<!---div class="result-block">
						 	<h3 class="redtxt">Gastas mas de lo que te ingresa</h3>
						 	<p>Tu realmente eres dueño de un X% de lo que tienes". El X% equivale a la relacion Patrimonio/Activo. Esto indica de todo lo que el usuario tiene, que tanto realmente le pertenece.</p>
						 	<div class="row">

						 	
							 	<div class="three columns">
							 		<h5><strong class="greytxt no-margin txt-shadow-white">INGRESO</strong></h5>
							 		<h3 class="bluetxt">$345,324.905</h3>
							 	</div>
							 	
							 	<div class="one columns">
							 		<div class="sprite-1 substract">-</div>
							 	</div>
	
							 	<div class="three columns">
							 		<h5><strong class="greytxt no-margin txt-shadow-white">GASTO <span class="small greytxt"><em>(Financiero + Otros)</em></span></strong></h5>
							 		<h3 class="greytxt">$345,324.905</h3>
							 	</div>
							 	
							 	<div class="one columns">
							 		<div class="sprite-1 equal">=</div>
							 	</div>
							 	
							 	<div class="four columns">
							 		<h5><strong class="greytxt no-margin txt-shadow-white">RESULTADO</strong></h5>
							 		<h3 class="greentxt">$345,324.905</h3>
							 	</div>


						 	</div>
						 	</div --->
					<div class="orbit-shadow" />
						<div class="text-center">

								<a href="javascript:void(0);" onClick="document.getElementById('questions').submit();" class="pretty-btn">Ver resultados</a>
						</div>
					</div>						 	
						</div><!-- /Container -->
                  
					<div class="blue-shadow"><img src="<?php echo APPLICATION_URL?>images/shadow-03.png" alt="shadow-1" width="1024" height="20" /></div>
					</div>
					<!-- /Content -->
					
				</div> <!-- /panel -->
				<div class="blue-shadow"><img src="<?php echo APPLICATION_URL?>images/shadow.png" alt="" width="" height=""></div>

			</div><!-- /Main Panel Width -->
		</div>
		<!-- 2.1 /Row: Content -->
          </form>
		
		
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
