<?php
	$background_img = (get_sub_field( 'background_image' ) ? "style='background-image:url(" . esc_url( get_sub_field( 'background_image' ) ) . ");'" : '');

?>
<!-- ufl-image-callout module -->
<div class="img-callout-wrapper" <?php echo $background_img; ?>>
	<div class="container">
		<div class="row">
		<?php if( have_rows( 'image_callout' ) ): ?>
			<?php while( have_rows( 'image_callout' ) ): the_row(); ?>
				<?php 
					$image    = get_sub_field( 'image' );
					$alt      = $image['alt'];
					$img_src  = $image['sizes']['large'];
				?>
			<div class="col-sm-12 col-md-4 img-callout-wrap">
				<div class="img-callout">
					<img src="<?php echo esc_url( $img_src ); ?>" alt="<?php echo esc_attr( $alt ); ?>" class="img-full">
					<h2><?php esc_html_e( the_sub_field( 'headline' ) ); ?></h2>
					<?php if ( get_sub_field( 'content') ): ?>
						<p><?php esc_html_e( the_sub_field( 'content' ) ); ?></p>
					<?php endif ?>
					<?php if ( get_sub_field( 'link_text') ): ?>
						<?php 
							$link_text = get_sub_field( 'link_text' ) ;
							if ( strtolower( $link_text ) == "learn more" || strtolower( $link_text ) == "read more")  {
								$link_label = $link_text . ": " . get_sub_field( 'headline' );
							}
							else {
								$link_label = $link_text;
							}
						?>
						<a href="<?php esc_url( the_sub_field( 'link_url' ) ); ?>" aria-label="<?php echo esc_attr( $link_label ); ?>" class="read-more"><?php echo esc_html( $link_text ); ?></a>
					<?php endif ?>
				</div>
			</div>
			<?php endwhile // the_row ?>
		<?php endif // have_rows ?>
		</div>
	</div>
</div>
