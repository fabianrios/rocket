
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
$salida	= new Salida($_GET[0]);
$products	= explode(",", $salida->__get('salida_productos'));
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
						<h2><span class="head-e"><span class="sprite-1 descubra-icon">Icon</span></span><strong>Resultados:</strong> nuestra recomendación para ti</h2>
						<img src="<?php echo APPLICATION_URL?>images/border.png" class="right border" width="12" height="44">
					</div>
					<!-- End Ribbon -->
					
						<div class="row question"><!-- Row Question 3 -->
							<br />
							<div class="ten columns centered"><!-- 11 col -->
								<h4 class="text-center greytxt no-margin thin">Estos son los tipos de productos que se adaptan a tus necesidades.</h4>
							</div>
							<br />
							<div class="blue-shadow"><img src="<?php echo APPLICATION_URL?>images/shadow-03.png" alt="" width="" height=""></div>
						</div>

					<!-- Content -->
					<div class="descubra-main">
					

					
						<div class="row margin-top-30"><!-- Row Result -->
						</div>

				

							
						<div class="eleven columns centered">
							<div class="row">
                            	<ul class="block-grid four-up"><!-- 1/3 -->


									<?php
									foreach ($products as $product)
									{
										$product = new Product($product);
									?>
                                        <li>
                                            <div class="meta-result">
                                            <div class="padding-10">
                                                <!-- cuenta -->
                                                <div class="text-center">
                                                <img src="<?php echo APPLICATION_URL?>images/bank.png" alt="" width="" height="">
                                                        <h5 class="greytxt no-margin bank-name"><?php echo utf8_encode($product->__get('product_name'));?></h5>
                                                </div>
                                                <!-- END cuenta -->
                                                
                                                <!-- contacto-entidad -->
                                                <div class="contacto-entidad">
            
                                                    <p class="text-center"><a href="<?php echo APPLICATION_URL?>descubra-020/<?php echo $product->__get('product_id');?>.html" class="small pretty-btn">Encontrar mi producto</a></p>
                                                </div>
                                                <!-- END contacto-entidad -->
                                                
                                            </div>	
                                            </div>
                                        </li>
									<?php
									}
									?>
	
								</ul><!-- End 1/3 -->

								

							</div>
						</div>
						
					</div>
					<!-- End Content -->
					
					


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
	<script src="javascripts/jquery.min.js"></script>
	<script src="javascripts/modernizr.foundation.js"></script>
	<script src="javascripts/foundation.js"></script>
	<script src="javascripts/app.js"></script>
	<script type="text/javascript" src="javascripts/jquery-ui-1.8.17.custom.min.js"></script>

		
</body>
</html>
<?php

?>
