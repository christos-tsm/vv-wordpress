<?php
require get_stylesheet_directory() . '/inc/protect-direct-access.php';
/**
 * Template Name: Business Profile
 */
get_header();
$current_user = wp_get_current_user();
?>
<main class="site-main site-main--account">
    <section class="dashboard__container container container--medium">
        <?php get_template_part('template-parts/account/account-menu'); ?>
        <main class="dashboard__content">
            <h1 class="section-title"><?php pll_e('Εμπορικό προφίλ') ?></h1>
            <?= do_shortcode('[acfe_form name="add-business-profile"]'); ?>
        </main>
    </section>
</main>
<?php get_footer(); ?>