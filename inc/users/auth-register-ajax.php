<?php
// Handle Ajax registration form submissions
add_action('wp_ajax_register_user', 'register_user');
add_action('wp_ajax_nopriv_register_user', 'register_user');
function register_user() {
    $username = $_POST['user_login'];
    $email = $_POST['user_email'];
    $password = $_POST['user_pass'];

    $userdata = array(
        'user_login' => $username,
        'user_email' => $email,
        'user_pass' => $password,
    );

    $user_id = wp_insert_user($userdata);

    if (is_wp_error($user_id)) {
        $error_message = $user_id->get_error_message();
        wp_send_json_error($error_message);
    } else {
        wp_send_json_success('Ο λογαριασμός σας δημιουργήθηκε.');
    }
    wp_die();
}
