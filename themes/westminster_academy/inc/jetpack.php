<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package westminster_academy
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function westminster_academy_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'westminster_academy_jetpack_setup' );
