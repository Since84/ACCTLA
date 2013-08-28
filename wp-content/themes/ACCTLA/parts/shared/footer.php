	<div class="footer">
		<p>
		Copyright &copy; <?php echo date("Y"); ?> <?php bloginfo( 'name' ); ?>. All rights reserved.
		</p>
<?php 
		 wp_nav_menu(array(
			'theme_location'	=>	'footer',
			'menu_class' 		=> 	'footer-nav',
			'container_class'	=>	'footer-nav-menu'
		 )); 
?>
	</div>
</div>