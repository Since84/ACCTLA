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

	/* ========================================================================================================================
	
	Theme specific settings

	Uncomment register_nav_menus to enable a single menu with the title of "Primary Navigation" in your theme
	
	======================================================================================================================== */

	add_theme_support('post-thumbnails');
	add_theme_support( 'menus' );
	
	register_nav_menus(array('primary' 	=> 'Primary Navigation',
							 'sign-up' 	=> 'Sign Up',
							 'members' 	=> 'Membership',
							 'about' 	=> 'About Us')
					  );
	
	
	 /**
     * WordPress Widgets start right here.
     */
/*
    function responsive_widgets_init() {

        
        (array(
            'name' => __('Main Sidebar', 'responsive'),
            'description' => __('Area 1 - sidebar.php', 'responsive'),
            'id' => 'main-sidebar',
            'before_title' => '<div class="widget-title">',
            'after_title' => '</div>',
            'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
            'after_widget' => '</div>'
        ));

        register_sidebar(array(
            'name' => __('Right Sidebar', 'responsive'),
            'description' => __('Area 2 - sidebar-right.php', 'responsive'),
            'id' => 'right-sidebar',
            'before_title' => '<div class="widget-title">',
            'after_title' => '</div>',
            'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
            'after_widget' => '</div>'
        ));
				
        register_sidebar(array(
            'name' => __('Left Sidebar', 'responsive'),
            'description' => __('Area 3 - sidebar-left.php', 'responsive'),
            'id' => 'left-sidebar',
            'before_title' => '<div class="widget-title">',
            'after_title' => '</div>',
            'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
            'after_widget' => '</div>'
        ));
		
        register_sidebar(array(
            'name' => __('Left Sidebar Half Page', 'responsive'),
            'description' => __('Area 4 - sidebar-left-half.php', 'responsive'),
            'id' => 'left-sidebar-half',
            'before_title' => '<div class="widget-title">',
            'after_title' => '</div>',
            'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
            'after_widget' => '</div>'
        ));
		
        register_sidebar(array(
            'name' => __('Right Sidebar Half Page', 'responsive'),
            'description' => __('Area 5 - sidebar-right-half.php', 'responsive'),
            'id' => 'right-sidebar-half',
            'before_title' => '<div class="widget-title">',
            'after_title' => '</div>',
            'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
            'after_widget' => '</div>'
        ));

        register_sidebar(array(
            'name' => __('Home Widget 1', 'responsive'),
            'description' => __('Area 6 - sidebar-home.php', 'responsive'),
            'id' => 'home-widget-1',
            'before_title' => '<div id="widget-title-one" class="widget-title-home"><h3>',
            'after_title' => '</h3></div>',
            'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
            'after_widget' => '</div>'
        ));

        register_sidebar(array(
            'name' => __('Home Widget 2', 'responsive'),
            'description' => __('Area 7 - sidebar-home.php', 'responsive'),
            'id' => 'home-widget-2',
            'before_title' => '<div id="widget-title-two" class="widget-title-home"><h3>',
            'after_title' => '</h3></div>',
            'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
            'after_widget' => '</div>'
        ));

        register_sidebar(array(
            'name' => __('Home Widget 3', 'responsive'),
            'description' => __('Area 8 - sidebar-home.php', 'responsive'),
            'id' => 'home-widget-3',
            'before_title' => '<div id="widget-title-three" class="widget-title-home"><h3>',
            'after_title' => '</h3></div>',
            'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
            'after_widget' => '</div>'
        ));

        register_sidebar(array(
            'name' => __('Gallery Sidebar', 'responsive'),
            'description' => __('Area 9 - sidebar-gallery.php', 'responsive'),
            'id' => 'gallery-widget',
            'before_title' => '<div class="widget-title">',
            'after_title' => '</div>',
            'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
            'after_widget' => '</div>'
        ));
		
        register_sidebar(array(
            'name' => __('Colophon Widget', 'responsive'),
            'description' => __('Area 10 - sidebar-colophon.php', 'responsive'),
            'id' => 'colophon-widget',
            'before_title' => '<div class="widget-title">',
            'after_title' => '</div>',
            'before_widget' => '<div id="%1$s" class="colophon-widget widget-wrapper %2$s">',
            'after_widget' => '</div>'
        ));
		
        register_sidebar(array(
            'name' => __('Top Widget', 'responsive'),
            'description' => __('Area 11 - sidebar-top.php', 'responsive'),
            'id' => 'top-widget',
            'before_title' => '<div class="widget-title">',
            'after_title' => '</div>',
            'before_widget' => '<div id="%1$s" class="%2$s">',
            'after_widget' => '</div>'
        ));
    }
	
    add_action('widgets_init', 'responsive_widgets_init');
*/
	
	
	

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
        wp_enqueue_style( 'screen' );
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