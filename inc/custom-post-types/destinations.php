<?php
// Custom Post Type
function create_destinations_post_type() {
    register_post_type(
        'destinations',
        array(
            'labels' => array(
                'name' => __('Destinations'),
                'singular_name' => __('Destination')
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'destinations'),
            'show_in_rest' => false,
            'menu_icon'   => 'dashicons-location',
            'menu_position' => 3,
            'supports' => array('thumbnail', 'title', 'revisions', 'editor')
        )
    );
}
// Hooking up our function to theme setup
add_action('init', 'create_destinations_post_type');

//Taxonomy
add_action('init', 'create_destinations_categories_hierarchical_taxonomy', 0);

function create_destinations_categories_hierarchical_taxonomy() {

    // Add new taxonomy, make it hierarchical like categories
    $labels = array(
        'name' => _x('Destination Categories', 'taxonomy general name'),
        'singular_name' => _x('Destination Category', 'taxonomy singular name'),
        'search_items' =>  __('Search Destination Categories'),
        'all_items' => __('All Destination Categories'),
        'parent_item' => __('Parent Destination Category'),
        'parent_item_colon' => __('Parent Destination Category:'),
        'edit_item' => __('Edit Destination Category'),
        'update_item' => __('Update Destination Category'),
        'add_new_item' => __('Add New Destination Category'),
        'new_item_name' => __('New Destination Category Name'),
        'menu_name' => __('Destination Categories'),
    );

    // Now register the taxonomy
    register_taxonomy('destination-categories', array('destinations'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'destination-categories'),
    ));
}
