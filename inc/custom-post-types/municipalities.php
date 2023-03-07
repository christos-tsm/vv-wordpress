<?php
// Custom Post Type
function create_municipalities_post_type() {
    register_post_type(
        'municipalities',
        array(
            'labels' => array(
                'name' => __('Municipalities'),
                'singular_name' => __('Municipality')
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'municipalities'),
            'show_in_rest' => false,
            'menu_icon'   => 'dashicons-pressthis',
            'supports' => array('title', 'revisions')
        )
    );
}
// Hooking up our function to theme setup
add_action('init', 'create_municipalities_post_type');
