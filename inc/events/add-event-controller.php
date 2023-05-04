<?php
if (isset($_POST['action']) && $_POST['action'] === "submit_custom_event_form" && wp_verify_nonce($_POST['custom_event_form_nonce'], 'submit_custom_event_form')) {
    require_once(ABSPATH . 'wp-admin/includes/file.php');
    // Get post's creation info, sanitize and create the custom post type
    $title = sanitize_text_field($_POST['title']);
    $description = sanitize_textarea_field($_POST['description']);
    $post_type = sanitize_text_field($_POST['post-type']);
    $uuid = sanitize_text_field($_POST['uuid']);
    $store_id = sanitize_text_field($_POST['store_id']);
    $new_post = array(
        'post_type' => $post_type,
        'post_title' => $title,
        'post_content' => $description,
        'post_status' => 'draft',
    );
    if (isset($_POST['edit_mode']) && $_POST['edit_mode'] === "1" && isset($_POST['post_id'])) {
        $post_id = sanitize_text_field($_POST['post_id']);
        $new_post['ID'] = $post_id;
        $new_post['post_status'] = 'publish';
        wp_update_post($new_post);
    } else {
        $post_id = wp_insert_post($new_post);
    }
    // Add post featured image
    if (isset($_FILES['logo'])) :
        // Get the uploaded file data
        $uploaded_file = $_FILES['logo'];
        // Handle the file upload
        $upload_overrides = array('test_form' => false);
        $movefile = wp_handle_upload($uploaded_file, $upload_overrides);
        if ($movefile && !isset($movefile['error'])) {
            // The file has been uploaded successfully, set it as the post thumbnail
            $attachment_id = wp_insert_attachment(array(
                'guid' => $movefile['url'],
                'post_mime_type' => $movefile['type'],
                'post_title' => preg_replace('/\.[^.]+$/', '', $uploaded_file['name']),
                'post_content' => '',
                'post_status' => 'inherit'
            ), $movefile['file']);
            set_post_thumbnail($post_id, $attachment_id);
        } else {
            // Handle the error case
            $error_msg = $movefile['error'];
        }
    endif;
    // Set the taxonomy for the post
    $taxonomy = sanitize_text_field($_POST['taxonomy']);
    if (isset($_POST['cat']) && !empty($_POST['cat'])) {
        $selected_categories = $_POST['cat'];
        // Set the taxonomy for the post
        $selected_categories = array(intval($_POST['cat']));
        $result = wp_set_post_terms($post_id, $selected_categories, $taxonomy);
    }
    // Get and sanitize form data
    if (isset($_POST['address']) && !empty($_POST['address'])) {
        $address = sanitize_text_field($_POST['address']);
    }
    if (isset($_POST['date']) && !empty($_POST['date'])) {
        $date = sanitize_text_field($_POST['date']);
    }
    if (isset($_POST['time']) && !empty($_POST['time'])) {
        $time = sanitize_text_field($_POST['time']);
    }
    if (isset($_POST['coordinates']) && !empty($_POST['coordinates'])) {
        $coordinates = sanitize_text_field($_POST['coordinates']);
    }
    if (isset($_POST['facebook_url']) && !empty($_POST['facebook_url'])) {
        $facebook_url = sanitize_text_field($_POST['facebook_url']);
    }

    if (isset($_POST['emails']) && !empty($_POST['emails'])) {
        $emails = array();
        foreach ($_POST['emails'] as $email) {
            $emails[] = array(
                'email' => sanitize_email($email)
            );
        }
    }
    if (isset($_POST['tels']) && !empty($_POST['tels'])) {
        $tels = array();
        foreach ($_POST['tels'] as $tel) {
            $tels[] = array(
                'tel' => sanitize_text_field($tel)
            );
        }
    }
    if (isset($_FILES['gallery'])) {
        $files = $_FILES['gallery'];
        $upload_overrides = array('test_form' => false);
        $attachment_ids = array();
        foreach ($files['name'] as $key => $value) {
            if ($files['name'][$key]) {
                $file = array(
                    'name'     => $files['name'][$key],
                    'type'     => $files['type'][$key],
                    'tmp_name' => $files['tmp_name'][$key],
                    'error'    => $files['error'][$key],
                    'size'     => $files['size'][$key]
                );
                $movefile = wp_handle_upload($file, $upload_overrides);
                if ($movefile && !isset($movefile['error'])) {
                    $attachment_id = wp_insert_attachment(
                        array(
                            'post_mime_type' => $movefile['type'],
                            'post_title' => $movefile['file'],
                            'post_content' => '',
                            'post_status' => 'inherit'
                        ),
                        $movefile['file'],
                        $post_id
                    );
                    if (!is_wp_error($attachment_id)) {
                        $attachment_ids[] = $attachment_id;
                    }
                }
            }
        }
    }
    // Save the ACF fields as post meta data
    if ($address) {
        update_field('address', $address, $post_id);
    }
    if ($date) {
        update_field('date', $date, $post_id);
    }
    if ($time) {
        update_field('time', $time, $post_id);
    }
    if ($price) {
        update_field('average_price', $price, $post_id);
    }
    if ($attachment_ids) {
        update_field('gallery', $attachment_ids, $post_id);
    }
    if ($coordinates) {
        update_field('coordinates', $coordinates, $post_id);
    }
    if ($emails) {
        update_field('emails', $emails, $post_id);
    }
    if ($tels) {
        update_field('tels', $tels, $post_id);
    }
    if ($facebook_url) {
        update_field('facebook_url', $facebook_url, $post_id);
    }
    update_field('user_id', $uuid, $post_id);
    update_field('store_id', $store_id, $post_id);
    if (isset($_POST['edit_mode']) && $_POST['edit_mode'] === "1" && isset($_POST['post_id'])) {
        if ($post_id) {
            // Set success message as transient
            set_transient('custom_hotel_form_success', 'Η καταχώρηση ανανεώθηκε, σας ευχαριστούμε', 5);
        } else {
            // Set error message as transient
            set_transient('custom_hotel_form_error', 'Προέκυψε κάποιο σφάλμα, παρακαλούμε δοκιμάστε ξανά', 5);
        }
    } else {
        if ($post_id) {
            // Set success message as transient
            set_transient('custom_hotel_form_success', 'Η καταχώρηση σας είναι προς έγκριση, σας ευχαριστούμε', 5);
        } else {
            // Set error message as transient
            set_transient('custom_hotel_form_error', 'Προέκυψε κάποιο σφάλμα, παρακαλούμε δοκιμάστε ξανά', 5);
        }
    }
    // Redirect to the same page
    wp_redirect('/logariasmos/kataxorisi-ekdilosis/');
    exit;
}
