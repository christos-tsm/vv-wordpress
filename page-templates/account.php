<?php

/**
 * Template Name: Account
 */
get_header();
?>
<?php if (!is_user_logged_in()) : ?>
    <main class="site-main site-main--auth">
        <section class="container container--medium section--account-forms">
            <div class="tabs">
                <h3 class="tab-header tab-header--active cta" data-target="form#login"><span><?php _e('Σύνδεση'); ?></span></h3>
                <h3 class="tab-header cta" data-target="form#register"><span><?php _e('Εγγραφή'); ?></span></h3>
            </div>
            <div class="forms">
                <?php get_template_part('template-parts/account/login-form'); ?>
                <?php get_template_part('template-parts/account/register-form'); ?>
            </div>
        </section>
    </main>
<?php else : ?>
    <main class="site-main site-main--account">
        <?php get_template_part('template-parts/account/dashboard'); ?>
    </main>
<?php endif; ?>
<?php get_footer(); ?>