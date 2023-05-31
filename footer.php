<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Volos_Voyage
 */

?>

<footer class="site-footer">
    <div class="site-footer__content container container--medium">
        <div class="site-footer__col">
            <?php $footer_logo = get_field('footer_logo', 'option'); ?>
            <a class="site-footer__logo" aria-label="Link to homepage" class="icon" href="<?= pll_home_url(); ?>">
                <img src="<?= esc_url($footer_logo['url']) ?>" alt="<?php the_title(); ?>">
            </a>
        </div>
        <div class="site-footer__col site-footer__menu">
            <h6 class="site-footer__header"><?php pll_e('Μενού'); ?></h6>
            <?php
            wp_nav_menu(array(
                'theme_location' => "footer-menu",
                'container' => "nav",
            ));
            ?>
        </div>
        <div class="site-footer__col site-footer__menu">
            <h6 class="site-footer__header"><?php pll_e('Χρήσιμα'); ?></h6>
            <?php
            wp_nav_menu(array(
                'theme_location' => "footer-useful-menu",
                'container' => "nav",
            ));
            ?>
        </div>
        <div class="site-footer__col site-footer__social">
            <h6 class="site-footer__header"><?php pll_e('Social Media'); ?></h6>
            <div class="social-media">
                <?php $facebook_url = get_field('facebook_url', 'option'); ?>
                <?php $instagram_url = get_field('instagram_url', 'option'); ?>
                <?php $tiktok_url = get_field('tiktok_url', 'option'); ?>
                <a target="_blank" rel="noreferrer" aria-label="Social media link" href="<?= esc_url($facebook_url); ?>" class="icon icon--medium">
                    <?= file_get_contents(get_stylesheet_directory() . '/assets/images/facebook.svg'); ?>
                </a>
                <a target="_blank" rel="noreferrer" aria-label="Social media link" href="<?= esc_url($instagram_url); ?>" class="icon icon--medium">
                    <?= file_get_contents(get_stylesheet_directory() . '/assets/images/instagram.svg'); ?>
                </a>
                <a target="_blank" rel="noreferrer" aria-label="Social media link" href="<?= esc_url($tiktok_url); ?>" class="icon icon--medium">
                    <?= file_get_contents(get_stylesheet_directory() . '/assets/images/tiktok.svg'); ?>
                </a>
            </div>
        </div>
    </div>
    <p class="copyrights">&copy; Volos Voyage 2023 - All rights reserved</p>
</footer>
<?php wp_footer(); ?>
</body>

</html>