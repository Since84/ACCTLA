<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); 
	$meta = get_post_custom(get_the_ID());
?>
<div class="page-title">
	<h2>Verdicts Database</h2>
	<?php 
			 wp_nav_menu(array(
				'theme_location'	=>	'page-menu',
				'menu_class' 		=> 	'page-menu',
				'container_class'	=>	'page-menu-container',
			 )); 
	?>
</div>
<div class="page-content content-block single-verdict">
	<h1><?php the_title(); ?></h1>
	<div>
		<ul class="verdict-field">
			<li class="field-label">Verdict</li>
			<li><?php echo $meta['the_verdict'][0]; ?></li>
		</ul>
		<ul class="verdict-field">
			<li class="field-label">Case Type</li>
			<li><?php echo $meta['case_type'][0]; ?></li>
		</ul>
		<ul class="verdict-field">
			<li class="field-label">Case Name</li>
			<li><?php echo $meta['the_venue'][0]; ?></li>
		</ul>
		<ul class="verdict-field">
			<li class="field-label">Judge</li>
			<li><?php echo $meta['the_judge'][0]; ?></li>
		</ul>
		<ul class="verdict-field">
			<li class="field-label">Date</li>
			<li><?php echo $meta['the_date'][0]; ?></li>
		</ul>
	</div>
	<div>
		<h1>Plaintiff(s)</h1>
		<ul class="verdict-field">
			<li class="field-label">Attorney(s)</li>
			<li><?php echo $meta['plaintiff_attorneys'][0]; ?></li>
		</ul>
		<ul class="verdict-field">
			<li class="field-label">Experts</li>
			<li><?php echo $meta['plaintiff_experts'][0]; ?></li>
		</ul>
		<h1>Defendant(s)</h1>
		<ul class="verdict-field">
			<li class="field-label">Attorney(s)</li>
			<li><?php echo $meta['defendant_attorneys'][0]; ?></li>
		</ul>
		<ul class="verdict-field">
			<li class="field-label">Experts</li>
			<li><?php echo $meta['defendant_experts'][0]; ?></li>
		</ul>
		<ul class="verdict-field">
			<li class="field-label">Insurers</li>
			<li></li>
		</ul>
	</div>
	<div>
		<ul class="verdict-field">
			<h1>Facts:</h1>
			<li><?php echo $meta['facts'][0]; ?></li>
		</ul>
		<ul class="verdict-field">
			<h1>Inquiry:</h1>
			<li><?php echo $meta['inquiry'][0]; ?></li>
		</ul>
		<ul class="verdict-field">
			<h1>Verdict Information:</h1>
			<li><?php echo $meta['verdict_info'][0]; ?></li>
		</ul>
		<ul class="verdict-field">
			<h1>Post Trial:</h1>
			<li><?php echo $meta['inquiry'][0]; ?></li>
		</ul>		
	</div>
	<div>
		<ul class="verdict-field">
			<h1>Editor's Comments</h1>
			<li><?php echo $meta['comments'][0]; ?></li>
		</ul>
	</div>

<?php endwhile; ?>
</div>
<div class="sidebar content-block" >
	<? Starkers_Utilities::get_template_parts( array( 'parts/shared/verdict-sidebar')); ?>
</div>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>