<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width,initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class('loading'); // Enable JS transitions ?>>
<?php include get_stylesheet_directory() . '/inc/google-analytics.php'; ?>

<header>
<a href="#main" id="skip-link" class="visuallyhidden focusable">Skip to main content</a>
<div class="header unit">
      <a href="http://ufl.edu/" class="logo">
		<span class="icon-svg logo-uf"><svg><use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/logo-uf.svg#Layer_1"></use></svg></span>
      </a>
    <div class="site-title">
		<h1>
		  <a href="<?php echo site_url('/'); ?>">
			<span class=""><?php echo bloginfo('name'); ?></span>
		  </a>
		  </h1>	
	</div>
	
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
  	</div>
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
				
			?>
  		</ul>
		<ul class="social-nav">
			<?php hwcoe_ufl_socialnetworks(); ?>
		</ul>
  		<div class="audience-nav-wrap">
			<?php 
            if ( has_nav_menu( 'audience_nav' ) ): ?>
                <a href="#" class="cur-audience"><?php echo hwcoe_ufl_nav_menu_name_by_location( 'audience_nav' ); ?></a>
                <span class="arw-right icon-svg"><svg><use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/spritemap.svg#arw-down"></use></svg></span>
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
	  	</div>
  	</div>
    
  	<a href="#" class="btn-show-aux">
			<span class="icon-svg icon-menu">
	    	<svg>
	      	<use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/spritemap.svg#menu"></use>
	    	</svg>
	    </span>
			<span class="icon-svg icon-close">
	    	<svg>
	      	<use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/spritemap.svg#close"></use>
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
      	<use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/spritemap.svg#menu"></use>
    	</svg>
    </span>
		<span class="icon-svg icon-close" role="button">
    	<svg>
      	<use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/spritemap.svg#close"></use>
    	</svg>
    </span>
  </a>
  
  </div><!-- .header.unit -->
</header>
<!-- END HEADER -->
