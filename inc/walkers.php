<?php
/**
 * Main Menu Walker and filters
 */
class hwcoe_ufl_main_nav_menu extends Walker_Nav_Menu {

    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
		$output .= "\n$indent<div class=\"dropdown\">\n<ul role=\"menu\">";
    }
	
	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n</div>";
	}

	/**
	 * Menu Fallback
	 * =============
	 * If this function is assigned to the wp_nav_menu's fallback_cb variable
	 * and a manu has not been assigned to the theme location in the WordPress
	 * menu manager the function with display nothing to a non-logged in user,
	 * and will add a link to the WordPress menu manager if logged in as an admin.
	 *
	 * @param array $args passed from the wp_nav_menu function.
	 *
	 */
	public static function fallback() {

		// wp_list_pages
		$args = array(
			'date_format'  => get_option('date_format'),
			'depth'        => 2,
			'echo'         => 0,
			'link_before'  => '<span>',
			'link_after'   => '</span>',
			// 'link_before'  => '',
			// 'link_after'   => '',
			'post_type'    => 'page',
			'post_status'  => 'publish',
			'show_date'    => '',
			'sort_column'  => 'menu_order, post_title',
			'sort_order'   => '',
			'title_li'     => '',
		  );

		$output = '<ul id="menu-primary-navigation" class="menu fallback">';

		$output .= wp_list_pages( $args );

		$output .= '</ul>';

		echo $output;

	}
}

function hwcoe_ufl_main_menu_item_args( $args, $item, $depth ){
	if ( ('main_menu' == $args->theme_location) && (0 == $depth) ){
		$args->link_before = '<span>';
		$args->link_after = '</span>';
	}
	return $args;
}
add_filter( 'nav_menu_item_args', 'hwcoe_ufl_main_menu_item_args', 10, 3);

function hwcoe_ufl_main_menu_link_attrs( $atts, $item, $args, $depth = null ){
	if ( ('main_menu' == $args->theme_location) && (0 == $depth) ){
		$atts['class'] = 'main-menu-link';
		$atts['role'] = 'menuitem';
	}
	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'hwcoe_ufl_main_menu_link_attrs', 10, 4);
