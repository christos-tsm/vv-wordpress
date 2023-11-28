<?php
$search_results_page = get_post(1040);
$profile_category = isset($_GET['profile_category']) ? $_GET['profile_category'] : '';
$profile_categories = get_terms(array(
    'taxonomy' => 'freelancer-categories',
    'hide_empty' => true
));
?>
<?php if (!empty($profile_categories) && !is_wp_error($profile_categories)) : ?>
    <form method="GET" id="freelancers-search" action="<?php the_permalink($search_results_page); ?>">
        <div class="form-row">
            <select class="input pointer" name="profile_category" id="profile_category">
                <?php foreach ($profile_categories as $term) : ?>
                    <?php $selected = ($term->slug == $profile_category) ? 'selected' : '';  ?>
                    <option value="<?= $term->slug ?>" <?= $selected ?>><?= $term->name ?></option>
                <?php endforeach;  ?>
            </select>
            <?php get_template_part('template-parts/forms/municipality-areas-header') ?>
            <button class="input btn pointer" type="submit"><?php _e('Αναζήτηση'); ?></button>
        </div>
    </form>
<?php endif;  ?>