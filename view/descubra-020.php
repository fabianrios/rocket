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
	<title>Rocket | Descubra: Identifica tus productos financieros</title>
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
	<script type="text/javascript" src="<?php echo APPLICATION_URL?>javascripts/jquery-ui-1.8.20.custom.min.js"></script>
	<script src="<?php echo APPLICATION_URL?>javascripts/global-functions.js"></script>	
	<script src="<?php echo APPLICATION_URL?>js/ajax_lib.js"></script>
	<script src="<?php echo APPLICATION_URL?>js/ajax_helper.js"></script>
	<script src="<?php echo APPLICATION_URL?>js/helpers.js"></script>
	<script src="<?php echo APPLICATION_URL?>javascripts/descubra-precision.js"></script>
	
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
	<script language="javascript">
		$(function () {
			$('.save').unbind('click');
			$('.save').click(function () {
				validForm = validate();
				if(validForm)
				{
					document.getElementById('questions').submit();
				}
			});
		});
		function validate() {
			var alertString = '';
			$('.validable').each(function (index) {
				if(($(this).val() == '0') || ($(this).val() == '') || ($(this).val() == 'NULL') || ($(this).val() == '0 meses') || ($(this).val() == '$0'))
				{

					alertString += '- ' + $(this).attr("title") + '\r\n';
				}
			});
			if(alertString == '')
			{
				return true;
			}
			else
			{
				alertString = 'Por favor responda las siguientes preguntas para continuar:\r\n' + alertString;
				alert(alertString);
				return false;
			}
		}
		function geoChanged(response, id) {
			$('#' + id).html(response);
		}
	</script>
</head>
<body>
<!--1. HEADER -->
<?php	
include_once('header.php');	
foreach ($_POST as $key=>$value)
{
	$userData 	= UserHelper::setData($user->__get('user_id'), $key, str_replace(".", "", $value));
}
$productId 			= (isset($_GET[0])) ? $_GET[0] : 4;
$productId2			= $productId;
$product			= new Product($productId);
$extra				= "";
if ($product->__get('parent_id') != 0)
{
	$productId2		= $product->__get('parent_id');
	$extra			= " OR product_id = " . escape($productId);
}
$tablePrefix 		= 'iden_';
$groups 			= OrderHelper::retrieveOrders("AND product_id = " . $productId2 . $extra . " GROUP BY group_id");
$tab				= (isset($_GET[1])) ? $_GET[1] : 1;
$questions			= OrderHelper::retrieveOrders("AND product_id = " . $productId2 . $extra . " AND group_id = " . $tab . " AND parent_id = 0 AND order_restriction not like '%,".$productId.",%' ORDER by order_value");
$group				= new Group($tab);
?>
<!--1. End HEADER -->
	


<!--2. MAIN-->
<div id="main"> 
	<div class="container principal clearfix"><!-- Container Padding 20px -->
<?php	
	$bread_name = array("Explora","Identifica");
	$js_array = json_encode($bread_name);
include_once('breadcrumbs-descubra.php');	
?>	

		<!-- 2.2 Row: Content -->
		<div class="row">
			<div class="nine columns"><!-- Main Panel Width -->
				<div class="panel header-explorar"> <!-- panel -->
					
					<!-- Ribbon -->
					<div class="ribbon">
						<h2><span class="head-e"><span class="descubra-icon" aria-hidden="true" data-icon="&#x72;"></span> </span><strong>Identifica:</strong> <?php echo utf8_encode($group->__get('group_name'));?></h2>
						<img src="<?php echo APPLICATION_URL?>images/border.png" class="right border" width="12" height="44">
					</div>
					<!-- End Ribbon -->
					
	
					
					
					<form action=""	method="post" id="questions">				
					<!-- Content -->
					<div class="descubra-main">

					<div class="row question"><!-- Row Question 3 -->
							<br />
							<div class="eleven columns centered"><!-- 11 col -->
								<h5 class="text-left greytxt no-margin thin"><strong><?php echo utf8_encode($group->__get('group_summary'));?></strong></h5>
							</div>
							<br />
							<div class="blue-shadow"><img src="<?php echo APPLICATION_URL?>images/shadow-03.png" alt="" width="" height=""></div>
						</div>	

						<?php
                        require_once(SITE_VIEW . "fields.php");
                        ?>	                    
						
					</div>
					<!-- End Content -->
					</form>
					
					
					
					
					
					<div class="main-footer">
					<div class="shadow"><img src="<?php echo APPLICATION_URL?>images/shadow-1.png" alt="shadow-1" width="1024" height="20" /></div>
						<div class="container clearfix"><!--container-->
						<div class="text-right right right-btn"><!--action-->
                        	<?php
							if ($tab > 1)
							{
							?>
								<a href="javascript:window.history.back(1);" class="greytxt"> <strong>Anterior</strong></a>
                            <?php
							}
							if ($tab == count($groups))
							{
							?>
								<a href="javascript:void(0);" onClick="document.getElementById('questions').action='<?php echo APPLICATION_URL?>descubra-030/<?php echo $productId?>.html'; document.getElementById('questions').submit();" class="pretty-btn-1 save">Ver resultados</a>
							<?php
							}
							else
							{
							?>
                            	<a href="javascript:void(0);" onClick="document.getElementById('questions').action='<?php echo APPLICATION_URL?>descubra-020/<?php echo $productId?>/<?php echo $tab+1;?>.html'; "  class="pretty-btn-1 save">Siguiente</a>
                            <?php
							}
							?>
							</div>
						</div>
					</div>
					
					


				</div> <!-- END panel -->
				<div class="blue-shadow"><img src="<?php echo APPLICATION_URL?>images/shadow.png" alt="" width="" height=""></div>

			</div><!-- End Main Panel Width -->
			<div class="three columns"><!-- Sidebar -->
			
			<div class="bluebox-fixed box-shadow round-1"><!-- bluebox -->
			    <div class="padding-10"><!-- /Padding 10 -->
			  		<!-- title -->
				    <h6 class="thin whitetxt text-center large txt-shadow-black">NIVEL DE <strong>PRECISIÓN</strong></h6>
				    <p class="giant"><?php echo intval((($tab-1)/(count($groups)+1))*80);?><span class="percentage">%</span></p>
				    <!-- /title -->
				    <hr class="white" />
			  	
					<div class="box-input text-center">
				    <label class="whitetxt text-center txt-shadow-black">Categoría de producto:</label>
				   	<h4 class="whitetxt txt-shadow-black"><strong><?php echo utf8_encode($product->__get('product_name'));?></strong></h4>
					</div>

				</div><!-- /Padding 10 -->
			</div><!-- bluebox -->
			<div class="shadow"><!-- bluebox tail -->
				<img src="<?php echo APPLICATION_URL?>images/sidebar-tail.png" alt="sidebar-tail" width="" height="" />
			</div><!-- bluebox tail -->

				
			</div><!-- End Sidebar -->
			

			
		</div>
		<!-- 2.2 End Row: Content -->
		
		
	</div><!-- END Container Padding 20px -->
</div>
<!--2. END MAIN--> 	

<?php	
include_once('footer.php');	
?>

<!-- Included JS Files -->

	

	
	
		
</body>
</html>
