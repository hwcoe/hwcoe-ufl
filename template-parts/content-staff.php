<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package HWCOE_UFL
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
    <div class="entry-content">
        <?php the_content(); ?>
        
        
        <?php if(have_rows('staff')): ?>
        	<?php while(have_rows('staff')): the_row(); ?>
        	<h3 class="member-name entry-title"><?php the_sub_field('name'); ?></h3>
        	<div class="row">
        		<div class="col-md-2">
	        		<img src="<?php echo get_sub_field('photo')['url']; ?>" alt="<?php the_sub_field('name'); ?>" width="100" />
        		</div>
        		<div class="col-md-10">
	        		<h4><?php the_sub_field('position'); ?></h4>
	        		<p><?php the_sub_field('description'); ?></p>
        		</div>
        	</div>
        	
        	<hr />
        	<?php endwhile; ?>
		<?php endif; ?>
	</div><!-- .entry-content -->
    
    <footer class="entry-footer">
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
