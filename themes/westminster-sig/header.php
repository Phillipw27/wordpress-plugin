<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package westminster-sig
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
<script>
jQuery(document).ready(function(e) {
jQuery('#mobile-nav').click(function(e){
		jQuery('.main-navigation ul').toggle();
		
		//alert("here");
	});
});
	</script>
</head>

<body <?php body_class(); ?>>


	<header>
	<div class="gridContainer clearfix">
		<div id="logo" ><?php dynamic_sidebar( 'top-logo' ); ?></div> <!-- end logo-->
  </div><!-- end gridContainer-->
  <div class="main-navigation">
 		 <a id="mobile-nav" href="javascript:void(0);"><span>Menu</span></a>
     	<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
    </div><!-- end navigation-->
    <div class="billboard">
    	<?php if ( is_front_page() ) {
			  // static homepage
			  echo do_shortcode("[huge_it_slider id='1']");
			}  ?>
	</div><!-- end billboard-->
        
</header>