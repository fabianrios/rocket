<?php
if ( (!isset($_SESSION['user_active'])) || ($_SESSION['user_active'] == ''))
	redirectUrl('/home.html'); 
$_SESSION['user_active'] 	= $_SESSION['user_active'];
$user 						= new User($_SESSION['user_active']);
$avatarImg 					= 'resources/Avatar/30x30.jpg';
if(strpos($user->__get('user_image'), 'https:') !== false)
	$avatarImg = $user->__get('user_image');
?>
<!-- <!DOCTYPE html> -->
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
	<link rel="stylesheet" href="stylesheets/foundation.css">
	<link rel="stylesheet" href="stylesheets/style.css" type="text/css" />
	<link rel="stylesheet" href="stylesheets/jquery-ui-1.8.17.custom.css" type="text/css" />
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
	


	<!--[if lt IE 9]>
		<link rel="stylesheet" href="stylesheets/ie.css">
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


<!--MAIN-->         
<div id="main">
	<div class="container principal clearfix"><!-- Container Padding 20px -->
		
		<!-- 2.2 Row: Content -->
		<div class="row">
			<div class="twelve columns"><!-- Main Panel Width -->
				<div class="panel"> <!-- panel -->
	
				<!-- Row -->
				<div class="row">
					<!-- 11 col -->
				    <div class="eleven columns centered">
				    	<!-- innerheader -->
				    	<div class="bugdet-innerheader clearfix">
				    		<!-- ribbon -->
				    		<div class="budget-ribbon">
				    			<div class="budget-title left">
				    				<h2 class="left white txt-shadow-black"><strong class="whitetxt"><span class="whitetxt" aria-hidden="true" data-icon="&#x3c;"></span> Cambiar contraseña</strong></h2>
				    			</div>
				    			<div class="sprite-1 ribbon-detail left">icon</div>
				    		</div>
							<!-- /ribbon -->
				    	</div>
				    	<!-- /innerheader -->
				    </div>
				    <!-- /11 col -->
				</div>
				<!--/Row -->
	
				<!--CONTENT-->
				<div class="start-main clearfix">
					<!-- container -->
					<div class="container">
						<!-- row -->
						<div class="row">
							<!-- 4 col -->
							<div class="four columns">
								<br />
								<form method="post" action="<?php echo APPLICATION_URL?>user.controller.html" id="registerForm" >
									
									<div class="mid-input-div"><!-- Div Input -->
									<label>Contrase&ntilde;a anterior</label>
									    <input name="old_password" type="password" class="input" />
									    <div class="pass" style="display:none;">Check</div>
									</div>
	            		            						
									<div class="mid-input-div"><!-- Div Input -->
									<label>Nueva contrase&ntilde;a</label>
									    <input name="user_password" type="password" class="input" />
									    <div class="pass" style="display:none;">Check</div>
									</div>
									<div class="mid-input-div"><!-- Div Input Button & Recuperar Contrase&ntilde;a-->
										<div class="action clearfix">
											<div class="login-btn">
												<p>
												<input type="hidden" name="user_id" value ="<?php echo $_SESSION['user_active'];?>" />
	            		                        <input type="hidden" name="action" value ="updatePassword" />
												<input type="submit" value="Actualizar" class="pretty-btn" />
												</p>
											</div>
										</div>	
									</div>
								</form>
							</div>
							<!-- /4 col -->
						</div>
						<!-- row -->
					</div>
					<!-- container -->
					</div>	
					<!--END CONTENT-->

  				</div> <!-- panel -->
 			</div><!-- Main Panel Width -->
		</div>
		<!-- 2.2 /Row: Content -->
	
	</div><!-- /Container Padding 20px -->	
</div><!--END MAIN-->

<!--3. FOOTER -->
<?php	
include_once('footer.php');	
?>
<!--3. /FOOTER-->
</body>
</html>
