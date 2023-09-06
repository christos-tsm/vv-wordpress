<?php
$current_post_id = get_the_ID();
$current_date = date('Y-m-d');

$args = array(
    'post_type' => 'events',
    'post_status' => 'publish',
    'meta_query' => array(
        array(
            'key' => 'store_id',
            'value' => $current_post_id,
            'compare' => '='
        )
    )
);

$events_query = new WP_Query($args);
?>
<?php if ($events_query->have_posts()) : ?>
    <section class="related-events__container container container--medium">
        <div class="section-title__container">
            <h2 class="section-title"><?php _e('Προσεχείς εκδηλώσεις'); ?> </h2>
        </div>
        <div class="related-events">
            <?php while ($events_query->have_posts()) : $events_query->the_post(); ?>
                <?php get_template_part('template-parts/cards/events/event-card'); ?>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </div>
    </section>
<?php endif;  ?>