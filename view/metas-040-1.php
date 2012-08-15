<?php
	foreach ($_POST as $key=>$value)
		$_POST[$key] = str_replace(".", "", str_replace("$", "", $value));
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
include_once('header-explora.php');	
?>
<!--1. /HEADER -->
	


<!--2. MAIN-->
<form action="<?php echo APPLICATION_URL?>metas-050/<?php echo $_GET[0]?>.html" method="post">
<div id="main"> 
	<div class="container principal clearfix"><!-- Container Padding 20px -->
	

		<!-- 2.2 Row: Content -->
		<div class="row">
			<div class="nine columns"><!-- Main Panel Width -->
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
								<h5 class="text-center greytxt no-margin"><strong>Dependiendo de cómo manejes tu dinero, cuanto te entra y cuanto te sale, te podremos decir que productos se adaptan mejor a ti. </strong></h5>
							</div>
							<br />
							<div class="blue-shadow"><img src="<?php echo APPLICATION_URL?>images/shadow-03.png" alt="" width="" height=""></div>
						</div>
					
										
					<!-- Question 1 -->
					<div class="row question">
										
							<a href="#" class="sprite-1 more-info">Info</a>
					 	
						    <!-- Tooltip -->
						   	<div class="tooltip-info" style="display:none;">
						   	<a href="#" class="sprite-1 close-icon">1</a>
						    	<h6 class="greentxt"><strong>Porqué te preguntamos esto</strong></h6>
						    	<hr />
						    	<p class="greytxt"><strong>¿Cuanto es tu ingreso neto?</strong><br />
								Para poder orientarte en la mejor forma de obtener tu crédito necesitamos esta variable, la cual es muy importante.
						    	</p>
					 		</div>
					 		<!-- /Tooltip -->
					
					
						<h4 class="greytxt text-center"><strong>¿Cuanto es tu ingreso neto?</strong></h4>
						<h5 class="greytxt text-center">El total de tus ingresos</h5>
				
						<div class="row"><!-- Row -->
							<div class="ten columns centered">
								<div class="slider-ingreso"></div>
									<label for="amount" class="cantidad text-center"><input type="text" name="ingresos_netos" class="amount text-ingreso" id="income"  /></label>
							</div> 
						</div><!-- /Row -->
					</div>
					<!-- /Question 1 -->
					
					<!-- Question 2 -->
					<div class="row question">
							<a href="#" class="sprite-1 more-info">Info</a>
						    <!-- Tooltip -->
						   	<div class="tooltip-info" style="display:none;">
						   	<a href="#" class="sprite-1 close-icon">1</a>
						    	<h6 class="greentxt"><strong>Porqué te preguntamos esto</strong></h6>
						    	<hr />
						    	<p class="greytxt"><strong>¿Cuantos son tus gastos mensuales diferentes a crédito?</strong><br />
								Para poder orientarte en la mejor forma de obtener tu crédito necesitamos esta variable, la cual es muy importante.</p>
					 		</div>
					 		<!-- /Tooltip -->
					
						<h4 class="greytxt text-center"><strong>¿Cuantos son tus gastos mensuales diferentes a crédito?</strong></h4>
						<h5 class="greytxt text-center">Todo lo que gastas distinto a créditos hipotecarios o tarjetas de crédito</h5>
				
						<div class="row"><!-- Row -->
							<div class="ten columns centered">
								<div class="slider-gastosno"></div>
									<label for="amount" class="cantidad text-center"><input name="gastos_no_financieros"  type="text" class="amount text-gastosno" id="outcome" /></label>
							</div> 
						</div><!-- /Row -->
					</div>
					<!-- /Question 2 -->
					
					
					
							<div class="otros-gastos"><!-- Otros Gastos -->
							<div class="container">
								<div class="row"><!-- Row Result -->
									<div class="twelve columns">
									<div class="row">
										<h3 class="seven columns">Gastos en créditos <span class="small greytxt"><em>(promedio mensual)</em></span></h3>
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
							 		<h5 class="text-center greytxt no-margin txt-shadow-white"><strong><span class="orangetxt">&#8226;</span> Cuota hipotecaria</strong></h5>
							 			<table class="blank-table">
											<tr>
											    <td><a href="#" class="sprite-1 less-than">less</a></td>
											    <td><input class="finanzas-input expand orangetxt" rel="bar4" type="text" placeholder="0" name="gastos_financieros-h"/></td>
											    <td><a href="#" class="sprite-1 more-than">more</a></td>
											</tr>
										</table>
							 		<p class="text-center small">¿Cuál es el valor de los pagos que realizaste el mes pasado por tus créditos con entidades financieras?</p>
							 		</div><!-- /Col 3/4 -->
							 		<div class="four columns"><!-- Col 4/4 -->
							 		<h5 class="text-center greytxt no-margin txt-shadow-white"><strong><span class="aquatxt">&#8226;</span> Tarjeta de crédito</strong></h5>
							 			<table class="blank-table">
											<tr>
											    <td><a href="#" class="sprite-1 less-than">less</a></td>
											    <td><input class="finanzas-input expand aquatxt" rel="bar4" type="text" placeholder="0" name="gastos_financieros-tc"/></td>
											    <td><a href="#" class="sprite-1 more-than">more</a></td>
											</tr>
										</table>
							 		<p class="text-center small">¿Cuál es el valor de los pagos que realizaste el mes pasado por tus deudas con familiares, amigos y otros?</p>
							 		</div><!-- /Col 4/4 -->                                
							 		<div class="four columns"><!-- Col 1/4 -->
							 		<h5 class="text-center greytxt no-margin txt-shadow-white"><strong><span class="bluetxt">&#8226;</span> Créditos</strong></h5>
							 			<table class="blank-table">
											<tr>
											    <td><a href="#" class="sprite-1 less-than">less</a></td>
											    <td><input class="finanzas-input expand bluetxt" rel="bar4" type="text" placeholder="0" name="gastos_financieros-c"/></td>
											    <td><a href="#" class="sprite-1 more-than">more</a></td>
											</tr>
										</table>
							 		<p class="text-center small">¿Cuánto pagaste por tu cuota del crédito de vivienda el mes pasado, o en canon del leasing? Si alguien mas te prestó para comprar la vivienda, inclúyelo.</p>
							 		</div><!-- /Col 1/4 -->
							 		


							 	</div><!-- /Row Result -->
							 </div>
						 	</div><!-- Gastos Finacieros -->

					<!-- Question 2 -->
                       <div class="container">
                            <div class="row-questions" style="position:relative;"><!-- Question cuatro Preguntas -->
                                <a href="#" class="sprite-1 more-info">Info</a>
                                <!-- Tooltip -->
                                <div class="tooltip-info" style="display:none;">
                                <a href="#" class="sprite-1 close-icon">1</a>
                                    <h6 class="greentxt"><strong>Porqué te preguntamos esto</strong></h6>
                                    <hr />
                                    <p class="greytxt"><strong>&iquest;Deseas ahorrar durante el tiempo previo al inicio la realizaci&oacute;n de tu sue&ntilde;o?</strong><br />
                                    El ahorro es el camino m&aacute;s r&aacute;pido para conseguir tu meta.
                                    </p>
                                </div>
                                <br>                            
                                <h4 class="text-center greytxt no-margin"><strong>&iquest;Deseas ahorrar durante el tiempo previo al inicio la realizaci&oacute;n de tu sue&ntilde;o?</strong>
                                </h4> 
                                <div class="row"> <!-- row -->
                                    <ul class="block-grid two-up">
                                        <li><!-- Answer 1 -->
                                                <div class="bubble-off text-center  suen_ahorro" id="suen_ahorro-0">
                                                    <div class="bubble-txt">
                                                        <h4 class="whitetxt txt-shadow-black assertion">No</h4>
                                                        <p class="small whitetxt txt-shadow-black"></p>
                                                    </div>
                                                </div>
                                        </li><!-- /Answer 1 -->
                                         <li><!-- Answer 1 -->
                                                <div class="bubble-off text-center  suen_ahorro" id="suen_ahorro-1">
                                                    <div class="bubble-txt">
                                                        <h4 class="whitetxt txt-shadow-black assertion">Si</h4>
                                                        <p class="small whitetxt txt-shadow-black"></p>
                                                    </div>
                                                </div>
                                        </li><!-- /Answer 1 -->    
                                    </ul>
                                    <input type="hidden" id="suen_ahorro" name="suen_ahorro"  />                                   
                                </div> <!-- END row -->
                            </div>	<!--- end row-questions--->
                           </div>
                            <div class="row question">
                            
                                    <a href="#" class="sprite-1 more-info">Info</a>
                                    <!-- Tooltip -->
                                    <div class="tooltip-info" style="display:none;">
                                    <a href="#" class="sprite-1 close-icon">1</a>
                                        <h6 class="greentxt"><strong>Porqué te preguntamos esto</strong></h6>
                                        <hr />
                                        <p class="greytxt"><strong>¿Qu&eacute; porcentaje de tu capacidad de cr&eacute;dito quieres utilizar para ahorro antes de iniciar tu meta?</strong><br />
        								La suma que ahorres determinar&aacute; si es necesario endeudarte para conseguir tu meta.
                                        </p>
                                    </div>
                                    <!-- /Tooltip -->
                                <h4 class="greytxt text-center"><strong>¿Qu&eacute; porcentaje de tu capacidad de cr&eacute;dito quieres utilizar para ahorro antes de iniciar tu meta?</strong></h4>
                        
                                <div class="row"><!-- Row -->
                                    <div class="ten columns centered">
                                        <div class="slider slider-ahorro"></div>
                                            <label for="amount" class="cantidad text-center"><input type="text" class="amount amount-ahorro" name="suen_porcentaje_ahorro" id="suen_porcentaje_ahorro" //></label>
                                    </div> 
                                </div><!-- /Row -->
                            </div>                           
                            			 	
					<!-- <div class="main-footer" ></div> -->
					<div class="shadow"><img src="<?php echo APPLICATION_URL?>images/shadow-1.png" alt="shadow-1" width="1024" height="20" /></div>
						<div class="text-center">
							<?php
							foreach ($_POST as $key=>$value)
							{
								echo '<input type="hidden" name="'.$key.'" value="'.$value.'" />';
							}
							?>   
							<!-- <a href="<?php echo APPLICATION_URL?>metas-030/<?php echo $_GET[0] ?>.html" class="button green nice radius">Anterior</a> -->
							<input type="submit" value="Siguiente" class="button green nice radius submit">
							<br />
						</div>
						<br />
					</div>

				<div class="blue-shadow"><img src="<?php echo APPLICATION_URL?>images/shadow.png" alt="" width="" height=""></div>
				</div> <!-- /panel -->
                
			
			
			<div class="three columns"><!-- Sidebar -->

				<div class="bluebox-fixed box-shadow">
				<div class="padding-10">
				<div class="goal">
					<a href="metas-020/carro.html" title=""><div class="goal-<?php echo $_GET[0];?> sprite-goals">Carro</div></a>
				</div>
					<br />
					<ul class="list text-center">
						<li class="whitetxt txt-shadow-black"><strong>Valor de la meta:</strong><br/> <span class="big">$<?php echo number_format($_POST['valor_bien']);?></span></li>	
						<?php
						if (!isset($_POST['cuota_inicial']))
						{
						?>
	                        <li class="whitetxt txt-shadow-black"><strong>Valor del préstamo:</strong><br/> <span class="big">$<?php echo number_format(str_replace("$", "", $_POST['valor_bien']));?></span></li>
                        <?php
						}
						else
						{
						?>
                        	<li class="whitetxt txt-shadow-black"><strong>Valor del préstamo:</strong><br/> <span class="big">$<?php echo number_format(intval($_POST['valor_bien'])-intval($_POST['cuota_inicial']));?></span></li>
                        <?php
						}
						?>
						<li class="whitetxt txt-shadow-black"><strong>Número de cuotas:</strong><br/> <span class="big"><?php echo number_format($_POST['cuotas']);?></span></li>
						<li class="whitetxt txt-shadow-black"><strong>Valor de la cuota:</strong><br/> <span class="big">$<?php echo number_format($_POST['costo']);?></span></li>
					</ul>
				</div>
				</div>
			</div><!-- /Sidebar -->
			</div>
		</div>
		<!-- 2.2 /Row: Content -->
		
		
	</div><!-- /Container Padding 20px -->
</div>
</form>
<!--2. /MAIN--> 	

<?php	
include_once('footer-explorar.php');	
?>

<!-- Included JS Files -->

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
	
	$(function() {
			   
		$( ".slider-ingreso" ).slider({
			value:0,
			min: 0,
			max: 30000000,
			step: 100000,
			slide: function( event, ui ) {
				$( ".text-ingreso" ).val( "$" + addCommas(ui.value) );
			}
		});
		$( ".text-ingreso" ).val( "$" + addCommas($( ".slider-ingreso" ).slider( "value" )) );
		$( ".slider-gastosno" ).slider({
			value:0,
			min: 0,
			max: 30000000,
			step: 50000,
			slide: function( event, ui ) {
				$( ".text-gastosno" ).val( "$" + addCommas(ui.value) );
			}
		});
		$( ".text-gastosno" ).val( "$" + addCommas($( ".slider-gastosno" ).slider( "value" )) );	


				

	});

	$( ".slider-ahorro" ).slider({
		value:50,
		min: 0,
		max: 100,
		step: 1,
		slide: function( event, ui ) {
			$( ".amount-ahorro" ).val(  ui.value );
		}
	});
	$( ".amount-ahorro" ).val( addCommas($( ".slider-ahorro" ).slider( "value" )) );

	$('#suen_ahorro-0').click(function(){
		$('.suen_ahorro').removeClass("bubble-on");		
		$('.suen_ahorro').addClass("bubble-off");
		$(this).removeClass("bubble-off");							
		$(this).addClass("bubble-on");
		$('#suen_ahorro').val(0);
		$('#suen_ahorro').trigger('change');		
	});// end toggle panel1

	$('#suen_ahorro-1').click(function(){
		$('.suen_ahorro').removeClass("bubble-on");		
		$('.suen_ahorro').addClass("bubble-off");
		$(this).removeClass("bubble-off");							
		$(this).addClass("bubble-on");
		$('#suen_ahorro').val(0);
		$('#suen_ahorro').trigger('change');		
	});// end toggle panel1
</script>
	
		
		
</body>
</html>
