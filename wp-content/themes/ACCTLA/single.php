<?php
/**
 * The Template for displaying all single posts
 *
 * Please see /external/starkers-utilities.php for info on Starkers_Utilities::get_template_parts()
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */
?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<div class="page-title">
	<h2> Register </h2>
	<?php 
			wp_nav_menu(array(
				'theme_location'	=> 'list-menu',
				'menu_class' 		=> 	'page-menu',
				'container_class'	=> 'page-menu-container'
			));
	?>

</div>
<article>
	<?php the_content(); ?>			
	<?php if ( get_the_author_meta( 'description' ) ) : ?>
	<?php echo get_avatar( get_the_author_meta( 'user_email' ) ); ?>
	<h3>About <?php echo get_the_author() ; ?></h3>
	<?php the_author_meta( 'description' ); ?>
	<?php endif; ?>

</article>
<?php endwhile; ?>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>