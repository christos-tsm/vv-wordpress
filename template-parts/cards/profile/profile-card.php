<?php
$current_user_id = get_current_user_id();
$profile_user_id = intval(get_field('user_id'));
$featured_image = get_field('featured_image');
$business_logo = get_field('logo');
$business_title = get_field('business_title');
$business_description = get_field('business_content');
$address = get_field('address');
$municipalities = get_field('municipality');
if (strlen($business_description) > 350) {
    $short_description = substr($business_description, 0, 350) . '...';
} else {
    $short_description = $business_description;
}
?>
<article class="store-card store-card__<?= get_the_ID() ?>">
    <?php $post_status = get_post_status(get_the_ID()); ?>
    <?php if ($post_status === 'draft') : ?>
        <span class="badge badge--draft"><?php _e('Εκκρεμεί έγκριση') ?></span>
    <?php endif; ?>
    <?php if ($business_logo) : ?>
        <a class="store-card__thumbnail-link" aria-label="Link for <?php the_title(); ?> page" href="<?php the_permalink(); ?>">
            <img class="store-card__thumbnail" src="<?= esc_url($business_logo['sizes']['medium']) ?>" alt="<?php the_title(); ?>">
        </a>
    <?php else : ?>
        <?php $logo = get_field('header_logo', 'option'); ?>
        <a class="store-card__thumbnail-link" aria-label="Link for <?php the_title(); ?> page" href="<?php the_permalink(); ?>">
            <img class="store-card__thumbnail" src="<?= esc_url($logo['url']) ?>" alt="<?php the_title(); ?>">
        </a>
    <?php endif; ?>
    <div class="store-card__details">
        <h3 class="store-card__title">
            <a href="<?php the_permalink(); ?>"><?= $business_title; ?></a>
            <?php if ($current_user_id === $profile_user_id) : ?>
                <div class="store-card__actions">
                    <?php $update_profile_page = get_post(339); ?>
                    <form method="POST" id="delete-profile-form" action="<?= esc_url(admin_url('admin-post.php')); ?>">
                        <input type="hidden" name="action" value="delete_user_profile">
                        <input type="hidden" name="user_id" value="<?= get_field('user_id') ?>">
                        <input type="hidden" name="delete_profile_nonce" value="<?= wp_create_nonce('delete_profile_nonce'); ?>">
                        <input type="hidden" name="profile_id" value="<?= esc_attr(get_the_ID()); ?>">
                        <button id="delete-profile-button" class="btn input pointer btn--delete" type="submit">Delete Profile</button>
                    </form>
                    <?php if ($post_status === 'publish') : ?>
                        <a href="<?php the_permalink($update_profile_page) ?>?profile_id=<?= get_the_ID(); ?>&edit_mode=1" class="btn btn--small input"><?php _e('Επεξεργασία') ?></a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </h3>
        <p class="store-card__description"><?= $short_description; ?></p>
        <footer class="store-card__footer">
            <address class="store-card__address">
                <span class=" icon icon--x-small">
                    <?= file_get_contents(get_stylesheet_directory() . '/assets/images/location-pin.svg'); ?>
                </span>
                <a class="address-link" href="#!" target="_blank" rel="noreferrer noopener">
                    <?= esc_attr($address); ?>,
                    <?php foreach ($municipalities as $municipality) : ?>
                        <?= esc_attr($municipality->post_title); ?>
                    <?php endforeach; ?>
                </a>
            </address>
        </footer>
    </div>
</article>