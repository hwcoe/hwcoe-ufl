<?php 
	$image_side = get_sub_field( 'image_position' );
	$headline = '<h2>' . esc_html( get_sub_field('headline') ) . '</h2>';
	$image_markup = '<div class="gal-img" style="background:url(' . esc_url( get_sub_field( 'image' ) ) . ') no-repeat center center; background-size:cover;"></div>';
	$caption = ( get_sub_field( 'image_heading' ) ? '<div class="caption">' . esc_html( get_sub_field( 'image_heading' ) ) . '</div>' : '');
?>
<!-- ufl-secondary-image module -->
<div class="gal-list-wrap">
	<div class="container">	
		<div class="row">		
			<div class="col-md-6">
				<?php if( 'left' == $image_side ): ?>
				<div class="gal-with-caption">
					<?php echo $image_markup; ?>
					<?php echo $caption; ?>
				</div><!-- /gal-with-caption -->
				<?php else: // image_side ?>		
				<?php echo $headline; ?>
				<div>
					<?php the_sub_field( 'content' ); ?>
				</div>			
				<?php endif // image_side ?>			
			</div><!-- /col-md-6 -->		
			<div class="col-md-6 gal-img-content">
				<?php if( 'left' == $image_side ): ?>
				<?php echo $headline; ?>
				<div>
					<?php the_sub_field( 'content' ); ?>
				</div>
				<?php else: // image_side ?>
				<div class="gal-with-caption">
					<?php echo $image_markup; ?>
					<?php echo $caption; ?>
				</div><!-- /gal-with-caption -->
				<?php endif // left_side ?>
			</div><!-- /col-md-6 gal-img-content -->
		</div><!-- /row -->
	</div><!-- /container -->
</div><!-- /gal-list-wrap -->
