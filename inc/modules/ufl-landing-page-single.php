<?php if( have_rows('single_hero_image') ): ?>
  <?php while ( have_rows('single_hero_image') ) : the_row(); ?>
  <?php
    $title = (get_sub_field( 'title_override' ) ? get_sub_field( 'title_override' ) : get_the_title());
  ?>
  <div id="main" class="landing-page-hero-full post-<?php the_ID(); ?>">
    <div class="hero-img gradient-bg" style="background-image:url(<?php the_sub_field( 'hero_image' ); ?>)">
    <h1><?php echo $title; ?></h1>
    </div>
    <div class="hero-text">
      <div class="container">
        <div class="col-sm-8 col-sm-offset-2">
        <p><?php the_sub_field( 'description' ); ?></p>
        <?php if( get_sub_field( 'include_button' ) ): ?>
          <?php if( have_rows ( 'buttons' ) ): ?>
            <?php while( have_rows( 'buttons' ) ) : the_row(); ?>
              <a href="<?php the_sub_field( 'button_url' ); ?>" class="btn"><?php the_sub_field( 'button_text' ); ?> <span class="arw-right icon-svg"><svg><use xlink:href="<?php echo HWCOE_UFL_IMG_DIR; ?>/spritemap.svg#arw-right"></use></svg></span></a>
            <?php endwhile // have_rows buttons ?>
          <?php endif // have_rows buttons ?>
        <?php endif // include_button ?>
        </div>
      </div>
    </div>
  </div>
  <?php endwhile // ?>
<?php endif // ?>


        
