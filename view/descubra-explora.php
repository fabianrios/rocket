
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
	<title>Rocket | Descubra: Resultado de tu exploración de producto finaciero</title>
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
	


<div id="main">
	<div class="container principal clearfix"><!-- Container Padding 20px -->

		<?php	
			$bread_name = array("Explora");
			$js_array = json_encode($bread_name);
			include_once('breadcrumbs-descubra.php');	
		?>	
					
		<!-- Row: Content -->
		<div class="row">
			<div class="nine columns"><!-- 9 col -->
				<div class="panel-1  grad4"> <!-- panel -->
				
				
					
					<div class="row"><!-- row -->
						<div class="innerheader clearfix"><!-- innerheader -->
							<div class="inner-ribbon"><!-- inner-ribbon -->
								<div class="budget-title left">
									<h2 class="left white txt-shadow-black"><!-- ribbon title -->
										<div class="icon-ribbon">
											<span class="whitetxt" aria-hidden="true" data-icon="&#x72;"></span>
										</div>
										<div class="title-ribbon">
											<p class="whitetxt small-1 txt-shadow-black no-margin">Descubra</p>
											<strong class="whitetxt title-txt">Explora</strong>
										</div>
									</h2><!-- /ribbon title -->
								</div>
								<div class="sprite-1 ribbon-detail left">icon</div>
							</div><!-- /inner-ribbon -->
						</div><!-- /innerheader -->
					</div><!--/row -->
				
								
					<div class="row margin-top-60"><!-- row -->
						<div class="container"><!-- Container Padding 20px -->
						<h2 class="answer">Este es el set de productos que mejor se adapta a tus necesidades.</h2>
							<ul class="block-grid four-up"><!-- 1/3 -->
								<?php
								$first 	= true;
								$pid	= 0;
								foreach ($products as $product)
								{
									$product = new Product($product);
									if ($first)
										$pid = $product->__get('product_id');
									$first = false;
								?>
									<li class="text-center result-explorer round"><!--explorer item-->
										<div class="padding-10"><!--padding container-->
											
											<!-- title -->
											<div class="explorer-title">
												<h5 class="no-margin"><?php echo utf8_encode($product->__get('product_name'));?></h5>
											</div>
											<!-- /title -->
											
											<!-- description -->
											<div class="explorer-description">
												<p><?php echo $product->__get('product_texto');?></p>
											</div>
											<!-- /description -->
											
											<!-- select -->
											<div class="explorer-select">
												<input type="checkbox" name="option2" value="Butter" checked> <strong>Seleccionar</strong>
												<!--<p class="text-center"><a href="<?php echo APPLICATION_URL?>descubra-020/<?php echo $product->__get('product_id');?>.html" class="">Encontrar mi producto</a></p>-->
											</div>
											<!-- /select -->
											
										</div><!--padding container-->
									</li><!--/explorer item-->
								<?php
								}
								?>
	
							</ul><!-- End 1/3 -->
							
							<div class="shadow"><img src="<?php echo APPLICATION_URL?>images/shadow-01.png" alt="" width="" height=""></div>
							
							<p class="text-right">
								<a href="<?php echo APPLICATION_URL?>descubra-020/<?php echo $pid;?>.html" class="pretty-btn-1">Identifica los productos <span class="whitetxt large baseline" aria-hidden="true" data-icon="&#x63;"></span></a>
							</p>
							
						</div><!-- /Container Padding 20px -->
					</div><!-- row -->
						
					
				</div> <!-- /panel -->
				<div class="shadow"><img src="<?php echo APPLICATION_URL?>images/shadow.png" alt="" width="" height=""></div>
			</div><!-- /9 col -->							
			
			<div class="three columns"><!-- 3 cols: sidebar -->
				<div class="bluebox-fixed box-shadow round-1"><!-- bluebox -->
					<div class="padding-10"><!-- /Padding 10 -->
						<!-- title -->
						<h6 class="thin whitetxt text-center large txt-shadow-black">RESULTADO <strong>EXPLORA</strong></h6>
						<!-- /title -->
					 	
					 	<!-- total result -->
					 	<div class="total-result-3">
					 		<p class="whitetxt total-result-explorer">20<span class="tiny">/100</span></p>
					 	</div>
					 	<!-- total result -->
		
					 	<!-- txt -->
					 	<div class="calification">
					 		<h6 class="whitetxt text-center small txt-shadow-black">
					 			CATEGORÍA<br /> PRODUCTOS
					 		</h6>
					 	</div>
					 	<!-- txt -->
					 	
					</div><!-- /Padding 10 -->
				</div><!-- bluebox -->

				<div class="shadow"><!-- bluebox tail -->
					<img src="<?php echo APPLICATION_URL?>images/sidebar-tail.png" alt="sidebar-tail" width="" height="" />
				</div><!-- bluebox tail -->
				
								
				<div class="next-steps-block clearfix"><!-- Next steps -->
					<!-- title -->
					<h6 class="next-step-title dark-greytxt txt-shadow-white"><span class="thin">Próximos</span> <strong>Pasos</strong></h6>
					<p class="greytxt explain-1">Al escoger la categoría del producto puedes identificar cual es el mejor producto para ti dentro de cada
categoría</p>
					<!-- /title -->	
				</div><!-- Next steps -->

			</div><!-- 3 cols: sidebar -->
		
		</div>
		<!-- /Row: Content -->
		
	</div><!-- /Container Padding 20px -->
</div>
<!--/2. MAIN-->

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
