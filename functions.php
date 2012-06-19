<?php
/* -----------------------------------------------------------------------------------------------
 * FOURSQUARE THEME FUNCTIONS
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 *
 * @package WordPress
 * @subpackage Foursquare Two
 * @since Foursquare Two 1.0
 *
 * Last Updated: February 22, 2012
 ------------------------------------------------------------------------------------------------ */

################################################################################
// SETUP
################################################################################

// Include Function Files
require_once('assets/functions/admin-profile-options.php');
require_once('assets/functions/admin-theme-options.php');
require_once('assets/functions/custom-post-types.php');
require_once('assets/functions/shortcodes.php');
require_once('assets/functions/breadcrumbs.php');
require_once('assets/functions/class-tgm-plugin-activation.php');

// Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) )
	$content_width = 640;

// Tell WordPress to run foursquare_setup() when the 'after_setup_theme' hook is run.
add_action( 'after_setup_theme', 'foursquare_setup' );

if ( ! function_exists( 'foursquare_setup' ) ):

// Load all CSS files in the currect order!
function bootstrapwp_css_loader() {
	wp_enqueue_style('bootstrap.css', get_template_directory_uri().'/assets/styles/bootstrap/bootstrap.css', false ,'1.0', 'all' );
  	wp_enqueue_style('style.css', get_template_directory_uri().'/style.css', false ,'1.0', 'all' );
  	wp_enqueue_style('responsive.css', get_template_directory_uri().'/assets/styles/bootstrap/responsive.css', false ,'1.0', 'all' );
}     
    add_action('wp_enqueue_scripts', 'bootstrapwp_css_loader');

// Sets up theme defaults and registers support for various WordPress features.
function foursquare_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'foursquare', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'foursquare' ),
	) );
	
	// Custom header starts here
	if ( ! defined( 'HEADER_TEXTCOLOR' ) )
		define( 'HEADER_TEXTCOLOR', '' );

	// No CSS, just IMG call. The %s is a placeholder for the theme template directory URI.
	if ( ! defined( 'HEADER_IMAGE' ) )
		define( 'HEADER_IMAGE', '' );

	// The height and width of your custom header. You can hook into the theme's own filters to change these values.
	// Add a filter to foursquare_header_image_width and foursquare_header_image_height to change these values.
	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'foursquare_header_image_width', 570 ) );
	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'foursquare_header_image_height', 85 ) );

	// We'll be using post thumbnails for custom header images on posts and pages.
	// We want them to be 940 pixels wide by 198 pixels tall.
	// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
	set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );

	// Don't support text inside the header image.
	if ( ! defined( 'NO_HEADER_TEXT' ) )
		define( 'NO_HEADER_TEXT', true );

	// Add a way for the custom header to be styled in the admin panel that controls
	// custom headers. See foursquare_admin_header_style(), below.
	add_custom_image_header( '', 'foursquare_admin_header_style' );

	// ... and thus ends the custom header business.
}
endif;

if ( ! function_exists( 'foursquare_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in foursquare_setup().
 *
 * @since Twenty Ten 1.0
 */
function foursquare_admin_header_style() {
?>
<style type="text/css">
/* Shows the same border as on front end */
#headimg {
	border-bottom: 1px solid #000;
	border-top: 4px solid #000;
	min-height: 85px !important;
}
/* If NO_HEADER_TEXT is false, you would style the text with these selectors:
	#headimg #name { }
	#headimg #desc { }
*/
</style>
<?php
}
endif;

// Include Required Plugins
/**
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @package	   TGM-Plugin-Activation
 * @subpackage Example
 * @version	   2.3.3
 * @author	   Thomas Griffin <thomas@thomasgriffinmedia.com>
 * @author	   Gary Jones <gamajo@gamajo.com>
 * @copyright  Copyright (c) 2012, Thomas Griffin
 * @license	   http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */

add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function my_theme_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// Plugins that are pre-packaged with a theme
		array(
			'name'     				=> 'Hero Content Slider', // The plugin name
			'slug'     				=> 'flexslider', // The plugin slug (typically the folder name)
			'source'   				=> get_stylesheet_directory() . '/assets/plugins/flexslider.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher
			'force_activation' 		=> true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> 'The Events Calendar', // The plugin name
			'slug'     				=> 'the-events-calendar', // The plugin slug (typically the folder name)
			'source'   				=> get_stylesheet_directory() . '/assets/plugins/the-events-calendar.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> 'Foursquare Twitter Widget', // The plugin name
			'slug'     				=> 'fs-twitter-widget', // The plugin slug (typically the folder name)
			'source'   				=> get_stylesheet_directory() . '/assets/plugins/fs-twitter-widget.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher
			'force_activation' 		=> true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> 'Contact Form 7',
			'slug'     				=> 'contact-form-7', 
			'source'   				=> get_stylesheet_directory() . '/assets/plugins/contact-form-7.zip', 
			'required' 				=> true, 
			'version' 				=> '', 
			'force_activation' 		=> true,			
			'force_deactivation' 	=> false, 
			'external_url' 			=> '', 
		),
		array(
			'name'     				=> 'WordPress Gzip Compression',
			'slug'     				=> 'wordpress-gzip-compression', 
			'source'   				=> get_stylesheet_directory() . '/assets/plugins/wordpress-gzip-compression', 
			'required' 				=> true, 
			'version' 				=> '', 
			'force_activation' 		=> true,			
			'force_deactivation' 	=> false, 
			'external_url' 			=> '', 
		),

		// Plugins from the WordPress Plugin Repository
		array(
			'name' 		=> '',
			'slug' 		=> '',
			'required' 	=> false,
		),

	);

	// Change this to your theme text domain, used for internationalising strings
	$theme_text_domain = 'tgmpa';

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'       		=> $theme_text_domain,         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
		'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> __( 'Install Required Plugins', $theme_text_domain ),
			'menu_title'                       			=> __( 'Install Plugins', $theme_text_domain ),
			'installing'                       			=> __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
			'oops'                             			=> __( 'Something went wrong with the plugin API.', $theme_text_domain ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                           			=> __( 'Return to Required Plugins Installer', $theme_text_domain ),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', $theme_text_domain ),
			'complete' 									=> __( 'All plugins installed and activated successfully. %s', $theme_text_domain ) // %1$s = dashboard link
		)
	);

	tgmpa( $plugins, $config );

}

################################################################################
// HEAD FUNCTIONS
################################################################################
 
// Makes some changes to the <title> tag, by filtering the output of wp_title().
/*----------------------------------------------------------------------------*/
function foursquare_filter_wp_title( $title, $separator ) {
	// Don't affect wp_title() calls in feeds.
	if ( is_feed() )
		return $title;

	// The $paged global variable contains the page number of a listing of posts.
	// The $page global variable contains the page number of a single post that is paged.
	// We'll display whichever one applies, if we're not looking at the first page.
	global $paged, $page;

	if ( is_search() ) {
		// If we're a search, let's start over:
		$title = sprintf( __( 'Search results for %s', 'foursquare' ), '"' . get_search_query() . '"' );
		// Add a page number if we're on page 2 or more:
		if ( $paged >= 2 )
			$title .= " $separator " . sprintf( __( 'Page %s', 'foursquare' ), $paged );
		// Add the site name to the end:
		$title .= " $separator " . get_bloginfo( 'name', 'display' );
		// We're done. Let's send the new title back to wp_title():
		return $title;
	}

	// Otherwise, let's start by adding the site name to the end:
	$title .= get_bloginfo( 'name', 'display' );

	// If we have a site description and we're on the home/front page, add the description:
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $separator " . $site_description;

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $separator " . sprintf( __( 'Page %s', 'foursquare' ), max( $paged, $page ) );

	// Return the new title to wp_title():
	return $title;
}
add_filter( 'wp_title', 'foursquare_filter_wp_title', 10, 2 );

// Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
/*----------------------------------------------------------------------------*/
 
function foursquare_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'foursquare_page_menu_args' );

################################################################################
// Comments and Pingbacks
################################################################################

if ( ! function_exists( 'foursquare_comment' ) ) :
function foursquare_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<h3 class="comment-author vcard">
			<?php echo get_avatar( $comment, 60 ); ?>
			<?php printf( __( '%s', 'foursquare' ), sprintf( '%s', get_comment_author_link() ) ); ?>
		</h3><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<strong><?php _e( 'Your comment is awaiting moderation.', 'foursquare' ); ?></strong>
			<br />
		<?php endif; ?>
		<div class="comment-meta commentmetadata"><i>
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s', 'foursquare' ), get_comment_date(),  get_comment_time() ); ?><?php edit_comment_link( __( '(Edit)', 'foursquare' ), ' ' );
			?></i><br /><br />
		</div><!-- .comment-meta .commentmetadata -->
		<div class="comment-body"><?php comment_text(); ?></div>
		<div class="reply button btn-reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
	</div><!-- #comment-##  -->
	<?php
	break;
	case 'pingback'  :
	case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'foursquare' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'foursquare'), ' ' ); ?></p>
	<?php
	break;
	endswitch;
}
endif;

################################################################################
// POST FUNCTIONS
################################################################################

// Prints HTML with meta information for the current post (category, tags and permalink).
if ( ! function_exists( 'foursquare_posted_in' ) ) :

function foursquare_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'Tags: %2$s.');
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s.', 'foursquare' );
	} else {
		$posted_in = __( '| <a href="%3$s" title="Permalink to %4$s" rel="bookmark">Permalink</a>.', 'foursquare' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;

// Thumbnail Image Sizes
/*----------------------------------------------------------------------------*/

// Thumbnail image size for Sermon custom post type
if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'sermons', '270', '105', 'true' ); //(cropped)
}

// Post Excerpts
/*----------------------------------------------------------------------------*/

// Length: 25 words
function foursquare_excerpt_length( $length ) {
	return 25;
}
add_filter( 'excerpt_length', 'foursquare_excerpt_length' );

// Returns a "Continue Reading" link for excerpts
function foursquare_continue_reading_link() {
	return ' <p><a class="btn btn-primary" href="'. get_permalink() . '">' . __( 'Read more', 'foursquare' ) . '</a></p>';
}

// Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and foursquare_continue_reading_link().
function foursquare_auto_excerpt_more( $more ) {
	return ' &hellip;' . foursquare_continue_reading_link();
}
add_filter( 'excerpt_more', 'foursquare_auto_excerpt_more' );

// Adds a pretty "Continue Reading" link to custom post excerpts.
function foursquare_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= foursquare_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'foursquare_custom_excerpt_more' );

// Length: 15 words. Used on Home blog feed and Sermon Archive.
function wpe_excerptlength_teaser($length) {
    return 15;
}

add_filter( 'excerpt_length', 'foursquare_excerpt_length' );

// Length: 40 words
function wpe_excerptlength_searchteaser($length) {
    return 40;
}

// Length: 85 words
function wpe_excerptlength_events($length) {
    return 85;
}


// Register the "More" function for custom length excerpts
function wpe_excerptmore($more) {
    return '';
}

function wpe_excerpt($length_callback='', $more_callback='') {
    global $post;
    if(function_exists($length_callback)){
        add_filter('excerpt_length', $length_callback);
    }
    if(function_exists($more_callback)){
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>'.$output.'</p>';
    echo $output;
}

################################################################################
// REGISTER SIDEBARS
################################################################################

function foursquare_widgets_init() {
	// Area 1, located at the bottom of the site. Allows two widgets (third space is a feed for Latest Sermons.
	register_sidebar( array(
		'name' => __( 'Footer Widgets', 'foursquare' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The two widgets to the right of the Latest Sermon at the bottom of the site.', 'foursquare' ),
		'before_widget' => '<div class="span4"><li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li></div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );

	// Area 2, located on all subpages. Empty by default.
	register_sidebar( array(
		'name' => __( 'Subpage Widgets', 'foursquare' ),
		'id' => 'subpage-widget-area',
		'description' => __( 'The widget area for the blog index', 'foursquare' ),
		'before_widget' => '<div class="span4"><li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li></div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );

	// Area 3, located below content of a Full-Width page. Empty by default.
	register_sidebar( array(
		'name' => __( 'Full-Width Page Widgets', 'foursquare' ),
		'id' => 'fullwidth-widget-area',
		'description' => __( 'Text widgets below the content of a page using the full-width template', 'foursquare' ),
		'before_widget' => '<div class="span4"><li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li></div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );
	
	// Area 4, located below the Primary Widget Area in the sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Blog Widgets', 'foursquare' ),
		'id' => 'blog-widget-area',
		'description' => __( 'The widget area for the blog index', 'foursquare' ),
		'before_widget' => '<div class="span4"><li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li></div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );

}
// Register sidebars by running foursquare_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'foursquare_widgets_init' );

################################################################################
// WIDGETS
################################################################################

// Removes the default styles that are packaged with the Recent Comments widget.
function foursquare_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'foursquare_remove_recent_comments_style' );

// Prints HTML with meta information for the current post—date/time and author.
if ( ! function_exists( 'foursquare_posted_on' ) ) :

function foursquare_posted_on() {
	printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'foursquare' ),
		'meta-prep meta-prep-author',
		sprintf( '<span class="entry-date">%3$s</span>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'foursquare' ), get_the_author() ),
			get_the_author()
		)
	);
}
endif;
?>
