<?php
	$background_img = (get_sub_field( 'background_image' ) ? "style='background-image:url(" . get_sub_field( 'background_image' ) . ");'" : '');
	$headline = get_sub_field( 'headline' );
?>
<div class="breaker" <?php echo $background_img; ?>>
	<div class="container">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<?php if( get_sub_field( 'include_circle_graphic' ) ): ?>
					<?php if( get_sub_field( 'custom_graphic' ) ): ?>
					<span class="icon-circle" style="background:url(<?php the_sub_field( 'custom_graphic' ); ?>) center; background-size: cover; border: 5px solid white;">
						<span class="icon-svg"> </span>
					</span>
					<?php else: ?>
					<span class="icon-circle">
						<span class="icon-svg"><svg><use xlink:href="<?php echo HWCOE_UFL_IMG_DIR ?>/spritemap.svg#icon-pencil"></use></svg></span>
					<?php endif // custom_graphic ?>
				<?php endif // include_circle_graphic ?>
				</span>
				<h2><?php echo $headline; ?></h2>
				<p><?php the_sub_field( 'content' ); ?></p>
				<?php if( have_rows ( 'buttons' ) ): ?>
					<?php while( have_rows( 'buttons' ) ) : the_row(); ?>
						<?php 
							$button_link = (get_sub_field( 'internal_or_external_link' ) == 'internal' ? get_sub_field( 'internal_link' ) : get_sub_field( 'external_url' ) );
							$button_text = strtolower( get_sub_field( 'button_text' ) );
							if ( ($button_text == "learn more" || $button_text == "read more") ) {
								$button_label = $headline;
							}
							else {
								$button_label = get_sub_field( 'button_text' );
							}
						?>
							<a href="<?php echo $button_link; ?>" aria-label="<?php echo $button_label; ?>" class="btn btn--white"><?php the_sub_field( 'button_text' ); ?> <span class="arw-right icon-svg"><svg><use xlink:href="<?php echo HWCOE_UFL_IMG_DIR; ?>/spritemap.svg#arw-right"></use></svg></span></a>
					<?php endwhile // have_rows ?>
				<?php endif // have_rows ?>
			</div>
		</div>
	</div>
</div>
