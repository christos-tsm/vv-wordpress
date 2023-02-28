<?php
// Custom Post Type
function create_events_post_type() {
    register_post_type(
        'events',
        array(
            'labels' => array(
                'name' => __('Events'),
                'singular_name' => __('Event')
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'events'),
            'show_in_rest' => false,
            'menu_icon'   => 'dashicons-groups',
        )
    );
}
// Hooking up our function to theme setup
add_action('init', 'create_events_post_type');

//Taxonomy
add_action('init', 'create_events_categories_hierarchical_taxonomy', 0);

function create_events_categories_hierarchical_taxonomy() {

    // Add new taxonomy, make it hierarchical like categories
    $labels = array(
        'name' => _x('Event Categories', 'taxonomy general name'),
        'singular_name' => _x('Event Category', 'taxonomy singular name'),
        'search_items' =>  __('Search Event Categories'),
        'all_items' => __('All Event Categories'),
        'parent_item' => __('Parent Event Category'),
        'parent_item_colon' => __('Parent Event Category:'),
        'edit_item' => __('Edit Event Category'),
        'update_item' => __('Update Event Category'),
        'add_new_item' => __('Add New Event Category'),
        'new_item_name' => __('New Event Category Name'),
        'menu_name' => __('Event Categories'),
    );

    // Now register the taxonomy
    register_taxonomy('event-categories', array('events'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'event-categories'),
    ));
}
