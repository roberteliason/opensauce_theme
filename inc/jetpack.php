<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package opensauce
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function opensauce_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'opensauce_jetpack_setup' );
