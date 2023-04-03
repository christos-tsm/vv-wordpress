<?php
// Custom Post Type
function create_restaurant_post_type() {
    register_post_type(
        'restaurants',
        array(
            'labels' => array(
                'name' => __('Restaurants'),
                'singular_name' => __('Restaurant')
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'restaurants'),
            'show_in_rest' => false,
            'menu_icon'   => 'dashicons-food',
            'menu_position' => 3,
            'supports' => array('thumbnail', 'title', 'revisions', 'editor')
        )
    );
}
// Hooking up our function to theme setup
add_action('init', 'create_restaurant_post_type');

//Taxonomy
add_action('init', 'create_restaurants_categories_hierarchical_taxonomy', 0);

function create_restaurants_categories_hierarchical_taxonomy() {

    // Add new taxonomy, make it hierarchical like categories
    $labels = array(
        'name' => _x('Restaurant Categories', 'taxonomy general name'),
        'singular_name' => _x('Restaurant Category', 'taxonomy singular name'),
        'search_items' =>  __('Search Restaurant Categories'),
        'all_items' => __('All Restaurant Categories'),
        'parent_item' => __('Parent Restaurant Category'),
        'parent_item_colon' => __('Parent Restaurant Category:'),
        'edit_item' => __('Edit Restaurant Category'),
        'update_item' => __('Update Restaurant Category'),
        'add_new_item' => __('Add New Restaurant Category'),
        'new_item_name' => __('New Restaurant Category Name'),
        'menu_name' => __('Restaurant Categories'),
    );

    // Now register the taxonomy
    register_taxonomy('restaurant-categories', array('restaurants'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'restaurant-categories'),
    ));
}
