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
 * String Translations
 */
require get_stylesheet_directory() . '/inc/translations.php';

/**
 * Custom Post Types
 */
require get_stylesheet_directory() . '/inc/custom-post-types/restaurants.php';
require get_stylesheet_directory() . '/inc/custom-post-types/coffee-houses.php';
require get_stylesheet_directory() . '/inc/custom-post-types/museums.php';
require get_stylesheet_directory() . '/inc/custom-post-types/shops.php';
require get_stylesheet_directory() . '/inc/custom-post-types/hotels.php';
require get_stylesheet_directory() . '/inc/custom-post-types/destinations.php';
require get_stylesheet_directory() . '/inc/custom-post-types/events.php';
require get_stylesheet_directory() . '/inc/custom-post-types/bars.php';
require get_stylesheet_directory() . '/inc/custom-post-types/travel-agents.php';
require get_stylesheet_directory() . '/inc/custom-post-types/night-clubs.php';
require get_stylesheet_directory() . '/inc/custom-post-types/sightseeing.php';
require get_stylesheet_directory() . '/inc/custom-post-types/freelancers.php';

/**
 * AJAX files
 */
require get_stylesheet_directory() . '/inc/users/auth-register-ajax.php';
require get_stylesheet_directory() . '/inc/users/auth-login-ajax.php';
require get_stylesheet_directory() . '/inc/users/update-user-details.php';
require get_stylesheet_directory() . '/inc/stores/delete-store.php';
require get_stylesheet_directory() . '/inc/ajax/cpt-archive-ajax.php';
require get_stylesheet_directory() . '/inc/stores/report-stores-controller.php';
require get_stylesheet_directory() . '/inc/stores/add-to-favourites-controller.php';
/**
 * Custom post types submission controllers
 * Needs to be loaded after taxonomies are created, so they can be available in the form submission
 */
function load_add_store_controller()
{
	require_once(get_stylesheet_directory() . '/inc/stores/add-store-controller.php');
	require_once(get_stylesheet_directory() . '/inc/events/add-event-controller.php');
}
// Hook the function to wp_loaded action hook
add_action('wp_loaded', 'load_add_store_controller');
