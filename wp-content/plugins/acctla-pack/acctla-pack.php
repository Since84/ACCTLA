<?php
/*
Plugin Name: ACCTLA Pack
Plugin URI: 
Description: Custom Functionality for the ACCTLA website.
Author: Damon Hastings
Version: 1.0
Author URI:
*/



/*------------------------------------------------------------------------------------
  ------------------------------------------------------------------------------------
  Custom Posts Types, Taxonomies, etc..
  ------------------------------------------------------------------------------------
  ------------------------------------------------------------------------------------
  
  POST TYPE FORMAT 
  
  	function custom_post_types() {
	  $labels = array(
	    'name' => '[POST TYPE]s',
	    'singular_name' => '[POST TYPE]',
	    'add_new' => 'Add New',
	    'add_new_item' => 'Add New [POST TYPE]',
	    'edit_item' => 'Edit [POST TYPE]',
	    'new_item' => 'New [POST TYPE]',
	    'all_items' => 'All [POST TYPE]s',
	    'view_item' => 'View [POST TYPE]',
	    'search_items' => 'Search [POST TYPE]s',
	    'not_found' =>  'No [POST TYPE]s found',
	    'not_found_in_trash' => 'No [POST TYPE]s found in Trash', 
	    'parent_item_colon' => '',
	    'menu_name' => '[POST TYPE]s'
	  );
	
	  $args = array(
	    'labels' => $labels,
	    'public' => true,
	    'publicly_queryable' => true,
	    'show_ui' => true, 
	    'show_in_menu' => true, 
	    'query_var' => true,
	    'rewrite' => array( 'slug' => '[POST TYPE]' ),
	    'capability_type' => 'post',
	    'has_archive' => true, 
	    'hierarchical' => false,
	    'menu_position' => null,
	    'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	  ); 
	
	  register_post_type( '[POST TYPE]', $args );
	}
  
  TAXONOMY FORMAT
  
  	register_taxonomy('[TAXONOMY SINGULAR]', 'user', array(
	    'public'      =>true,
	    'labels'      =>array(
	        'name'                        =>'[TAXONOMY PLURAL]',
	        'singular_name'               =>'[TAXONOMY SINGULAR]',
	        'menu_name'                   =>'[TAXONOMY PLURAL]',
	        'search_items'                =>'Search [TAXONOMY PLURAL]',
	        'popular_items'               =>'Popular [TAXONOMY PLURAL]',
	        'all_items'                   =>'All [TAXONOMY PLURAL]',
	        'edit_item'                   =>'Edit [TAXONOMY SINGULAR]',
	        'update_item'             	  =>'Update [TAXONOMY SINGULAR]',
	        'add_new_item'                =>'Add New [TAXONOMY SINGULAR]',
	        'new_item_name'               =>'New [TAXONOMY SINGULAR] Name',
	        'separate_items_with_commas'  =>'Separate [TAXONOMY PLURAL] with commas',
	        'add_or_remove_items'         =>'Add or remove [TAXONOMY PLURAL]',
	        'choose_from_most_used'       =>'Choose from the most popular [TAXONOMY PLURAL]',
	    ),
	    'rewrite'     =>array(
	        'with_front'              =>true,
	        'slug'                        =>'author/expertise',
	    ),
	    'capabilities'    => array(
	        'manage_terms'                =>'edit_users',
	        'edit_terms'              	  =>'edit_users',
	        'delete_terms'                =>'edit_users',
	        'assign_terms'                =>'read',
	    ),
	));
  
  
*/

function create_post_types() {
	$args = array( 
		'public' => true, 'label' => 'Verdicts',
		'supports' => array( 'title', 'editor', 'author', 'custom-fields' ) 
	);
    register_post_type( 'verdict', $args );
    
/*
    $pubArgs = array( 
		'public' => true, 'label' => 'Verdict Newsletter',
		'supports' => array( 'title', 'editor', 'author', 'custom-fields' ) 
	);
    register_post_type( 'verdict-publication', $pubArgs );
*/
}

function register_the_verdict () {
	$verdictargs = array (
		'label' => 'The Verdict Publication',
		'supports' => array( 'title', 'excerpt', 'thumbnail' ),
		'register_meta_box_cb' => 'my_meta_box_cb',
		'show_ui' => true,
		'query_var' => true
	);
	register_post_type( 'theverdict' , $verdictargs );
}
add_action( 'init', 'register_the_verdict' );

function my_meta_box_cb () {
	add_meta_box( 'theverdict' . '_details' , 'Media Library', 'my_meta_box_details', 'theverdict', 'normal', 'high' );
}

function my_meta_box_details () {
	global $post;
$post_ID = $post->ID; // global used by get_upload_iframe_src
	printf( "<iframe frameborder='0' src=' %s ' style='width: 100%%; height: 400px;'> </iframe>", get_upload_iframe_src('media') );
}


function create_taxonomies() {

	register_taxonomy('expertise', 'user', array(
	    'public'      =>true,
	    'hierarchical' =>true,
	    'labels'      =>array(
	        'name'                        =>'Expertises',
	        'singular_name'               =>'Expertise',
	        'menu_name'                   =>'Expertises',
	        'search_items'                =>'Search Expertises',
	        'popular_items'               =>'Popular Expertises',
	        'all_items'                   =>'All Expertises',
	        'edit_item'                   =>'Edit Expertise',
	        'update_item'             =>'Update Expertise',
	        'add_new_item'                =>'Add New Expertise',
	        'new_item_name'               =>'New Expertise Name',
	        'separate_items_with_commas'=>'Separate expertises with commas',
	        'add_or_remove_items'     =>'Add or remove expertises',
	        'choose_from_most_used'       =>'Choose from the most popular expertises',
	    ),
	    'rewrite'     =>array(
	        'with_front'              =>true,
	        'slug'                        =>'author/expertise',
	    ),
	    'capabilities'    => array(
	        'manage_terms'                =>'edit_users',
	        'edit_terms'              =>'edit_users',
	        'delete_terms'                =>'edit_users',
	        'assign_terms'                =>'read',
	    ),
	));
	
	register_taxonomy('member-level', 'user', array(
	    'public'      =>true,
	    'hierarchical' =>true,
	    'labels'      =>array(
	        'name'                        =>'Member Levels',
	        'singular_name'               =>'Member Level',
	        'menu_name'                   =>'Member Levels',
	        'search_items'                =>'Search Member Levels',
	        'popular_items'               =>'Popular Member Levels',
	        'all_items'                   =>'All Member Levels',
	        'edit_item'                   =>'Edit Member Level',
	        'update_item'             =>'Update Member Level',
	        'add_new_item'                =>'Add New Member Level',
	        'new_item_name'               =>'New Member Level Name',
	        'separate_items_with_commas'=>'Separate member- evels with commas',
	        'add_or_remove_items'     =>'Add or remove member levels',
	        'choose_from_most_used'       =>'Choose from the most popular member levels',
	    ),
	    'rewrite'     =>array(
	        'with_front'              =>true,
	        'slug'                        =>'author/member-level',
	    ),
	    'capabilities'    => array(
	        'manage_terms'                =>'edit_users',
	        'edit_terms'              =>'edit_users',
	        'delete_terms'                =>'edit_users',
	        'assign_terms'                =>'read',
	    ),
	));	
	
}

add_action( 'init' , 'create_taxonomies' );
add_action( 'init', 'create_post_types' );



//Send Form Input to Post in Custom Fields

add_action("gform_after_submission", "set_post_content", 10, 2);


function set_post_content($entry, $form){

    //getting post
    $post = get_post($entry["post_id"]);

    //changing post content
    add_post_meta($entry["post_id"],"case_name", $entry[20], true );
    add_post_meta($entry["post_id"],"case_type", $entry[2], true );
    add_post_meta($entry["post_id"],"the_verdict", $entry[1], true );
	add_post_meta($entry["post_id"],"the_venue", $entry[4], true );
	add_post_meta($entry["post_id"],"the_judge", $entry[5], true );
	add_post_meta($entry["post_id"],"the_date", $entry[6], true );
	add_post_meta($entry["post_id"],"plaintiff_attorneys", $entry[10], true );
    add_post_meta($entry["post_id"],"plaintiff_experts", $entry[11], true );
    add_post_meta($entry["post_id"],"defendant_attorneys", $entry[13], true );
    add_post_meta($entry["post_id"],"defendant_experts", $entry[14], true );
    add_post_meta($entry["post_id"],"facts", $entry[16], true );
    add_post_meta($entry["post_id"],"inquiry", $entry[17], true );
    add_post_meta($entry["post_id"],"verdict_info", $entry[18], true ); 
    add_post_meta($entry["post_id"],"comments", $entry[19], true );

    //updating post
    wp_update_post($post);
}






?>