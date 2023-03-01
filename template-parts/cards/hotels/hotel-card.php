<article class="<?= is_page_template('page-templates/homepage.php') ? 'swiper-slide' : '' ?> hotel-card hotel-card__<?= get_the_ID() ?>">
    <header class="hotel-card__header">
        <?php if (has_post_thumbnail()) : ?>
            <a href="<?php the_permalink() ?>">
                <img class="hotel-card__thumbnail" src="<?php the_post_thumbnail_url('medium_large'); ?>" alt="<?php the_title(); ?>">
            </a>
        <?php else : ?>
            <?php $default = get_field('header_logo', 'options'); ?>
            <a href="<?php the_permalink() ?>">
                <img class="hotel-card__thumbnail" src="<?= esc_url($default['url']) ?>" alt="<?php the_title(); ?>">
            </a>
        <?php endif; ?>
        <h3 class="hotel-card__title"> <a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
    </header>
    <footer class="hotel-card__footer">
        <p class="hotel-details__item">
            <span class="icon icon--small">
                <?= file_get_contents(get_stylesheet_directory() . '/assets/images/star.svg'); ?>
            </span>
            <?php the_field('reviews'); ?>
        </p>
        <p class="hotel-details__item"">
            <span class=" icon icon--small">
            <?= file_get_contents(get_stylesheet_directory() . '/assets/images/credit-card.svg'); ?>
            </span>
            <?php the_field('average_price_per_night'); ?>
        </p>
        <p class="hotel-details__item"">
            <span class=" icon icon--small">
            <?= file_get_contents(get_stylesheet_directory() . '/assets/images/location-pin.svg'); ?>
            </span>
            <?php the_field('distance_from_city_center'); ?>
        </p>
    </footer>
</article>