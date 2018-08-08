<?php
global $EM_Event, $post;
$hours_format = em_get_hour_format();
$required = apply_filters('em_required_html','<i>*</i>');
?>
<div class="event-form-when" id="em-form-when">
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
<?php if( false && get_option('dbem_recurrence_enabled') && $EM_Event->is_recurrence() ) : //in future, we could enable this and then offer a detach option alongside, which resets the recurrence id and removes the attachment to the recurrence set ?>
<input type="hidden" name="recurrence_id" value="<?php echo $EM_Event->recurrence_id; ?>" />
<?php endif;