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

	<title>Buho: La forma divertida de tener el control de tus finanzas</title>

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
$bread_name = "Costo";
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
					
						
						<div class="row question"><!-- Row Question 3 -->
							<br />
							<div class="eleven columns centered"><!-- 11 col -->
								<h5 class="text-center greytxt no-margin"><strong>El primer paso en el camino de hacer tu meta realidad es saber el costo que tiene, ¿cuál es el costo de la tuya?</strong></h5>
							</div>
							<br />
							<div class="blue-shadow"><img src="<?php echo APPLICATION_URL?>images/shadow-03.png" alt="" width="" height=""></div>
						</div>
					<!-- Question 1 -->
					<?php 
                    if ((isset($_GET[0])) && ($_GET[0]== '3'))
                    {
                    ?>	                    
					

					
					<div class="row question"><!-- Row Question 3 -->
					
					 	
					<a href="#" class="sprite-1 more-info">Info</a>
				
							 <!-- Tooltip -->
						   	<div class="tooltip-info" style="display:none;">
						   	<a href="#" class="sprite-1 close-icon">1</a>
						    	<h6 class="greentxt"><strong>¿Conoces el valor del bien que deseas adquirir?</strong></h6>
						    	<hr />
						    	<p class="greytxt"><strong>¿Sabes cuanto cuesta el carro que te quieres comprar?</strong><br />
						    	Acá te podemos ayudar con los precios de referencia de Fasecolda (Federación de Aseguradores Colombianos), qué te dará un valor estimado.
						    	</p>
					 		</div>
					 		<!-- /Tooltip -->		
					 						 	
						<div class="eleven columns centered"><!-- 11 col -->
						    					    	
						    <div class="text-center"><!-- Question -->
						    	<h4 class="greytxt"><strong>¿Conoces el valor del bien que deseas adquirir?</strong></h4>
						    </div><!-- /Question -->	
						
						    <div class="row"><!-- Answers -->
						    	
						    	<ul class="block-grid two-up">
						    		<li><!-- Answer 1 -->
						        		    <div class="bubble-on text-center bubble-choice" id="hide-fasecolda">
						        		    	<div class="bubble-txt">
						        		    		<h4 class="whitetxt txt-shadow-black assertion">Lo tengo claro.<h4>
						        		    	</div>
						        		    </div>
						    		</li><!-- /Answer 1 -->
						    		<li><!-- Answer 1 -->
						        		    <div class="bubble-off text-center bubble-choice" id="show-fasecolda">
						        		    	<div class="bubble-txt">
						        		    		<h4 class="whitetxt txt-shadow-black assertion">Ayúdame a escoger.<h4>
						        		    	</div>
						        		    </div>
						    		</li><!-- /Answer 1 -->
						    	</ul>
						    			
						    </div><!-- /Answers -->
						</div><!-- /11 col -->
					</div><!-- /Row Question 3 -->

					
					
					


					<!-- Question 2 -->
					<div class="row question" id="fasecolda" style="display:none;">	
					<div class="blue-shadow"><img src="<?php echo APPLICATION_URL?>images/shadow-1.png" alt="" width="" height=""></div>
					<h4 class="text-center greytxt">Escoge tu carro</h4>
				
							<div class="six columns centered"><!-- 6 col -->
								<div class="bluebox margin-top-30"><!-- Panel -->
								
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

									<table class="table-nude right">
									<tr>
										<td><span class="price" id="price_label">$ 0</span></td>
									</tr>
									</table>
																		

								</div><!-- /Panel -->
							</div><!-- 6 col -->
							
					</div><!-- /Row -->		

					<!-- /Question 2 -->
                    <?php
					}
                    if ((isset($_GET[0])) && ($_GET[0]== '4'))
                    {
                    ?>	                    
					

					
					<div class="row question"><!-- Row Question 3 -->
					
					<a href="#" class="sprite-1 more-info">Info</a>
				
							 <!-- Tooltip -->
						   	<div class="tooltip-info" style="display:none;">
						   	<a href="#" class="sprite-1 close-icon">1</a>
						    	<h6 class="greentxt"><strong>¿Conoces el valor del bien que deseas adquirir?</strong></h6>
						    	<hr />
						    	<p class="greytxt"><strong>¿Sabes cuanto cuesta la moto que te quieres comprar?</strong><br />
						    	Acá te podemos ayudar con los precios de referencia de Fasecolda (Federación de Aseguradores Colombianos), qué te dará un valor estimado.
						    	</p>
					 		</div>
					 		<!-- /Tooltip -->		
					 						 	
						<div class="eleven columns centered"><!-- 11 col -->
						    					    	
						    <div class="text-center"><!-- Question -->
						    	<h4 class="greytxt"><strong>¿Conoces el valor del bien que deseas adquirir?</strong></h4>
						    </div><!-- /Question -->	
						
						    <div class="row"><!-- Answers -->
						    	
						    	<ul class="block-grid two-up">
						    		<li><!-- Answer 1 -->
						        		    <div class="bubble-on text-center bubble-choice" id="hide-fasecolda">
						        		    	<div class="bubble-txt">
						        		    		<h4 class="whitetxt txt-shadow-black assertion">Lo tengo claro.<h4>
						        		    	</div>
						        		    </div>
						    		</li><!-- /Answer 1 -->
						    		<li><!-- Answer 1 -->
						        		    <div class="bubble-off text-center bubble-choice" id="show-fasecolda">
						        		    	<div class="bubble-txt">
						        		    		<h4 class="whitetxt txt-shadow-black assertion">Ayúdame a escoger.<h4>
						        		    	</div>
						        		    </div>
						    		</li><!-- /Answer 1 -->
						    	</ul>
						    			
						    </div><!-- /Answers -->
						</div><!-- /11 col -->
					</div><!-- /Row Question 3 -->

					
					
					


					<!-- Question 2 -->
					<div class="row question" id="fasecolda" style="display:none;">	
					<div class="blue-shadow"><img src="<?php echo APPLICATION_URL?>images/shadow-1.png" alt="" width="" height=""></div>
					<h4 class="text-center greytxt">Escoge tu moto</h4>
				
							<div class="six columns centered"><!-- 6 col -->
								<div class="bluebox margin-top-30"><!-- Panel -->
								
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

									<table class="table-nude right">
									<tr>
										<td><span class="price" id="price_label">$ 0</span></td>
									</tr>
									</table>
																		

								</div><!-- /Panel -->
							</div><!-- 6 col -->
							
					</div><!-- /Row -->		

					<!-- /Question 2 -->
                    <?php
					}
					?>					
					<!-- Question 3 -->
					<div class="row question">
							<a href="#" class="sprite-1 more-info">Info</a>
					 	
						    <!-- Tooltip -->
						   	<div class="tooltip-info" style="display:none;">
						   	<a href="#" class="sprite-1 close-icon">1</a>
						    	<h6 class="greentxt"><strong>Porqué te preguntamos esto</strong></h6>
						    	<hr />
						    	<p class="greytxt"><strong>¿Cuál es el valor del bien que desea adquirir?</strong><br />
							Con esta información podremos saber la factibilidad de tu sueño, y los diferentes caminos que puede tener para llegar a él						    	
						    	</p>
					 		</div>
					 		<!-- /Tooltip -->
						 <h4 class="greytxt text-center"><strong>¿Cuál es el valor del bien que desea adquirir?</strong></h4>
				
						<div class="row"><!-- Row -->
							<div class="ten columns centered margin-30">
							
								<input type="text" class="input-nice text-center" name="valor_bien" id="valor_bien" value="<?php if (isset($userData['valor_bien-'.$_GET[0]])) echo $userData['valor_bien-'.$_GET[0]];?>"/>

							</div>
						</div><!-- /Row -->
					</div>
					<!-- /Question 3 -->
					<!-- Question 4 -->
					<div class="row question">
					
							<a href="#" class="sprite-1 more-info">Info</a>
					 	
						    <!-- Tooltip -->
						   	<div class="tooltip-info" style="display:none;">
						   	<a href="#" class="sprite-1 close-icon">1</a>
						    	<h6 class="greentxt"><strong>Porqué te preguntamos esto</strong></h6>
						    	<hr />
						    	<p class="greytxt"><strong>¿A cuánto asciende el valor de la cuota inicial que dispone?</strong><br />
Si tienes una cuota inicial es muy importante, reduce tus necesidades de financiación. Además, algunos productos requieren cuota inicial para algunos tipos de sueños.
						    	</p>
					 		</div>
					 		<!-- /Tooltip -->
						<h4 class="greytxt text-center"><strong>¿A cuánto asciende el valor de la cuota inicial que dispone?</strong></h4>
				
						<div class="row"><!-- Row -->
							<div class="ten columns centered margin-30">
							
								<input type="text" class="input-nice text-center" name="cuota_inicial" id="valor_bien" value="" onChange="this.value = calculateMax(this.value, document.getElementById('valor_bien').value);" />

							</div>
						</div><!-- /Row -->
					</div>
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
						    	<h6 class="greentxt"><strong>Porqué te preguntamos esto</strong></h6>
						    	<hr />
						    	<p class="greytxt"><strong>¿Has identificado tus objetivos?</strong><br />
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
					<div class="question">
						<h4 class="greytxt text-center"><strong>¿En cuanto tiempo quieres hacer tu sueño realidad?</strong></h4>
						<h5 class="greytxt text-center">Cuanto tiempo quieres ahorrar para hacer tu sueño realidad</h5>
				
						<div class="row"><!-- Row -->
							<div class="ten columns centered">
								<div class="slider-tiempo"></div>
									<label for="amount" class="cantidad text-center"><input name="tiempo_sueno"  type="text" class="amount text-tiempo" id="time" /></label>
							</div> 
						</div><!-- /Row -->
					</div>     
					
					<!-- Question 6 -->
					<div class="row question">
					
					
							<a href="#" class="sprite-1 more-info">Info</a>
					 	
						    <!-- Tooltip -->
						   	<div class="tooltip-info" style="display:none;">
						   	<a href="#" class="sprite-1 close-icon">1</a>
						    	<h6 class="greentxt"><strong>Porqué te preguntamos esto</strong></h6>
						    	<hr />
						    	<p class="greytxt"><strong>¿Has identificado tus objetivos?</strong><br />
						    	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vulputate nunc nec nunc auctor sodales. Nulla tempor euismod odio condimentum mollis. Aenean nulla tellus, sodales id facilisis vitae, scelerisque vitae erat. Ut est lacus, gravida a iaculis eu, pellentesque ut urna. Donec ipsum mauris.						    	
						    	</p>
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
					<div class="row question">
					<a href="#" class="sprite-1 more-info">Info</a>
				
							 <!-- Tooltip -->
						   	<div class="tooltip-info" style="display:none;">
						   	<a href="#" class="sprite-1 close-icon">1</a>
						    	<h6 class="greentxt"><strong>Porqué te preguntamos esto</strong></h6>
						    	<hr />
						    	<p class="greytxt"><strong>¿En cuanto tiempo quieres hacer tu sueño realidad?</strong><br />
						    	Si tienes alguna preferencia o necesidad respecto a la duración del crédito, podemos orientarte al respecto.
						    	</p>
					 		</div>
					 		<!-- /Tooltip -->
					
						<h4 class="greytxt text-center"><strong>¿En cuanto tiempo quieres hacer tu sueño realidad?</strong></h4>
				
						<div class="row"><!-- Row -->
							<div class="ten columns centered">
								<div class="slider-tiempo"></div>
									<label for="amount" class="cantidad text-center"><input name="tiempo_sueno"  type="text" class="amount text-tiempo" id="time" /></label>
							</div> 
						</div><!-- /Row -->
					</div>                         
					<!-- /Question 6 -->
					
					<div class="main-footer" />
					<div class="shadow"><img src="<?php echo APPLICATION_URL?>images/shadow-1.png" alt="shadow-1" width="1024" height="20" /></div>
						<div class="text-center">
						    <?php
							foreach ($_POST as $key=>$value)
							{
								echo '<input type="hidden" name="'.$key.'" value="'.$value.'" />';
							}
							?>
							<a href="<?php echo APPLICATION_URL?>metas-010.html" class="pretty-btn"><span class="whitetxt large baseline" aria-hidden="true" data-icon="x"> Anterior</a>
							<input type="submit" value="Siguiente" class="pretty-btn submit" />
						</div>
					</div>

				</div> <!-- /panel -->
				<div class="blue-shadow"><img src="<?php echo APPLICATION_URL?>images/shadow.png" alt="" width="" height=""></div>

			</div><!-- /Main Panel Width -->
			
			<div class="three columns"><!-- Sidebar -->

				<div class="bluebox-fixed box-shadow">
				<div class="padding-10">
				<div class="goal">
					<a href="metas-020/carro.html" title=""><div class="goal-<?php echo $_GET[0];?> sprite-goals">Carro</div></a>
				</div>
                <h2><?php echo $objetivo;?></h2>
				</div>
				</div>
			</div><!-- /Sidebar -->
			
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
		$( ".text-tiempo" ).val(  addCommas($( ".slider-tiempo" ).slider( "value" ) + " meses") );		

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
