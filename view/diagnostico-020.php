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
	<script src="<?php echo APPLICATION_URL?>javascripts/jquery.min.js"></script>
	<script src="<?php echo APPLICATION_URL?>javascripts/modernizr.foundation.js"></script>
	<script src="<?php echo APPLICATION_URL?>javascripts/foundation.js"></script>
	<script src="<?php echo APPLICATION_URL?>javascripts/app.js"></script>
	<script type="text/javascript" src="<?php echo APPLICATION_URL?>javascripts/jquery-ui-1.8.17.custom.min.js"></script>
	<script src="<?php echo APPLICATION_URL?>js/ajax_helper.js"></script>
    <script src="<?php echo APPLICATION_URL?>js/ajax_lib.js"></script> 
    <script src="<?php echo APPLICATION_URL?>js/helpers.js"></script>    
    <script language="javascript">
    	
    </script>      
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
$tablePrefix 		= 'salu_';
$groups 			= QuestionHelper::retrieveQuestions(" GROUP BY question_group", "", "salu_");
$tab				= 2;
$questions			= QuestionHelper::retrieveQuestions(" GROUP BY question_group", "", "salu_");
foreach ($_POST as $key=>$value)
{
	$userData 	= UserHelper::setData($user->__get('user_id'), $key, str_replace(".", "", $value));
}
if (!isset($_GET[0]))
{
	$nextTab	= $tab+1;
	$action		= APPLICATION_URL."diagnostico-030/".$nextTab.".html";	
}
else
	$action	= APPLICATION_URL."diagnostico-050.html";
$userData	= unserialize($user->__get('user_data'));
?>
<!--1. End HEADER -->
	


<!--2. MAIN-->
<div id="main"> 
	<div class="container principal clearfix"><!-- Container Padding 20px -->
	
		<!-- 2.1 Row: Title -->
		<div class="row">
			<div class="six columns">
				<h2 class="title"><span class="sprite-1 diagnostico-icon">Icon</span>Diagnóstico</h2>
			</div>

			<div class="six columns">	
				<!-- breadcrumbs -->		
				<ul class="breadcrumbs">
					<li class="breadcrumb-active">1 Diagnóstico</li>
					<li>2</li>

				</ul>
				<!-- END breadcrumbs -->
			</div>	
		<hr class="dotted" />
		</div>
		<!-- 2.1 END Row: title -->
		<form action="<?php echo $action;?>" method="post" id="questions">
		<!-- 2.2 Row: Content -->
		<div class="row">
			<div class="twelve columns"><!-- Main Panel Width -->
				<div class="panel header-explorar"> <!-- panel -->
					
					<!-- Ribbon -->
					<div class="ribbon">
						<h2><span class="head-e"><span class="num">1</span></span><strong>Diagnóstico</strong></h2>
						<img src="<?php echo APPLICATION_URL?>images/border.png" class="right border" width="12" height="44">
						<div class="steps">
						<ul>
							<?php
							$i	= 1;
							foreach ($groups as $group)
							{
							?>
								<li <?php if ($i == $tab) { ?>class="active-step"<?php } ?>><?php echo $i;?></li>
                           	<?php
								$i++;
							}
							?>
						</ul>
						</div>
					</div>
					<!-- End Ribbon -->
										
					<!-- Content -->
					<div class="descubra-main">
						<?php
                        require_once(SITE_VIEW . "fields2.php");
                        ?>	  					
						
					</div>
					<!-- End Content -->
					<div class="orbit-shadow" />
						<div class="text-center">
                        	<?php
							if ($tab > 1)
							{
							?>
								<a href="<?php echo APPLICATION_URL?>diagnostico-010/<?php echo $tab-1;?>.html" class="pretty-btn"><span class="whitetxt large baseline" aria-hidden="true" data-icon="x"> Anterior</a>
                            <?php
							}
							if ($tab == count($groups))
							{
							?>
								<a href="javascript:void(0);" onClick="document.getElementById('questions').submit();" class="pretty-btn">Ver resultados</a>
							<?php
							}
							else
							{
							?>
                            	<a href="javascript:void(0);" onClick="document.getElementById('questions').submit();" class="pretty-btn">Siguiente</a>
                            <?php
							}
							?>
						</div>
					</div>

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
