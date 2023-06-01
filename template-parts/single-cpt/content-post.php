<?php
$post_type = get_post_type();
$category = get_the_category(get_the_ID());
$gallery = get_field('gallery');
?>
<main class="site-main site-main--single">
    <article id="single-<?= get_the_ID(); ?>" class="single-content single-content__<?= esc_attr($post_type); ?>">
        <header class="single-content__header">
            <div class="cover-photo__container container container--medium">
                <?php if (has_post_thumbnail()) : ?>
                    <img class="cover-photo" src="<?php the_post_thumbnail_url('large') ?>" alt="Volos-Voyage - <?php the_title(); ?>">
                <?php else : ?>
                    <?php $cover_photo = get_field('header_logo', 'option'); ?>
                    <img class="cover-photo cover-photo--logo" src="<?= esc_url($cover_photo['url']) ?>" alt="Volos-Voyage - <?php the_title(); ?>">
                <?php endif;  ?>
            </div>
            <div class="single-title__container container container--medium">
                <h1 class="section-title section-title--single">
                    <?php the_title(); ?>
                    <?php if ($category && !is_wp_error($category)) : ?>
                        <span class="single-category"><?= $category[0]->name; ?></span>
                    <?php endif; ?>
                </h1>
                <ul class="single-details">
                    <li class="single-details__item single-details__item--date-posted">
                        <!-- <a href="#!" target="_blank" rel="noreferrer noopener" class="address-link">
                            <span class="icon icon--x-small"><?= file_get_contents(get_stylesheet_directory() . '/assets/images/location-pin.svg') ?></span>
                            <?= $address; ?>
                        </a> -->
                    </li>
                </ul>
            </div>
        </header>
        <section class="single-content__content container container--medium">
            <div class="single-content">
                <?php the_content();  ?>
            </div>
            <?php if ($gallery) : ?>
                <div class="single-content__gallery">
                    <?php foreach ($gallery as $image) :  ?>
                        <a class="single-content__gallery-link" aria-label="Open gallery lightbox" data-fslightbox="gallery" href="<?= esc_url($image['url']) ?>">
                            <img class="single-content__gallery-image" src="<?= esc_url($image['sizes']['medium']) ?>" alt="<?php the_title(); ?> image">
                            <span class="overlay">
                                <span class="icon icon--medium">
                                    <?= file_get_contents(get_stylesheet_directory() . '/assets/images/external.svg'); ?>
                                </span>
                            </span>
                        </a>
                    <?php endforeach;  ?>
                </div>
            <?php endif;  ?>
        </section>
    </article>
</main>