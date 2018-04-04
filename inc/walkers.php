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
