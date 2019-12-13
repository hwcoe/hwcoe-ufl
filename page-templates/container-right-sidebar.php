<?php
/**
 * Template Name: Right Sidebar, No Left Navigation - Container
 * 
 * @package HWCOE_UFL
 *
 */
get_header(); ?>

<main id="main" class="container main-content">
<div class="row">
  <div class="col-sm-12">
    <?php hwcoe_ufl_breadcrumbs(); ?>
    <header class="entry-header" id="skiplink-dest" aria-label="Content Header">
      <?php hwcoe_ufl_entry_title(); ?>
    </header>
    <!-- .entry-header --> 
  </div>
</div>
<div class="row">
  
  <div class="<?php echo hwcoe_ufl_page_column_class(); ?>">
    <?php 
		while ( have_posts() ) : the_post();
			get_template_part( 'template-parts/content', 'page' );
		endwhile; // End of the loop. 
	?>
  </div>
  
  <?php get_sidebar('page_right'); ?> 
  
</div><!-- .row -->
</main><!-- #main -->

<?php get_footer(); ?>
