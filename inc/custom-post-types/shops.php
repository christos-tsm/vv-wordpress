<?php
// Custom Post Type
function create_shops_post_type() {
    register_post_type(
        'shops',
        array(
            'labels' => array(
                'name' => __('Shops'),
                'singular_name' => __('Shop')
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'shops'),
            'show_in_rest' => false,
            'menu_icon'   => 'dashicons-products',
            'menu_position' => 3,
            'supports' => array('thumbnail', 'title', 'revisions', 'editor')
        )
    );
}
// Hooking up our function to theme setup
add_action('init', 'create_shops_post_type');

//Taxonomy
add_action('init', 'create_shops_categories_hierarchical_taxonomy', 20);

function create_shops_categories_hierarchical_taxonomy() {

    // Add new taxonomy, make it hierarchical like categories
    $labels = array(
        'name' => _x('Shops Categories', 'taxonomy general name'),
        'singular_name' => _x('Shop Category', 'taxonomy singular name'),
        'search_items' =>  __('Search Shop Categories'),
        'all_items' => __('All Shop Categories'),
        'parent_item' => __('Parent Shop Category'),
        'parent_item_colon' => __('Parent Shop Category:'),
        'edit_item' => __('Edit Shop Category'),
        'update_item' => __('Update Shop Category'),
        'add_new_item' => __('Add New Shop Category'),
        'new_item_name' => __('New Shop Category Name'),
        'menu_name' => __('Shop Categories'),
    );

    // Now register the taxonomy
    register_taxonomy('shop-categories', array('shops'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'shop-categories'),
    ));
}
