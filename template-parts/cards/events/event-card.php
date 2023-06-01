<?php
$date = get_field('date', get_the_ID());
$time = get_field('time', get_the_ID());
$categories = get_post_taxonomies(get_the_ID());
?>
<article class="<?= is_page_template('page-templates/homepage.php') ? 'swiper-slide swiper-slide-event' : '' ?> events-card events-card__<?= get_the_ID() ?>">
    <header class="events-card__header">
        <?php if (has_post_thumbnail()) : ?>
            <a href="<?php the_permalink() ?>">
                <img class="events-card__thumbnail" src="<?php the_post_thumbnail_url('medium_large'); ?>" alt="<?php the_title(); ?>">
            </a>
        <?php else : ?>
            <?php $default = get_field('header_logo', 'options'); ?>
            <a href="<?php the_permalink() ?>">
                <img class="events-card__thumbnail" src="<?= esc_url($default['url']) ?>" alt="<?php the_title(); ?>">
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
    <div class="events-card__content">
        <?php if ($date && $time) : ?>
            <h4 class="events-card__subtitle">
                <span class="events-date-time">
                    <span class="icon icon--x-small">
                        <?= file_get_contents(get_stylesheet_directory() . '/assets/images/calendar.svg'); ?>
                    </span>
                    <?= esc_attr($date); ?>
                </span>
                <span class="events-date-time">
                    <span class="icon icon--x-small">
                        <?= file_get_contents(get_stylesheet_directory() . '/assets/images/clock.svg'); ?>
                    </span>
                    <?= esc_attr($time); ?>
                </span>
            </h4>
        <?php endif; ?>
        <h3 class="events-card__title"> <a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
    </div>
</article>