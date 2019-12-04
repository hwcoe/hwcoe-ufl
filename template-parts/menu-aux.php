<?php
/**
 * Template part for displaying auxiliary nav in the header.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package HWCOE_UFL
 */

?>
		
<div class="aux-menu-wrap">
	<nav aria-label="<?php _e('Global Menu', 'hwcoe-ufl'); ?>">
		<ul class="aux-nav">
			<?php 
			// Audience menu
			if ( has_nav_menu( 'audience_nav' ) ):
				wp_nav_menu( array( 
					'theme_location' => 'audience_nav',
					'items_wrap' => '%3$s',
					'container' => '',
					'depth' => 1,
					'fallback_cb' => false,
				));
			endif;
			
			// Display parent organization link
			hwcoe_ufl_global_parent_organization();
			
			// Global menu
			wp_nav_menu( array( 
				'theme_location' => 'global_menu',
				'items_wrap' => '%3$s',
				'container' => '',
				'depth' => 1,
				'fallback_cb' => false,
			)); 
		?>
		</ul><!-- /aux-nav -->
	</nav>
	<ul class="social-nav">
		<?php hwcoe_ufl_socialnetworks(); ?>
	</ul><!-- /social-nav -->

	<div class="audience-nav-wrap">
		<?php 
			if ( has_nav_menu( 'audience_nav' ) ): ?>
		<a href="#" class="cur-audience"><?php echo hwcoe_ufl_nav_menu_name_by_location( 'audience_nav' ); ?></a>
		<span class="arw-right icon-svg"><svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/img/spritemap.svg#arw-down"></use></svg></span>
			<?php 
				wp_nav_menu( array( 
					'theme_location' => 'audience_nav',
					'items_wrap' => '<ul>%3$s</ul>',
					'container' => '',
					'depth' => 1,
					'fallback_cb' => false,
				));
			endif;
		?>
	</div><!-- /audience-nav-wrap -->
</div><!-- /aux-menu-wrap -->