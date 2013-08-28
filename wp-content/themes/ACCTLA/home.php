<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<div class="home-top">
	<div class="featured-image">
		<img src="<?php bloginfo('template_url')?>/styles/images/home-featured-image.jpg"/>
		<div class="featured-text">
			<h2>Welcome!</h2>
			<span>The Alameda Contra Costa Trial Lawyers Association is widely regarded as one of the most illustrious and influential legal organizations in California</span>
		</div>
	</div>
	<div class="home-adspace"></div>
</div>
<ul class="home-lower">
	<li class="verdict">
		<h1>The Verdict</h1>
<?php
	$args = array( 'post_type' => 'theverdict', 'posts_per_page' => 1 );
	$loop = new WP_Query( $args );
	while ( $loop->have_posts() ) : $loop->the_post();

	$headline = get_post_meta(get_the_ID(), 'case_name');
	
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
	endwhile;	?>		
	</li>
	<li class="member-spotlight">
		<h1>Member Spotlight</h1>
		<?php dynamic_sidebar('Member Spotlight') ?>
	</li>
	<li class="event">
		<h1>Events</h1>
<?php
	$args = array( 'post_type' => 'event', 'posts_per_page' => 1 );
	$loop = new WP_Query( $args );
	while ( $loop->have_posts() ) : $loop->the_post();

	$event_args = array('post_id' => get_the_ID() );
	$event = EM_EVENTS::get( $event_args );
	$event = $event[0];
/* 	var_dump($event); */
	
	$location_args = array('location_id' => $event->location_id );
	$location = EM_LOCATIONS::get($location_args);
	$location = $location[0];
/* 	var_dump($location); */
	
	$event_name = $event->event_name;
	
	$event_start_date = $event->event_start_date;
	$h = strtotime($event_start_date);
	$d = date('l', strtotime( $tempDate));
	$event_start_date = $d." ".date("F dS, Y", $h);
	$event_start = $event->event_start_time;
	$event_start = date('h:i A', strtotime($event_start) );
	
	$event_end = $event->event_end_time;
	$event_end = date('h:i A', strtotime($event_end) );
	$event_location = $location->location_name;
	
	$event_slug = $event->event_slug;
	$register_link = get_bloginfo('url')."/?event=".$event_slug;
	
?>	
		<h2 class="headline"><?php echo $event_name; ?></h2>
		<h3><?php echo $event_start_date; ?></h3>
		<h4><?php echo $event_start." - ".$event_end; ?></h4>
		<h4><?php echo $event_location; ?></h4>
		<a class="register-button" href="<?php echo $register_link; ?>"> Register </a>
<?php endwhile;	?>		
	</li>
</ul>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer', 'parts/shared/html-footer') ); ?>