<?php
add_action('wp_ajax_login_user', 'login_user');
add_action('wp_ajax_nopriv_login_user', 'login_user');
function login_user() {
    $email = $_POST['user_email'];
    $password = $_POST['user_pass'];

    $creds = array(
        'user_login'    => $email,
        'user_password' => $password,
        'remember'      => true
    );

    $user = wp_signon($creds, false);
    if (is_wp_error($user)) {
        $error_message = $user->get_error_message();
        wp_send_json_error($error_message);
    } else {
        wp_send_json_success('Login successful');
    }
    wp_die();
}
