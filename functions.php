<?php

/**
 * Volos Voyage functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Volos_Voyage
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

/**
 * Theme setup
 */
require get_template_directory() . '/inc/theme-setup.php';

/**
 * Scripts & Styles enqueue
 */
require get_template_directory() . '/inc/scripts.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Site Utilities
 */
require get_stylesheet_directory() . '/inc/utils.php';

/**
 * Site Options
 */
require get_stylesheet_directory() . '/inc/options.php';

/**
 * Custom Post Types
 */
require get_stylesheet_directory() . '/inc/restaurants.php';
require get_stylesheet_directory() . '/inc/coffee-houses.php';
require get_stylesheet_directory() . '/inc/museums.php';
require get_stylesheet_directory() . '/inc/hotels.php';
require get_stylesheet_directory() . '/inc/destinations.php';
require get_stylesheet_directory() . '/inc/events.php';
require get_stylesheet_directory() . '/inc/bars.php';
require get_stylesheet_directory() . '/inc/travel-agents.php';
require get_stylesheet_directory() . '/inc/night-clubs.php';
require get_stylesheet_directory() . '/inc/sightseeing.php';

/**
 * AJAX files
 */
require get_stylesheet_directory() . '/inc/auth-register-ajax.php';
require get_stylesheet_directory() . '/inc/auth-login-ajax.php';
