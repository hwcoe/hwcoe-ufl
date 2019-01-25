<?php
/**
 * Change the default embed height to 16:9 dimensions
 * 
 * @since 0.1.0
 */

function hwcoe_ufl_embed_defaults( $size, $url ) {

	$width = (int) $GLOBALS['content_width'];
	$height = min( ceil( $width * 0.5625 ), 1000 );
	
	return compact( 'width', 'height' );
}
add_filter( 'embed_defaults', 'hwcoe_ufl_embed_defaults', 2, 10 );

/**
 * Custom image sizes 
 *
 * @since 0.1.0
 */
function hwcoe_ufl_image_sizes(){
	// Latest Posts Slider
	add_image_size('full-width-thumb', 1140, 399, array('center', 'top'));	// Full width recent posts slider
	add_image_size('half-width-thumb', 570, 399, array('right', 'top'));	// Half width recent posts slider

	// available for inserting in pages/posts
	add_image_size('page_header', 780, 274, array('center', 'top'));
	add_image_size('medium-cropped', 310, 275, array('right', 'top'));		// UFL Breaker Cards Thumbnail

	// legacy
	add_image_size('ufl_post_thumb', 600, 210, false);	

}
add_action( 'after_setup_theme', 'hwcoe_ufl_image_sizes' );

/**
 * Show additional sizes in the insert image dialog
 *
 * @param array $sizes	All defined image sizes
 * @since 0.2.5
 */
function hwcoe_ufl_show_custom_sizes( $sizes ) {
	 return array_merge( $sizes, array(
		'medium-cropped' => __( 'Medium (cropped)', 'hwcoe-ufl' ),
		'page_header' => __( 'Subpage Header', 'hwcoe-ufl' ),
	 ) );
}
add_filter( 'image_size_names_choose', 'hwcoe_ufl_show_custom_sizes' );

/**
 * Set a default favicon image
 *
 * @param string $url Site icon image url
 * @param int $size Size of the image
 * @param int $blog_id 
 * @return string Url of the site icon
 * @since 0.1.0
 */
function hwcoe_ufl_icon_url( $url, $size, $blog_id ){
	if ( empty($url) ){
		$url = get_template_directory_uri() . '/favicon.png';
	}
	return $url;
}
add_filter( 'get_site_icon_url', 'hwcoe_ufl_icon_url', 10, 3 );

/**
 * Add the default gallery styles
 *
 * @param boolean $html5 Whether theme supports html5 
 * @return boolean
 * @since 0.1.0
 */
add_filter( 'use_default_gallery_style', function( $html5 ){ return true; } );

/**
 * Add title attribute to gallery image tags
 *
 * @param string $atts attributes to add to tag
 * @param array $attachment data to be written into the media post
 * @return string $atts
 * @since 2.3.0
 */
function hwcoe_ufl_gallery_img_atts( $atts, $attachment ){
	// passes gallery image description to title attribute
	$atts['title'] = $attachment->post_content;
	return $atts;
}
add_filter( 'wp_get_attachment_image_attributes', 'hwcoe_ufl_gallery_img_atts', 10, 2 );
