<?php
/**
 * UF HWCOE WordPress theme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package HWCOE_UFL
 */

if ( ! function_exists( 'hwcoe_ufl_setup' ) ) :

/*
/* Sets up theme defaults and registers support for various WordPress features.
*/

function hwcoe_ufl_setup() {
	// Make theme available for translation.
	load_theme_textdomain( 'hwcoe-ufl', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );
	
	// Allow partial refreshes of widgets in sidebars
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Switch default core markup for search form, comment form, and comments to output valid HTML5
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress custom background feature   
	$defaults = array(
		'default-image' => '',
		'default-color' => '#faf8f1',
	);
	add_theme_support( 'custom-background', $defaults );
	
	// Add support for custom logos in the Customizer, use flex-width/height to skip cropping
	add_theme_support( 'custom-logo', array(
		'width' => 240,
		'height' => 58,
		'flex-width' => true,
		'flex-height' => true,
	) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'main_menu' => esc_html__( 'Main Menu', 'hwcoe-ufl' ),
		'global_menu' => esc_html__( 'Global Menu', 'hwcoe-ufl' ),
		'audience_nav' => esc_html__( 'Audience Navigation', 'hwcoe-ufl' ),
	) );
}
endif; // hwcoe_ufl_setup
add_action( 'after_setup_theme', 'hwcoe_ufl_setup' );

/*
/* Adds page excerpt support
*/
if ( ! function_exists( 'hwcoe_ufl_page_excerpt_support' ) ) :

function hwcoe_ufl_page_excerpt_support() {
	add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'hwcoe_ufl_page_excerpt_support' );

endif; 	// hwcoe_ufl_page_excerpt_support

/**
 * Set the max content width in pixels, based on the theme's design and stylesheet.
 * Priority 0 to make it available to lower priority callbacks.
 * @global int $content_width
 */

// default max content width
if ( ! isset( $content_width ) ) $content_width = 1050;

/*
 * Get theme version
 */

if ( ! function_exists( 'get_theme_version' ) ) :

function get_theme_version(){
  $theme_info = wp_get_theme();
  $version = $theme_info->get( 'Version' );
  return $version;
}

endif; // get_theme_version

/**
 * Enqueue scripts and styles.
 */

if ( ! function_exists( 'hwcoe_ufl_scripts' ) ) :

function hwcoe_ufl_scripts() {
	// Bootstrap
	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/inc/bootstrap/css/bootstrap.min.css', array(), null);
	wp_enqueue_script('bootstrap', get_template_directory_uri() . '/inc/bootstrap/js/bootstrap.min.js', array('jquery'), null, true);
	
	// PrettyPhoto
	wp_enqueue_style( 'prettyPhoto', get_template_directory_uri() . '/inc/prettyPhoto/css/prettyPhoto.css', array(), null );
	wp_enqueue_script( 'prettyPhoto', get_template_directory_uri() . '/inc/prettyPhoto/js/jquery.prettyPhoto.js', array('jquery'), null, true );
	
	// Theme
	wp_enqueue_style( 'hwcoe-ufl-style', get_stylesheet_uri(), array(), get_theme_version() );
	wp_enqueue_script( 'hwcoe-ufl-plugins', get_template_directory_uri() . '/js/plugins.min.js', array('jquery'), get_theme_version(), true );
	wp_enqueue_script( 'hwcoe-ufl-scripts', get_template_directory_uri() . '/js/scripts.min.js', array(), get_theme_version(), true );
	
	// Dashicons for front end use
	wp_enqueue_style( 'dashicons' );

	// Pass site data to Javascript
	$site_data = array(
		'home_url' => home_url('/'),
		'theme_url' => get_template_directory_uri(),
		'max_main_menu_items' => get_theme_mod('max_main_menu_items', 7),
		'mega_menu' => get_theme_mod('mega_menu', 1),
	);
	wp_localize_script( 'hwcoe-ufl-plugins', 'hwcoe_ufl_sitedata', $site_data );
}
add_action( 'wp_enqueue_scripts', 'hwcoe_ufl_scripts' );

endif; // hwcoe_ufl_scripts

/**
 * Enqueue inline styles
 */

if ( ! function_exists( 'hwcoe_ufl_inline_styles' ) ) :

function hwcoe_ufl_inline_styles() {
	$custom_css = '';
	
	// Adjust main menu width
	if ( has_nav_menu('main_menu') ){
		$menu_item_count = 0;
		$menu_locations = get_nav_menu_locations();
		$menu_items = wp_get_nav_menu_items( $menu_locations[ 'main_menu' ] );
		
		foreach ( $menu_items as $item ) {
			// Only count top level menu items
			if ( $item->menu_item_parent == 0 ){
				$menu_item_count++; 
			}   
		}
		$custom_css .= '@media screen and (min-width:1250px){ .main-menu-wrap .menu > li { width: calc(100%/' . $menu_item_count . '); }} ';
	}
	
	wp_add_inline_style('hwcoe-ufl-style', $custom_css);
}
endif; // hwcoe_ufl_inline_styles

// add_action('wp_enqueue_scripts', 'hwcoe_ufl_inline_styles');

/**
 * Registers an editor stylesheet for the theme
 */

if ( ! function_exists( 'hwcoe_ufl_editor_styles' ) ) :

function hwcoe_ufl_editor_styles() {
	add_editor_style('editor-style.css');
}
add_action( 'admin_init', 'hwcoe_ufl_editor_styles' );

endif; // hwcoe_ufl_editor_styles

/**
* Disable loading of unwanted scripts
*/

// Disable emojis
add_action( 'init', 'hwcoe_disable_emojis' );

function hwcoe_disable_emojis() {
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}

function disable_emojis_tinymce( $plugins ) {
  if ( is_array( $plugins ) ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
  } else {
    return array();
  }
}

// Deregister wp-polyfill
function deregister_polyfill(){

  wp_deregister_script( 'wp-polyfill' );
  wp_deregister_script( 'regenerator-runtime' );

}
add_action( 'wp_enqueue_scripts', 'deregister_polyfill');

/**
 * Load custom theme files 
 */

require get_template_directory() . '/inc/filters.php';
require get_template_directory() . '/inc/media.php';
require get_template_directory() . '/inc/shortcodes.php';
require get_template_directory() . '/inc/walkers.php';
require get_template_directory() . '/inc/widgets.php';
require get_template_directory() . '/inc/shibboleth.php';
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/navigation.php';

// Events Manager

if ( class_exists( 'EM_Events' ) && file_exists(get_template_directory() . '/plugins/events-manager/em-addons.php')) {
	require get_template_directory() . '/plugins/events-manager/em-addons.php';
}

// Gravity Forms custom code and enhancements

if ( class_exists( 'GFCommon' ) && file_exists(get_template_directory() . '/plugins/gravityforms/gf-addons.php')) {
	require get_template_directory() . '/plugins/gravityforms/gf-addons.php';
}

// END Gravity Forms

// Add Bootstrap compatible walker
if ( !class_exists('wp_bootstrap_navwalker') ) {
	require_once get_template_directory() . '/inc/wp-bootstrap-navwalker.php';
}

// The Events Calendar
// if ( class_exists('Tribe__Events__Main') ) {
//  require get_template_directory() . '/inc/the-events-calendar.php';
// }

// Shortcake Shortcode UI
// if( function_exists( 'shortcode_ui_register_for_shortcode' ) ) {
//  require get_template_directory() . '/inc/shortcake/shortcodes-ui.php';
// }

// IssueM newsletter
// if ( class_exists( 'IssueM' ) ) {
//  require get_template_directory() . '/inc/issuem/issuem.php';
// }

/*
 * Trim content
 * Useful for generating excerpt like snippets of content
 */

if ( ! function_exists( 'hwcoe_ufl_trim_content' ) ) :

function hwcoe_ufl_trim_content( $content, $length, $after_content ){

  if( strlen( $content ) > $length ){
	$trimmed_content = substr( strip_tags( $content ), 0,  $length  ) . $after_content;
	return $trimmed_content; 
  } else{
	return $content;
  }
}

endif; // hwcoe_ufl_trim_content

/*
 * Theme variable definitions
 */
define( "HWCOE_UFL_IMG_DIR", get_template_directory_uri() . "/img" );
define( "HWCOE_UFL_INC_DIR", get_template_directory() . "/inc/modules" );

// Advanced custom fields
/*
 * ACF functionality within the theme
 * All additional functionality should be defined here
 */

// Register ACF blocks for WP block editor

add_action('acf/init', 'hwcoe_ufl_acf_init_block_types');

function hwcoe_ufl_acf_init_block_types() {
	if( function_exists( 'acf_register_block_type' )){
		// register a card block.
		acf_register_block_type( array(
			'title'				=> __( 'Card with InnerBlocks', 'hwcoe-ufl' ),
			'name'				=> 'card_innerblocks',
			'description'       => __('A custom card block with InnerBlocks support.'),
			'render_template'	=> get_template_directory() . '/template-parts/blocks/card/card-innerblocks.php',
			'category'          => 'design',
			'mode'				=> 'preview',
			'keywords'          => array( 'card' ),
			'supports'			=> [
				'align'		=> true,
				'anchor'		=> true,
				'customClassName'	=> true,
				'jsx' 		=> true,
			]
		));
	}
}

// Add field groups programmatically for Page and Slider options
if( function_exists( 'acf_add_local_field_group' )){
	require get_template_directory() . '/inc/advanced-custom-fields/field-groups.php';
}

// Add Footer Options page under Appearance
if( function_exists('acf_add_options_page') ) {
  acf_add_options_page(array(
	'page_title' => 'Footer Options',
	'menu_title'=> 'Footer Options',
	'menu_slug' => 'footer-options',
	'parent_slug' => 'themes.php',
	'capability'=> 'customize',
	'redirect'  => false
  ));
}

// Add field groups for Post options, Home and Landing page template modules, and footer options
add_filter('acf/settings/save_json', 'hwcoe_ufl_acf_json_save_point');

if (!function_exists('hwcoe_ufl_acf_json_save_point')) { 
	function hwcoe_ufl_acf_json_save_point( $path ) {
		// update path
		$path = get_template_directory() . '/inc/advanced-custom-fields/acf-json';
		return $path; 
	}
}

add_filter('acf/settings/load_json', 'hwcoe_ufl_acf_json_load_point');

if (!function_exists('hwcoe_ufl_acf_json_load_point')) {
	function hwcoe_ufl_acf_json_load_point( $paths ) {	
		// remove original path (optional)
		unset($paths[0]);

		// append path
		$paths[] = get_template_directory() . '/inc/advanced-custom-fields/acf-json';
		
		// return
		return $paths;
	}
}

// Limit the ACF Custom Fields dashboard menu to users who are site administrators (single site) or network admins (multisite)
function hwcoe_ufl_acf_init() {
	acf_update_setting('capability', 'update_plugins'); 
}
add_action('acf/init', 'hwcoe_ufl_acf_init');

// Remove WPAUTOP from ACF TinyMCE Editor by default, so that we can use complex shortcodes in content fields
// WPAUTOP is reinstated in some areas
function acf_wysiwyg_remove_wpautop() {
	remove_filter('acf_the_content', 'wpautop' );
}
add_action('acf/init', 'acf_wysiwyg_remove_wpautop');

// END Advanced custom fields

// omit twitter script on oEmbeds since we've added it in scripts.js
// https://www.geekwire.com/devblog/remove-duplicate-twitter-widgets-js-script-from-oembed-endpoint-html-when-your-site-template-already-includes-it/

function omit_twitter_script($provider, $url, $args) {
    //get the hostname of the oEmbed endpoint provider being called
    $host = parse_url($provider, PHP_URL_HOST);
    //check to see that hostname is twitter.com
    if (strpos($host, 'twitter.com') !== false) {
      //adding ?omit_script=true to oEmbed endpoint call stops the returned HTML from containing widgets.js
        $provider = add_query_arg('omit_script', 'true', $provider);
    }
    //return the $provider URL so the oEmbed can be fetched
    return $provider;
}
add_filter('oembed_fetch_url', 'omit_twitter_script', 10, 3);