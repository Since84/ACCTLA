<div class="wrapper">
	<div class="header section">
		<div class="main-menu">
			<div class="title">
				<a href="<?php echo home_url(); ?>"><img src="<?php echo bloginfo('template_url'); ?>/styles/images/logo.png"/></a>
				<span class="description"><?php bloginfo('name'); ?></span>
			</div>	
			<nav class="primary-nav">
		<?php 		  
				wp_nav_menu( array(
					'theme_location'	=>	'primary',
					'menu_class'		=>	'primary-nav',
					'container_class'	=>	'primary-nav-menu' 
				)); 
		?>
				
			</nav>
		</div>
		<div class="sign-up">
			<h1 class="join">Join Us!</h1>
			<h2 class="join-sub">Become a member today.</h2>
			<!-- sign up form-->
<?php
			 wp_nav_menu(array(
				'theme_location'	=>	'sign-up',
				'menu_class' 		=> 	'sign-up-button'
			 )); 
?>
		</div>
		<div class="header-sub-section">
<?php 
			 wp_nav_menu(array(
				'theme_location'	=>	'header-sub',
				'menu_class' 		=> 	'menu-header-sub',
				'container_class'	=>	'header-sub-menu',
			 )); 
?>
		<div class="login">
			<a class="login-form">Member Login</a>
		<form name="loginform" id="loginform" action="<?php echo get_option('siteurl'); ?>/wp-login.php" method="post">
		
		        <input value="Username" class="input" type="text" size="20" tabindex="10" name="log" id="user_login" onfocus="if (this.value == 'Username') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Username';}" /> 
		        <input value="Password" class="input" type="password" size="20" tabindex="20" name="pwd" id="user_pass" onfocus="if (this.value == 'Password') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Password';}" />
		        <a href="<?php echo wp_lostpassword_url(); ?>" title="Lost Password">I forgot my login info</a>
		        <input name="wp-submit" id="wp-submit" value="Login" tabindex="100" type="submit">
<!-- 		        <input name="redirect_to" value="<?php echo get_option('siteurl'); ?>/" type="hidden"> -->
		        <input name="testcookie" value="1" type="hidden">
		
		</form>
		</div>
		</div>
	</div>
