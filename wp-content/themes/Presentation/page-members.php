<?php
/* Template Name:  Member Pages */

Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) );

if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<div class="page-head">
	<h2><?php the_title(); ?></h2>
	<?php wp_nav_menu( array('menu' => 'members' )); ?>
	<img src='<?php bloginfo('template_url')?>/images/sustaining-member-button.png' />
</div>
<div class="section">
	<?php the_post_thumbnail(); ?> 
</div>
<?php endwhile; ?>