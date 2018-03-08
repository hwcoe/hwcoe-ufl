<?php
/**
 * Template Name: Home Page
 * 
 * @package UFCLAS_UFL_2015
 *
 */
get_header(); 
?>
	<?php while ( have_posts() ) : the_post(); ?>
	<div id="post-<?php the_ID(); ?>" <?php post_class('page'); ?>>
		<div class="home-section">
			<div class="page-wrapper">
				<?php if( have_rows('page_modules') ): ?>
					<?php while ( have_rows('page_modules') ) : the_row(); ?>
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
						   * Statistics Module
						   * Currently linked with features story module
						   * return up to 4 statistics
						   */
						  ?>
						<?php if( get_row_layout() == 'statistics_module' ): ?>
							<?php include( HWCOE_UFL_INC_DIR . '/ufl-statistics.php' ); ?>
						<?php endif // statistics_module ?>
						<?php
						  /*
						   * Statistics Module Standalone
						   * return up to 4 statistics
						   */
						  ?>
						<?php if( get_row_layout() == 'statistics_module' ): ?>
							<?php include( HWCOE_UFL_INC_DIR . '/ufl-statistics-standalone.php' ); ?>
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
					<?php endwhile //page_modules ?>
				<?php endif // page_modules ?>
			</div> <!-- page-wrapper -->
		</div><!-- home-section -->
	</div>

<?php endwhile //the_post ?>

<?php get_footer(); ?>