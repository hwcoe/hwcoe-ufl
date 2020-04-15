<?php
/**
 * Template Name: Staff Listing
 * 
 * @package HWCOE_UFL
 *
 */
	
get_header(); ?>
	
<div id="main" class="container main-content">
	<div class="row">
		<div class="col-sm-12">
			<?php hwcoe_ufl_breadcrumbs(); ?>
			<header class="entry-header" aria-label="Content Header">
				<?php hwcoe_ufl_entry_title(); ?>
			</header>
		</div>
	</div>
	<div class="row">
  
	<?php get_sidebar('page_sidebar'); ?>  
  
		<div class="<?php echo hwcoe_ufl_page_column_class(); ?>">
		<?php 
			while ( have_posts() ) : the_post();
				get_template_part( 'template-parts/content', 'staff' );
			endwhile; // End of the loop. 
		?>
		</div>
   <?php get_sidebar('page_right'); ?> 
  
	</div><!-- .row -->
</div><!-- #main -->

<?php get_footer(); ?>
</body>
</html>