<?php
	function getCities()
	{
		global $wpdb; 
		
		$cities = $wpdb->get_results("SELECT DISTINCT meta_value FROM wp_usermeta WHERE meta_key = 'city' ORDER BY meta_value");

?>  
			<option></option> 
<?		
		foreach( $cities as $city ) {
?>
			<option value="<?php echo $city->meta_value; ?>"><?php echo $city->meta_value; ?></option>
<?php	
		} 
	}
	
		function getLevels()
	{
		global $wpdb; 
		
		$levels = $wpdb->get_results("SELECT DISTINCT id, name FROM wp_pmpro_membership_levels ORDER BY id");
?>  
			<option></option> 
<?
		foreach( $levels as $level ) {
?>
			<option value="<?php echo $level->id; ?>"><?php echo $level->name; ?></option>
<?php	
		} 
	}
?>

<div class="search-filter">
		
		<select name="filter_type">
			<option value="name">Name</option>
<!-- 				<option value="area_of_practice">Area of Practice</option> -->
			<option value="member_location">Location(City)</option>
			<option value="membership_level">Membership Level</option>
		</select>	
	    
	    <form name="name" role="search" action="<?php echo site_url('member-search'); ?>/" method="get" id="searchform" class="on">
		    <input type="text" name="m_name" placeholder="Search By Name"/>
		    <input type="submit" alt="Search" value="" />
		</form>
		
		<form name="filters" role="search" method="get" action="<?php echo site_url('member-search'); ?>/" id="searchform">
			<select name="member_location">
				<? getCities(); ?>
			</select>

		</form>
		
		<form name="filters" role="search" method="get" action="<?php echo site_url('member-search'); ?>/" id="searchform">
			<select name="membership_level">
				<? getLevels(); ?>
			</select>
		</form>
	</div>
