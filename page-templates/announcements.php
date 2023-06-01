<?php

/**
 * Template Name: Announcements
 */
get_header();

$args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'tax_query' => array(
        array(
            'taxonomy' => 'category',
            'field' => 'term_id',
            'terms' => 123,
        )
    )
);
$query = new WP_Query($args);
?>

<main class="site-main site-main--blog container container--medium">
    <?php get_template_part('template-parts/general/page-header'); ?>
    <?php if ($query->have_posts()) : ?>
        <section class="archive__content">
            <?php
            while ($query->have_posts()) : $query->the_post();
                get_template_part('template-parts/cards/posts/post-card');
            endwhile;
            wp_reset_postdata();
            ?>
        </section>
    <?php endif; ?>
</main>

<?php get_footer(); ?>