<?php

/**
 * Template Name: Account
 */
get_header();
?>
<main class="site-main site-main--auth">
    <?php if (!is_user_logged_in()) : ?>
        <section class="container container--medium section--account-forms">
            <div class="tabs">
                <h3 class="tab-header tab-header--active cta" data-target="form#login"><span><?php pll_e('Σύνδεση'); ?></span></h3>
                <h3 class="tab-header cta" data-target="form#register"><span><?php pll_e('Εγγραφή'); ?></span></h3>
            </div>
            <div class="forms">
                <?php get_template_part('template-parts/account/login-form'); ?>
                <?php get_template_part('template-parts/account/register-form'); ?>
            </div>
        </section>
    <?php else : ?>
        <?php get_template_part('template-parts/account/dashboard'); ?>
    <?php endif; ?>
</main>
<?php get_footer(); ?>