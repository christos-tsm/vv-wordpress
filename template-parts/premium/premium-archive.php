<?php
extract($wp_query->query_vars);
// Fetch Premium users
$premium_users = rcp_get_members_of_subscription();
$premium_users_array = [];
$premium_post_ids = [];

if (!empty($premium_users)) :
    foreach ($premium_users as $user) :
        if ($user->status === 'active') :
            $premium_users_array[] =  $user->ID;
        endif;
    endforeach;
endif;
// Fetch Premium CPTs
if (!empty($premium_users_array)) {
    $premium_posts = new WP_Query(array(
        'post_type' => $post_type,
        'meta_query' => array(
            array(
                'key' => 'user_id',
                'value' => $premium_users_array,
                'compare' => 'IN'
            ),
        ),
    ));
    // Gather the post IDs of the premium posts.
    if ($premium_posts->have_posts()) :
        while ($premium_posts->have_posts()) : $premium_posts->the_post();
            $premium_post_ids[] = get_the_ID();
        endwhile;
        wp_reset_postdata();
    endif;
}
// Fetch non premium CPTs
$other_posts = new WP_Query(array(
    'post_type' => $post_type,
    'post__not_in' => $premium_post_ids,  // Exclude premium posts
    'meta_query' => array(
        array(
            'key' => 'user_id',
            'value' => $premium_users_array,
            'compare' => 'NOT IN'
        ),
    ),
));

if (!empty($premium_users_array) && $premium_posts->have_posts()) : ?>
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