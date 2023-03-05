<?php

/**
 * Template Name: Update Account
 */
get_header();
if (!is_user_logged_in()) {
    wp_redirect(pll_home_url());
    exit;
}
$current_user = wp_get_current_user();
?>
<main class="site-main site-main--account">
    <section class="dashboard__container container container--medium">
        <?php get_template_part('template-parts/account/account-menu'); ?>
        <main class="dashboard__content">
            <h1 class="section-title"><?php pll_e('Ενημέρωση στοιχείων') ?></h1>
            <form class="form form--fluid" id="update-user-details-form" method="POST" action="<?= esc_url(admin_url('admin-post.php')); ?>">
                <?php wp_nonce_field('update_user_details', 'update_user_details_nonce'); ?>
                <input type="hidden" name="action" value="update_user_details">
                <input type="hidden" name="curlang" value="<?= pll_current_language(); ?>">
                <div class="form-row form-row--col">
                    <label for="first_name">First Name*</label>
                    <input type="text" name="first_name" id="first_name" class="input" value="<?php echo esc_attr($current_user->first_name); ?>">
                    <span class="message message--error text--left" id="first_name_error"></span>
                </div>
                <div class="form-row form-row--col">
                    <label for="last_name">Last Name*</label>
                    <input type="text" name="last_name" id="last_name" class="input" value="<?php echo esc_attr($current_user->last_name); ?>">
                    <span class="message message--error text--left" id="last_name_error"></span>

                </div>
                <div class="form-row form-row--col">
                    <label for="email">Email Address*</label>
                    <input type="email" name="user_email" id="user_email" class="input" value="<?php echo esc_attr($current_user->user_email); ?>">
                    <span class="message message--error text--left" id="email_error"></span>
                </div>
                <div class="form-row form-row--submit">
                    <!-- <button id="update-user-details-form-submit" class="input btn pointer" type="submit">Ενημέρωση</button> -->
                </div>
            </form>
            <?php if (get_transient('update_user_details_message')) : ?>
                <?php $message =  get_transient('update_user_details_message'); ?>
                <div class="message message--success"><?= esc_html__($message); ?></div>
                <?php delete_transient('update_user_details_message'); ?>
            <?php endif; ?>
            <?php if (get_transient('update_user_details_error')) : ?>
                <?php $message =  get_transient('update_user_details_error'); ?>
                <div class="message message--error"><?= esc_html__($message); ?></div>
                <?php delete_transient('update_user_details_error'); ?>
            <?php endif; ?>
        </main>
    </section>
</main>
<?php get_footer(); ?>