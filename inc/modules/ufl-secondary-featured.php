<?php if( get_sub_field( 'standalone' ) ): ?>
<div class="homepage-stat-wrap standalone">
<div class="container">
<div class="row">
<div class="col-sm-12">

<?php endif // standalone ?>
<?php
	/*
	 * Content Block #1
	 * Top right
	 */
?>
<?php if( have_rows('content_1') ): ?>
	<?php while ( have_rows('content_1') ) : the_row(); ?> 
		<?php $stat_background = get_sub_field( 'background_image' ); ?>
		<div class="stat-wrap one in-right"> 
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
					<a href="<?php echo get_category_link( $story_category ); ?>" class="category-tag"><?php echo get_cat_name( $story_category ); ?></a>
				</div>

			<?php else: ?>
				<?php $story_background = get_sub_field( 'story_background_image'); ?>
					<div class="big-stat-wrap <?php if( get_sub_field('background_gradient') ){ echo "gradient-bg"; } ?>" <?php if( $story_background ){ echo "style='background-image:url(" . $story_background . ")'"; } ?>>
					<div class="big-stat-copy">
						<h2><a href="<?php esc_url( the_sub_field( 'story_link' ) ); ?>"><?php the_sub_field( 'story_title' ) ?></a></h2>
						<p><?php the_sub_field( 'story_excerpt' ); ?></p>
						<a href="<?php esc_url( the_sub_field( 'story_link' ) ); ?>" class="read-more">Read more</a>
					</div>
					<a href="<?php echo get_category_link( get_sub_field( 'story_category' ) ); ?>" class="category-tag"><?php echo get_cat_name( get_sub_field( 'story_category' ) ); ?></a>
				</div>
			<?php endif // pull_latest_from_category ?>
		</div> <!-- stat-wrap one in-right -->
		
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
			<div class="stat-wrap two in-bottom"> 
				<div class="big-stat-wrap big-stat-img two <?php if( get_sub_field('background_gradient') ){ echo "gradient-bg"; } ?>">
					<div class="big-stat-copy">
						<?php the_sub_field( 'open_content' ); ?>
					</div>
				</div>
			</div>
		<?php elseif ( get_sub_field( 'twitter_widget' ) ): ?>
			<div class="stat-wrap two in-bottom" style="background: transparent;">
				<div class="tweet-block two">
					<?php the_sub_field( 'twitter_embed_code' ); ?>
				</div>
			</div>
		<?php else: ?>
		<?php $stat_background = get_sub_field( 'background_image' ); ?>
		<div class="stat-wrap two in-bottom"> 
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
				$stat_story = $recent_posts[0];
				wp_reset_postdata();
				$excerpt = ( $stat_story->post_excerpt ? $stat_story->post_excerpt : hwcoe_ufl_trim_content( $stat_story->post_content, 135, '...' ));
			?>
			<?php $story_background = (get_sub_field( 'story_background_image') ? get_sub_field( 'story_background_image' ) : wp_get_attachment_url( get_post_thumbnail_id( $stat_story->ID ) ) ); ?>
			<div class="big-stat-wrap big-stat-img two <?php if( get_sub_field('background_gradient') ){ echo "gradient-bg"; } ?>" <?php if( $story_background ){ echo "style='background-image:url(" . $story_background . ")'"; } ?>>
				<div class="big-stat-copy">
					<h2><a href="<?php echo esc_url( get_permalink( $stat_story->ID ) ); ?>"><?php echo get_the_title( $stat_story->ID ); ?></a></h2>
					<p><?php echo $excerpt; ?></p>
					<a href="<?php echo esc_url( get_permalink( $stat_story->ID ) ); ?>" class="read-more">Read more</a>
				</div>
				<a href="<?php echo get_category_link( $story_category ); ?>" class="category-tag"><?php echo get_cat_name( $story_category ); ?></a>
			</div>
		<?php else: ?>
			<?php $story_background = get_sub_field( 'story_background_image'); ?>
			<div class="big-stat-wrap big-stat-img two <?php if( get_sub_field('background_gradient') ){ echo "gradient-bg"; } ?>" <?php if( $story_background ){ echo "style='background-image:url(" . $story_background . ")'"; } ?>>
				<div class="big-stat-copy">
					<h2><a href="<?php esc_url( the_sub_field( 'story_link' ) ); ?>"><?php the_sub_field( 'story_title' ) ?></a></h2>
					<p><?php the_sub_field( 'story_excerpt' ); ?></p>
					<a href="<?php esc_url( the_sub_field( 'story_link' ) ); ?>" class="read-more">Read more</a>
				</div>
				<a href="<?php echo get_category_link( $story_category ); ?>" class="category-tag"><?php echo get_cat_name( $story_category ); ?></a>
			</div>
		<?php endif // pull_latest_from_category ?>

		</div> <!-- stat-wrap two in-bottom -->
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
		<?php if( get_sub_field( 'twitter_widget' ) ): ?>
			<div class="big-stat-wrap three" style="background: transparent;">
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
					$stat_story = $recent_posts[0];
					wp_reset_postdata();
					$excerpt = ( $stat_story->post_excerpt ? $stat_story->post_excerpt : hwcoe_ufl_trim_content( $stat_story->post_content, 135, '...' ));
				?>
				<?php $story_background = (get_sub_field( 'story_background_image') ? get_sub_field( 'story_background_image' ) : wp_get_attachment_url( get_post_thumbnail_id( $stat_story->ID ) ) ); ?>
				<div class="big-stat-wrap three <?php if( get_sub_field('background_gradient') ){ echo "gradient-bg"; } ?>" <?php if( $story_background ){ echo "style='background-image:url(" . $story_background . ")'"; } ?>>
					<div class="big-stat-copy">
						<h2><a href="<?php echo esc_url( get_permalink( $stat_story->ID ) ); ?>"><?php echo get_the_title( $stat_story->ID ); ?></a></h2>
						<p><?php echo $excerpt; ?></p>
						<a href="<?php echo esc_url( get_permalink( $stat_story->ID ) ); ?>" class="read-more">Read more</a>
					</div>
					<a href="<?php echo get_category_link( $story_category ); ?>" class="category-tag"><?php echo get_cat_name( $story_category ); ?></a>
				</div>
			<?php else: ?>
				<?php $story_background = get_sub_field( 'story_background_image'); ?>
					<div class="big-stat-wrap three <?php if( get_sub_field('background_gradient') ){ echo "gradient-bg"; } ?>" <?php if( $story_background ){ echo "style='background-image:url(" . $story_background . ")'"; } ?>>
					<div class="big-stat-copy">
						<h2><a href="<?php esc_url( the_sub_field( 'story_link' ) ); ?>"><?php the_sub_field( 'story_title' ) ?></a></h2>
						<p><?php the_sub_field( 'story_excerpt' ); ?></p>
						<a href="<?php esc_url( the_sub_field( 'story_link' ) ); ?>" class="read-more">Read more</a>
					</div>
					<a href="<?php echo get_category_link( $story_category ); ?>" class="category-tag"><?php echo get_cat_name( $story_category ); ?></a>
				</div>
			<?php endif // pull_latest_from_category ?>
		<?php endif // twitter_widget ?>
	<?php endwhile // have_rows ?>
			</div>
		</div>
	</div>
</div>
<?php endif // have_rows ?>    