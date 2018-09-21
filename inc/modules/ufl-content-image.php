<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<div class="row">
			<?php if( 'left' == get_sub_field( 'image_position' ) ): ?>
				<div class="col-sm-5 col-sm-offset-1">
					<?php
						$image = get_sub_field( 'image' );
						$img_src = $image['sizes']['large'];
						$alt = $image['alt'];
					?>
						<img src="<?php echo $img_src; ?>" alt="<?php echo $alt; ?>" class="img-full">
				</div>
				<div class="col-sm-5">
					<div class="row">
						<div class="col-md-12">
							<h2><?php the_sub_field( 'headline' ); ?></h2>
							<div><?php the_sub_field( 'content' ); ?></div>
						</div>
					</div>
				</div>
				<?php else: ?>
				<div class="col-sm-5 col-sm-offset-1">
					<div class="row">
						<div class="col-md-12">
							<h2><?php the_sub_field( 'headline' ); ?></h2>
							<div><?php the_sub_field( 'content' ); ?></div>
						</div>
					</div>
				</div>
				<div class="col-sm-5">
					<?php
						$image = get_sub_field( 'image' );
						$img_src = $image['sizes']['large'];
						$alt = $image['alt'];
					?>
						<img src="<?php echo $img_src; ?>" alt="<?php echo $alt; ?>" class="img-full">
				</div>
				<?php endif; ?>
			</div>
			<hr>
		</div>
	</div>
</div>
