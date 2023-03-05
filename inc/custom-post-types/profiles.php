<?php
// Custom Post Type
function create_profiles_post_type() {
    register_post_type(
        'profiles',
        array(
            'labels' => array(
                'name' => __('Profiles'),
                'singular_name' => __('Profile')
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'profiles'),
            'show_in_rest' => false,
            'menu_icon'   => 'dashicons-businessperson',
            'menu_position' => 3,
            'supports' => array('title', 'revisions', 'editor')
        )
    );
}
// Hooking up our function to theme setup
add_action('init', 'create_profiles_post_type');

//Taxonomy
add_action('init', 'create_profiles_categories_hierarchical_taxonomy', 0);

function create_profiles_categories_hierarchical_taxonomy() {

    // Add new taxonomy, make it hierarchical like categories
    $labels = array(
        'name' => _x('Profile Categories', 'taxonomy general name'),
        'singular_name' => _x('Profile Category', 'taxonomy singular name'),
        'search_items' =>  __('Search Profile Categories'),
        'all_items' => __('All Profile Categories'),
        'parent_item' => __('Parent Profile Category'),
        'parent_item_colon' => __('Parent Profile Category:'),
        'edit_item' => __('Edit Profile Category'),
        'update_item' => __('Update Profile Category'),
        'add_new_item' => __('Add New Profile Category'),
        'new_item_name' => __('New Profile Category Name'),
        'menu_name' => __('Profile Categories'),
    );

    // Now register the taxonomy
    register_taxonomy('profile-categories', array('profiles'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'profile-categories'),
    ));
}
