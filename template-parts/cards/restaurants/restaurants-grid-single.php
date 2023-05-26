<?php $categories = get_post_taxonomies(get_the_ID()); ?>
<div class="grid--restaurants__single grid--restaurants__single-<?= get_the_ID(); ?>">
    <div class="grid--restaurants__logo">
        <?php get_template_part('template-parts/premium/premium-badge'); ?>
        <?php if (has_post_thumbnail()) : ?>
            <a href="<?php the_permalink(); ?>">
                <img src="<?php the_post_thumbnail_url('medium_large'); ?>" alt="<?php the_title(); ?>">
            </a>
        <?php else : ?>
            <?php $logo = get_field('header_logo', 'option'); ?>
            <a href="<?php the_permalink(); ?>">
                <img src="<?= esc_url($logo['url']) ?>" alt="<?php the_title(); ?>">
            </a>
        <?php endif; ?>
    </div>
    <div class="grid--restaurants__content">
        <h3 class="grid--restaurants__title">
            <a href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
            </a>
        </h3>
        <ul class="grid--restaurants__details">
            <li class="grid--restaurants__details-item">
                <span class="icon icon--x-small"><?= file_get_contents(get_stylesheet_directory() . '/assets/images/info.svg') ?></span>
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
            </li>
            <li class="grid--restaurants__details-item">
                <span class="icon icon--x-small"><?= file_get_contents(get_stylesheet_directory() . '/assets/images/location-pin.svg') ?></span>
                <?php the_field('address'); ?>
            </li>
        </ul>
    </div>
</div>