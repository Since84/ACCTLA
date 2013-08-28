<?php
/*
	Sidebar for Verdict Database
*/
?>

<div class="submit-verdict">
	<h3>Got News?</h3>
	<p>If you have a verdict that you'd like to share, please submit it online.</p>
	<a class="submit" href='/submit-a-verdict'>Submit a Verdict</a>
</div>

<div class="search-verdict">
	<h3>Search Verdicts</h3>
    <form role="search" action="<?php echo site_url('/'); ?>" method="get" id="searchform">
	    <input type="hidden" name="post_type" value="verdict" />
	    <input type="text" name="s" placeholder="Search Verdicts"/>
	    <input type="submit" alt="Search" value="" />
	</form>
</div>

<div class="filter-verdict">
	<h3>Filter Verdicts</h3>
		<?php
	    	global $wpdb;
	    	$caseQuery = "(SELECT meta_value FROM wp_postmeta WHERE `meta_key` = 'case_type' LIMIT 1000000)";
			$caseTypes = $wpdb->get_results($caseQuery);
			
	    	$judgeQuery = "(SELECT meta_value FROM wp_postmeta WHERE `meta_key` = 'the_judge' LIMIT 1000000)";
			$judges = $wpdb->get_results($judgeQuery);
			
	    	$memberQuery = "(SELECT ID, display_name from $wpdb->users LIMIT 1000000)";
			$members = $wpdb->get_results($memberQuery);
			
/* 				var_dump($members); */
			
	    ?>
	<form role="search" method="get" action="<?php echo site_url('/'); ?>" id="searchform">
	    <select name="case_type"> 
	        <option value="" selected="selected">Case Type</option>
	<?php 
		foreach($caseTypes as $type){ 
	?>
			<option value="<?php echo $type->meta_value; ?>"><?php echo $type->meta_value; ?></option>           
	<?php			
		}
	?>
	    </select>
	    <select name="judge"> 
	        <option value="" selected="selected">Judge</option>  
	<?php 
		foreach($judges as $judge){ 
			$judge = $judge->meta_value;
	?>
			<option value="<?php echo $judge; ?>"><?php echo $judge; ?></option>           
	<?php			
		}
	?>
	    </select>
	    <select name="member_id"> 
	        <option value=null selected="selected">Member</option>
	<?php 
		foreach($members as $member){ 
	?> 
			<option value="<?php echo $member->ID; ?>"><?php echo $member->display_name; ?></option>           
	<?php			
		}
	?>
	    </select>		    
	    <input type="hidden" name="post_type" value="verdict" />
	    <input type="submit" name="submit" />
	</form>
</div>