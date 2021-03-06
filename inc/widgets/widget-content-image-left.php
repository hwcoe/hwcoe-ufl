<?php 
/**
 * Breaker Widget
 *
 * @package HWCOE_UFL
 * @since 0.4.0
 */
class UFL_2015_Content_Image_Left extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'widget-ufl-content-image-left',
			'description' => __('Content with left image and caption.', 'hwcoe-ufl'),
			'customize_selective_refresh' => true,
		);
		$control_ops = array();
		parent::__construct( 'ufl-content-image-left', __('UFL Content Image Left', 'hwcoe-ufl'), $widget_ops, $control_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		$title = ( !empty( $instance['title'] ) )? $instance['title'] : ''; 
		$text = ( !empty( $instance['text'] ) )? $instance['text'] : '';
		$image = ( !empty( $instance['image'] ) )? $instance['image'] : '';
		$caption = ( !empty( $instance['caption'] ) )? $instance['caption'] : '';
		
        // Apply filters
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
        $text = apply_filters( 'widget_text', $text, $instance, $this );
        
		echo $args['before_widget'];
		
        echo do_shortcode( sprintf(
			'[ufl-content-image-left headline="%s" image="%s" caption="%s"]%s[/ufl-content-image-left]',
			$title,
			$image,
			$caption,
			$text
		));
		
		echo $args['after_widget'];
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 
			'title' => '', 
			'text' => '', 
			'image' => '', 
			'caption' => '' 
		) );
		
		$title = sanitize_text_field( $instance['title'] );
		$image = ( isset( $instance['image'] ) )? $instance['image'] : '';
		$caption = sanitize_text_field( $instance['caption'] );
		
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Headline:', 'hwcoe-ufl'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Content:', 'hwcoe-ufl' ); ?></label>
		<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo esc_textarea( $instance['text'] ); ?></textarea></p>
		
        <p>
        <label for="<?php echo $this->get_field_id( 'image' ); ?>"><?php _e( 'Image', 'hwcoe-ufl' ); ?>:</label>
        <div class="wpshed-media-container">
            <div class="wpshed-media-inner">
                <?php $img_style = ( $instance[ 'image' ] != '' ) ? '' : 'style="display:none;"'; ?>
                <img id="<?php echo $this->get_field_id( 'image' ); ?>-preview" src="<?php echo esc_attr( $instance['image'] ); ?>" <?php echo $img_style; ?> />
                <?php $no_img_style = ( $instance[ 'image' ] != '' ) ? 'style="display:none;"' : ''; ?>
                <span class="wpshed-no-image" id="<?php echo $this->get_field_id( 'image' ); ?>-noimg" <?php echo $no_img_style; ?>><?php _e( 'No image selected', 'hwcoe-ufl' ); ?></span>
            </div>
        <input type="text" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" value="<?php echo esc_attr( $instance['image'] ); ?>" class="wpshed-media-url" />
		<input type="button" value="<?php echo _e( 'Remove', 'hwcoe-ufl' ); ?>" class="button wpshed-media-remove" id="<?php echo $this->get_field_id( 'image' ); ?>-remove" <?php echo $img_style; ?> />
		<?php $image_button_text = ( $instance[ 'image' ] != '' ) ? __( 'Change Image', 'hwcoe-ufl' ) : __( 'Select Image', 'hwcoe-ufl' ); ?>
        <input type="button" value="<?php echo $image_button_text; ?>" class="button wpshed-media-upload" id="<?php echo $this->get_field_id( 'image' ); ?>-button" />
        <br class="clear">
        </div>
        </p>
        
        <p><label for="<?php echo $this->get_field_id( 'caption' ); ?>"><?php _e( 'Caption:', 'hwcoe-ufl' ); ?></label>
		<textarea class="widefat" rows="8" cols="20" id="<?php echo $this->get_field_id('caption'); ?>" name="<?php echo $this->get_field_name('caption'); ?>"><?php echo esc_textarea( $instance['caption'] ); ?></textarea></p>
	<?php
    }

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		if ( current_user_can( 'unfiltered_html' ) ) {
			$instance['text'] = $new_instance['text'];
		} else {
			$instance['text'] = wp_kses_post( $new_instance['text'] );
		}
		$instance['image'] = esc_url_raw( $new_instance['image'] );
		$instance['caption'] = sanitize_text_field( $new_instance['caption'] );
		
		return $instance;
	}
}