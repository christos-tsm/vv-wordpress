<?php

/**
 * Template Name: Homepage
 */
get_header();
?>
<main class="site-main site-main--homepage">
    <?php if (have_rows('hero_section')) : ?>
        <?php while (have_rows('hero_section')) : the_row(); ?>
            <?php $gallery = get_sub_field('gallery'); ?>
            <section class="header-hero container container--medium">
                <div class="header-hero__content">
                    <h1 class="header-hero__title"><?php the_sub_field('title'); ?></h1>
                    <p class="header-hero__text"><?php the_sub_field('text'); ?></p>
                </div>
                <div class="header-hero__gallery">
                    <div class="header-hero__gallery-single">
                        <img src="<?= esc_url($gallery[0]['sizes']['medium_large']) ?>" alt="<?php the_sub_field('title'); ?>">
                    </div>
                    <div class="header-hero__gallery-single">
                        <img src="<?= esc_url($gallery[1]['sizes']['medium_large']) ?>" alt="<?php the_sub_field('title'); ?>">
                    </div>
                    <div class="header-hero__gallery-single">
                        <img src="<?= esc_url($gallery[2]['sizes']['medium_large']) ?>" alt="<?php the_sub_field('title'); ?>">
                    </div>
                </div>
            </section>
        <?php endwhile; ?>
    <?php endif; ?>
    <?php if (have_rows('categories_cards')) : ?>
        <div class="categories-cards categories-cards__homepage container container--medium">
            <?php while (have_rows('categories_cards')) :  the_row(); ?>
                <?php get_template_part('template-parts/cards/categories/category-card'); ?>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
    <?php if (have_rows('featured_hotels')) : ?>
        <?php while (have_rows('featured_hotels')) : the_row(); ?>
            <?php get_template_part('template-parts/sliders/hotels/featured-hotels'); ?>
        <?php endwhile; ?>
    <?php endif; ?>
    <section class="featured featured--restaurants container container--medium">
        <?php if (have_rows('homepage_ad', 'options')) : ?>
            <?php while (have_rows('homepage_ad', 'options')) : the_row(); ?>
                <?php get_template_part('template-parts/ads/homepage-ad'); ?>
            <?php endwhile; ?>
        <?php endif; ?>
        <?php if (have_rows('featured_restaurants')) : ?>
            <?php while (have_rows('featured_restaurants')) : the_row(); ?>
                <?php $link = get_sub_field('link'); ?>
                <div class="restaurants">
                    <div class="section-title__container">
                        <h2 class="section-title"><?php the_sub_field('section_title'); ?></h2>
                        <a class="cta cta--all" href="<?= esc_url($link['url']); ?>">
                            <span>
                                <?= esc_attr($link['title']); ?>
                                <?= file_get_contents(get_stylesheet_directory() . '/assets/images/arrow-right.svg') ?>
                            </span>
                        </a>
                    </div>
                    <?php $restaurants = get_sub_field('restaurants'); ?>
                    <div class="grid grid--restaurants">
                        <?php foreach ($restaurants as $post) : setup_postdata($post); ?>
                            <?php get_template_part('template-parts/cards/restaurants/restaurants-grid-single'); ?>
                        <?php endforeach; ?>
                        <?php wp_reset_postdata(); ?>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </section>
</main>
<?php get_footer(); ?>