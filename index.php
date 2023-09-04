<?php
/*
Plugin Name: Strength9 Data Prep Plugin
Description: This plugin will prepare and clean the data for the website
Author: Dave Pratt
Version: 1.0
Author URI: http://www.strength9.co.uk
*/

// Exit if accessed directly    
if ( ! defined( 'ABSPATH' ) ) exit;

function s9_cas_textfield($field, $post_id = false, $escape_method = "wp_kses_post") {
    $field = get_field($field, $post_id, true);
    
    if($field === NULL || $field === FALSE) $field = '';
    if(is_array($field))
    {
        $field_escaped = array();
        foreach($field as $key => $value)
        {
            $field_escaped[$key] = ($escape_method === NULL) ? $value : $escape_method($value);
        }
        return $field_escaped;
    }
    else
        return ($escape_method === NULL) ? $field : $escape_method($field);
};
function s9_cas_image ($field, $post_id = false, $return_method = "img", $class = false ) {
    $field = get_field($field, $post_id, true);
    
    if($field === NULL || $field === FALSE) {
        
        return '';
        exit;
    } else {
        if(is_array($field))
        {
            if ($return_method == "img") {
            if ($class === NULL || $class === FALSE) { $class = ''; } else {$class = ' class="'.$class.'" ';}
            return '<img src="'.esc_url($field['url']).'" alt="'.esc_attr($field['alt']).'"'.$class.'/>';
            } else {
                return esc_url($field['url']);
            }
        }
        else {
            return '';
        }
    };
};
function s9_cas_email ($address = false, $class = false) {
    if($class === NULL || $class === FALSE) {
        $class = '';
    } else {
        $class = ' class="'.$class.'" ';
    };
    
    if($address === NULL || $address === FALSE  || !filter_var($address, FILTER_VALIDATE_EMAIL)) {
        return 'Invalid email address';
        exit;
    } else {
        return '<a href="'.esc_url('mailto:'.antispambot($address)).'"'.$class.'>'.esc_html( antispambot( $address ) ).'</a>';
        exit;
    };
    
};
function s9_cas_socialmedia ( $socmediacontainer, $class = false) {
	if($socmediacontainer === NULL ||$socmediacontainer === FALSE || !is_array($socmediacontainer) ) {
		exit;
	} else  {
		if ($class === NULL || $class === FALSE) { $class = ''; } else {$class = ' class="'.$class.'" ';}
    	$out = '';
     	foreach($socmediacontainer as $repeater) {
         	$out .= '<li><a href="'.esc_url($repeater["social_address"]).'" title="'.esc_attr($repeater["social_address"]).'"><i class="'.esc_html($repeater["social"]).'"></i></a></li>';
    	}
    	return '<ul>'.$out.'</ul>';
	};
	exit;

};



?>