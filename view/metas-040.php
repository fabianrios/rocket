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
$creditTime	= VariableHelper::retrieveVariables(" AND sueno_tipo = ".escape($_GET[0]));
if (count($creditTime) >0)
	$creditTime	= $creditTime[0]->__get('plazo_maximo');
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
		<link rel="stylesheet" href="stylesheets/ie.css">
	<![endif]-->


	<script language="JavaScript" src="<?php echo APPLICATION_URL?>javascripts/jquery.min.js" ></script>
	<script language="JavaScript" src="<?php echo APPLICATION_URL?>javascripts/jquery-ui-1.8.20.custom.min.js" ></script>
	<script language="JavaScript" src="<?php echo APPLICATION_URL?>javascripts/goals-behaviors.js" ></script>
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
			return true;
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
?>
<!--1. /HEADER -->
	


<!--2. MAIN-->
<form action="<?php echo APPLICATION_URL?>metas-050/<?php echo $_GET[0]?>.html" method="post">
<div id="main"> 
	<div class="container principal clearfix"><!-- Container Padding 20px -->
	
<?php	
	$bread_name = array("Selección", "Costo", "Finanzas", "Cuota");
	$js_array = json_encode($bread_name);
	include_once('breadcrumbs-metas.php');	
?>

		<!-- 2.2 Row: Content -->
		<div class="row">
			<div class="nine columns"><!-- Main Panel Width -->
				<div class="panel header-explorar"> <!-- panel -->
					
					<!-- Ribbon -->
					<div class="ribbon">
						<h2><span class="head-e"><span class="sprite-1 metas-icon">Icon</span></span><strong>Metas:</strong> Monto y número de cuotas del crédito</h2>
						<img src="<?php echo APPLICATION_URL?>images/border.png" class="right border" width="12" height="44">
					</div>
					<!-- /Ribbon -->
					<?php
					if (str_replace(" meses", "", $_POST['tiempo_sueno']) > 0)
					{
					?>
						
						
					<div class="row question"><!-- Row Question-->
						<div class="eleven columns centered margin-top-30"><!-- 11 col -->
						<br />
							<h2 class="answer">Si tienes idea de cuanto puedes pagar mensualmente, o durante cuanto tiempo quieres tener el crédito, aquí podrás jugar con las dos cosas hasta que obtengas el resultado deseado.</h2>
						</div>
						<img src="<?php echo APPLICATION_URL?>images/shadow-01.png" alt="sidebar-tail" width="" height="" class="margin-top-30" />
					</div><!-- /Row Question-->
					

 						<div class="row-questions relative"><!-- Question cuatro Preguntas -->
 							<div class="container">	<!-- Container Padding 20px -->
								<a href="#" class="sprite-1 more-info">Info</a>
								<!-- Tooltip -->
								<div class="tooltip-info" style="display:none;">
								<a href="#" class="sprite-1 close-icon">1</a>
									<h6 class="whitetxt"><strong>Porqué te preguntamos esto</strong></h6>
									<hr class="white" />
									<p class="whitetxt"><strong>&iquest;Deseas ahorrar durante el tiempo previo al inicio la realizaci&oacute;n de tu sue&ntilde;o?</strong><br />
									El ahorro es el camino m&aacute;s r&aacute;pido para conseguir tu meta.
									</p>
								</div>
								<!-- Tooltip -->
								
								<h4 class="greytxt text-center query">&iquest;Deseas ahorrar durante el tiempo previo al inicio la realizaci&oacute;n de tu sue&ntilde;o?</h4> 

								<div class="row explorer-main"> <!-- row -->
									<ul class="block-grid two-up">
										<li><!-- Answer 1 -->
											<div class="bubble-off text-center  suen_ahorro" id="suen_ahorro-0">
												<div class="bubble-txt">
													<h4 class="whitetxt txt-shadow-black assertion">No</h4>
													<p class="small whitetxt txt-shadow-black"></p>
												</div>
											</div>
										 </li><!-- /Answer 1 -->
										 <li><!-- Answer 2 -->
											<div class="bubble-off text-center  suen_ahorro" id="suen_ahorro-1">
												<div class="bubble-txt">
													<h4 class="whitetxt txt-shadow-black assertion">Sí</h4>
													<p class="small whitetxt txt-shadow-black"></p>
												</div>
											</div>
										</li><!-- /Answer 2 -->    
									</ul>
									<input type="hidden" id="suen_ahorro" name="suen_ahorro"  />                                   
								</div> <!--/row -->
							</div><!-- /Container Padding 20px -->
						</div><!---/row-questions--->
							<?php
							$valor_maximo_ahorro = ($_POST['salud_28-1'] + $_POST['salud_28-2'] + $_POST['salud_28-3'])-($_POST['salud_24']+$_POST['salud_25']+$_POST['salud_23-1']+$_POST['salud_26']+$_POST['salud_27']); 
							?>
						
						<input type="hidden" id="valor-maximo-ahorro" name="valor-maximo-ahorro" value="<?php echo $valor_maximo_ahorro;?>">  
						
						<div id="cuanto-ahorro" class="row question margin grad3"><!--row-->
						<div class="shadow"><!-- bluebox tail -->
							<img src="<?php echo APPLICATION_URL?>images/shadow-01.png" alt="sidebar-tail" width="" height="" />
						</div><!-- bluebox tail -->	
							<div class="container">	
								<a href="#" class="sprite-1 more-info">Info</a>
								<!-- Tooltip -->
								<div class="tooltip-info" style="display:none;">
								<a href="#" class="sprite-1 close-icon">1</a>
									<h6 class="greentxt"><strong>Porqué te preguntamos esto</strong></h6>
									<hr />
									<p class="greytxt"><strong>¿Qu&eacute; porcentaje de tu capacidad de ahorro quieres utilizar para ahorro antes de iniciar tu meta?</strong><br />
									La suma que ahorres determinar&aacute; si es necesario endeudarte para conseguir tu meta.
									</p>
								</div>
								<!-- /Tooltip -->
								
								<h4 class="greytxt text-center query">¿Qu&eacute; porcentaje de tu capacidad de Ahorro ($<?php echo number_format($valor_maximo_ahorro)?> por mes) quieres utilizar para ahorro antes de iniciar tu meta?</h4>
						
								<div class="row"><!-- Row -->
									<div class="container"><!-- Container Padding 20px -->
											<div class="slider-ahorro"></div>
								
												<table class="blank-table" width"100%">
													<tr>
														<td><input type="text" name="suen_porcentaje_ahorro" id="suen_porcentaje_ahorro" class="amount suen_porcentaje_ahorro"  onChange="calculateNewPayment();"/></td>
														<td><strong>=</strong></td>
														<td id="payment_value">
															</span><input type="text" name="ahorro-mes-dinero" class="amount ahorro_amount" id="ahorro-mes-dinero" value="" />
														</td>
													</tr>
													<tr>	
														<td>Ahorrando esto mensual tu crédito sería<input type="text" id="nuevo-credito" name="nuevo-credito" class="amount text-center" value="" readonly /></td>	
													</tr>
												</table>
												<div class="shadow"><!-- bluebox tail -->
														<img src="<?php echo APPLICATION_URL?>images/shadow-03.png" alt="sidebar-tail" width="" height="" />
												</div><!-- bluebox tail -->	
                                      
									</div><!-- /Container Padding 20px --> 
								</div><!-- /Row -->
							</div>	
						</div><!--row-->
						  
					<?php
					}
					?>					
					
					<div class="row question margin" style="display:none ;"><!-- Row Question-->
						<div class="container">
						<h4 class="greytxt text-center query">¿En cuánto tiempo quieres pagar el credito?</h4>
							<div class="row"><!-- Row -->
								<table class="blank-table">
									<tr>
										<td>
											<input type="text" id="cuotas" name="cuotas" class="amount time-amount" value="36" onChange="calculateNewPayment();"/> meses
										</td>
										<td>=</td>
										<td id="payment_value">
											<input type="text" id="costo" name="costo" class="amount money-amount" value="" readonly /><br />
										</td>
									</tr>
								</table>
							</div><!-- /Row -->
						</div>
					</div><!-- Row Question-->
					
					
					
										
					<div class="row question margin"><!-- Question 1 -->
						<h4 class="greytxt text-center query">¿En cuánto tiempo quieres pagar el crédito?</h4> 
						<div class="container">
						<div class="row"><!-- Row -->
												
								<div class="slider-time"></div>
								
								<table class="blank-table">
									<tr>
										<td><input type="text" name="cuotas" class="amount time-amount" />
											<br /><span class="text-center light-greytxt">(número total de meses)</span>
										</td>
										<td><strong>=</strong> </td>
										<td id="payment_value">
											  <input type="text" name="costo" class="amount payment-amount" value="" /><br /><span class="text-center light-greytxt">(cuota de pago mensual)</span>
										</td>
									</tr>
								</table>
						</div><!-- /Row -->
						</div>
					</div><!-- /Question 1 -->
					
					
					
					
					
					<div class="main-footer" >
					<div class="shadow"><img src="<?php echo APPLICATION_URL?>images/shadow-1.png" alt="shadow-1" width="1024" height="20" /></div>
						<div class="container clearfix"><!--container-->
							<div class="text-right right right-btn">
							
								<?php
								foreach ($_POST as $key=>$value)
								{
									echo '<input type="hidden" id="'.$key.'" name="'.$key.'" value="'.$value.'" />';
								}
								$valor_prestamo		 = (isset($_POST['cuota_inicial'])) ? $_POST['valor_bien'] - $_POST['cuota_inicial'] : $_POST['valor_bien'];
								?> 
								<input type="hidden" id="valor-prestamo-total" name="valor-prestamo-total" value="<?php echo $valor_prestamo;?>">
								<a href="javascript:void(0);" onClick="window.history.go(-1);" class="greytxt"> <strong>Anterior</strong></a>
								<input type="submit" value="Siguiente" class="pretty-btn-1">
							</div>
						</div>						
					</div>



				</div> <!-- /panel -->
				<div class="blue-shadow"><img src="<?php echo APPLICATION_URL?>images/shadow.png" alt="" width="" height=""></div>
			</div><!-- /Main Panel Width -->
			
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
if (!isset($_POST['cuota_inicial']))
	$value 		= intval(str_replace("$", "", $_POST['valor_bien']));
else
	$value		= $_POST['valor_bien'] - $_POST['cuota_inicial'];
$payment	= $value / 36;
$min		= $value / 72;
$max		= $value / 6;
?>	
<script type="text/javascript">
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

function calculateNewPayment()
{
	
	value		= $($('#valor-prestamo-total')[0]).val();
	value		= parseInt(value.replace(/\./g,''));
	tiempo		= $($('#tiempo_sueno')[0]).val();
	tiempo		= parseInt(tiempo.replace(" meses",''));
	cuotas		= $($('#cuotas')[0]).val();
	cuotas		= parseInt(cuotas.replace(/\./g,''));
	<?php
	if (str_replace(" meses", "", $_POST['tiempo_sueno']) > 0)
	{
	?>	
	if (isNaN(cuotas))
	{
		cuotas 	= 36;
		$($('#cuotas')[0]).val(36);
	}
	if (cuotas > <?php echo $creditTime;?>)
	{
		cuotas	= <?php echo $creditTime;?>;
		$($('#cuotas')[0]).val(<?php echo $creditTime;?>);
		alert('Las entidades no prestan para <?php echo $objetivo;?> a más de <?php echo $creditTime;?> meses.');
	}
	if (tiempo > 0)
	{
		
		porcentaje	= (parseInt($($('#suen_porcentaje_ahorro')[0]).val())/100);
		if (isNaN(porcentaje))
		{
			porcentaje = 0.5;
			$($('#suen_porcentaje_ahorro')[0]).val(50);
		}
		if (porcentaje > 1)
		{
			porcentaje = 1;
			$($('#suen_porcentaje_ahorro')[0]).val(100);
		}
			
		ahorromax	= parseInt($($('#valor-maximo-ahorro')[0]).val());
		ahorro		=  ahorromax * porcentaje  * tiempo;
		$($('#ahorro-mes-dinero')[0]).val(addCommas(ahorro/tiempo));
		value		= value - ahorro;
		if (value > 0)
			$($('#nuevo-credito')[0]).val(addCommas(value));
		else
			$($('#nuevo-credito')[0]).val('Con este nivel de ahorro puedes cumplir tu meta en el tiempo que te lo propusiste');
		
	}
	<?php
	}
	?>
	SimpleAJAXCall('<?php echo APPLICATION_URL?>credit_payment.controller/update_payment_value/' + value + '/' + cuotas + '.html', changeCosto, 'GET', '');
}

function changeCosto(resp, object )
{
	$($('#costo')[0]).val(addCommas(resp));
}

$(document).ready(function () 
{

	calculateNewPayment();
	//
	$($('#cuanto-ahorro')[0]).hide();
	
	$('#suen_ahorro-0').click(function(){
		$('.suen_ahorro').removeClass("bubble-on");		
		$('.suen_ahorro').addClass("bubble-off");
		$(this).removeClass("bubble-off");							
		$(this).addClass("bubble-on");
		$('#suen_ahorro').val(0);
		$('#suen_ahorro').trigger('change');		
		$($('#cuanto-ahorro')[0]).hide();
		$($('#suen_porcentaje_ahorro')[0]).val(0);
		calculateNewPayment();
	});///toggle panel1
	
	$('#suen_ahorro-1').click(function(){
		$('.suen_ahorro').removeClass("bubble-on");		
		$('.suen_ahorro').addClass("bubble-off");
		$(this).removeClass("bubble-off");							
		$(this).addClass("bubble-on");
		$('#suen_ahorro').val(1);
		$('#suen_ahorro').trigger('change');
		$($('#cuanto-ahorro')[0]).show();
		$($('#suen_porcentaje_ahorro')[0]).val(100);	
		calculateNewPayment();
	});///toggle panel1			
	
});
</script>


<script type="text/javascript">

	var value = <?php echo $value?>;
			$(function() {
		$(".payment-amount").val( "$" + addCommas(parseInt(<?php echo Sueno::calculatePayment($value, 36);?>)));
		$( ".slider-time" ).slider({
			range: "min",
			value: 36,
			min: 6,
			max: 72,
			slide: function( event, ui ) {
				$( ".time-amount" ).val( ui.value + " meses" );
			},
			change: function ( event, ui ) {
				SimpleAJAXCall('<?php echo APPLICATION_URL?>credit_payment.controller/update_payment_value/<?php echo $value?>/' + ui.value + '.html', changePaymentValue, 'GET', '');
			}
		});
		$( ".time-amount" ).val( $( ".slider-time" ).slider( "value" ) + " meses" );

	});

	var value = 100;
			$(function() {
		$(".suen_porcentaje_ahorro").val( "$" + addCommas(parseInt(100)));
		$( ".slider-ahorro" ).slider({
			range: "min",
			value: 100,
			min: 0,
			max: 100,
			slide: function( event, ui ) {
				$( ".suen_porcentaje_ahorro" ).val( ui.value );
			},
			change: function ( event, ui ) {
				calculateNewPayment();
			}
		});
		$( ".suen_porcentaje_ahorro" ).val( $( ".slider-ahorro" ).slider( "value" ));

	});
			
	</script>
</body>
</html>
