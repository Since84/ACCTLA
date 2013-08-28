<?php
/*
	Template Name: No Sidebars
*/

Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<div class="page-title">
	<h2><?php the_title(); ?></h2>
	<?php 
		$pageType = get_post_meta( get_the_ID(), 'page-type', true );
		$pageType = $pageType;
		if ( $pageType == 'Event List' ){
			wp_nav_menu(array(
				'theme_location'	=> 'list-menu',
				'menu_class' 		=> 	'page-menu',
				'container_class'	=> 'page-menu-container'
			));
/*
		} else {
			wp_nav_menu(array(
				'theme_location'	=>	'page-menu',
				'menu_class' 		=> 	'page-menu',
				'container_class'	=>	'page-menu-container',
			));
*/
		} 
	?>
</div>
<div class="page-content content-block">
<?php the_content(); ?>
<?php endwhile; ?>
</div>
<div class="sidebar content-block" >
</div>
</div>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>