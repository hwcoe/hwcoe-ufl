<main id="main" class="container post-<?php the_ID(); ?>">
  <div class="row">
    <div class="col-sm-12">
      <?php the_title( '<h1>', '</h1>' ); ?>
    </div>
  </div>
</main>
<?php if( have_rows('double_image_landing_page') ): ?>
  <?php while ( have_rows('double_image_landing_page') ) : the_row(); ?>
    <div class="landing-page-hero">
      <div class="container">
        <div class="row">
          <div class="col-sm-7 col-sm-pull-1">
          <div class="img-hero" style="background-image:url(<?php the_sub_field( 'first_image' ); ?>)"></div>
          </div>
          <div class="col-sm-5 col-sm-offset-5 hero-content">
            <h2><?php the_sub_field( 'secondary_headline' ); ?></h2>
            <p><?php the_sub_field( 'description' ); ?>
          </div>
          <div class="col-sm-7 secondary">
            <div class="img-hero" style="background-image:url(<?php the_sub_field( 'second_image' ); ?>)"></div>
          </div>
        </div>
      </div>
    </div>
  <?php endwhile // ?>
<?php endif // ?>


        
