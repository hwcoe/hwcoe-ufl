<div class="stat-breaker">
  <div class="hor-scroll-wrap">
    <div class="container">
<?php
  $stat_count = 1;
?>
<?php if( have_rows( 'statistics' ) ): ?>
  <?php while ( have_rows( 'statistics' ) ) : the_row(); ?>
  <?php if( get_sub_field( 'background_image' ) ):?>
    <style>
      .stat-count-<?php echo $stat_count; ?>:hover { background-image:url(<?php the_sub_field( 'background_image' ); ?>); } 
    </style>
  <?php endif // background_image ?>
  <div class="stat-block-wrap stat-count-<?php echo $stat_count; ?> hor-scroll-el col-sm-<?php the_sub_field( 'columns' ); ?>">
          <div class="stat-block">
            <div class="stat">
            <h2><?php the_sub_field( 'statistic_value' ); ?></h2>
            </div>
            <div class="info">
              <div class="info-copy">
                <p><?php the_sub_field( 'statistic_description' ); ?></p>
              </div>
             </div>
          </div>
        </div>
  <?php $stat_count++; ?>
  <?php endwhile // the_row ?>
<?php endif // have_rows ?>
    </div><!-- ./container -->
  </div><!-- ./hor-scroll-wrapper -->
</div><!-- stat-breaker -->
