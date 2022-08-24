<?php
// The following are included in the scope of this event date range picker
/* @var int $id */
/* @var EM_Event $EM_Event */
$days_names = em_get_days_names();
?>
<div class="em-recurrence-pattern em-recurring-text">
	<?php _e ( 'This event repeats', 'events-manager'); ?>
	<select class="em-recurrence-frequency inline" name="recurrence_freq" id="recurrence-frequency<?php echo $id; ?>">
		<?php
		$freq_options = array ("daily" => __ ( 'Daily', 'events-manager'), "weekly" => __ ( 'Weekly', 'events-manager'), "monthly" => __ ( 'Monthly', 'events-manager'), 'yearly' => __('Yearly','events-manager') );
		em_option_items ( $freq_options, $EM_Event->recurrence_freq );
		?>
	</select>
	<?php _e ( 'every', 'events-manager')?>
	<input type="text" class="em-recurrence-interval inline" id="recurrence-interval-<?php echo $id; ?>" name='recurrence_interval' size='2' value='<?php echo $EM_Event->recurrence_interval ; ?>' aria-label="<?php esc_html_e('Recurrence Interval', 'events-manager'); ?>">
	<span class="interval-desc interval-daily-singular"><?php _e ( 'day', 'events-manager')?></span>
	<span class="interval-desc interval-daily-plural"><?php _e ( 'days', 'events-manager') ?></span>
	<span class="interval-desc interval-weekly-singular"><?php _e ( 'week on', 'events-manager'); ?></span>
	<span class="interval-desc interval-weekly-plural"><?php _e ( 'weeks on', 'events-manager'); ?></span>
	<span class="interval-desc interval-monthly-singular"><?php _e ( 'month on the', 'events-manager')?></span>
	<span class="interval-desc interval-monthly-plural"><?php _e ( 'months on the', 'events-manager')?></span>
	<span class="interval-desc interval-yearly-singular"><?php _e ( 'year', 'events-manager')?></span>
	<span class="interval-desc interval-yearly-plural"><?php _e ( 'years', 'events-manager') ?></span>
	<span class="alternate-selector em-monthly-selector" id="monthly-selector-<?php echo $id; ?>">
		<select id="monthly-modifier-<?php echo $id; ?>r" name="recurrence_byweekno" class="inline">
			<?php
			$weekno_options = array ("1" => __ ( 'first', 'events-manager'), '2' => __ ( 'second', 'events-manager'), '3' => __ ( 'third', 'events-manager'), '4' => __ ( 'fourth', 'events-manager'), '5' => __ ( 'fifth', 'events-manager'), '-1' => __ ( 'last', 'events-manager') );
			em_option_items ( $weekno_options, $EM_Event->recurrence_byweekno  );
			?>
		</select>
		<select id="recurrence-weekday-<?php echo $id; ?>" name="recurrence_byday" class="inline">
			<?php em_option_items ( $days_names, $EM_Event->recurrence_byday  ); ?>
		</select>
		<?php _e('of each month','events-manager'); ?>
	</span>
	<div class="alternate-selector em-weekly-selector" id="weekly-selector-<?php echo $id; ?>">
		<?php
		$saved_bydays = ($EM_Event->is_recurring()) ? explode ( ",", $EM_Event->recurrence_byday ) : array();
		em_checkbox_items ( 'recurrence_bydays[]', $days_names, $saved_bydays );
		?>
	</div>
</div>