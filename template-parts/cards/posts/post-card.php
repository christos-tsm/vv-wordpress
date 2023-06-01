<article id="post-<?= get_the_ID(); ?>" class="card card-post">
    <header class="card__header">
        <?php if (has_post_thumbnail()) : ?>
            <a href="<?php the_permalink() ?>">
                <img class="card__thumbnail post-card__thumbnail" src="<?php the_post_thumbnail_url('medium_large'); ?>" alt="<?php the_title(); ?>">
                <?php get_template_part('template-parts/premium/premium-badge'); ?>
            </a>
        <?php else : ?>
            <?php $default = get_field('header_logo', 'options'); ?>
            <a href="<?php the_permalink() ?>">
                <img style="padding: 15px; object-fit: contain;" class="card__thumbnail post-card__thumbnail" src="<?= esc_url($default['url']) ?>" alt="<?php the_title(); ?>">
                <?php get_template_part('template-parts/premium/premium-badge'); ?>
            </a>
        <?php endif; ?>
        <h3 class="card__title post-card__title"> <a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
    </header>
</article>