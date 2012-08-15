
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
	<link rel="stylesheet" href="stylesheets/foundation.css">
	<link rel="stylesheet" href="stylesheets/style.css" type="text/css" />
	<link rel="stylesheet" href="stylesheets/jquery-ui-1.8.17.custom.css" type="text/css" />
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />

	<script src="<?php echo APPLICATION_URL;?>javascripts/jquery.min.js"></script>
	<script language="JavaScript" src="<?php echo APPLICATION_URL?>javascripts/diagnostics-behaviors.js" ></script>
	<script language="JavaScript" src="<?php echo APPLICATION_URL?>javascripts/global-functions.js" ></script>
	<script src="<?php echo APPLICATION_URL;?>js/jquery.knob-1.1.2.js"></script>	
    <script src="<?php echo APPLICATION_URL;?>js/diagnostico.js"></script>	
	<script language="JavaScript">
		function validateInputs() {
			String.prototype.trim = function(){return this.replace(/^\s\s*/, '').replace(/\s\s*$/, '');};
			dataArray 	= Array();
			var counter = 0;
			var index  	= 0;
			$('.blank-input').each(function (index) {
				if(parseInt($(this).val().trim()) == '')
					$(this).val(0)
				if($(this).val().trim() < 0) {
					dataArray[dataArray.length] = $(this).attr('title') + " no puede ser menor a 0.";
				}
				counter = counter+$(this).val();
			});
			if(counter == 0)
			{
				dataArray[dataArray.length] = "Debe haber al menos una persona en el hogar.";
			}
			if(($("#field1").val() == 0) || ($("#field1").val().trim() == '')) {
				dataArray[dataArray.length] = "Lo representativo de su ingreso en su hogar debe ser al menos 1%.";
			}
			if(dataArray.length > 0) {
				parseAlert(1, dataArray)
				return false;
			}
			else {
				document.getElementById('questions').submit();
				return true;
			}

		}
	</script>
<script type="text/javascript" src="<?php echo APPLICATION_URL?>javascripts/kinetic.js"></script>
<script type="text/javascript" src="<?php echo APPLICATION_URL?>javascripts/piechart.js"></script>
<script language="javascript">
	$(function () {
		totalPresicionWeight 	+= 5;
	});	
</script>    
	<!--[if lt IE 9]>
		<link rel="stylesheet" href="stylesheets/ie.css">
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
$userData 	= unserialize($user->__get('user_data'));
?>
<!--1. /HEADER -->
	


<!--2. MAIN-->
<div id="main"> 
	
	<div class="container principal clearfix"><!-- Container Padding 20px -->
	

		<form action="<?php echo APPLICATION_URL?>diagnostico-metas.html" method="post" id="questions">
		<!-- 2.1 Row: Content -->
		<div class="row">
			
			<div class="twelve columns"><!-- Main Panel Width -->
				<div class="panel-1 grad2"> <!-- panel -->
						<br />
				    	<!-- ribbon -->
			    		<div class="ribbon">
							<h2><span class="head-e"><span class="descubra-icon" aria-hidden="true" data-icon="w"></span></span><strong>Diagnostico:</strong> Tu hogar</h2>
							<img src="/buho_private/images/border.png" class="right border" width="12" height="44">
						</div>
					<!-- /ribbon -->
										
						<div class="row question margin-top-10"><!-- Row Question 3 -->
							<br />
							<div class="eleven columns centered"><!-- 11 col -->
								<h5 class="text-center greytxt no-margin"><strong>Para llegar a dónde quieres, debes saber realmente dónde éstas. No todos somos iguales, para saber como estas tú y no el vecino, necesitamos conocer el entorno en el que vives y cuáles son tus metas.</strong></h5>
							</div>
							<br />
							<div class="shadow"><img src="<?php echo APPLICATION_URL?>images/shadow-03.png" alt="" width="" height=""></div>
						</div>					
										
					<!-- Content -->
					<div class="descubra-main clearfix">
						<div class="container">
							<div class="row">
								<div class="seven columns">
									<div class="text-center relative">
										<h4 class="greytxt"><strong>Reparto de gastos en tu hogar</strong></h4>
										<h5 class="greytxt">¿Qué tan representativo es tu ingreso en el total de gastos de tu hogar?</h5>
										<div class="move"></div>
                                        <div id="piechart" class="clearfix" style="width: 600px;"></div>
                                        <div class="pie-numbers">
                                        
                                        
                                            <table class="table-chart tu-aporte">
                                                <tr>
                                                    <td><label id="field1label" style="display:inline;"></label>%<input type="hidden" class="piechart-input" id="field1" name="user_income_representation" value="<?php echo $userData['user_income_representation'];?>" /></td>
                                                    <td><strong>Lo que tu aportas</strong></td>
                                                </tr>
                                            </table>
                                        
                                            <table class="table-chart aporte-familia">
                                                <tr>
                                                    <td><label id="field5label" style="display:inline;"></label>%<input type="hidden" class="piechart-input" id="field5" name="usuario_no_income" value="<?php echo 100-$userData['user_income_representation'];?>"  /></td>
                                                    <td><strong>Lo que aporta tu familia</strong></td>
                                                </tr>
                                            </table>
                                        
                                        </div>
                                        
                                        
                                        <script>
                                        chartInfo 	= new Array();
                                        chartInfo1  = new Array();
                                        
                                        chartInfo[0] = {"percentage" : <?php echo $userData['user_income_representation'];?>, "color" : '#1269b1', "fieldID" : 'field1', "percentageLabelID" : 'field1label'};
                                        chartInfo[1] = {'percentage' : <?php echo 100 - $userData['user_income_representation'];?>, 'color' : '#f58d48', 'fieldID' : 'field5', 'percentageLabelID' : 'field5label'};
                                        
                                        window.onload = function() {
                                            initPieChart('piechart', 520, 400, chartInfo);
                                        }
                                        </script>    									
                                    </div>
                                    
								</div>
	
								<div class="five columns"><!-- Home Persons -->

                            
									<div class="text-center">
										<h4 class="greytxt"><strong>Tu hogar</strong></h4>
										<h5 class="greytxt">¿Cuantas personas conforman tu hogar, incluyéndote?</h5>
									</div>

									<div class="people">
										<div class="row">
											<div class="three columns men"><!-- Men -->
												<a href="#" class="icon_add" style=""><div class="sprite-1 men-icon">Men-icon</div></a>
												<table class="blank-table">
													<tbody>
                                                        <tr>
                                                            <td><a href="#" class="less-than lt round-2" aria-hidden="true" data-icon="&#x6c;"></a></td>
                                                            <td><input rel="user_men" title="Hombres" name="user_men" class="blank-input greentxt" type="text" placeholder="0" value="<?php echo (isset($userData['user_men'])) ? number_format($userData['user_men'], 0, ",", ".") : '';?>"/></td>
                                                            <td><a href="#" class="more-than mt round-2" aria-hidden="true" data-icon="&#x3b;"></a></td>
                                                        </tr>
													</tbody>                                                      
												</table>
											</div><!-- /Men -->
											
											<div class="three columns men"><!-- Women -->
												<a href="#" class="icon_add" style=""><div class="sprite-1 women-icon">Men-icon</div></a>
												<table class="blank-table">
													<tr>
														<td><a href="#" class="less-than lt round-2" aria-hidden="true" data-icon="&#x6c;"></a></td>
														<td><input title="Mujeres" name="user_women" class="blank-input greentxt" type="text" placeholder="0" value="<?php echo (isset($userData['user_women'])) ? number_format($userData['user_women'], 0, ",", ".") : '';?>"/></td>
														<td><a href="#" class="more-than mt round-2" aria-hidden="true" data-icon="&#x3b;"></a></td>
													</tr>
												</table>
											</div><!-- /Women -->
											
											<div class="three columns men"><!-- Boy -->
												<a href="#" class="icon_add" style=""><div class="sprite-1 boy-icon">Men-icon</div></a>
												<table class="blank-table">
													<tr>
														<td><a href="#" class="less-than lt round-2" aria-hidden="true" data-icon="&#x6c;"></a></td>
														<td><input title="Niños" name="user_sons" class="blank-input greentxt" type="text" placeholder="0" value="<?php echo (isset($userData['user_sons'])) ? number_format($userData['user_sons'], 0, ",", ".") : '';?>"/></td>
														<td><a href="#" class="more-than mt round-2" aria-hidden="true" data-icon="&#x3b;"></a></td>
													</tr>
												</table>
											</div><!-- /Boy -->
											
											<div class="three columns men"><!-- Girl -->
												<a href="#" class="icon_add" style=""><div class="sprite-1 girl-icon">Men-icon</div></a>
												<table class="blank-table">
													<tr>
														<td><a href="#" class="less-than lt round-2" aria-hidden="true" data-icon="&#x6c;"></a></td>
														<td><input title="Niñas" name="user_daughters" class="blank-input greentxt" type="text" placeholder="0" value="<?php echo (isset($userData['user_daughters'])) ? number_format($userData['user_daughters'], 0, ",", ".") : '';?>"/></td>
														<td><a href="#" class="more-than mt round-2" aria-hidden="true" data-icon="&#x3b;"></a></td>
														
													</tr>
												</table>
											</div><!-- /Girl -->
										</div>
									</div>
								</div><!-- /Home Persons -->
							</div>
						</div>
					</div>
					<!-- /Content -->
					
					<div class="main-footer"><!--main footer-->
						<div class="shadow"><img src="<?php echo APPLICATION_URL;?>images/shadow-1.png" alt="shadow-1" width="1024" height="20" /></div>
						<div class="container clearfix"><!--container-->
							<div class="text-right right right-btn">
								<a href="javascript:void(0);" onClick="" class="pretty-btn-1 submit">Proyecta tus metas</a>
							</div>
						</div><!--/container-->
					</div><!--/main footer-->


				</div> <!-- /panel -->
				<div class="blue-shadow"><img src="<?php echo APPLICATION_URL;?>images/shadow.png" alt="" width="" height=""></div>

			</div><!-- /Main Panel Width -->
			
		</div>
        </form>
		<!-- 2.1 /Row: Content -->
		
	
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
