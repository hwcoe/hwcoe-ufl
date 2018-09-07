<?php
/**
 * Template Name: No Sidebars or Widgets - Container
 * 
 * @package HWCOE_UFL
 *
 */
get_header(); ?>

<div id="main" class="container main-content">
<div class="row">
  <div class="col-sm-12">
    <?php hwcoe_ufl_breadcrumbs(); ?>
    <header class="entry-header">
      <?php hwcoe_ufl_entry_title(); ?>
    </header>
    <!-- .entry-header --> 
  </div>
</div>
<div class="row">
  <div class="col-sm-12">
    <?php 
		while ( have_posts() ) : the_post();
			get_template_part( 'template-parts/content', 'page' );
		endwhile; // End of the loop. 
	?>
  </div>
</div>
</div>

<?php get_footer(); ?>
