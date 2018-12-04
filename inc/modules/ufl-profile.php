
<div class="feature-bio-wrap hor-scroll-wrap">
	<div class="container">
		<div class="feature-bios">
			<div class="bio-wrap">
<?php if( have_rows('profile') ): ?>
<?php 
	$profile_count = 0; 
	$featured_bio_copy = '';
	$button_text = '';
	$button_label = '';
?>
	<?php while ( have_rows('profile') ) : the_row(); ?> 
		<?php if( 0 === $profile_count ){
			$featured_bio_copy .=   '<div class="feature-bio-copy-wrap">';
			$featured_bio_copy .=   '<h2>' . get_sub_field( 'profile_name' ) . '</h2>';
			$featured_bio_copy .=   '<h3>' . get_sub_field( 'title' ) . '</h3>';
			$featured_bio_copy .=   '<p>' .  get_sub_field( 'description' ) . '</p>';
			if( get_sub_field( 'include_button' ) ){
				$button_text = strtolower( get_sub_field( 'button_text' ) );
				if ( $button_text == "learn more" ||  $button_text == 'read more' ) {
					$button_label = "Read More: " . get_sub_field( 'profile_name' );
				}
				else {
					$button_label = get_sub_field( 'button_text' );
				}
				$featured_bio_copy .= '<a href="' . get_sub_field( 'button_url' ) . '" class="btn btn--white" aria-label="' . $button_label . '">' . get_sub_field( 'button_text' ) . '<span class="arw-right icon-svg"><svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="' . HWCOE_UFL_IMG_DIR . '/spritemap.svg#arw-right"></use></svg></span></a>';
		 	}
		 	if ( get_sub_field( 'profile_type' ) ) {
				$featured_bio_copy .=   '<span class="category-tag orange">' . get_sub_field( 'profile_type' ) . '</span>';
			}
			$featured_bio_copy .=   '<span class="btn-circle arw-right icon-svg"><svg><use xlink:href="' . HWCOE_UFL_IMG_DIR . '/spritemap.svg#arw-right"></use></svg></span>';
		 	$featured_bio_copy .= '</div>';
		} // profile_count ?>
		<?php $profile_image = (get_sub_field( 'profile_image' ) ? "style='background-image:url(" . get_sub_field( 'profile_image' ) . ");' " : '');?>
		<div class="bio hor-scroll-el">
			<div class="bio-img" <?php echo $profile_image; ?>></div>
			<div class="copy-wrap">
				<h2><?php the_sub_field( 'profile_name' ); ?></h2>
				<h3><?php the_sub_field( 'title' ); ?></h3>
				<p><?php the_sub_field( 'description' ); ?></p>
				<?php if( get_sub_field( 'include_button' ) ): 
					$button_text = strtolower( get_sub_field( 'button_text' ) );
					if ( $button_text == "learn more" ||  $button_text == 'read more' ) {
						$button_label = "Read More: " . get_sub_field( 'profile_name' );
					}
					else {
						$button_label = get_sub_field( 'button_text' );
					}
				?>
				<a href="<?php the_sub_field( 'button_url' ); ?>" class="btn btn--white" aria-label="<?php echo $button_label; ?>"><?php the_sub_field( 'button_text' ); ?> <span class="arw-right icon-svg"><svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php echo HWCOE_UFL_IMG_DIR; ?>/spritemap.svg#arw-right"></use></svg></span></a>
				<?php endif // include_button ?>
				<?php if ( get_sub_field( 'profile_type' ) ) : ?>
					<span class="category-tag orange"><?php the_sub_field( 'profile_type' ); ?></span>
				<?php endif ?>
				<span class="btn-circle arw-right icon-svg"><svg><use xlink:href="<?php echo HWCOE_UFL_IMG_DIR; ?>/spritemap.svg#arw-right"></use></svg></span>
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
