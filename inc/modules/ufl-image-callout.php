<!-- ufl-image-callout module -->
<div class="img-callout-wrapper" style="background-image:url(<?php the_sub_field( 'background_image' ); ?>)">
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
					<img src="<?php echo $img_src; ?>" alt="<?php echo $alt; ?>" class="img-full">
					<h2><?php esc_attr( the_sub_field( 'headline' ) ); ?></h2>
					<p><?php esc_attr( the_sub_field( 'content' ) ); ?></p>
					<?php if ( get_sub_field( 'link_text') ): ?>
						<a href="<?php esc_url( the_sub_field( 'link_url' ) ); ?>" class="read-more"><?php esc_attr( the_sub_field( 'link_text' ) ); ?></a>
					<?php endif ?>
				</div>
			</div>
			<?php endwhile // the_row ?>
		<?php endif // have_rows ?>
		</div>
	</div>
</div>
