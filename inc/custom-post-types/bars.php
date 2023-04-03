<?php
// Custom Post Type
function create_bars_post_type() {
    register_post_type(
        'bars',
        array(
            'labels' => array(
                'name' => __('Bars'),
                'singular_name' => __('Bar')
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'bars'),
            'show_in_rest' => false,
            'menu_icon'   => 'dashicons-beer',
            'supports' => array('thumbnail', 'title', 'revisions', 'editor')
        )
    );
}
// Hooking up our function to theme setup
add_action('init', 'create_bars_post_type');

//Taxonomy
add_action('init', 'create_bars_categories_hierarchical_taxonomy', 0);

function create_bars_categories_hierarchical_taxonomy() {

    // Add new taxonomy, make it hierarchical like categories
    $labels = array(
        'name' => _x('Bar Categories', 'taxonomy general name'),
        'singular_name' => _x('Bar Category', 'taxonomy singular name'),
        'search_items' =>  __('Search Bar Categories'),
        'all_items' => __('All Bar Categories'),
        'parent_item' => __('Parent Bar Category'),
        'parent_item_colon' => __('Parent Bar Category:'),
        'edit_item' => __('Edit Bar Category'),
        'update_item' => __('Update Bar Category'),
        'add_new_item' => __('Add New Bar Category'),
        'new_item_name' => __('New Bar Category Name'),
        'menu_name' => __('Bar Categories'),
    );

    // Now register the taxonomy
    register_taxonomy('bar-categories', array('bars'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'bar-categories'),
    ));
}
