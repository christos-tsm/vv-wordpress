<?php
$date = get_field('date');
$time = get_field('time');
$categories = get_post_taxonomies(get_the_ID());
?>
<article class="<?= is_page_template('page-templates/homepage.php') ? 'swiper-slide swiper-slide-event' : '' ?> event-card event-card__<?= get_the_ID() ?>">
    <header class="event-card__header">
        <?php if (has_post_thumbnail()) : ?>
            <a href="<?php the_permalink() ?>">
                <img class="event-card__thumbnail" src="<?php the_post_thumbnail_url('medium_large'); ?>" alt="<?php the_title(); ?>">
            </a>
        <?php else : ?>
            <?php $default = get_field('header_logo', 'options'); ?>
            <a href="<?php the_permalink() ?>">
                <img class="event-card__thumbnail" src="<?= esc_url($default['url']) ?>" alt="<?php the_title(); ?>">
            </a>
        <?php endif; ?>
        <?php foreach ($categories as $category) : ?>
            <?php if (strpos($category, '-categories') !== false) : ?>
                <?php $terms = get_the_terms(get_the_ID(), $category); ?>
                <?php if ($terms && !is_wp_error($terms)) : ?>
                    <?php foreach ($terms as $term) : ?>
                        <span class="badge badge--category"><?= $term->name; ?></span>
                    <?php endforeach ?>
                <?php endif; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </header>
    <div class="event-card__conent">
        <?php if ($date && $time) : ?>
            <h4 class="event-card__subtitle">
                <span class="event-date-time">
                    <span class="icon icon--x-small">
                        <?= file_get_contents(get_stylesheet_directory() . '/assets/images/calendar.svg'); ?>
                    </span>
                    <?= esc_attr($date); ?>
                </span>
                <span class="event-date-time">
                    <span class="icon icon--x-small">
                        <?= file_get_contents(get_stylesheet_directory() . '/assets/images/clock.svg'); ?>
                    </span>
                    <?= esc_attr($time); ?>
                </span>
            </h4>
        <?php endif; ?>
        <h3 class="event-card__title"> <a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
    </div>
</article>