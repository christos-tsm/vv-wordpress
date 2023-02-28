<?php
// Custom Post Type
function create_coffee_house_post_type() {
    register_post_type(
        'coffee-houses',
        array(
            'labels' => array(
                'name' => __('Coffee Houses'),
                'singular_name' => __('Coffee House')
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'coffee-houses'),
            'show_in_rest' => false,
            'menu_icon'   => 'dashicons-store',
            'menu_position' => 2
        )
    );
}
// Hooking up our function to theme setup
add_action('init', 'create_coffee_house_post_type');

//Taxonomy
add_action('init', 'create_coffee_houses_categories_hierarchical_taxonomy', 0);

function create_coffee_houses_categories_hierarchical_taxonomy() {

    // Add new taxonomy, make it hierarchical like categories
    $labels = array(
        'name' => _x('Coffee House Categories', 'taxonomy general name'),
        'singular_name' => _x('Coffee House Category', 'taxonomy singular name'),
        'search_items' =>  __('Search Coffee House Categories'),
        'all_items' => __('All Coffee House Categories'),
        'parent_item' => __('Parent Coffee House Category'),
        'parent_item_colon' => __('Parent Coffee House Category:'),
        'edit_item' => __('Edit Coffee House Category'),
        'update_item' => __('Update Coffee House Category'),
        'add_new_item' => __('Add New Coffee House Category'),
        'new_item_name' => __('New Coffee House Category Name'),
        'menu_name' => __('Coffee House Categories'),
    );

    // Now register the taxonomy
    register_taxonomy('coffee-houses-categories', array('coffee-houses'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'coffee-houses-categories'),
    ));
}
