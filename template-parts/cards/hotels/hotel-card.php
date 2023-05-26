<article class="<?= is_page_template('page-templates/homepage.php') ? 'swiper-slide' : '' ?> hotel-card hotel-card__<?= get_the_ID() ?>">
    <header class="card card__header hotel-card__header">
        <?php if (has_post_thumbnail()) : ?>
            <a href="<?php the_permalink() ?>">
                <img class="card__thumbnail hotel-card__thumbnail" src="<?php the_post_thumbnail_url('medium_large'); ?>" alt="<?php the_title(); ?>">
                <?php get_template_part('template-parts/premium/premium-badge'); ?>
            </a>
        <?php else : ?>
            <?php $default = get_field('header_logo', 'options'); ?>
            <a href="<?php the_permalink() ?>">
                <img style="padding: 15px; object-fit: contain;" class="card__thumbnail hotel-card__thumbnail" src="<?= esc_url($default['url']) ?>" alt="<?php the_title(); ?>">
                <?php get_template_part('template-parts/premium/premium-badge'); ?>
            </a>
        <?php endif; ?>
        <h3 class="card__title hotel-card__title"> <a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
    </header>
    <footer class="card__footer hotel-card__footer">
        <address class="hotel-details__item"">
            <span class=" icon icon--x-small">
            <?= file_get_contents(get_stylesheet_directory() . '/assets/images/location-pin.svg'); ?>
            </span>
            <?php the_field('address'); ?>
        </address>
    </footer>
</article>