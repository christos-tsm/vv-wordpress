<?php
$current_user_id = get_current_user_id();
$profile_user_id = intval(get_field('user_id'));
$featured_image = get_field('featured_image');
$business_title = get_field('business_title');
$business_description = get_field('business_content');
$address = get_field('address');
$municipality = get_field('municipality');
if (strlen($business_description) > 350) {
    $short_description = substr($business_description, 0, 350) . '...';
} else {
    $short_description = $business_description;
}
?>
<article class="profile-card profile-card__<?= get_the_ID() ?>">
    <?php $post_status = get_post_status(get_the_ID()); ?>
    <?php if ($post_status === 'draft') : ?>
        <span class="badge badge--draft"><?php pll_e('Εκκρεμεί έγκριση') ?></span>
    <?php endif; ?>
    <?php if ($featured_image) : ?>
        <a class="profile-card__thumbnail-link" aria-label="Link for <?php the_title(); ?> page" href="<?php the_permalink(); ?>">
            <img class="profile-card__thumbnail" src="<?= esc_url($featured_image['url']) ?>" alt="<?php the_title(); ?>">
        </a>
    <?php else : ?>
        <?php $logo = get_field('header_logo', 'option'); ?>
        <a class="profile-card__thumbnail-link" aria-label="Link for <?php the_title(); ?> page" href="<?php the_permalink(); ?>">
            <img class="profile-card__thumbnail" src="<?= esc_url($logo['url']) ?>" alt="<?php the_title(); ?>">
        </a>
    <?php endif; ?>
    <div class="profile-card__details">
        <h3 class="profile-card__title">
            <a href="<?php the_permalink(); ?>"><?= $business_title; ?></a>
            <?php if ($current_user_id === $profile_user_id) : ?>
                <?php $update_profile_page = pll_get_post(339); ?>
                <a href="<?php the_permalink($update_profile_page) ?>?profile_id=<?= get_the_ID(); ?>&edit_mode=1" class="btn btn--small input"><?php pll_e('Επεξεργασία') ?></a>
            <?php endif; ?>
        </h3>
        <p class="profile-card__description"><?= $short_description; ?></p>
        <footer class="profile-card__footer">
            <address class="profile-card__address">
                <span class=" icon icon--x-small">
                    <?= file_get_contents(get_stylesheet_directory() . '/assets/images/location-pin.svg'); ?>
                </span>
                <?= esc_attr($address); ?>
            </address>
        </footer>
    </div>
</article>