<?php
/* WARNING! This file may change in the near future as we intend to add features to the event editor. If at all possible, try making customizations using CSS, jQuery, or using our hooks and filters. - 2012-02-14 */
/* 
 * To ensure compatability, it is recommended you maintain class, id and form name attributes, unless you now what you're doing. 
 * You also must keep the _wpnonce hidden field in this form too.
 */
global $EM_Event, $EM_Notices, $bp;
$template = isset($args['css_template']) ? esc_attr($args['css_template']) : implode(' ', em_get_template_classes('event-editor', 'event-editor-section', true));

//check that user can access this page
if( is_object($EM_Event) && !$EM_Event->can_manage('edit_events','edit_others_events') ){
	?>
	<div class="wrap"><h2><?php esc_html_e('Unauthorized Access','events-manager'); ?></h2><p><?php echo sprintf(__('You do not have the rights to manage this %s.','events-manager'),__('Event','events-manager')); ?></p></div>
	<?php
	return false;
}elseif( !is_object($EM_Event) ){
	$EM_Event = new EM_Event();
}
$required = apply_filters('em_required_html','<span class="required">*</span>');

echo $EM_Notices;
//Success notice
if( !empty($_REQUEST['success']) ){
	if(!get_option('dbem_events_form_reshow')) return false;
}
$id = rand(); // not related to searches, so we'll just add an ID for good practice
?>	
<div class="<?php em_template_classes('view-container'); ?>" id="em-view-<?php echo $id; ?>" data-view="event">
	<form enctype='multipart/form-data' id="event-form-<?php echo $id; ?>" class="event-form <?php em_template_classes('event-editor'); ?> <?php if( $EM_Event->is_recurring() ) echo 'em-event-admin-recurring' ?>"
	      method="post" action="<?php echo esc_url(add_query_arg(array('success'=>null, 'action'=>null))); ?>" data-view-id="<?php echo $id; ?>">
		<div class="wrap">
			<?php do_action('em_front_event_form_header', $EM_Event); ?>

			<?php if(get_option('dbem_events_anonymous_submissions') && !is_user_logged_in()): ?>
			<section class="event-form-submitter <?php echo $template; ?>">
				<h2><?php esc_html_e( 'Your Details', 'events-manager'); ?></h2>
				<div class="input-left">
					<label for="event-owner-name"><?php esc_html_e('Name', 'events-manager'); ?><?php echo $required; ?></label>
					<input type="text" name="event_owner_name" id="event-owner-name" value="<?php echo esc_attr($EM_Event->event_owner_name); ?>" />
				</div>
				<div class="input-right">
					<label for="event-owner-email"><?php esc_html_e('Email', 'events-manager'); ?><?php echo $required; ?></label>
					<input type="text" name="event_owner_email" id="event-owner-email" value="<?php echo esc_attr($EM_Event->event_owner_email); ?>" />
				</div>

				<h2 class="event-form-name"><?php esc_html_e( 'Event Details', 'events-manager'); ?></h2>
			</section>
			<?php endif; ?>
			
			<section class="event-form-name <?php echo $template; ?>">
				<label for="event-name"><?php esc_html_e('Event Name', 'events-manager'); ?><?php echo $required; ?></label>
				
				<div class="input">
					<input type="text" name="event_name" id="event-name" maxlength="110" value="<?php echo esc_attr($EM_Event->event_name,ENT_QUOTES); ?>" />
					<label class="description" for="event-name"><?php esc_html_e('Example: Information Session (max 110 characters)', 'events-manager'); ?></label>
				
					<?php em_locate_template('forms/event/group.php',true); ?>
				</div>
			</section>

			<section class="event-form-when <?php echo $template; ?>">
				<?php
					if( empty($EM_Event->event_id) && $EM_Event->can_manage('edit_recurring_events','edit_others_recurring_events') && get_option('dbem_recurrence_enabled') ){
						em_locate_template('forms/event/when-with-recurring.php',true);
					}elseif( $EM_Event->is_recurring()  ){
						em_locate_template('forms/event/recurring-when.php',true);
					}else{
						em_locate_template('forms/event/when.php',true);
					}
				?>
			</section>

			<?php if( get_option('dbem_locations_enabled') ): ?>
			<section class="event-form-where">
				<?php em_locate_template('forms/event/location.php',true); ?>
			</section>
			<?php endif; ?>
			
			<section class="event-form-details">
					<div class="event-editor input-left">
						<?php if( get_option('dbem_events_form_editor') && function_exists('wp_editor') ): ?>
							<?php wp_editor($EM_Event->post_content, 'em-editor-content', array('textarea_name'=>'content') ); ?>
						<?php else: ?>
							<label for="event-description"><?php esc_html_e( 'Event Description', 'events-manager')?></label>
							<textarea name="content" id="event-description" rows="10" ><?php echo $EM_Event->post_content ?></textarea>
							<label class="description" for="event-description"><?php esc_html_e( 'HTML allowed', 'events-manager')?></label>
						<?php endif; ?>
					</div>
					<div class="event-extra-details input-right <?php echo $template; ?>">
						<div class="input">
						<?php if(get_option('dbem_attributes_enabled')) { em_locate_template('forms/event/attributes-public.php',true); }  ?>
						<?php if(get_option('dbem_categories_enabled')) { em_locate_template('forms/event/categories-public.php',true); }  ?>
						</div>
					</div>
			</section>

			<?php 
			// Template customization - removed image upload
			?>

			<?php if( get_option('dbem_rsvp_enabled') && $EM_Event->can_manage('manage_bookings','manage_others_bookings') ) : ?>
			<section class="event-form-bookings <?php echo $template; ?>">
				<!-- START Bookings -->
				<h2><?php esc_html_e('Bookings/Registration','events-manager'); ?></h2>
				<div class="input event-form-bookings">
					<?php em_locate_template('forms/event/bookings.php',true); ?>
				</div>
				<!-- END Bookings -->
			</section>
			<?php endif; ?>
			
			
			<?php do_action('em_front_event_form_footer', $EM_Event); ?>
		</div><!-- wrap -->

		<section class="event-form-submit <?php echo $template; ?>">
			<p class="input submit">
			    <?php if( empty($EM_Event->event_id) ): ?>
			    <input type='submit' class='button-primary' value='<?php echo esc_attr(sprintf( __('Submit %s','events-manager'), __('Event','events-manager') )); ?>' >

			    <?php else: ?>
			    <input type='submit' class='button-primary' value='<?php echo esc_attr(sprintf( __('Update %s','events-manager'), __('Event','events-manager') )); ?>' >
			    <?php endif; ?>
			</p>
			<input type="hidden" name="event_id" value="<?php echo $EM_Event->event_id; ?>" >
			<input type="hidden" name="_wpnonce" value="<?php echo wp_create_nonce('wpnonce_event_save'); ?>" >
			<input type="hidden" name="action" value="event_save" >
			<?php if( !empty($_REQUEST['redirect_to']) ): ?>
			<input type="hidden" name="redirect_to" value="<?php echo esc_attr($_REQUEST['redirect_to']); ?>" >
			<?php endif; ?>
		</section>

	</form>
</div>