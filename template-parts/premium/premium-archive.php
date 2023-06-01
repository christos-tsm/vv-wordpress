<?php
extract($wp_query->query_vars);
// Fetch Premium users
global $wpdb;
$premium_level_id = 3; // 'Premium' level ID
$premium_user_ids = $wpdb->get_col(
    $wpdb->prepare(
        "SELECT user_id FROM {$wpdb->prefix}pmpro_memberships_users WHERE membership_id = %d AND status = 'active'",
        $premium_level_id
    )
);
// Fetch non premium posts
$other_posts = new WP_Query(array(
    'post_type' => $post_type,
    'meta_query' => array(
        array(
            'key' => 'user_id',
            'value' => $premium_user_ids,
            'compare' => 'NOT IN'
        ),
    ),
));
// Fetch Premium CPTs
$premium_posts = new WP_Query(array(
    'post_type' => $post_type,
    'meta_query' => array(
        array(
            'key' => 'user_id',
            'value' => $premium_user_ids,
            'compare' => 'IN'
        ),
    ),
));
if ($premium_posts->have_posts()) : ?>
    <section class="archive__premium-posts">
        <?php while ($premium_posts->have_posts()) : $premium_posts->the_post(); ?>
            <?php get_template_part('template-parts/archive/content-archive');  ?>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
    </section>
<?php endif;  ?>
<section class="archive__content">
    <?php
    while ($other_posts->have_posts()) : $other_posts->the_post();
        get_template_part('template-parts/archive/content-archive');
    endwhile;
    wp_reset_postdata();
    ?>
</section>