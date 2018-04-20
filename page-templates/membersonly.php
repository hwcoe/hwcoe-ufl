<?php
/**
 * Template Name:  Container | Members Only Page
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
      <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
    </header>
    <!-- .entry-header --> 
  </div>
</div>
<div class="row">
  <div class="col-sm-12">
    <?php 
		if ( ufl_check_authorized_user( get_the_ID() ) ) : // check if logged in/valid shib user required
            while ( have_posts() ) : the_post();
                get_template_part( 'template-parts/content', 'page' );
            endwhile; // End of the loop. 
		else:
			get_template_part('template-parts/content','restricted');
		endif;
	?>
  </div>
</div>
</div>

<?php get_footer(); ?>
