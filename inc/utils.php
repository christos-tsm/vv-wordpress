<?php
//  Disable the emoji's
function disable_emojis() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    // Remove from TinyMCE
    add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
}
add_action('init', 'disable_emojis');

// Filter out the tinymce emoji plugin.
function disable_emojis_tinymce($plugins) {
    if (is_array($plugins)) {
        return array_diff($plugins, array('wpemoji'));
    } else {
        return array();
    }
}

// Remove classic-theme-styles
add_action('wp_enqueue_scripts', 'volos_voyage_deregister_styles', 20);
function volos_voyage_deregister_styles() {
    wp_dequeue_style('classic-theme-styles');
}

//Remove Gutenberg Block Library CSS from loading on the frontend
function volos_voyage_wp_block_library_css() {
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wc-blocks-style'); // Remove WooCommerce block CSS
}
add_action('wp_enqueue_scripts', 'volos_voyage_wp_block_library_css', 100);

//Remove admin bar from all users
add_action('after_setup_theme', 'volos_voyage_remove_admin_bar');
function volos_voyage_remove_admin_bar() {
    if (!current_user_can('administrator') && !is_admin()) {
        show_admin_bar(false);
    }
}

//Create new user role for registered users
function create_client_role() {
    add_role('client', 'Client User', array(
        'read' => true,
        'edit_posts' => true,
        'delete_posts' => true,
        'publish_posts' => true,
        'upload_files' => true,
        'edit_published_posts' => true,
        'delete_published_posts' => true
    ));
}
add_action('init', 'create_client_role');

//Hide wp-admin from client user role
function hide_admin_dashboard() {
    if (current_user_can('custom_user')) {
        remove_menu_page('index.php');
    }
}
add_action('admin_menu', 'hide_admin_dashboard');

// Redirect all user roles except admin and non-logged in users away from wp-admin dashboard
function custom_user_redirect_to_dashboard() {
    if (!current_user_can('administrator') && is_admin() && !(defined('DOING_AJAX') && DOING_AJAX)) {
        wp_redirect(pll_home_url());
        exit;
    }
}
add_action('admin_init', 'custom_user_redirect_to_dashboard');
