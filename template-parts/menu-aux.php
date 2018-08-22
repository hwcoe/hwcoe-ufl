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
			</ul>
			<ul class="social-nav">
				<?php hwcoe_ufl_socialnetworks(); ?>
			</ul>

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
		
		<a href="#" class="btn-show-aux">
			<span class="icon-svg icon-menu">
				<svg>
					<use xlink:href="<?php echo get_template_directory_uri(); ?>/img/spritemap.svg#menu"></use>
				</svg>
			</span>
			<span class="icon-svg icon-close">
				<svg>
					<use xlink:href="<?php echo get_template_directory_uri(); ?>/img/spritemap.svg#close"></use>
				</svg>
			</span>
		</a>
			<?php hwcoe_ufl_get_search_form( 'menu' ); ?>
	</div>

	<div class="mobile-dropdown-wrap"></div>
	
	<?php get_template_part( 'template-parts/content', 'alert-small' );  ?>
	
	<?php hwcoe_ufl_get_search_form( 'mobile' ); ?>
	
	<a href="#" class="btn-menu" role="button" aria-haspopup="true" aria-expanded="false">
		<span class="icon-svg icon-menu">
			<svg>
				<use xlink:href="<?php echo get_template_directory_uri(); ?>/img/spritemap.svg#menu"></use>
			</svg>
		</span>
		<span class="icon-svg icon-close" role="button">
			<svg>
				<use xlink:href="<?php echo get_template_directory_uri(); ?>/img/spritemap.svg#close"></use>
			</svg>
		</span>
	</a>
	
