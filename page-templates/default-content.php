<?php

/**
 * Template Name: Generic
 */
get_header();
?>
<main id="primary" class="site-main site-main--generic-page">
    <section class="container container--medium">
        <div class="generic__header">
            <?php if (has_post_thumbnail()) : ?>
                <img class="generic__thumbnail" src="<?php the_post_thumbnail_url('large') ?>" alt="Volos-Voyage - <?php the_title(); ?>">
            <?php endif; ?>
            <div class="generic__title">
                <h1 class="page-title"><?php the_title(); ?></h1>
            </div>
            <div class="overlay"></div>
        </div>
        <div class="generic__content">
            <?php the_content();  ?>
        </div>
        <?php if (get_field('gallery')) : ?>
            <?php $gallery = get_field('gallery'); ?>
            <div class="generic__gallery single-content__gallery">
                <?php foreach ($gallery as $image) : ?>
                    <a class="single-content__gallery-link" data-fslightbox="gallery" aria-label="Open image in lightbox" href="<?= esc_url($image['url']) ?>">
                        <img class="single-content__gallery-image" src="<?= esc_url($image['sizes']['medium_large']) ?>" alt="<?= the_title(); ?>">
                        <span class="overlay">
                            <span class="icon icon--medium">
                                <?= file_get_contents(get_stylesheet_directory() . '/assets/images/external.svg'); ?>
                            </span>
                        </span>
                    </a>
                <?php endforeach;  ?>
            </div>
        <?php endif; ?>
    </section>
</main>
<?php get_footer(); ?>