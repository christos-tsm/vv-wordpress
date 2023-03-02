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