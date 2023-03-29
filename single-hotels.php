<?php
get_header();
$gallery = get_field('gallery');
$address = get_field('address');
$coordinates = get_field('coordinates');
$website = get_field('website');
$distance = get_field('distance_from_city_center');
$avg_prce = get_field('average_price');
?>
<main class="site-main site-main--single">
    <section class="single-header container container--medium">
        <h1 class="section-title"><?php the_title(); ?></h1>
        <div class="single-header__actions">
            <a aria-label="Add <?php the_title(); ?> to your favourites" href="#!" class="icon icon--medium icon--add-to-favourites">
                <?= file_get_contents(get_stylesheet_directory() . '/assets/images/heart.svg'); ?>
            </a>
            <a aria-label="Share about <?php the_title(); ?>" href="#!" class="icon icon--medium icon--share">
                <?= file_get_contents(get_stylesheet_directory() . '/assets/images/share.svg'); ?>
            </a>
        </div>
    </section>
    <div class="single-description container container--medium">
        <div class="single-description__text">
            <?php the_content(); ?>
        </div>
    </div>
    <?php if ($gallery && !empty($gallery)) : ?>
        <div class="single-gallery container container--medium">
            <?php foreach ($gallery as $image) : ?>
                <a class="single-gallery__item-link" aria-label="Open gallery lightbox" data-fslightbox="gallery" href="<?= esc_url($image['url']) ?>">
                    <img class="single-gallery__item-image" src="<?= esc_url($image['sizes']['large']) ?>" alt="<?php the_title(); ?> image">
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <section class="single-info container container--medium">
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
            <?php if (have_rows('social_media')) : ?>
                <div class="single-info__card-section">
                    <h2 class="section-subtitle"><?php pll_e('Social Media') ?></h2>
                    <ul class="single-info__ul">
                        <?php while (have_rows('social_media')) : the_row(); ?>
                            <li class="single-info__ul-item">
                                <a class="single-info__ul-link icon icon--medium" href="<?= esc_url(get_sub_field('url')); ?>">
                                    <span class="icon icon--small">
                                        <?= file_get_contents(get_stylesheet_directory() . '/assets/images/at.svg'); ?>
                                    </span>
                                    <?= esc_attr(get_sub_field('title')); ?>
                                </a>
                            </li>
                        <?php endwhile; ?>
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
    </section>
</main>
<?php get_footer(); ?>