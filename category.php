<?php
/**
 * The template file for categories.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package HWCOE_UFL
 */
get_header(); ?>

<main id="main" class="container main-content">
<div class="row">
  <div class="col-sm-12">
    <header class="entry-header">
      <?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
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
	
		// Previous/next page navigation.
		the_posts_pagination();
	?>
  </div>
  <?php get_sidebar('post_sidebar'); ?>
</div>
</main>

<?php get_footer(); ?>
