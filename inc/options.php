<?php
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title'    => 'General Settings',
        'menu_title'    => 'General Settings',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'Brand',
        'menu_title'    => 'Brand',
        'parent_slug'   => 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'Navigation Settings',
        'menu_title'    => 'Navigation Settings',
        'parent_slug'   => 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'Ads Settings',
        'menu_title'    => 'Ads Settings',
        'parent_slug'   => 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'Municipalities',
        'menu_title'    => 'Municipalities',
        'parent_slug'   => 'theme-general-settings',
    ));
}
