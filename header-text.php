<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class('loading'); // Enable JS transitions ?>>
	<?php include get_template_directory() . '/inc/google-analytics.php'; ?>

	<header>
		<a href="#main" id="skip-link" class="visuallyhidden focusable">Skip to main content</a>
		<div class="header unit">
			<a href="http://ufl.edu/" class="logo">
				<span class="icon-svg logo-uf">
					<svg>
						<use xlink:href="<?php echo get_template_directory_uri(); ?>/img/spritemap.svg#logo-uf"></use>
						<span class="visuallyhidden">University of Florida</span>
					</svg>
				</span>
			</a>
			<div class="site-title">

				<h1 class="title-with-tagline"><a href="<?php echo site_url('/'); ?>"><?php echo bloginfo('name'); ?></a></h1>	
				
				<?php if ( get_theme_mod('tagline_display', 0) ): // if site tagline display is turned on ?>
				<h2><?php echo bloginfo('description'); ?></h2>	
				<?php endif; ?>
			</div> <!-- /site-title -->
			<div class="menu-wrap">
				<div class="main-menu-wrap">
					<nav role="navigation" aria-label="<?php _e( 'Main Menu', 'hwcoe-ufl' ); ?>">
						<?php 
							wp_nav_menu( array( 
								'theme_location' => 'main_menu',
								'container' => '',
								'depth' => 2, 
								'walker' => new hwcoe_ufl_main_nav_menu(),
								'fallback_cb' => 'hwcoe_ufl_main_nav_menu::fallback',
							));
						?>
					</nav>
				</div><!-- /main-menu-wrap -->

				<?php get_template_part( 'template-parts/menu', 'aux' );  ?>
				
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
			</div><!-- /menu-wrap -->

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

		</div><!-- .header.unit -->
	</header>
<!-- END HEADER -->
	<div class="print-header">
		<h1><?php echo bloginfo('name'); ?></h1>
		<h2><?php echo bloginfo('description'); ?></h2>
	</div>
