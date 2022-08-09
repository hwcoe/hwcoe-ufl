<?php
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 * @since 0.1.0
 */
function hwcoe_ufl_body_classes( $classes ) {
	$classes[] = 'loading';
	
	if ( is_page_template('page-templates/home-page.php') ) {
		$classes[] = 'homepage';
	}
	// if ( get_theme_mod('disable_global_elements', 0) ){
	// 	$classes[] = 'disable-global';
	// }
	if ( $header_type = get_theme_mod('header_type', 'logo') ){
		$classes[] = 'header-type-' . $header_type;
	}

	return $classes;
}
add_filter( 'body_class', 'hwcoe_ufl_body_classes' );

/**
 * Adds feed link to category title
 * 
 * @since 0.1.0
 */
function hwcoe_ufl_archive_title( $title ){
	if ( is_category() ) {
		$queried_obj = get_queried_object();
		$icon = get_template_directory_uri();
		$icon .= "/img/spritemap.svg#feed";
		$title = sprintf( __( '%s', 'hwcoe-ufl' ), single_cat_title( '', false ) );
		$title .= sprintf('<a href="%s" class="icon-svg icon-feed"><svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="%s"></use></svg><span class="visuallyhidden">%s</span></a>', get_category_feed_link( $queried_obj->term_id ), $icon, $title );
	}
	else {
		$title = str_replace( __('Archives: ', 'hwcoe-ufl'), '', $title);
	}
	return $title;
}
add_filter( 'get_the_archive_title', 'hwcoe_ufl_archive_title' );

/**
 * Change the Read More Text from the default (legacy)
 */
function hwcoe_ufl_excerpt_more( $more ){
	$custom_meta = get_post_custom( get_the_ID() );
	$custom_button_text = ( isset($custom_meta['custom_meta_featured_content_button_text']) )? $custom_meta['custom_meta_featured_content_button_text'][0]:'';
	$label = ( empty($custom_button_text) )? __('Read&nbsp;More', 'hwcoe-ufl'):$custom_button_text;
	return '&hellip; <a href="'. get_permalink() . '" aria-label="Read \"'. get_the_title() . '\" class="read-more">' . $label . '</a>';
}
add_filter('excerpt_more', 'hwcoe_ufl_excerpt_more');
add_filter('the_content_more_link', 'hwcoe_ufl_excerpt_more');

/**
 * Show either the_content or the_excerpt based on whether post contains the <!--more--> tag (legacy)
 */
function hwcoe_ufl_teaser_excerpt( $excerpt ){
	
	global $post;
	$has_teaser = (strpos($post->post_content, '<!--more') !== false);
	if ($has_teaser){
		// Remove extra formatting from the content
		return strip_tags( get_the_content(), '<a><br><br/>' );
	}
	else {
		return $excerpt;
	}
}
add_filter( 'get_the_excerpt', 'hwcoe_ufl_teaser_excerpt', 9, 1);

/**
 * Change the default excerpt length from 55 to 40 words
 *
 * @param int $length Excerpt length.
 * @return int - modified excerpt length.
 */
function hwcoe_ufl_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'hwcoe_ufl_excerpt_length', 999 );

/**
 * Adds support for the title override metabox on pages
 * 
 * @param  string  $title Post title
 * @param  integer $id  Post ID
 * @return string  Post title
 */
function hwcoe_ufl_title( $title, $id ) {
	if ( is_page() ){
		$title_override = get_post_meta( $id, 'custom_meta_page_title_override', true );
	} else if ( is_single() ) {
		$title_override = get_post_meta( $id, 'custom_meta_post_title_override', true );
	}

	$title = ( !empty($title_override) )? esc_html($title_override) : esc_html($title);

	return $title;
}

function hwcoe_ufl_entry_title() {
	// add hwcoe_ufl_title filter for title at the top of the content section of the page template
	add_filter( 'the_title', 'hwcoe_ufl_title', 10, 2 );
	the_title( '<h1 class="entry-title">', '</h1>' ); 
	remove_filter( 'the_title', 'hwcoe_ufl_title', 10, 2 );
}

/**
 * Remove redundant role attribute from post and comment nav
 * @param  string  $template navigation markup template
 * @return string  modified nav markup template
 * @since 2.8.2
 */

function hwcoe_ufl_navigation_template( $template ) {
    $template = '
    <nav class="navigation %1$s" aria-label="%4$s">
		<h2 class="screen-reader-text">%2$s</h2>
		<div class="nav-links">%3$s</div>
	</nav>';

    return $template;
}

add_filter( 'navigation_markup_template', 'hwcoe_ufl_navigation_template' );