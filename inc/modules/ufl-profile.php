
<div class="feature-bio-wrap hor-scroll-wrap">
  <div class="container">
    <div class="feature-bios">
      <div class="bio-wrap">
<?php if( have_rows('profile') ): ?>
<?php 
  $profile_count = 0; 
  $featured_bio_copy = '';
?>
  <?php while ( have_rows('profile') ) : the_row(); ?> 
    <?php if( 0 === $profile_count ){
     $featured_bio_copy .=   '<div class="feature-bio-copy-wrap">';
     $featured_bio_copy .=   '<h2>' . get_sub_field( 'profile_name' ) . '</h2>';
     $featured_bio_copy .=   '<h3>' . get_sub_field( 'title' ) . '</h3>';
     $featured_bio_copy .=   '<p>' .  get_sub_field( 'description' ) . '</p>';
     if( get_sub_field( 'include_button' ) ){
      $featured_bio_copy .= '<a href="' . get_sub_field( 'button_url' ) . '" class="btn btn--white">' . get_sub_field( 'button_text' ) . '<span class="arw-right icon-svg"><svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="' . UFL_ATHENA_IMG_DIR . '/spritemap.svg#arw-right"></use></svg></span></a>';
     }
     $featured_bio_copy .=   '<span class="category-tag orange">' . get_sub_field( 'profile_type' ) . '</span>';
     $featured_bio_copy .=   '<span class="btn-circle arw-right icon-svg"><svg><use xlink:href="' . UFL_ATHENA_IMG_DIR . '/spritemap.svg#arw-right"></use></svg></span>';
     $featured_bio_copy .= '</div>';
      } // profile_count ?>
      <?php
        $profile_image = (get_sub_field( 'profile_image' ) ? "style='background-image:url(" . get_sub_field( 'profile_image' ) . ");' " : '');
      ?>
      <div class="bio hor-scroll-el">
        <div class="bio-img" <?php echo $profile_image; ?>></div>
        <div class="copy-wrap">
          <h2><?php the_sub_field( 'profile_name' ); ?></h2>
          <h3><?php the_sub_field( 'title' ); ?></h3>
          <p><?php the_sub_field( 'description' ); ?></p>
          <?php if( get_sub_field( 'include_button' ) ): ?>
          <a href="<?php the_sub_field( 'button_url' ); ?>" class="btn btn--white"><?php the_sub_field( 'button_text' ); ?> <span class="arw-right icon-svg"><svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php echo UFL_ATHENA_IMG_DIR; ?>/spritemap.svg#arw-right"></use></svg></span></a>
          <?php endif // include_button ?>
          <span class="category-tag orange"><?php the_sub_field( 'profile_type' ); ?></span>
          <span class="btn-circle arw-right icon-svg"><svg><use xlink:href="<?php echo UFL_ATHENA_IMG_DIR; ?>/spritemap.svg#arw-right"></use></svg></span>
        </div>
      </div>


    <?php $profile_count++; ?>
  <?php endwhile // the_row ?>
<?php endif // have_rows ?>
<?php echo $featured_bio_copy; ?>
            </div>
          </div>
        </div>
      </div>
