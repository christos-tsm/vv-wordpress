<?php
get_header();
$categories = get_terms(array(
    'taxonomy' => 'restaurant-categories',
    'hide_empty' => false,
));
?>
<main class="site-main site-main--archive  container container--medium">
    <?php
    set_query_var('categories', $categories);
    get_template_part('template-parts/archive/filters');
    ?>
    <?php if (have_posts()) : ?>
        <section class="archive__content">
            <?php
            while (have_posts()) : the_post();
                get_template_part('template-parts/archive/content-restaurant');
            endwhile;
            wp_reset_postdata();
            ?>
        </section>
    <?php endif; ?>
</main>
<?php get_footer(); ?>