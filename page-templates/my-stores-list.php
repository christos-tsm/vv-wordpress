<?php
require get_stylesheet_directory() . '/inc/protect-direct-access.php';
/**
 * Template Name: My Store List
 */
get_header();
// Get current user id
$current_user_id = get_current_user_id();
// Check if there is a param with a store_id to enable edit mode
isset($_GET['store_id']) && !empty($_GET['store_id']) ? $post_id = $_GET['store_id'] : $post_id = null;
isset($_GET['type']) && !empty($_GET['type']) ? $type = $_GET['type'] : $type = null;
isset($_GET['edit_mode']) && !empty($_GET['edit_mode']) ? $edit_mode = intval($_GET['edit_mode']) : $edit_mode = 0;
?>
<main class="site-main site-main--account">
    <section class="dashboard__container container container--medium">
        <?php if ($edit_mode == 0) : ?>
            <?php get_template_part('template-parts/account/user-details'); ?>
        <?php endif;  ?>
        <div class="dashboard__content">
            <?php if (isset($post_id) && !empty($post_id) && $edit_mode === 1  && get_post_status($post_id) === 'publish') :  ?>
                <?php get_template_part('template-parts/forms/add', $type); ?>
            <?php else : ?>
                <?php
                /**
                 * WP_query didnt fetch "shops" cpt
                 * Used sql instead to resolve the issue.
                 */
                global $wpdb;
                $current_user_id = get_current_user_id();
                $query = $wpdb->prepare(
                    "
                    SELECT *
                    FROM {$wpdb->prefix}posts
                    INNER JOIN {$wpdb->prefix}postmeta
                    ON {$wpdb->prefix}posts.ID = {$wpdb->prefix}postmeta.post_id
                    WHERE {$wpdb->prefix}posts.post_type IN ('hotels', 'bars', 'restaurants', 'travel-agents', 'coffee-houses', 'night-clubs', 'shops', 'freelancers')
                    AND {$wpdb->prefix}postmeta.meta_key = 'user_id'
                    AND {$wpdb->prefix}postmeta.meta_value = '%d'
                    AND {$wpdb->prefix}posts.post_status IN ('publish', 'draft')
                    ",
                    $current_user_id
                );
                $results = $wpdb->get_results($query);
                ?>
                <?php if (!empty($results)) : ?>
                    <div class="store-list__container">
                        <div class="store-list">
                            <?php foreach ($results as $result) : ?>
                                <?php $post = get_post($result->ID); ?>
                                <?php setup_postdata($post); ?>
                                <?php get_template_part('template-parts/admin/cards/store-card'); ?>
                            <?php endforeach; ?>
                            <?php wp_reset_postdata(); ?>
                        </div>
                    </div>
                <?php else : ?>
                    <p class="message message--error"><?php _e('Δεν βρέθηκαν καταχωρημένες επιχειρήσεις') ?></p>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </section>
</main>


<?php get_footer(); ?>