<?php 
/*
Template Name: Verdict Database
*/

Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); 

if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<div class="page-title">
	<h2><?php the_title(); ?></h2>
	<div class='page-menu-container'>
		<ul class='page-menu'>
	<?php 
/*
			 wp_nav_menu(array(
				'theme_location'	=>	'page-menu',
				'menu_class' 		=> 	'page-menu',
				'container_class'	=>	'page-menu-container',
			 )); 
*/
		$pages = get_pages('child_of='.$post->post_parent.'&sort_column=post_title');
		$count = 0;
		foreach($pages as $page)
		{ ?>
			<li class='menu-item'>
				<h4>
					<a href="<?php echo get_page_link($page->ID) ?>"><?php echo $page->post_title ?></a>
				</h4>
			</li>
		<?php
		}
	?>
			<li class='menu-item sustaining'><a href='<?php echo site_url(); ?>/sign-up/?level=1'>Become a Sustaining Member</a></li>
		</ul>
	</div>
</div>
<?php endwhile; ?>
<div class="page-content content-block">
	<h1>Recent Verdicts</h1>
<?php 
	$args = array( 'post_type' => 'verdict', 'posts_per_page' => 10 );
	$loop = new WP_Query( $args );
	while ( $loop->have_posts() ) : $loop->the_post();
	$meta = get_post_custom(get_the_ID());
	
?>	
	<a class="verdict" href="<? the_permalink() ?>">
	<h2><? the_title(); ?></h2>
		<div class="entry-content">
			<p>
			<?php echo $meta['comments'][0]; ?>
			</p>
		</div>
	</a>
<? endwhile; wp_reset_query(); ?>
</div>
<div class="sidebar content-block" >
 <? Starkers_Utilities::get_template_parts( array( 'parts/shared/verdict-sidebar')); ?>
</div>
</div>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>