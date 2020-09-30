<?php
global $EM_Event;
// global $EM_Location;
$required = apply_filters('em_required_html','<span class="required">*</span>');

//determine location types (if needed)
$location_types = array();
if( !get_option('dbem_require_location') && !get_option('dbem_use_select_for_locations') ) {
	$location_types[0] = array(
		'selected' =>  $EM_Event->location_id === '0' || $EM_Event->location_id === 0,
		'description' => esc_html__('No Location','events-manager'),
	);
}
if( EM_Locations::is_enabled() ){
	$location_types['location'] = array(
		'selected' =>  !empty($EM_Event->location_id),
		'display-class' => 'em-location-type-place',
		'description' => esc_html__('Physical Location','events-manager'),
	);
}
foreach( EM_Event_Locations\Event_Locations::get_types() as $event_location_type => $EM_Event_Location_Class ){ /* @var EM_Event_Locations\Event_Location $EM_Event_Location_Class */
	if( $EM_Event_Location_Class::is_enabled() ){
		$location_types[$EM_Event_Location_Class::$type] = array(
			'display-class' => 'em-event-location-type-'. $EM_Event_Location_Class::$type,
			'selected' => $EM_Event_Location_Class::$type == $EM_Event->event_location_type,
			'description' => $EM_Event_Location_Class::get_label(),
		);
	}
}
?>
<div class="em-input-field em-input-field-select em-location-types <?php if( count($location_types) == 1 ) echo 'em-location-types-single'; ?>">
	<label><?php esc_html_e ( 'Location Type', 'events-manager')?></label>
	<select name="location_type" class="em-location-types-select">
		<?php foreach( $location_types as $location_type => $location_type_option ): ?>
		<option value="<?php echo esc_attr($location_type); ?>" <?php if( !empty($location_type_option['selected']) ) echo 'selected="selected"'; ?> data-display-class="<?php if( !empty($location_type_option['display-class']) ) echo esc_attr($location_type_option['display-class']); ?>">
			<?php echo esc_html($location_type_option['description']); ?>
		</option>
		<?php endforeach; ?>
	</select>
	<script type="text/javascript">
		jQuery(document).ready(function($){
			$('.em-location-types .em-location-types-select').change(function(){
				let el = $(this);
				if( el.val() == 0 ){
					$('.em-location-type').hide();
				}else{
					let location_type = el.find('option:selected').data('display-class');
					$('.em-location-type').hide();
					$('.em-location-type.'+location_type).show();
					if( location_type != 'em-location-type-place' ){
						jQuery('#em-location-reset a').trigger('click');
					}
				}
			}).trigger('change');
		});
	</script>
</div>

<?php if( EM_Locations::is_enabled() ): ?>
<div id="em-location-data" class="em-location-data em-location-type em-location-type-place <?php if( count($location_types) == 1 ) echo 'em-location-type-single'; ?>">
	<div id="location_coordinates" style='display: none;'>
		<input id='location-latitude' name='location_latitude' type='text' value='<?php echo esc_attr($EM_Event->get_location()->location_latitude); ?>' size='15' />
		<input id='location-longitude' name='location_longitude' type='text' value='<?php echo esc_attr($EM_Event->get_location()->location_longitude); ?>' size='15' />
	</div>
	<?php if( get_option('dbem_use_select_for_locations') || !$EM_Event->can_manage('edit_locations','edit_others_locations') ) : ?>
	<div class="em-location-data">
		<p class="em-location-data-select">
			<label for="location-id"><?php esc_html_e('Location:','events-manager') ?> </label>
			<select name="location_id" id='location-select-id' size="1">
				<?php
				$ddm_args = array('private'=>$EM_Event->can_manage('read_private_locations'));
				$ddm_args['owner'] = (is_user_logged_in() && !current_user_can('read_others_locations')) ? get_current_user_id() : false;
				$locations = EM_Locations::get($ddm_args);
				$selected_location = !empty($EM_Event->location_id) || !empty($EM_Event->event_id) ? $EM_Event->location_id:get_option('dbem_default_location');
				foreach($locations as $EM_Location) {
					$selected = ($selected_location == $EM_Location->location_id) ? "selected='selected' " : '';
					if( $selected ) $found_location = true;
			        ?>
			        <option value="<?php echo esc_attr($EM_Location->location_id) ?>" title="<?php echo esc_attr("{$EM_Location->location_latitude},{$EM_Location->location_longitude}"); ?>" <?php echo $selected ?>><?php echo esc_html($EM_Location->location_name); ?></option>
			        <?php
				}
				if( empty($found_location) && !empty($EM_Event->location_id) ){
					$EM_Location = $EM_Event->get_location();
					if( $EM_Location->post_id ){
						?>
				        <option value="<?php echo esc_attr($EM_Location->location_id) ?>" title="<?php echo esc_attr("{$EM_Location->location_latitude},{$EM_Location->location_longitude}"); ?>" selected="selected"><?php echo esc_html($EM_Location->location_name); ?></option>
				        <?php
					}
				}
				?>
			</select>
		</p>
	</div> <!-- / .em-location-data -->

	<?php else : ?>
	<div class="em-location-fields">
		<?php
		global $EM_Location;
		if( $EM_Event->location_id !== 0 ){
			$EM_Location = $EM_Event->get_location();
		}elseif(get_option('dbem_default_location') > 0){
			$EM_Location = em_get_location(get_option('dbem_default_location'));
		}else{
			$EM_Location = new EM_Location();
		}
		?>
		<div class="input-full em-location-data-name">
			<label for="location-name"><?php _e ( 'Location Name:', 'events-manager')?><?php echo $required; ?></label>
			<input id='location-id' name='location_id' type='hidden' value='<?php echo esc_attr($EM_Location->location_id); ?>' size='15' />
			<input id="location-name" type="text" name="location_name" value="<?php echo esc_attr($EM_Location->location_name, ENT_QUOTES); ?>" />
			<label for="location-name" id="em-location-search-tip" class="description"><?php esc_html_e( 'Create a location or start typing to search a previously created location.', 'events-manager')?></label>
			<label for="location-name" id="em-location-reset" class="description" style="display:none;"><?php esc_html_e('You cannot edit saved locations here.', 'events-manager'); ?> <a href="#"><?php esc_html_e('Reset this form to create a location or search again.', 'events-manager')?></a></label>
		</div>
		<div class="input-full em-location-data-address">
			<label for="location-address"><?php _e ( 'Address:', 'events-manager')?><?php echo $required; ?></label>
			<input id="location-address" type="text" name="location_address" value="<?php echo esc_attr($EM_Location->location_address); ; ?>" />
		</div>	
		<div class="input-full em-location-data-town">
			<label for="location-town"><?php _e ( 'City:', 'events-manager')?><?php echo $required; ?></label>
			<input id="location-town" type="text" name="location_town" value="<?php echo esc_attr($EM_Location->location_town); ?>" />
		</div>
		<div class="input-left em-location-data-state">
			<label for="location-state"><?php _e ( 'State:', 'events-manager')?><?php echo $required; ?></label>
			<input id="location-state" type="text" name="location_state" value="<?php echo esc_attr($EM_Location->location_state); ?>" />
		</div>
		<div class="em-location-data-postcode input-right">
			<label for="location-postcode"><?php _e ( 'Zip Code:', 'events-manager')?><?php echo $required; ?></label>
			<input id="location-postcode" type="text" name="location_postcode" value="<?php echo esc_attr($EM_Location->location_postcode); ?>" />
		</div>
		<div class="em-location-data-country input-full">
			<label for="location-country"><?php _e ( 'Country:', 'events-manager')?><?php echo $required; ?></label><br />
			
			<select id="location-country" name="location_country">
				<option value="0" <?php echo ( $EM_Location->location_country == '' && $EM_Location->location_id == '' && get_option('dbem_location_default_country') == '' ) ? 'selected="selected"':''; ?>><?php _e('none selected','events-manager'); ?></option>
				<?php foreach(em_get_countries() as $country_key => $country_name): ?>
				<option value="<?php echo esc_attr($country_key); ?>" <?php echo ( $EM_Location->location_country == $country_key || ($EM_Location->location_country == '' && $EM_Location->location_id == '' && get_option('dbem_location_default_country')==$country_key) ) ? 'selected="selected"':''; ?>><?php echo esc_html($country_name); ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		
		<div class="em-location-data-url input-full">
			<label for="location-url"><?php _e ( 'Location Website:', 'events-manager')?></label><br />
			<input id="location-url" type="text" name="location_url" value="<?php echo esc_attr($EM_Location->location_url); ; ?>" />
		</div>
	</div><!-- /em-location-fields -->

	<?php endif; ?>

	<?php if ( get_option( 'dbem_gmap_is_active' ) ):?>
		<?php em_locate_template('forms/map-container.php',true); ?>
	<?php endif; ?>
	<br style="clear:both;" />
</div> <!-- / #em-location-data -->

<?php endif; // EM_Locations is_enabled ?>
<div class="em-event-location-data">
	<?php foreach( EM_Event_Locations\Event_Locations::get_types() as $event_location_type => $EM_Event_Location_Class ): /* @var EM_Event_Locations\Event_Location $EM_Event_Location_Class */ ?>
		<?php if( $EM_Event_Location_Class::is_enabled() ): ?>
			<div class="em-location-type em-event-location-type-<?php echo esc_attr($event_location_type); ?>">
			<?php $EM_Event_Location_Class::load_admin_template(); ?>
			</div>
		<?php endif; ?>
	<?php endforeach; ?>
	
</div>