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
    <!-- <section class="categories-cards container container--medium">
        <div class="categories-cards__single categories-card__hotels">
            <a class="categories-cards__title" href="#!">
                <?php pll_e('Ξενοδοχεία') ?>
            </a>
        </div>
        <div class="categories-cards__single categories-card__restaurants">
            <a class="categories-cards__title" href="#!">
                <?php pll_e('Εστιατόρια') ?>
            </a>
        </div>
        <div class="categories-cards__single categories-card__coffee-houses">
            <a class="categories-cards__title" href="#!">
                <?php pll_e('Καφετέριες') ?>
            </a>
        </div>
        <div class="categories-cards__single categories-card__bars">
            <a class="categories-cards__title" href="#!">
                <?php pll_e('Μπάρ') ?>
            </a>
        </div>
        <div class="categories-cards__single categories-card__museums">
            <a class="categories-cards__title" href="#!">
                <?php pll_e('Μουσεία') ?>
            </a>
        </div>
        <div class="categories-cards__single categories-card__travel-agents">
            <a class="categories-cards__title" href="#!">
                <?php pll_e('Ταξιδιωτικά γραφεία') ?>
            </a>
        </div>
    </section> -->
</main>
<?php get_footer(); ?>