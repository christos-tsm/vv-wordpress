<?php

/**
 * Enqueue scripts and styles.
 */
function volos_voyage_scripts() {
    wp_enqueue_style('splide-styles', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css', array(), null);
    wp_enqueue_style('volos-voyage-style', get_stylesheet_uri(), array(), _S_VERSION);
    wp_enqueue_style('volos-voyage-font', 'https://fonts.googleapis.com/css2?family=Manrope:wght@200;400;500;700&display=swap', array(), null);



    wp_enqueue_script('splide-script',  'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js', array(), _S_VERSION, true);
    wp_enqueue_script('volos-voyage-core', get_template_directory_uri() . '/assets/js/core.js', array(), _S_VERSION, true);
    wp_enqueue_script('volos-voyage-logout-script',  get_template_directory_uri() . '/assets/js/logout.js', array(), _S_VERSION, true);
    wp_localize_script('volos-voyage-logout-script', 'wpApiSettings', array(
        'root' => esc_url_raw(rest_url()),
        'nonce' => wp_create_nonce('wp_rest'),
        'logout_url' => wp_logout_url(home_url()),
    ));
    if (is_page_template('page-templates/account.php')) {
        wp_enqueue_script('volos-voyage-auth-forms', get_template_directory_uri() . '/assets/js/auth-forms.js', array(), _S_VERSION, true);
        wp_localize_script('volos-voyage-auth-forms', 'wp_ajax', array('ajax_url' => admin_url('admin-ajax.php')));
    }
}
add_action('wp_enqueue_scripts', 'volos_voyage_scripts');
