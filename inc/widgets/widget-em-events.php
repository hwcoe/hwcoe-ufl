<?php
/**
 * Events Manager UF-Branded events widget
 * @package HWCOE_UFL
 * @since 1.2.0
 *
 */

class HWCOE_Events_Widget extends WP_Widget {
	var $defaults;
	
	public static function init(){
		return register_widget("HWCOE_Events_Widget");
	}

	/** constructor */
	function __construct() {
		$this->defaults = array(
			'title' => __('Events','events-manager'),
			'scope' => 'future',
			'order' => 'ASC',
			'limit' => 5,
			'category' => 0,
			'format' => '<li><h4><span class="month">#M</span><span class="day">#d</span></h4><div class="event-info"><h3 class="eventlink">#_EVENTLINK</h3><p class="time">#_EVENTTIMES</p></div></li>',
			'nolistwrap' => false,
			'orderby' => 'event_start_date,event_start_time,event_name',
			'all_events' => 0,
			'all_events_text' => __('All Events', 'events-manager'),
			'no_events_text' => __('No Events', 'events-manager')
		);
		$this->em_orderby_options = apply_filters('em_settings_events_default_orderby_ddm', array(
			'event_start_date,event_start_time,event_name' => __('start date, start time, event name','events-manager'),
			'event_name,event_start_date,event_start_time' => __('name, start date, start time','events-manager'),
			'event_name,event_end_date,event_end_time' => __('name, end date, end time','events-manager'),
			'event_end_date,event_end_time,event_name' => __('end date, end time, event name','events-manager'),
		)); 
		$widget_ops = array('description' => __( "Display a list of events formatted with the UF HWCOE theme.", 'events-manager') );
		parent::__construct(false, $name = 'Events - UF HWCOE Theme', $widget_ops);	
	}
		/** @see WP_Widget::widget */
	function widget($args, $instance) {
		$instance = array_merge($this->defaults, $instance);
		$instance = $this->fix_scope($instance); // depcreciate	

		echo $args['before_widget'];
		if( !empty($instance['title']) ){
			echo $args['before_title'];
			echo apply_filters('widget_title',$instance['title'], $instance, $this->id_base);
			echo $args['after_title'];
		}
		//remove owner searches
		$instance['owner'] = false;
		
		//legacy stuff

		//orderby fix for previous versions with old orderby values
		if( !array_key_exists($instance['orderby'], $this->em_orderby_options) ){
			//replace old values
			$old_vals = array(
				'name' => 'event_name',
				'end_date' => 'event_end_date',
				'start_date' => 'event_start_date',
				'end_time' => 'event_end_time',
				'start_time' => 'event_start_time'
			);
			foreach($old_vals as $old_val => $new_val){
				$instance['orderby'] = str_replace($old_val, $new_val, $instance['orderby']);
			}
		}
		
		//get events
		$events = EM_Events::get(apply_filters('em_widget_events_get_args',$instance));
		
		//output events
		echo "<ul class=\"events-list\">";
		$div_wrap = !preg_match('/^<div>/i', trim($instance['format']));
		
		if ( count($events) > 0 ){
			foreach($events as $event){				
				echo $event->output($instance['format']);
			}
		}else{
			echo '<li>'.$instance['no_events_text'].'</li>';
		}
		if ( !empty($instance['all_events']) ){
			$events_link = (!empty($instance['all_events_text'])) ? em_get_link($instance['all_events_text']) : em_get_link(__('all events','events-manager'));
			echo '<li class="all-events-link">'.$events_link.'</li>';
		}
		echo "</ul>";
		
		echo $args['after_widget'];
	}

	/** @see WP_Widget::update */
	function update($new_instance, $old_instance) {
		foreach($this->defaults as $key => $value){
			if( !isset($new_instance[$key]) ){
				$new_instance[$key] = $value;
			}
			//balance tags and sanitize output formats
			if( in_array($key, array('format', 'no_events_text', 'all_events_text')) ){
				if( is_multisite() && !em_wp_is_super_admin() ) $new_instance[$key] = wp_kses_post($new_instance[$key]); //for multisite
				$new_instance[$key] = force_balance_tags($new_instance[$key]);
			}
		}
		return $new_instance;
	}

	/** @see WP_Widget::form */
	function form($instance) {
		$instance = array_merge($this->defaults, $instance);
		$instance = $this->fix_scope($instance); // depcreciate
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title', 'events-manager'); ?>: </label>
			<input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($instance['title']); ?>" class="widefat" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('limit'); ?>"><?php esc_html_e('Number of events','events-manager'); ?>: </label>
			<input type="text" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" size="3" value="<?php echo esc_attr($instance['limit']); ?>" />
		</p>
		<p>
			
			<label for="<?php echo $this->get_field_id('scope'); ?>"><?php esc_html_e('Scope','events-manager'); ?>: </label><br/>
			<select id="<?php echo $this->get_field_id('scope'); ?>" name="<?php echo $this->get_field_name('scope'); ?>" class="widefat" >
				<?php foreach( em_get_scopes() as $key => $value) : ?>   
				<option value='<?php echo esc_attr($key); ?>' <?php echo ($key == $instance['scope']) ? "selected='selected'" : ''; ?>>
					<?php echo esc_html($value); ?>
				</option>
				<?php endforeach; ?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('order'); ?>"><?php esc_html_e('Order By','events-manager'); ?>: </label>
			<select  id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>" class="widefat">
				<?php foreach($this->em_orderby_options as $key => $value) : ?>   
				<option value='<?php echo esc_attr($key); ?>' <?php echo ( !empty($instance['orderby']) && $key == $instance['orderby']) ? "selected='selected'" : ''; ?>>
					<?php echo esc_html($value); ?>
				</option>
				<?php endforeach; ?>
			</select> 
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('order'); ?>"><?php esc_html_e('Order','events-manager'); ?>: </label>
			<select id="<?php echo $this->get_field_id('order'); ?>" name="<?php echo $this->get_field_name('order'); ?>" class="widefat">
				<?php 
				$order_options = apply_filters('em_widget_order_ddm', array(
					'ASC' => __('Ascending','events-manager'),
					'DESC' => __('Descending','events-manager')
				)); 
				?>
				<?php foreach( $order_options as $key => $value) : ?>   
				<option value='<?php echo esc_attr($key); ?>' <?php echo ($key == $instance['order']) ? "selected='selected'" : ''; ?>>
					<?php echo esc_html($value); ?>
				</option>
				<?php endforeach; ?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('category'); ?>"><?php esc_html_e('Category IDs','events-manager'); ?>: </label>
			<input type="text" id="<?php echo $this->get_field_id('category'); ?>" class="widefat" name="<?php echo $this->get_field_name('category'); ?>" size="3" value="<?php echo esc_attr($instance['category']); ?>" /><br />
			<em><?php esc_html_e('1,2,3 or 2 (0 = all)','events-manager'); ?> </em>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('all_events'); ?>"><?php esc_html_e('Show all events link at bottom?','events-manager'); ?>: </label>
			<input type="checkbox" id="<?php echo $this->get_field_id('all_events'); ?>" name="<?php echo $this->get_field_name('all_events'); ?>" <?php echo (!empty($instance['all_events']) && $instance['all_events']) ? 'checked':''; ?>  class="widefat">
		</p>
		<p id="<?php echo $this->get_field_id('all_events'); ?>-section">
			<label for="<?php echo $this->get_field_id('all_events'); ?>"><?php esc_html_e('All events link text?','events-manager'); ?>: </label>
			<input type="text" id="<?php echo $this->get_field_id('all_events_text'); ?>" name="<?php echo $this->get_field_name('all_events_text'); ?>" value="<?php echo esc_attr( $instance['all_events_text'] ); ?>" >
		</p>
		<script type="text/javascript">
		jQuery('#<?php echo $this->get_field_id('all_events'); ?>').change( function(){
			if( this.checked ){
				jQuery(this).parent().next().show();
			}else{
				jQuery(this).parent().next().hide();
			} 
		}).trigger('change');
		</script>
		<p>
			<label for="<?php echo $this->get_field_id('format'); ?>"><?php esc_html_e('List item format','events-manager'); ?>: </label>
			<textarea rows="5" cols="24" id="<?php echo $this->get_field_id('format'); ?>" name="<?php echo $this->get_field_name('format'); ?>" class="widefat"><?php echo esc_textarea($instance['format']); ?></textarea>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('no_events_text'); ?>"><?php _e('No events message','events-manager'); ?>: </label>
			<input type="text" id="<?php echo $this->get_field_id('no_events_text'); ?>" name="<?php echo $this->get_field_name('no_events_text'); ?>" value="<?php echo esc_attr( $instance['no_events_text'] ); ?>" >
		</p>
		<?php 
	}

	 /**
	 * Backwards compatability for an old setting which is now just another scope.
	 * @param unknown_type $instance
	 * @return string
	 */
	function fix_scope($instance){
		if( !empty($instance['time_limit']) && is_numeric($instance['time_limit']) && $instance['time_limit'] > 1 ){
			$instance['scope'] = $instance['time_limit'].'-months';
		}elseif( !empty($instance['time_limit']) && $instance['time_limit'] == 1){
			$instance['scope'] = 'month';
		}elseif( !empty($instance['time_limit']) && $instance['time_limit'] == 'no-limit'){
			$instance['scope'] = 'all';
		}
		return $instance;
	}
}
add_action('widgets_init', 'HWCOE_Events_Widget::init');
?>