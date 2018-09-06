<?php
/**
 * Gravity Forms custom code and enhancements
 *
 * @package HWCOE_UFL
 * @since 1.3.1
 */

/**
/* Gravity Forms maintenance mode
*/
function gf_maintenance_mode( $form_string, $form ) {
    $form_string = '<p class="lead">Forms have been temporarily disabled for scheduled maintenance. Please check back later.</p>';

    return $form_string;
}
// Enables maintenance mode - uncomment to use
// add_filter( 'gform_get_form_filter', 'gf_maintenance_mode', 10, 2 );

