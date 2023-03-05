<?php
/*
add_action('admin_post_update_user_details', 'update_user_details');
add_action('admin_post_nopriv_update_user_details', 'update_user_details');

function update_user_details() {
    $account_page_gr = get_the_permalink(227);
    $account_page_en = get_the_permalink(232);
    // Check nonce
    if (!isset($_POST['update_user_details_nonce'])) {
        if (!wp_verify_nonce($_POST['update_user_details_nonce'], 'update_user_details')) {
            wp_die('Invalid form data nonce');
        }
    }
    // Get user ID
    $user_id = get_current_user_id();
    if (!$user_id) {
        wp_die('You must be logged in to update your details.');
    }
    // Check if there is first_name last_name email
    if (!isset($_POST['first_name']) || !isset($_POST['last_name']) || !isset($_POST['user_email'])) {
        if (isset($_POST['curlang']) && $_POST['curlang'] === 'el') {
            set_transient('update_user_details_error', 'Τα πεδία όνομα, επίθετο και email είναι υποχρεωτικά', 10);
            wp_redirect($_POST['_wp_http_referer']);
            exit();
        } else {
            set_transient('update_user_details_error', 'First name, last name and email fields are required', 10);
            wp_redirect($_POST['_wp_http_referer']);
            exit();
        }
    }
    // Sanitize inputs
    $first_name = sanitize_text_field($_POST['first_name']);
    $last_name = sanitize_text_field($_POST['last_name']);
    $email = sanitize_email($_POST['user_email']);
    // Check if sanitized inputs are empty
    if (empty($first_name) || empty($last_name) || empty($email)) {
        if (isset($_POST['curlang']) && $_POST['curlang'] === 'el') {
            set_transient('update_user_details_error', 'Μη έγκυρα δεδομένα.', 10);
            wp_redirect($account_page_gr);
            exit();
        } else {
            set_transient('update_user_details_error', 'Invalid form data.', 10);
            wp_redirect($account_page_en);
            exit();
        }
    }
    //Check if email is an actual email address
    if (!empty($email) && !is_email($email)) {
        if (isset($_POST['curlang']) && $_POST['curlang'] === 'el') {
            set_transient('update_user_details_error', 'Μη έγκυρο email', 10);
            wp_redirect($_POST['_wp_http_referer']);
            exit();
        } else {
            set_transient('update_user_details_error', 'Invalid email address', 10);
            wp_redirect($_POST['_wp_http_referer']);
            exit();
        }
    }
    // Check if first name & last name contains only letters
    $regex = '/^[^\r\n]*$/';
    if (!preg_match($regex, $_POST['first_name']) || !preg_match($regex, $_POST['last_name'])) {
        if (isset($_POST['curlang']) && $_POST['curlang'] === 'el') {
            set_transient('update_user_details_error', 'Το όνομα και το επίθετο πρέπει να περιέχουν μόνο χαρακτήρες.', 10);
            wp_redirect($_POST['_wp_http_referer']);
            exit();
        } else {
            set_transient('update_user_details_error', 'First name and last name should contain only alphabets', 10);
            wp_redirect($_POST['_wp_http_referer']);
            exit();
        }
    }

    $update_args = array(
        'ID' => $user_id,
        'first_name' => $first_name,
        'last_name' => $last_name,
        'user_email' => $email,
    );

    wp_update_user($update_args);

    if (isset($_POST['curlang']) && $_POST['curlang'] === 'el') {
        set_transient('update_user_details_message', 'Τα στοιχεία λογαριασμού ενημερώθηκαν επιτυχώς.', 10);
        wp_redirect($account_page_gr);
        exit();
    } else {
        set_transient('update_user_details_message', 'Your details have been updated successfully.', 10);
        wp_redirect($account_page_en);
        exit();
    }
    exit();
}
*/
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
}
