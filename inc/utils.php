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
// Disable all colors within Gutenberg.
remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');
remove_action('wp_footer', 'wp_enqueue_global_styles', 1);
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
        $user_id = intval(get_field('user_id', $post_id));
        $user_data = get_userdata($user_id);
        $user_display_name = $user_data->user_login . ' - ' . $user_data->user_email;
        if ($user_display_name) {
            echo esc_html($user_display_name);
        } else {
            echo '-';
        }
    }
}
// Restrict access to non-logged in users
add_action('template_redirect', 'restrict_child_pages');
function restrict_child_pages() {
    if (!is_user_logged_in()) { // Check if user is not logged in
        $parent_ids = array(48, 50); // Set the IDs of the parent pages
        $page_id = get_queried_object_id(); // Get the ID of the current page
        $is_child_page = false;
        foreach ($parent_ids as $parent_id) {
            if (in_array($parent_id, get_post_ancestors($page_id))) {
                $is_child_page = true;
                break;
            }
        }
        if ($is_child_page) {
            wp_redirect(pll_home_url()); // Redirect to the login page
            exit;
        }
    }
}
