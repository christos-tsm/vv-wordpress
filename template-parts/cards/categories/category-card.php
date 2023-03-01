<?php
$icon = get_sub_field('icon');
$link = get_sub_field('link');
?>
<div class="categories-cards__single">
    <?php if ($link) : ?>
        <a class="categories-cards__title" href="<?= esc_url($link['url']); ?>">
            <?php if ($icon) : ?>
                <span class="icon icon--medium"><?= file_get_contents($icon['url']) ?></span>
            <?php endif; ?>
            <?= esc_html($link['title']);  ?>
        </a>
    <?php endif; ?>
</div>