<?php
/**
 * The template for the contact_footer widget area.
 *
 * @package HWCOE_UFL
 * @since 0.3.0
 */
?>
<div id="footer-right">

<?php if ( is_active_sidebar( 'footer_right' ) ) : ?>

	<div class="widget-area">
        <?php dynamic_sidebar( 'footer_right' ); ?>
    </div><!-- .widget-area -->

<?php endif; ?>

</div><!-- #footer-right -->