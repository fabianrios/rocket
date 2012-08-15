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
$explora		= new Explora(1);
$answer			= new ExploraAnswer(1);
$answer_text 	= explode("/", $answer->__get('answer_text'));
											  
include_once('header.php');	
?>
<!--1. End HEADER -->
	


<!--2. MAIN-->
<div id="main"> 
	<div class="container principal clearfix"><!-- Container Padding 20px -->
	
<?php	
$bread_name = "Explora";
include_once('breadcrumbs-descubra.php');	
?>	

		<!-- 2.2 Row: Content -->
		<div class="row">
			<div class="twelve columns"><!-- Main Panel Width -->
				<div class="panel header-explorar"> <!-- panel -->
					
					<!-- Ribbon -->
					<div class="ribbon">
						<h2><span class="head-e"><span class="sprite-1 descubra-icon">Icon</span></span><strong>Descubra:</strong> Explorar</h2>
						<img src="images/border.png" class="right border" width="12" height="44">
						<div class="steps">
						</div>
					</div>
					<!-- End Ribbon -->
					
						<div class="row question"><!-- Row Question 3 -->
							<br />
							<div class="eleven columns centered"><!-- 11 col -->
								<h5 class="text-center greytxt no-margin"><strong>Existen más tipos de productos de los que imaginas, ¿estas seguro cúal es el que mejor se adapta a lo que necesitas? Identifícalo con esta herramienta.</strong></h5>
							</div>
							<br />
							<div class="blue-shadow"><img src="<?php echo APPLICATION_URL?>images/shadow-03.png" alt="" width="" height=""></div>
						</div>	
										
					<!-- Content -->
					<div class="descubra-main" id="questionDiv">
						<div class="descubra-question"><!-- Question tres Preguntas -->
        				    <h4 class="greytxt text-center"><strong><?php echo utf8_encode($explora->__get('explora_question'));?></strong></h4>
        				    <ul class="block-grid two-up">	
 
						         
<li>
                                    <a href="javascript:void(0);" onClick="Rep(<?php echo $answer->__get('answer_goto')?>);">                                
                                        <div class="bubble-1 text-center">
                                            <div class="bubble-txt">
                                                <h4 class="whitetxt txt-shadow-black assertion"><?php echo utf8_encode($answer_text[0]);?></h4>
                                                <p class="small whitetxt txt-shadow-black"><?php echo  utf8_encode($answer_text[1]);?></p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
						        
						        
						        <li>                                            
        				             <div class="bubble-1 text-center">
						        	     <div class="bubble-txt">
						        	     <a href="javascript:void(0);" onClick="Rep(100);">
						        	     	<h4 class="whitetxt txt-shadow-black assertion">No quiero acompañamiento</h4>
						        	     	<p class="small whitetxt txt-shadow-black">Sé que tipo de producto necesito.</p>
						        	     </a>
						        	     </div>
						        	 </div>
        				    	</li>
        				    	

        				    </ul>
						</div><!-- End Question tres Preguntas -->			
					</div>
					<!-- End Content -->
				</div> <!-- END panel -->
				<div class="blue-shadow"><img src="images/shadow.png" alt="" width="" height=""></div>

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

	function Rep(val)
	{
		SimpleAJAXCall('descubra-questions/'+val+'.html', ElementStateChanged, 'GET', 'questionDiv');
	}
	function Ans(val)
	{
		window.location.href="<?php echo APPLICATION_URL;?>descubra-explora/"+val+".html";
	}	
	</script>
	
	
		
</body>
</html>
