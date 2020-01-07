<?php 
	$image_side = get_sub_field( 'image_position' );
	$caption = ( get_sub_field( 'image_heading' ) ? '<div class="caption">' . get_sub_field( 'image_heading' ) . '</div>' : '');
?>
<!-- ufl-secondary-image module -->
<div class="gal-list-wrap">
	<div class="container">	
		<div class="row">		
			<div class="col-md-6">
				<?php if( 'left' == $image_side ): ?>
				<div class="gal-with-caption">
					<div class="gal-img" style="background:url(<?php the_sub_field( 'image' ); ?>) no-repeat center center; background-size:cover;"></div>
					<?php echo $caption; ?>
				</div><!-- /gal-with-caption -->
				<?php else: // image_side ?>		
				<h2><?php the_sub_field( 'headline' ); ?></h2>
				<div>
					<?php the_sub_field( 'content' ); ?>
				</div>			
				<?php endif // image_side ?>			
			</div><!-- /col-md-6 -->		
			<div class="col-md-6 gal-img-content">
				<?php if( 'left' == $image_side ): ?>
				<h2><?php the_sub_field( 'headline' ); ?></h2>
				<div>
					<?php the_sub_field( 'content' ); ?>
				</div>
				<?php else: // image_side ?>
				<div class="gal-with-caption">
					<div class="gal-img" style="background:url(<?php the_sub_field( 'image' ); ?>) no-repeat center center; background-size:cover;"></div>
					<?php echo $caption; ?>
				</div><!-- /gal-with-caption -->
				<?php endif // left_side ?>
			</div><!-- /col-md-6 gal-img-content -->
		</div><!-- /row -->
	</div><!-- /container -->
</div><!-- /gal-list-wrap -->
