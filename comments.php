<?php
/**
 * The template for comments (if enabled).
 *
 * @package HWCOE_UFL
 * @since 2.3.2
 */
?>
<?php

// don't load it if you can't comment
if ( post_password_required() ) {
  return;
}

?>

  <?php if ( have_comments() ) : ?>

    <h2 class="comments-title"><?php comments_number( __( '<span>No</span> Comments', 'hwcoe-ufl' ), __( '<span>One</span> Comment', 'hwcoe-ufl' ), __( '<span>%</span> Comments', 'hwcoe-ufl' ) );?></h2>

    <section class="comment-list">
      <?php
        wp_list_comments( array(
          'style'             => 'div',
          'short_ping'        => true,
          'avatar_size'       => 40,
          'callback'          => null,
          'type'              => 'all',
          'reply_text'        => __('Reply', 'hwcoe-ufl'),
          'page'              => '',
          'per_page'          => '',
          'reverse_top_level' => null,
          'reverse_children'  => ''
        ) );
      ?>
    </section>

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
    	<nav class="navigation comment-navigation">
      	<div class="comment-nav-prev"><?php previous_comments_link( __( '&larr; Previous Comments', 'hwcoe-ufl' ) ); ?></div>
      	<div class="comment-nav-next"><?php next_comments_link( __( 'More Comments &rarr;', 'hwcoe-ufl' ) ); ?></div>
    	</nav>
    <?php endif; ?>

    <?php if ( ! comments_open() ) : ?>
    	<p class="no-comments"><?php _e( 'Comments are closed.' , 'hwcoe-ufl' ); ?></p>
    <?php endif; ?>

  <?php endif; ?>

  <?php comment_form(); ?>

