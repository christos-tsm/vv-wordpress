<?php
// Custom Post Type
function create_night_clubs_post_type() {
    register_post_type(
        'night-clubs',
        array(
            'labels' => array(
                'name' => __('Night Clubs'),
                'singular_name' => __('Night Club')
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'night-clubs'),
            'show_in_rest' => false,
            'menu_icon'   => 'dashicons-buddicons-tracking',
            'supports' => array('thumbnail', 'title', 'revisions', 'editor')
        )
    );
}
// Hooking up our function to theme setup
add_action('init', 'create_night_clubs_post_type');
