<?php
add_action('wp_ajax_delete_user_profile', 'volos_voyage_delete_user_profile');
add_action('wp_ajax_nopriv_delete_user_profile', 'volos_voyage_delete_user_profile');

function volos_voyage_delete_user_profile() {
    $nonce = $_POST['delete_profile_nonce'];
    if (!wp_verify_nonce($nonce, 'delete_profile_nonce')) {
        wp_send_json_error('Invalid nonce.');
    }
    $profile_id = intval($_POST['profile_id']);
    $user_id = intval($_POST['user_id']);
    $current_user_id = get_current_user_id();
    if ($user_id != $current_user_id) {
        wp_send_json_error('You are not authorized to delete this post.');
    }
    $result = wp_trash_post($profile_id);
    if ($result === false) {
        wp_send_json_error('Failed to delete post.');
    } else {
        wp_send_json_success();
    }
    wp_send_json_success();
}
