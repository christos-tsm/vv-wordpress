<?php

/**
 * Template Name: Search Results
 */
get_header();
$profile_category = $_GET['profile_category'];
$municipality = $_GET['municipality'];
$tax_query = array(
    array(
        'taxonomy' => 'freelancer-categories',
        'field'    => 'slug',
        'terms'    => $profile_category,
    ),
);
$meta_query = array(
    array(
        'key'     => 'municipality',
        'value'   => $municipality,
        'compare' => 'LIKE',
    ),
);
$query = new WP_Query(array(
    'post_type' => 'freelancers',
    'tax_query' => $tax_query,
    'meta_query' => $meta_query,
));
?>
<main class="site-main site-main--search-results">
    <div class="container container--medium">
        <div class="store-list__container">
            <div class="store-list">
                <?php if ($query->have_posts()) : ?>
                    <?php while ($query->have_posts()) : $query->the_post(); ?>
                        <?php get_template_part('template-parts/admin/cards/store-card'); ?>
                    <?php endwhile; ?>
                <?php else : ?>
                    <p class="message message--error"><?php _e('Δεν βρέθηκαν καταχωρημένες επιχειρήσεις') ?></p>
                <?php endif; ?>
                <?php wp_reset_postdata(); ?>
            </div>
        </div>
    </div>
</main>
<?php get_footer();  ?>