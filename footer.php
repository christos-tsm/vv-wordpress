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
            <?php if (have_rows('social_media', 'option')) : ?>
                <div class="social-media">
                    <?php while (have_rows('social_media', 'option')) : the_row(); ?>
                        <?php $url = get_sub_field('url'); ?>
                        <?php $icon = get_sub_field('icon'); ?>
                        <a target="_blank" rel="noreferrer" aria-label="Social media link" href="<?= esc_url($url); ?>" class="icon icon--medium"><?= file_get_contents($icon['url']); ?></a>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <p class="copyrights">&copy; Volos Voyage 2023 - All rights reserved</p>
</footer>
<?php wp_footer(); ?>
</body>

</html>