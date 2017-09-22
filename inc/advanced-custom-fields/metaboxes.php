<?php
/**
 * Hide the ACF dashboard menu from end users - disable during development
 *
 * @since 0.2.5
 */
define( 'ACF_LITE', true );

/**
 * Enqueue admin scripts and styles.
 * 
 * @since 0.5.1
 */
function ufclas_ufl_2015_metabox_styles_scripts( $hook ) {
	if ( 'post.php' != $hook ) {
        return;
    }
	wp_enqueue_style('metaboxes', get_template_directory_uri() . '/inc/advanced-custom-fields/metaboxes.css', array(), null);
}
add_action( 'admin_enqueue_scripts', 'ufclas_ufl_2015_metabox_styles_scripts' );

/**
 * Add the ACF exported metaboxes - cannot be edited in dashboard
 */
 
/**
 * Page Options
 *
 * @since 0.2.5
 */
register_field_group(array (
	'id' => 'acf_page-options',
	'title' => 'Page Options',
	'fields' => array (
		array (
			'key' => 'field_57a905164b0d2',
			'label' => 'Subtitle Text',
			'name' => 'custom_meta_page_subtitle',
			'type' => 'text',
			'instructions' => 'Enter the text that will appear as a secondary title',
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'formatting' => 'none',
			'maxlength' => '',
		),
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
 * @since 0.2.5
 */
register_field_group(array (
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
				'UFAD Group' => 'UFAD Group',
			),
			'default_value' => 'Public',
			'allow_null' => 0,
			'multiple' => 0,
		),
		array (
			'key' => 'field_57a8f8732479c',
			'label' => 'UFAD Groups',
			'name' => 'custom_meta_visitor_auth_groups',
			'type' => 'text',
			'instructions' => 'Enter the name(s) of the UFAD Groups allowed to access this page separated by commas.',
			'conditional_logic' => array (
				'status' => 1,
				'rules' => array (
					array (
						'field' => 'field_57a8f8512479b',
						'operator' => '==',
						'value' => 'UFAD Group',
					),
				),
				'allorany' => 'all',
			),
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
 * Post Featured Content Slider Options
 *
 * @since 0.2.5
 */
register_field_group(array (
	'id' => 'acf_post-featured-content-slider-options',
	'title' => 'Post Featured Content Slider Options',
	'fields' => array (
		array (
			'key' => 'field_57a8f72dd5615',
			'label' => 'Button Text',
			'name' => 'custom_meta_featured_content_button_text',
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
				1 => 'Image will use 100% of the allowed width. Recommended size is 1140px x 399px',
			),
			'default_value' => 0,
			'layout' => 'vertical',
		),
		array (
			'key' => 'field_57a8f7a8d5618',
			'label' => 'Disable Image Captions',
			'name' => 'custom_meta_featured_content_disable_captions',
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

/**
 * Post Options
 *
 * @since 0.2.5
 */
register_field_group(array (
	'id' => 'acf_post-options',
	'title' => 'Post Options',
	'fields' => array (
		array (
			'key' => 'field_57a8f7d62ec9d',
			'label' => 'Subtitle Text',
			'name' => 'custom_meta_post_subtitle',
			'type' => 'text',
			'instructions' => 'Enter the text that will appear as a secondary title',
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'formatting' => 'none',
			'maxlength' => '',
		),
		array (
			'key' => 'field_57a8f7e32ec9e',
			'label' => 'Title Override Text',
			'name' => 'custom_meta_post_title_override',
			'type' => 'text',
			'instructions' => 'Enter the text that will appear as the page title shown at the top of the content section of the page template',
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'formatting' => 'none',
			'maxlength' => '',
		),
		array (
			'key' => 'field_57a8fbede675d',
			'label' => 'Hide Featured Image',
			'name' => 'custom_meta_post_remove_featured',
			'type' => 'checkbox',
			'choices' => array (
				1 => 'Hide the featured image from single post view',
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


/**
 * Landing Page Options 
 *
 * @since 0.6.0
 */
register_field_group(array (
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
				'value' => 'page-templates/landing-page.php',
				'order_no' => 0,
				'group_no' => 0,
			),
		),
		array (
			array (
				'param' => 'page_template',
				'operator' => '==',
				'value' => 'page-templates/landing-page-full-width.php',
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
	'menu_order' => 5,
));

