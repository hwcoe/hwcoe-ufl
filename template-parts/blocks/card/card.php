<?php

/**
 * Card Block Template with InnerBlocks support.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'card-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className", "anchor", and align" values.
$classes = ['card'];
if( !empty( $block['className'] ) )
    $classes = array_merge( $classes, explode( ' ', $block['className'] ) );

if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$anchor = '';
if( !empty( $block['anchor'] ) )
	$anchor = ' id="' . sanitize_title( $block['anchor'] ) . '"';

// Load custom field values.
$card_width = get_field('card_width');
$card_linked = get_field('card_linked');
$card_linked_url = get_field('card_linked_url');


$template = array(
	array('core/image', array(
		'align' => 'center',
		'url' => HWCOE_UFL_IMG_DIR . '/card-header-placeholder.jpg',
		'alt' => '',
	)),
	array('core/heading', array(
		'level' => 2,
		'content' => 'Card Headline Goes Here',
	)),
    array( 'core/paragraph', array(
        'content' => 'Card content goes here',
    )),    
    array( 'core/button', array(
        'url' => '#',
		'text' => 'Edit Button Text and Link URL',
		'linkTarget' => '_blank',
		'borderRadius' => 0,
		'align' => 'center',
    )),

);

?>

<?php if (!is_admin() && $card_linked) { ?>
	<a href="<?php esc_url($card_linked_url); ?>" class="card--linked card-flex">
		<div id="<?php esc_attr($id); ?>">
			<div class="<?php join( ' ', $classes ); ?>" <?php $anchor; ?>>
				<InnerBlocks template="<?php esc_attr( wp_json_encode( $template ) ); ?>" />
			</div>
		</div>
	</a>
	<?php } 
	else { ?>
		<div class="card-flex" id="<?php echo esc_attr($id); ?>">
		    <?php	
			echo '<div class="' . join( ' ', $classes ) . '"' . $anchor . '>';
				echo '<InnerBlocks template="' . esc_attr( wp_json_encode( $template ) ) . '" />';
			echo '</div>';
			?>
		</div>
	<?php 	}

?>