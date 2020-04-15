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
		
		<?php if( have_rows('staff_listing') ): ?>
			<?php while( have_rows('staff_listing') ): the_row(); ?>
				<?php if( get_row_layout() == 'staff_listing_section' ): ?>
					<?php 
						$section_heading = ( get_sub_field('staff_section_heading') ? get_sub_field('staff_section_heading') : ''); 
						if ($section_heading != '') {
							echo "<h2>" . esc_html($section_heading) . "</h2>";
						}
					?>
					<?php if( have_rows ( 'staff_member' ) ): ?>
						<?php while( have_rows( 'staff_member' ) ) : the_row(); ?>
							<?php 
								$staff_name				= get_sub_field('staff_name');
								$staff_url				= ( get_sub_field('staff_url') ? get_sub_field('staff_url') : '');
								$staff_title			= get_sub_field('staff_title');
								$staff_description	= ( get_sub_field('staff_description') ? get_sub_field('staff_description') : '' );
								if ( get_sub_field('staff_photo') ) {
									$staff_photo_url	= get_sub_field('staff_photo')['url'];
								} else {
									$staff_photo_url	= '';
								}
							?>
							<h3 class="member-name entry-title">
								<?php if($staff_url != ''): ?>
								<a href="<?php echo esc_url($staff_url); ?>"><?php echo esc_html($staff_name); ?></a>
								<?php else: ?>
									<?php echo esc_html($staff_name); ?>
								<?php endif; // $staff_url ?>
							</h3>
							<div class="row">
							<?php if ($staff_photo_url != ''): ?>
								<div class="col-md-3">			
									<img src="<?php echo esc_url($staff_photo_url); ?>" alt="<?php echo esc_attr($staff_name); ?>" class="alignnone" />
								</div>
								<div class="col-md-9">
							<?php else: ?>
								<div class="col-md-12">
							<?php endif; // $staff_photo_url ?>
									<h4><?php echo esc_html($staff_title); ?></h4>
									<?php if($staff_description != '') {
										echo wpautop( wp_kses_post($staff_description) );
									} ?>
								</div>
							</div> <!-- row -->
							<hr style="margin:20px 0 30px;" />

						<?php endwhile // the_row staff_member ?>
					<?php endif // have_rows staff_member ?>
				<?php endif; // get_row_layout staff_listing_section ?>
			<?php endwhile; //the_row staff_listing ?>
		<?php endif; // have_rows staff_listing ?>
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
