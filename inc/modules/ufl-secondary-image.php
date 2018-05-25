<?php 
  $image_side = get_sub_field( 'image_position' );
?>
<div class="gal-list-wrap">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
        <?php if( 'left' == $image_side ): ?>
          <div class="gal-with-caption">
          <div class="gal-img" style="background:url(<?php the_sub_field( 'image' ); ?>); background-size:cover;">
            </div>
            <?php if( get_sub_field( 'image_heading' ) ): ?>
            <div class="caption"><?php the_sub_field( 'image_heading' ); ?></div>
            <?php endif // image_heading ?>
          </div>
        <?php else: ?>
        <h2><?php the_sub_field( 'headline' ); ?></h2>
          <div>
            <?php the_sub_field( 'content' ); ?>
          </div>
        <?php endif // image_side ?>
        </div>
        <div class="col-md-6 gal-img-content">
        <?php if( 'left' == $image_side ): ?>
        <h2><?php the_sub_field( 'headline' ); ?></h2>
          <div>
            <?php the_sub_field( 'content' ); ?>
          </div>
        <?php else: ?>
          <div class="gal-with-caption">
          <div class="gal-img" style="background:url(<?php the_sub_field( 'image' ); ?>); background-size:cover;">
            </div>
            <?php if( get_sub_field( 'image_heading' ) ): ?>
            <div class="caption"><?php the_sub_field( 'image_heading' ); ?></div>
            <?php endif // image_heading ?>
        <?php endif // left_side ?>
        </div>
      </div>
    </div>
  </div>
</div>
