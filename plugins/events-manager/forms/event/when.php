<?php
global $EM_Event, $post;
$hours_format = em_get_hour_format();
$required = apply_filters('em_required_html','<i>*</i>');
$id = rand();
?>
<div class="event-form-when" id="em-form-when">
	<?php include( em_locate_template('forms/event/when/dates.php') ); ?>
	<p id='event-date-explanation' class="description">
	<?php esc_html_e( 'This event spans every day between the beginning and end date, with start/end times applying to each day.', 'events-manager'); ?>
	</p>
	<?php include( em_locate_template('forms/event/when/times.php') ); ?>
	<?php include( em_locate_template('forms/event/when/timezone.php') ); ?>
</div>  
<?php if( false && get_option('dbem_recurrence_enabled') && $EM_Event->is_recurrence() ) : //in future, we could enable this and then offer a detach option alongside, which resets the recurrence id and removes the attachment to the recurrence set ?>
<input type="hidden" name="recurrence_id" value="<?php echo $EM_Event->recurrence_id; ?>" />
<?php endif;