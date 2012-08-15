<?php
if ( (!isset($_SESSION['user_active'])) || ($_SESSION['user_active'] == ''))
	redirectUrl('/home.html'); 
$_SESSION['user_active'] = $_SESSION['user_active'];
$user = new User($_SESSION['user_active']);
$avatarImg = 'resources/Avatar/30x30.jpg';
if(strpos($user->__get('user_image'), 'https:') !== false)
	$avatarImg = $user->__get('user_image');
?>
<!--1. HEADER-->
<div id="header" class="header">
	<div class="container"><!-- Container Padding 20px -->
		<!--HEADER ROW -->
		<div class="row">

				<!-- 1.1 Logo -->
				<div class="seven columns">
					<div class="logo">
						<h1><a href="<?php echo APPLICATION_URL?>home.html" title="Inicio Rocket">La forma divertida de tener el control de tus finanzas</a></h1><!-- <span class="notifications">7</span> -->
					</div>
					<!-- Search
					<input type="text" name="" class="search-input f_right" value="buscar...">
					 Search -->
				</div>
				<!-- 1.1 /Logo -->
	
				<!-- 1.2 Main-Nav -->
				<div class="five columns">
					<div class="row allheight"><!-- row -->
						<div class="ten columns text-right configuracion">
							<h6 class="bluetxt"><?php echo $user->__get('user_names').' '.ucfirst($user->__get('user_surnames'))?></h6>
							<a href="<?php echo APPLICATION_URL?>ingresar.html">CAMBIAR CONTRASE&Ntilde;A | </a><a href="<?php echo APPLICATION_URL?>user.controller/logoutUser.html">CERRAR SESI&Oacute;N</a>
						</div>
						<div class="two columns valign">
							<img src="<?php echo APPLICATION_URL?><?php echo $avatarImg?>" class="images" alt="30x30" width="30" height="30" />
						</div>	
					</div><!-- /row -->
				</div>
				<!-- 1.2 /Main-Nav -->

		</div><!--/HEADER ROW -->
	</div><!-- /Container Padding 20px -->
</div>
<!--1. /HEADER--> 


<!-- 2 MENU -->
<div class="menu"  >
	<div class="row altura51" > <!-- row -->
		<div class="two columns"> <!-- mi perfil -->
			<ul class="nav-bar left"> <!-- nav-var -->
				<li>
					<a href="<?php echo APPLICATION_URL?>home.html" class="main"><span class="nav-icon" aria-hidden="true" data-icon="&#x0022;"></span> Inicio</a>
				</li>
			</ul> <!-- /nav-var -->
        </div> <!--/ mi perfil -->
			<ul class="nav-bar right"> <!-- nav-var -->
				<li>
					<a href="<?php echo APPLICATION_URL?>diagnostico-000.html" class="main"><span class="nav-icon" aria-hidden="true" data-icon="&#x0023;"></span> Diagn&oacute;stico</a>
				</li>
				<li>
					<a href="<?php echo APPLICATION_URL?>metas-000.html" class="main activo"><span class="nav-icon" aria-hidden="true" data-icon="&#x0025;"></span> Metas</a>	
				</li>
				<li>
					<a href="<?php echo APPLICATION_URL?>descubra-000.html" class="main"><span class="nav-icon" aria-hidden="true" data-icon="&#x0024;"></span> Descubra</a>			
				</li>
				
<!--
<li>
					<a href="<?php echo APPLICATION_URL?>sobres-000.html" class="main"><span class="menu-sobres"></span>Sobres</a>
				</li>
-->
			</ul> <!-- /nav-var -->
	</div><!-- /row -->
	</div>
</div>

<!--

<div class="menu-2">
	<div class="row" > 
	<ul class="steps">
		<li> Selección  <span aria-hidden="true" class="icon-arrow-4"></span></li>
		<li> Costo  <span aria-hidden="true" class="icon-arrow-4"></span></li>
		<li class="active"> Cuota  <span aria-hidden="true" class="icon-arrow-4"></span></li>
		<li> Manejo  <span aria-hidden="true" class="icon-arrow-4"></span></li>
		<li> Resultado	  <span aria-hidden="true" class="icon-arrow-4"></span></li>
	
	</ul>
	</div>
</div>
-->

<!-- END. 2 MENU -->
