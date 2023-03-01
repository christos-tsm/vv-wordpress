<section class="featured featured--hotels container container--medium">
    <h2 class="section-title"><?php the_sub_field('section_title'); ?></h2>
    <?php if (get_sub_field('hotels')) : ?>
        <?php $hotels = get_sub_field('hotels'); ?>
        <div class="swiper slider slider--hotels">
            <div class="swiper-wrapper">
                <?php foreach ($hotels as $post) : setup_postdata($post); ?>
                    <?php get_template_part('template-parts/cards/hotels/hotel-card'); ?>
                <?php endforeach; ?>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    <?php endif; ?>
</section>