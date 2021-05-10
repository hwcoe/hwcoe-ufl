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

$template = array(
	array('core/image', array(
		'align' => 'center',
		'url' => 'https://www.eng.ufl.edu/wp-content/uploads/2021/05/card-header-placeholder.jpg',
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
    )),

);
?>

<div class="col-sm-12 col-md-4 card-block" id="<?php echo esc_attr($id); ?>">
    <?php	
	echo '<div class="' . join( ' ', $classes ) . '"' . $anchor . '>';
		echo '<InnerBlocks template="' . esc_attr( wp_json_encode( $template ) ) . '" />';
	echo '</div>';
	?>
</div>