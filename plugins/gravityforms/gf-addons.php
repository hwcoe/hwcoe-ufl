<?php

// Set options for multi select fields
function gf_set_chosen_options($form){
	?>
	
	<script type="text/javascript">
		gform.addFilter('gform_chosen_options','set_chosen_options_js');
		//limit how many options may be chosen in a multi-select
		function set_chosen_options_js(options, element){
			// if form designer has added the CSS class 'limit_options_to_2' to the multi-select
			if (element.parents().hasClass('limit_options_to_2')) {
				//limit number of options to 2 
				options.max_selected_options = 2; 
			}
			return options;
		}
	</script>
	
	<?php
	//return the form object from the php hook  
	return $form;
}

add_action("gform_pre_render", "gf_set_chosen_options");

// Gravity Forms maintenance mode
function gf_maintenance_mode( $form_string, $form ) {
    $form_string = '<p class="lead">Forms have been temporarily disabled for scheduled maintenance. Please check back later.</p>';

    return $form_string;
}
// Uncomment to use
// add_filter( 'gform_get_form_filter', 'gf_maintenance_mode', 10, 2 );

?>