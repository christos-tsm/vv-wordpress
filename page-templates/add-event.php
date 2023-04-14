<?php
require get_stylesheet_directory() . '/inc/protect-direct-access.php';
/**
 * Template Name: Add Event
 */
get_header();
$current_user_id = get_current_user_id();
// Fetch current user's stores
global $wpdb;
$query = $wpdb->prepare(
    "
    SELECT *
    FROM {$wpdb->prefix}posts
    INNER JOIN {$wpdb->prefix}postmeta
    ON {$wpdb->prefix}posts.ID = {$wpdb->prefix}postmeta.post_id
    WHERE {$wpdb->prefix}posts.post_type IN ('hotels', 'bars', 'restaurants', 'travel-agents', 'coffee-houses', 'night-clubs', 'shops')
    AND {$wpdb->prefix}postmeta.meta_key = 'user_id'
    AND {$wpdb->prefix}postmeta.meta_value = '%d'
    AND {$wpdb->prefix}posts.post_status IN ('publish')
    ",
    $current_user_id
);
$results = $wpdb->get_results($query);
// if (isset($_GET['store']) && !empty($_GET['store'])) {
//     $store = $_GET['store'];
// } else {
//     $store = null;
// }
?>
<main class="site-main site-main--account">
    <div class="dashboard__container container container--medium">
        <section class="dashboard__content">
            <h1 class="section-title section-title--dashboard"><?php pll_e('Καταχώρηση εκδήλωσης'); ?><span class="divider"></span></h1>
            <?php if (!get_transient('custom_hotel_form_success') && !get_transient('custom_hotel_form_error')) : ?>
                <div class="store-select__container">
                    <?php if (!empty($results)) : ?>
                        <select name="store_id" id="store_id">
                            <?php foreach ($results as $result) : ?>
                                <?php $post = get_post($result->ID); ?>
                                <?php setup_postdata($post); ?>
                                <option value="<?= get_the_ID(); ?>" <?= isset($_GET['store_id']) && $_GET['store_id'] === get_the_ID() ? 'selected' : '' ?>><?php the_title(); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php wp_reset_postdata(); ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <?php
            if (get_transient('custom_hotel_form_success')) {
                echo '<div class="message message--success">' . get_transient('custom_hotel_form_success') . '</div>';
                delete_transient('custom_hotel_form_success');
            }
            if (get_transient('custom_hotel_form_error')) {
                echo '<div class="message message--error">' . get_transient('custom_hotel_form_error') . '</div>';
                delete_transient('custom_hotel_form_error');
            }
            ?>
            <div class="store-event-form-container">
                <?php get_template_part('template-parts/forms/add-event'); ?>
            </div>
        </section>
    </div>
</main>
<?php get_footer(); ?>