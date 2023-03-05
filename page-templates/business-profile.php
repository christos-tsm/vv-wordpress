<?php

/**
 * Template Name: Business Profile
 */
acf_form_head();
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
            <h1 class="section-title"><?php pll_e('Εμπορικό προφίλ') ?></h1>
            <?php $submit_message = pll_current_language() === 'el' ? esc_attr('Δημιουργία Επαγγελματικού Προφίλ') : esc_attr('Submit Business Profile'); ?>
            <?php acf_form(array(
                'post_id'       => 'new_post',
                'post_title' => true,
                'post_content' => false,
                'uploader' => 'basic',
                'new_post'      => array(
                    'post_type'     => 'profiles',
                    'post_status'   => 'draft'
                ),
                'html_submit_button'  => '<input type="submit" class="btn input pointer" value="%s" />',
                'submit_value'  => $submit_message
            )); ?>
        </main>
    </section>
</main>
<?php get_footer(); ?>