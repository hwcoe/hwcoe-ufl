<?php
/**
 * Template Name: Blank | No Header or Footer
 * 
 * @package HWCOE_UFL
 *
 */
    
get_header(); ?>
    
     <?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'template-parts/content', 'page' ); ?>
    
    <?php endwhile; // End of the loop. ?>

<?php wp_footer(); ?>
</body>
</html>