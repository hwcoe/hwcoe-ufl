<!-- ufl-profile module -->
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
			$title_markup = ( get_sub_field( 'title' ) ? '<h3>' . esc_html( get_sub_field( 'title' ) ) . '</h3>' : '');
			$featured_bio_copy .=   '<div class="feature-bio-copy-wrap">';
			$featured_bio_copy .=   '<h2>' . esc_html( get_sub_field( 'profile_name' ) ) . '</h2>';
			$featured_bio_copy .=	$title_markup;
			$featured_bio_copy .=  wpautop( wp_kses_post( get_sub_field( 'description' ) ) );
			if( get_sub_field( 'include_button' ) ){
				$button_text = get_sub_field( 'button_text' ) ;
				if ( strtolower( $button_text ) == "learn more" || strtolower( $button_text ) == "read more")  {
						$button_label = $button_text . ": " . esc_attr( get_sub_field( 'profile_name' ) );
				}
				else {
					$button_label = $button_text;
				}

				$featured_bio_copy .= '<a href="' . esc_url( get_sub_field( 'button_url' ) ) . '" class="btn btn--white profile-link-'. $profile_count . '" aria-label="' . $button_label . '">' . $button_text . '<span class="arw-right icon-svg"><svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="' . HWCOE_UFL_IMG_DIR . '/spritemap.svg#arw-right"></use></svg></span></a>';
		 	}
		 	if ( get_sub_field( 'profile_type' ) ) {
				$featured_bio_copy .=   '<span class="category-tag orange">' . esc_html( get_sub_field( 'profile_type' )) . '</span>';
			}
			$featured_bio_copy .=   '<span class="btn-circle arw-right icon-svg"><svg><use xlink:href="' . HWCOE_UFL_IMG_DIR . '/spritemap.svg#arw-right"></use></svg></span>';
		 	$featured_bio_copy .= '</div>';
		} // profile_count ?>
		<?php 
			$profile_image = (get_sub_field( 'profile_image' ) ? "style='background-image:url(" . esc_url( get_sub_field( 'profile_image' ) ) . ");' " : '');
			$title_markup = (get_sub_field( 'title' ) ? '<h3>' . esc_html( get_sub_field( 'title' ) ) . '</h3>' : '');
		?>
		<div class="bio hor-scroll-el">
			<div class="bio-img" <?php echo $profile_image; ?>></div>
			<div class="copy-wrap">
				<h2><?php the_sub_field( 'profile_name' ); ?></h2>
				<?php echo $title_markup; ?>
				<p><?php the_sub_field( 'description' ); ?></p>
				<?php if( get_sub_field( 'include_button' ) ): 
					$button_text = get_sub_field( 'button_text' ) ;					
					if ( strtolower( $button_text ) == "learn more" || strtolower( $button_text ) == "read more")  {
						$button_label = $button_text . ": " . esc_attr( get_sub_field( 'profile_name' ) );
					}
					else {
						$button_label = $button_text;
					}
				?>
				<a href="<?php esc_url( the_sub_field( 'button_url' ) ); ?>" class="btn btn--white profile-link-<?php echo $profile_count; ?>" aria-label="<?php echo $button_label; ?>"><?php echo $button_text; ?> <span class="arw-right icon-svg"><svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php echo HWCOE_UFL_IMG_DIR; ?>/spritemap.svg#arw-right"></use></svg></span></a>
				<?php endif // include_button ?>
				<?php if ( get_sub_field( 'profile_type' ) ) : ?>
					<span class="category-tag orange"><?php esc_html_e( the_sub_field( 'profile_type' ) ); ?></span>
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
