<?php

/**
 * Enqueue scripts and styles.
 */
function volos_voyage_scripts()
{
    // Styles
    wp_enqueue_style('swiper-styles', 'https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css', array(), null);
    wp_enqueue_style('volos-voyage-select', get_template_directory_uri() . '/assets/css/nice-select2.css', array(), _S_VERSION);
    if (is_singular()) {
        wp_enqueue_style('volos-voyage-leaflet', get_template_directory_uri() . '/assets/css/leaflet.css', array(), _S_VERSION);
    }
    wp_enqueue_style('volos-voyage-font', 'https://fonts.googleapis.com/css2?family=Manrope:wght@200;400;500;700&display=swap', array(), null);
    wp_enqueue_style('volos-voyage-select', get_template_directory_uri() . '/assets/css/nice-select2.css.map', array(), _S_VERSION);
    if (is_page_template('page-templates/add-event.php') || is_page_template('page-templates/my-events-list.php')) {
        wp_enqueue_style('volos-voyage-default-date', get_template_directory_uri() . '/assets/css/default.date.css', array(), _S_VERSION);
    }
    wp_enqueue_style('volos-voyage-style', get_stylesheet_uri(), array(), _S_VERSION);
    remove_action('wp_body_open', 'wp_global_styles_render_svg_filters'); // Remove SVG Duotone Filters
    // Scripts
    wp_enqueue_script('volos-voyage-swiper-script',  'https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js', array(), _S_VERSION, true);
    wp_enqueue_script('volos-voyage-select', get_template_directory_uri() . '/assets/js/select.min.js', array(), _S_VERSION, true);
    wp_enqueue_script('volos-voyage-profile-search', get_template_directory_uri() . '/assets/js/profile-search.js', array(), _S_VERSION, true);
    wp_enqueue_script('volos-voyage-core', get_template_directory_uri() . '/assets/js/core.js', array(), _S_VERSION, true);
    if (is_singular()) {
        wp_enqueue_script('volos-voyage-lightboxed', get_template_directory_uri() . '/assets/js/lightboxed.js', array(), _S_VERSION, true);
        wp_enqueue_script('volos-voyage-leaflet', get_template_directory_uri() . '/assets/js/leaflet.min.js', array(), _S_VERSION, true);
        wp_enqueue_script('volos-voyage-map', get_template_directory_uri() . '/assets/js/map.js', array(), _S_VERSION, true);
        wp_enqueue_script('volos-voyage-single-cpt', get_template_directory_uri() . '/assets/js/single-cpt.js', array(), _S_VERSION, true);
        wp_enqueue_script('volos-voyage-report-form', get_template_directory_uri() . '/assets/js/report-store.js', array(), _S_VERSION, true);
        wp_localize_script('volos-voyage-report-form', 'report_ajax_object', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce'    => wp_create_nonce('report_nonce'),
        ));
    }
    if (is_page_template('page-templates/update-account.php')) {
        wp_enqueue_script('volos-voyage-update-form', get_template_directory_uri() . '/assets/js/user-update-details.js', array(), _S_VERSION, true);
        wp_localize_script('volos-voyage-update-form', 'wp_ajax', array('ajax_url' => admin_url('admin-ajax.php')));
    }
    if (is_page_template('page-templates/business-profile.php') || is_page_template('page-templates/my-business-profiles-list.php')) {
        wp_enqueue_script('volos-voyage-business-profile-form', get_template_directory_uri() . '/assets/js/business-profile-form.js', array(), _S_VERSION, true);
        wp_localize_script('volos-voyage-business-profile-form', 'wp_ajax', array('ajax_url' => admin_url('admin-ajax.php')));
    }
    if (is_post_type_archive()) {
        wp_enqueue_script('volos-voyage-archive-filters', get_template_directory_uri() . '/assets/js/archive-filters.js', array(), _S_VERSION, true);
        wp_localize_script('volos-voyage-archive-filters', 'wp_ajax', array('ajax_url' => admin_url('admin-ajax.php')));
    }
    if (is_page_template('page-templates/account.php')) {
        wp_enqueue_script('volos-voyage-auth-forms', get_template_directory_uri() . '/assets/js/auth-forms.js', array(), _S_VERSION, true);
        wp_localize_script('volos-voyage-auth-forms', 'wp_ajax', array('ajax_url' => admin_url('admin-ajax.php')));
    }
    if (is_page_template('page-templates/add-store.php') || is_page_template('page-templates/my-stores-list.php')) {
        wp_enqueue_script('volos-voyage-add-store', get_template_directory_uri() . '/assets/js/add-store.js', array(), _S_VERSION, true);
    }
    if (is_page_template('page-templates/my-stores-list.php')) {
        wp_enqueue_script('volos-voyage-delete-store', get_template_directory_uri() . '/assets/js/delete-store.js', array(), _S_VERSION, true);
        wp_localize_script('volos-voyage-delete-store', 'wp_ajax', array('ajax_url' => admin_url('admin-ajax.php')));
    }
    if (is_page_template('page-templates/add-event.php') || is_page_template('page-templates/my-events-list.php')) {
        wp_enqueue_script('volos-voyage-date-picker', get_template_directory_uri() . '/assets/js/picker.date.js', array(), _S_VERSION, true);
        wp_enqueue_script('volos-voyage-date-picker-languages', get_template_directory_uri() . '/assets/js/picker.lang.js', array(), _S_VERSION, true);
        wp_enqueue_script('volos-voyage-add-event', get_template_directory_uri() . '/assets/js/add-event.js', array(), _S_VERSION, true);
        wp_enqueue_script('volos-voyage-add-store', get_template_directory_uri() . '/assets/js/add-store.js', array(), _S_VERSION, true);
        wp_enqueue_script('volos-voyage-delete-store', get_template_directory_uri() . '/assets/js/delete-store.js', array(), _S_VERSION, true);
        wp_localize_script('volos-voyage-delete-store', 'wp_ajax', array('ajax_url' => admin_url('admin-ajax.php')));
    }
}
add_action('wp_enqueue_scripts', 'volos_voyage_scripts', 9999);
