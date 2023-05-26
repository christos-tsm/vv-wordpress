<?php

get_header();
$categories = get_terms(array(
    'taxonomy' => 'bar-categories',
    'hide_empty' => false,
));
$post_type = 'bars';
$taxonomy =  'bar-categories';
?>
<main class="site-main site-main--archive  container container--medium">
    <?php
    set_query_var('categories', $categories);
    set_query_var('post-type', $post_type);
    set_query_var('taxonomy', $taxonomy);
    get_template_part('template-parts/archive/filters');
    ?>
    <?php if (have_posts()) : ?>
        <div class="archive__container">
            <?php get_template_part('template-parts/premium/premium-archive'); ?>
        </div>
    <?php endif; ?>
</main>
<?php get_footer(); ?>