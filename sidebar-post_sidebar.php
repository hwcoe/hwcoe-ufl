<?php
/**
 * The page sidebar.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package HWCOE_UFL
 */

if ( ! is_active_sidebar( 'post_sidebar' ) ): ?>

<div id="post-sidebar" class="widget-area" role="complementary">
    <?php the_widget( 'WP_Widget_Archives', array('title' => __('News Archive', 'hwcoe-ufl'), 'dropdown' => 1) ); ?>
</div><!-- post_sidebar -->

<?php else: ?>

<div id="post-sidebar" class="widget-area" role="complementary">
    <?php dynamic_sidebar( 'post_sidebar' ); ?>
</div><!-- post_sidebar -->

<?php endif; ?>