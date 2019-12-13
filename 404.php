<?php
/**
 * The template for displaying 404 pages.
 *
 * @package HWCOE_UFL
 */
get_header(); ?>

<main id="main" class="container main-content">
	<div class="row" id="skiplink-dest">
		<div class="col-sm-12">
			<header class="entry-header page-header" aria-label="Content Header">
				<h1><?php esc_html_e( 'Page not found', 'hwcoe-ufl' ); ?></h1>
			</header>
			<!-- .entry-header --> 
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<section class="error-404 not-found">
				<div class="page-content">
					<p><?php esc_html_e( "Sorry, the page you are looking for doesn't appear to exist (or may have moved).", 'hwcoe-ufl' ); ?></p>
					<p><a href="<?php echo home_url(); ?>">Return to the home page</a> <?php esc_html_e( "or try using the search below:", 'hwcoe-ufl' ); ?></p>
					<?php get_search_form(); ?>
				</div>
			</section>
		</div>
	</div>
</main>

<?php get_footer(); ?>
