<?php

/*
Plugin Name: Westminster Vimeo Page
Plugin URI: sig-ad.com
Description: Displays Vimeo videos the way its needed.
Author: Phillip Werner
Author URI:
License: GPLv2
*/

add_shortcode('wa_vimeo', 'get_vimeo_information');

function get_vimeo_information(){
	global $wpdb;

	$information_query =  'select * from ' . $wpdb->get_blog_prefix();
	$information_query .= 'vimeography_gallery ORDER by id';
	$vimeo_videos = $wpdb->get_results( $information_query, ARRAY_A );

	print_r($vimeo_videos);
}


