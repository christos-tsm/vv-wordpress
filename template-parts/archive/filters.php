<?php
// Extract the categories variable from the query variables
extract(get_query_var('categories'));
?>
<aside class="archive__filters">
    <div class="archive__categories">
        <ul>
            <li><a href="#!">Όλες οι κατηγορίες</a></li>
            <?php foreach ($categories as $category) : ?>
                <li><a href="<?= esc_url(get_term_link($category)) ?>"><?= esc_attr($category->name); ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</aside>