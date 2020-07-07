<?php
	$image    = '';
	$content  = '';
	$headline = '';
	$content_box_copy = '';
	$content_box_img = '';
	$category_obj	= get_sub_field( 'category' );
	$category_name = get_cat_name( $category_obj );	
	$anchor = ( get_sub_field( 'in_page_anchor' ) ? 'id="' . esc_attr( get_sub_field( 'in_page_anchor' ) ) . '"' : '');
?>
<?php if( get_sub_field( 'pull_latest_from_category' ) ): ?>
	<?php 
	// Pull latest story with image from specified category
	$args = array(
		'posts_per_page'   => 10,
   		'category'         => $category_obj, 
		'orderby'          => 'date',
		'order'            => 'DESC',
		'post_type'        => 'post',
		'post_parent'      => '',
		'post_status'      => 'publish',
		'suppress_filters' => true 
	);
	$posts_array = get_posts( $args );
	
	foreach( $posts_array as $post ){ 
		if( has_post_thumbnail( $post->ID ) ){
			$image    = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
			$image    = $image[0];
			$content  = apply_filters( 'the_content', get_post_field( 'post_content', $post->ID ) );
			$headline = get_the_title( $post->ID );
			break;
		}
	}
	wp_reset_postdata();
	?>
<?php else: ?>
	<?php
		$image    = get_sub_field( 'image' );
		$content  = get_sub_field( 'content' );
		$headline = get_sub_field( 'headline' );
	?>
<?php endif // pull_latest_from_category ?>
<?php
	// image content div
	$content_box_img = '<div class="col-sm-5 content-box-img" style="background-image:url(' . $image . '"></div>';

	// post copy div
	$content_box_copy .= '<div class="col-sm-7 content-box-copy">';
	if ( $headline ) {
		$content_box_copy .= '<h2>' . esc_html( $headline ) . '</h2>';
	}
	$content_box_copy .= wpautop( wp_kses_post( $content ) );
	if ( have_rows ( 'read_more_links' ) ):
		while( have_rows( 'read_more_links' ) ) : the_row();
			$readmore_link = get_sub_field( 'read_more_url' );
			$readmore_text = get_sub_field( 'read_more_text' );
			if ( strtolower( $readmore_text ) == "learn more" || strtolower( $readmore_text ) == "read more")  {
				$readmore_label = $readmore_text . ": " . $headline;
			} else {
				$readmore_label = $readmore_text;
			}
			$content_box_copy .= ' <a href="' . esc_url( $readmore_link ) . '" aria-label="' . esc_attr( $readmore_label ) . '" class="read-more">' . esc_html( $readmore_text ) . '</a>';
		endwhile;
	endif;
	$content_box_copy .= '<a href="' . get_category_link( $category_obj ) . '" class="category-tag orange">' . $category_name . '</a>';
	$content_box_copy .= '</div>';
?>
<!-- ufl-category-content module -->
<div class="content-box-module" <?php echo $anchor; ?>>
	<div class="container">
		<div class="row">
			<?php if( 'right' == get_sub_field( 'image_position' ) ): ?>
				<?php 
					echo $content_box_copy;
					echo $content_box_img;
				?>
			<?php elseif( 'left' == get_sub_field( 'image_position' ) ): ?>
				<?php 
					echo $content_box_img;
					echo $content_box_copy;
				?>
			<?php endif // image_position ?>
		</div>
	</div>
</div>
