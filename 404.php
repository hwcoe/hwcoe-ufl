<?php
/**
 * The template for displaying 404 pages.
 *
 * @package HWCOE_UFL
 */
get_header(); ?>

<div id="main" class="container main-content">
<div class="row">
  <div class="col-sm-12">
    <?php hwcoe_ufl_breadcrumbs(); ?>
    <header class="entry-header page-header">
      <h1><?php esc_html_e( 'Page not found', 'hwcoe-ufl' ); ?></h1>
    </header>
    <!-- .entry-header --> 
  </div>
</div>
<div class="row">
  <div class="col-sm-12">
  
  <section class="error-404 not-found">
  <div class="page-content">
    <p><?php esc_html_e( "Sorry, the page you are looking for doesn't appear to exist (or may have moved). You may want to try using the search below:", 'hwcoe-ufl' ); ?></p>
  	<?php get_search_form(); ?>
  </div>
  </section>
  
  
  </div>
</div>
</div>

<?php get_footer(); ?>
