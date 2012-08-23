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
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />

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
	
	<?php	
	
	include_once('menu-script.php');
	?>
	
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
	


<!--2. MAIN-->
<form action="<?php echo APPLICATION_URL?>metas-040/<?php echo $_GET[0]?>.html" method="post">
<div id="main"> 
	<div class="container principal clearfix"><!-- Container Padding 20px -->

	<?php	
		$bread_name = array("Selección", "Costo", "Finanzas");
		$js_array = json_encode($bread_name);
		include_once('breadcrumbs-metas.php');	
	?>

		<!-- 2.2 Row: Content -->
		<div class="row">
			<div class="nine columns"><!-- 9 col -->
				<div class="panel header-explorar"> <!-- panel -->
					
					<!-- Ribbon -->
					<div class="ribbon">
						<h2><span class="head-e"><span class="sprite-1 metas-icon">Icon</span></span><strong>Metas:</strong> Cómo manejas tu dinero</h2>
						<img src="<?php echo APPLICATION_URL?>images/border.png" class="right border" width="12" height="44">
					</div>
					<!-- /Ribbon -->
					
						<div class="row question"><!-- Row Question 3 -->
							<br />
							<div class="eleven columns centered"><!-- 11 col -->
								<h2 class="answer">Dependiendo de cómo manejes tu dinero, cuánto te entra y cuanto te sale, te podremos decir que productos se adaptan mejor a ti.</h2>
							</div>
							<br />
							<div class="blue-shadow"><img src="<?php echo APPLICATION_URL?>images/shadow-03.png" alt="" width="" height=""></div>
						</div>
					
										
					<!-- Question 1 -->
					<div class="row question margin">
							<div class="container">			
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
							 		
							 		
							 		<h4 class="greytxt text-center query"><span class="bluetxt">&#8226;</span> Ingresos por sueldo</h4>
							 			<table class="blank-table-2 centered">
											<tr>
											    <td><div class="less-than round-left" aria-hidden="true" data-icon="&#x6c;"></div></td>
											    <td><input class="finanzas-input expand bluetxt" rel="bar3" type="text" placeholder="0" name="salud_28-1" id="ingresos" value="<?php echo (isset($userData['salud_28-1'])) ? number_format($userData['salud_28-1'], 0, ",", ".") : '';?>" /></td>
											    <td><div class="more-than round-right" aria-hidden="true" data-icon="&#x3b;"></div></td>
											</tr>
										</table>
							 		<p class="text-center small light-greytxt">¿Cuántos son tus ingresos netos promedio mensuales? (después de descontar esa tan lejana pensión, y tu costosa salud, etc.)</p>
							 		</div><!-- /Col 1/3 -->
							 		<div class="four columns"><!-- Col 2/3 -->
							 		<h4 class="greytxt text-center query"><span class="greentxt">&#8226;</span> Pensión mensual</h4>
							 			<table class="blank-table-2 centered">
											<tr>
											    <td><div class="less-than round-left" aria-hidden="true" data-icon="&#x6c;"></div></td>
											    <td><input class="finanzas-input expand greentxt" rel="bar3" type="text" placeholder="0" name="salud_28-2" id="pension" value="<?php echo (isset($userData['salud_28-2'])) ? number_format($userData['salud_28-2'], 0, ",", ".") : '';?>" /></td>
											    <td><div class="more-than round-right" aria-hidden="true" data-icon="&#x3b;"></div></td>
											</tr>
										</table>
							 		<p class="text-center small light-greytxt">¿Cuánto es tu ingreso mensual por esa tan mereceida pensión?</p>
							 		</div><!-- /Col 2/3 -->
							 		<div class="four columns"><!-- Col 3/3 -->
							 		<h4 class="greytxt text-center query"><span class="orangetxt">&#8226;</span> Otros ingresos</h4>
							 			<table class="blank-table-2 centered">
											<tr>
											    <td><div class="less-than round-left" aria-hidden="true" data-icon="&#x6c;"></div></td>
											    <td><input class="finanzas-input expand orangetxt" rel="bar3" type="text" placeholder="0" name="salud_28-3"  id="otros_ingresos" value="<?php echo (isset($userData['salud_28-3'])) ? number_format($userData['salud_28-3'], 0, ",", ".") : '';?>" /></td>
											    <td><div class="more-than round-right" aria-hidden="true" data-icon="&#x3b;"></div></td>
											</tr>
										</table>
							 		<p class="text-center small light-greytxt">Si tienes otros ingresos diferentes a sueldo o pensión, ¿Cuánto suman?</p>
							 		</div><!-- /Col 3/3 -->
							 	</div><!-- /Row Result -->
						</div> 	
					</div>
					<!-- /Question 1 -->
					
					
					
					<div class="row question margin"><!-- Otros Gastos -->
						<div class="container">
							<div class="row"><!-- Row Result -->
								<div class="twelve columns">
								<div class="row">
									<h4 class="seven thin columns greytxt">Gastos en créditos <span class="small greytxt"><em>(promedio mensual)</em></span></h4>
									<h5 class="five columns text-right finanzas-total bar4text"><span class="small greytxt ">Total:</span><strong> $0</strong></h5>
									
								</div>
									<div class="total-bar">
										<div class="padding-5 clearfix bar4">
											<div class="blue-bar left round-left" style="width:50%">50%</div>
											<div class="green-bar left" style="width:25%">25%</div>
											<div class="orange-bar left" style="width:25%">25%</div>
										</div>
									</div>
								</div>
						 	</div><!-- Row Result -->
						 	
						 	<div class="row"><!-- Row Result -->
						 		<div class="four columns"><!-- Col 3/4 -->
						 		<h4 class="greytxt text-center query"><span class="orangetxt">&#8226;</span> Cuota hipotecaria</h4>
						 			<table class="blank-table-2 centered">
										<tr>
										    <td><div class="less-than round-left" aria-hidden="true" data-icon="&#x6c;"></div></td>
										    <td><input class="finanzas-input expand orangetxt" rel="bar4" type="text" placeholder="0" name="salud_24" value="<?php echo (isset($userData['salud_24'])) ? number_format($userData['salud_24'], 0, ",", ".") : '';?>"/></td>
										    <td><div class="more-than round-right" aria-hidden="true" data-icon="&#x3b;"></div></td>
										</tr>
									</table>
						 		<p class="text-center small light-greytxt">¿Cuánto pagaste por tu cuota del crédito o leasing de vivienda el mes pasado?</p>
						 		</div><!-- /Col 3/4 -->
						 		<div class="four columns"><!-- Col 4/4 -->
						 		<h4 class="greytxt text-center query"><span class="aquatxt">&#8226;</span> Tarjeta de crédito</h4>
						 			<table class="blank-table-2 centered">
										<tr>
										    <td><div class="less-than round-left" aria-hidden="true" data-icon="&#x6c;"></div></td>
										    <td><input class="finanzas-input expand aquatxt" rel="bar4" type="text" placeholder="0" name="salud_25" value="<?php echo (isset($userData['salud_25'])) ? number_format($userData['salud_25'], 0, ",", ".") : '';?>"/></td>
										    <td><div class="more-than round-right" aria-hidden="true" data-icon="&#x3b;"></div></td>
										</tr>
									</table>
						 		<p class="text-center small light-greytxt">¿Cuánto pagas en promedio cada mes por tu crédito rotativo y/o tarjeta de crédito?</p>
						 		</div><!-- /Col 4/4 -->                                
						 		<div class="four columns"><!-- Col 1/4 -->
						 		<h4 class="greytxt text-center query"><span class="bluetxt">&#8226;</span> Otros Créditos</h4>
						 			<table class="blank-table-2 centered">
										<tr>
										    <td><div class="less-than round-left" aria-hidden="true" data-icon="&#x6c;"></div></td>
										    <td><input class="finanzas-input expand bluetxt" rel="bar4" type="text" placeholder="0" name="salud_23-1" value="<?php echo (isset($userData['salud_23-1'])) ? number_format($userData['salud_23-1'], 0, ",", ".") : '';?>"/></td>
										    <td><div class="more-than round-right" aria-hidden="true" data-icon="&#x3b;"></div></td>
										</tr>
									</table>
						 		<p class="text-center small light-greytxt">¿Cuánto pagaste en promedio cada mes por créditos con entidades financieras, familiares, amigos u otros?</p>
						 		</div><!-- /Col 1/4 -->
						 		
	
	
						 	</div><!-- /Row Result -->
						 </div>
				 	</div><!-- Gastos Financieros -->


					<div class="row question margin">
						<div class="container">	

					
				
								<div class="row"><!-- Row Result -->
									<div class="twelve columns">
									<div class="row">
										<h4 class="nine thin columns greytxt">Otros Gastos y ahorro <span class="small greytxt"><em>(Lo que gastas cada mes para vivir y ahorrar)</em></span></h4>
										<h5 class="three columns text-right finanzas-total bar5text"><span class="small greytxt">Total:</span><strong> $0</strong></h5>
										
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
							 		<h4 class="greytxt text-center query"><span class="bluetxt">&#8226;</span> Servicios Públicos</h4>
							 			
							 			
							 			
							 			
							 			
							 			
							 			
							 			
							 			
							 			<table class="blank-table-2 centered">
											<tr>
											    <td><div class="less-than round-left" aria-hidden="true" data-icon="&#x6c;"></div></td>
											    <td><input class="finanzas-input expand bluetxt" rel="bar5" type="text" placeholder="0" name="salud_26" value="<?php echo (isset($userData['salud_26'])) ? number_format($userData['salud_26'], 0, ",", ".") : '';?>"/></td>
											    <td><div class="more-than round-right" aria-hidden="true" data-icon="&#x3b;"></div></td>
											</tr>
										</table>
							 		<p class="text-center small light-greytxt">¿Cuánto pagas en promedio mensualmente por tus recibos de servicios públicos, celular, medicina prepagada y pensión del colegio?</p>
							 		</div><!-- /Col 1/3 -->
							 		<div class="four columns"><!-- Col 2/3 -->
							 		<h4 class="greytxt text-center query"><span class="greentxt">&#8226;</span> Otros gastos</h4>
							 			<table class="blank-table-2 centered">
											<tr>
											     <td><div class="less-than round-left" aria-hidden="true" data-icon="&#x6c;"></div></td>
											    <td><input class="finanzas-input expand greentxt" rel="bar5" type="text" placeholder="0" name="salud_27" value="<?php echo (isset($userData['salud_27'])) ? number_format($userData['salud_27'], 0, ",", ".") : '';?>"/></td>
											    <td><div class="more-than round-right" aria-hidden="true" data-icon="&#x3b;"></div></td>
											</tr>
										</table> 
										
							 		<p class="text-center small light-greytxt">¿Cuánto suman los gastos mensuales que tienes que hacer por el resto de cosas sin incluir ahorros? (comida, transporte, vestuario, hogar, arriendo y diversión, etc.)</p>
							 		</div><!-- /Col 2/3 -->
							 		<div class="four columns"><!-- Col 3/3 -->
							 		<h4 class="greytxt text-center query"><span class="orangetxt">&#8226;</span> Ahorros planeados</h4>
							 			<table class="blank-table-2 centered">
											<tr>
											    <td><div class="less-than round-left" aria-hidden="true" data-icon="&#x6c;"></div></td>
											    <td><input class="finanzas-input expand orangetxt" rel="bar5" type="text" placeholder="0" name="salud_29" value="<?php echo (isset($userData['salud_29'])) ? number_format($userData['salud_29'], 0, ",", ".") : '';?>"/></td>
											    <td><div class="more-than round-right" aria-hidden="true" data-icon="&#x3b;"></div></td>
											</tr>
										</table>
							 		<p class="text-center small light-greytxt">¿Cuánto ahorras de tu ingreso mensual? Incluye pensiones voluntarias</p>
							 		</div><!-- /Col 3/3 -->
							 	</div><!-- /Row Result -->
						</div>
						
						<div class="result-block"><!--result block-->
					 		<div class="container">
						 		<div class="row">
								 	<div class="three columns">
								 		<h6><strong class="greytxt no-margin txt-shadow-white">INGRESO</strong></h6>
								 		<h4 class="bluetxt ingreso thin">$345,324.905</h4>
								 	</div>
								 	
								 	<div class="one columns">
								 		<div class="sprite-1 substract">-</div>
								 	</div>
			
								 	<div class="three columns">
								 		<h6><strong class="greytxt no-margin txt-shadow-white">GASTO <span class="small greytxt"><em>(Créditos & Otros)</em></span></strong></h6>
								 		<h4 class="greytxt gasto thin">$345,324.905</h4>
								 	</div>
								 	
								 	<div class="one columns">
								 		<div class="sprite-1 equal">=</div>
								 	</div>
								 	
								 	<div class="four columns">
								 		<h6><strong class="greytxt no-margin txt-shadow-white">POSIBILIDAD ADICIONAL DE AHORRO</strong></h6>
								 		<h4 class="greentxt resultado thin">$345,324.905</h4>
								 		<small class="greytxt">Tendrías una capacidad de endeudamiento de: <span class="orangetxt resultado thin">$345,324.905</span></small>
								 		
								 	</div>

						 		</div>
						 	</div>
						 <div class="shadow"><img src="<?php echo APPLICATION_URL?>images/shadow-03.png" alt="shadow-1" width="1024" height="20" /></div>
					 	</div>
						
					</div>
					<!-- /Question 2 -->

                            			 	
					<div class="main-footer" >
					<div class="shadow"><img src="<?php echo APPLICATION_URL?>images/shadow-1.png" alt="shadow-1" width="1024" height="20" /></div>
						<div class="container clearfix"><!--container-->
							<div class="text-right right right-btn">
								<a href="javascript:void(0);" onClick="window.history.go(-1);" class="greytxt"> <strong>Anterior</strong></a>
								<?php
								foreach ($_POST as $key=>$value)
								{
									echo '<input type="hidden" id="'.$key.'" name="'.$key.'" value="'.$value.'" />';
								}
								?>                                 
								<input type="submit" value="Siguiente" class="pretty-btn-1 submit">
							</div>
						</div>						
					</div>


				</div> <!-- /panel -->
                
			<div class="blue-shadow"><img src="<?php echo APPLICATION_URL?>images/shadow.png" alt="" width="" height=""></div>
			</div><!-- /9 col -->
			
			
			<div class="three columns"><!-- Sidebar -->
				<div class="bluebox-fixed box-shadow round-1"><!-- bluebox -->
				    <div class="padding-10"><!-- /Padding 10 -->
				  		<!-- title -->
					    <h6 class="thin whitetxt text-center large txt-shadow-black">TU <strong>META</strong></h6>
					    <!-- /title -->
				    	<div class="goal margin-top-10">
							<div class="row">
								<div class="five columns">
									<img src="<?php echo APPLICATION_URL?>/images/goals/big/carro.png" alt="estudio" width="70" height="70" />
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
				

			</div>
			<!-- /Sidebar -->
			
		</div>
		<!-- 2.2 /Row: Content -->
		
		
	</div><!-- /Container Padding 20px -->
</div>
</form>
<!--2. /MAIN--> 	

<?php	
include_once('footer.php');	
?>

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
	
		
		
</body>
</html>
