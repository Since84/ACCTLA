<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
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
	<h2><?php the_title(); ?></h2>
	<div class='page-menu-container'>
		<ul class='page-menu'>
	<?php 
		$pages = get_pages('child_of='.$post->post_parent.'&sort_column=post_title');
		$count = 0;
		foreach($pages as $page)
		{ ?>
			<li class='menu-item'><h4><a href="<?php echo get_page_link($page->ID) ?>"><?php echo $page->post_title ?></a></h4></li>
	<?php
		}
		wp_reset_query();
	?>
			<li class='menu-item sustaining'><a href='<?php echo site_url(); ?>/sign-up/?level=1'>Become a Sustaining Member</a></li>
		</ul>
	</div>
</div>
<div class="page-content content-block">
	<?php the_content(); ?>
<?php endwhile; ?>
</div>
<div class="sidebar content-block" >
	<?php dynamic_sidebar("Content Page"); ?>
</div>
</div>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>