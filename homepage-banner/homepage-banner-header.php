<?php
/*
Plugin Name: Homepage-Banner
Plugin URI: sig-ad.com
Description: Adds a basic homepage banner with area for text.
Author: Phillip Werner
Author URI:
License: GPLv2
*/



	wp_enqueue_script('jquery');


register_activation_hook(__FILE__, banner_activation());

function banner_activation(){
	//Get access to global database access class
	global $wpdb;
	//Create table on main blog in network mode or single blog
	homepage_create_table($wpdb->get_blog_prefix());
}

function homepage_create_table($prefix){
	//Prepare SQL query to create database table

	$creation_query = 'CREATE TABLE IF NOT EXISTS ' .
	$prefix . 'homepage_banners ( `banner_id` int(20) Not NULL AUTO_INCREMENT, `image` text, `header_1` text, `header_2` text, `ordinal` int(3), PRIMARY KEY(`banner_id`));';
	global $wpdb;
	$wpdb->query( $creation_query );
}




/*
if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}





 //Change Favicon programatically using add_action hook
/*
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
}
*/

/* Change Meta information using add_filter hook
add_filter('the_generator', 'ch2gf_generator_filter', 10, 2);

function ch2gf_generator_filter($html, $type){
	if($type == 'xhtml'){
		$html = preg_replace('("WordPress.*?")', '"Phillip Werner"', $html);
	}
	return $html;
}
*/

/* Add Email Icon at the end of Each blog/page to email the link 


add_filter('the_content', 'ch2epl_email_page_filter');

function ch2epl_email_page_filter($the_content) {
	$mail_icon_url = plugins_url('Mail-icon.png', __FILE__);

	$new_content = $the_content;

$new_content .= '<div class="email_link">';
$new_content .= '<a href="mailto:someone@somewhere.com?';
$new_content .= 'subject=Check out this interesting article ';
$new_content .= 'entitled ' . get_the_title();
$new_content .= '&body=Hi!%0A%0AI thought you would enjoy ';
$new_content .= 'this article entitled ';
$new_content .= get_the_title() . '.%0A%0A' . get_permalink();
$new_content .= '%0A%0AEnjoy!">';

if ( !empty( $mail_icon_url ) ) {
$new_content .= '<img alt="Email icon" ';
$new_content .= ' src="';
$new_content .= $mail_icon_url. '" /></a>';
} else {
$new_content .= 'Email link to this article';
}
$new_content .= '</div>';
// Return filtered content for display on the site

return $new_content;

} */



// SHORTCODES!!!!!!!!!!
/*
add_shortcode('tl', 'ch2ts_twitter_link_shortcode');
function ch2ts_twitter_link_shortcode($atts){
	$output = '<a href="httsp://twitter.com">';
	$output .= 'Twitter Feed</a>';
	return $output;
}
*/
//Show Live Twitter Feed with ShortCode
/*
add_shortcode('twitterfeed', 'ch2te_twitter_embed_shortcode');

function ch2te_twitter_embed_shortcode($atts){
		extract( shortcode_atts( array(
		'user_name' => 'ylefebvre'
		), $atts ) );
		if ( !empty( $user_name ) ) {
		$output = '<a class="twitter-timeline" href="';
		$output .= esc_url( 'https://twitter.com/' . $user_name );
		$output .= '">Tweets by ' . esc_html( $user_name );
		$output .= '</a><script async ';
		$output .= 'src="//platform.twitter.com/widgets.js"';
		$output .= ' charset="utf-8"></script>';
		} else {
		$output = '';
		}
		return $output;
}
*/

//Load a Stylesheet for plugin using OOP
/*
class CH2_OO_Private_Item_Text{
	function __construct(){
add_action('wp_enqueue_scripts', array( $this,'ch2pit_queue_stylesheet'));

function ch2pit_queue_stylesheet(){
	wp_enqueue_style('privateshortcodestyle', plugins_url('stylesheet.css', __FILE__));
}
	}
}
$my_ch2_oo_private_item_text = new CH2_OO_Private_Item_Text();


*/



add_action('admin_menu', 'homepage_banner_admin_menu');

function homepage_banner_admin_menu() {
// Create top-level menu item
add_menu_page( 'Homepage-Banner',
'Homepage-Banner', 'manage_options',
'ch3mlm-main-menu', 'ch3mlm_my_complex_main');
}
//plugins_url( 'myplugin.png', __FILE__ ) );
// Create a sub-menu under the top-level menu

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

function ch3mlm_my_complex_main(){
	//Retrieve plugin configuration options from database
	$options = ch2pho_get_options();


	?>

	<div id="ch2pho-general" class="wrap">
<h2>My Homepage Banners</h2><br />
<?php 

if ( isset( $_GET['message'] ) &&
$_GET['message'] == '1' ) { ?>
<div id='message' class='updated fade'>
<p><strong>Settings Saved</strong></p></div>
<?php } 

global $wpdb;
	 ?>

<!-- <input type="Add New" value="Add New" class="button-primary"/>
<input type="submit" value="Submit" class="button-primary"/>
</form> -->

<!-- Top-level menu -->
<div id="general" class="wrap">
	<h2>Homepage Banners <a class="add-new-banner" href="<?php echo add_query_arg( array('page' => 'ch3mlm-main-menu', 'id' => 'new'), admin_url('options-general.php')); ?>"> Add New Banner</a> </h2>
	<!-- Display list of banners -->
	<?php if(empty($_GET['id'])){
		$banner_query = 'select * from ' . $wpdb->get_blog_prefix();
		$banner_query .= 'homepage_banners ORDER by ordinal ASC';
		$banner_items = $wpdb->get_results($banner_query, ARRAY_A);
		
	}?>

	<h3>Manage Banner Entries</h3>
	<table class="wp-list-table widefat fixed">
		<thead><tr><th style="width: 80px">ID</th>
			<th style="width: 300px">Image</th>
			<th>Header 1</th>
			<th>Header 2</th>
			<th>Ordinal</th></thead>
			<tbody>
			<?php
			//Display Banners if there are any
			if($banner_items){
				foreach($banner_items as $items){
					echo '<tr style="background: #FFF">';
					echo '<td>' . $items['banner_id'] . '</td>';
					echo '<td><img src="' . $items['image']. '" width="100%" height="auto" /></td>';
					echo '<td>' . $items['header_1'] . '</td>';
					echo '<td>' . $items['header_2'] . '</td>';
					echo '<td>' . $items['ordinal'] . '</td></tr>';
				}
			}
			else if( isset($_GET['id']) && ('new' == $_GET['id'] || is_numeric($_GET['id']))){
				$banner_id = intval($_GET['id']);
				$mode = 'new';
				//Query database if numeric id is present
				if($banner_id > 0){
					$banner_query = 'select * from ' . $wpdb->get_blog_prefix();
					$banner_query .= 'homepage_banner where banner_id = %d';
					$banner_data = $wpdb->get_row($wpdb->prepare($banner_query, $banner_id), ARRAY_A);
					//Set variable to indicate page mode
					if($banner_data){
						$mode = 'edit';
					}
				}

				if('new' == $mode){
					$banner_data = array('image' => '', 'header_1' => '', 'header_2' => '', 'ordinal' => '');
				}

				//Display Title based on current mode

				if('new' == $mode){
					echo '<h3> Add New Banner </h3>';
				}
				else if('edit' == $mode){
					echo '<h3>Edit Banner #'.$banner_data['banner_id']. ' - ';
					echo $banner_data['header_1'] . '<h3>';
				}


				?>

				<form method="post" action="<?php echo admin_url('admin-post.php');?>">
					<input type="hidden" name="action" value="save_banner" />
					<input type="hidden" name="banner_id" value="<?php echo $banner_data['banner_id'] ?>"/>

					<!-- Adding security through hidden referrer field -->
					<?php wp_nonce_field('banner_add_edit'); ?>

					<!-- Display banner editing form -->
					
					<table>
						
						<tr>
							<td style="width: 150px">Header 1</td>
							<td><input type="text" name="header_1" size="60" value="<?php echo esc_html($banner_data['header_1']); ?>"/></td>
						</tr>
						<tr>
							<td>Header 2</td>
							<td><input type="text" name="header_2" size="60" value="<?php echo esc_html($banner_data['header_2']);?>" /></td>
						</tr>
						<tr>
							<td>
								<select name="ordinal">
									<?php
									//Display drop-down list of banner ordinals
									$banner_data['ordinal']?>
								</select>
							</td>
						</tr>
					</table>
					<input type="submit" value="Submit" class="button-primary" />
				</form>
				<?php }
			
			else{
				echo '<tr style="background: #FFF"><td>';
				echo 'Not Found</td></tr>';
			}
			?>
		</tbody>
		</table><br />
		<?php } ?>
	

</div>
<?php



	add_action("admin_enqueue_scripts", "enqueue_media_uploader");
function enqueue_media_uploader(){
	wp_enqueue_scripts('homejavascript', plugins_url('homepage.js',__FILE__));
	wp_enqueue_media();

}



add_action('admin_init', 'ch2pho_admin_init');
add_action('admin_init', 'ch8bt_admin_init');

function ch2pho_admin_init(){
	add_action('admin_post_save_ch2pho_options', 'process_ch2pho_options');
}

function ch8bt_admin_init(){
	add_action('admin_post_save_save_banner', 'process_added_banner');
}

function process_added_banner(){
	if(!current_user_can('manage_options')){
		wp_die('Not Allowed');
	}
	//Check if nonce field is present for security
	check_admin_referer('banner_add_edit');
	global $wpdb;

	//Place this stuff in the database
	$banner_data = array();
	$banner_data['header_1'] = (isset($_POST['header_1']) ? sanitize_text_field($_POST['header_1']) : '');

	$banner_data['header_2'] = (isset($_POST['header_2']) ? sanitize_text_field($_POST['header_2']): '');
	$banner_data['ordinal'] = (isset($_POST['ordinal']) ? intval($_POST['ordinal']) : 0);

	//Insert into the database
	if(isset($_POST['banner_id']) && 0 == $_POST['banner_id']){
		$wpdb->insert($wpdb->get_blog_prefix(). 'homepage_banners'. $banner_data);
	}
	else if( isset($_POST['banner_id']) && $_POST['banner_id'] > 0){
		$wpdb->update($wpdb->get_blog_prefix(). 'homepage_banners'. $banner_data, array('banner_id' => intval($_POST['banner_id'])));
	}
	//Maybe here issue??????
	wp_redirect( add_query_arg('page', 'ch3mlm-main-menu', admin_url('options_general.php')));
	exit;
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
wp_redirect( add_query_arg( array('page' => 'ch3mlm-main-menu', 'message' => '1'),
admin_url( 'options-general.php' ) ) );
exit;
}
?>





