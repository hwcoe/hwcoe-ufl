<?php
/**
 * The template file for a generic single post.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package HWCOE_UFL
 */
get_header(); ?>

<main id="main" class="container main-content">
<div class="row">
	<div class="col-sm-12">
		<?php hwcoe_ufl_breadcrumbs(); ?>
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
