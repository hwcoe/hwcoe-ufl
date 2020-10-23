<!-- ufl-featured-story module -->
<div class="featured-story-wrap">
	 <div class="featured-story-img-wrap">
<?php 
  /*
	* Add variables to array rather than looping through fields again
	*/
$stories = array();

?>
<?php if( have_rows( 'featured_story' ) ): ?>
  <?php while ( have_rows( 'featured_story' ) ) : the_row(); ?>
		<?php 
			$internal         	= ( get_sub_field( 'internal_or_external_link' ) == 'internal' ? true : false ); 
			$link             	= '';
			$featured_image   	= '';
			$caption            = get_sub_field( 'image_caption' );
			$title            	= get_sub_field( 'story_title' );
			$category         	= get_sub_field( 'primary_category' );
			$tagline			= ( trim( get_sub_field( 'link_text' ) ) ? get_sub_field( 'link_text' ) : '');

		  if( $internal ){
			 $page   = get_sub_field( 'internal_link' ); 
			 $id     = $page->ID;
			 $link   = get_permalink( $id );
			 if( get_sub_field( 'use_post_featured_image' ) ){
				$featured_image  = wp_get_attachment_url( get_post_thumbnail_id( $page->ID ) );
			 } else {
				$featured_image = get_sub_field( 'featured_image' );
			 }
		  } else {
			 $link = get_sub_field( 'external_url' );
			 $featured_image = get_sub_field( 'featured_image' );
		  }

		  $story = array(
			 'title'     => $title,
			 'category'  => $category,
			 'tagline'   => $tagline,
			 'link'      => $link,
			 'caption'   => $caption
		  );
		  array_push( $stories, $story );
		?>
		<figure class="featured-story-img" style="background-image:url(<?php echo esc_url($featured_image); ?>)">
			<?php if ( $story['caption'] !== ''): ?>
				<figcaption class="featured-img-caption"><?php echo esc_html($story['caption']); ?></figcaption>
			<?php endif; ?>
	  </figure>
  <?php endwhile // have_rows ?>
<?php endif // have_rows ?>
  </div><!-- ./featured-story-img-wrap -->
</div><!-- ./featured-story-wrap -->
<div class="homepage-secondary-featured-wrap<?php if( get_sub_field('standalone') ){echo ' standalone';} ?><?php if( get_sub_field('alternate_format') ){echo ' bottom';} ?>">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="featured-story-content-wrap-wrap">
					<div class="featured-story-content-wrap col-md-6 col-md-offset-1">
					<?php $story_count = 1; foreach( $stories as $story): ?>
						<?php if( 1 === $story_count ): ?>
						<div class="featured-story active">
							<h2 data-index="<?php echo esc_attr($story_count); ?>"><?php echo $story['title']; ?> 
							<?php if ( $story['tagline'] !== ''): ?>
								<a href="<?php echo esc_url( $story['link'] ); ?>" aria-label="Read '<?php echo esc_attr( $story['title'] ); ?>'" class="read-more"><?php echo esc_html($story['tagline']); ?></a>
							<?php endif; ?>
							</h2>
							<a href="<?php echo esc_url( get_category_link( $story['category'] ) ); ?>" class="category-tag"><?php echo esc_html(get_cat_name( $story['category'] )); ?></a>
						</div>
						<?php else:  // story_count ?>
						<div data-number="<?php echo esc_attr($story_count); ?>" class="featured-story">
							<h2 data-index="<?php echo esc_attr($story_count); ?>"><?php echo esc_html($story['title']); ?> 
							<?php if ( $story['tagline'] !== ''): ?>
								<a href="<?php echo esc_url( $story['link'] ); ?>" aria-label="Read '<?php echo esc_attr($story['title']); ?>'" class="read-more"><?php echo esc_html($story['tagline']); ?></a>
							<?php endif; ?>
							</h2>
							<a href="<?php echo esc_url( get_category_link( $story['category']) ); ?>" class="category-tag"><?php echo esc_html(get_cat_name( $story['category'] )); ?></a>
						</div>
						<?php endif // story_count ?>
					<?php $story_count++; ?>
					<?php endforeach //stories ?>
					</div><!-- //featured-story-content-wrap -->
				</div><!-- //featured-story-content-wrap-wrap -->
			<?php if ( get_sub_field('standalone') ): ?>
			</div><!-- //col-sm-12 -->
		</div><!-- //row -->
	</div><!-- //container -->
</div>
<?php endif ?>