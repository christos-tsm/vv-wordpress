<?php
add_action('wp_ajax_filter_cpt', 'filter_cpt');
add_action('wp_ajax_nopriv_filter_cpt', 'filter_cpt');

function filter_cpt() {
    $category_id = $_GET['category'];
    $post_type = $_GET['post_type'];
    $taxonomy = $_GET['taxonomy'];
    if ($category_id == "-1") {
        $args = array(
            'post_type' => $post_type,
            'posts_per_page' => -1
        );
    } else {
        $args = array(
            'post_type' => $post_type,
            'tax_query' => array(
                array(
                    'taxonomy' => $taxonomy,
                    'field' => 'term_id',
                    'terms' => $category_id
                )
            ),
            'posts_per_page' => -1
        );
    }
    $query = new WP_Query($args);
    ob_start();
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            get_template_part('template-parts/archive/content-archive');
        }
    } else {
        echo '<div class="loading-spinner__container"><span class="loader"></span></div><p class="message message--error">Δεν βρέθηκαν αποτελέσματα</p>';
    }
    wp_reset_postdata();
    $content = ob_get_clean();
    echo $content;
    wp_reset_postdata();
    wp_die();
}
