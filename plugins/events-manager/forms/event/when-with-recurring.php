<?php
/* Used by the buddypress and front-end editors to display event time-related information */
global $EM_Event;
$days_names = em_get_days_names();
$hours_format = em_get_hour_format();
$admin_recurring = is_admin() && $EM_Event->is_recurring();
?>
<!-- START recurrence postbox -->
<div id="em-form-with-recurrence" class="event-form-with-recurrence event-form-when">
	<div class="em-date-range input-left">
		<label for="event-start-date"><?php _e ( 'Start Date', 'events-manager'); ?></label>
		<input class="em-date-start em-date-input-loc" type="text" />
		<input class="em-date-input" type="hidden" name="event_start_date" id="event-start-date" value="<?php echo $EM_Event->start()->getDate(); ?>" />
	</div>
	<div class="em-date-range input-right">
		<label for="event-end-date"><?php _e ( 'End Date', 'events-manager'); ?></label>
		<input class="em-date-end em-date-input-loc" type="text" />
		<input class="em-date-input" type="hidden" name="event_end_date" id="event-end-date" value="<?php echo $EM_Event->end()->getDate(); ?>" />
	</div>
	<div class="input-full">
		<input type="checkbox" class="em-time-allday" name="event_all_day" id="em-time-all-day" value="1" <?php if(!empty($EM_Event->event_all_day)) echo 'checked="checked"'; ?> /> <label for="em-time-all-day"><?php _e('All day','events-manager'); ?></label>
	</div>

	<div class="em-time-entry input-left">
		<label for="start-time"><?php _e ( 'Start Time', 'events-manager'); ?></label>
		<input id="start-time" type="text" size="8" maxlength="8" name="event_start_time" value="<?php echo $EM_Event->start()->i18n($hours_format); ?>" />
		<label class="description" for="start-time"><?php esc_html_e( 'HH:MM (24 hour format)', 'events-manager')?></label>
	</div>
	<div class="em-time-entry input-right">
		<label for="end-time"><?php _e ( 'End Time', 'events-manager'); ?></label>
		<input id="end-time" class="em-time-input em-time-end" type="text" size="8" maxlength="8" name="event_end_time" value="<?php echo $EM_Event->end()->i18n($hours_format); ?>" />
		<label class="description" for="end-time"><?php esc_html_e( 'HH:MM (24 hour format)', 'events-manager')?></label>
	</div>
	<div class="input-full">
		<input type="checkbox" id="em-recurrence-checkbox" name="recurring" value="1" <?php if($EM_Event->is_recurring()) echo 'checked' ?> /> <label for="em-recurrence-checkbox"><?php _e('This is a recurring event.', 'events-manager'); ?></label> 
	</div>
	<div class="em-recurring-text input-left">
		<p>
			<label for="recurrence-frequency"><?php _e ( 'Repeats', 'events-manager'); ?></label>
			<select id="recurrence-frequency" name="recurrence_freq">
				<?php
					$freq_options = array ("daily" => __ ( 'Daily', 'events-manager'), "weekly" => __ ( 'Weekly', 'events-manager'), "monthly" => __ ( 'Monthly', 'events-manager'), 'yearly' => __('Yearly','events-manager') );
					em_option_items ( $freq_options, $EM_Event->recurrence_freq ); 
				?>
			</select>
			<label for="recurrence-interval"><?php _e ( 'every', 'events-manager'); ?></label>
			<input id="recurrence-interval" name='recurrence_interval' size='2' value='<?php echo $EM_Event->recurrence_interval ; ?>' />
			<span class='interval-desc' id="interval-daily-singular"><label for="recurrence-interval"><?php _e ( 'day', 'events-manager')?></label></span>
			<span class='interval-desc' id="interval-daily-plural"><label for="recurrence-interval"><?php _e ( 'days', 'events-manager')?></label></span>
			<span class='interval-desc' id="interval-weekly-singular"><label for="recurrence-interval"><?php _e ( 'week on', 'events-manager'); ?></label></span>
			<span class='interval-desc' id="interval-weekly-plural"><label for="recurrence-interval"><?php _e ( 'weeks on', 'events-manager'); ?></label></span>
			<span class='interval-desc' id="interval-monthly-singular"><label for="recurrence-interval"><?php _e ( 'month on the', 'events-manager')?></label></span>
			<span class='interval-desc' id="interval-monthly-plural"><label for="recurrence-interval"><?php _e ( 'months on the', 'events-manager')?></label></span>
			<span class='interval-desc' id="interval-yearly-singular"><label for="recurrence-interval"><?php _e ( 'year', 'events-manager')?></label></span> 
			<span class='interval-desc' id="interval-yearly-plural"><label for="recurrence-interval"><?php _e ( 'years', 'events-manager') ?></label></span>
		</p>
	</div>
	<div class="em-recurring-text input-right">
		<p class="alternate-selector" id="weekly-selector">
			<?php
				$saved_bydays = ($EM_Event->is_recurring()) ? explode ( ",", $EM_Event->recurrence_byday ) : array(); 
				em_checkbox_items ( 'recurrence_bydays[]', $days_names, $saved_bydays ); 
			?>
		</p>
		<p class="alternate-selector" id="monthly-selector" style="display:inline;">
			<select id="monthly-modifier" name="recurrence_byweekno">
				<?php
					$weekno_options = array ("1" => __ ( 'first', 'events-manager'), '2' => __ ( 'second', 'events-manager'), '3' => __ ( 'third', 'events-manager'), '4' => __ ( 'fourth', 'events-manager'), '5' => __ ( 'fifth', 'events-manager'), '-1' => __ ( 'last', 'events-manager') ); 
					em_option_items ( $weekno_options, $EM_Event->recurrence_byweekno  ); 
				?>
			</select>
			<select id="recurrence-weekday" name="recurrence_byday">
				<?php em_option_items ( $days_names, $EM_Event->recurrence_byday  ); ?>
			</select>
			<label for="monthly-selector"><?php _e('of each month','events-manager'); ?></label>
		</p>
		
	</div>
	<script type="text/javascript">
	//<![CDATA[
	jQuery(document).ready( function($) {
		$('#em-recurrence-checkbox').change(function(){
			if( $('#em-recurrence-checkbox').is(':checked') ){
				$('.em-recurring-text').show();
				$('.em-event-text').hide();
			}else{
				$('.em-recurring-text').hide();
				$('.em-event-text').show();						
			}
		});
		$('#em-recurrence-checkbox').trigger('change');

		$('#em-time-all-day').change(function(){
			if( $('#em-time-all-day').is(':checked') ){
				$('.em-time-entry').hide();
			}else{
				$('.em-time-entry').show();						
			}
		});
		$('#em-time-all-day').trigger('change');
	});
	//]]>
	</script>
</div>