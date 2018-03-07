<?php
/*
Plugin Name: Homepage-Banner
Plugin URI: sig-ad.com
Description: Adds a basic homepage banner with area for text.
Author: Phillip Werner
Author URI:
License: GPLv2
*/



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



