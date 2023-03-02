<?php $events = get_sub_field('events'); ?>
<?php if ($events) : ?>
    <div class="swiper slider slider--events">
        <div class="swiper-wrapper">
            <?php foreach ($events as $post) : setup_postdata($post); ?>
                <?php get_template_part('template-parts/cards/events/event-card'); ?>
            <?php endforeach; ?>
            <?php wp_reset_postdata(); ?>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
<?php endif; ?>