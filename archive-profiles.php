<?php
get_header();
$args = array(
    'post_type' => 'profiles',
    'post_status' => 'publish',
    'posts_per_page' => -1,
);
if (isset($_GET['profile_category']) && !empty($_GET['profile_category'])) {
    $municipality = (int) $_GET['municipality'];
    $category = (int) $_GET['profile_category'];
    $args['meta_query'] = array(
        'relation' => 'AND',
        array(
            'key' => 'business_category',
            'value' => '"' . $category . '"',
            'compare' => 'LIKE',
        ),
        array(
            'key' => 'municipality',
            'value' => '"' . $municipality . '"',
            'compare' => 'LIKE',
        )
    );
}
$query = new WP_Query($args);
?>
<main class="site-main site-main--profiles-archive">
    <section class="profiles-archive__content container container--medium">
        <?php if ($query->have_posts()) : ?>
            <?php
            while ($query->have_posts()) : $query->the_post();
                get_template_part('template-parts/cards/profile/profile-card');
            endwhile;
            wp_reset_postdata();
            ?>
        <?php else : ?>
            <h1 class="message message--error"><?php pll_e('Δεν βρέθηκαν αποτελέσματα για την αναζήτησή σας.') ?></h1>
        <?php endif; ?>
    </section>
</main>
<?php get_footer(); ?>