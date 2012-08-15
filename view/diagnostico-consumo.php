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
	<link rel="stylesheet" href="<?php echo APPLICATION_URL?>stylesheets/jquery-ui-1.8.17.custom.css" type="text/css" />
	<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700' rel='stylesheet' type='text/css'>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
	<script language="JavaScript" src="<?php echo APPLICATION_URL?>javascripts/jquery.min.js" ></script>
	<script language="JavaScript" src="<?php echo APPLICATION_URL?>javascripts/jquery-ui-1.8.20.custom.min.js" ></script>
	<script language="JavaScript" src="<?php echo APPLICATION_URL?>javascripts/diagnostics-behaviors.js" ></script>
	<script language="JavaScript" src="<?php echo APPLICATION_URL?>javascripts/global-functions.js" ></script>
	<script language="JavaScript" src="<?php echo APPLICATION_URL?>js/ajax_lib.js" ></script>
	<script language="JavaScript" src="<?php echo APPLICATION_URL?>js/ajax_helper.js" ></script>
	<script language="JavaScript" src="<?php echo APPLICATION_URL?>js/form_parser_helper.js" ></script>
	<script language="JavaScript" src="<?php echo APPLICATION_URL?>js/helpers.js" ></script>
	<script language="JavaScript">
		function validateInputs() {
			var validForm = true;
			dataArray = Array("Debe contestar las siguientes preguntas para continuar:");
			$('input[type="hidden"]').each( function () {
				if(($(this).val() == '') && ($(this).hasClass('precision-data') == false))
				{
					validForm = false;
					dataArray[dataArray.length] = '- ' + $(this).attr('title');
				}
			});
			
			if(!validForm) {
				parseAlert(1, dataArray);
				
				return false;
			}
			else {
				document.getElementById('questions').submit();
				return true;
			}
		}
	</script>       
	<?php	
	
	include_once('menu-script.php');
	?>
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
include_once('header.php');	
foreach ($_POST as $key=>$value)
{
	$userData 	= UserHelper::setData($user->__get('user_id'), $key, $value);
}
$userData 	= unserialize($user->__get('user_data'));
if (!isset($userData['user_income_representation']))
	javascriptExecute("window.location.href='".APPLICATION_URL."diagnostico-010.html'");
$tablePrefix 		= 'salu_';
$groups 			= QuestionHelper::retrieveQuestions(" GROUP BY question_group", "", "salu_");
$tab				= 3;
$questions			= QuestionHelper::retrieveQuestions(" GROUP BY question_group", "", "salu_");


$action	= APPLICATION_URL."diagnostico-finanzas.html";	
?>
<!--1. End HEADER -->
	


<!--2. MAIN-->
<div id="main"> 
	<div class="container principal clearfix"><!-- Container Padding 20px -->
	
<?php	
	$bread_name = array("Consumo");
	$js_array = json_encode($bread_name);
	include_once('breadcrumbs.php');	
?>

		<form action="<?php echo $action;?>" method="post" id="questions">
		<!-- 2.2 Row: Content -->
		<div class="row">
			<div class="twelve columns"><!-- Main Panel Width -->
				<div class="panel header-explorar"> <!-- panel -->
					
					<!-- Ribbon -->
					<div class="ribbon">
						<h2><span class="head-e"><span class="sprite-1 diagnostico-icon">Icon</span></span><strong>Diagnóstico: </strong>Hábitos de consumo</h2>
						<img src="<?php echo APPLICATION_URL?>images/border.png" class="right border" width="12" height="44">

					</div>
					<!-- End Ribbon -->

						<div class="row question"><!-- Row Question 3 -->
							<br />
							<div class="eleven columns centered"><!-- 11 col -->
								<h5 class="text-center greytxt no-margin"><strong>Un factor fundamental en tu diagnóstico es cómo gastas en el día a día. Contesta las siguientes preguntas para identificar este aspecto.</strong></h5>
							</div>
							<br />
							<div class="blue-shadow"><img src="<?php echo APPLICATION_URL?>images/shadow-03.png" alt="" width="" height=""></div>
						</div>	
										
					<!-- Content -->
					<div class="descubra-main">
						<?php
                        require_once(SITE_VIEW . "fields2.php");
                        ?>	  					
						
					</div>
					<!-- End Content -->


					
					
										
					<div class="main-footer"><!--main footer-->
						<div class="shadow"><img src="<?php echo APPLICATION_URL;?>images/shadow-1.png" alt="shadow-1" width="1024" height="20" /></div>
						<div class="container clearfix"><!--container-->
							<div class="text-left left-btn left">
								<a href="<?php echo APPLICATION_URL?>diagnostico-planeacion.html" class="greytxt"> Volver</a> |							
								
								<a href="javascript:void(0);" onClick="document.getElementById('questions').action='<?php echo APPLICATION_URL?>diagnostico-050.html';" class="greytxt submit">Ver resultados </a>
							</div>

							<div class="text-right right right-btn">
								<a href="javascript:void(0);" onClick="document.getElementById('questions').action='<?php echo APPLICATION_URL?>diagnostico-finanzas.html';" class="pretty-btn-1 submit">Diagnóstico finanzas</a>

							</div>
						</div><!--/container-->
					</div><!--/main footer-->
				
					
					
					
					


				</div> <!-- END panel -->
				<div class="blue-shadow"><img src="<?php echo APPLICATION_URL?>images/shadow.png" alt="" width="" height=""></div>

			</div><!-- End Main Panel Width -->
			
		</div>
		<!-- 2.2 End Row: Content -->
		</form>	
			
	</div><!-- END Container Padding 20px -->
</div>
<!--2. END MAIN--> 	

<?php	
include_once('footer.php');	
?>
</body>
</html>
