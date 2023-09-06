<?php $current_user = wp_get_current_user(); ?>
<section class="dashboard__container container container--medium">
    <?php get_template_part('template-parts/account/user-details'); ?>
    <div class="dashboard__content">
        <h1 class="section-title section-title--dashboard"><?php _e('Ενημέρωση στοιχείων') ?> <span class="divider"></span></h1>
        <form class="form form--fluid" id="update-user-details-form" method="POST" action="<?= esc_url(admin_url('admin-post.php')); ?>">
            <?php wp_nonce_field('update_user_details', 'update_user_details_nonce'); ?>
            <input type="hidden" name="action" value="update_user_details">
            <input type="hidden" name="curlang" value="<?= get_bloginfo("language") ?>">
            <div class="form-row">
                <div class="form-row form-row--col">
                    <label for="first_name"><?php _e('Όνομα') ?>*</label>
                    <input type="text" name="first_name" id="first_name" class="input" value="<?php echo esc_attr($current_user->first_name); ?>">
                    <span class="message message--error text--left" id="first_name_error"></span>
                </div>
                <div class="form-row form-row--col">
                    <label for="last_name"><?php _e('Επίθετο') ?>*</label>
                    <input type="text" name="last_name" id="last_name" class="input" value="<?php echo esc_attr($current_user->last_name); ?>">
                    <span class="message message--error text--left" id="last_name_error"></span>
                </div>
            </div>
            <div class="form-row form-row--col">
                <label for="email">Email*</label>
                <input type="email" name="user_email" id="user_email" class="input" value="<?php echo esc_attr($current_user->user_email); ?>">
                <span class="message message--error text--left" id="email_error"></span>
            </div>
            <div class="form-row form-row--submit"></div>
            <p class="message--update"></p>
        </form>
        <div class="change-password__container">
            <a href="#!" class="input btn pointer" id="btn-change-password"><?php _e('Αλλαγή κωδικού'); ?></a>
            <form class="form form--fluid" id="update-user-password-form" method="POST" action="<?= esc_url(admin_url('admin-post.php')); ?>">
                <?php wp_nonce_field('update_user_password', 'update_user_password_nonce'); ?>
                <input type="hidden" name="action" value="update_user_password">
                <div class="form-row form-row--col">
                    <label for="old_password"><?php _e('Τρέχον κωδικός'); ?>*</label>
                    <input type="password" name="old_password" id="old_password" class="input">
                    <span class="message message--error text--left" id="old_password_error"></span>
                </div>
                <div class="form-row">
                    <div class="form-row form-row--col">
                        <label for="new_password"><?php _e('Νέος κωδικός'); ?>*</label>
                        <input type="password" name="new_password" id="new_password" class="input">
                        <span class="message message--error text--left" id="new_password_error"></span>
                    </div>
                    <div class="form-row form-row--col">
                        <label for="confirm_password"><?php _e('Επιβεβαίωση νέου κωδικού'); ?>*</label>
                        <input type="password" name="confirm_password" id="confirm_password" class="input">
                        <span class="message message--error text--left" id="confirm_password_error"></span>
                    </div>
                </div>
                <div class="form-row form-row--submit">
                    <!-- <button id="update-user-password-form-submit" class="input btn pointer" type="submit"><?php _e('Ανανέωση κωδικού'); ?></button> -->
                </div>
                <p id="password-change-message" class="message--update"></p>
            </form>
        </div>
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
    </div>
</section>