<?php 
/*
Template Name: The Verdict Publication
*/

Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); 

if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<div class="page-title">
	<h2><?php the_title(); ?></h2>
</div>

<div class="page-content the-verdict content-block">
	<div class="pub-description">
		<? the_content(); ?>
	</div>
<?php endwhile; ?>
<?php 
	$args = array( 'post_type' => 'theverdict', 'posts_per_page' => 10 );
	$loop = new WP_Query( $args );
	while ( $loop->have_posts() ) : $loop->the_post();
	
	$postId = get_the_ID();
	$attachArgs = array(
	   'post_type' => 'attachment',
	   'numberposts' => -1,
	   'post_parent' => $postId
	 );

	 $attachments = get_posts( $attachArgs );
	 if ( $attachments ) {
	    foreach ( $attachments as $attachment ) {
?>	
	<a class='verdict-item' href="<?php echo wp_get_attachment_url($attachment->ID); ?>">
		<h2><?php the_title(); ?></h2>
		<?php the_post_thumbnail('thumb'); ?>
		<div class="entry-content">
			<?php echo wp_get_attachment_image( $attachment->ID ); ?>
		</div>
	</a>
<? 
		}
	}
	endwhile; ?>
</div>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>