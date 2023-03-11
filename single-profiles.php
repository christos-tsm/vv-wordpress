<?php
get_header();
$post_status = get_post_status(get_the_ID());
$thumbnail = get_field('featured_image');
$municipalities = get_field('municipality');
$logo = get_field('logo');
?>
<main class="site-main site-main--profile">
    <section class="profile-single__container container container--medium">
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
            <h2 class="profile-single__address">
                <span class="icon icon--small"><?= file_get_contents(get_stylesheet_directory() . '/assets/images/location-pin.svg') ?></span>
                <a href="#!" target="_blank" rel="noreferrer noopener">
                    <?php the_field('address'); ?>,
                    <?php foreach ($municipalities as $municipality) : ?>
                        <?= esc_attr($municipality->post_title); ?>
                    <?php endforeach; ?>
                </a>
            </h2>
        </div>
        <div class="profile-single__content">
            <div class="profile-single__description">
                <p><?php the_field('business_content'); ?></p>
            </div>
        </div>
    </section>
</main>
<?php get_footer(); ?>