<?php
/**
 * Template part for displaying general content.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package HWCOE_UFL
 */
?>
<!-- content -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( is_archive() ): ?>
		
		<header class="entry-header" aria-label="Archive Item Header">
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		</header><!-- .entry-header -->
		
		<?php if ( has_post_thumbnail() ): ?>
			<div class="entry-thumbnail">
				<?php the_post_thumbnail( 'thumbnail', array( 'class' => 'alignleft' ) ); ?>
			</div>
		<?php endif; ?>
		
	<?php else: ?>
		<?php if ( has_post_thumbnail() ): ?>
			<header class="entry-header" aria-label="Content Header">
				<?php echo hwcoe_ufl_post_featured_image(); ?>	
			</header>
		<?php endif; ?>
		
		<div class="entry-meta">
			<p><?php the_time('F j, Y'); ?> in <?php the_category(', '); ?></p>
		</div><!-- .entry-meta -->
	<?php endif; ?>
	
	<div class="entry-content">
		<?php
			if ( is_singular() ):
				the_content();
			else: 
		?>
			<div class="entry-meta">
				<p><?php the_time('F j, Y'); ?> in <?php the_category(', '); ?></p>
			</div><!-- .entry-meta -->
		<?php	the_excerpt();
			endif;
		?>
	</div><!-- .entry-content -->
	<div class="entry-meta">
		<?php the_tags('<p class="tag">', ' ','</p>'); ?>
	</div>
	
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
	<?php if ( comments_open() ): ?>
		<div id="comment-container">
			<?php comments_template(); ?>
		</div> 
	<?php endif; ?> 
	
</article><!-- #post-## -->
