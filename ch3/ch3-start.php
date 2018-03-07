<?php
/*
Plugin Name: CH3
Plugin URI: sig-ad.com
Description: Adds a basic homepage banner with area for text.
Author: Phillip Werner
Author URI:
License: GPLv2
*/


//Set Default Options for Admin Section
/*
register_activation_hook(__FILE__, 'ch3io_set_default_options');

function ch3io_set_default_options(){
	if(false === get_option('ch3io_ga_account_name')){
		add_option('ch3io_ga_account_name', 'UA-000000-0');
	}
}
*/

//More options in an array and upgrage strategy
/*
register_activation_hook(__FILE__, 'ch2pho_set_default_options_array');

function ch2pho_set_default_options_array(){
	ch2pho_get_options();
}

function ch2pho_get_options(){
	$options = get_option('ch2pho_options', array());

	$new_options['user_name'] = 'pwerner';
	$new_options['track_outgoing_links'] = false;

	$merged_options = wp_parse_args($options, $new_options);

	$compare_options = array_diff_key($new_options, $options);
	if(empty($options) || !empty($compare_options)){
		update_option('ch2pho_options', $merged_options);
	}
	return $merged_options;
}

add_action('wp_head', 'ch2pho_page_header_output', 1);

function ch2pho_page_header_output() { 
	$site_icon_url = get_site_icon_url();
	if(!empty ($site_icon_url)){
		wp_site_icon();
	}
	else{
		$icon_url = plugins_url('favicon.ico', __FILE__);
 ?>

 <link rel="shortcut icon" href="<?php echo $icon_url; ?>" />
 <?php
	}

	add_action('the_content', 'ch2lfa_link_filter_analytics');

	function ch2lfa_link_filter_analytics($the_content){

		$new_content = str_replace('href', 'onClick="recordOutboundLink( this );return false;" href', $the_content );
		return $new_content;
	}
	add_action('wp_footer', 'ch2lfa_footer_analytics_code');

	function ch2lfa_footer_analytics_code(){
		?>
		<script type="text/javascript">
function recordOutboundLink( link ) {
ga( 'send', 'event', 'Outbound Links', 'Click',
link.href, { 'transport': 'beacon',
'hitCallback': function() {
document.location = link.href;
}
} );
}
</script>
<?php 
	}
}*/

//Add Menu under Settings
/*
add_action('admin_menu', 'ch2pho_settings_menu', 1);

function ch2pho_settings_menu(){
	add_options_page('My Google Analytics Configuration', 'My Google Analytics', 'manage_options', 'ch2pho-my-google-analytics', 'ch2pho_config_page');
}*/


//Add multilevel teir menu
/*
add_action('admin_menu', 'ch3mlm_admin_menu');

function ch3mlm_admin_menu() {
// Create top-level menu item
add_menu_page( 'My Complex Plugin Configuration Page',
'My Complex Plugin', 'manage_options',
'ch3mlm-main-menu', 'ch3mlm_my_complex_main',
plugins_url( 'myplugin.png', __FILE__ ) );
// Create a sub-menu under the top-level menu
add_submenu_page( 'ch3mlm-main-menu',
'My Complex Menu Sub-Config Page',
'Sub-Config Page',
'manage_options', 'ch3mlm-sub-menu',
'ch3mlm_my_complex_submenu' );

///Add Outside link to another page
global $submenu;
$url = 'https://www.packtpub.com';
$submenu['ch3mlm-main-menu'][] = array('FAQ', 'manage_options', $url);
}
*/

//Hide items which users should not access from default menu
//This removes comments and Permalinks under Settings
/*
add_action('admin_menu', 'ch3hmi_hide_menu_item');

function ch3hmi_hide_menu_item(){
	remove_menu_page('edit-comments.php');
	remove_submenu_page('options-general.php', 'options-permalink.php');
}
*/

//Render admin page contents with HTML
/*
function ch2pho_config_page(){
	//Retrieve plugin configuration options from database
	$options = ch2pho_get_options();
	?>

	<div id="ch2pho-general" class="wrap">
<h2>My Google Analytics</h2><br />
<?php if ( isset( $_GET['message'] ) &&
$_GET['message'] == '1' ) { ?>
<div id='message' class='updated fade'>
<p><strong>Settings Saved</strong></p></div>
<?php } ?>
<form method="post" action="admin-post.php">
<input type="hidden" name="action"
value="save_ch2pho_options" />
<!-- Adding security through hidden referrer field -->
<?php wp_nonce_field( 'ch2pho' ); ?>
Account Name: <input type="text" name="user_name"
value="<?php echo esc_html( $options['user_name'] );
?>"/><br />
Track Outgoing Links: <input type="checkbox"
name="track_outgoing_links"
<?php checked( $options['track_outgoing_links'] ); ?>/>
<br /><br />
<input type="submit" value="Submit" class="button-primary"/>
</form>
</div>
<?php }


add_action('admin_init', 'ch2pho_admin_init');

function ch2pho_admin_init(){
	add_action('admin_post_save_ch2pho_options', 'process_ch2pho_options');
}

function process_ch2pho_options() {
// Check that user has proper security level
if ( !current_user_can( 'manage_options' ) ) {
wp_die( 'Not allowed' );
}
// Check if nonce field configuration form is present
check_admin_referer( 'ch2pho' );
// Retrieve original plugin options array
$options = ch2pho_get_options();

// Cycle through all text form fields and store their values
// in the options array
foreach ( array( 'user_name' ) as $option_name ) {
if ( isset( $_POST[$option_name] ) ) {
$options[$option_name] =
sanitize_text_field( $_POST[$option_name] );
}
}
// Cycle through all check box form fields and set the options
// array to true or false values based on presence of variables
foreach ( array( 'track_outgoing_links' ) as $option_name ) {
if ( isset( $_POST[$option_name] ) ) {
$options[$option_name] = true;
} else {
$options[$option_name] = false;
}
}
// Store updated options array to database and send message
update_option( 'ch2pho_options', $options );
// Redirect the page to the configuration form
wp_redirect( add_query_arg( array('page' => 'ch2pho-my-google-analytics', 'message' => '1'),
admin_url( 'options-general.php' ) ) );
exit;
}
*/


