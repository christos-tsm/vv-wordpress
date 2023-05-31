<?php
// Get the ID of the current page
$current_page_id = get_the_ID();
if (!is_user_logged_in() || $current_page_id != pll_get_post(48) && (!get_post_ancestors($current_page_id) || !in_array(pll_get_post(48), get_post_ancestors($current_page_id)))) : ?>
    <div class="site-header__bottom">
        <div class="site-header__menu-container container container--medium">
            <a href="#!" class="site-header__burger">
                <span class="burger__container icon icon--medium">
                    <span class="icon icon--active" id="open-menu">
                        <?= file_get_contents(get_stylesheet_directory() . '/assets/images/burger.svg'); ?>
                    </span>
                    <span class="icon" id="close-menu">
                        <?= file_get_contents(get_stylesheet_directory() . '/assets/images/remove.svg'); ?>
                    </span>
                </span>
                <?php pll_e('Ανακαλύψτε'); ?>
            </a>
            <?php
            wp_nav_menu(array(
                "theme_location" => "primary-menu",
                "menu" => "primary-menu", // (int|string|WP_Term) Desired menu. Accepts a menu ID, slug, name, or object.
                "menu_class" => "site-header__categories", // (string) CSS class to use for the ul element which forms the menu. Default "menu".
                "container" => "nav", // (string) Whether to wrap the ul, and what to wrap it with. Default "div".
                "container_class" => "site-header__menu", // (string) Class that is applied to the container. Default "menu-{menu slug}-container".
                "add_li_class" => "site-header__categories-item"
            ));
            wp_nav_menu(array(
                "theme_location" => "primary-menu-extend",
                "menu" => "primary-menu-extend", // (int|string|WP_Term) Desired menu. Accepts a menu ID, slug, name, or object.
                "menu_class" => "site-header__ext-menu-links", // (string) CSS class to use for the ul element which forms the menu. Default "menu".
                "container" => "nav", // (string) Whether to wrap the ul, and what to wrap it with. Default "div".
                "container_class" => "site-header__ext-menu", // (string) Class that is applied to the container. Default "menu-{menu slug}-container".
                "add_li_class" => "site-header__ext-menu-links-item"
            ));
            ?>
        </div>
    </div>
<?php endif;  ?>