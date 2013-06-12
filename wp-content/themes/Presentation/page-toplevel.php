<?php
/* Template Name:  Top Level Pages */

Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) );

if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<div class="section">
	<?php the_post_thumbnail(); ?> 
</div>
<?php endwhile; 
	
	Starkers_Utilities::get_template_parts( array( 'parts/shared/html-footer' ) );
?>