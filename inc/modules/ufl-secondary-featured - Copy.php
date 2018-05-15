<div class="homepage-stat-wrap standalone">
<div class="container">
<div class="row">
<div class="col-sm-12">

<?php
  /*
   * Story #1
   */
?>
<?php if( have_rows('story_1') ): ?>
  <?php while ( have_rows('story_1') ) : the_row(); ?> 
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
  <?php endwhile // have_rows ?>
<?php endif // have_rows ?>     
<?php
  /*
   * Stat 4
   * Note: Stat 3 and 4 do not have box statistics
   * Rather, just large stories
   */
?>
<?php if( have_rows('statistic_4') ): ?>
  <?php while ( have_rows('statistic_4') ) : the_row(); ?> 
    <?php if( get_sub_field( 'twitter_widget' ) ): ?>
      <div class="big-stat-wrap four <?php if( get_sub_field('background_gradient') ){ echo "gradient-bg"; } ?>" style="background: transparent;">
      <?php the_sub_field( 'embed_code' ); ?>
      </div>
    <?php else: ?>
    <?php $story_category = get_sub_field( 'story_category' ); ?>
      <?php if( get_sub_field( 'pull_latest_from_category' ) ): ?>
        <?php        
          $cat = get_sub_field( 'category' );
          $args = array(
            'numberposts' => 1,
            'category' => $cat[0], 
            'orderby' => 'post_date',
            'order' => 'DESC',
            'post_type' => 'post',
            'post_status' => 'publish',
          );
          $recent_posts = wp_get_recent_posts( $args, OBJECT );
          $stat_story = $recent_posts[0];
        ?>
        <?php $story_background = (get_sub_field( 'story_background_image') ? get_sub_field( 'story_background_image' ) : wp_get_attachment_url( get_post_thumbnail_id( $stat_story->ID ) ) ); ?>
        <div class="big-stat-wrap big-stat-img four <?php if( get_sub_field('background_gradient') ){ echo "gradient-bg"; } ?>" <?php if( $story_background ){ echo "style='background-image:url(" . $story_background . ")'"; } ?>>
          <div class="big-stat-copy">
            <h2><a href="<?php echo esc_url( get_permalink( $stat_story->ID ) ); ?>"><?php echo get_the_title( $stat_story->ID ); ?></a></h2>
            <p><?php echo $excerpt; ?></p>
            <a href="<?php echo esc_url( get_permalink( $stat_story->ID ) ); ?>" class="read-more">Read more</a>
          </div>
          <a href="<?php echo get_category_link( $story_category[0]); ?>" class="category-tag"><?php echo get_cat_name( $story_category[0]); ?></a>
        </div>
      <?php else: ?>
        <?php $story_background = get_sub_field( 'story_background_image'); ?>
          <div class="big-stat-wrap big-stat-img four <?php if( get_sub_field('background_gradient') ){ echo "gradient-bg"; } ?>" <?php if( $story_background ){ echo "style='background-image:url(" . $story_background . ")'"; } ?>>
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

