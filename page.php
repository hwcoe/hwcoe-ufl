<?php
/**
 * The default template for pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package HWCOE_UFL
 */
get_header(); ?>

<div id="main" class="container main-content">
<div class="row">
  <!-- <div class="col-sm-8 col-md-offset-3"> -->
  <div class="col-sm-12">
    <?php hwcoe_ufl_breadcrumbs(); ?>
    <header class="entry-header">
      <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
    </header>
    <!-- .entry-header --> 
  </div>
</div>
<div class="row">
  
  <?php get_sidebar('page_sidebar'); ?>  
  
  <div class="<?php echo hwcoe_ufl_page_column_class(); ?>">
    <?php 
		while ( have_posts() ) : the_post();
			get_template_part( 'template-parts/content', 'page' );
		endwhile; // End of the loop. 
	?>
  </div>
  
  <?php get_sidebar('page_right'); ?> 
  
</div><!-- .row -->
</div><!-- #main -->

<?php get_footer(); ?>
