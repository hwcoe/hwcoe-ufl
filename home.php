<?php
/**
 * Site home page if set to display latest blog posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package HWCOE_UFL
 */
get_header(); 

?>

<?php 
	// Display Featured Carousel
	get_template_part( 'template-parts/featured', 'carousel' );	
?>

<div class="container-fluid">
	<div class="container">
		<div class="row">
			<div id="secondary" class="widget-area" role="complementary">
			<?php hwcoe_ufl_secondary_widget_area(); ?>
    		</div><!-- .widget-area -->
		</div>
	</div>
</div>

<?php get_sidebar('page_sections'); ?>

<?php get_footer(); ?>
