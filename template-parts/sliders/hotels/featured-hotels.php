<?php $link = get_sub_field('link'); ?>
<section class="featured featured--hotels container container--medium">
    <div class="section-title__container">
        <h2 class="section-title"><?php the_sub_field('section_title'); ?></h2>
        <a class="cta cta--all" href="<?= esc_url($link['url']); ?>">
            <span>
                <?= esc_attr($link['title']); ?>
                <?= file_get_contents(get_stylesheet_directory() . '/assets/images/arrow-right.svg') ?>
            </span>
        </a>
    </div>
    <?php if (get_sub_field('hotels')) : ?>
        <?php $hotels = get_sub_field('hotels'); ?>
        <div class="swiper slider slider--hotels">
            <div class="swiper-wrapper">
                <?php foreach ($hotels as $post) : setup_postdata($post); ?>
                    <?php get_template_part('template-parts/cards/hotels/hotel-card'); ?>
                <?php endforeach; ?>
                <?php wp_reset_postdata(); ?>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    <?php endif; ?>
</section>