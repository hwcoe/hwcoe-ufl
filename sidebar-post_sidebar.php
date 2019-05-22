<?php
/**
 * The page sidebar.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package HWCOE_UFL
 */

if ( is_active_sidebar( 'post_sidebar' ) ): ?>

<div class="col-md-3">
	<div id="post-sidebar" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'post_sidebar' ); ?>
	</div><!-- post_sidebar -->
</div>

<?php endif; ?>