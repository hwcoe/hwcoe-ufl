<?php
/**
 * Navigation functions
 *
 * @package HWCOE_UFL
 */
 

/**
 * Displays breadcrumb navigation for current page
 * 
 * @since 0.1.0
 */
function hwcoe_ufl_breadcrumbs() {
	global $post;

	// Do not display on the homepage
	if ( !is_front_page() ) {

		$breadcrumb = '<ul class="breadcrumb-wrap">';

		// Link to home page
		$breadcrumb .= '<li class="item-home"><a class="bread-link bread-home" href="' . get_home_url() . '" title="Home">Home</a></li>';
	
		$post_ancestors = get_post_ancestors($post);

		if ( $post_ancestors) {
			$post_ancestors = array_reverse($post_ancestors);
			foreach ( $post_ancestors as $crumb_id ){
				$breadcrumb .= '<li><a href="' . get_permalink( $crumb_id ) . '">' . get_the_title( $crumb_id ) . '</a></li>';
			}
		}

		$breadcrumb .= '<li class="item-current item-' . $post->ID . '"><strong>' . get_the_title() . '</strong></li>';
		$breadcrumb .= "</ul>";
		
		echo $breadcrumb;
	}
}

/*
 * Return ID of top Post Parent
 */

function hwcoe_ufl_get_top_page_parent($post){
	global $post;
  $ancestors = $post->ancestors;
  if ($ancestors) {
	return end($ancestors);
  } else {
	return $post->ID;
  }
}
/*
 * Sidebar Output
 */

function hwcoe_ufl_sidebar_navigation($post) {
  $parent_id = hwcoe_ufl_get_top_page_parent( $post );
  $args = array(
	'child_of'     => $parent_id,
	'date_format'  => get_option('date_format'),
	'depth'        => 5,
	'echo'         => 0,
	'link_after'   => '',
	'link_before'  => '',
	'post_type'    => 'page',
	'post_status'  => 'publish',
	'show_date'    => '',
	'sort_column'  => 'menu_order, post_title',
	'sort_order'   => '',
	'title_li'     => '',
	'walker'       => new Walker_Page
  );

  $sidebar = wp_list_pages( $args );
  return $sidebar;
}

/**
 * Page Menu Navigation
 *
 * @return string List of page links
 *
 */
// function hwcoe_ufl_sidebar_navigation() {
// 	global $post;
	
// 	$post_ancestors = get_post_ancestors( $post );
// 	$depth = count($post_ancestors);
// 	$top_page = $post->ID;
	
// 	if ( $depth ){
// 		$top_page = $post_ancestors[0];
// 	}
	
// 	$children = wp_list_pages(array(
// 		'title_li' => '',
// 		'child_of' => $top_page,
// 		'echo' => false,
// 		'depth' => 2,
// 	));
	
// 	return $children;
// }

/**
 * Filter the CSS class for the menu list items <li>
 *
 * @return array Menu item classes
 *
 */
function hwcoe_ufl_nav_classes( $classes, $item, $args ) {
	if ( 'audience_nav' == $args->theme_location ){
		$classes[] = 'audience-link';
	}
	return $classes;
}
add_filter( 'nav_menu_css_class', 'hwcoe_ufl_nav_classes', 10, 3 );



/**
 * Ensure that submenus use the correct classes
 *
 * @return array Menu item classes
 *
 */
function hwcoe_ufl_submenu_args( $args ) {
	$sidebars_widgets = get_option( 'sidebars_widgets' );
	
	return $args;
}
add_filter( 'wp_nav_menu_args', 'hwcoe_ufl_submenu_args' );



