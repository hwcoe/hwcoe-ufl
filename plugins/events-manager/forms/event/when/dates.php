<?php
// The following are included in the scope of this event date range picker
/* @var int $id */
/* @var bool $with_recurring Set if a recurring event or front-end to show both options. */
/* @var EM_Event $EM_Event */
?>
<div class="em-datepicker em-datepicker-range em-event-dates input-full">
	<?php if( !$EM_Event->is_recurring() || !empty($with_recurring) ): ?>
	<label for="em-date-start-end-<?php echo $id ?>" class="em-event-text"><?php _e ( 'Event Date ', 'events-manager'); ?></label>
	<?php endif; ?>
	<?php if( !empty($with_recurring) || $EM_Event->is_recurring() ): ?>
	<label for="em-date-start-end-<?php echo $id ?>" class="em-recurring-text"><?php _e ( 'Recurrences Span Between', 'events-manager'); ?></label>
	<?php endif; ?>
	<input id="em-date-start-end-<?php echo $id ?>" type="hidden" class="em-date-input em-date-start-end" aria-hidden="true" placeholder="<?php _e ( 'Select date range', 'events-manager'); ?>">
	<?php if( !empty($with_recurring) || $EM_Event->is_recurring() ): ?>
	<?php endif; ?>
	<div class="em-datepicker-data">
		<input type="date" name="event_start_date" value="<?php echo $EM_Event->start()->getDate(); ?>" aria-label="<?php _e ( 'From ', 'events-manager'); ?>">
		<span class="separator"><?php _e('to','events-manager'); ?></span>
		<input type="date" name="event_end_date" value="<?php echo $EM_Event->end()->getDate(); ?>" aria-label="<?php _e('to','events-manager'); ?>">
	</div>
	<?php if( !empty($with_recurring) || $EM_Event->is_recurring() ): ?>
		<p class="em-range-description em-recurring-text"><em><?php _e( 'For a recurring event, a one day event will be created on each recurring date within this date range.', 'events-manager'); ?></em></p>
	<?php endif; ?>
</div>
