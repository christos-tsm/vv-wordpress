<?php
$date = get_field('date');
$time = get_field('time');
$price = get_field('tickets_from');
?>
<article class="<?= is_page_template('page-templates/homepage.php') ? 'swiper-slide swiper-slide-event' : '' ?> event-card event-card__<?= get_the_ID() ?>">
    <header class="card card__header event-card__header">
        <?php if (has_post_thumbnail()) : ?>
            <a href="<?php the_permalink() ?>">
                <img class="card__thumbnail event-card__thumbnail" src="<?php the_post_thumbnail_url('medium_large'); ?>" alt="<?php the_title(); ?>">
            </a>
        <?php else : ?>
            <?php $default = get_field('header_logo', 'options'); ?>
            <a href="<?php the_permalink() ?>">
                <img class="card__thumbnail event-card__thumbnail" src="<?= esc_url($default['url']) ?>" alt="<?php the_title(); ?>">
            </a>
        <?php endif; ?>
        <div class="card__content event-card__conent">
            <?php if ($date && $time) : ?>
                <h4 class="card__subtitle event-card__subtitle">
                    <span class="event-date">
                        <span class="icon icon--small">
                            <?= file_get_contents(get_stylesheet_directory() . '/assets/images/calendar.svg'); ?>
                        </span>
                        <?= esc_attr($date); ?>
                    </span>
                    <span class="event-time">
                        <span class="icon icon--small">
                            <?= file_get_contents(get_stylesheet_directory() . '/assets/images/clock.svg'); ?>
                        </span>
                        <?= esc_attr($time); ?>
                    </span>
                    <span class="event-price"><?= pll_e('Εισητήρια από:') . esc_attr($price) ?> &euro;</span>
                </h4>
            <?php endif; ?>
            <h3 class="card__title event-card__title"> <a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
        </div>
    </header>
    <div class="card__overlay"></div>
</article>