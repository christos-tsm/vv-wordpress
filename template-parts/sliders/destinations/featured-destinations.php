<?php $destinations = get_sub_field('destinations'); ?>
<?php if ($destinations) : ?>
    <div class="swiper slider slider--destinations">
        <div class="swiper-wrapper">
            <?php foreach ($destinations as $post) : setup_postdata($post); ?>
                <?php get_template_part('template-parts/destinations/destinations-slide'); ?>
            <?php endforeach; ?>
            <?php wp_reset_postdata(); ?>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
<?php endif; ?>