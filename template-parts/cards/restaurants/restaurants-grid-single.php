<div class="grid--restaurants__single grid--restaurants__single-<?= get_the_ID(); ?>">
    <?php $logo = get_field('logo'); ?>
    <div class="grid--restaurants__logo">
        <?php if ($logo) : ?>
            <a href="<?php the_permalink(); ?>">
                <img src="<?= esc_url($logo['url']) ?>" alt="<?php the_title(); ?>">
            </a>
        <?php else : ?>
            <?php $logo = get_field('header_logo', 'option'); ?>
            <a href="<?php the_permalink(); ?>">
                <img src="<?= esc_url($logo['url']) ?>" alt="<?php the_title(); ?>">
            </a>
        <?php endif; ?>
    </div>
    <div class="grid--restaurants__content">
        <h3 class="grid--restaurants__title">
            <a href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
            </a>
        </h3>
        <ul class="grid--restaurants__details">
            <li class="grid--restaurants__details-item">
                <span class="icon icon--x-small"><?= file_get_contents(get_stylesheet_directory() . '/assets/images/star.svg') ?></span>
                <?php the_field('reviews'); ?>
            </li>
            <li class="grid--restaurants__details-item">
                <span class="icon icon--x-small"><?= file_get_contents(get_stylesheet_directory() . '/assets/images/credit-card.svg') ?></span>
                <?php the_field('average_price_per_dinner'); ?> &euro;
            </li>
            <li class="grid--restaurants__details-item">
                <span class="icon icon--x-small"><?= file_get_contents(get_stylesheet_directory() . '/assets/images/location-pin.svg') ?></span>
                <?php the_field('address'); ?>
            </li>
        </ul>
    </div>
</div>