<?php
require get_stylesheet_directory() . '/inc/protect-direct-access.php';
/**
 * Template Name: My Business List
 */
get_header();
// Get current user id
$current_user_id = get_current_user_id();
// Check if there is a param with a profile_id to enable edit mode
isset($_GET['profile_id']) && !empty($_GET['profile_id']) ? $post_id = $_GET['profile_id'] : $post_id = null;
isset($_GET['edit_mode']) && !empty($_GET['edit_mode']) ? $edit_mode = intval($_GET['edit_mode']) : $edit_mode = 0;
?>
<main class="site-main site-main--account">
    <section class="dashboard__container container container--medium">
        <?php get_template_part('template-parts/account/account-menu'); ?>
        <main class="dashboard__content">
            <?php if (isset($post_id) && !empty($post_id) && $edit_mode === 1) :  ?>
                <?php $profile_user_id = intval(get_post_meta($post_id, 'submitted_by_user_id')); ?>
                <?php if ($current_user_id === $profile_user_id) : ?>
                    <?= do_shortcode('[acfe_form post_id=" ' . $post_id . ' " name="edit-business-profile"]') ?>
                <?php else : ?>
                    <div class="message message--error">
                        <p><?php pll_e('Το επαγγελματικό προφίλ που αναζητάτε δεν βρέθηκε') ?></p>
                    </div>
                <?php endif; ?>
            <?php else : ?>
                <?php
                $args = array(
                    'post_type' => 'profiles',
                    'posts_per_page' => -1,
                    'meta_key' => 'submitted_by_user_id',
                    'meta_value' => $current_user_id
                );
                $query = new WP_Query($args);
                if ($query->have_posts()) :
                    while ($query->have_posts()) : $query->the_post();
                        get_template_part('template-parts/cards/profile/profile-card');
                    endwhile;
                else :
                    echo '<p class="message message--error">' . pll__('Δεν βρέθηκαν επαγγελματικά προφίλ') . '</p>';
                endif;
                ?>
            <?php endif; ?>
        </main>
    </section>
</main>
<?php get_footer(); ?>