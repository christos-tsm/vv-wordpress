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
// Show who uploaded the custom post types in the backend
add_filter('manage_edit-profiles_columns', 'volos_voyage_add_user_display_name_column');
add_filter('manage_edit-hotels_columns', 'volos_voyage_add_user_display_name_column');
add_filter('manage_edit-bars_columns', 'volos_voyage_add_user_display_name_column');
add_filter('manage_edit-coffee-houses_columns', 'volos_voyage_add_user_display_name_column');
add_filter('manage_edit-travel-agents_columns', 'volos_voyage_add_user_display_name_column');
add_filter('manage_edit-night-clubs_columns', 'volos_voyage_add_user_display_name_column');
add_filter('manage_edit-restaurants_columns', 'volos_voyage_add_user_display_name_column');
add_filter('manage_edit-shops_columns', 'volos_voyage_add_user_display_name_column');
function volos_voyage_add_user_display_name_column($columns) {
    $columns['submitted_by'] = __('Submitted By', 'my-text-domain');
    return $columns;
}
// Display user display name in "Submitted By" column of profiles custom post type
add_action('manage_profiles_posts_custom_column', 'volos_voyage_display_user_display_name_column', 10, 2);
add_action('manage_hotels_posts_custom_column', 'volos_voyage_display_user_display_name_column', 10, 2);
add_action('manage_bars_posts_custom_column', 'volos_voyage_display_user_display_name_column', 10, 2);
add_action('manage_coffee-houses_posts_custom_column', 'volos_voyage_display_user_display_name_column', 10, 2);
add_action('manage_travel-agents_posts_custom_column', 'volos_voyage_display_user_display_name_column', 10, 2);
add_action('manage_night-clubs_posts_custom_column', 'volos_voyage_display_user_display_name_column', 10, 2);
add_action('manage_restaurants_posts_custom_column', 'volos_voyage_display_user_display_name_column', 10, 2);
add_action('manage_shops_posts_custom_column', 'volos_voyage_display_user_display_name_column', 10, 2);
function volos_voyage_display_user_display_name_column($column_name, $post_id) {
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
function volos_voyage_restrict_child_pages() {
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
add_action('template_redirect', 'volos_voyage_restrict_child_pages');
// Add class in menu li
function volos_voyage_add_additional_class_on_li($classes, $item, $args) {
    if (isset($args->add_li_class)) {
        $classes[] = $args->add_li_class;
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'volos_voyage_add_additional_class_on_li', 1, 3);
// Admin side notifications about draft posts in each custom post type
add_filter('add_menu_classes', 'custom_post_type_draft_count');
function custom_post_type_draft_count($menu) {
    global $wpdb;
    $post_types = get_post_types(array('_builtin' => false)); // Get all custom post types
    foreach ($post_types as $post_type) {
        $count = wp_count_posts($post_type)->draft; // Get the count of draft posts
        $menu_slug = 'edit.php?post_type=' . $post_type; // The slug for the custom post type menu item
        foreach ($menu as $menu_key => $menu_data) {
            if ($menu_slug == $menu_data[2]) {
                $menu[$menu_key][0] .= " <span class='awaiting-mod count-$count'><span class='pending-count'>" . number_format_i18n($count) . "</span></span>"; // Add the count to the menu item title
                break;
            }
        }
    }
    return $menu;
}
