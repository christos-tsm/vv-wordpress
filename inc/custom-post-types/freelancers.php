<?php
// Custom Post Type
function create_freelancers_post_type() {
    register_post_type(
        'freelancers',
        array(
            'labels' => array(
                'name' => __('Freelancers'),
                'singular_name' => __('Freelancer')
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'freelancers'),
            'show_in_rest' => false,
            'menu_icon'   => 'dashicons-admin-users',
            'supports' => array('thumbnail', 'title', 'revisions', 'editor')
        )
    );
}
// Hooking up our function to theme setup
add_action('init', 'create_freelancers_post_type');

//Taxonomy
add_action('init', 'create_freelancers_categories_hierarchical_taxonomy', 0);

function create_freelancers_categories_hierarchical_taxonomy() {

    // Add new taxonomy, make it hierarchical like categories
    $labels = array(
        'name' => _x('Freelancers Categories', 'taxonomy general name'),
        'singular_name' => _x('Freelancer Category', 'taxonomy singular name'),
        'search_items' =>  __('Search Freelancer Categories'),
        'all_items' => __('All Freelancer Categories'),
        'parent_item' => __('Parent Freelancer Category'),
        'parent_item_colon' => __('Parent Freelancer Category:'),
        'edit_item' => __('Edit Freelancer Category'),
        'update_item' => __('Update Freelancer Category'),
        'add_new_item' => __('Add New Freelancer Category'),
        'new_item_name' => __('New Freelancer Category Name'),
        'menu_name' => __('Freelancer Categories'),
    );

    // Now register the taxonomy
    register_taxonomy('freelancer-categories', array('freelancers'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'freelancer-categories'),
    ));
}
