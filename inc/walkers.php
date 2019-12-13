<?php
/**
 * Main Menu Walker and filters
 */
class hwcoe_ufl_main_nav_menu extends Walker_Nav_Menu {

    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
		$output .= "\n$indent<div class=\"dropdown\">\n<ul>";
    }
	
	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n</div>";
	}

	/**
	 * Menu Fallback
	 * =============
	 * If this function is assigned to the wp_nav_menu's fallback_cb variable
	 * and a manu has not been assigned to the 'Main Menu' theme location in the WordPress
	 * menu manager, the function will display a page menu.
	 *
	 */
	public static function fallback() {

		// wp_list_pages
		$args = array(
			'depth'        => 2,
			'echo'         => 0,
			'link_before'  => '<span>',
			'link_after'   => '</span>',
			'title_li'     => '',
			'walker'		=> new hwcoe_ufl_main_nav_fallback,
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
	}
	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'hwcoe_ufl_main_menu_link_attrs', 10, 4);

// fallback page menu if no main nav menu is set
class hwcoe_ufl_main_nav_fallback extends Walker_Page {

	public function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
		$output .= "\n$indent<div class=\"dropdown\">\n<ul>";
    }
	
	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n</div>";
	}

}
