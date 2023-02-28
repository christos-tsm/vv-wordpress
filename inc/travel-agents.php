<?php
// Custom Post Type
function create_travel_agents_post_type() {
    register_post_type(
        'travel-agents',
        array(
            'labels' => array(
                'name' => __('Travel Agents'),
                'singular_name' => __('Travel Agent')
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'travel-agents'),
            'show_in_rest' => false,
            'menu_icon'   => 'dashicons-tickets-alt',
        )
    );
}
// Hooking up our function to theme setup
add_action('init', 'create_travel_agents_post_type');

//Taxonomy
add_action('init', 'create_travel_agents_categories_hierarchical_taxonomy', 0);

//create a custom taxonomy name it events_categories for your posts  
function create_travel_agents_categories_hierarchical_taxonomy() {

    // Add new taxonomy, make it hierarchical like categories
    $labels = array(
        'name' => _x('Travel Agent Categories', 'taxonomy general name'),
        'singular_name' => _x('Travel Agent Category', 'taxonomy singular name'),
        'search_items' =>  __('Search Travel Agent Categories'),
        'all_items' => __('All Travel Agent Categories'),
        'parent_item' => __('Parent Travel Agent Category'),
        'parent_item_colon' => __('Parent Travel Agent Category:'),
        'edit_item' => __('Edit Travel Agent Category'),
        'update_item' => __('Update Travel Agent Category'),
        'add_new_item' => __('Add New Travel Agent Category'),
        'new_item_name' => __('New Travel Agent Category Name'),
        'menu_name' => __('Travel Agent Categories'),
    );

    // Now register the taxonomy
    register_taxonomy('travel-agent-categories', array('travel-agents'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'travel-agent-categories'),
    ));
}
