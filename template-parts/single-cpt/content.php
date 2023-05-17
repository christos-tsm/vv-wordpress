<?php
$post_type = get_post_type();
$cover_photo = get_field('cover_photo');
$gallery = get_field('gallery');
$address = get_field('address');
$coordinates = get_field('coordinates');
$website = get_field('website');
$facebook_url = get_field('facebook_url');
$instagram_url = get_field('instagram_url');
$tiktok_url = get_field('tiktok_url');
$tripadvisor_url = get_field('tripadvisor_url');
$booking_url = get_field('booking_url');
$distance = get_field('distance_from_city_center');
$avg_prce = get_field('average_price');
$categories = get_post_taxonomies(get_the_ID());
?>
<main class="site-main site-main--single">
    <article id="single-<?= get_the_ID(); ?>" class="single-content single-content__<?= esc_attr($post_type); ?>">
        <header class="single-content__header">
            <div class="cover-photo__container container container--medium">
                <?php if ($cover_photo && !empty($cover_photo)) : ?>
                    <img class="cover-photo" src="<?= $cover_photo['url'] ?>" alt="Volos-Voyage - <?php the_title(); ?>">
                <?php else : ?>
                    <?php $cover_photo = get_field('header_logo', 'option'); ?>
                    <img class="cover-photo cover-photo--logo" src="<?= esc_url($cover_photo['url']) ?>" alt="Volos-Voyage - <?php the_title(); ?>">
                <?php endif;  ?>
                <?php if (has_post_thumbnail()) : ?>
                    <div class="profile-photo__container">
                        <img class="profile-photo" src="<?php the_post_thumbnail_url('large') ?>" alt="Volos-Voyage - <?php the_title(); ?>">
                    </div>
                <?php endif;  ?>
            </div>
            <div class="single-title__container container container--medium">
                <h1 class="section-title section-title--single">
                    <?php the_title(); ?>
                    <?php foreach ($categories as $category) : ?>
                        <?php if (strpos($category, '-categories') !== false) : ?>
                            <?php $terms = get_the_terms(get_the_ID(), $category); ?>
                            <?php if ($terms && !is_wp_error($terms)) : ?>
                                <?php foreach ($terms as $term) : ?>
                                    <span class="single-category"><?= $term->name; ?></span>
                                <?php endforeach ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endforeach;  ?>
                </h1>
                <ul class="single-details">
                    <li class="single-details__item single-details__item--address">
                        <a href="#!" target="_blank" rel="noreferrer noopener" class="address-link">
                            <span class="icon icon--x-small"><?= file_get_contents(get_stylesheet_directory() . '/assets/images/location-pin.svg') ?></span>
                            <?= $address; ?>
                        </a>
                    </li>
                </ul>
            </div>
        </header>
        <section class="single-content__content container container--medium">
            <div class="section-title__container">
                <h2 class="section-title"><?php pll_e('Σχετικά με εμάς'); ?> </h2>
            </div>
            <?php the_content();  ?>
        </section>
        <footer class="single-content__footer">
            <!-- Contact details -->
        </footer>
    </article>
</main>