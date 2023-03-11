<?php
get_header();
$post_status = get_post_status(get_the_ID());
$thumbnail = get_field('featured_image');
$municipalities = get_field('municipality');
$logo = get_field('logo');
$facebook = get_field('facebook');
$instagram = get_field('instagram');
$tiktok = get_field('tiktok');
$website = get_field('website');
?>
<main class="site-main site-main--profile">
    <section class="profile-single__section profile-single__header-container container container--medium">
        <div class="profile-single__header">
            <?php if ($post_status === 'draft') : ?>
                <span class="badge badge--draft"><?php pll_e('Εκκρεμεί έγκριση') ?></span>
            <?php endif; ?>
            <div class="profile-single__cover">
                <img class="profile-single__cover-image" src="<?= esc_url($thumbnail['sizes']['1536x1536']) ?>" alt="<?php the_title(); ?>">
            </div>
            <div class="profile-single__logo">
                <img class="profile-single__logo-image" src="<?= esc_url($logo['sizes']['medium']) ?>" alt="<?php the_title() ?>">
            </div>
            <h1 class="profile-single__title section-title"><?php the_title(); ?></h1>
        </div>
        <div class="profile-single__content">
            <div class="profile-single__description">
                <p><?php the_field('business_content'); ?></p>
            </div>
        </div>
    </section>
    <section class="profile-single__section profile-single__contact-container container container--medium">
        <div class="profile-single__map">
            <div class="section-title__container">
                <h2 class="section-title"><?php pll_e('Τοποθεσία'); ?></h2>
            </div>
            <h3 class="profile-single__address">
                <a href="#!" target="_blank" rel="noreferrer noopener">
                    <span class="icon icon--small"><?= file_get_contents(get_stylesheet_directory() . '/assets/images/location-pin.svg') ?></span>
                    <?php the_field('address'); ?>,
                    <?php foreach ($municipalities as $municipality) : ?>
                        <?= esc_attr($municipality->post_title); ?>
                    <?php endforeach; ?>
                </a>
            </h3>
            <div id="map" data-icon="<?= get_stylesheet_directory_uri() . '/assets/images/map-pin.svg' ?>" data-coordinates="<?php the_field('coordinates'); ?>"></div>
        </div>
        <div class="profile-single__details">
            <div class="section-title__container">
                <h2 class="section-title"><?php pll_e('Επικοινωνία'); ?></h2>
            </div>
            <div class="profile-single__contact-links">
                <?php if (have_rows('business_emails')) :  ?>
                    <ul class="profile-single__list">
                        <?php while (have_rows('business_emails')) : the_row(); ?>
                            <li class="profile-single__list-item">
                                <a href="mailto:<?php the_sub_field('email') ?>">
                                    <span class="icon icon--small">
                                        <?= file_get_contents(get_stylesheet_directory() . '/assets/images/email.svg'); ?>
                                    </span>
                                    <?php the_sub_field('email') ?>
                                </a>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; ?>
                <?php if (have_rows('business_tels')) :  ?>
                    <ul class="profile-single__list">
                        <?php while (have_rows('business_tels')) : the_row(); ?>
                            <?php
                            $tel = get_sub_field('tel');
                            $tel_url = preg_replace("/\s+/", "", $tel);
                            ?>
                            <li class="profile-single__list-item">
                                <a href="tel:<?= esc_attr($tel_url) ?>">
                                    <span class="icon icon--small">
                                        <?= file_get_contents(get_stylesheet_directory() . '/assets/images/phone.svg'); ?>
                                    </span>
                                    <?= esc_attr($tel); ?>
                                </a>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; ?>
            </div>
            <?php if ($website) : ?>
                <div class="profile-single__section">
                    <div class="section-title__container">
                        <h2 class="section-title"><?php pll_e('Ιστιότοπος επιχείρησης'); ?></h2>
                    </div>
                    <div class="profile-single__contact-links">
                        <ul class="profile-single__list">
                            <li class="profile-single__list-item">
                                <a href="<?= esc_url($website) ?>" target="_blank" rel="noopener">
                                    <span class="icon icon--small">
                                        <?= file_get_contents(get_stylesheet_directory() . '/assets/images/globe.svg'); ?>
                                    </span>
                                    <?= esc_attr($website); ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
            <?php if ($facebook || $instagram || $tiktok) : ?>
                <div class="profile-single__section">
                    <div class="section-title__container">
                        <h2 class="section-title"><?php pll_e('Κοινωνικά δίκτυα'); ?></h2>
                    </div>
                    <div class="profile-single__contact-links">
                        <ul class="profile-single__list profile-single__list--social-media">
                            <?php if ($facebook) : ?>
                                <li class="profile-single__list-item">
                                    <a href="<?= esc_url($facebook) ?>" target="_blank" rel="noopener">
                                        <span class="icon icon--small">
                                            <?= file_get_contents(get_stylesheet_directory() . '/assets/images/facebook.svg'); ?>
                                        </span>
                                        <?php pll_e('Facebook') ?>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if ($instagram) : ?>
                                <li class="profile-single__list-item">
                                    <a href="<?= esc_url($instagram) ?>" target="_blank" rel="noopener">
                                        <span class="icon icon--small">
                                            <?= file_get_contents(get_stylesheet_directory() . '/assets/images/instagram.svg'); ?>
                                        </span>
                                        <?php pll_e('Instagram') ?>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if ($tiktok) : ?>
                                <li class="profile-single__list-item">
                                    <a href="<?= esc_url($tiktok) ?>" target="_blank" rel="noopener">
                                        <span class="icon icon--small">
                                            <?= file_get_contents(get_stylesheet_directory() . '/assets/images/tiktok.svg'); ?>
                                        </span>
                                        <?php pll_e('Tik Tok') ?>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
    <?php if (have_rows('gallery')) : ?>
        <section class="profile-single__section profile-single__gallery-container container container--medium">
            <div class="section-title__container">
                <h2 class="section-title"><?php pll_e('Φωτογραφίες'); ?></h2>
            </div>
            <div class="profile-single__gallery">
                <?php while (have_rows('gallery')) : the_row(); ?>
                    <?php $image = get_sub_field('image'); ?>
                    <div class="profile-single__gallery-single">
                        <a class="profile-single__gallery-link" aria-label="Open gallery lightbox" data-fslightbox="gallery" href="<?= esc_url($image['url']) ?>">
                            <span class="overlay">
                                <span class="icon icon--medium">
                                    <?= file_get_contents(get_stylesheet_directory() . '/assets/images/external.svg'); ?>
                                </span>
                            </span>
                            <img class="profile-single__gallery-image" src="<?= esc_url($image['sizes']['medium_large']) ?>" alt="<?php the_title(); ?>">
                        </a>
                    </div>
                <?php endwhile; ?>
            </div>
        </section>
    <?php endif; ?>
</main>
<?php get_footer(); ?>