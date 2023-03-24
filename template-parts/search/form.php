<form method="GET" action="<?php echo esc_url(pll_home_url() . 'profiles/'); ?>">
    <div class="form-row">
        <?php
        $terms = get_terms(array(
            'taxonomy' => 'profile-categories',
            'pad_counts' => true,
        ));
        $non_empty_terms = array();
        foreach ($terms as $term) :
            if ($term->count > 0) {
                $non_empty_terms[] = $term;
            }
        endforeach;
        $args = array(
            'post_type' => 'municipalities',
            'posts_per_page' => -1
        );
        $municipalities = new WP_Query($args);
        ?>
        <select class="input pointer" name="profile_category" id="profile_category">
            <?php foreach ($non_empty_terms as $term) : ?>
                <?php if (isset($_GET['profile_category'])  && !empty($_GET['profile_category']) && intval($_GET['profile_category']) === $term->term_id) : ?>
                    <option selected value="<?= esc_attr($term->term_id) ?>"><?= esc_attr($term->name); ?></option>
                <?php else : ?>
                    <option value="<?= esc_attr($term->term_id) ?>"><?= esc_attr($term->name); ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>
        <select class="input pointer" name="municipality" id="municipality">
            <?php if ($municipalities->have_posts()) : ?>
                <?php while ($municipalities->have_posts()) : $municipalities->the_post(); ?>
                    <?php if (isset($_GET['municipality'])  && !empty($_GET['municipality']) && intval($_GET['municipality']) === get_the_ID()) : ?>
                        <option selected value="<?= get_the_ID() ?>"><?php the_title(); ?></option>
                    <?php else : ?>
                        <option value="<?= get_the_ID() ?>"><?php the_title(); ?></option>
                    <?php endif; ?>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            <?php endif; ?>
        </select>
        <button class="input btn pointer" type="submit"><?php pll_e('Αναζήτηση'); ?></button>
    </div>
</form>