<?php $distance_from_volos = get_field('distance_from_volos'); ?>
<article class="<?= is_page_template('page-templates/homepage.php') ? 'swiper-slide' : '' ?> slide-destination destination__<?= get_the_ID() ?>">
    <div class="slide-destination__thumbnail-container">
        <?php if (has_post_thumbnail()) : ?>
            <a href="<?php the_permalink() ?>" class="icon">
                <img class="thumbnail slide-destination__thumbnail" src="<?php the_post_thumbnail_url('medium_large'); ?>" alt="<?php the_title(); ?>">
            </a>
        <?php else : ?>
            <?php $default = get_field('header_logo', 'options'); ?>
            <a href="<?php the_permalink() ?>" class="icon">
                <img class="thumbnail slide-destination__thumbnail" src="<?= esc_url($default['url']) ?>" alt="<?php the_title(); ?>">
            </a>
        <?php endif; ?>
    </div>

    <div class="slide-destination__content">
        <h3 class="slide-destination__title"><?php the_title(); ?></h3>
        <h4 class="slide-destination__subtitle">
            <span class="icon icon--small"><?= file_get_contents(get_stylesheet_directory() . '/assets/images/location-pin.svg'); ?></span>
            <?= esc_attr($distance_from_volos) . ' ' . pll__('μακριά άπο τον Βόλο'); ?>
        </h4>
        <div class="slide-destination__text">
            <?php the_content(); ?>
        </div>
    </div>
</article>