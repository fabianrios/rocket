<?php
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
			if(($('#valor_bien').val() == '') || ($('#valor_bien').val() == '$') || ($('#valor_bien').val() == '$0')) {
				parseAlert(1, Array("Debe escribír el valor del bien para continuar."));
				
				return false;
			}
			else {
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
$user		= new User($_SESSION['user_active']);
$userData 	= unserialize($user->__get('user_data'));
if (!isset($userData['user_income_representation']))
	javascriptExecute("window.location.href='".APPLICATION_URL."metas-perfil/".$_GET[0].".html'");

?>
<!--1. /HEADER -->
	

<form action="<?php echo APPLICATION_URL?>metas-030/<?php echo $_GET[0]?>.html" method="post">
<!--2. MAIN-->
<div id="main"> 
	<div class="container principal clearfix"><!-- Container Padding 20px -->
	
	<?php	
		$bread_name = array("Selección", "Costo");
		$js_array = json_encode($bread_name);
		include_once('breadcrumbs-metas.php');	
	?>
		<!-- 2.2 Row: Content -->
		<div class="row">
			<div class="nine columns"><!-- Main Panel Width -->
				<div class="panel header-explorar"> <!-- panel -->
					<!-- Ribbon -->
					<div class="ribbon">
						<h2><span class="head-e"><span class="sprite-1 metas-icon">Icon</span></span><strong>Metas:</strong> Costo de tu meta</h2>
						<img src="<?php echo APPLICATION_URL?>images/border.png" class="right border" width="12" height="44">
					</div>
					<!-- /Ribbon -->
					
						
					<div class="row question"><!-- Row Question-->
						<div class="eleven columns centered margin-top-30"><!-- 11 col -->
						<br />
							<h2 class="answer">El primer paso en el camino de hacer tu meta realidad es saber el costo que tiene, ¿cuál es el costo de la tuya?</h2>
						</div>
						<img src="<?php echo APPLICATION_URL?>images/shadow-01.png" alt="sidebar-tail" width="" height="" class="margin-top-30" />
					</div><!-- /Row Question-->
					<?php 
                    if ((isset($_GET[0])) && ($_GET[0]== '3'))
                    {
                    ?>	                    
					<!--CARRO-->
					<div class="row question margin"><!-- Row Question-->	
						<div class="container"><!-- Container Padding 20px -->
							<a href="#" class="sprite-1 more-info">Info</a>
					
							 <!-- Tooltip -->
						   	<div class="tooltip-info" style="display:none;">
						   	<a href="#" class="sprite-1 close-icon">1</a>
						    	<h6 class="whitetxt"><strong>¿Conoces el valor del bien que deseas adquirir?</strong></h6>
						    	<hr class="dotted" />
						    	<p class="whitetxt"><strong>¿Sabes cuanto cuesta el carro que te quieres comprar?</strong><br />
						    	Acá te podemos ayudar con los precios de referencia de Fasecolda (Federación de Aseguradores Colombianos), qué te dará un valor estimado.
						    	</p>
					 		</div>
					 		<!-- /Tooltip -->		
						 						 	
							
							<div class="question"><!--Question-->					    	
							    <h4 class="greytxt text-center query">¿Conoces el valor del bien que deseas adquirir?</h4>
							
							    <div class="row explorer-main"><!-- Answers -->
							    	<ul class="block-grid two-up">
							    		<li><!-- Answer 1 -->
							        		    <div class="bubble-on text-center bubble-choice" id="hide-fasecolda">
							        		    	<div class="bubble-txt">
							        		    		<h4 class="whitetxt txt-shadow-black assertion">Lo tengo claro.</h4></div>
							        		    </div>
							    		</li><!-- /Answer 1 -->
							    		<li><!-- Answer 1 -->
							        		    <div class="bubble-off text-center bubble-choice" id="show-fasecolda">
							        		    	<div class="bubble-txt">
							        		    		<h4 class="whitetxt txt-shadow-black assertion">Ayúdame a escoger.</h4>
							        		    	</div>
							        		    </div>
							    		</li><!-- /Answer 1 -->
							    	</ul>	
							    </div><!-- /Answers -->
						    </div><!--/Question--> 
						</div><!-- /Container Padding 20px -->
					</div><!-- /Row Question-->

					
					<div class="row question grad3" id="fasecolda" style="display:none;"><!-- Row Question-->
						<div class="shadow"><!-- bluebox tail -->
							<img src="<?php echo APPLICATION_URL?>images/shadow-01.png" alt="sidebar-tail" width="" height="" />
						</div><!-- bluebox tail -->	
						<h4 class="text-center greytxt txt-shadow-white">Escoge tu carro</h4>
						<p class="text-center small light-greytxt"> Precios de referencia tomados de Fasecolda</p>
						
							<div class="six columns centered"><!-- 6 col -->
								<div class="fasecolda-block margin-top-30 round-1"><!-- Blue Box -->
								
									<!-- Selection -->
									<div class="row">
										<div class="four columns text-right"><p class="greytxt">Año:</p></div>
										<div class="eight columns">
											<select onChange="SimpleAJAXCall('<?php echo APPLICATION_URL;?>fasecolda.controller/changeYear/'+this.value+'.html', ElementStateChanged, 'GET', 'fabricantes');">
												<option>Escoje un año</option>
		                                        <?php
												for ($i=2013; $i> 1990; $i--)
												{
												?>
		                                        	<option value="<?php echo $i;?>"><?php echo $i;?></option>
		                                        <?php
		                                       	}
		                                        ?>
											</select>
										</div>
									</div>
									<!-- / Selection -->
									
									<!-- Selection -->
									<div class="row" id="fabricantes">
		
									</div>
									<!-- / Selection -->
									
									<!-- Selection -->
									<div class="row" id="referencias">
		
									</div>                                    
									<!-- / Selection -->				
								</div><!-- /Blue Box -->
								<table class="table-nude right">
									<tr>
										<td><span class="greytxt"><strong class="light-greytxt">Costo de tu carro</strong></span></td>
										<td><span class="price">$</span><span class="price" id="price_label">0</span></td>
									</tr>
								</table>
							</div><!-- 6 col -->
						<div class="shadow"><!-- bluebox tail -->
							<img src="<?php echo APPLICATION_URL?>images/shadow-03.png" alt="sidebar-tail" width="" height="" />
						</div><!-- bluebox tail -->	
					</div><!-- /Row Question-->	
					
					<!--/CARRO-->				
					
					
                    <?php
					}
                    if ((isset($_GET[0])) && ($_GET[0]== '4'))
                    {
                    ?>	                    
					

					<!--/MOTO-->				
					
					<div class="row question margin"><!-- Row Question -->
						<div class="container"><!-- Container Padding 20px -->
						<a href="#" class="sprite-1 more-info">Info</a>
								
							<!-- Tooltip -->
						   	<div class="tooltip-info" style="display:none;">
						   	<a href="#" class="sprite-1 close-icon">1</a>
						    	<h4 class="whitetxt text-center query"><strong>¿Conoces el valor del bien que deseas adquirir?</strong></h4>
						    	<hr class="dotted" />
						    	<p class="whitetxt"><strong>¿Sabes cuanto cuesta la moto que te quieres comprar?</strong><br />
						    	Acá te podemos ayudar con los precios de referencia de Fasecolda (Federación de Aseguradores Colombianos), qué te dará un valor estimado.
						    	</p>
					 		</div>
					 		<!-- /Tooltip -->	
					 		
							<div class="question"><!--Question-->					    	
							    <h4 class="query">¿Conoces el valor del bien que deseas adquirir?</h4>
							
							    <div class="row"><!-- Answers -->
							    	<ul class="block-grid two-up">
							    		<li><!-- Answer 1 -->
							        		    <div class="bubble-on text-center bubble-choice" id="hide-fasecolda">
							        		    	<div class="bubble-txt">
							        		    		<h4 class="whitetxt txt-shadow-black assertion">Lo tengo claro.</h4></div>
							        		    </div>
							    		</li><!-- /Answer 1 -->
							    		<li><!-- Answer 1 -->
							        		    <div class="bubble-off text-center bubble-choice" id="show-fasecolda">
							        		    	<div class="bubble-txt">
							        		    		<h4 class="whitetxt txt-shadow-black assertion">Ayúdame a escoger.</h4>
							        		    	</div>
							        		    </div>
							    		</li><!-- /Answer 1 -->
							    	</ul>	
							    </div><!-- /Answers -->
						    </div><!--/Question--> 						 						 	
						</div><!-- /Container Padding 20px -->
					</div><!-- /Row Question-->

					
					<div class="row question grad3" id="fasecolda" style="display:none;"><!-- Row Question-->
						<div class="shadow"><!-- bluebox tail -->
							<img src="<?php echo APPLICATION_URL?>images/shadow-01.png" alt="sidebar-tail" width="" height="" />
						</div><!-- bluebox tail -->	
						<h4 class="text-center greytxt txt-shadow-white">Escoge tu moto</h4>
						<p class="text-center small light-greytxt"> Precios de referencia tomados de Fasecolda</p>
						
							<div class="six columns centered"><!-- 6 col -->
								<div class="fasecolda-block margin-top-30 round-1"><!-- Blue Box -->
								
									<!-- Selection -->
									<div class="row">
										<div class="four columns text-right"><p class="greytxt">Año:</p></div>
										<div class="eight columns">
											<select onChange="SimpleAJAXCall('<?php echo APPLICATION_URL;?>fasecolda.controller/changeYearM/'+this.value+'.html', ElementStateChanged, 'GET', 'fabricantes');">
												<option>Escoje un año</option>
		                                        <?php
												for ($i=2013; $i> 1990; $i--)
												{
												?>
		                                        	<option value="<?php echo $i;?>"><?php echo $i;?></option>
		                                        <?php
		                                       	}
		                                        ?>
											</select>
										</div>
									</div>
									<!-- / Selection -->
									
									<!-- Selection -->
									<div class="row" id="fabricantes">
		
									</div>
									<!-- / Selection -->
									
									<!-- Selection -->
									<div class="row" id="referencias">
		
									</div>                                    
									<!-- / Selection -->				
								</div><!-- /Blue Box -->
								<table class="table-nude right">
									<tr>
										<td><span class="greytxt"><strong class="light-greytxt">Costo de tu moto</strong></span></td>
										<td><span class="price">$</span><span class="price" id="price_label">0</span></td>
									</tr>
								</table>
							</div><!-- 6 col -->
						<div class="shadow"><!-- bluebox tail -->
							<img src="<?php echo APPLICATION_URL?>images/shadow-03.png" alt="sidebar-tail" width="" height="" />
						</div><!-- bluebox tail -->	
					</div><!-- /Row Question-->	
					
					
					<!--/MOTO-->				
					



                    <?php
					}
					?>					
					
					
					<div class="row question margin">
						<div class="container">									 	
							<div class="row"><!-- Row Result -->
						 		<div class="six columns"><!-- Col 1/2 -->
						 		<h4 class="greytxt text-center query">Valor del bien</h4>
						 			<table class="blank-table-2 centered">
										<tr>
										    <td><div class="less-than round-left" aria-hidden="true" data-icon="&#x6c;"></div></td>
										    <td><input type="text" class="envelope-input text-center" name="valor_bien" id="valor_bien" value="<?php if (isset($userData['valor_bien-'.$_GET[0]])) echo number_format($userData['valor_bien-'.$_GET[0]], 0, ',', '.');?>"/></td>
										    <td><div class="more-than round-right" aria-hidden="true" data-icon="&#x3b;"></div></td>
										</tr>
									</table>						 			
						 		<p class="text-center small light-greytxt">Valor del bien que deseas adquirir</p>
						 		</div><!-- /Col 1/2 -->
						 		<div class="six columns"><!-- Col 2/2 -->
						 		<h4 class="greytxt text-center query"> Cuota inicial</h4>
						 			<table class="blank-table-2 centered">
										<tr>
										    <td><div class="less-than round-left" aria-hidden="true" data-icon="&#x6c;"></div></td>
										    <td><input type="text" class="envelope-input text-center" name="cuota_inicial" id="cuota_inicial" value="<?php if (isset($userData['cuota_inicial-'.$_GET[0]])) echo number_format($userData['cuota_inicial-'.$_GET[0]], 0, ',', '.');?>" onChange="this.value = calculateMax(this.value, document.getElementById('valor_bien').value);" /></td>
										    <td><div class="more-than round-right" aria-hidden="true" data-icon="&#x3b;"></div></td>
										</tr>
									</table>
						 		<p class="text-center small light-greytxt">Si tienes una couta inicial para la compra de tu bien</p>
						 		</div><!-- /Col 2/2 -->
						 	</div><!-- /Row Result -->
						 </div>
				 	</div>
					
					
					
					<!-- Question 3 -->
					
					<!-- /Question 3 -->
					<!-- Question 4 -->
					
					<!-- /Question 4 -->
					<?php
					if (1 == 2)
					{
					?>
					<!-- Question 5 -->
					<div class="row question">
					
							<a href="#" class="sprite-1 more-info">Info</a>
					 	
						    <!-- Tooltip -->
						   	<div class="tooltip-info" style="display:none;">
						   	<a href="#" class="sprite-1 close-icon">1</a>
						    	<h6 class="whitetxt"><strong>Porqué te preguntamos esto</strong></h6>
						    	<hr class="dotted" />
						    	<p class="whitetxt"><strong>¿Has identificado tus objetivos?</strong><br />
						    	Si tienes una cuota inicial es muy importante, reduce tus necesidades de financiación. Además, algunos productos requieren cuota inicial para algunos tipos de sueños						    	
						    	</p>
					 		</div>
					 		<!-- /Tooltip -->
					 		
						<h3 class="text-center">¿Tiene un vehículo para canjear?</h3>
						<div class="row"><!-- Row -->
							<div class="ten columns centered">

							    <div class="six columns"><!-- Option 1 -->
							    	<div class="bluebox">
							    		<div class="uncheck" id="panel1"></div>
							    		<label class="margin-30">Lo tengo</label>
							    	</div>
							    	<div class="blue-shadow"><img src="<?php echo APPLICATION_URL?>images/shadow-bluebox.png" alt="" width="" height=""></div>
							    </div><!-- /Option 1 -->
							
							    <div class="six columns"><!-- Option 2 -->
							    	<div class="bluebox">
							    		<div class="uncheck" id="panel2"></div>
							    		<label class="margin-30">No lo tengo</label>
							    	</div>
							    	<div class="blue-shadow"><img src="<?php echo APPLICATION_URL?>images/shadow-bluebox.png" alt="" width="" height=""></div>
							    </div><!-- /Option 2 -->

							</div>
						</div><!-- /Row -->
					</div>
					<!-- /Question 5 -->
					
					
										<!-- Question 2 -->
					<!--div class="question">
						<h4 class="greytxt text-center"><strong>¿En cuanto tiempo quieres hacer tu sueño realidad?</strong></h4>
						<h5 class="greytxt text-center">Cuanto tiempo quieres ahorrar para hacer tu sueño realidad</h5>
				
						<div class="row"><!-- Row -->
							<!--div class="ten columns centered">
								<div class="slider-tiempo"></div>
									<label for="amount" class="cantidad text-center"></label>
							</div> 
						</div><!-- /Row -->
					<!--/div>     
					
					<!-- Question 6 -->
					<input name="tiempo_sueno"  type="hidden" class="amount text-tiempo" value="<?php echo $_GET[1]?>" id="time" />
					<div class="row question">
					
					
							<a href="#" class="sprite-1 more-info">Info</a>
					 	
						    <!-- Tooltip -->
						   	<div class="tooltip-info" style="display:none;">
						   	<a href="#" class="sprite-1 close-icon">1</a>
						    	<h6 class="whitetxt"><strong>Porqué te preguntamos esto</strong></h6>
						    	<hr class="dotted" />
						    	<p class="whitetxt"><strong>¿Has identificado tus objetivos?</strong><br />
						    	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vulputate nunc nec nunc auctor sodales. Nulla tempor euismod odio condimentum mollis. Aenean nulla tellus, sodales id facilisis vitae, scelerisque vitae erat. Ut est lacus, gravida a iaculis eu, pellentesque ut urna. Donec ipsum mauris.						    	
						    	</p><br />
					 		</div>
					 		<!-- /Tooltip -->
						<h3 class="text-center">¿Valor del vehículo para canje?</h3>
				
						<div class="row"><!-- Row -->
							<div class="ten columns centered">
							
								<input type="text" class="input-nice" value="$"/>

							</div>
						</div><!-- /Row -->
					</div>
					                
                    
                    <?php
					}
					?>
					<!--div class="row question">
					<!-- <a href="#" class="sprite-1 more-info">Info</a> -->
				
					 		 
						   	<!--div class="tooltip-info" style="display:none;">
						   	<a href="#" class="sprite-1 close-icon">1</a>
						    	<h6 class="whitetxt"><strong>Porqué te preguntamos esto</strong></h6>
						    	<hr class="dotted" />
						    	<p class="whitetxt"><strong>¿En cuanto tiempo quieres hacer tu sueño realidad?</strong><br />
						    	Si tienes alguna preferencia o necesidad respecto a la duración del crédito, podemos orientarte al respecto.
						    	</p>
					 		</div>
					 		
					
				 		<h4 class="greytxt text-center"><strong>¿En cuanto tiempo quieres hacer tu sueño realidad?</strong></h4>
				
						<div class="row">
							<div class="ten columns centered">
								<div class="slider-tiempo"></div>
									<label for="amount" class="cantidad text-center"><input name="tiempo_sueno"  type="text" class="amount text-tiempo" id="time" /></label>
							</div> 
						</div>
					</div-->

					<input name="tiempo_sueno"  type="hidden" class="amount text-tiempo" value="<?php echo $_GET[1]?>" id="time" />
					<!-- /Question 6 -->
					<br />
					
					
					<div class="main-footer"><!--main footer-->
					<div class="shadow"><img src="<?php echo APPLICATION_URL?>images/shadow-1.png" alt="shadow-1" width="1024" height="20" /></div>
						<div class="container clearfix"><!--container-->
							<div class="text-right right right-btn"><!--action-->
							    <?php
								foreach ($_POST as $key=>$value)
								{
									echo '<input type="hidden" name="'.$key.'" value="'.$value.'" />';
								}
								?>
								<a href="<?php echo APPLICATION_URL?>metas-010.html" class="greytxt"> <strong>Anterior</strong></a>
								<input type="hidden" value="<?php echo $_GET[1];?>" name="tiempo_sueno" />
                                <input type="submit" value="Siguiente" class="pretty-btn-1 submit" />
							</div><!--action-->
						</div><!--container-->
					</div><!--main footer-->
					

				</div> <!-- /panel -->
				<div class="blue-shadow"><img src="<?php echo APPLICATION_URL?>images/shadow.png" alt="" width="" height=""></div>

			</div><!-- /Main Panel Width -->
			
			
			<div class="three columns"><!-- Sidebar -->

			<div class="bluebox-fixed box-shadow round-1"><!-- bluebox -->
			    <div class="padding-10"><!-- /Padding 10 -->
			  		<!-- title -->
				    <h6 class="thin whitetxt text-center large txt-shadow-black">TU <strong>META</strong></h6>
				    <!-- /title -->
						<div class="row">
							<div class="five columns">
								<img src="<?php echo APPLICATION_URL?>/images/goals/big/carro.png" alt="estudio" width="70" height="70" />
							</div>
							<div class="seven columns">
							 <h6 class="whitetxt txt-shadow-black uppercase"><strong><?php echo $objetivo;?></strong></h6>
							</div>
						</div>
				</div><!-- /Padding 10 -->
			</div><!-- bluebox -->

			<div class="shadow"><!-- bluebox tail -->
				<img src="<?php echo APPLICATION_URL?>images/sidebar-tail.png" alt="sidebar-tail" width="" height="" />
			</div><!-- bluebox tail -->
				

		</div><!--sidebar-->

			
		</div>
		<!-- 2.2 /Row: Content -->
		
		
	</div><!-- /Container Padding 20px -->
</div>
<!--2. /MAIN--> 	
</form>

<?php	
include_once('footer.php');	
?>

<!-- Included JS Files -->

	
<script type="text/javascript">
function calculateTotal()
{
	document.getElementById('valor_bien').value;
	document.getElementById('cuota_inicial').value;
	document.getElementById('total').innerHTML = document.getElementById('valor_bien').value;
	document.getElementById('prestamo').innerHTML = a;			
}


function calculateMax(value, topValue)
{
	value 		= value.replace(/\./g,'');
	topValue 	= topValue.replace(/\./g,'');
	if (value == '') 
		value = 0;
	if (topValue == '') 
		topValue = 0;
	var topV	= (parseInt(topValue)*0.95) - parseInt(value);
	if (topV < 0)
	{
		alert ('El valor de la cuota inicial debe ser inferior a $'+addCommas(parseInt(topValue)*0.95)+' (95% del valor del bien). Si dispones de una cantidad superior, puedes realizar tu meta.');
		return addCommas(parseInt(topValue)*0.95);
	}
	else
		return addCommas(value);
}
function addCommas(nStr) 
{

    nStr += '';
	nStr = nStr.replace(/\./g,'');
    var x = nStr.split(',');
    var x1 = x[0];
    var x2 = x.length > 1 ? ',' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) 
	{
        x1 = x1.replace(rgx, '$1' + '.' + '$2');
    }
    return x1 + x2;

	
}
	$(function() {
		$('#valor_bien').change(function () {
			newVal = addCommas($('#valor_bien').val());
			$('#valor_bien').val(newVal);
		});
		$('.bubble-choice').click(function(){
			$('.bubble-on').removeClass("bubble-on");		
			$('.bubble-choice').addClass("bubble-off");
			$(this).removeClass("bubble-off");							
			$(this).addClass("bubble-on");
			if($(this).attr("id") == 'show-fasecolda')
			{
				$('#fasecolda').show();
			}
			else
			{
				$('#fasecolda').hide();
			}
		});
	
		$( ".slider-tiempo" ).slider({
			value:0,
			min: 0,
			max: 60,
			step: 1,
			slide: function( event, ui ) {
				$( ".text-tiempo" ).val( addCommas(ui.value + " meses" ) );
			}
		});
		//$( ".text-tiempo" ).val(  addCommas($( ".slider-tiempo" ).slider( "value" ) + " meses") );		

	});

	
		$(document).ready(function(){ //document ready
		
			// toggle panel1	
			$('#panel1').click(function(){
				$(this).addClass("checked");
				$('#panel2').removeClass("checked");
			});// /toggle panel1
			
			// toggle panel2
			$('#panel2').click(function(){
				$(this).addClass("checked");
				$('#panel1').removeClass("checked");
			});// /toggle panel2
		});///document ready
	
		function changeValues(price)
		{
			$("#valor_bien").val(addCommas(price));
			$("#price_label").html(addCommas(price));
			
		}
	</script>
	
</body>
</html>
