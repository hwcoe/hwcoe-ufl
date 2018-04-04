<?php
 /**
 * Register Shortcode UI for UFL Landing Page Double Image
 * 
 */
function ufclas_ufl_2015_register_landing_double() {
	
	// Define the UI for attributes of the shortcode. 
	$shortcode_ui_fields = array(
		array(
			'label'		=> esc_html__( 'Headline', 'hwcoe-ufl' ),
			'description' 	=> esc_html__('Heading to display above the content, optional', 'hwcoe-ufl'),
			'attr' 		=> 'headline',
			'type' 		=> 'text',
		),
		array(
			'label'		=> esc_html__( 'Primary Image', 'hwcoe-ufl' ),
			'attr' 		=> 'image1',
			'type' 		=> 'attachment',
			'libraryType' 	=> array( 'Image' ),
			'addButton'		=> esc_html__( 'Select Image', 'hwcoe-ufl' ),
			'frameTitle'	=> esc_html__( 'Select Primary Image', 'hwcoe-ufl' ),
		),
		array(
			'label'		=> esc_html__( 'Secondary Image', 'hwcoe-ufl' ),
			'attr' 		=> 'image2',
			'type' 		=> 'attachment',
			'libraryType' 	=> array( 'Image' ),
			'addButton'		=> esc_html__( 'Select Image', 'hwcoe-ufl' ),
			'frameTitle'	=> esc_html__( 'Select Secondary Image', 'hwcoe-ufl' ),
		),
	);
	
	// Define the Shortcode UI arguments
	$shortcode_ui_args = array(
		'label' 			=> esc_html__('UFL Landing Page Double Image', 'hwcoe-ufl'),
		'listItemImage' 	=> 'dashicons-format-image',
		'post_type' 		=> array('page'),
		'inner_content' 	=> array(
			'label' 		=> esc_html__('Content', 'hwcoe-ufl'),
			'description' 	=> esc_html__('Include text to display within the Landing Page Double Image', 'hwcoe-ufl'),
		),
		'attrs' 			=> $shortcode_ui_fields,
	);
	
	shortcode_ui_register_for_shortcode( 'ufl-landing-page-double-image', $shortcode_ui_args );
}
add_action( 'register_shortcode_ui', 'ufclas_ufl_2015_register_landing_double' );

 /**
 * Register Shortcode UI for Landing Page Hero
 * 
 */
function ufclas_ufl_2015_register_landing_hero() {
	
	// Define the UI for attributes of the shortcode. 
	$shortcode_ui_fields = array(
		array(
			'label'		=> esc_html__( 'Headline', 'hwcoe-ufl' ),
			'description' 	=> esc_html__('Heading to display over the background image', 'hwcoe-ufl'),
			'attr' 		=> 'headline',
			'type' 		=> 'text',
		),
		array(
			'label'		=> esc_html__( 'Background Image', 'hwcoe-ufl' ),
			'attr' 		=> 'image',
			'type' 		=> 'attachment',
			'libraryType' 	=> array( 'Image' ),
			'addButton'		=> esc_html__( 'Select Image', 'hwcoe-ufl' ),
			'frameTitle'	=> esc_html__( 'Select Background Image', 'hwcoe-ufl' ),
		),
		array(
			'label'		=> esc_html__( 'Background Image Height', 'hwcoe-ufl' ),
			'attr' 		=> 'image_height',
			'type' 		=> 'select',
			'options' 	=> array(
							'large' => esc_html__( 'Large', 'hwcoe-ufl' ),
							'medium' => esc_html__( 'Medium', 'hwcoe-ufl' ),
							'half' => esc_html__( 'Small', 'hwcoe-ufl' ),
			),
		),
		array(
			'label'		=> esc_html__( 'Button Text', 'hwcoe-ufl' ),
			'description' 	=> esc_html__('Displayed within the button', 'hwcoe-ufl'),
			'attr' 		=> 'button_text',
			'type' 		=> 'text',
		),
		array(
			'label'		=> esc_html__( 'Button Link', 'hwcoe-ufl' ),
			'description' 	=> esc_html__('URL to visit when button is clicked.', 'hwcoe-ufl'),
			'attr' 		=> 'button_link',
			'type' 		=> 'url',
			'meta' 		=> array(
							'placeholder' => esc_html__( 'http:// or https://', 'hwcoe-ufl' ),
			),
		),
	);
	
	// Define the Shortcode UI arguments
	$shortcode_ui_args = array(
		'label' 			=> esc_html__('UFL Landing Page Hero Image', 'hwcoe-ufl'),
		'listItemImage' 	=> 'dashicons-format-image',
		'post_type' 		=> array('page'),
		'inner_content' 	=> array(
			'label' 		=> esc_html__('Content', 'hwcoe-ufl'),
			'description' 	=> esc_html__('Include text to display below the Landing Page Hero Image', 'hwcoe-ufl'),
		),
		'attrs' 			=> $shortcode_ui_fields,
	);
	
	shortcode_ui_register_for_shortcode( 'ufl-landing-page-hero', $shortcode_ui_args );
}
add_action( 'register_shortcode_ui', 'ufclas_ufl_2015_register_landing_hero' );

 /**
 * Register Shortcode UI for Breaker
 * 
 */
function ufclas_ufl_2015_register_breaker() {
	
	// Define the UI for attributes of the shortcode. 
	$shortcode_ui_fields = array(
		array(
			'label'		=> esc_html__( 'Headline', 'hwcoe-ufl' ),
			'description' 	=> esc_html__('Heading to display over the background image', 'hwcoe-ufl'),
			'attr' 		=> 'headline',
			'type' 		=> 'text',
		),
		array(
			'label'		=> esc_html__( 'Background Image', 'hwcoe-ufl' ),
			'attr' 		=> 'image',
			'type' 		=> 'attachment',
			'libraryType' 	=> array( 'Image' ),
			'addButton'		=> esc_html__( 'Select Image', 'hwcoe-ufl' ),
			'frameTitle'	=> esc_html__( 'Select Background Image', 'hwcoe-ufl' ),
		),
		array(
			'label'		=> esc_html__( 'Hide Button', 'hwcoe-ufl' ),
			'attr' 		=> 'hide_button',
			'type' 		=> 'checkbox',
		),
		array(
			'label'		=> esc_html__( 'Button Text', 'hwcoe-ufl' ),
			'description' 	=> esc_html__('Displayed within the button', 'hwcoe-ufl'),
			'attr' 		=> 'button_text',
			'type' 		=> 'text',
		),
		array(
			'label'		=> esc_html__( 'Button Link', 'hwcoe-ufl' ),
			'description' 	=> esc_html__('URL to visit when button is clicked.', 'hwcoe-ufl'),
			'attr' 		=> 'button_link',
			'type' 		=> 'url',
			'meta' 		=> array(
							'placeholder' => esc_html__( 'http:// or https://', 'hwcoe-ufl' ),
			),
		),
	);
	
	// Define the Shortcode UI arguments
	$shortcode_ui_args = array(
		'label' 			=> esc_html__('UFL Breaker', 'hwcoe-ufl'),
		'listItemImage' 	=> 'dashicons-format-image',
		'post_type' 		=> array('page'),
		'inner_content' 	=> array(
			'label' 		=> esc_html__('Content', 'hwcoe-ufl'),
			'description' 	=> esc_html__('full width background image with a headline, text, and butto', 'hwcoe-ufl'),
		),
		'attrs' 			=> $shortcode_ui_fields,
	);
	
	shortcode_ui_register_for_shortcode( 'ufl-breaker', $shortcode_ui_args );
}
add_action( 'register_shortcode_ui', 'ufclas_ufl_2015_register_breaker' );

 /**
 * Register Shortcode UI for Content with Left Image and Caption
 * 
 * @link http://webservices.it.ufl.edu/terminalfour/uf-2015-template/content-types/content-with-list-and-left-image-with-caption/
 */
function ufclas_ufl_2015_register_content_image_left() {
	
	// Define the UI for attributes of the shortcode. 
	$shortcode_ui_fields = array(
		array(
			'label'		=> esc_html__( 'Headline', 'hwcoe-ufl' ),
			'description' 	=> esc_html__('Heading to display over the background image', 'hwcoe-ufl'),
			'attr' 		=> 'headline',
			'type' 		=> 'text',
		),
		array(
			'label'		=> esc_html__( 'Image', 'hwcoe-ufl' ),
			'attr' 		=> 'image',
			'type' 		=> 'attachment',
			'libraryType' 	=> array( 'Image' ),
			'addButton'		=> esc_html__( 'Select Image', 'hwcoe-ufl' ),
			'frameTitle'	=> esc_html__( 'Select Image', 'hwcoe-ufl' ),
		),
		array(
			'label'		=> esc_html__( 'Image Caption', 'hwcoe-ufl' ),
			'description' 	=> esc_html__('A caption to overlay the image, optional', 'hwcoe-ufl'),
			'attr' 		=> 'caption',
			'type' 		=> 'textarea',
		),
	);
	
	// Define the Shortcode UI arguments
	$shortcode_ui_args = array(
		'label' 			=> esc_html__('UFL Content Image Left', 'hwcoe-ufl'),
		'listItemImage' 	=> 'dashicons-format-image',
		'post_type' 		=> array('page'),
		'inner_content' 	=> array(
			'label' 		=> esc_html__('Content', 'hwcoe-ufl'),
			'description' 	=> esc_html__('Content with List and Left Image with Caption', 'hwcoe-ufl'),
		),
		'attrs' 			=> $shortcode_ui_fields,
	);
	
	shortcode_ui_register_for_shortcode( 'ufl-content-image-left', $shortcode_ui_args );
}
add_action( 'register_shortcode_ui', 'ufclas_ufl_2015_register_content_image_left' );

/**
 * Register Shortcode UI for Content with Left Image and Caption
 * 
 * @link http://webservices.it.ufl.edu/terminalfour/uf-2015-template/content-types/content-with-list-and-left-image-with-caption/
 */
function ufclas_ufl_2015_register_content_image_right() {
	
	// Define the UI for attributes of the shortcode. 
	$shortcode_ui_fields = array(
		array(
			'label'		=> esc_html__( 'Headline', 'hwcoe-ufl' ),
			'description' 	=> esc_html__('Heading for the section, optional', 'hwcoe-ufl'),
			'attr' 		=> 'headline',
			'type' 		=> 'text',
		),
		array(
			'label'		=> esc_html__( 'Image', 'hwcoe-ufl' ),
			'attr' 		=> 'image',
			'type' 		=> 'attachment',
			'libraryType' 	=> array( 'Image' ),
			'addButton'		=> esc_html__( 'Select Image', 'hwcoe-ufl' ),
			'frameTitle'	=> esc_html__( 'Select Image', 'hwcoe-ufl' ),
		),
		array(
			'label'		=> esc_html__( 'Label', 'hwcoe-ufl' ),
			'description' 	=> esc_html__('Category title for the content section, optional', 'hwcoe-ufl'),
			'attr' 		=> 'label',
			'type' 		=> 'text',
		),
	);
	
	// Define the Shortcode UI arguments
	$shortcode_ui_args = array(
		'label' 			=> esc_html__('UFL Content Image Right', 'hwcoe-ufl'),
		'listItemImage' 	=> 'dashicons-format-image',
		'post_type' 		=> array('page'),
		'inner_content' 	=> array(
			'label' 		=> esc_html__('Content', 'hwcoe-ufl'),
			'description' 	=> esc_html__('Content with Right Image and Category', 'hwcoe-ufl'),
		),
		'attrs' 			=> $shortcode_ui_fields,
	);
	
	shortcode_ui_register_for_shortcode( 'ufl-content-image-right', $shortcode_ui_args );
}
add_action( 'register_shortcode_ui', 'ufclas_ufl_2015_register_content_image_right' );


 /**
 * Register Shortcode UI for Breaker with Cards
 * 
 * @link http://webservices.it.ufl.edu/terminalfour/uf-2015-template/content-types/cards/
 */
function ufclas_ufl_2015_register_breaker_cards() {
	
	// Get category select options
	$category_options = array();
	$categories = get_categories();
	
	if( !empty( $categories ) ){ 
		foreach($categories as $category){
			$category_options[ $category->term_id ] = $category->name;		
		}
	}
	
	// Define the UI for attributes of the shortcode.
	$shortcode_ui_fields = array(
		array(
			'label'		=> esc_html__( 'Background Image', 'hwcoe-ufl' ),
			'attr' 		=> 'image',
			'type' 		=> 'attachment',
			'libraryType' 	=> array( 'Image' ),
			'addButton'		=> esc_html__( 'Select Image', 'hwcoe-ufl' ),
			'frameTitle'	=> esc_html__( 'Select Background Image', 'hwcoe-ufl' ),
		),
		array(
			'label'		=> esc_html__( 'Post Category', 'hwcoe-ufl' ),
			'attr' 		=> 'category',
			'type' 		=> 'select',
			'options'	=> $category_options,
		),
		array(
			'label'		=> esc_html__( 'Hide Excerpt', 'hwcoe-ufl' ),
			'attr' 		=> 'hide_excerpt',
			'type' 		=> 'checkbox',
		),
		array(
			'label'		=> esc_html__( 'Show Image and Title Links', 'hwcoe-ufl' ),
			'attr' 		=> 'show_links',
			'type' 		=> 'checkbox',
		),
	);
	
	// Define the Shortcode UI arguments
	$shortcode_ui_args = array(
		'label' 			=> esc_html__('UFL Breaker with Cards', 'hwcoe-ufl'),
		'listItemImage' 	=> 'dashicons-format-image',
		'post_type' 		=> array('page'),
		'attrs' 			=> $shortcode_ui_fields,
	);
	
	shortcode_ui_register_for_shortcode( 'ufl-breaker-cards', $shortcode_ui_args );
}
add_action( 'register_shortcode_ui', 'ufclas_ufl_2015_register_breaker_cards' );

function ufclas_ufl_2015_register_image_right_quote() {
	
	// Define the UI for attributes of the shortcode. 
	$shortcode_ui_fields = array(
		array(
			'label'		=> esc_html__( 'Image', 'hwcoe-ufl' ),
			'attr' 		=> 'image',
			'type' 		=> 'attachment',
			'libraryType' 	=> array( 'Image' ),
			'addButton'		=> esc_html__( 'Select Image', 'hwcoe-ufl' ),
			'frameTitle'	=> esc_html__( 'Select Image', 'hwcoe-ufl' ),
		),
	);
	
	// Define the Shortcode UI arguments
	$shortcode_ui_args = array(
		'label' 			=> esc_html__('UFL Image Right Quote', 'hwcoe-ufl'),
		'listItemImage' 	=> 'dashicons-format-image',
		'post_type' 		=> array('post','page'),
		'inner_content' 	=> array(
			'label' 		=> esc_html__('Quote', 'hwcoe-ufl'),
			'description' 	=> esc_html__('Quote that appears to the right of the image', 'hwcoe-ufl'),
		),
		'attrs' 			=> $shortcode_ui_fields,
	);
	
	shortcode_ui_register_for_shortcode( 'ufl-image-right-quote', $shortcode_ui_args );
}
add_action( 'register_shortcode_ui', 'ufclas_ufl_2015_register_image_right_quote' );

