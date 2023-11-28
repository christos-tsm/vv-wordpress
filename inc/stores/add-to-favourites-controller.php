<?php

/**
 * Create functions to handle get/add/remove
 */

// Get the user's favorites
function get_user_favorites($user_id) {
    // Retrieve the favorites data
    $favorites = get_user_meta($user_id, 'favorites', true);
    // If the favorites data is not an array (which could be the case for a new user or if the data is corrupted), initialize it as an empty array
    if (!is_array($favorites)) {
        $favorites = [];
    }
    return $favorites;
}
// Add to the user's favorites
function add_to_user_favorites($user_id, $post_id) {
    $favorites = get_user_favorites($user_id);
    $favorites[] = $post_id;
    update_user_meta($user_id, 'favorites', $favorites);
}
// Remove from the user's favorites
function remove_from_user_favorites($user_id, $post_id) {
    $favorites = get_user_favorites($user_id);
    if (($key = array_search($post_id, $favorites)) !== false) {
        unset($favorites[$key]);
    }
    update_user_meta($user_id, 'favorites', $favorites);
}

/**
 * Create the controller ajax functions
 */
// Handle the AJAX request
add_action('wp_ajax_add_to_favorites', 'add_to_favorites');
add_action('wp_ajax_remove_from_favorites', 'remove_from_favorites');
function add_to_favorites() {
    check_ajax_referer('fav_nonce', 'nonce');
    // Get the POST data
    $post_id = $_POST['post_id'];
    // Get the current user
    $user_id = get_current_user_id();
    if ($post_id && $user_id) {
        // Add the post to the user's favorites
        add_to_user_favorites($user_id, $post_id);
        // Return a success response
        wp_send_json_success();
    } else {
        // Return an error response
        wp_send_json_error('Missing post ID or user ID');
    }
}

function remove_from_favorites() {
    check_ajax_referer('fav_nonce', 'nonce');
    // Get the POST data
    $post_id = $_POST['post_id'];
    // Get the current user
    $user_id = get_current_user_id();
    if ($post_id && $user_id) {
        // Remove the post from the user's favorites
        remove_from_user_favorites($user_id, $post_id);
        // Return a success response
        wp_send_json_success();
    } else {
        // Return an error response
        wp_send_json_error('Missing post ID or user ID');
    }
}
