<?php

/**
 * Template Name: My Subscription
 */
get_header();
$user_id = get_current_user_id(); // Substitute with the ID of the user
$all_meta_for_user = get_user_meta($user_id);
$is_membership_active = rcp_is_active($user_id);
?>
<main class="site-main site-main--account">
    <?php if (is_user_logged_in()) : ?>
        <section class="dashboard__container container container--medium">
            <?php get_template_part('template-parts/account/user-details'); ?>
            <div class="dashboard__content">
                <div class="membership membership__info">
                    <h1 class="section-title section-title--dashboard"><?php _e('Πληροφορίες συνδρομής', 'volos-voyage'); ?> <span class="divider"></span></h1>
                    <?= do_shortcode('[subscription_details]'); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
</main>
<?php get_footer(); ?>