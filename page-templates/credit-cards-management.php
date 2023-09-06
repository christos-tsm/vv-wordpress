<?php

/**
 * Template Name: Credit Cards Management
 */
get_header();
?>
<main class="site-main site-main--account">
    <?php if (is_user_logged_in()) : ?>
        <section class="dashboard__container container container--medium">
            <?php get_template_part('template-parts/account/user-details'); ?>
            <div class="dashboard__content">
                <div class="membership membership__info">
                    <?= do_shortcode('[rcp_update_card]'); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
</main>
<?php get_footer(); ?>