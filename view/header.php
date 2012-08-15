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
<div class="header">
	<div class="container"><!-- Container Padding 20px -->
		<!--HEADER ROW -->
		<div class="row">

			<!-- 1.1 Logo -->
			<div class="seven columns">
			    <div class="logo">
			    	<h1><a href="<?php echo APPLICATION_URL?>home.html" title="Inicio Rocket">Rocket</a></h1>
			    </div>
			</div>
			<!-- 1.1 /Logo -->
	
			<!-- 1.2 Main-Nav -->
			<div class="five columns">
			    <div class="row"><!-- row -->
			    	<ul class="user-nav right allheight clearfix"><!-- user nav -->
						<li class="tinyman left">
			    			<img src="<?php echo APPLICATION_URL?><?php echo $avatarImg?>" class="images" alt="30x30" width="30" height="30" />				
						</li>
						<li class="left">
							<h6 class="bluetxt tinyname"><?php echo $user->__get('user_names').' '.ucfirst($user->__get('user_surnames'))?></h6>
						</li>
						<li class="config left">
							<a href="#" class="bluetxt"><span aria-hidden="true" data-icon="&#x7a;"></span></a>
							<div class="cancelar">
								<ul>
									<li><a href="<?php echo APPLICATION_URL?>user.controller/logoutUser.html" class="bluetxt small" aria-hidden="true" data-icon="&#xe05c;"> <strong>Cambiar contraseña</strong> </a></li>
									<li><a href="<?php echo APPLICATION_URL?>user.controller/logoutUser.html" class="bluetxt small" aria-hidden="true" data-icon="q"> <strong>Cambiar foto</strong> </a></li>
									<li><a href="<?php echo APPLICATION_URL?>user.controller/logoutUser.html" class="bluetxt small" aria-hidden="true" data-icon="y"> <strong>Cerrar sesión</strong> </a></li>
								</ul>
							</div>
						</li>
						<li class="logout left">
							<a href="<?php echo APPLICATION_URL?>user.controller/logoutUser.html"  class="close" ><span aria-hidden="true" data-icon="&#x79;"></span> </a>
						</li>
			    	</ul><!-- /user nav -->
			    </div><!-- /row -->
			</div>
			<!-- 1.2 /Main-Nav -->

		</div><!--/HEADER ROW -->
	</div><!-- /Container Padding 20px -->
</div>
<!--1. /HEADER--> 



<div class="menu"><!-- 2 MENU -->
	<div class="container"><!-- Container Padding 20px -->
		<div class="row" > <!-- row -->
			<div class="two columns"> <!-- 2 col -->
				<ul class="nav-bar left"> <!-- nav-var -->
					<li class="no-border">
						<a href="<?php echo APPLICATION_URL?>home.html" class="main" title="home"><span class="nav-icon" aria-hidden="true" data-icon="&#x71;"></span> Inicio</a>
					</li>
				</ul> <!-- /nav-var -->
    	    </div> <!-- /2 col -->
    	    
    	    <div class="ten columns"><!-- 10 col -->
				<ul class="nav-bar right"> <!-- nav-var -->
					<li>
						<a href="<?php echo APPLICATION_URL?>diagnostico-000.html" class="main" title="diagnostico">
							<span class="nav-icon" aria-hidden="true" data-icon="&#x77;"></span> 
							<span class="nav-text">Diagn&oacute;stico <br /><span class="thin x-small uppercase">Analiza tus finanzas</span></span>
						</a>
					</li>
					<li>
						<a href="<?php echo APPLICATION_URL?>metas-000.html" class="main" title="metas">
							<span class="nav-icon" aria-hidden="true" data-icon="&#x65;"></span> 
							<span class="nav-text">Metas <br /><span class="thin x-small uppercase">Evalua tu meta</span></span>
						</a>
					</li>
					
					<li>
						<a href="<?php echo APPLICATION_URL?>descubra-000.html" class="main" title="descubra">
							<span class="nav-icon" aria-hidden="true" data-icon="&#x72;"></span> 
							<span class="nav-text">Descubra <br /><span class="thin x-small uppercase">Identifica tu producto</span></span>
						</a>
					</li>
					<li>
						<a href="<?php echo APPLICATION_URL?>sobres-000.html" class="main" title="sobres">
							<span class="nav-icon" aria-hidden="true" data-icon="&#x74;"></span> 
							<span class="nav-text">Sobres <br /><span class="thin x-small uppercase">Controla tus gastos</span></span>
						</a>
					</li>
				</ul> <!-- /nav-var -->
			</div> <!-- /10 col -->
		</div><!-- /row -->
	</div><!-- /Container Padding 20px -->
</div><!-- 2. /MENU -->
