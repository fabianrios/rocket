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
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
	<title>Rocket | Descubra: Selecciona tu producto finaciero</title>
    <meta name="description" content="SITE DESCRIPTION" />
    <meta name="keywords" content="SITE KEYWORDS" />
    <meta name="copyright" content="SITE COPYRIGHT" />
    <meta name="author" content=""/>
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
?>
<!--1./HEADER -->
	


<!--2. MAIN-->
<div id="main"> 
	<div class="container principal clearfix"><!-- Container Padding 20px -->


		<?php	
	$bread_name = array("Explora","Identifica","Resultados");
	$js_array = json_encode($bread_name);
include_once('breadcrumbs-descubra.php');	
?>	

		<!-- Row: Content -->
		<div class="row">
			<div class="nine columns"><!-- 9 col -->
				<div class="panel-1  grad4"> <!-- panel -->

					<div class="row"><!-- Row -->
						<div class="innerheader clearfix"><!-- innerheader -->
							<div class="inner-ribbon"><!-- inner-ribbon -->
								<div class="budget-title left">
									<h2 class="left white txt-shadow-black"><!-- ribbon title -->
										<div class="icon-ribbon">
											<span class="whitetxt" aria-hidden="true" data-icon="&#x72;"></span>
										</div>
										<div class="title-ribbon">
											<p class="whitetxt small-1 txt-shadow-black no-margin">Descubra</p>
											<strong class="whitetxt title-txt">Identifica</strong>
										</div>
									</h2><!-- /ribbon title -->
								</div>
								<div class="sprite-1 ribbon-detail left">icon</div>
							</div><!-- /inner-ribbon -->
						</div><!-- /innerheader -->
					</div><!--/row -->
					


					<!-- Content -->
					<div class="row margin-top-60"><!-- row -->
						<div class="container"><!-- Container Padding 20px -->
						<h2 class="answer">Este es el set de productos que mejor se adapta a tus necesidades.</h2>
							
							<div class="row"><!--row-->
                            	<ul class="identify-block clearfix"><!-- 1/3 -->

                            	<?php
								$i = 0;
								if (count($products) > 0)
								{
									foreach ($products as $product)
									{
										if ($i < 4)
										{
									?>
									
									<li class="identify-item left">
										<div class="two columns">
											<img src="<?php echo APPLICATION_URL?>images/bank-placeholder.png" alt="" width="" height="">
										</div>
										
										<div class="seven columns">
											<h5 class="greytxt product-name"><?php echo utf8_encode($product[1]);?></h5> 
											<h6 class="greytxt no-margin bank-name"><strong><?php echo utf8_encode($product[0]);?></strong></h6>
											<?php
											/*
                                            <h6 class="greytxt no-margin bank-name">Esta cuenta tiene un sistema de costos muy bueno, su principal desventaja es la protección al consumidor financiero. <a href="diagnostico-planeacion/once.html" class="greentxt">Más info <span class="greentxt footer-icon large" aria-hidden="true" data-icon="&#x63;"></span></a> </h6>
											*/
											?>
											
										</div>
										
										<div class="three columns">
									    	<!-- Share block -->
									    	<div class="contact-block">
									    		<div class="contact js-show clearfix">
									    			<div class="contact-dropdown active round-1 clearfix">
														<a href="#"><strong>Contactar</strong> <span aria-hidden="true" data-icon="&#x7a;"></span></a>
															<ul class="contact-li">
																<li><a href="" target="_blank">Sitio Web</a></li>
																<li><a href="" target="_blank">Teléfono</a></li>
																<li><a href="" target="_blank">Chat</a></li>
																<li><a href="" target="_blank">Facebook</a></li>
															</ul>
													</div>
												</div>
									    	</div>
									    	<!-- /Share block -->
											<!--<small class="light-greytxt">Si este producto te interesa puedes contactarte con la entidad.</small>-->
										</div>	
									</li>
									
									<?php
										$i++;
										}
									}
								}
								?>
								</ul><!--/1/3 -->
							</div><!--/row-->
						</div><!-- /Container Padding 20px -->
					</div>
					<!--/Content -->
					
					


					</div> <!--/panel -->
					<div class="shadow"><img src="<?php echo APPLICATION_URL?>images/shadow.png" alt="" width="" height=""></div>
				</div><!-- 9 col -->
				
				<div class="three columns"><!-- Sidebar  3 col-->
		
					<div class="bluebox-fixed box-shadow round-1"><!-- bluebox -->
					    <div class="padding-10"><!-- /Padding 10 -->
					    	<!-- title -->
					    	<h6 class="thin whitetxt text-center large txt-shadow-black">PROMEDIO <strong>GENERAL</strong></h6>
					    	<!-- /title -->
					     	
					     	<!-- total result -->
					     	<div class="total-result-1 clearfix gauge-7">
					     		<p class="whitetxt total-result-diagnostico">70<span class="x-small">/100</span></p>
					     	</div>
					     	<!-- total result -->
		
					     	<!-- calification -->
					     	<div class="calification">
					     		<p class="light-greytxt text-center small-1 txt-shadow-black no-margin">Identifica</p>
					     		<h6 class="whitetxt text-center large txt-shadow-black">Precisión</h6>
					     	</div><!-- calification -->
						</div><!-- /Padding 10 -->
					</div><!-- bluebox -->
		
					<div class="shadow"><!-- bluebox tail -->
						<img src="<?php echo APPLICATION_URL?>images/sidebar-tail.png" alt="sidebar-tail" width="" height="" />
					</div><!-- bluebox tail -->
						
										
					<div class="next-steps-block clearfix"><!-- Next steps -->
						<!-- title -->
						<h6 class="next-step-title dark-greytxt txt-shadow-white">Próximos <strong>Pasos</strong></h6>
						<p class="greytxt explain-1">Según tu diagnóstico te recomendamos usar las siguientes herramientas</p>
						<!-- /title -->	
						
						<ul class="next-steps"> <!-- nav-var -->
							<li>
							    <a href="<?php echo APPLICATION_URL?>metas-000.html">
							    	<span class="nav-icon dark-greytxt" aria-hidden="true" data-icon="&#x65;"></span> 
							    	<span class="nav-text dark-greytxt"><strong>Metas</strong> <span class="dark-greytxt footer-icon large" aria-hidden="true" data-icon="&#x63;"></span> <br /><span class="thin x-small uppercase">Alcanza tu meta</span></span>
							    </a>
							</li>
							
							<li>
							    <a href="<?php echo APPLICATION_URL?>descubra-000.html">
							    	<span class="nav-icon dark-greytxt" aria-hidden="true" data-icon="&#x72;"></span> 
							    	<span class="nav-text dark-greytxt"><strong>Descubra</strong> <span class="dark-greytxt footer-icon large" aria-hidden="true" data-icon="&#x63;"></span> <br /><span class="thin x-small uppercase">Identifica el producto</span></span>
							    </a>
							</li>
							<li>
							    <a href="<?php echo APPLICATION_URL?>sobres-000.html">
							    	<span class="nav-icon dark-greytxt" aria-hidden="true" data-icon="&#x74;"></span> 
							    	<span class="nav-text dark-greytxt"><strong>Sobres</strong> <span class="dark-greytxt footer-icon large" aria-hidden="true" data-icon="&#x63;"></span> <br /><span class="thin x-small uppercase">Finanzas personales</span></span>
							    </a>
							</li>
						</ul> <!-- /nav-var -->
		
					</div><!-- Next steps -->
		
				</div><!-- Sidebar  3 col-->
				
			</div>
			<!-- 2.2/Row: Content -->
		
	</div><!--/Container Padding 20px -->
</div>
<!--2./MAIN-->  	

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
