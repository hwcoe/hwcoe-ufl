<?php
  $image    = '';
  $content  = '';
  $headline = '';
  $category_obj   = (get_sub_field( 'pull_latest_from_category' ) ? get_sub_field( 'category' ) : '' );
  $category_id    = $category_obj[0]->term_id;
  $category_name  = ($category_obj[0]->name ? $category_obj[0]->name : get_sub_field( 'category_tag' ));

?>
<?php if( get_sub_field( 'pull_latest_from_category' ) ): ?>
  <?
    /*
     * Pull latest story with image
     * from specified category
     */
  ?>
  <?php
    $args = array(
    'posts_per_page'   => 10,
    'category'         => $category_id, 
    'orderby'          => 'date',
    'order'            => 'DESC',
    'post_type'        => 'post',
    'post_parent'      => '',
    'post_status'      => 'publish',
    'suppress_filters' => true 
  );
  $posts_array = get_posts( $args );
  
  foreach( $posts_array as $post ){ 
    if( has_post_thumbnail( $post->ID ) ){
      $image    = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
      $image    = $image[0];
      $content  = apply_filters( 'the_content', get_post_field( 'post_content', $post->ID ) );
      $headline = get_the_title( $post->ID );
      break;
    }
  }
  wp_reset_postdata();
  ?>
<?php else: ?>
  <?php
    $image    = get_sub_field( 'image' );
    $content  = get_sub_field( 'content' );
    $headline = get_sub_field( 'headline' );
  ?>
<?php endif // pull_latest_from_category ?>


<div class="content-box-module" id="<?php the_sub_field( 'in_page_anchor' ); ?>">
    <div class="container">
      <div class="row">
        <?php if( 'left' == get_sub_field( 'image_position' ) ): ?>
        <div class="col-sm-7 content-box-copy">
        <?php if( $headline ): ?>
        <h2><?php echo $headline; ?></h2>
        <?php endif; ?>
          <?php echo $content; ?>
          <?php if( have_rows ( 'buttons' ) ): ?>
            <?php while( have_rows( 'buttons' ) ) : the_row(); ?>
              <a href="<?php the_sub_field( 'button_url' ); ?>" class="read-more"><?php the_sub_field( 'button_text' ); ?></a>
              <?php endwhile // have_rows ?>
            <?php endif // have_rows ?>
            <span class="category-tag orange"><?php echo $category_name; ?></span>
        </div>
        <div class="col-sm-5 content-box-img" style="background-image:url(<?php echo $image; ?>)">
          <img src="http://dummyimage.com/470x532" alt="" class="visuallyhidden">
        </div>
        <?php elseif( 'right' == get_sub_field( 'image_position' ) ): ?>
         <div class="col-sm-5 content-box-img" style="background-image:url(<?php echo $image; ?>)">
          <img src="http://dummyimage.com/470x532" alt="" class="visuallyhidden">
        </div>
        <div class="col-sm-7 content-box-copy">
        <?php if( $headline ): ?>
        <h2><?php echo $headline; ?></h2>
        <?php endif ?>
          <?php echo $content; ?>
          <?php if( have_rows ( 'buttons' ) ): ?>
            <?php while( have_rows( 'buttons' ) ) : the_row(); ?>
              <a href="<?php the_sub_field( 'button_url' ); ?>" class="read-more"><?php the_sub_field( 'button_text' ); ?></a>
              <?php endwhile // have_rows ?>
            <?php endif // have_rows ?>
            <span class="category-tag orange"><?php echo $category_name; ?></span>
        </div>
        <?php endif // image_position ?>
      </div>
    </div>
  </div>
