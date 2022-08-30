<?php 
/* 
 * Used for both multiple and single tickets. $col_count will always be 1 in single ticket mode, and be a unique number for each ticket starting from 1 
 * This form should have $EM_Ticket and $col_count available globally. 
 */
global $col_count, $EM_Ticket; /* @var EM_Ticket $EM_Ticket */
$col_count = absint($col_count); //now we know it's a number
?>
<div class="em-ticket-form">
	<input type="hidden" name="em_tickets[<?php echo $col_count; ?>][ticket_id]" class="ticket_id" value="<?php echo esc_attr($EM_Ticket->ticket_id) ?>" />
	<div class="em-ticket-form-main">
		<div class="ticket-name">
			<label for="ticket_name" title="<?php esc_attr_e('Enter a ticket name.','events-manager'); ?>"><?php esc_html_e('Ticket Name','events-manager') ?></label>
			<input type="text" id="ticket_name" name="em_tickets[<?php echo $col_count; ?>][ticket_name]" value="<?php echo esc_attr($EM_Ticket->ticket_name) ?>" class="ticket_name" />
		</div>
		<div class="ticket-description">
			<label for="ticket_description"><?php esc_html_e('Ticket Description','events-manager') ?></label>
			<textarea id="ticket_description" name="em_tickets[<?php echo $col_count; ?>][ticket_description]" class="ticket_description" rows="3"><?php echo esc_html(wp_unslash($EM_Ticket->ticket_description)) ?></textarea>
		</div>
		<div class="ticket-spaces input-left">
			<label for="ticket_spaces" title="<?php esc_attr_e('Enter a maximum number of spaces (required).','events-manager'); ?>"><?php esc_html_e('Total Spaces Available','events-manager') ?></label>
			<input type="text" name="em_tickets[<?php echo $col_count; ?>][ticket_spaces]" value="<?php echo esc_attr($EM_Ticket->ticket_spaces) ?>" class="ticket_spaces" id="ticket_spaces" />
		</div>
	</div>
	<div class="em-ticket-form-advanced" style="display:none;">
		<div class="ticket-spaces ticket-spaces-min input-left">
			<label for="ticket_min" title="<?php esc_attr_e('Leave blank for no lower limit','events-manager'); ?>"><?php echo esc_html_e('Minimum spaces per booking','events-manager');?></label>
			<input type="text" name="em_tickets[<?php echo $col_count; ?>][ticket_min]" value="<?php echo esc_attr($EM_Ticket->ticket_min) ?>" class="ticket_min" id="ticket_min" />
		</div>
		<div class="ticket-spaces ticket-spaces-max inline-inputs input-right">
			<label for="ticket_max" title="<?php esc_attr_e('Leave blank for no upper limit','events-manager'); ?>"><?php echo esc_html_e('Maximum spaces per booking', 'events-manager'); ?></label>
			<input type="text" name="em_tickets[<?php echo $col_count; ?>][ticket_max]" value="<?php echo esc_attr($EM_Ticket->ticket_max) ?>" class="ticket_max" id="ticket_max" />
		</div>
		<div class="ticket-dates em-time-range">
			<div class="ticket-dates-from input-left">
				<label title="<?php esc_attr_e('Add a start or end date (or both) to impose time constraints on ticket availability. Leave either blank for no upper/lower limit.','events-manager'); ?>">
					<?php esc_html_e('Available from','events-manager') ?>
				</label>
				<div class="ticket-dates-from-normal em-datepicker">
					<input type="hidden" class="em-date-input em-date-input-start">
					<span class="em-datepicker-data">
						<input type="date" name="em_tickets[<?php echo $col_count; ?>][ticket_start]" value="<?php echo ( !empty($EM_Ticket->ticket_start) ) ? $EM_Ticket->start()->format("Y-m-d"):''; ?>" />
					</span>
				</div>
				<div class="ticket-dates-from-recurring ">
					<input type="text" name="em_tickets[<?php echo $col_count; ?>][ticket_start_recurring_days]" size="3" value="<?php if( !empty($EM_Ticket->ticket_meta['recurrences']['start_days']) && is_numeric($EM_Ticket->ticket_meta['recurrences']['start_days'])) echo absint($EM_Ticket->ticket_meta['recurrences']['start_days']); ?>" />
					<?php esc_html_e('day(s)','events-manager'); ?>
					<select name="em_tickets[<?php echo $col_count; ?>][ticket_start_recurring_when]" class="ticket-dates-from-recurring-when">
						<option value="before" <?php if( isset($EM_Ticket->ticket_meta['recurrences']['start_days']) && $EM_Ticket->ticket_meta['recurrences']['start_days'] <= 0) echo 'selected="selected"'; ?>><?php echo esc_html(sprintf(_x('%s the event starts','before or after','events-manager'),__('Before','events-manager'))); ?></option>
						<option value="after" <?php if( !empty($EM_Ticket->ticket_meta['recurrences']['start_days']) && $EM_Ticket->ticket_meta['recurrences']['start_days'] > 0) echo 'selected="selected"'; ?>><?php echo esc_html(sprintf(_x('%s the event starts','before or after','events-manager'),__('After','events-manager'))); ?></option>
					</select>
				</div>
				<?php echo esc_html_x('at', 'time','events-manager'); ?>
				<input class="em-time-input em-time-start" type="text" size="8" maxlength="8" name="em_tickets[<?php echo $col_count; ?>][ticket_start_time]" value="<?php echo ( !empty($EM_Ticket->ticket_start) ) ? $EM_Ticket->start()->format( em_get_hour_format() ):''; ?>" />
			</div>
			<div class="ticket-dates-to input-right">
				<label title="<?php esc_attr_e('Add a start or end date (or both) to impose time constraints on ticket availability. Leave either blank for no upper/lower limit.','events-manager'); ?>">
					<?php esc_html_e('Available until','events-manager') ?>
				</label>
				<div class="ticket-dates-to-normal em-datepicker">
					<input type="hidden" class="em-date-input em-date-input-start">
					<span class="em-datepicker-data">
						<input type="date" name="em_tickets[<?php echo $col_count; ?>][ticket_end]" value="<?php echo ( !empty($EM_Ticket->ticket_end) ) ? $EM_Ticket->end()->format("Y-m-d"):''; ?>" />
					</span>
				</div>
				<div class="ticket-dates-to-recurring">
					<input type="text" name="em_tickets[<?php echo $col_count; ?>][ticket_end_recurring_days]" size="3" value="<?php if( isset($EM_Ticket->ticket_meta['recurrences']['end_days']) && $EM_Ticket->ticket_meta['recurrences']['end_days'] !== false ) echo absint($EM_Ticket->ticket_meta['recurrences']['end_days']); ?>" />
					<?php esc_html_e('day(s)','events-manager'); ?>
					<select name="em_tickets[<?php echo $col_count; ?>][ticket_end_recurring_when]" class="ticket-dates-to-recurring-when">
						<option value="before" <?php if( isset($EM_Ticket->ticket_meta['recurrences']['end_days']) && $EM_Ticket->ticket_meta['recurrences']['end_days'] <= 0) echo 'selected="selected"'; ?>><?php echo esc_html(sprintf(_x('%s the event starts','before or after','events-manager'),__('Before','events-manager'))); ?></option>
						<option value="after" <?php if( !empty($EM_Ticket->ticket_meta['recurrences']['end_days']) && $EM_Ticket->ticket_meta['recurrences']['end_days'] > 0) echo 'selected="selected"'; ?>><?php echo esc_html(sprintf(_x('%s the event starts','before or after','events-manager'),__('After','events-manager'))); ?></option>
					</select>
				</div>
				<?php echo esc_html_x('at', 'time','events-manager'); ?>
				<input class="em-time-input em-time-end ticket-times-to-normal" type="text" size="8" maxlength="8" name="em_tickets[<?php echo $col_count; ?>][ticket_end_time]" value="<?php echo ( !empty($EM_Ticket->ticket_end) ) ? $EM_Ticket->end()->format( em_get_hour_format() ):''; ?>" />
			</div>
		</div>
		<?php if( !get_option('dbem_bookings_tickets_single') || count($EM_Ticket->get_event()->get_tickets()->tickets) > 1 ): ?>
		<div class="ticket-required input-full">
			<label for="ticket_required" title="<?php esc_attr_e('If checked every booking must select one or the minimum number of this ticket.','events-manager'); ?>" class="inline-right"><?php esc_html_e('Ticket required?','events-manager') ?></label>
			<input type="checkbox" value="1" name="em_tickets[<?php echo $col_count; ?>][ticket_required]" <?php if($EM_Ticket->ticket_required) echo 'checked="checked"'; ?> id="ticket_required" class="ticket_required" />
		</div>
		<?php endif; ?>
		<div class="ticket-type input-left">
			<label for="ticket_type"><?php esc_html_e('Booking available for','events-manager') ?></label>
			<select name="em_tickets[<?php echo $col_count; ?>][ticket_type]" class="ticket_type" id="ticket_type">
				<option value=""><?php _e('Everyone','events-manager'); ?></option>
				<option value="members" <?php if($EM_Ticket->ticket_members) echo 'selected="selected"'; ?>><?php esc_html_e('Logged In Users','events-manager'); ?></option>
				<option value="guests" <?php if($EM_Ticket->ticket_guests) echo 'selected="selected"'; ?>><?php esc_html_e('Guest Users','events-manager'); ?></option>
			</select>
		</div>
		<?php if( current_user_can( 'edit_posts') ): ?>
		<div class="ticket-roles input-right" <?php if( !$EM_Ticket->ticket_members ): ?>style="display:none;"<?php endif; ?>>
			<label for="ticket_members_roles"><?php _e('Restrict booking to','events-manager'); ?></label>
			<div>
				<?php 
				$WP_Roles = new WP_Roles();
				foreach($WP_Roles->roles as $role => $role_data){ /* @var $WP_Role WP_Role */
					?>
					<input type="checkbox" name="em_tickets[<?php echo $col_count; ?>][ticket_members_roles][]" value="<?php echo esc_attr($role); ?>" <?php if( in_array($role, $EM_Ticket->ticket_members_roles) ) echo 'checked="checked"' ?> id="ticket_members_roles" class="ticket_members_roles" /> <?php echo esc_html($role_data['name']); ?><br />
					<?php
				}
				?>
			</div>
		</div>
		<?php endif; ?>
		<?php do_action('em_ticket_edit_form_fields', $col_count, $EM_Ticket); //do not delete, add your extra fields this way, remember to save them too! ?>
	</div>
	<div class="ticket-options input-full">
		<p><a href="#" class="ticket-options-advanced show button"><span class="show-advanced"><?php esc_html_e('Show Advanced Options','events-manager'); ?></span><span class="hide-advanced" style="display:none;"><?php esc_html_e('Hide Advanced Options','events-manager'); ?></span></a></p>
	</div>
</div>