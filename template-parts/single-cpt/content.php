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
                    <?php endforeach; ?>
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
            <div class="single-content">
                <?php the_content();  ?>
            </div>
            <?php if ($gallery) : ?>
                <div class="single-content__gallery">
                    <?php foreach ($gallery as $image) :  ?>
                        <a class="single-content__gallery-link" aria-label="Open gallery lightbox" data-fslightbox="gallery" href="<?= esc_url($image['url']) ?>">
                            <img class="single-content__gallery-image" src="<?= esc_url($image['sizes']['large']) ?>" alt="<?php the_title(); ?> image">
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
        <footer class="single-content__footer container container--medium">
            <div class="single-info__card">
                <?php if (have_rows('emails') || have_rows('tels')) : ?>
                    <div class="single-info__card-section">
                        <h2 class="section-subtitle"><?php pll_e('Επικοινωνία') ?></h2>
                        <ul class="single-info__ul">
                            <?php if (have_rows('emails')) : ?>
                                <?php while (have_rows('emails')) : the_row(); ?>
                                    <?php $email = antispambot(get_sub_field('email')); ?>
                                    <li class="single-info__ul-item">
                                        <a class="single-info__ul-link" href="mailto:<?= $email; ?>">
                                            <span class="icon icon--small"><?= file_get_contents(get_stylesheet_directory() . '/assets/images/email.svg') ?></span>
                                            <?php the_sub_field('email'); ?>
                                        </a>
                                    </li>
                                <?php endwhile; ?>
                            <?php endif; ?>
                            <?php if (have_rows('tels')) : ?>
                                <?php while (have_rows('tels')) : the_row(); ?>
                                    <?php $tel_url = preg_replace("/\s+/", "", get_sub_field('tel')); ?>
                                    <li class="single-info__ul-item">
                                        <a class="single-info__ul-link" href="tel:+30<?= $tel_url; ?>">
                                            <span class="icon icon--small"><?= file_get_contents(get_stylesheet_directory() . '/assets/images/phone.svg') ?></span>
                                            <?php the_sub_field('tel'); ?>
                                        </a>
                                    </li>
                                <?php endwhile; ?>
                            <?php endif; ?>
                            <?php if ($website && !empty($website)) : ?>
                                <li class="single-info__ul-item">
                                    <a class="single-info__ul-link" href="<?= esc_url($website) ?>" target="_blank" rel="noopener">
                                        <span class="icon icon--small"><?= file_get_contents(get_stylesheet_directory() . '/assets/images/globe.svg') ?></span>
                                        <?php pll_e('Ιστοσελίδα') ?>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <?php if ($facebook_url || $instagram_url || $tiktok_url || $tripadvisor_url || $booking_url) : ?>
                    <div class="single-info__card-section">
                        <h2 class="section-subtitle"><?php pll_e('Social Media') ?></h2>
                        <ul class="single-info__ul single-social-media__ul">
                            <?php if ($facebook_url) : ?>
                                <li class="single-info__ul-item">
                                    <a class="single-info__ul-link icon icon--medium" target="_blank" rel="noopener" href="<?= esc_url($facebook_url); ?>">
                                        <span class="icon icon--small">
                                            <?= file_get_contents(get_stylesheet_directory() . '/assets/images/at.svg'); ?>
                                        </span>
                                        <?php pll_e('Facebook'); ?>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if ($instagram_url) : ?>
                                <li class="single-info__ul-item">
                                    <a class="single-info__ul-link icon icon--medium" target="_blank" rel="noopener" href="<?= esc_url($instagram_url); ?>">
                                        <span class="icon icon--small">
                                            <?= file_get_contents(get_stylesheet_directory() . '/assets/images/at.svg'); ?>
                                        </span>
                                        <?php pll_e('Instagram'); ?>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if ($tiktok_url) : ?>
                                <li class="single-info__ul-item">
                                    <a class="single-info__ul-link icon icon--medium" target="_blank" rel="noopener" href="<?= esc_url($tiktok_url); ?>">
                                        <span class="icon icon--small">
                                            <?= file_get_contents(get_stylesheet_directory() . '/assets/images/at.svg'); ?>
                                        </span>
                                        <?php pll_e('Tiktok'); ?>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if ($tripadvisor_url) : ?>
                                <li class="single-info__ul-item">
                                    <a class="single-info__ul-link icon icon--medium" target="_blank" rel="noopener" href="<?= esc_url($tripadvisor_url); ?>">
                                        <span class="icon icon--small">
                                            <?= file_get_contents(get_stylesheet_directory() . '/assets/images/at.svg'); ?>
                                        </span>
                                        <?php pll_e('Trip Advisor'); ?>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if ($booking_url) : ?>
                                <li class="single-info__ul-item">
                                    <a class="single-info__ul-link icon icon--medium" target="_blank" rel="noopener" href="<?= esc_url($booking_url); ?>">
                                        <span class="icon icon--small">
                                            <?= file_get_contents(get_stylesheet_directory() . '/assets/images/at.svg'); ?>
                                        </span>
                                        <?php pll_e('Booking'); ?>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <?php if ($address && !empty($address)) : ?>
                    <div class="single-info__card-section">
                        <h2 class="section-subtitle"><?php pll_e('Διεύθυνση') ?></h2>
                        <ul class="single-info__ul">
                            <li class="single-info__ul-item">
                                <a class="single-info__ul-link icon icon--medium address-link" target="_blank" rel="noopener noreferrer" href="#!">
                                    <span class="icon icon--small">
                                        <?= file_get_contents(get_stylesheet_directory() . '/assets/images/location-pin.svg'); ?>
                                    </span>
                                    <?= esc_attr($address); ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                <?php endif; ?>
                <?php if ($distance && !empty($distance) || $avg_prce && !empty($avg_prce)) : ?>
                    <div class="single-info__card-section">
                        <h2 class="section-subtitle"><?php pll_e('Πληροφορίες') ?></h2>
                        <ul class="single-info__ul">
                            <?php if ($distance && !empty($distance)) : ?>
                                <li class="single-info__ul-item">
                                    <span class="icon icon--small">
                                        <?= file_get_contents(get_stylesheet_directory() . '/assets/images/location-pin.svg'); ?>
                                    </span>
                                    <?= esc_attr($distance) . ' ' . pll__('από το κέντρο του Βόλου'); ?>
                                </li>
                            <?php endif; ?>
                            <?php if ($avg_prce && !empty($avg_prce)) : ?>
                                <li class="single-info__ul-item">
                                    <span class="icon icon--small">
                                        <?= file_get_contents(get_stylesheet_directory() . '/assets/images/credit-card.svg'); ?>
                                    </span>
                                    <?= esc_attr($avg_prce) ?> &euro;
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
            <div class="single-info__map">
                <h2 class="section-subtitle"><?php pll_e('Τοποθεσία') ?></h2>
                <div id="map" data-coordinates="<?= esc_attr($coordinates); ?>" data-icon="<?= get_stylesheet_directory_uri() . '/assets/images/map-pin.svg' ?>"></div>
            </div>
        </footer>
    </article>
    <div>
        <?php get_template_part('template-parts/single-cpt/related-events'); ?>
    </div>
</main>