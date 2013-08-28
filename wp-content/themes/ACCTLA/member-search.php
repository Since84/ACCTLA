<?php 
/*
Template Name: Member Search
*/

Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); 

	function memberSearch()
	{
		global $wpdb;
		$memberSearch = get_query_var('m_name');
		$locationFilter = urldecode(get_query_var('member_location'));
		$practiceFilter = get_query_var('area_of_practice');
		$levelFilter = get_query_var('membership_level');
		
		if( $memberSearch != "" ){
		
			$query = 	"SELECT ID FROM $wpdb->users 
						LEFT OUTER JOIN wp_usermeta
						ON wp_users.ID = wp_usermeta.user_id
						WHERE meta_key = 'nickname'
						AND meta_value LIKE '%$memberSearch%'";	
								
		} else if( $locationFilter != "" ){
		
			$query = 	"SELECT ID FROM $wpdb->users 
						LEFT OUTER JOIN wp_usermeta
						ON wp_users.ID = wp_usermeta.user_id
						WHERE meta_key = 'city'
						AND meta_value LIKE '%$locationFilter%'";
										
		} else if( $levelFilter != "" ){
		
			$query = 	"SELECT $wpdb->users.ID FROM $wpdb->users 
						LEFT OUTER JOIN $wpdb->pmpro_memberships_users
						ON wp_users.ID = wp_pmpro_memberships_users.user_id
						WHERE membership_id = $levelFilter";
						
		}

/* 		var_dump($wpdb->get_results($query)); */
						
	    $total_query = "SELECT COUNT(1) FROM (${query}) AS combined_table";
	    $total = $wpdb->get_var( $total_query );
	    $items_per_page = isset( $_GET['perpage'] ) ? abs( (int) $_GET['perpage'] ) : 10;
	    $page = isset( $_GET['cpage'] ) ? abs( (int) $_GET['cpage'] ) : 1;
	    $offset = ( $page * $items_per_page ) - $items_per_page;
		
		$query .= " ORDER BY display_name LIMIT $offset, $items_per_page";				
		$members = $wpdb->get_results($query);
		
		foreach ($members as $member) { 	
			$authorId = $member->ID;
			
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
	
	function memberPaging() 
	{
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
<div class="page-title">
	<h2>
		<span>Members</span>
<?		Starkers_Utilities::get_template_parts( array( 'parts/shared/member-filters' ) ); ?>
	</h2>
	<div class='page-menu-container'>
		<ul class='page-menu'>
<?php 
		$parentPage = get_page_by_title( 'Members' );
		$pages = get_pages('child_of='.$parentPage->ID.'&sort_column=post_title');
		$count = 0;
		foreach($pages as $page)
		{ ?>
			<li class='menu-item'>
				<h4><a href="<?php echo get_page_link($page->ID) ?>"><?php echo $page->post_title ?></a></h4>
			</li>
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
		<?php memberSearch(); ?>
	</ul>
		<?php memberPaging(); ?>
	</div>
	<div class="sidebar content-block" >
	</div>
</div>


<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>