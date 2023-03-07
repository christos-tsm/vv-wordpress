<?php
//  Disable the emoji's
function volos_voyage_disable_emojis() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    // Remove from TinyMCE
    add_filter('tiny_mce_plugins', 'volos_voyage_disable_emojis_tinymce');
}
// Filter out the tinymce emoji plugin.
function volos_voyage_disable_emojis_tinymce($plugins) {
    if (is_array($plugins)) {
        return array_diff($plugins, array('wpemoji'));
    } else {
        return array();
    }
}
add_action('init', 'volos_voyage_disable_emojis');
// Remove classic-theme-styles
function volos_voyage_deregister_styles() {
    wp_dequeue_style('classic-theme-styles');
}
add_action('wp_enqueue_scripts', 'volos_voyage_deregister_styles', 20);
//Remove Gutenberg Block Library CSS from loading on the frontend
function volos_voyage_wp_block_library_css() {
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wc-blocks-style'); // Remove WooCommerce block CSS
}
add_action('wp_enqueue_scripts', 'volos_voyage_wp_block_library_css', 100);
//Remove admin bar from all users
function volos_voyage_remove_admin_bar() {
    if (!current_user_can('administrator') && !is_admin()) {
        show_admin_bar(false);
    }
}
add_action('after_setup_theme', 'volos_voyage_remove_admin_bar');
//Create new user role for registered users
function volos_voyage_create_guest_role() {
    add_role('guest', 'Guest User', array(
        'read' => true,
        'edit_posts' => true,
        'delete_posts' => true,
        'publish_posts' => true,
        'upload_files' => true,
        'edit_published_posts' => true,
        'delete_published_posts' => true
    ));
}
add_action('init', 'volos_voyage_create_guest_role');
// Redirect all user roles except admin and non-logged in users away from wp-admin dashboard
function volos_voyage_guest_user_redirect_to_dashboard() {
    $user = wp_get_current_user();
    if (in_array('guest', (array) $user->roles) && is_admin() && !(defined('DOING_AJAX') && DOING_AJAX)) {
        wp_redirect(pll_home_url());
        exit;
    }
}
add_action('admin_init', 'volos_voyage_guest_user_redirect_to_dashboard');
// Add user data when they upload business
add_action('acf/save_post', 'my_acf_save_post', 10, 1);
function my_acf_save_post($post_id) {
    // Get current user's ID and display name
    $user_id = get_current_user_id();
    $user_display_name = get_the_author_meta('display_name', $user_id);

    // Save user data as post meta data
    update_post_meta($post_id, 'submitted_by_user_id', $user_id);
    update_post_meta($post_id, 'submitted_by_user_display_name', $user_display_name);
}
// Show who uploaded the business profile in the backend
add_filter('manage_edit-profiles_columns', 'my_add_user_display_name_column');
function my_add_user_display_name_column($columns) {
    $columns['submitted_by'] = __('Submitted By', 'my-text-domain');
    return $columns;
}
// Display user display name in "Submitted By" column of profiles custom post type
add_action('manage_profiles_posts_custom_column', 'my_display_user_display_name_column', 10, 2);
function my_display_user_display_name_column($column_name, $post_id) {
    if ($column_name === 'submitted_by') {
        $user_display_name = get_post_meta($post_id, 'submitted_by_user_display_name', true);
        if ($user_display_name) {
            echo esc_html($user_display_name);
        } else {
            echo '-';
        }
    }
}
