<?php 
/**
 * Theme Customization API, requires WordPress 3.4
 *
 */

/**
 * Get category list for a customizer select
 */
function hwcoe_ufl_customize_categories() {
	$args = array('fields' => 'id=>name');
	return get_categories( $args );
}
/**
 * Get range of values for customizer select
 * @since 0.1.0
 */
function hwcoe_ufl_customize_range( $min = 0, $max = 10 ) {
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
 * @see http://cachingandburning.com/wordpress-theme-customizer-sanitizing-radio-buttons-and-select-lists/
 */
function hwcoe_ufl_sanitize_choices( $input, $setting ) {
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
 * @since 0.1.0
 */
function hwcoe_ufl_customize_css() {
	$custom_css = '';
	$theme_mods = get_theme_mods();
	
	$custom_logo_height = ( isset($theme_mods['custom_logo_height']) )? $theme_mods['custom_logo_height'] : 58;
	$custom_logo_width = ( isset($theme_mods['custom_logo_width']) )? $theme_mods['custom_logo_width'] : 240;
	$custom_logo_top = ( isset($theme_mods['custom_logo_top']) )? $theme_mods['custom_logo_top'] : 22;

	$background_color = ( isset($theme_mods['background_color']) )? $theme_mods['background_color'] : false;
	$content_color = ( isset($theme_mods['content_color']) )? $theme_mods['content_color'] : false;
	$collapse_sidebar_nav = ( isset($theme_mods['collapse_sidebar_nav']) )? $theme_mods['collapse_sidebar_nav'] : 1;
	

	if( !empty($custom_logo_height) ) {
		$custom_css .= "@media (min-width: 992px){ .header.unit .main-menu-wrap .logo-unit {height:".$custom_logo_height."px;}}";
	}
	if( !empty($custom_logo_width) ) {
		$custom_css .= "@media (min-width: 992px){ .header.unit .main-menu-wrap .logo-unit {width:".$custom_logo_width."px;}}";
		$custom_css .= "@media screen and (min-width: 993px) and (max-width: 1366px) {.header.unit .main-menu-wrap .logo-unit {width:".$custom_logo_width * 0.75."px;}}";
	}
	if( !empty($custom_logo_top) || strlen($custom_logo_top) > 0 ) {
		$custom_css .= "@media (min-width: 992px){ .header.unit .main-menu-wrap .logo-unit {top:".$custom_logo_top."px;}}";
	}

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
		// $custom_css  .= '.sidenav .page_item_has_children.current_page_item .children .children {display:none;} ';
		// $custom_css  .= '.sidenav .page_item_has_children.current_page_item ~ .page_item_has_children .children {display:none;} ';
		// $custom_css  .= '.sidenav .page_item_has_children.current_page_item .children {display: block;} ';
	}
	
	 wp_add_inline_style( 'hwcoe-ufl-style', $custom_css );
}
add_action('wp_enqueue_scripts', 'hwcoe_ufl_customize_css');

/**
 * Add Customizer Preview script
 * @since 0.1.0
 */
function hwcoe_ufl_customize_script() {
	wp_enqueue_script( 'hwcoe-ufl-themecustomizer',	get_template_directory_uri() . '/js/customizer.min.js', array( 'jquery','customize-preview' ), null, true	);
}
add_action('customize_preview_init', 'hwcoe_ufl_customize_script');
 
/**
 * Add custom theme mods to the Customizer
 * @since 0.1.0
 */
function hwcoe_ufl_customize_register( $wp_customize ) {
	// Site Identity section
	$wp_customize->add_setting( 
		'custom_logo_height', 
		array( 
			'default' => '58', 
			'transport' => 'postMessage',
			'sanitize_callback' => 'sanitize_text_field' 
		)
	);
	$wp_customize->add_setting( 
		'custom_logo_width', 
		array( 
			'default' => '240', 
			'transport' => 'postMessage',
			'sanitize_callback' => 'sanitize_text_field' 
		)
	);
	$wp_customize->add_setting( 
		'custom_logo_top', 
		array( 
			'default' => '22', 
			'transport' => 'postMessage',
			'sanitize_callback' => 'sanitize_text_field' 
		)
	);
	
	$wp_customize->add_control( 'custom_logo_height', array(
		'label' => __('Logo Height', 'hwcoe-ufl'),
		'description' => __("Enter height in pixels (default 58)", 'hwcoe-ufl'),
		'section' => 'title_tagline',
		'type' => 'text',
	));
	$wp_customize->add_control( 'custom_logo_width', array(
		'label' => __('Logo Width', 'hwcoe-ufl'),
		'description' => __("Enter width in pixels (default 240)", 'hwcoe-ufl'),
		'section' => 'title_tagline',
		'type' => 'text',
	));
	$wp_customize->add_control( 'custom_logo_top', array(
		'label' => __('Logo Top Position', 'hwcoe-ufl'),
		'description' => __("Enter top position in pixels (default 22)", 'hwcoe-ufl'),
		'section' => 'title_tagline',
		'type' => 'text',
	));
	

	// Colors section
	$default_colors = array( 'beige' => '#faf8f1' );
	$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
	$wp_customize->get_setting( 'background_color' )->default = '#faf8f1';
	$wp_customize->add_setting( 'content_color', array( 
		'default' => '#faf8f1', 
		'transport' => 'postMessage', 
		'sanitize_callback' => 'sanitize_hex_color' 
	));
	
	$wp_customize->add_control( 
		new WP_Customize_Color_Control( $wp_customize, 'content_color', array(
			'label' => __('Content Background Color', 'hwcoe-ufl'),
			'section' => 'colors',
			'settings' => 'content_color',
		)
	));
	
	// Add a Theme Option panel for backwards compatibility
	$wp_customize->add_panel( 'theme_options', array(
		'title' => __('Theme Options', 'hwcoe-ufl'),
		'description' => __('Options for modifying the theme.', 'hwcoe-ufl'),
		'priority' => '160',
	));
	
	// General
	$wp_customize->add_section( 'theme_options_general', array(
		'title' => __('General', 'hwcoe-ufl'),
		'description' => __('', 'hwcoe-ufl'),
		'panel' => 'theme_options',
	));
	
	$wp_customize->add_setting( 'parent_colleges_institutes', array( 'default' => 'None', 'sanitize_callback' => 'hwcoe_ufl_sanitize_choices' ));
	$wp_customize->add_setting( 'analytics_acct', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ));
	$wp_customize->add_setting( 'max_main_menu_items', array( 'default' => 7, 'sanitize_callback' => 'absint' ));
	$wp_customize->add_setting( 'mega_menu', array( 'default' => 1, 'sanitize_callback' => 'absint' ));
	$wp_customize->add_setting( 'collapse_sidebar_nav', array( 'default' => 1, 'sanitize_callback' => 'absint' ));
	
	$wp_customize->add_control( 'parent_colleges_institutes', array(
		'label' => __('Parent Organization', 'hwcoe-ufl'),
		'description' => __('Select your parent organization.', 'hwcoe-ufl'),
		'section' => 'theme_options_general',
		'type' => 'select',
		'choices' => array(
			'University of Florida|http://ufl.edu' => __('University of Florida', 'hwcoe-ufl'),
			'Herbert Wertheim College of Engineering|https://www.eng.ufl.edu/' => __('Herbert Wertheim College of Engineering', 'hwcoe-ufl'),
			'None' => __('None', 'hwcoe-ufl'),
		),
	));
	$wp_customize->add_control( 'analytics_acct', array(
		'label' => __('Google Analytics Measurement ID', 'hwcoe-ufl'),
		'description' => __("e.g., 'G-XXXXXXXXXX'", 'hwcoe-ufl'),
		'section' => 'theme_options_general',
		'type' => 'text',
	));
	$wp_customize->add_control( 'max_main_menu_items', array(
		'label' => __('Maximum Main Menu items', 'hwcoe-ufl'),
		'description' => __('Items to display in main menu before showing the "More" item', 'hwcoe-ufl'),
		'section' => 'theme_options_general',
		'type' => 'number',
	));
	$wp_customize->add_control( 'mega_menu', array(
		'label' => __('Enable Mega Drop Down Menu', 'hwcoe-ufl'),
		'description' => __('Main menu items appear in 2 columns', 'hwcoe-ufl'),
		'section' => 'theme_options_general',
		'type' => 'checkbox',
	));
	$wp_customize->add_control( 'collapse_sidebar_nav', array(
		'label' => __('Collapse Sidebar Navigation', 'hwcoe-ufl'),
		'description' => __('Useful for larger sites - keeps the sidebar navigation a manageable height', 'hwcoe-ufl'),
		'section' => 'theme_options_general',
		'type' => 'checkbox',
	));

		
	// Homepage
	$wp_customize->add_section( 'theme_options_homepage', array(
		'title' => __('Homepage', 'hwcoe-ufl'),
		'description' => __('The options below edit the homepage featured slider and widgets.', 'hwcoe-ufl'),
		'panel' => 'theme_options',
	));
	
	$wp_customize->add_setting( 'homepage_layout', array( 'default' => '2c-bias', 'sanitize_callback' => 'sanitize_key' ));
	$wp_customize->add_setting( 'featured_category', array( 'default' => 0, 'sanitize_callback' => 'absint' ));
	$wp_customize->add_setting( 'number_of_posts_to_show', array( 'default' => 3, 'sanitize_callback' => 'absint' ));
	$wp_customize->add_setting( 'featured_style', array( 'default' => 'slider-dark', 'sanitize_callback' => 'sanitize_key' ));
	$wp_customize->add_setting( 'featured_speed', array( 'default' => 7, 'sanitize_callback' => 'absint' ));
	$wp_customize->add_setting( 'featured_disable_link', array( 'default' => 0, 'sanitize_callback' => 'absint' ));
	
	$wp_customize->add_control( 'homepage_layout', array(
		'label' => __('Homepage Layout for Widgets', 'hwcoe-ufl'),
		'description' => __('Select a layout to use for your widgets on the homepage', 'hwcoe-ufl'),
		'section' => 'theme_options_homepage',
		'type' => 'select',
		'choices' => array(
			'3c-default' => __('Three Columns, 1/2 1/4 1/4', 'hwcoe-ufl'),
			'3c-thirds' => __('Three Columns, 1/3 1/3 1/3', 'hwcoe-ufl'),
			'2c-bias' => __('Two Columns, 2/3, 1/3', 'hwcoe-ufl'),
			'2c-half' => __('Two Columns, 1/2 1/2', 'hwcoe-ufl'),
			'1c-100' => __('One Column', 'hwcoe-ufl'),
			'1c-100-2c-half' => __('One Column w/ Two Columns', 'hwcoe-ufl')
		),
	));
	
	$wp_customize->add_control( 'featured_category', array(
		'label' => __('Select a Category', 'hwcoe-ufl'),
		'description' => __('Choose a category for the featured post slider.', 'hwcoe-ufl'),
		'section' => 'theme_options_homepage',
		'type' => 'select',
		'choices' => hwcoe_ufl_customize_categories(),
	));
	
	$wp_customize->add_control( 'number_of_posts_to_show', array(
		'label' => __('Number of Posts to Display in Slider', 'hwcoe-ufl'),
		'description' => __('Number of posts to display in your slider', 'hwcoe-ufl'),
		'section' => 'theme_options_homepage',
		'type' => 'select',
		'choices' => hwcoe_ufl_customize_range( 1, 15 ),
	));
	
	$wp_customize->add_control( 'featured_speed', array(
		'label' => __('Slider Speed', 'hwcoe-ufl'),
		'description' => __('Time in seconds to display each slide', 'hwcoe-ufl'),
		'section' => 'theme_options_homepage',
		'type' => 'number',
	));
	
	$wp_customize->add_control( 'featured_disable_link', array(
		'label' => __('Disable Slider Links', 'hwcoe-ufl'),
		'description' => __('Disable links from being created on the homepage slider.', 'hwcoe-ufl'),
		'section' => 'theme_options_homepage',
		'type' => 'checkbox',
	));
	
	// Header
	$wp_customize->add_section( 'theme_options_header', array(
		'title' => __('Header', 'hwcoe-ufl'),
		'panel' => 'theme_options',
	));
	
	$wp_customize->add_setting( 'header_type', array( 'default' => 'icon', 'sanitize_callback' => 'hwcoe_ufl_sanitize_choices' ));
	$wp_customize->add_setting( 'tagline_display', array( 'default' => 0, 'sanitize_callback' => 'absint' ));
	$wp_customize->add_setting( 'tagline_url', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ));
	
	$wp_customize->add_control( 'header_type', array(
		'label' => __('Header Type', 'hwcoe-ufl'),
		'description' => __("Select the type of header to display on all pages", 'hwcoe-ufl'),
		'section' => 'theme_options_header',
		'type' => 'radio',
		'choices' => array(
			'logo' => __('Logo Image', 'hwcoe-ufl'),
			'text' => __('Title Text', 'hwcoe-ufl'),
		),
	));
	$wp_customize->add_control( 'tagline_display', array(
		'label' => __('Enable Tagline Display', 'hwcoe-ufl'),
		'description' => __('Site tagline appears in Title Text header mode', 'hwcoe-ufl'),
		'section' => 'theme_options_header',
		'type' => 'checkbox',
	));
	$wp_customize->add_control( 'tagline_url', array(
		'label' => __('Tagline URL', 'hwcoe-ufl'),
		'description' => __("If you wish your tagline to be a link, fill in with a complete URL (e.g. https://www.eng.ufl.edu). Leave blank to leave tagline unlinked.", 'hwcoe-ufl'),
		'section' => 'theme_options_header',
		'type' => 'text',
	));


	// Announcement/Alert
	$wp_customize->add_section( 'theme_options_alert', array(
		'title' => __('Announcement or Alert', 'hwcoe-ufl'),
		'panel' => 'theme_options',
	));
	
	$wp_customize->add_setting( 'actionitem_text', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ));
	$wp_customize->add_setting( 'actionitem_heading', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ));
	$wp_customize->add_setting( 'actionitem_url', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ));
	$wp_customize->add_setting( 'actionitem_altcolor', array( 'default' => 0, 'sanitize_callback' => 'absint' ));
	
	$wp_customize->add_control( 'actionitem_text', array(
		'label' => __('Announcement/Alert Text', 'hwcoe-ufl'),
		'description' => __('The Announcement/Alert text is an alert message below your main menu. Leave it blank to remove it.', 'hwcoe-ufl'),
		'section' => 'theme_options_alert',
		'type' => 'text',
	));
	$wp_customize->add_control( 'actionitem_url', array(
		'label' => __('Announcement/Alert URL', 'hwcoe-ufl'),
		'description' => __("Where visitors are taken when they click on your Announcement/Alert link", 'hwcoe-ufl'),
		'section' => 'theme_options_alert',
		'type' => 'text',
	));
	$wp_customize->add_control( 'actionitem_heading', array(
		'label' => __('Announcement/Alert Heading', 'hwcoe-ufl'),
		'description' => __('The Announcement/Alert heading is above the alert message (optional)', 'hwcoe-ufl'),
		'section' => 'theme_options_alert',
		'type' => 'text',
	));
	$wp_customize->add_control( 'actionitem_altcolor', array(
		'label' => __('Announcement/Alert Alternate Color', 'hwcoe-ufl'),
		'description' => __('This is an alternate color (red) used for warnings and emergency alerts.', 'hwcoe-ufl'),
		'section' => 'theme_options_alert',
		'type' => 'checkbox',
	));
	
	// Social 
	$wp_customize->add_section( 'theme_options_social', array(
		'title' => __('Social Media', 'hwcoe-ufl'),
		'description' => __("Enter your organization's social media URLs (e.g. https://...). Social media icons are displayed in the header and footer", 'hwcoe-ufl'),
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
		'label' => __('Facebook URL', 'hwcoe-ufl'),
		'description' => __("", 'hwcoe-ufl'),
		'section' => 'theme_options_social',
		'type' => 'text',
	));
	$wp_customize->add_control( 'twitter_url', array(
		'label' => __('X (formerly Twitter) URL', 'hwcoe-ufl'),
		'description' => __("", 'hwcoe-ufl'),
		'section' => 'theme_options_social',
		'type' => 'text',
	));
	$wp_customize->add_control( 'youtube_url', array(
		'label' => __('YouTube URL', 'hwcoe-ufl'),
		'description' => __("", 'hwcoe-ufl'),
		'section' => 'theme_options_social',
		'type' => 'text',
	));
	$wp_customize->add_control( 'linkedin_url', array(
		'label' => __('LinkedIn URL', 'hwcoe-ufl'),
		'description' => __("", 'hwcoe-ufl'),
		'section' => 'theme_options_social',
		'type' => 'text',
	));
	$wp_customize->add_control( 'instagram_url', array(
		'label' => __('Instagram URL', 'hwcoe-ufl'),
		'description' => __("", 'hwcoe-ufl'),
		'section' => 'theme_options_social',
		'type' => 'text',
	));
	$wp_customize->add_control( 'flickr_url', array(
		'label' => __('Flickr URL', 'hwcoe-ufl'),
		'description' => __("", 'hwcoe-ufl'),
		'section' => 'theme_options_social',
		'type' => 'text',
	));
	$wp_customize->add_control( 'feed_url', array(
		'label' => __('News Feed URL', 'hwcoe-ufl'),
		'description' => __("", 'hwcoe-ufl'),
		'section' => 'theme_options_social',
		'type' => 'text',
	));
	
	// Custom Attributes
		
}
add_action('customize_register','hwcoe_ufl_customize_register');

