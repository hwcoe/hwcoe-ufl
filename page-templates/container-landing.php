<?php
/**
 * Template Name: Landing Page - Container
 * 
 * @package HWCOE_UFL
 *
 */
get_header(); ?>
<?php 
	if ( has_post_thumbnail() ):
		add_filter( 'the_title', 'hwcoe_ufl_title', 10, 2 );
		$custom_meta = get_post_meta( get_the_ID() );
		$custom_meta_image_height = ( isset( $custom_meta['custom_meta_image_height']) )? $custom_meta['custom_meta_image_height'][0] : '';
		$shortcode = sprintf( '[ufl-landing-page-hero headline="%s" image="%d" image_height="%s"]%s[/ufl-landing-page-hero]', 
			get_the_title(),
			get_post_thumbnail_id(),
            $custom_meta_image_height,
			''
		);
		echo do_shortcode( $shortcode );
		remove_filter( 'the_title', 'hwcoe_ufl_title', 10, 2 );
	endif;
?>
<main id="main" class="container main-content">
    <div class="row">
        <div class="col-sm-12">
            <?php 
				if ( ! has_post_thumbnail() ): 
					hwcoe_ufl_entry_title();
				endif;
			?>
			
			<?php while ( have_posts() ) : the_post(); ?>
	
				<?php get_template_part( 'template-parts/content', 'landing' ); ?>
        
        	<?php endwhile; // End of the loop. ?>

        </div>
    </div>
    
</main>

<?php get_footer(); ?>