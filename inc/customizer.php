<?php 
/**
 * Theme Customization API, requires WordPress 3.4
 *
 */

/**
 * Get category list for a customizer select
 * @since 0.2.5
 */
function ufclas_ufl_2015_customize_categories() {
	$args = array('fields' => 'id=>name');
	return get_categories( $args );
}
/**
 * Get range of values for customizer select
 * @since 0.2.5
 */
function ufclas_ufl_2015_customize_range( $min = 0, $max = 10 ) {
	$range = array();
	for ($i=$min; $i<=$max; $i++){
		$range[$i] = $i;
	}
	return $range;
}

/**
 * Sanitize radio and select boxes using choices
 *
 * @return string Valid input or the default value for the setting 
 * @since 0.3.0
 * @see http://cachingandburning.com/wordpress-theme-customizer-sanitizing-radio-buttons-and-select-lists/
 */
function ufclas_ufl_2015_sanitize_choices( $input, $setting ) {
	global $wp_customize;
	
	$control = $wp_customize->get_control( $setting->id );
	
	if ( array_key_exists( $input, $control->choices ) ){
		return $input;
	}
	else {
		return $setting->default;	
	}
}

/**
 * Add Customizer CSS
 * @since 0.2.5
 */
function ufclas_ufl_2015_customize_css() {
	$custom_css = '';
	$theme_mods = get_theme_mods();
	$background_color = ( isset($theme_mods['background_color']) )? $theme_mods['background_color'] : false;
	$content_color = ( isset($theme_mods['content_color']) )? $theme_mods['content_color'] : false;
	$collapse_sidebar_nav = ( isset($theme_mods['collapse_sidebar_nav']) )? $theme_mods['collapse_sidebar_nav'] : 1;
	
	// Custom background color
	if ( !empty($background_color) ) {
		$custom_css .=  "body { background-color: {$background_color}; } ";
  	}
	
	// Custom content color
	if ( !empty($content_color) ) {
		$custom_css .=  "#main.main-content { background-color: {$content_color}; } ";
  	}
	
	// Custom css for sidenav
	if ( $collapse_sidebar_nav ) {
		$custom_css  .= '.sidenav .page_item_has_children .children {display: none;} ';	
  	}
	
    wp_add_inline_style( 'style', $custom_css );
}
add_action('wp_enqueue_scripts', 'ufclas_ufl_2015_customize_css');

/**
 * Add Customizer Preview script
 * @since 0.4.0
 */
function ufclas_ufl_2015_customize_script() {
	wp_enqueue_script( 'ufl-2015-themecustomizer',	get_template_directory_uri() . '/js/customizer.min.js', array( 'jquery','customize-preview' ), null, true	);
}
add_action('customize_preview_init', 'ufclas_ufl_2015_customize_script');
 
/**
 * Add custom theme mods to the Customizer
 * @since 0.2.5
 */
function ufclas_ufl_2015_customize_register( $wp_customize ) {
	// Colors section
	$default_colors = array( 'beige' => 'faf8f1' );
	$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
	$wp_customize->get_setting( 'background_color' )->default = 'faf8f1';
	$wp_customize->add_setting( 'content_color', array( 'default' => 'faf8f1', 'transport' => 'postMessage', 'sanitize_callback' => 'sanitize_hex_color' ));
	
	$wp_customize->add_control( 
		new WP_Customize_Color_Control( $wp_customize, 'content_color', array(
			'label' => __('Content Background Color', 'ufclas-ufl-2015'),
			'section' => 'colors',
			'settings' => 'content_color',
		)
	));
	
	// Add a Theme Option panel for backwards compatibility
	$wp_customize->add_panel( 'theme_options', array(
		'title' => __('Theme Options', 'ufclas-ufl-2015'),
		'description' => __('Options for modifying the theme.', 'ufclas-ufl-2015'),
		'priority' => '160',
	));
	
	// General
	$wp_customize->add_section( 'theme_options_general', array(
		'title' => __('General', 'ufclas-ufl-2015'),
		'description' => __('', 'ufclas-ufl-2015'),
		'panel' => 'theme_options',
	));
	
	$wp_customize->add_setting( 'parent_colleges_institutes', array( 'default' => 'None', 'sanitize_callback' => 'ufclas_ufl_2015_sanitize_choices' ));
	$wp_customize->add_setting( 'analytics_acct', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ));
	$wp_customize->add_setting( 'max_main_menu_items', array( 'default' => 7, 'sanitize_callback' => 'absint' ));
	$wp_customize->add_setting( 'mega_menu', array( 'default' => 1, 'sanitize_callback' => 'absint' ));
	$wp_customize->add_setting( 'collapse_sidebar_nav', array( 'default' => 1, 'sanitize_callback' => 'absint' ));
	
	$wp_customize->add_control( 'parent_colleges_institutes', array(
		'label' => __('Parent Organization', 'ufclas-ufl-2015'),
		'description' => __('Select your parent organization.', 'ufclas-ufl-2015'),
		'section' => 'theme_options_general',
		'type' => 'select',
		'choices' => array(
			'University of Florida|http://ufl.edu' => __('University of Florida', 'ufclas-ufl-2015'),
			'Herbert Wertheim College of Engineering|https://www.eng.ufl.edu/' => __('Herbert Wertheim College of Engineering', 'ufclas-ufl-2015'),
			'None' => __('None', 'ufclas-ufl-2015'),
		),
	));
	$wp_customize->add_control( 'analytics_acct', array(
		'label' => __('Google Analytics Account Number', 'ufclas-ufl-2015'),
		'description' => __("(e.g., 'UA-xxxxxxx-x' or 'UA-xxxxxxx-xx' )", 'ufclas-ufl-2015'),
		'section' => 'theme_options_general',
		'type' => 'text',
	));
	$wp_customize->add_control( 'max_main_menu_items', array(
		'label' => __('Maximum Main Menu items', 'ufclas-ufl-2015'),
		'description' => __('Items to display in main menu before showing the "More" item', 'ufclas-ufl-2015'),
		'section' => 'theme_options_general',
		'type' => 'number',
	));
	$wp_customize->add_control( 'mega_menu', array(
		'label' => __('Enable Mega Drop Down Menu', 'ufclas-ufl-2015'),
		'description' => __('Main menu items appear in 2 columns', 'ufclas-ufl-2015'),
		'section' => 'theme_options_general',
		'type' => 'checkbox',
	));
	$wp_customize->add_control( 'collapse_sidebar_nav', array(
		'label' => __('Collapse Sidebar Navigation', 'ufclas-ufl-2015'),
		'description' => __('Useful for larger sites - keeps the sidebar navigation a manageable height', 'ufclas-ufl-2015'),
		'section' => 'theme_options_general',
		'type' => 'checkbox',
	));

		
	// Homepage
	$wp_customize->add_section( 'theme_options_homepage', array(
		'title' => __('Homepage', 'ufclas-ufl-2015'),
		'description' => __('The options below edit the homepage featured slider and widgets.', 'ufclas-ufl-2015'),
		'panel' => 'theme_options',
	));
	
	$wp_customize->add_setting( 'homepage_layout', array( 'default' => '2c-bias', 'sanitize_callback' => 'sanitize_key' ));
	$wp_customize->add_setting( 'featured_category', array( 'default' => 0, 'sanitize_callback' => 'absint' ));
	$wp_customize->add_setting( 'number_of_posts_to_show', array( 'default' => 3, 'sanitize_callback' => 'absint' ));
	$wp_customize->add_setting( 'featured_style', array( 'default' => 'slider-dark', 'sanitize_callback' => 'sanitize_key' ));
	$wp_customize->add_setting( 'featured_speed', array( 'default' => 7, 'sanitize_callback' => 'absint' ));
	$wp_customize->add_setting( 'featured_disable_link', array( 'default' => 0, 'sanitize_callback' => 'absint' ));
	
	$wp_customize->add_control( 'homepage_layout', array(
		'label' => __('Homepage Layout for Widgets', 'ufclas-ufl-2015'),
		'description' => __('Select a layout to use for your widgets on the homepage', 'ufclas-ufl-2015'),
		'section' => 'theme_options_homepage',
		'type' => 'select',
		'choices' => array(
			'3c-default' => __('Three Columns, 1/2 1/4 1/4', 'ufclas-ufl-2015'),
			'3c-thirds' => __('Three Columns, 1/3 1/3 1/3', 'ufclas-ufl-2015'),
			'2c-bias' => __('Two Columns, 2/3, 1/3', 'ufclas-ufl-2015'),
			'2c-half' => __('Two Columns, 1/2 1/2', 'ufclas-ufl-2015'),
			'1c-100' => __('One Column', 'ufclas-ufl-2015'),
			'1c-100-2c-half' => __('One Column w/ Two Columns', 'ufclas-ufl-2015')
		),
	));
	
	$wp_customize->add_control( 'featured_category', array(
		'label' => __('Select a Category', 'ufclas-ufl-2015'),
		'description' => __('Choose a category for the featured post slider.', 'ufclas-ufl-2015'),
		'section' => 'theme_options_homepage',
		'type' => 'select',
		'choices' => ufclas_ufl_2015_customize_categories(),
	));
	
	$wp_customize->add_control( 'number_of_posts_to_show', array(
		'label' => __('Number of Posts to Display in Slider', 'ufclas-ufl-2015'),
		'description' => __('Number of posts to display in your slider', 'ufclas-ufl-2015'),
		'section' => 'theme_options_homepage',
		'type' => 'select',
		'choices' => ufclas_ufl_2015_customize_range( 1, 15 ),
	));
	
	$wp_customize->add_control( 'featured_speed', array(
		'label' => __('Slider Speed', 'ufclas-ufl-2015'),
		'description' => __('Time in seconds to display each slide', 'ufclas-ufl-2015'),
		'section' => 'theme_options_homepage',
		'type' => 'number',
	));
	
	$wp_customize->add_control( 'featured_disable_link', array(
		'label' => __('Disable Slider Links', 'ufclas-ufl-2015'),
		'description' => __('Disable links from being created on the homepage slider.', 'ufclas-ufl-2015'),
		'section' => 'theme_options_homepage',
		'type' => 'checkbox',
	));
	
	// Header
	$wp_customize->add_section( 'theme_options_header', array(
		'title' => __('Header', 'ufclas-ufl-2015'),
		'panel' => 'theme_options',
	));
	
	$wp_customize->add_setting( 'header_type', array( 'default' => 'icon', 'sanitize_callback' => 'ufclas_ufl_2015_sanitize_choices' ));
	$wp_customize->add_control( 'header_type', array(
		'label' => __('Header Type', 'ufclas-ufl-2015'),
		'description' => __("Select the type of header to display on all pages", 'ufclas-ufl-2015'),
		'section' => 'theme_options_header',
		'type' => 'radio',
		'choices' => array(
			'logo' => __('Logo Image', 'ufclas-ufl-2015'),
			'text' => __('Title Text', 'ufclas-ufl-2015'),
		),
	));
	
	// Announcement/Alert
	$wp_customize->add_section( 'theme_options_alert', array(
		'title' => __('Announcement or Alert', 'ufclas-ufl-2015'),
		'panel' => 'theme_options',
	));
	
	$wp_customize->add_setting( 'actionitem_text', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ));
	$wp_customize->add_setting( 'actionitem_heading', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ));
	$wp_customize->add_setting( 'actionitem_url', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ));
	$wp_customize->add_setting( 'actionitem_altcolor', array( 'default' => 0, 'sanitize_callback' => 'absint' ));
	
	$wp_customize->add_control( 'actionitem_text', array(
		'label' => __('Announcement/Alert Text', 'ufclas-ufl-2015'),
		'description' => __('The Announcement/Alert text is an alert message below your main menu. Leave it blank to remove it.', 'ufclas-ufl-2015'),
		'section' => 'theme_options_alert',
		'type' => 'text',
	));
	$wp_customize->add_control( 'actionitem_url', array(
		'label' => __('Announcement/Alert URL', 'ufclas-ufl-2015'),
		'description' => __("Where visitors are taken when they click on your Announcement/Alert link", 'ufclas-ufl-2015'),
		'section' => 'theme_options_alert',
		'type' => 'text',
	));
	$wp_customize->add_control( 'actionitem_heading', array(
		'label' => __('Announcement/Alert Heading', 'ufclas-ufl-2015'),
		'description' => __('The Announcement/Alert heading is above the alert message (optional)', 'ufclas-ufl-2015'),
		'section' => 'theme_options_alert',
		'type' => 'text',
	));
	$wp_customize->add_control( 'actionitem_altcolor', array(
		'label' => __('Announcement/Alert Alternate Color', 'ufclas-ufl-2015'),
		'description' => __('This is an alternate color (red) used for warnings and emergency alerts.', 'ufclas-ufl-2015'),
		'section' => 'theme_options_alert',
		'type' => 'checkbox',
	));
	
	// Social 
	$wp_customize->add_section( 'theme_options_social', array(
		'title' => __('Social Media', 'ufclas-ufl-2015'),
		'description' => __("Enter your organization's social media URLs (e.g. https://...). Social media icons are displayed in the header and footer", 'ufclas-ufl-2015'),
		'panel' => 'theme_options',
	));
	
	$wp_customize->add_setting( 'facebook_url', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ));
	$wp_customize->add_setting( 'twitter_url', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ));
	$wp_customize->add_setting( 'youtube_url', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ));
	$wp_customize->add_setting( 'linkedin_url', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ));
	$wp_customize->add_setting( 'instagram_url', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ));
	$wp_customize->add_setting( 'flickr_url', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ));
	$wp_customize->add_setting( 'feed_url', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ));
	
	$wp_customize->add_control( 'facebook_url', array(
		'label' => __('Facebook URL', 'ufclas-ufl-2015'),
		'description' => __("", 'ufclas-ufl-2015'),
		'section' => 'theme_options_social',
		'type' => 'text',
	));
	$wp_customize->add_control( 'twitter_url', array(
		'label' => __('Twitter URL', 'ufclas-ufl-2015'),
		'description' => __("", 'ufclas-ufl-2015'),
		'section' => 'theme_options_social',
		'type' => 'text',
	));
	$wp_customize->add_control( 'youtube_url', array(
		'label' => __('YouTube URL', 'ufclas-ufl-2015'),
		'description' => __("", 'ufclas-ufl-2015'),
		'section' => 'theme_options_social',
		'type' => 'text',
	));
	$wp_customize->add_control( 'linkedin_url', array(
		'label' => __('LinkedIn URL', 'ufclas-ufl-2015'),
		'description' => __("", 'ufclas-ufl-2015'),
		'section' => 'theme_options_social',
		'type' => 'text',
	));
	$wp_customize->add_control( 'instagram_url', array(
		'label' => __('Instagram URL', 'ufclas-ufl-2015'),
		'description' => __("", 'ufclas-ufl-2015'),
		'section' => 'theme_options_social',
		'type' => 'text',
	));
	$wp_customize->add_control( 'flickr_url', array(
		'label' => __('Flickr URL', 'ufclas-ufl-2015'),
		'description' => __("", 'ufclas-ufl-2015'),
		'section' => 'theme_options_social',
		'type' => 'text',
	));
	$wp_customize->add_control( 'feed_url', array(
		'label' => __('News Feed URL', 'ufclas-ufl-2015'),
		'description' => __("", 'ufclas-ufl-2015'),
		'section' => 'theme_options_social',
		'type' => 'text',
	));
	
	// Custom Attributes
		
}
add_action('customize_register','ufclas_ufl_2015_customize_register');

