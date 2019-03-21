<?php
/**
 * Template part for displaying page content in landing-page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package HWCOE_UFL
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<div class="entry-content">
		<?php the_content(); ?>
		<?php if( have_rows('landing_page_modules') ): ?>
			<?php while ( have_rows('landing_page_modules') ) : the_row(); ?>
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
				   * Secondary with Image Module
				   * Modular- can be used multiple times
				   */
				?>
				<?php if( get_row_layout() == 'secondary_with_image' ): ?>
					<?php include( HWCOE_UFL_INC_DIR . '/ufl-secondary-image.php' ); ?>
				<?php endif // secondary_with_image ?>
				<?php
				  /*
				   * Statistics Wide Module
				   * Up to 6 statistics, depending on row count 
				   */
				  ?>
				<?php if( get_row_layout() == 'statistics_module' ): ?>
					<?php include( HWCOE_UFL_INC_DIR . '/ufl-statistics.php' ); ?>
				<?php endif // statistics_module ?>
				<?php
				  /*
				   * Category Content Module 
				   * Get recent post, or add content 
				   */
				  ?>
				<?php if( get_row_layout() == 'category_content' ): ?>
					<?php include( HWCOE_UFL_INC_DIR . '/ufl-category-content.php' ); ?>
				<?php endif // category_content ?>
				<?php
				  /*
				   * Image Callout
				   * Three image callout
				   */
				  ?>
				<?php if( get_row_layout() == 'triple_image_callout' ): ?>
					<?php include( HWCOE_UFL_INC_DIR . '/ufl-image-callout.php' ); ?>
				<?php endif // triple_image_callout ?>
				<?php
				  /*
				   * Content Block with Quote 
				   */
				  ?>
				<?php if( get_row_layout() == 'secondary_content_with_quote_block' ): ?>
					<?php include( HWCOE_UFL_INC_DIR . '/ufl-secondary-quote.php' ); ?>
				<?php endif // secondary_content_with_quote_block ?>
				<?php
				  /*
				   * General Content- No Formatting 
				   */
				  ?>
				<?php if( get_row_layout() == 'general_content' ): ?>
					<?php include( HWCOE_UFL_INC_DIR . '/ufl-content.php' ); ?>
				<?php endif // general_content ?>
				<?php
				  /*
				   * General Content- Image
				   * Left or Right justified image
				   */
				  ?>
				<?php if( get_row_layout() == 'general_content_with_image' ): ?>
					<?php include( HWCOE_UFL_INC_DIR . '/ufl-content-image.php' ); ?>
				<?php endif // general_content_with_image ?>
				<?php
				  /*
				   * List Sub-Pages
				   */
				  ?>
				<?php if( get_row_layout() == 'list_sub_pages' ): ?>
					<?php include( HWCOE_UFL_INC_DIR . '/ufl-sub-page-list.php' ); ?>
				<?php endif // list_sub_pages ?>
				<?php
				  /*
				   * List Posts from category
				   */
				  ?>
				<?php if( get_row_layout() == 'archive_content' ): ?>
					<?php include( HWCOE_UFL_INC_DIR . '/ufl-landing-page-archive.php' ); ?>
				<?php endif // archive_content ?>
				<?php
				  /*
				   * Profiles 
				   */
				  ?>
				<?php if( get_row_layout() == 'profile_module' ): ?>
					<?php include( HWCOE_UFL_INC_DIR . '/ufl-profile.php' ); ?>
				<?php endif // profile_module ?>
 			<?php endwhile // the_row ?>
		<?php endif // have_rows ?>
	</div><!-- .entry-content -->
	
	<footer class="entry-footer container">
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'hwcoe-ufl' ),
				'after'  => '</div>',
			) );
			
			edit_post_link(
				sprintf(
					esc_html__( 'Edit %s', 'hwcoe-ufl' ),
					the_title( '<span class="sr-only">"', '"</span>', false )
				),
				'<span class="edit-link">',
				'</span>'
			);
		?>
	</footer><!-- .entry-footer -->
	
</article><!-- #post-## -->
