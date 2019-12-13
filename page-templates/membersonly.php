<?php
/**
 * Template Name:  Members Only Page
 * 
 * @package HWCOE_UFL
 *
 */
if ( ufl_check_page_visitor_level( $post->ID ) > 0 ) { 
  define( 'DONOTCACHEPAGE', 1 ); 
}
get_header(); ?>

<main id="main" class="<?php if( get_field('full_width_content_container') ){echo 'no-';} ?>container main-content">
<div class="row">
  <div class="col-sm-12">
    <?php hwcoe_ufl_breadcrumbs(); ?>
    <header class="entry-header" aria-label="Content Header" id="skiplink-dest">
      <?php hwcoe_ufl_entry_title(); ?>
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
</main>

<?php get_footer(); ?>
