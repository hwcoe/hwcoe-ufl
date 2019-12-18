<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package HWCOE_UFL
 */
get_header(); ?>

<main id="main" class="container main-content">
<div class="row">
  <div class="col-sm-12">
    <?php if ( !is_home() && !is_front_page() ): ?>
		<?php hwcoe_ufl_breadcrumbs(); ?>
        <header class="entry-header" aria-label="Content Header">
          <?php hwcoe_ufl_entry_title(); ?>
        </header><!-- .entry-header --> 
    <?php endif; ?>
  </div>
</div>
<div class="row">
  <div class="col-sm-12">
    <?php 
		while ( have_posts() ) : the_post();
			get_template_part( 'template-parts/content', get_post_type() );
		endwhile; // End of the loop. 
	?>
  </div>
</div>
</main>

<?php get_footer(); ?>
