<?php
// Register the AJAX action
add_action('wp_ajax_update_user_details', 'update_user_details_callback');
add_action('wp_ajax_nopriv_update_user_details', 'update_user_details_callback');

function update_user_details_callback() {
    // Check the nonce for security
    check_ajax_referer('update_user_details', 'update_user_details_nonce');

    // Get the user ID
    $user_id = get_current_user_id();

    // Get the submitted form data
    $first_name = sanitize_text_field($_POST['first_name']);
    $last_name = sanitize_text_field($_POST['last_name']);
    $user_email = sanitize_email($_POST['user_email']);

    // Update the user profile
    $user_data = array(
        'ID' => $user_id,
        'first_name' => $first_name,
        'last_name' => $last_name,
        'user_email' => $user_email
    );
    wp_update_user($user_data);

    // Send a response back to the AJAX request
    if (isset($_POST['curlang']) && $_POST['curlang'] === 'el') {
        $message = 'Τα στοιχεία λογαριασμού σας ενημερώθηκαν επιτυχώς';
    } else {
        $message = 'Προέκυψε σφάλμα. Παρακαλούμε δοκιμάστε αργότερα';
    }
    $response = array(
        'success' => true,
        'data' =>  $message
    );
    wp_send_json_success($response);
    wp_die();
}
