<?php 
/*
Template Name: Verdict Database Search
*/

Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); 

?>
<div class="page-title">
	<h2>Verdicts Database</h2>
	<div class='page-menu-container'>
		<ul class='page-menu'>
	<?php 
		$pages = get_pages('child_of=12&sort_column=post_title');
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
<div class="page-content content-block">
	<h1>Recent Verdicts</h1>
<?php 
	$memberVar = get_query_var('member_id');
	$member = intval($memberVar);
	$judge = get_query_var('judge');
	$caseType = get_query_var('case_type');
	
	 if ( $memberVar != null  || $judge != null || $caseType != null ){ 

	 	$filterArgs = array( 'post_type' => 'verdict', 'posts_per_page' => 10 );
	 	
	 	$metaArgs = array('relation' => 'AND');
	 	if ( $member != "" && $member != null ) { 
	 		array_push_associative( $filterArgs, array('author' => $member) ); 
	 	}
	 	if ( $judge != "" && $judge != null ) { 
	 		array_push( $metaArgs, array(
	 			'key' => 'the_judge',
	 			'value' => urldecode($judge),
	 			'compare' => '='
	 		)); 
	 	}
	 	if ( $caseType != "" && $caseType != null ) { 
	 		array_push( $metaArgs, array(
	 			'key' => 'case_type', 
	 			'value' => $caseType,
	 			'compare' => '='
	 		)); 
	 	}
	 	$metaQuery = array('meta_query' => $metaArgs);
	 	array_push_associative( $filterArgs , $metaQuery );

	 	query_posts( $filterArgs ); 
	 }
	
	if ( have_posts() ) while ( have_posts() ) : the_post(); 
	$meta = get_post_custom(get_the_ID());
		
	
?>	
	<a class="verdict" href="<? the_permalink(); ?>">
	<h2><?php the_title(); ?></h2>
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