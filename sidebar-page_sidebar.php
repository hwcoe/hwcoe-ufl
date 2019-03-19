<?php
/**
 * The page sidebar.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package HWCOE_UFL
 */

$hwcoe_ufl_sidebar_nav = hwcoe_ufl_sidebar_navigation($post);

// Display only if a page menu or Page Left sidebar exists
if ( empty( $hwcoe_ufl_sidebar_nav ) && !is_active_sidebar( 'page_sidebar' ) ){
	return;
} 
?>
<div class="col-md-3">
	
	<?php if ( !empty( $hwcoe_ufl_sidebar_nav ) ): ?>
	
	<div class="ul sidenav">
	  <li class="btn-mobile-toggle" aria-hidden="true" role="presentation"><a href="#">Pages <span class="arw-right icon-svg"><svg>
		<use xlink:href="<?php echo get_template_directory_uri(); ?>/img/spritemap.svg#arw-right"></use>
		</svg></span></a></li>
	  <?php echo $hwcoe_ufl_sidebar_nav; ?>
	</div><!-- .sidenav -->
	
	<?php endif; ?>
	
	<?php if ( is_active_sidebar( 'page_sidebar' ) ): ?>
	
		<div id="page-sidebar" class="widget-area" role="complementary">
			<?php dynamic_sidebar( 'page_sidebar' ); ?>
		</div><!-- page_sidebar -->    
	
	<?php endif; ?>

</div>