<?php
/**
 * The page sidebar.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package HWCOE_UFL
 */

if ( ! is_active_sidebar( 'page_right' ) ): 
	return;
endif;
?>

<div class="col-md-3">

<div id="page-right" class="widget-area" role="complementary">
    <?php dynamic_sidebar( 'page_right' ); ?>
</div><!-- page_right -->

</div>