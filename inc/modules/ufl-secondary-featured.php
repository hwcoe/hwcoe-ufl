<div class="homepage-stat-wrap standalone">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">

				
				<?php if( have_rows('secondary_featured_content_block') ): ?>
					<?php while ( have_rows('secondary_featured_content_block') ) : the_row(); ?> 
						<?php $content_category = get_sub_field( 'content_category' ); ?>
						<?php if( get_sub_field( 'pull_latest_from_category' ) ): ?>
						  <?php        
							 $args = array(
								'posts_per_page' => 1,
								'category' => $content_category,
								'orderby' => 'date',
								'order' => 'DESC',
								'post_type' => 'post',
								'post_status' => 'publish',
							 );
							 $recent_posts = get_posts( $args );
							 $stat_story = $recent_posts[0];
							 wp_reset_postdata();
							 $excerpt = ( $stat_story->post_excerpt ? $stat_story->post_excerpt : hwcoe_ufl_trim_content( $stat_story->post_content, 135, '...' ));
						  ?>
						  <?php $story_background = (get_sub_field( 'story_background_image') ? get_sub_field( 'story_background_image' ) : wp_get_attachment_url( get_post_thumbnail_id( $stat_story->ID ) ) ); ?>
						  <div class="big-stat-wrap <?php if( get_sub_field('background_gradient') ){ echo "gradient-bg"; } ?>" <?php if( $story_background ){ echo "style='background-image:url(" . $story_background . ")'"; } ?>>
							 <div class="big-stat-copy">
								<h2><a href="<?php echo esc_url( get_permalink( $stat_story->ID ) ); ?>"><?php echo get_the_title( $stat_story->ID ); ?></a></h2>
								<p><?php echo $excerpt ?></p>
								<a href="<?php echo esc_url( get_permalink( $stat_story->ID ) ); ?>" class="read-more">Read more</a>
							 </div>
							 <a href="<?php echo get_category_link( $content_category ); ?>" class="category-tag"><?php echo get_cat_name( $content_category ); ?></a>
						  </div>

						<?php else: ?>
						  <?php $story_background = get_sub_field( 'story_background_image'); ?>
							 <div class="big-stat-wrap <?php if( get_sub_field('background_gradient') ){ echo "gradient-bg"; } ?>" <?php if( $story_background ){ echo "style='background-image:url(" . $story_background . ")'"; } ?>>
							 <div class="big-stat-copy">
								<h2><a href="<?php esc_url( the_sub_field( 'story_link' ) ); ?>"><?php the_sub_field( 'story_title' ) ?></a></h2>
								<p><?php the_sub_field( 'story_excerpt' ); ?></p>
								<a href="<?php esc_url( the_sub_field( 'story_link' ) ); ?>" class="read-more">Read more</a>
							 </div>
							 <a href="<?php echo get_category_link( get_sub_field( 'content_category' ) ); ?>" class="category-tag"><?php echo get_cat_name( get_sub_field( 'content_category' ) ); ?></a>
						  </div>
						<?php endif // pull_latest_from_category ?>

						<?php $content_category = get_sub_field( 'content_category' ); ?>
							<?php if( get_sub_field( 'pull_latest_from_category' ) ): ?>
								<?php        
									$args = array(
										'posts_per_page' => 1,
										'category' => $content_category,
										'orderby' => 'date',
										'order' => 'DESC',
										'post_type' => 'post',
										'post_status' => 'publish',
									);
									$recent_posts = get_posts( $args );
									$content_story = $recent_posts[0];
									wp_reset_postdata();
									$excerpt = ( $content_story->post_excerpt ? $content_story->post_excerpt : hwcoe_ufl_trim_content( $content_story->post_content, 135, '...' ));
								?>
								<?php $story_background = (get_sub_field( 'story_background_image') ? get_sub_field( 'story_background_image' ) : wp_get_attachment_url( get_post_thumbnail_id( $content_story->ID ) ) ); ?>
								<div class="big-stat-wrap three <?php if( get_sub_field('background_gradient') ){ echo "gradient-bg"; } ?>" <?php if( $story_background ){ echo "style='background-image:url(" . $story_background . ")'"; } ?>>
									<div class="big-stat-copy">
										<h2><a href="<?php echo esc_url( get_permalink( $content_story->ID ) ); ?>"><?php echo get_the_title( $content_story->ID ); ?></a></h2>
										<p><?php echo $excerpt; ?></p>
										<a href="<?php echo esc_url( get_permalink( $content_story->ID ) ); ?>" class="read-more">Read more</a>
									</div>
									<a href="<?php echo get_category_link( $content_category ); ?>" class="category-tag"><?php echo get_cat_name( $content_category ); ?></a>
								</div>
							<?php else: ?>
								<?php $story_background = get_sub_field( 'story_background_image'); ?>
									<div class="big-stat-wrap three <?php if( get_sub_field('background_gradient') ){ echo "gradient-bg"; } ?>" <?php if( $story_background ){ echo "style='background-image:url(" . $story_background . ")'"; } ?>>
									<div class="big-stat-copy">
										<h2><a href="<?php esc_url( the_sub_field( 'story_link' ) ); ?>"><?php the_sub_field( 'story_title' ) ?></a></h2>
										<p><?php the_sub_field( 'story_excerpt' ); ?></p>
										<a href="<?php esc_url( the_sub_field( 'story_link' ) ); ?>" class="read-more">Read more</a>
									</div>
									<a href="<?php echo get_category_link( $content_category ); ?>" class="category-tag"><?php echo get_cat_name( $content_category ); ?></a>
								</div>
							<?php endif // pull_latest_from_category ?>
					<?php endwhile // have_rows ?>
				<?php endif // have_rows ?>
			</div> <!-- col-sm-12 -->
		</div> <!-- row -->
	</div> <!-- container -->
</div> <!-- homepage-stat-wrap standalone -->
