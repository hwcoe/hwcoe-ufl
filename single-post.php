<?php
/**
 * The template file for a generic single post.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package HWCOE_UFL
 */
get_header(); ?>
<?php 
	$custom_meta = get_post_meta( get_the_ID() );
	$post_hero = ( isset($custom_meta['post_hero_image']) )? $custom_meta['post_hero_image'][0]:NULL;
	if ( has_post_thumbnail() && $post_hero ):
		add_filter( 'the_title', 'hwcoe_ufl_title', 10, 2 );
		$hero_image_height = ( isset( $custom_meta['hero_image_height']) )? $custom_meta['hero_image_height'][0] : '';
		$shortcode = sprintf( '[ufl-landing-page-hero headline="%s" image="%d" image_height="%s"]%s[/ufl-landing-page-hero]', 
			get_the_title(),
			get_post_thumbnail_id(),
            $hero_image_height,
			''
		);
		echo do_shortcode( $shortcode );
		remove_filter( 'the_title', 'hwcoe_ufl_title', 10, 2 );
	endif;
?>

<main id="main" class="container main-content">
<div class="row">
	<div class="col-sm-12">
		<header class="entry-header" aria-label="Content Header">
			<?php hwcoe_ufl_entry_title(); ?>
		</header>
		<!-- .entry-header --> 
	</div>
</div>
<div class="row">
	<div class="<?php echo hwcoe_ufl_page_column_class(); ?>">
	
	<?php 
		while ( have_posts() ) : the_post();
			get_template_part( 'template-parts/content', get_post_type() );
		endwhile; // End of the loop.
		
		the_post_navigation( array(
			'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'hwcoe-ufl' ) . '</span> ' .
				'<span class="screen-reader-text">' . __( 'Next post:', 'hwcoe-ufl' ) . '</span> ' .
				'<span class="post-title">%title</span>',
			'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'hwcoe-ufl' ) . '</span> ' .
				'<span class="screen-reader-text">' . __( 'Previous post:', 'hwcoe-ufl' ) . '</span> ' .
				'<span class="post-title">%title</span>',
		) );
	?>
  </div>
	<?php get_sidebar('post_sidebar'); ?>
</div>
</main>

<?php get_footer(); ?>
