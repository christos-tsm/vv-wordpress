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
        <div class="dashboard__content">
            <?php if (isset($post_id) && !empty($post_id) && $edit_mode === 1  && get_post_status($post_id) === 'publish') :  ?>
                <?php get_template_part('template-parts/forms/add', $type); ?>
            <?php else : ?>
                <?php
                $args = array(
                    'post_type' => array('hotels', 'bars', 'restaurants', 'travel-agents', 'coffee-houses', 'night-clubs'),
                    'meta_key' => 'user_id',
                    'meta_value' => $current_user_id,
                    'post_status' => array('publish', 'draft')
                );
                $query = new WP_Query($args);
                ?>
                <div class="dashboard__content">
                    <?php if ($query->have_posts()) : ?>
                        <div class="store-list__container">
                            <div class="store-list">
                                <?php while ($query->have_posts()) : $query->the_post(); ?>
                                    <?php get_template_part('template-parts/admin/cards/store-card'); ?>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    <?php else : ?>
                        <p class="message message--error"><?php pll_e('Δεν βρέθηκαν καταχωρημένες επιχειρήσεις') ?></p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>


<?php get_footer(); ?>