<?php
/**
 * Template Name: No Sidebars or Widgets
 * 
 * @package HWCOE_UFL
 *
 */
get_header(); ?>

<main id="main" class="<?php if( get_field('full_width_content_container') ){echo 'no-';} ?>container main-content">
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
  <div class="col-sm-12">
    <?php 
		while ( have_posts() ) : the_post();
			get_template_part( 'template-parts/content', 'page' );
		endwhile; // End of the loop. 
	?>
  </div>
</div>
</main>

<?php get_footer(); ?>
