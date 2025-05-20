<?php
/**
 * Template Name: Options Output
 * 
 * @package HWCOE_UFL
 *
 */
get_header(); ?>

<main id="main" class="container main-content">
<div class="row">
	<div class="col-sm-12">
		<?php hwcoe_ufl_breadcrumbs(); ?>
		<header class="entry-header" aria-label="Content Header">
			<?php hwcoe_ufl_entry_title(); ?>
		</header>
		<!-- .entry-header --> 
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<?php 
			while ( have_posts() ) : the_post();
				get_template_part( 'template-parts/content', 'page' );
			endwhile; // End of the loop. 
		?>

		<?php
					echo "<h3>Non Default Page template</h3>";
					echo "<ul>";
					$args = [
						'post_type' => 'page',
						'posts_per_page' => -1,
						'meta_query' => array(
							array(
							'key'     => '_wp_page_template',
							'value'   => array(
								// 'page-templates/blank.php', 
								// 'page-templates/container-landing.php', 
								// 'page-templates/container-no-sidebar.php', 
								// 'page-templates/container-right-sidebar.php', 
								// 'page-templates/home-page.php',
								// 'page-templates/membersonly.php', 
								// 'page-templates/no-container-landing.php',
								// 'page-templates/options-output.php',
								// 'page-templates/staff.php',
								'page-templates/career-fair-landing.php',
								'page-templates/event-info-year.php',
								'page-templates/event-info-co-closed.php',
								'page-templates/event-info-co-display.php',
								'page-templates/event-info-co-marketing.php',
								'page-templates/event-info-co-open.php',
								'page-templates/event-info-date.php',
								'page-templates/event-info-date-comma.php',
								'page-templates/event-info-display-name.php',
								'page-templates/event-info-end-time.php',
								'page-templates/event-info-location.php',
								'page-templates/event-info-location-simple.php',
								'page-templates/event-info-semester.php',
								'page-templates/event-info-start-time.php',
								'page-templates/event-info-stud-closed.php',
								'page-templates/event-info-stud-open.php'
								)
							)
						)
					];
					$pages = get_posts( $args );
					foreach ( $pages as $page ){
						echo '<li><a href="' . get_permalink( $page ) . '">'.get_the_title( $page ).'</a></li>';
					}
					echo "</ul>";
				?>
				<?php
				echo "<h3>Non Default Post template</h3>";
					echo "<ul>";
					$args = [
						'post_type' => 'post',
						'posts_per_page' => -1,
						'meta_query' => array(
							array(
							'key'     => '_wp_page_template',
							'value'   => array(
								'single-post-newsletter.php',
								'single-post-company.php'
								)
							)
						)
					];
					$posts = get_posts( $args );
					foreach ( $posts as $post ){
						echo '<li><a href="' . get_permalink( $post ) . '">'.get_the_title( $post ).'</a></li>';
					}
					echo "</ul>";
				?>
				<?php
					echo "<h3>Members only</h3>";
					echo "<ul>";
					$args = [
						'post_type' => 'page',
						'posts_per_page' => -1,
						'meta_query' => array(
							array(
							'key'     => 'custom_meta_visitor_auth_level',
							'value'   => array('GatorLink Users', 'WordPress Users')
							)
						)
					];
					$pages = get_posts( $args );
					foreach ( $pages as $page ) {
						echo '<a href="' . get_permalink( $page ) . '">'.get_the_title( $page ).'</a><br />';
					}
					echo "</ul>";

				?>

				<?php
					echo "<h3>Post/Page with Title Override</h3>";
					echo "<ul>";
					$args = [
						// 'post_type' => 'page',
						'post_type' => array( 'post', 'page'),
						'posts_per_page' => -1,		
						'meta_query' => array(
							'relation' => 'OR',
							array(
							'key'     => 'custom_meta_page_title_override',
							'value'   => '',
							'compare' => '!='
							),
							array(
							'key'     => 'custom_meta_post_title_override',
							'value'   => '',
							'compare' => '!='
							),
						),
					];
					$pages = get_posts( $args );
					foreach ( $pages as $page ) {
						echo '<a href="' . get_permalink( $page ) . '">'.get_the_title( $page ).'</a><br />';
					}
					echo "</ul>";

				?>
				<?php
					echo "<h3>Page with Full width content container</h3>";
					echo "<ul>";
					$args = [
						'post_type' => 'page',
						'posts_per_page' => -1,
						'meta_query' => array(
							array(
							'key'     => 'full_width_content_container',
							'value'   => true
							)
						)
					];
					$pages = get_posts( $args );
					foreach ( $pages as $page ) {
						echo '<a href="' . get_permalink( $page ) . '">'.get_the_title( $page ).'</a><br />';
					}
					echo "</ul>";

				?>
				<?php
					echo "<h3>Post with hidden featured image</h3>";
					echo "<ul>";
					$args = [
						'post_type' => 'post',
						'posts_per_page' => -1,
						'meta_query' => array(
							array(
							'key'     => 'hide_featured_image',
							'value'   => true
							)
						)
					];
					$pages = get_posts( $args );
					foreach ( $pages as $page ) {
						echo '<a href="' . get_permalink( $page ) . '">'.get_the_title( $page ).'</a><br />';
					}
					echo "</ul>";

				?>

				<?php
					echo "<h3>Post with full width featured image in single post view</h3>";
					echo "<ul>";
					$args = [
						'post_type' => 'post',
						'posts_per_page' => -1,
						'meta_query' => array(
							array(
							'key'     => 'full_width_featured_image',
							'value'   => true
							)
						)
					];
					$pages = get_posts( $args );
					foreach ( $pages as $page ) {
						echo '<a href="' . get_permalink( $page ) . '">'.get_the_title( $page ).'</a><br />';
					}
					echo "</ul>";

				?>

				<?php
					echo "<h3>Post with featured image as hero</h3>";
					echo "<ul>";
					$args = [
						'post_type' => 'post',
						'posts_per_page' => -1,
						'meta_query' => array(
							array(
							'key'     => 'post_hero_image',
							'value'   => true
							)
						)
					];
					$pages = get_posts( $args );
					foreach ( $pages as $page ) {
						echo '<a href="' . get_permalink( $page ) . '">'.get_the_title( $page ).'</a><br />';
					}
					echo "</ul>";

				?>
		
	</div>
</div>
</main>

<?php get_footer(); ?>
