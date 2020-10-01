<?php 
/**
 * Events Manager plugin functions 
 */
 
 
 /**
Events Manager Custom Event Attributes and Conditionals
https://www.johnrussell.dev/blog/2014/07/events-manager-custom-event-attributes-conditionals/
 */

 function em_event_output_condition_filter($replacement, $condition, $match, $EM_Event){
    // Checks for has_Host conditional
    if(is_object($EM_Event) && preg_match('/^has_(Host)$/', $condition, $matches)){
        if(array_key_exists($matches[1], $EM_Event->event_attributes) && !empty($EM_Event->event_attributes[$matches[1]]) ){
            $replacement = preg_replace("/\{\/?$condition\}/", '', $match);
        }else{
            $replacement = '';
        }
    }
    
    return $replacement;
}
add_filter('em_event_output_condition', 'em_event_output_condition_filter', 1, 4);