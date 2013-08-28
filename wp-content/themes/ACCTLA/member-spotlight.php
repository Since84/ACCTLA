<?php

class AcctlaMemberSpotlight extends WP_Widget {

	// constructor
	function AcctlaMemberSpotlight() {
		parent::WP_Widget(false, $name = __('Member Spotlight', 'member_spotlight'));
	}

	// widget form creation
	function form($instance) {	
		global $wpdb; 
		
		$authors = $wpdb->get_results("SELECT ID, display_name from $wpdb->users ORDER BY display_name");

		if($instance) {
		     $member = $instance['member'];
		} else {
			$member = '';
	 	}
		
?>
		<select id="<?php echo $this->get_field_id( 'member' ); ?>" name="<?php echo $this->get_field_name( 'member' ); ?>" > 
<?php
		foreach($authors as $author) {
?>	
			<option value="<?php echo $author->ID; ?>" <?php if ( $author->ID == $member ) echo 'selected="selected"'; ?>>
				<?php echo $author->display_name; ?>
			</option>
<?php
		}			
?>
		</select>

<?php
	
	}

	// widget update
	function update($new_instance, $old_instance) {
      $instance = $old_instance;
      // Fields
      $instance['member'] = $new_instance['member'];
	  return $instance;
	}

	// widget display
	function widget($args, $instance) {
		extract($args);
		$memberId = $instance['member'];
		
		$memberLevel = pmpro_getMembershipLevelForUser($memberId);
		
		$authorInfo['name'] 		= get_the_author_meta('first_name', $memberId).' '.get_the_author_meta('last_name', $memberId);
		$authorInfo['description'] 	= get_the_author_meta('description', $memberId);		
		$authorInfo['facebook'] 	= get_the_author_meta('facebook', $memberId);
		$authorInfo['linkedin'] 	= get_the_author_meta('linkedin', $memberId);
		$authorInfo['cv'] 			= get_the_author_meta('cv', $memberId);
		
?>
	<div class="member">
		<div class="member-photo">
			<?php echo get_avatar($memberId); ?>
		</div>
		<div class="member-info">
			<h2>
				<span class="member-name"><?php echo $authorInfo['name']; ?></span>
				<span class="member-level"><?php if($memberLevel){ echo $memberLevel->name; } ?></span>
			</h2>
			<div class="member-description"><?php echo $authorInfo['description'];  ?></div>
			<ul class="member-links">
				<?php if( $authorInfo['facebook'] ){ ?>
					<li class="facebook" >
						<a href='http://www.facebook.com/<?php echo $authorInfo['facebook']; ?>'><span class="icon"></span></a>
					</li>
				<?php } if( $authorInfo['linkedin'] ){ ?>
					<li class="linkedin" >
						<a href='http://www.linkedin.com/in/<?php echo $authorInfo['linkedin']; ?>'><span class="icon"></span></a>
					</li>
				<?php } if( $authorInfo['cv'] ){ ?>
					<li class="cv" >
						<a href='<?php echo $authorInfo['cv']; ?>'><span class="icon"></span></a>
					</li>
				<?php } ?>
					<li class="sustaining">
						<a href='/sign-up/?level=1'>Become a Sustaining Member</a>
					</li>
			</ul>
		</div>
	</div>
<?php
	}
}

function add_acctla_member_spotlight(){
	register_widget("AcctlaMemberSpotlight");
}

// register widget
add_action('widgets_init', 'add_acctla_member_spotlight');