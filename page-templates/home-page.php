<?php
/**
 * Template Name: Home Page - No Container
 * 
 * @package HWCOE_UFL
 *
 */
get_header(); 
?>
	<?php while ( have_posts() ) : the_post(); ?>
	<div id="post-<?php the_ID(); ?>" <?php post_class('page'); ?>>
		<div class="home-section">
			<div class="page-wrapper">
				<?php if( have_rows('home_page_modules') ): ?>
					<?php while ( have_rows('home_page_modules') ) : the_row(); ?>
						<?php
						  /*
						   * Featured Story Module
						   * Returns up to three featured stories
						   * with hero graphic
						   */
						?>
						<?php if( get_row_layout() == 'featured_stories' ): ?>
							<?php include( HWCOE_UFL_INC_DIR . '/ufl-featured-story.php' ); ?>				
						<?php endif // featured_story ?>
					
						<?php
						  /*
						   * Secondary Featured Content Module
						   * return 3 secondary feature stories or content blocks
						   */
						 ?>
						<?php if( get_row_layout() == 'secondary_featured' ): ?>
							<?php include( HWCOE_UFL_INC_DIR . '/ufl-secondary-featured.php' ); ?>
						<?php endif // secondary_featured ?>
						<?php
						/*
						* Statistics Module
						* Up to 6 statistics, depending on row count 
						*/
						?>
						<?php if( get_row_layout() == 'statistics_module' ): ?>
							<?php include( HWCOE_UFL_INC_DIR . '/ufl-statistics.php' ); ?>
						<?php endif // statistics_module ?>

						<?php
						  /*
						   * Secondary Module
						   * Modular- can be used multiple times
						   */
						  ?>
						<?php if( get_row_layout() == 'secondary_module' ): ?>
							<?php include( HWCOE_UFL_INC_DIR . '/ufl-secondary.php' ); ?>
						<?php endif // secondary_module ?>
						<?php
						  /*
						   * Profile module 
						   */
						  ?>
						<?php if( get_row_layout() == 'profile_module' ): ?>
							<?php include( HWCOE_UFL_INC_DIR . '/ufl-profile.php' ); ?>
						<?php endif // profile_module ?>
					<?php endwhile //home_page_modules ?>
				<?php endif // home_page_modules ?>
			</div> <!-- page-wrapper -->
		</div><!-- home-section -->
	</div>
<?php endwhile //the_post ?>

<?php if ( is_front_page() ) {
	get_sidebar('page_sections'); 
} ?>
<?php get_footer(); ?>