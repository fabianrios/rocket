<?php
$userEnvelopesResult	= UserEnvelopeHelper::selectUserEnvelopes("AND user_id = " . $_SESSION["user_active"]);
if(($userEnvelopesResult["num_rows"] > 0) && (isset($_GET[0]) && $_GET[0] == 'start'))
{
	redirectUrl(APPLICATION_URL . 'sobres-040.html');
}
?>
<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
	
<meta charset="ISO-8859-1" />

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
	<link rel="stylesheet" href="<?php echo APPLICATION_URL?>stylesheets/style-1.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo APPLICATION_URL?>stylesheets/jquery-ui-1.8.20.custom.css" type="text/css" />
	<script language="JavaScript">
		var ApplicationUrl = '<?php echo APPLICATION_URL?>';
	</script>
	<script language="JavaScript" src="<?php echo APPLICATION_URL?>javascripts/jquery.min.js" ></script>
	<script language="JavaScript" src="<?php echo APPLICATION_URL?>javascripts/jquery-ui-1.8.20.custom.min.js" ></script>
	<script language="JavaScript" src="<?php echo APPLICATION_URL?>javascripts/envelopes-behaviors.js" ></script>
	<script language="JavaScript" src="<?php echo APPLICATION_URL?>js/ajax_lib.js" ></script>
	<script language="JavaScript" src="<?php echo APPLICATION_URL?>js/ajax_helper.js" ></script>
	<script language="JavaScript" src="<?php echo APPLICATION_URL?>js/form_parser_helper.js" ></script>
	<script language="JavaScript" src="<?php echo APPLICATION_URL?>js/helpers.js" ></script>
	<link rel="shortcut icon" type="image/x-icon" src="<?php echo APPLICATION_URL?><?php echo APPLICATION_URL?>favicon.ico" />
	

	<!--[if lt IE 9]>
		<link rel="stylesheet" src="<?php echo APPLICATION_URL?><?php echo APPLICATION_URL?>stylesheets/ie.css">
	<![endif]-->


	<!-- IE Fix for HTML5 Tags -->
	<!--[if lt IE 9]>
		<script src="<?php echo APPLICATION_URL?>http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

</head>

<body>


<!--1. HEADER -->
<?php	
include_once('header-explora.php');	
unset($_SESSION["visited_dashboard"]);

require_once(SITE_VIEW . "check_envelopes.php");
if(!isset($userEnvelopes))
	$userEnvelopes	= UserEnvelopeHelper::retrieveUserEnvelopes("AND user_id = " . $user->__get('user_id'));
?>
<!--1. /HEADER -->
	


<!--2. MAIN-->
<div id="main"> 
	<div class="container principal clearfix"><!-- Container Padding 20px -->
	

		<!-- 2.2 Row: Content -->
		<div class="row">
			<div class="twelve columns"><!-- Main Panel Width -->
				<div class="panel header-explorar"> <!-- panel -->
					
					<!-- Ribbon -->
					<div class="ribbon">
						<h2><span class="head-e"><span class="sprite-1 sobres-icon">Icon</span></span><strong>Sobres:</strong> Estos sobres son s&oacute;lo para ti</h2>
						<img src="<?php echo APPLICATION_URL?>images/border.png" class="right border" width="12" height="44">
						<a href=""><span aria-hidden="true" class="icon-help"></span></a>
					</div>
					<!-- /Ribbon -->

					<!-- Envelope -->
					<div class="sobre-main">
						
						<div class="row question"><!-- Row Question 3 -->
							<br />
							<div class="eleven columns centered"><!-- 11 col -->
								<h5 class="text-left greytxt no-margin thin">El primer paso para disfrutar de esta herramienta es identificar y activar los sobres que vas a usar, es decir que tipo de grupos de gastos quieres cargar</h5>
							</div>
							<br />
							<div class="blue-shadow"><img src="<?php echo APPLICATION_URL?>images/shadow-03.png" alt="" width="" height=""></div>
						</div>	
						
						<!-- new envelope -->
						<div class="new-expense add-expense-div" style="display:none;" >
							<!-- new expense box -->
							<div class="new-expense-box round-1">
							<p class="text-right no-margin"><span aria-hidden="true" class="icon-cancel bluetxt"></span></p>
								<!-- container -->
								<div class="container">
									
									<a href=""><p aria-hidden="true" class="icon-x-altx-alt text-right close-icon add-expense-close-icon"></p></a>
									<br />
									<h6 class="greentxt">Crear Sobre</h6>
									<hr class="dotted-1" />
									<form action="<?php echo APPLICATION_URL?>envelopes.controller.html" method="post" >
										<input type="hidden" name="action" value="create_envelope" />								
									<table class="blank-table centered" width="100%">
									
										<tr>
											<td>
												<label>Nombre del Sobre</label>
							    			  <input type="text" name="user_envelope_name" class="date-input" value=""/>
											</td>
										</tr>
									</table>
									<hr class="dotted-1" />
										
											<input type="submit" value="Crear Sobre" class="small pretty-btn" />
									</form>		
					
								</div>
								<!-- /container -->
							</div>
							<!-- /new expense box -->
						</div>
						<!-- /new envelope -->
						
						<ul class="sobres-ul clearfix">
							<?php
							$loadedEdit = true;
							$count 			= 1;
							$envelopeIds 	= array();
							foreach($userEnvelopes as $userEnvelope)
							{
								$class			= '';
								$iconStyle		= 'display:none;';
								$budget			= '';
								if(($userEnvelope->__get('user_envelope_budget') != 0) && ($userEnvelope->__get('user_envelope_budget') != ''))
								{
									$class 			= 'sobre-active'; 
									$iconStyle		= '';
									$budget			= $userEnvelope->__get('user_envelope_budget');
								}
								/*else
									$userEnvelope = new UserEnvelope();*/
									
								?>
								<li class="sobre-li <?php echo $class?>" id="envelopecontainer-<?php echo $userEnvelope->__get('user_envelope_id')?>">
									<div class="sobre-img text-center">
										<a href="#" id="envelope-<?php echo $userEnvelope->__get('user_envelope_id')?>" class="envelope_opener">
											<img src="<?php echo APPLICATION_URL?>images/sobre-off.png" alt="sobre-on" width="189" height="143" />
										</a>
										<div class="sprite-1 check" id="check-<?php echo $userEnvelope->__get('user_envelope_id')?>" style="<?php echo $iconStyle?>">icon</div>
									</div>
									<div class="sobre-info text-center">
										<h6 class="sobre-title greytxt"><strong><?php echo $userEnvelope->__get('user_envelope_name')?></strong></h6>
											<h5 class="sobre-value bluetxt" <?php if(($budget == '') || ($budget == 0)) { echo 'style="display:none;"'; } ?> id="budget-<?php echo $userEnvelope->__get('user_envelope_id')?>"><strong><span aria-hidden="true" class="icon-untitled-2"></span> $<?php echo formatNumber($budget, "0", ".", ".")?></strong></h5>										
										
									</div>
								</li>	
								<?php
								$envelopeObjs[$count] = $userEnvelope;
								$count++;
								if($count == 6)
								{
									$loadedEdit = true;
									$count = 1;
									foreach($envelopeObjs as $userEnvelope)
									{
										$envelopeBags = EnvelopeBagHelper::retrieveEnvelopeBags("AND user_id = '" . $user->__get('user_id') . "' AND user_envelope_id = " . $userEnvelope->__get('user_envelope_id'));
										require(SITE_VIEW . "edit_envelope.php");
										$count++;
									}
									$count = 1;
								}
								else
									$loadedEdit = false;
							}
							if(!$loadedEdit)
							{
								$count = 1;
								foreach($envelopeObjs as $userEnvelope)
								{
									$envelopeBags = EnvelopeBagHelper::retrieveEnvelopeBags("AND user_id = '" . $user->__get('user_id') . "' AND user_envelope_id = " . $userEnvelope->__get('user_envelope_id'));
									require(SITE_VIEW . "edit_envelope.php");
									$count++;
								}								
							}
							?>	
								<li class="sobre-li">
									<div class="sobre-new-block text-center">
										<div class="new-sobre">
											<a href="#" class="agregar-sobre">+</a>
										</div>
									</div>
									<div class="sobre-info text-center">
										<h6 class="sobre-title greentxt"><strong>Crear Sobre</strong></h6>				
									</div>
								</li>											
						</ul>
					</div>
					<!-- /Envelope -->
					
					
					<div class="main-footer" /><!-- Main Footer -->
					<div class="shadow"><img src="images/shadow-1.png" alt="shadow-1" width="1024" height="20" /></div>
						<div class="text-center">
							<a href="<?php echo APPLICATION_URL?>sobres-020.html" class="pretty-btn">Activar Sobres</a>
						</div>
					</div><!-- /Main Footer -->

				</div> <!-- /panel -->
				<div class="blue-shadow"><img src="<?php echo APPLICATION_URL?>images/shadow.png" alt="" width="" height=""></div>
				
			</div><!-- /Main Panel Width -->
		</div>
		<!-- 2.2 /Row: Content -->
		
		
	</div><!-- /Container Padding 20px -->
</div>
<!--2. /MAIN--> 	

<?php	
include_once('footer.php');	
?>



<!-- Included JS Files -->

	
	<script type="text/javascript">
	<?php
	if(isset($_GET[0]))
	{
		?>
		$(document).ready(function () {
		$('#pointer-<?php echo $_GET[0]?>').toggle('1000');
		$('#editenvelope-<?php echo $_GET[0]?>').animate({
			height: 'toggle'
		  }, 1000, function() {
		    // Animation complete.
		  });
		})

		<?php
	}
	?>

	</script>
	
		
		
</body>
</html>
