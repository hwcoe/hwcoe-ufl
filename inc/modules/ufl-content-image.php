<?php
	$headline = ( get_sub_field( 'headline' ) ? '<h2>' . esc_html( get_sub_field( 'headline' ) ) . '</h2>' : '');
	$content = 	( get_sub_field( 'content' ) ? '<div>' . wpautop( wp_kses_post( get_sub_field( 'content' ) ) ) . '</div>' : '');

	if ( get_sub_field( 'image' ) ) {						
		$image = get_sub_field( 'image' );
		$img_src = $image['sizes']['large'];
		$alt = $image['alt'];
		$img_markup = '<img src="' . esc_url( $img_src ) . '" alt="' . esc_attr( $alt ) . '" class="img-full">';
	} else {
		$img_markup = '';
	}
?>

<?php if( $headline != '' || $content != '' || $img_markup != ''): ?>
<!-- ufl-content-image module -->
<div class="container ufl-content-image">
	<div class="row">
		<div class="col-sm-12">
			<div class="row">
			<?php if( 'left' == get_sub_field( 'image_position' ) ): ?>
				<div class="col-sm-5 col-sm-offset-1">
					<?php echo $img_markup; ?>
				</div>
				<div class="col-sm-5">
					<div class="row">
						<div class="col-md-12">
							<?php echo $headline; ?>
							<?php echo $content; ?>
						</div>
					</div>
				</div>
				<?php else: ?>
				<div class="col-sm-5 col-sm-offset-1">
					<div class="row">
						<div class="col-md-12">
							<?php echo $headline; ?>
							<?php echo $content; ?>
						</div>
					</div>
				</div>
				<div class="col-sm-5">
					<?php echo $img_markup; ?>
				</div>
				<?php endif; ?>
			</div>
			<hr>
		</div>
	</div>
</div>
<?php endif; ?>
