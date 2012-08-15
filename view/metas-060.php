<?php 

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
	<link rel="stylesheet" href="<?php echo APPLICATION_URL?>stylesheets/jquery-ui-1.8.17.custom.css" type="text/css" />
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
	

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
foreach ($_POST as $key=>$value)
	$_POST[$key] = str_replace(".", "", str_replace("$", "", $value));
include_once('header.php');	
$sueno 	= new Sueno($user);	
foreach ($_POST as $key=>$value)
{
	$sueno->addFilter($key, str_replace("$", "", $value));
}
$sueno->addFilter('tiempo_sueno', 0);
$salidas	= $sueno->calculate();
?>
<!--1. End HEADER -->
	


<!--2. MAIN-->
<div id="main"> 
	<div class="container principal clearfix"><!-- Container Padding 20px -->
	


		<!-- 2.2 Row: Content -->
		<div class="row">
			<div class="twelve columns"><!-- Main Panel Width -->
				<div class="panel header-explorar"> <!-- panel -->
					
					<!-- Ribbon -->
					<div class="ribbon">
						<h2><span class="head-e"><span class="sprite-1 metas-icon">Icon</span></span><strong>Metas:</strong> Así podrás hacer tu meta realidad</h2>
						<img src="<?php echo APPLICATION_URL?>images/border.png" class="right border" width="12" height="44">
					</div>
					<!-- End Ribbon -->
					
					
					<h3>Estas son las alternativas que tienes para que puedas hacer tu meta realidad</h3>
					
					
					<!-- Content -->
					<div class="descubra-main clearfix">
					<div class="container">
					
						<div class="row margin-top-10"><!-- Row Result -->
							<div class="ten columns centered"><!-- 10 col -->
								<div class="row"><!-- Row -->
								
					 				<div class="two columns">
					 					<div class="circle-metas">
					 					</div>
					 				</div>
					 				
					 				<div class="ten columns">
					 					<h2>Puedes adquirir tu crédito</h2>
					 					<p><strong>Dado tu objetivo:</strong>Tu objetivo es plausible, te recomendamos ir a la herramienta Sueno	</p>
					 				</div>
					 				
								</div><!-- /Row -->
							</div><!-- 10 col -->
					 	</div><!-- /Row Result -->
					
						<div class="row margin-top-30"><!-- Row Result -->
					 		<div class="ten columns centered">

					 			<div class="row">
					 			
					 			 <?php
								$i = 0;
								foreach ($salidas as $salida)
								{
									$i++;
									if ($salida['tipo'] == 'positivo')
									{
								?>
					 				<div class="three columns meta-result">
					 				<div class="padding-10">
					 				<h5 class="text-center greytxt"><strong>Opcion <?php echo $i;?></strong>
					 				</h5>
					 									 				<br />

					 						<div class="knob-2">
												<p class="meses-number text-center"><?php echo $salida['tiempo']?><br />
												<span class="small no-margin"><strong>MESES</strong></span>
												</p>
											</div>
					 						<!-- <p class="justified"><?php echo ucfirst(strtolower($salida))?></p> -->
					 						<ul class="metas-result-ul">
					 							<li class="text-center"><h6 class="bluetxt no-margin">CUOTA: $<?php echo $salida['cuota'];?> </h6></li>
					 							<li class="text-center metas-result-li"><h6 class="greytxt">TOTAL: $<?php echo $salida['total'];?><h6></li>
					 							<li class="text-center"><a href="<?php echo APPLICATION_URL?>diagnostico-010.html" class="small pretty-btn">Quiero este crédito</a></li>
					 						</ul>
					 						
					 				</div>
					
					 				</div>
					 								 				
					 			<?php
									}	
								}
								?>   
					 				
					 		</div>
					 	
					 	</div><!-- Row Result -->
					</div>
					</div>
					</div>
					<!-- /Content -->
										

			
					

				</div> <!-- END panel -->
				<div class="blue-shadow"><img src="<?php echo APPLICATION_URL?>images/shadow.png" alt="" width="" height=""></div>

			</div><!-- End Main Panel Width -->
			

			
		</div>
		<!-- 2.2 End Row: Content -->
		
		
	</div><!-- END Container Padding 20px -->
</div>
<!--2. END MAIN--> 	

<?php	
include_once('footer.php');	
?>

<!-- Included JS Files -->
	<script src="<?php echo APPLICATION_URL?>javascripts/jquery.min.js"></script>
	<script src="<?php echo APPLICATION_URL?>javascripts/modernizr.foundation.js"></script>
	<script src="<?php echo APPLICATION_URL?>javascripts/foundation.js"></script>
	<script src="<?php echo APPLICATION_URL?>javascripts/app.js"></script>
	<script type="text/javascript" src="<?php echo APPLICATION_URL?>javascripts/jquery-ui-1.8.17.custom.min.js"></script>
	
		<script type="text/javascript">
	$(function() {
		$( ".slider" ).slider({
			value:100000,
			min: 500000,
			max: 60000000,
			step: 50000,
			slide: function( event, ui ) {
				$( ".amount" ).val( "$" + ui.value );
			}
		});
		$( ".amount" ).val( "$" + $( ".slider" ).slider( "value" ) );
	});
	</script>
	
		
		
</body>
</html>
