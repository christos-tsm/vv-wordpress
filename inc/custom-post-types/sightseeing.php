<?php
// Custom Post Type
function create_sightseeing_post_type() {
    register_post_type(
        'sightseeing',
        array(
            'labels' => array(
                'name' => __('Sightseeing'),
                'singular_name' => __('Sightseeing')
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'sightseeing'),
            'show_in_rest' => false,
            'menu_icon'   => 'dashicons-location-alt',
            'menu_position' => 3,
            'supports' => array('thumbnail', 'title', 'revisions', 'editor')
        )
    );
}
// Hooking up our function to theme setup
add_action('init', 'create_sightseeing_post_type');

//Taxonomy
add_action('init', 'create_sightseeing_categories_hierarchical_taxonomy', 0);

function create_sightseeing_categories_hierarchical_taxonomy() {

    // Add new taxonomy, make it hierarchical like categories
    $labels = array(
        'name' => _x('Sightseeing Categories', 'taxonomy general name'),
        'singular_name' => _x('Sightseeing Category', 'taxonomy singular name'),
        'search_items' =>  __('Search Sightseeing Categories'),
        'all_items' => __('All Sightseeing Categories'),
        'parent_item' => __('Parent Sightseeing Category'),
        'parent_item_colon' => __('Parent Sightseeing Category:'),
        'edit_item' => __('Edit Sightseeing Category'),
        'update_item' => __('Update Sightseeing Category'),
        'add_new_item' => __('Add New Sightseeing Category'),
        'new_item_name' => __('New Sightseeing Category Name'),
        'menu_name' => __('Sightseeing Categories'),
    );

    // Now register the taxonomy
    register_taxonomy('sightseeing-categories', array('ightseeing'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'sightseeing-categories'),
    ));
}
