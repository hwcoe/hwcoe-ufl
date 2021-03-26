<!-- ufl-statistics module -->
<div class="stat-breaker">
	<div class="hor-scroll-wrap">
		<div class="container">
			<?php if( get_sub_field( 'headline' ) ):?>
				<h2><?php esc_html_e( the_sub_field( 'headline' ) ); ?></h2>
			<?php endif //headline ?>
<?php
	$stat_count = 1;
?>
<?php if( have_rows( 'statistics' ) ): ?>
	<?php while ( have_rows( 'statistics' ) ) : the_row(); ?>
	<?php 
		if( get_sub_field( 'background_image' ) ): 
		$background_image = get_sub_field( 'background_image' );
	?>
		<div id="background-image" style="display: none;">
			<?php echo esc_url( $background_image ); ?>
		</div>
	<?php endif // background_image ?>
	<div class="stat-block-wrap stat-count-<?php echo $stat_count; ?> hor-scroll-el col-sm-<?php esc_attr( the_sub_field( 'columns' ) ); ?>">

					<div class="stat-block">
						<div class="stat">
						<h3><?php esc_html_e( the_sub_field( 'statistic_value' ) ); ?></h3>
						</div>
						<div class="info">
							<div class="info-copy">
								<?php echo wp_kses_post( get_sub_field( 'statistic_description' ) ); ?> 
							</div>
						 </div>
					</div>
				</div>
	<?php $stat_count++; ?>
	<?php endwhile // the_row ?>
<?php endif // have_rows ?>
		</div><!-- ./container -->
	</div><!-- ./hor-scroll-wrapper -->
</div><!-- stat-breaker -->
