<?php
/*
	Template Name: Members
*/

Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) );


function contributors() {
	global $wpdb;
	
	$memberSearch = get_query_var('s_member');
	$query = "(SELECT ID, user_nicename from $wpdb->users)";

    $total_query = "SELECT COUNT(1) FROM (${query}) AS combined_table";
    $total = $wpdb->get_var( $total_query );
    $items_per_page = isset( $_GET['perpage'] ) ? abs( (int) $_GET['perpage'] ) : 10;
    $page = isset( $_GET['cpage'] ) ? abs( (int) $_GET['cpage'] ) : 1;
    $offset = ( $page * $items_per_page ) - $items_per_page;
    $authors = $wpdb->get_results( $query . "ORDER BY display_name LIMIT ${offset}, ${items_per_page}" );
 
/* $authors = $wpdb->get_results("SELECT ID, user_nicename from $wpdb->users ORDER BY display_name"); */
	foreach($authors as $author) {
		$authorId = $author->ID;
		
/*
		$authorMembershipMeta = $wpdb->get_results(
			"SELECT wp_pmpro_memberships_users.membership_id, wp_pmpro_membership_levels.name
			FROM $wpdb->users
				JOIN wp_pmpro_memberships_users
					ON $wpdb->users.ID = wp_pmpro_memberships_users.user_id
				JOIN wp_pmpro_membership_levels
					ON wp_pmpro_memberships_levels.id = wp_pmpro_memberships_users.membership_id
			ORDER BY $wpdb->users.ID
			WHERE $wpdb->users.ID = $authorId"
		);
*/
		
/*
		$authorMemberId = $wpdb->get_results("SELECT membership_id FROM wp_pmpro_memberships_users WHERE user_id = $authorId LIMIT 1");
		
		$authorMemberMeta = $wpdb->get_results("SELECT membership_id FROM wp_pmpro_memberships_users WHERE user_id = $authorId LIMIT 1");
*/
/* 		var_dump($authorMembershipMeta); */


		$memberLevel = pmpro_getMembershipLevelForUser($authorId);
		$memberLevel = seoURL($memberLevel->name);
		
		$authorInfo['name'] = get_the_author_meta('first_name', $authorId).' '.get_the_author_meta('last_name', $authorId);
		$authorInfo['company'] = get_the_author_meta('company', $authorId);
		$authorInfo['email'] = get_the_author_meta('email', $authorId);
		$authorInfo['address1'] = get_the_author_meta('address_1', $authorId);
		$authorInfo['city'] = get_the_author_meta('city', $authorId);
		$authorInfo['state'] = get_the_author_meta('state', $authorId);
		$authorInfo['zip'] = get_the_author_meta('zip', $authorId);
		$authorInfo['phone'] = get_the_author_meta('phone', $authorId);
		$authorInfo['fax'] = get_the_author_meta('fax', $authorId);
		$authorInfo['facebook'] = get_the_author_meta('facebook', $authorId);
		$authorInfo['linkedin'] = get_the_author_meta('linkedin', $authorId);
		$authorInfo['cv'] = get_the_author_meta('cv', $authorId);
		
		
		$authorElem  = '<li class="member '.$memberLevel.'">';
		$authorElem	.= '<div class="sustaining-member-badge">Sustaining Member</div>';
		$authorElem .= 		get_avatar($authorId);
		$authorElem .= '	<div class="member-info">';
		$authorElem .= '		<div class="member-name">';
		$authorElem .= '			<span class="name"><span>'. $authorInfo['name'].'</span>';
		if($authorInfo['facebook'] != "") { $authorElem .= '<a class="facebook" href="http://www.facebook.com/'.$authorInfo['facebook'].'"><span class="icon"></span></a>'; }
		if($authorInfo['linkedin'] != "") { $authorElem .= '<a class="linkedin" href="http://www.linkedin.com/in/'.$authorInfo['facebook'].'"><span class="icon"></span></a>'; }
		if($authorInfo['cv'] != "") { $authorElem .= '<a class="cv" href="'.$authorInfo["cv"].'"><span class="icon"></span></a>'; }
		$authorElem .= '			</span>';
		$authorElem .= '			<span class="company">'. $authorInfo['company'] .'</span>';
		$authorElem .= '			<span class="email">'. $authorInfo['email'] .'</span>';
		$authorElem .= '		</div>';
		$authorElem .= '		<div class="member-address">';
		$authorElem .= '			<span class="address1">'. $authorInfo['address1'] .'</span>';
		$authorElem .= '			<span class="address_location">'.$authorInfo['city'].', '.$authorInfo['state'].' '.$authorInfo['zip'].'</span>';
		$authorElem .= '			<span class="phone_fax"><span class="phone">T: '.$authorInfo['phone'].'</span><span class="fax">F: '.$authorInfo['fax'].'</span></span>';
		$authorElem .= '		</div>';
		$authorElem .= '    </div>';
		$authorElem .= '</li>';
		
		echo $authorElem;
		
	}	
}

function memberPaging() {
		$perPage = $_GET['perpage'];
		$perPageClass = "show-".$perPage;
	
?>

		<div class="member-paging <?php echo $perPageClass; ?>">
			<a class="page-numbers show-20" href="<?php echo add_query_arg('perpage','20'); wp_reset_query(); ?>">show 20</a>
			<a class="page-numbers show-40" href="<?php echo add_query_arg('perpage','40'); wp_reset_query(); ?>">show 40</a>
			<a class="page-numbers show-all" href="<?php echo add_query_arg('perpage','18446744073709551615'); wp_reset_query(); ?>">show All</a>
			
<?php
			global $wpdb;
			$query = "(SELECT ID, user_nicename from $wpdb->users)";
		
		    $total_query = "SELECT COUNT(1) FROM (${query}) AS combined_table";
		    $total = $wpdb->get_var( $total_query );
		    $items_per_page = isset( $_GET['perpage'] ) ? abs( (int) $_GET['perpage'] ) : 10;
		    $page = isset( $_GET['cpage'] ) ? abs( (int) $_GET['cpage'] ) : 1;
		    echo paginate_links( array(
		        'base' => add_query_arg( 'cpage', '%#%' ),
		        'format' => '',
		        'prev_text' => __('&laquo;'),
		        'next_text' => __('&raquo;'),
		        'total' => ceil($total / $items_per_page),
		        'current' => $page
			));
			
	    	$judgeQuery = "(SELECT meta_value FROM wp_postmeta WHERE `meta_key` = 'the_judge' LIMIT 1000000)";
			$judges = $wpdb->get_results($judgeQuery);
?>
			
		</div>
		
<?php
	}
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<div class="page-title">
	<h2>
		<span>Members</span>
		<div class="search-verdict">
<?		Starkers_Utilities::get_template_parts( array( 'parts/shared/member-filters' ) ); ?>

	</h2>
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
?>
			<li class='menu-item sustaining'><a href='/sign-up/?level=1'>Become a Sustaining Member</a></li>
		</ul>
	</div>
</div>
<div class="page-content content-block">
<?php memberPaging(); ?>
<ul class="member-list">
<?php contributors(); ?>
</ul>
<?php memberPaging(); ?>
<?php endwhile; ?>
</div>
<div class="sidebar content-block" >
</div>
</div>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>