<!-- START FOOTER -->
<footer class="footer-wrap">

	<?php if( have_rows('footer_buttons', 'option') ): ?>
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<ul class="footer-audience-nav">
							<?php while( have_rows('footer_buttons', 'option') ): the_row(); ?>
								<?php $button_link = ( 'internal' == get_sub_field( 'internal_or_external_link' ) ? get_sub_field( 'internal_link' ) : get_sub_field( 'external_url' ) ); ?>
								<li><a href="<?php echo $button_link; ?>"><?php the_sub_field( 'button_text' ); ?></a></li>
							<?php endwhile // the_row ?>
						</ul>
					</div>
				</div>
			</div><!-- .container -->
		</div><!-- .footer-top -->
	<?php endif; // have_rows ?>
	<div class="footer-bottom">
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-md-push-8 footer-contact-wrap">
					<a href="http://ufl.edu/" class="footer-logo icon-svg">
						<svg>
							<use xlink:href="<?php echo get_template_directory_uri(); ?>/img/spritemap.svg#florida-logo-full"></use>
						</svg>
						<span class="visuallyhidden">University of Florida</span>
					</a>
					<ul class="social-nav">
						<?php hwcoe_ufl_socialnetworks(); ?>
					</ul>
                    <?php get_sidebar('footer_right'); ?>
				</div>
				<div class="col-md-8 col-md-pull-4">
					<?php if ( get_field( 'override_footer_columns', 'option' ) ) : ?>
						<?php if( have_rows('footer_columns', 'option') ): ?>
							<?php while ( have_rows( 'footer_columns', 'option' ) ) : the_row(); ?>
								<div class="col-md-<?php the_sub_field( 'columns' ); ?> col-sm-<?php the_sub_field( 'columns' ); ?> footer-menu">
									<h2><?php the_sub_field( 'heading' ); ?> 
										<span class="icon-svg icon-caret">
											<svg>
												<use xlink:href="<?php echo HWCOE_UFL_IMG_DIR; ?>/spritemap.svg#caret"></use>
											</svg>
											<span class="visuallyhidden">Open/Close</span>
										</span>
									</h2>
									<?php the_sub_field( 'list_items' ); ?>
								</div>
							<?php endwhile // footer_columns ?>
						<?php endif // have_rows footer_columns ?>
					<?php else: // if override_footer_columns is not selected ?> 
						<?php get_sidebar('site_footer'); ?>
					<?php endif //override_footer_columns ?>
				</div>
			</div><!-- .row -->
		</div><!-- .container --> 
	</div><!-- .footer-bottom -->
</footer><!-- .footer-wrap -->
<?php wp_footer(); ?>
</body>
</html>