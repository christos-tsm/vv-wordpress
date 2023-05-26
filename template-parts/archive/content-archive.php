<?php
$description = get_field('description');
$address = get_field('address');
if ($description) :
    $words = explode(" ", $description);
    $trimmed_description = implode(" ", array_splice($words, 0, 15));
else :
    $description = get_the_content();
    $words = explode(" ", $description);
    $trimmed_description = implode(" ", array_splice($words, 0, 15));
endif;
?>
<div class="loading-spinner__container">
    <span class="loader"></span>
</div>
<article class="archive-item archive-item--<?= get_post_type() ?> archive-item--<?= get_the_ID() ?>">
    <header class="archive-item__header">
        <?php if (has_post_thumbnail()) : ?>
            <a class="archive-item__thumbnail-link" href="<?php the_permalink() ?>">
                <img class="archive-item__thumbnail" src="<?= esc_url(the_post_thumbnail_url('medium_large')) ?>" alt="<?php the_title() ?>">
            </a>
        <?php elseif (get_field('logo')) : ?>
            <?php $logo = get_field('logo'); ?>
            <a class="archive-item__logo-link" href="<?php the_permalink() ?>">
                <img class="archive-item__logo" src="<?= esc_url($logo['url']) ?>" alt="<?php the_title() ?>">
            </a>
        <?php else : ?>
            <?php $logo = get_field('header_logo', 'option'); ?>
            <a class="archive-item__logo-link" href="<?php the_permalink() ?>">
                <img class="archive-item__logo" src="<?= esc_url($logo['url']) ?>" alt="<?php the_title() ?>">
            </a>
        <?php endif; ?>
        <h3 class="archive-item__title">
            <a class="archive-item__title-link" href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
            </a>
        </h3>
        <?php get_template_part('template-parts/premium/premium-badge'); ?>
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
    <?php if ($address) : ?>
        <footer>
            <ul class="archive-item__details">
                <li class="archive-item__details-item">
                    <span class="icon icon--x-small"><?= file_get_contents(get_stylesheet_directory() . '/assets/images/location-pin.svg') ?></span>
                    <address><?= esc_attr($address); ?></address>
                </li>
            </ul>
        </footer>
    <?php endif; ?>
</article>