<?php
if (isset($_POST['action']) && $_POST['action'] === "submit_custom_store_form" && wp_verify_nonce($_POST['custom_store_form_nonce'], 'submit_custom_store_form')) {
    require_once(ABSPATH . 'wp-admin/includes/file.php');
    // Get post's creation info, sanitize and create the custom post type
    $title = sanitize_text_field($_POST['title']);
    $description = sanitize_textarea_field($_POST['description']);
    $post_type = sanitize_text_field($_POST['post-type']);
    $uuid = sanitize_text_field($_POST['uuid']);
    $new_post = array(
        'post_type' => $post_type,
        'post_title' => $title,
        'post_content' => $description,
        'post_status' => 'draft',
    );
    $post_id = wp_insert_post($new_post);
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
    if (isset($_POST['distance_from_city_center']) && !empty($_POST['distance_from_city_center'])) {
        $distance = sanitize_text_field($_POST['distance_from_city_center']);
    }
    if (isset($_POST['average_price']) && !empty($_POST['average_price'])) {
        $price = sanitize_text_field($_POST['average_price']);
    }
    if (isset($_POST['coordinates']) && !empty($_POST['coordinates'])) {
        $coordinates = sanitize_text_field($_POST['coordinates']);
    }
    if (isset($_POST['website']) && !empty($_POST['website'])) {
        $website = sanitize_text_field($_POST['website']);
    }
    if (isset($_POST['facebook_url']) && !empty($_POST['facebook_url'])) {
        $facebook_url = sanitize_text_field($_POST['facebook_url']);
    }
    if (isset($_POST['instagram_url']) && !empty($_POST['instagram_url'])) {
        $instagram_url = sanitize_text_field($_POST['instagram_url']);
    }
    if (isset($_POST['tiktok_url']) && !empty($_POST['tiktok_url'])) {
        $tiktok_url = sanitize_text_field($_POST['tiktok_url']);
    }
    if (isset($_POST['tripadvisor_url']) && !empty($_POST['tripadvisor_url'])) {
        $tripadvisor_url = sanitize_text_field($_POST['tripadvisor_url']);
    }
    if (isset($_POST['booking_url']) && !empty($_POST['booking_url'])) {
        $booking_url = sanitize_text_field($_POST['booking_url']);
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
    if ($distance) {
        update_field('distance_from_city_center', $distance, $post_id);
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
    if ($website) {
        update_field('website', $website, $post_id);
    }
    if ($facebook_url) {
        update_field('facebook_url', $facebook_url, $post_id);
    }
    if ($instagram_url) {
        update_field('instagram_url', $instagram_url, $post_id);
    }
    if ($tiktok_url) {
        update_field('tiktok_url', $tiktok_url, $post_id);
    }
    if ($tripadvisor_url) {
        update_field('tripadvisor_url', $tripadvisor_url, $post_id);
    }
    if ($booking_url) {
        update_field('booking_url', $booking_url, $post_id);
    }

    update_field('user_id', $uuid, $post_id);
    if ($post_id) {
        // Set success message as transient
        set_transient('custom_hotel_form_success', 'Η καταχώρηση σας είναι προς έγκριση, σας ευχαριστούμε', 5);
    } else {
        // Set error message as transient
        set_transient('custom_hotel_form_error', 'Προέκυψε κάποιο σφάλμα, παρακαλούμε δοκιμάστε ξανά', 5);
    }
    // Redirect to the same page
    wp_redirect('/logariasmos/katachorisi-epicheirisis/');
    exit;
}
