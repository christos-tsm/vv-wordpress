<?php
$current_user = wp_get_current_user();
$current_user_id = $current_user->ID;
$current_user_username = $current_user->user_login;
$current_user_email = $current_user->user_email;

$user_info = get_userdata($current_user_id);
$registered_at = date_i18n('F j, Y', strtotime($user_info->user_registered));
?>
<div class="user-details__container">
    <div class="user-details">
        <div class="user-details__info">
            <h3 class="user-details__title">
                @<?= esc_attr($current_user_username); ?>
                <?php if (in_array('administrator', (array) $current_user->roles)) : ?>
                    <span class="icon icon--small icon--verified">
                        <?= file_get_contents(get_stylesheet_directory() . '/assets/images/verified.svg'); ?>
                    </span>
                <?php endif;  ?>
            </h3>
            <h4 class="user-details__subtitle"><?= esc_attr($current_user_email); ?></h4>
            <p class="user-details__registration-date">Μέλος από: <?= esc_attr($registered_at); ?></p>
        </div>
        <?php
        wp_nav_menu(array(
            'theme_location' => "dashboard-account-menu",
            "menu" => "dashboard-account-menu", // (int|string|WP_Term) Desired menu. Accepts a menu ID, slug, name, or object.
            "menu_class" => "user-details__menu", // (string) CSS class to use for the ul element which forms the menu. Default "menu".
            "container" => "nav", // (string) Whether to wrap the ul, and what to wrap it with. Default "div".
            "container_class" => "user-details__menu-container", // (string) Class that is applied to the container. Default "menu-{menu slug}-container".
            "add_li_class" => "user-details__menu-item"
        ));
        ?>
        <a href="<?php echo wp_logout_url(home_url()); ?>" class="input btn pointer" id="logout" aria-label="Logout" title="<?php _e('Αποσύνδεση'); ?>">
            <span class="icon icon--small">
                <?= file_get_contents(get_stylesheet_directory() . '/assets/images/logout.svg'); ?>
            </span>
            <?php _e('Αποσύνδεση'); ?>
        </a>
    </div>
</div>