<?php
/* Used by the buddypress and front-end editors to display event time-related information */
global $EM_Event;
$days_names = em_get_days_names();
$hours_format = em_get_hour_format();
$admin_recurring = is_admin() && $EM_Event->is_recurring();
$id = rand();
?>
<!-- START recurrence postbox -->
<div id="em-form-with-recurrence-<?php echo $id; ?>" class="em event-form-with-recurrence event-form-when">
	<div class="input-full">
		<input type="checkbox" id="em-recurrence-checkbox-<?php echo $id; ?>" class="em-recurrence-checkbox" name="recurring" value="1" <?php if($EM_Event->is_recurring()) echo 'checked' ?> > <label for="em-recurrence-checkbox-<?php echo $id; ?>"><?php _e('This is a recurring event.', 'events-manager'); ?></label> 
	</div>
	<?php
		$with_recurring = true;
		include( em_locate_template('forms/event/when/dates.php') );
	?>
	<?php include( em_locate_template('forms/event/when/recurrence-pattern.php') ); ?>
	<?php include( em_locate_template('forms/event/when/times.php') ); ?>
	<?php include( em_locate_template('forms/event/when/timezone.php') ); ?>
	
</div>