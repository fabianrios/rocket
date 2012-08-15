<?php
$user = new User($_SESSION['user_active']);
foreach ($_POST as $key=>$value)
	$userData 	= UserHelper::setData($user->__get('user_id'), $key, $value);
$user 		= new User($_SESSION['user_active']);
$product 	= isset($_GET[0]) ? $_GET[0] : 14;
$product	= new Product($_GET[0]);
if ($product->__get('parent_id') != 0)
	$parent	= $product->__get('parent_id');
else 
	$parent	= $product->__get('product_id');

if ($parent == 1)
	$model = new TCreditosValue($user, $product->__get('product_equivalencia'), false);
if ($parent ==4)
	$model = new CreditosValue($user, $product->__get('product_equivalencia'), false);
if ($parent == 6)
	$model = new DepositosVValue($user, $product->__get('product_equivalencia'), false);
if ($parent == 14)
	$model = new DepositosTValue($user, $product->__get('product_equivalencia'), false);	


$products = $model->getWithFilters();


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
?>
<!--1. End HEADER -->
	


<!--2. MAIN-->
<div id="main"> 
	<div class="container principal clearfix"><!-- Container Padding 20px -->

<?php	
$bread_name = "Resultados";
include_once('breadcrumbs-descubra.php');	
?>	

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
					


					<!-- Content -->
					<div class="descubra-main">
					
					<div class="row margin-top-10"><!-- Row Result -->
							<div class="eleven columns centered"><!-- 10 col -->
								<div class="row"><!-- Row -->
								
					 				<div class="two columns">
					 					<div class="circle-descubra">
					 					</div>
					 				</div>
					 				
					 				<div class="ten columns">
					 					
                                         
										
                                        <h2>Estas son las opciones para ti!</h2>
					 					
                                        
					 				</div>
					 				
								</div><!-- /Row -->
							</div><!-- 10 col -->
					 	</div><!-- /Row Result -->
					 	

					
						<div class="row margin-top-30"><!-- Row Result -->
						<div class="blue-shadowmargin-top-30"><img src="<?php echo APPLICATION_URL?>images/shadow-02.png" alt="" width="" height=""></div>
						</div>

				

							
						<div class="eleven columns centered">
							<div class="row">
                            	<ul class="block-grid four-up"><!-- 1/3 -->

                            	<?php
								$i = 0;
								if (count($products) > 0)
								{
									foreach ($products as $product)
									{
										if ($i < 4)
										{
									?>
								
										<li>
										<div class="meta-result">
										<div class="padding-10">
											<!-- cuenta -->
											<div class="text-center">
											<img src="<?php echo APPLICATION_URL?>images/bank.png" alt="" width="" height="">
													<h5 class="greytxt no-margin bank-name"><?php echo utf8_encode($product[0]);?></h5>
													<h6 class="greytxt product-name"><?php echo utf8_encode($product[1]);?></h6> 
											</div>
											<!-- END cuenta -->
											
											<hr class="break" />
											<!-- contacto-entidad -->
											<div class="contacto-entidad">
												<h6 class="text-center greytxt thin">Puedes contactar a la entidad:</h6> 
												<ul class="entidad clearfix ">
													<li class="telefono">telefono</li>
													<li class="representante">representante</li>
													<li class="twitter">twitter</li>
													<li class="face">Facebook</li>
												</ul>
											<hr class="break" />
												<p class="text-center"><a href="#" class="small pretty-btn">Quiero este producto</a></p>
											</div>
											<!-- END contacto-entidad -->
											
										</div>	
										</div>
									</li>
									
									<?php
										$i++;
										}
									}
								}
								?>
								</ul><!-- End 1/3 -->

								

							</div>
						</div>
						
					</div>
					<!-- End Content -->
					
					<div class="main-footer">
					<div class="shadow"><img src="<?php echo APPLICATION_URL?>images/shadow-1.png" alt="shadow-1" width="1024" height="20" /></div>
						<div class="text-center">
							<a href="<?php echo APPLICATION_URL?>descubra-020/<?php echo $_GET[0];?>.html" class="pretty-btn"><span class="whitetxt large baseline" aria-hidden="true" data-icon="x"> Anterior</a>
						</div>
					</div>
					


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
