<?php

$args = array(
  'sort_order' => 'asc',
  'sort_column' => 'menu_order',
  'hierarchical' => 0,
  'child_of' => 0,
  'parent' => get_the_ID(), 
  'exclude_tree' => '',
  'number' => get_sub_field( 'maximum_to_display' ),
  'offset' => 0,
  'post_type' => 'page',
  'post_status' => 'publish'
); 
$pages = get_pages($args); 
$show_thumb     = get_sub_field( 'show_thumbnail' );
$show_excerpt   = get_sub_field( 'show_excerpt' );
$list_children  = get_sub_field( 'list_sub_children' );

foreach( $pages as $page ): ?>
<?php 
  $link     = get_permalink( $page->ID );
  $title    = $page->post_title;
  $image    = '';
  if ( $show_thumb ){
    $image    = wp_get_attachment_url( get_post_thumbnail_id($page->ID) );
  }
  $content  = '';
  if( $show_excerpt ){
    $content  = ($page->post_excerpt ? $page->post_excerpt : wp_trim_words( $page->post_content , 50 ) . "..." );
  }
?>
<div class="container">
  <div class="row">
    <div class="col-sm-12 col-md-10 col-md-offset-1">
      <div class="row">
        <?php if( $show_thumb && $image ): ?>
          <div class="col-sm-4">
            <img src="<?php echo $image; ?>" alt="<?php echo $title; ?>" class="img-full">
          </div>
        <div class="col-sm-8">
        <?php else: // show_thumb ?>
        <div class="col-sm-12 sub-page-list-item">
        <?php endif // show_thumb ?>
        <h2><a href="<?php echo $link; ?>"><?php echo $title; ?></a></h2>
        <div class="normal"><?php echo $content; ?>
          <a class="read-more" href="<?php echo $link; ?>">Read More</a>
        </div>
        <?php if( $list_children ): ?>
        <?php 
          $args = array(
            'sort_order' => 'asc',
            'sort_column' => 'menu_order',
            'hierarchical' => 0,
            'child_of' => 0,
            'parent' => $page->ID, 
            'exclude_tree' => '',
            'number' => get_sub_field( 'maximum_to_display' ),
            'offset' => 0,
            'post_type' => 'page',
            'post_status' => 'publish'
          ); 
          $subpages = get_pages($args); 
         ?>
          <?php if( $subpages ): ?>
            <div class="col-sm-8">
              <br />
              <h3>Related</h3>
              <ul class="big-list">
              <?php foreach( $subpages as $subpage ): ?>
              <li><a href="<?php echo get_permalink( $subpage->ID ); ?>"><?php echo $subpage->post_title; ?> <span class="arw-right icon-svg"><svg><use xlink:href="<?php echo HWCOE_UFL_IMG_DIR; ?>/spritemap.svg#arw-right"></use></svg></span></a></li> 
              <?php endforeach // subpage ?>
              </ul>
            </div>
          <?php endif // subpages ?>
        <?php endif // list_children ?> 
        </div>
      </div>
      <hr>
    </div>
  </div>
</div>
<?php endforeach // pages ?>
