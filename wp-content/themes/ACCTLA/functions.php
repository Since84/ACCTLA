<?php
	/**
	 * Starkers functions and definitions
	 *
	 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
	 *
 	 * @package 	WordPress
 	 * @subpackage 	Starkers
 	 * @since 		Starkers 4.0
	 */

	/* ========================================================================================================================
	
	Required external files
	
	======================================================================================================================== */

	require_once( 'external/starkers-utilities.php' );
	require_once( 'member-spotlight.php' );

	/* ========================================================================================================================
	
	Theme specific settings

	Uncomment register_nav_menus to enable a single menu with the title of "Primary Navigation" in your theme
	
	======================================================================================================================== */

	add_theme_support('post-thumbnails');
	add_theme_support( 'menus' );
	
	register_nav_menus(array('primary' 		=> 	'Primary Navigation',
							 'sign-up' 		=>  'Sign Up',
							 'header-sub' 	=> 	'Header Sub Menu',
							 'members' 		=> 	'Membership',
							 'about' 		=> 	'About Us',
							 'page-menu'	=>	'Page Menu',
							 'list-menu'	=>	'List Menu',
							 'footer' 		=> 	'Footer' )
					  );
	register_sidebar(array(
							  'name' => __( 'Content Page' ),
							  'id' => 'content-page',
							  'description' => __( 'Widgets in this area will be shown on the right-hand side.' ),
							  'before_title' => '<h1>',
							  'after_title' => '</h1>'
	  ));

	register_sidebar(array(
							  'name' => __( 'Verdict Database' ),
							  'id' => 'verdict-database',
							  'description' => __( 'Widgets for the Verdict Database' ),
							  'before_title' => '<h1>',
							  'after_title' => '</h1>'
	  ));
	  
	register_sidebar(array(
		'name'          => __( 'Member Spotlight' ),
		'id'            => 'member-spotlight',
		'description'   => 'Member Spotlight Section on the Homepage'
	));
	  

	/* ========================================================================================================================
	
	Actions and Filters
	
	======================================================================================================================== */

	add_action( 'wp_enqueue_scripts', 'starkers_script_enqueuer' );

	add_filter( 'body_class', array( 'Starkers_Utilities', 'add_slug_to_body_class' ) );

	/* ========================================================================================================================
	
	Custom Post Types - include custom post types and taxonimies here e.g.

	e.g. require_once( 'custom-post-types/your-custom-post-type.php' );
	
	======================================================================================================================== */


	/* ========================================================================================================================
	
	Scripts
	
	======================================================================================================================== */

	/**
	 * Add scripts via wp_head()
	 *
	 * @return void
	 * @author Keir Whitaker
	 */

	function starkers_script_enqueuer() {
		wp_register_script( 'site', get_template_directory_uri().'/js/site.js', array( 'jquery' ) );
		wp_enqueue_script( 'site' );
		
		wp_register_style( 'screen', get_stylesheet_directory_uri().'/style.css', '', '', 'screen' );
		wp_register_style( 'archivo', 'http://fonts.googleapis.com/css?family=Archivo+Narrow', '', '', 'screen' );
		wp_register_style( 'ubuntu', 'http://fonts.googleapis.com/css?family=Ubuntu:400,700,400italic,700italic', '', '', 'screen' );
		wp_register_style( 'satisfy', 'http://fonts.googleapis.com/css?family=Satisfy', '', '', 'screen' );
		wp_register_style( 'styles', get_stylesheet_directory_uri().'/styles/stylesheets/screen.css', '', '', 'screen' );
		
		wp_enqueue_style( 'screen' );
		wp_enqueue_style( 'archivo' );
		wp_enqueue_style( 'ubuntu' );
		wp_enqueue_style( 'satisfy' );
		wp_enqueue_style( 'styles' );
	}	

	/* ========================================================================================================================
	
	Comments
	
	======================================================================================================================== */

	/**
	 * Custom callback for outputting comments 
	 *
	 * @return void
	 * @author Keir Whitaker
	 */
	function starkers_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment; 
		?>
		<?php if ( $comment->comment_approved == '1' ): ?>	
		<li>
			<article id="comment-<?php comment_ID() ?>">
				<?php echo get_avatar( $comment ); ?>
				<h4><?php comment_author_link() ?></h4>
				<time><a href="#comment-<?php comment_ID() ?>" pubdate><?php comment_date() ?> at <?php comment_time() ?></a></time>
				<?php comment_text() ?>
			</article>
		<?php endif;
	}
	
	
	
	
	
add_action( 'show_user_profile', 'my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'my_show_extra_profile_fields' );

function my_show_extra_profile_fields( $user ) { ?>

	<h3>Extra profile information</h3>

	<table class="form-table">

		<tr>
			<th><label for="company">Company</label></th>

			<td>
				<input type="text" name="company" id="company" value="<?php echo esc_attr( get_the_author_meta( 'company', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your Company name. </span>
			</td>
		</tr>
		<tr>
			<th><label for="facebook">Facebook</label></th>

			<td>
				<input type="text" name="facebook" id="facebook" value="<?php echo esc_attr( get_the_author_meta( 'facebook', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your Facebook URL. (twitter.com/<strong>URL</strong>)</span>
			</td>
		</tr>
		<tr>
			<th><label for="twitter">Twitter</label></th>

			<td>
				<input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your Twitter handle. (twitter.com/<strong>handle</strong>)</span>
			</td>
		</tr>
		<tr>
			<th><label for="linkedin">Linkedin</label></th>

			<td>
				<input type="text" name="linkedin" id="linkedin" value="<?php echo esc_attr( get_the_author_meta( 'linkedin', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your Linkedin url. (linkedin.com/in/<strong>URL</strong>)</span>
			</td>
		</tr>
		<tr>
			<th><label for="cv">CV</label></th>

			<td>
				<input type="text" name="cv" id="cv" value="<?php echo esc_attr( get_the_author_meta( 'cv', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter a link to your CV.</span>
			</td>
		</tr>

	</table>
<?php }

add_action( 'personal_options_update', 'my_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'my_save_extra_profile_fields' );

function my_save_extra_profile_fields( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;

	/* Copy and paste this line for additional fields. Make sure to change 'twitter' to the field ID. */
	update_usermeta( $user_id, 'facebook', $_POST['facebook'] );
	update_usermeta( $user_id, 'company', $_POST['company'] );
	update_usermeta( $user_id, 'linkedin', $_POST['linkedin'] );
	update_usermeta( $user_id, 'twitter', $_POST['twitter'] );
	update_usermeta( $user_id, 'cv', $_POST['cv'] );
}


/** Random Functions ***********************/

function seoUrl($string) {
    //lower case everything
    $string = strtolower($string);
    //make alphaunermic
    $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
    //Clean multiple dashes or whitespaces
    $string = preg_replace("/[\s-]+/", " ", $string);
    //Convert whitespaces and underscore to dash
    $string = preg_replace("/[\s_]/", "-", $string);
    return $string;
}

/** Custom Search Template ***********************/
//add author_more to query vars
function array_push_associative(&$arr) {
   $args = func_get_args();
   foreach ($args as $arg) {
       if (is_array($arg)) {
           foreach ($arg as $key => $value) {
               $arr[$key] = $value;
               $ret++;
           }
       }else{
           $arr[$arg] = "";
       }
   }
   return $ret;
}


function add_query_vars() {
    global $wp;
    $wp->add_query_var('member_id');
    $wp->add_query_var('judge');
    $wp->add_query_var('case_type');
    $wp->add_query_var('s_member');
    $wp->add_query_var('m_name');
    $wp->add_query_var('ms');
    $wp->add_query_var('member_location');
    $wp->add_query_var('area_of_practice');
    $wp->add_query_var('name');
    $wp->add_query_var('membership_level');
}

add_filter('init', 'add_query_vars');


 function template_chooser($template)   
{    
  global $wp_query;   
  $ms = get_query_var('ms');
  $member = get_query_var('member_id');
  $judge = get_query_var('judge');
  $caseType = get_query_var('case_type');

  if( $post_type == 'verdict' && ( $wp_query->is_search || $member != "" || $judge != "" || $caseType != "" )   )
  {
    return locate_template('verdict-database-search.php'); 
  }  
  return $template;   
}
add_filter('template_include', 'template_chooser'); 