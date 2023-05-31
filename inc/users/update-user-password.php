<?php
add_action('wp_ajax_update_user_password', 'update_user_password_callback');
add_action('wp_ajax_nopriv_update_user_password', 'update_user_password_callback');

function update_user_password_callback()
{
    // Check the nonce for security
    check_ajax_referer('update_user_password', 'update_user_password_nonce');

    // Get the user ID
    $user_id = get_current_user_id();

    // Get the submitted form data
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];

    // Verify the old password
    $user = get_user_by('id', $user_id);
    if ($user && wp_check_password($old_password, $user->data->user_pass, $user->ID)) {
        // Update the user password
        wp_set_password($new_password, $user_id);

        // Prepare a success response
        $message = 'Ο κωδικός σας άλλαξε επιτυχώς. Παρακαλούμε, συνδεθείτε ξανά.';
        $response = array(
            'success' => true,
            'data' =>  $message
        );
    } else {
        // Prepare an error response
        $message = 'Λάθος τρέχον κωδικός.';
        $response = array(
            'success' => false,
            'data' =>  $message
        );
    }

    wp_send_json($response);
    wp_die();
}
