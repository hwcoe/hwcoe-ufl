<?php
/**
 * The template file for archives.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package HWCOE_UFL
 */
get_header(); ?>

<main id="main" class="container main-content">
<div class="row">
  <div class="col-sm-12">
    <header class="entry-header" aria-label="Content Header">
      <?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
    </header>
    <!-- .entry-header --> 
  </div>
</div>
<div class="row">
  <div class="col-md-9">
    <?php 
		while ( have_posts() ) : the_post();
			get_template_part( 'template-parts/content', get_post_type() );
		endwhile; // End of the loop. 
		
		// Previous/next page navigation.
		the_posts_pagination();
	?>
  </div>
  <div class="col-md-3">
    <div id="post-sidebar" class="widget-area" role="complementary">
      <?php the_widget( 'WP_Widget_Archives', array('title' => __('News Archive', 'hwcoe-ufl'), 'dropdown' => 0) ); ?>
   </div><!-- post_sidebar -->
  </div>
</div>
</main>

<?php get_footer(); ?>
