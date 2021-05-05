<?php

/**
 * Card Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'card-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'card';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$headline = get_field('card_headline') ?: 'Headline';
$image = get_field('card_image') ?: 295;
$content = get_field('card_content') ?: 'Content';
$button_text = get_field('card_button_text') ?: 'Button Text';
$button_url = get_field('card_button_url') ?: 'Button URL';
$new_window = get_field('card_link_new_window') ?: 'Open in new window';

?>

<div class="col-sm-12 col-md-4" id="<?php echo esc_attr($id); ?>">
	<div class="<?php echo esc_attr($className); ?>">

    <div class="card-image">
		 <?php echo wp_get_attachment_image( $image, 'full' ); ?>
		</div>
		<?php echo '<h2>' . esc_html($headline) . '</h2>'; ?>
		<?php echo wp_kses_post( $content ); ?>
	</div>
</div>
