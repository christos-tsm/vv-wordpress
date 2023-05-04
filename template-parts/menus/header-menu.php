<?php
// Get the ID of the current page
$current_page_id = get_the_ID();
// Check if the current page is post ID 48 or a child of that page
if (is_user_logged_in() && $current_page_id == pll_get_post(48) || (get_post_ancestors($current_page_id) && in_array(pll_get_post(48), get_post_ancestors($current_page_id)))) {
    // Show the first menu
    wp_nav_menu(array(
        'theme_location' => "dashboard-account-menu",
        "menu" => "primary-menu", // (int|string|WP_Term) Desired menu. Accepts a menu ID, slug, name, or object.
        "menu_class" => "site-header__categories container container--medium", // (string) CSS class to use for the ul element which forms the menu. Default "menu".
        "container" => "nav", // (string) Whether to wrap the ul, and what to wrap it with. Default "div".
        "container_class" => "site-header__menu", // (string) Class that is applied to the container. Default "menu-{menu slug}-container".
        "add_li_class" => "site-header__categories-item"
    ));
} else {
    // Show the second menu
    wp_nav_menu(array(
        "theme_location" => "primary-menu",
        "menu" => "primary-menu", // (int|string|WP_Term) Desired menu. Accepts a menu ID, slug, name, or object.
        "menu_class" => "site-header__categories container container--medium", // (string) CSS class to use for the ul element which forms the menu. Default "menu".
        "container" => "nav", // (string) Whether to wrap the ul, and what to wrap it with. Default "div".
        "container_class" => "site-header__menu", // (string) Class that is applied to the container. Default "menu-{menu slug}-container".
        "add_li_class" => "site-header__categories-item"
    ));
}
