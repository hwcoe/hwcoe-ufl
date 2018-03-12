<?php
/**
 * Site home page if set to display latest blog posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package UFCLAS_UFL_2015
 */
get_header(); 

?>

<?php 
	// Display Featured Carousel
	get_template_part( 'template-parts/featured', 'carousel' );	
?>

<!-- <div id="main" class="container-fluid main-content" role="main"> -->
<div id="main" role="main">
<div class="container">
  <div class="row">
  	
	<div id="secondary" class="widget-area" role="complementary">
		<?php ufandshands_secondary_widget_area(); ?>
    </div><!-- .widget-area -->
    
  </div>
</div>
</div>
<?php get_sidebar('page_sections'); ?>

<?php get_footer(); ?>
