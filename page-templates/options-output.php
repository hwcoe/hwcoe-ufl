<?php
/**
 * Template Name: Options Output
 * 
 * @package HWCOE_UFL
 *
 */
get_header(); ?>

<div id="main" class="container main-content">
<div class="row">
	<div class="col-sm-12">
		<?php hwcoe_ufl_breadcrumbs(); ?>
		<header class="entry-header">
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
								'page-templates/blank.php', 
								'page-templates/container-landing.php', 
								'page-templates/container-no-sidebar.php', 
								'page-templates/container-right-sidebar.php', 
								'page-templates/home-page.php','membersonly.php', 
								'page-templates/no-container-landing.php',
								'page-templates/options-output.php'
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
		
	</div>
</div>
</div>

<?php get_footer(); ?>
