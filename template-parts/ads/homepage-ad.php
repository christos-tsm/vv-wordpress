<?php $ad_image = get_sub_field('image'); ?>
<div class="ad ad--homepage">
    <h4 class="ad__title section-title"><?php the_sub_field('title'); ?></h4>
    <p class="ad__text"><?php the_sub_field('text'); ?> </p>
    <img class="ad__banner" src="<?= esc_url($ad_image['url']) ?>" alt="<?php the_sub_field('title'); ?>">
</div>