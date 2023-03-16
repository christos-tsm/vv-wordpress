<?php
$description = get_field('description');
if ($description) :
    $words = explode(" ", $description);
    $trimmed_description = implode(" ", array_splice($words, 0, 15));
endif;
?>
<article class="archive-item archive-item--restaurant archive-item--<?= get_the_ID() ?>">
    <header class="archive-item__header">
        <?php if (get_field('logo')) : ?>
            <?php $logo = get_field('logo'); ?>
            <a class="archive-item__thumbnail-link" href="<?php the_permalink() ?>">
                <img class="archive-item__thumbnail" src="<?= esc_url($logo['url']) ?>" alt="<?php the_title() ?>">
            </a>
        <?php else : ?>
            <?php $logo = get_field('header_logo'); ?>
            <a class="archive-item__thumbnail-link" href="<?php the_permalink() ?>">
                <img class="archive-item__thumbnail" src="<?= esc_url($logo['url']) ?>" alt="<?php the_title() ?>">
            </a>
        <?php endif; ?>
        <h3 class="archive-item__title">
            <a class="archive-item__title-link" href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
            </a>
        </h3>
    </header>
    <?php if ($description) : ?>
        <div class="archive-item__description">
            <?php if (count($words) > 15) : ?>
                <p><?= esc_attr($trimmed_description) . '...'; ?></p>
            <?php else : ?>
                <p><?= esc_attr($description); ?></p>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <footer>
        <ul class="archive-item__details">
            <li class="archive-item__details-item">
                <span class="icon icon--x-small"><?= file_get_contents(get_stylesheet_directory() . '/assets/images/star.svg') ?></span>
                <?php the_field('reviews'); ?>
            </li>
            <li class="archive-item__details-item">
                <span class="icon icon--x-small"><?= file_get_contents(get_stylesheet_directory() . '/assets/images/credit-card.svg') ?></span>
                <?php the_field('average_price_per_dinner'); ?> &euro;
            </li>
            <li class="archive-item__details-item">
                <span class="icon icon--x-small"><?= file_get_contents(get_stylesheet_directory() . '/assets/images/location-pin.svg') ?></span>
                <address><?php the_field('address'); ?></address>
            </li>
        </ul>
    </footer>
</article>