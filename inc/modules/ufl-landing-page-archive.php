<?php
	$anchor = ( get_sub_field( 'in_page_anchor' ) ? 'id="' . esc_attr( get_sub_field( 'in_page_anchor' ) ) . '"' : '');
	$category = get_sub_field( 'category' );
	$sortby = (get_sub_field('sort_by') ? get_sub_field('sort_by'): 'date');
	$sorting = (get_sub_field( 'sorting_order' ) ? get_sub_field( 'sorting_order' ) : 'DESC' );
	$args = array(
		'posts_per_page'  => get_sub_field( 'maximum_articles_returned' ),
		'cat'             => $category,
		'orderby'         => $sortby,
		'order'           => $sorting,
		'post_type'       => 'post',
		'post_status'     => 'publish',
	);
	
	$archive = new WP_Query( $args );
?>
<!-- ufl-landing-page-archive module -->
<div class="container landing-page-archive post-content-box" <?php echo $anchor; ?>>
<?php if (get_sub_field( 'section_title' )): ?>
	<h2 style="text-align:<?php the_sub_field( 'title_alignment' ); ?>"><?php esc_html_e(the_sub_field( 'section_title' )); ?></h2>
<?php endif; ?>
	
<?php if ( $archive->have_posts() ): ?>
	<?php while ( $archive->have_posts() ): $archive->the_post(); ?>
		<div class="archive-entry row">
			<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>  
			<?php if( has_post_thumbnail() && get_sub_field( 'include_thumbnails' ) ): ?> 
				<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium-cropped' ); ?>
				<div class="col-sm-2">
 					<img src="<?php echo $image[0]; ?>" class="img-full">
				</div>
				<div class="col-sm-10">
			<?php else: // has_post_thumbnail ?>
				<div class="col-sm-12">
			<?php endif // has_post_thumbnail ?>
				<?php if( 'full' == get_sub_field( 'content_flavor' ) ): ?>
					<?php the_content(); ?>
				<?php elseif( 'excerpt' == get_sub_field( 'content_flavor' ) ): ?>
					<?php the_excerpt(); ?>
				<?php endif // content_flavor ?>
				</div>
		</div>
	<?php endwhile // the_post ?>
	<?php if( get_sub_field( 'read_more' ) ): ?>
		<p style="text-align: center;">
			<a href="<?php esc_url(the_sub_field( 'read_more' )); ?>" aria-label="Keep reading: <?php echo get_cat_name($category); ?>" class="btn btn--blue">Keep reading <span class="arw-right icon-svg"><svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php echo HWCOE_UFL_IMG_DIR; ?>/spritemap.svg#arw-right"></use></svg></span></a>
		</p>
	<?php endif // read_more ?>
<?php endif // have_posts ?>
<?php wp_reset_postdata(); ?>
</div>
