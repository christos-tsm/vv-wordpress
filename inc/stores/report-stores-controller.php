<?php
function can_user_report($user_id, $post_id)
{
    // Get reported users for this post
    $reported_users = get_post_meta($post_id, 'reported_users', true);
    // If no one has reported yet, it's okay to report
    if (empty($reported_users)) {
        return true;
    }
    // If the user has reported before, they can't report again
    if (in_array($user_id, $reported_users)) {
        return false;
    }
    // If the user hasn't reported before, they can report
    return true;
}
function handle_report_submission()
{
    // Check if our nonce is set.
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'report_nonce')) {
        echo json_encode(array('success' => false, 'message' => 'Nonce verification failed.'));
        wp_die();
    }

    $user_id = $_POST['user_id'];
    $post_id = $_POST['post_id'];
    $post_title = $_POST['post_title'];
    $user_reporting_email = $_POST['user_reported_email'];

    if (!can_user_report($user_id, $post_id)) {
        echo json_encode(array('success' => false, 'message' => 'You have already reported this post.'));
        wp_die();
    }

    // If user can report, record that they have
    $reported_users = get_post_meta($post_id, 'reported_users', true);
    if (empty($reported_users)) {
        $reported_users = array();
    }
    $reported_users[] = $user_id;
    update_post_meta($post_id, 'reported_users', $reported_users);

    // Change email content type to HTML
    add_filter('wp_mail_content_type', function () {
        return 'text/html';
    });

    // Send email to admin
    $to = get_option('admin_email');
    $subject = 'New report for post ID ' . $post_id;
    $message = '<h1 style="font-family: sans-serif; margin-bottom: 10px;"><strong>User ID ' . $user_id . ' with email ' . $user_reporting_email . ' has reported post ID ' . $post_id . ' with name ' .  $post_title . '</strong></h1>';
    $message .= '<p style="font-family: sans-serif; margin: 10px 0;"><strong>Report Reason </strong></p><p style="font-family: sans-serif;">' . $_POST['report_case'] . '</p>';
    $message .= '<p style="font-family: sans-serif; margin: 10px 0;"><strong>Report Comments: </strong></p><p style="font-family: sans-serif;">' . $_POST['report_notes'] . '</p>';
    wp_mail($to, $subject, $message);

    echo json_encode(array('success' => true, 'message' => 'Your report has been submitted.'));
    wp_die();
}
add_action('wp_ajax_report_form', 'handle_report_submission');
add_action('wp_ajax_nopriv_report_form', 'handle_report_submission');
