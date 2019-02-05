<?php
/**
 * Enqueue admin scripts and styles.
 */
function hwcoe_ufl_metabox_styles_scripts( $hook ) {
	if ( 'post.php' != $hook ) {
        return;
    }
	wp_enqueue_style('metaboxes', get_template_directory_uri() . '/inc/advanced-custom-fields/metaboxes.css', array(), null);
}
add_action( 'admin_enqueue_scripts', 'hwcoe_ufl_metabox_styles_scripts' );

/**
 *	Add the ACF exported field groups - groups cannot be edited in dashboard
 *	Displays field groups across multisite without having to import them
 *	1. Page Options
 *	2. Page Visibility Options
 *	3. Latest Posts Slider Options
 */

/**
 * Page Options
 *
 */
acf_add_local_field_group(array (
	'id' => 'acf_page-options',
	'title' => 'Page Options',
	'fields' => array (
		array (
			'key' => 'field_57a905164badf',
			'label' => 'Title Override Text',
			'name' => 'custom_meta_page_title_override',
			'type' => 'text',
			'instructions' => 'Enter the text that will appear as the page title shown at the top of the content section of the page template',
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'formatting' => 'none',
			'maxlength' => '',
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'page',
				'order_no' => 0,
				'group_no' => 0,
			),
			array (
				'param' => 'page_template',
				'operator' => '!=',
				'value' => 'page-templates/home-page.php',
				'order_no' => 1,
				'group_no' => 0,
			),
			array (
				'param' => 'page_template',
				'operator' => '!=',
				'value' => 'page-templates/blank.php',
				'order_no' => 1,
				'group_no' => 0,
			),
		),
	),
	'options' => array (
		'position' => 'normal',
		'layout' => 'default',
		'hide_on_screen' => array (
			0 => 'custom_fields',
		),
	),
	'menu_order' => 0,
));

/**
 * Page Visibility Options
 *
 */
acf_add_local_field_group(array (
	'id' => 'acf_page-visibility-options',
	'title' => 'Page Visibility Options',
	'fields' => array (
		array (
			'key' => 'field_57a8f8512479b',
			'label' => 'Visitor Authentication Level',
			'name' => 'custom_meta_visitor_auth_level',
			'type' => 'select',
			'instructions' => 'Choose authentication level for visitors of this page. GatorLink Users only works if Shibboleth is configured properly.',
			'choices' => array (
				'Public' => 'Public',
				'WordPress Users' => 'WordPress Users',
				'GatorLink Users' => 'GatorLink Users',
			),
			'default_value' => 'Public',
			'allow_null' => 0,
			'multiple' => 0,
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'page',
				'order_no' => 0,
				'group_no' => 0,
			),
			array (
				'param' => 'page_template',
				'operator' => '==',
				'value' => 'page-templates/membersonly.php',
				'order_no' => 1,
				'group_no' => 0,
			),
		),
	),
	'options' => array (
		'position' => 'normal',
		'layout' => 'default',
		'hide_on_screen' => array (
			0 => 'custom_fields',
		),
	),
	'menu_order' => 0,
));

/**
 * Landing Page Options 
 */
acf_add_local_field_group(array (
	'id' => 'acf_landing-page-options',
	'title' => 'Landing Page Options',
	'fields' => array (
		array (
			'key' => 'field_582cc265f8a2c',
			'label' => 'Background Image Height',
			'name' => 'custom_meta_image_height',
			'type' => 'select',
			'instructions' => 'If the page has a Featured Image, this sets the height of the hero image.',
			'choices' => array (
				'large' => 'Large',
				'medium' => 'Medium',
				'half' => 'Small',
			),
			'default_value' => 'large',
			'allow_null' => 0,
			'multiple' => 0,
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'page_template',
				'operator' => '==',
				'value' => 'page-templates/container-landing.php',
				'order_no' => 0,
				'group_no' => 0,
			),
		),
		array (
			array (
				'param' => 'page_template',
				'operator' => '==',
				'value' => 'page-templates/no-container-landing.php',
				'order_no' => 0,
				'group_no' => 1,
			),
		),
	),
	'options' => array (
		'position' => 'normal',
		'layout' => 'default',
		'hide_on_screen' => array (
			0 => 'custom_fields',
		),
	),
	'menu_order' => 0,
));

/**
 * Latest Posts Slider Options
 */

if ( get_option( 'page_for_posts' ) || 'posts' == get_option( 'show_on_front' ) ) {
	acf_add_local_field_group(array (
		'id' => 'acf_latest-posts-slider-options',
		'title' => 'Latest Posts Slider Options',
		'fields' => array (
			array (
				'key' => 'field_57a8f72dd5615',
				'label' => 'Button Text',
				'name' => 'custom_meta_button_text',
				'type' => 'text',
				'instructions' => 'Enter the text that will appear as a button',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (	
				'key' => 'field_57a8f790d5617',
				'label' => 'Full Width Image',
				'name' => 'custom_meta_image_type',
				'type' => 'checkbox',
				'choices' => array (
					1 => 'Image will use 100% of the allowed width in the slider. Recommended size is 1140px x 399px',
				),
				'default_value' => 1,
				'layout' => 'vertical',
			),
			array (
				'key' => 'field_57a8f7a8d5618',
				'label' => 'Disable Image Caption',
				'name' => 'custom_meta_slider_disable_caption',
				'type' => 'checkbox',
				'choices' => array (
					1 => 'Disable the caption box from appearing on <em>full width images</em> (contains title, excerpt)',
				),
				'default_value' => 0,
				'layout' => 'vertical',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'custom_fields',
			),
		),
		'menu_order' => 0,
	)); 
}