<?php
// Custom Post Type
function create_museum_post_type() {
    register_post_type(
        'museums',
        array(
            'labels' => array(
                'name' => __('Museums'),
                'singular_name' => __('Restaurant')
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'museums'),
            'show_in_rest' => false,
            'menu_icon'   => 'dashicons-bank',
            'menu_position' => 4
        )
    );
}
// Hooking up our function to theme setup
add_action('init', 'create_museum_post_type');

//Taxonomy
add_action('init', 'create_museums_categories_hierarchical_taxonomy', 0);

function create_museums_categories_hierarchical_taxonomy() {

    // Add new taxonomy, make it hierarchical like categories
    $labels = array(
        'name' => _x('Museum Categories', 'taxonomy general name'),
        'singular_name' => _x('Museum Category', 'taxonomy singular name'),
        'search_items' =>  __('Search Museum Categories'),
        'all_items' => __('All Museum Categories'),
        'parent_item' => __('Parent Museum Category'),
        'parent_item_colon' => __('Parent Museum Category:'),
        'edit_item' => __('Edit Museum Category'),
        'update_item' => __('Update Museum Category'),
        'add_new_item' => __('Add New Museum Category'),
        'new_item_name' => __('New Museum Category Name'),
        'menu_name' => __('Museum Categories'),
    );

    // Now register the taxonomy
    register_taxonomy('museum-categories', array('museums'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'museum-categories'),
    ));
}
