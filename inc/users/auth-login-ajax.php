<?php
add_action('wp_ajax_login_user', 'login_user');
add_action('wp_ajax_nopriv_login_user', 'login_user');

function login_user()
{
    // Check if our nonce is set and verify it.
    if (!isset($_POST['security']) || !wp_verify_nonce($_POST['security'], 'login_user_nonce')) {
        wp_send_json_error('Invalid security token sent.');
        wp_die();
    }

    // Sanitize and validate email
    $email = sanitize_email($_POST['user_email']);
    if (!is_email($email)) {
        wp_send_json_error('Invalid email address.');
        wp_die();
    }

    // Sanitize password
    $password = sanitize_text_field($_POST['user_pass']);

    $creds = array(
        'user_login'    => $email,
        'user_password' => $password,
        'remember'      => true
    );

    // Remove PMPRO hooks temporarily
    remove_all_actions('wp_login_failed');

    $user = wp_signon($creds, false);
    if (is_wp_error($user)) {
        $error_message = $user->get_error_message();
        wp_send_json_error($error_message);
    } else {
        wp_send_json_success('Login successful');
    }

    // Re-add PMPRO hooks after handling the request
    do_action('wp_login_failed');

    wp_die();
}
