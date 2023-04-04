<?php
add_action('wp_ajax_delete_store', 'volos_voyage_delete_store');
add_action('wp_ajax_nopriv_delete_store', 'volos_voyage_delete_store');

function volos_voyage_delete_store() {
    $nonce = $_POST['delete_store_nonce'];
    if (!wp_verify_nonce($nonce, 'delete_store_nonce')) {
        wp_send_json_error('Invalid nonce.');
        wp_die();
    }
    $store_id = intval($_POST['store_id']);
    $user_id = intval($_POST['user_id']);
    $current_user_id = get_current_user_id();
    if ($user_id != $current_user_id) {
        wp_send_json_error('You are not authorized to delete this post.');
    }
    $result = wp_trash_post($store_id);
    if ($result === false) {
        wp_send_json_error('Failed to delete post.');
    } else {
        wp_send_json_success();
    }
    wp_send_json_success();
    wp_die();
}
