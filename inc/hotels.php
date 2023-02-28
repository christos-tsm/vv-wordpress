<?php
// Custom Post Type
function create_hotels_post_type() {
    register_post_type(
        'hotels',
        array(
            'labels' => array(
                'name' => __('Hotels'),
                'singular_name' => __('Hotel')
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'hotels'),
            'show_in_rest' => false,
            'menu_icon'   => 'dashicons-building',
            'menu_position' => 3
        )
    );
}
// Hooking up our function to theme setup
add_action('init', 'create_hotels_post_type');

//Taxonomy
add_action('init', 'create_hotels_categories_hierarchical_taxonomy', 0);

function create_hotels_categories_hierarchical_taxonomy() {

    // Add new taxonomy, make it hierarchical like categories
    $labels = array(
        'name' => _x('Hotel Categories', 'taxonomy general name'),
        'singular_name' => _x('Hotel Category', 'taxonomy singular name'),
        'search_items' =>  __('Search Hotel Categories'),
        'all_items' => __('All Hotel Categories'),
        'parent_item' => __('Parent Hotel Category'),
        'parent_item_colon' => __('Parent Hotel Category:'),
        'edit_item' => __('Edit Hotel Category'),
        'update_item' => __('Update Hotel Category'),
        'add_new_item' => __('Add New Hotel Category'),
        'new_item_name' => __('New Hotel Category Name'),
        'menu_name' => __('Hotel Categories'),
    );

    // Now register the taxonomy
    register_taxonomy('hotel-categories', array('hotels'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'hotel-categories'),
    ));
}
