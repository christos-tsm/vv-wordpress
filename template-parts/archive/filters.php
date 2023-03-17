<?php
// Extract the categories variable from the query variables
extract($wp_query->query_vars);
?>
<aside class="archive__filters">
    <div class="archive__categories">
        <ul class="archive__categories-list">
            <li data-id="-1" data-taxonomy="<?= esc_attr($taxonomy); ?>" data-type="<?= $post_type ?>" class="archive__categories-list-item archive__categories-list-item--active"><a href="#!">Όλες οι κατηγορίες</a></li>
            <?php foreach ($categories as $category) : ?>
                <li data-type="<?= $post_type ?>" data-taxonomy="<?= esc_attr($taxonomy); ?>" data-id=" <?= esc_attr($category->term_id) ?>" class="archive__categories-list-item"><a href="<?= esc_url(get_term_link($category)) ?>"><?= esc_attr($category->name); ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</aside>