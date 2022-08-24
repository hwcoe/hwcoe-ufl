<?php
// The following are included in the scope of this event date range picker
/* @var int $id */
/* @var EM_Event $EM_Event */
?>

<?php if( get_option('dbem_timezone_enabled') ): ?>
<div class="em-timezone input-full">
	<label for="event-timezone-<?php echo $id; ?>"><?php esc_html_e('Timezone', 'events-manager'); ?></label>
	<select id="event-timezone-<?php echo $id; ?>" name="event_timezone" class="em-selectize">
		<?php echo wp_timezone_choice( $EM_Event->get_timezone()->getName(), get_user_locale() ); ?>
	</select>
</div>
<?php endif; ?>