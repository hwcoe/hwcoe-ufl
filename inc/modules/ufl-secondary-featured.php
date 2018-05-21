<?php
	/*
	 * Content Block #1
	 * Top right
	 */
?>
<?php if( have_rows('content_1') ): ?>
	<?php while ( have_rows('content_1') ) : the_row(); ?> 
	<div class="secondary-featured-block one in-right"> 
		<?php $story_category = get_sub_field( 'story_category' ); ?>
		<?php if( get_sub_field( 'pull_latest_from_category' ) ): ?>
			<?php        
				$args = array(
					'posts_per_page' => 1,
					'category' => $story_category,
					'orderby' => 'date',
					'order' => 'DESC',
					'post_type' => 'post',
					'post_status' => 'publish',
				);
				$recent_posts = get_posts( $args );
				$secondary_story = $recent_posts[0];
				wp_reset_postdata();
				$excerpt = ( $secondary_story->post_excerpt ? $secondary_story->post_excerpt : hwcoe_ufl_trim_content( $secondary_story->post_content, 135, '...' ));
			?>
			<?php $story_background = (get_sub_field( 'story_background_image') ? get_sub_field( 'story_background_image' ) : wp_get_attachment_url( get_post_thumbnail_id( $secondary_story->ID ) ) ); ?>
			<div class="secondary-featured-story <?php if( get_sub_field('background_gradient') ){ echo "gradient-bg"; } ?>" <?php if( $story_background ){ echo "style='background-image:url(" . $story_background . ")'"; } ?>>
				<div class="secondary-featured-copy">
					<h2><a href="<?php echo esc_url( get_permalink( $secondary_story->ID ) ); ?>"><?php echo get_the_title( $secondary_story->ID ); ?></a></h2>
					<p><?php echo $excerpt ?></p>
					<a href="<?php echo esc_url( get_permalink( $secondary_story->ID ) ); ?>" class="read-more">Read more</a>
				</div>
				<a href="<?php echo get_category_link( $story_category ); ?>" class="category-tag"><?php echo get_cat_name( $story_category ); ?></a>
			</div>

		<?php else: ?>
			<?php $story_background = get_sub_field( 'story_background_image'); ?>
				<div class="secondary-featured-story <?php if( get_sub_field('background_gradient') ){ echo "gradient-bg"; } ?>" <?php if( $story_background ){ echo "style='background-image:url(" . $story_background . ")'"; } ?>>
				<div class="secondary-featured-copy">
					<h2><a href="<?php esc_url( the_sub_field( 'story_link' ) ); ?>"><?php the_sub_field( 'story_title' ) ?></a></h2>
					<p><?php the_sub_field( 'story_excerpt' ); ?></p>
					<a href="<?php esc_url( the_sub_field( 'story_link' ) ); ?>" class="read-more">Read more</a>
				</div>
				<a href="<?php echo get_category_link( get_sub_field( 'story_category' ) ); ?>" class="category-tag"><?php echo get_cat_name( get_sub_field( 'story_category' ) ); ?></a>
			</div>
		<?php endif // pull_latest_from_category ?>
	</div> <!-- secondary-featured-block one in-right -->
		
	<?php endwhile // have_rows ?>
<?php endif // have_rows ?>     
<?php
	/*
	 * Content Block #2
	 * Bottom Left
	 */
?>
<?php if( have_rows('content_2') ): ?>
	<?php while ( have_rows('content_2') ) : the_row(); ?> 
		<?php if( get_sub_field( 'content_enable' ) ): ?>
			<div class="secondary-featured-block two in-bottom"> 
				<div class="secondary-featured-story <?php if( get_sub_field('background_gradient') ){ echo "gradient-bg"; } ?>">
					<div class="secondary-featured-copy">
						<?php the_sub_field( 'open_content' ); ?>
					</div>
				</div>
			</div>
		<?php elseif ( get_sub_field( 'twitter_widget' ) ): ?>
			<div class="secondary-featured-block two in-bottom" style="background: transparent;">
				<div class="tweet-block" style="background: transparent;">
					<?php the_sub_field( 'twitter_embed_code' ); ?>
				</div>
			</div>
		<?php else: ?>
			<div class="secondary-featured-block two in-bottom"> 
		<?php $story_category = get_sub_field( 'story_category' ); ?>
		<?php if( get_sub_field( 'pull_latest_from_category' ) ): ?>
			<?php        
				$args = array(
					'posts_per_page' => 1,
					'category' => $story_category,
					'orderby' => 'date',
					'order' => 'DESC',
					'post_type' => 'post',
					'post_status' => 'publish',
				);
				$recent_posts = get_posts( $args );
				$secondary_story = $recent_posts[0];
				wp_reset_postdata();
				$excerpt = ( $secondary_story->post_excerpt ? $secondary_story->post_excerpt : hwcoe_ufl_trim_content( $secondary_story->post_content, 135, '...' ));
			?>
			<?php $story_background = (get_sub_field( 'story_background_image') ? get_sub_field( 'story_background_image' ) : wp_get_attachment_url( get_post_thumbnail_id( $secondary_story->ID ) ) ); ?>
				<div class="secondary-featured-story <?php if( get_sub_field('background_gradient') ){ echo "gradient-bg"; } ?>" <?php if( $story_background ){ echo "style='background-image:url(" . $story_background . ")'"; } ?>>
					<div class="secondary-featured-copy">
						<h2><a href="<?php echo esc_url( get_permalink( $secondary_story->ID ) ); ?>"><?php echo get_the_title( $secondary_story->ID ); ?></a></h2>
						<p><?php echo $excerpt; ?></p>
						<a href="<?php echo esc_url( get_permalink( $secondary_story->ID ) ); ?>" class="read-more">Read more</a>
					</div>
					<a href="<?php echo get_category_link( $story_category ); ?>" class="category-tag"><?php echo get_cat_name( $story_category ); ?></a>
				</div>
		<?php else: ?>
			<?php $story_background = get_sub_field( 'story_background_image'); ?>
			<div class="secondary-featured-story <?php if( get_sub_field('background_gradient') ){ echo "gradient-bg"; } ?>" <?php if( $story_background ){ echo "style='background-image:url(" . $story_background . ")'"; } ?>>
				<div class="secondary-featured-copy">
					<h2><a href="<?php esc_url( the_sub_field( 'story_link' ) ); ?>"><?php the_sub_field( 'story_title' ) ?></a></h2>
					<p><?php the_sub_field( 'story_excerpt' ); ?></p>
					<a href="<?php esc_url( the_sub_field( 'story_link' ) ); ?>" class="read-more">Read more</a>
				</div>
				<a href="<?php echo get_category_link( $story_category ); ?>" class="category-tag"><?php echo get_cat_name( $story_category ); ?></a>
			</div>
		<?php endif // pull_latest_from_category ?>

			</div> <!-- secondary-featured-block two in-bottom -->
		<?php endif // content_enable ?>
	<?php endwhile // have_rows ?>
<?php endif // have_rows ?>     
<?php
	/*
	 * Content Block #3
	 * Bottom right
	 */
?>
<?php if( have_rows('content_3') ): ?>
	<?php while ( have_rows('content_3') ) : the_row(); ?> 
		<div class="secondary-featured-block three">
		<?php if( get_sub_field( 'twitter_widget' ) ): ?>
			<div class="tweet-block" style="background: transparent;">
				<?php the_sub_field( 'embed_code' ); ?>
			</div>
		<?php else: ?>
		<?php $story_category = get_sub_field( 'story_category' ); ?>
			<?php if( get_sub_field( 'pull_latest_from_category' ) ): ?>
				<?php        
					$args = array(
						'posts_per_page' => 1,
						'category' => $story_category,
						'orderby' => 'date',
						'order' => 'DESC',
						'post_type' => 'post',
						'post_status' => 'publish',
					);
					$recent_posts = get_posts( $args );
					$secondary_story = $recent_posts[0];
					wp_reset_postdata();
					$excerpt = ( $secondary_story->post_excerpt ? $secondary_story->post_excerpt : hwcoe_ufl_trim_content( $secondary_story->post_content, 135, '...' ));
				?>
				<?php $story_background = (get_sub_field( 'story_background_image') ? get_sub_field( 'story_background_image' ) : wp_get_attachment_url( get_post_thumbnail_id( $secondary_story->ID ) ) ); ?>
				<div class="secondary-featured-story <?php if( get_sub_field('background_gradient') ){ echo "gradient-bg"; } ?>" <?php if( $story_background ){ echo "style='background-image:url(" . $story_background . ")'"; } ?>>
					<div class="secondary-featured-copy">
						<h2><a href="<?php echo esc_url( get_permalink( $secondary_story->ID ) ); ?>"><?php echo get_the_title( $secondary_story->ID ); ?></a></h2>
						<p><?php echo $excerpt; ?></p>
						<a href="<?php echo esc_url( get_permalink( $secondary_story->ID ) ); ?>" class="read-more">Read more</a>
					</div>
					<a href="<?php echo get_category_link( $story_category ); ?>" class="category-tag"><?php echo get_cat_name( $story_category ); ?></a>
				</div>
			<?php else: ?>
			<?php $story_background = get_sub_field( 'story_background_image'); ?>
				<div class="secondary-featured-story <?php if( get_sub_field('background_gradient') ){ echo "gradient-bg"; } ?>" <?php if( $story_background ){ echo "style='background-image:url(" . $story_background . ")'"; } ?>>
				<div class="secondary-featured-copy">
					<h2><a href="<?php esc_url( the_sub_field( 'story_link' ) ); ?>"><?php the_sub_field( 'story_title' ) ?></a></h2>
					<p><?php the_sub_field( 'story_excerpt' ); ?></p>
					<a href="<?php esc_url( the_sub_field( 'story_link' ) ); ?>" class="read-more">Read more</a>
				</div>
				<a href="<?php echo get_category_link( $story_category ); ?>" class="category-tag"><?php echo get_cat_name( $story_category ); ?></a>
			</div>
		<?php endif // pull_latest_from_category ?>
		</div> <!-- secondary-featured-block three -->
	<?php endif // twitter_widget ?>
	<?php endwhile // have_rows ?>
</div> <!--col-sm-12-->
</div> <!--row -->
</div> <!--container -->
</div> <!-- homepage-secondary-featured-wrap standalone -->
<?php endif // have_rows ?>    