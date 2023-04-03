<?php
$current_user = wp_get_current_user();
isset($_GET['store_id']) && !empty($_GET['store_id']) ? $post_id = $_GET['store_id'] : $post_id = null;
isset($_GET['type']) && !empty($_GET['type']) ? $type = $_GET['type'] : $type = null;
isset($_GET['edit_mode']) && !empty($_GET['edit_mode']) ? $edit_mode = intval($_GET['edit_mode']) : $edit_mode = 0;
if ($post_id || $type || $edit_mode) {
    if ($current_user->ID !== intval(get_field('user_id', $post_id))) {
        wp_die('Unauthorized');
    }
}
?>
<div class="store-form__header">
    <?php if ($post_id) : ?>
        <h2 class="subsection-title"><?php pll_e('Επεξεργαστείτε τα στοιχεία της επιχείρησής σας'); ?></h2>
    <?php else : ?>
        <h3 class="section-subtitle section-subtitle--dashboard"><?php pll_e('Βήμα 2ο') ?></h3>
        <h2 class="subsection-title"><?php pll_e('Συμπληρώστε τα στοιχεία της επιχείρησής σας'); ?></h2>
    <?php endif; ?>
</div>
<form id="custom-hotel-form" class="form form--fluid" method="post" enctype="multipart/form-data" action="<?php echo esc_url(get_permalink()); ?>">
    <?php if ($edit_mode) :  ?>
        <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
        <input type="hidden" name="edit_mode" value="1">
    <?php endif; ?>
    <input type="hidden" name="uuid" value="<?= $current_user->ID ?>">
    <input type="hidden" name="post-type" value="hotels">
    <div class="form-row form-row--col">
        <label for="title"><?php pll_e('Τίτλος'); ?></label>
        <input class="input" type="text" value="<?= $post_id && $edit_mode ? get_the_title($post_id) : "" ?>" name="title" id="title" required>
    </div>
    <div class="form-row form-row--col">
        <label for="description"><?php pll_e('Περιγραφή'); ?></label>
        <textarea class="input" name="description" id="description" cols="30" rows="10" required><?= $post_id && $edit_mode ? get_post_field('post_content', $post_id) : "" ?></textarea>
    </div>
    <div class="form-row form-row--col">
        <label for="logo"><?php pll_e('Εικόνα προφίλ / Λογότυπο'); ?></label>
        <label for="logo" class="label--file input pointer"><?php pll_e('Προσθήκη') ?></label>
        <input class="input input--file" type="file" name="logo" id="logo" accept="image/*" />
        <div class="preview-logo__container">
            <?php if ($post_id && has_post_thumbnail($post_id)) : ?>
                <img src="<?= get_the_post_thumbnail_url($post_id, 'medium') ?>" alt="<?php the_title(); ?>">
            <?php endif; ?>
        </div>
    </div>
    <div class="form-row form-row--col">
        <input type="hidden" name="taxonomy" value="hotel-categories">
        <label for="cat"><?php pll_e('Κατηγορίες'); ?></label>
        <?php
        if ($post_id && $edit_mode) :
            $selected_category = ''; // initialize variable to hold the selected category
            $categories = get_the_terms($post_id, 'hotel-categories'); // get the categories for the post
            if ($categories && !is_wp_error($categories)) {
                $category_ids = wp_list_pluck($categories, 'term_id'); // get the IDs of the categories
                $args = array(
                    'taxonomy' => 'hotel-categories',
                    'orderby' => 'name',
                    'hide_empty' => false,
                    'class' => 'hotel-categories',
                    'echo' => false,
                    'selected' => $category_ids[0] // set the selected category to the first one in the list
                );
                $categories = wp_dropdown_categories($args); // generate the dropdown menu
                $selected_category = ' selected="selected"'; // set the selected attribute
            }
            $categories = str_replace('id=', 'class="" id=', $categories); // replace the id attribute with a class
            $categories = str_replace('<option value="' . $category_ids[0] . '">', '<option value="' . $category_ids[0] . '"' . $selected_category . '>', $categories); // add the selected attribute to the first category
        else :
            $args = array(
                'taxonomy' => 'hotel-categories',
                'orderby' => 'name',
                'hide_empty' => false,
                'class' => 'hotel-categories',
                'echo' => false
            );
            $categories = wp_dropdown_categories($args);
            $categories = str_replace('id=', 'class="" id=', $categories);
        endif;
        echo $categories;
        ?>
    </div>
    <div class="form-row">
        <div class="form-row form-row--col">
            <label for="address"><?php pll_e('Διεύθυνση'); ?></label>
            <input class="input" type="text" name="address" id="address" value="<?= $post_id && $edit_mode ? get_field('address', $post_id) : "" ?>" required>
        </div>
    </div>
    <div class="form-row form-row--col">
        <div class="acf-label">
            <label for="coordinates"><?php pll_e('Συντεταγμένες'); ?></label>
            <p class="description">
                <?php pll_e('Στην διεύθυνση <a href="https://maps.google.com" target="_blank" rel="noopener">maps.google.com</a>, βάλτε την διεύθυνσή σας και πατήστε δεξί click στο location pin που σας εμφανίζει. Οι τιμές σε μορφή "23,502934, 23,5035525" είναι οι συντεταγμένες της επιχείρησής σας. Αριστερό κλικ σε αυτές για αντιγραφή και έπειτα κάντε επικόλληση εδώ.') ?>
            </p>
        </div>
        <input class="input" type="text" name="coordinates" id="coordinates" value="<?= $post_id && $edit_mode ? get_field('coordinates', $post_id) : "" ?>" required>
    </div>
    <div class="form-row form-row--col">
        <label for="gallery"><?php pll_e('Προσθήκη φωτογραφιών'); ?></label>
        <label for="gallery" class="label--file input pointer"><?php pll_e('Προσθήκη') ?></label>
        <input class="input input--file" type="file" name="gallery[]" id="gallery" multiple accept="image/*" max="5" />
        <div class="preview-gallery__container">
            <?php if ($post_id && $edit_mode && get_field('gallery', $post_id)) : ?>
                <?php $gallery = get_field('gallery', $post_id); ?>
                <?php foreach ($gallery as $image) : ?>
                    <img src="<?= esc_url($image['sizes']['medium']) ?>" alt="<?php the_title(); ?>">
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="form-row">
        <div class="form-row form-row--col">
            <label for="emails"><?php pll_e('Διευθύνσεις email') ?></label>
            <div id="emails-container">
                <?php if ($post_id && $edit_mode && have_rows('emails', $post_id)) : ?>
                    <?php while (have_rows('emails', $post_id)) : the_row(); ?>
                        <div class="email-row">
                            <input class="input" value="<?php the_sub_field('email'); ?>" type="email" name="emails[]" required>
                            <?php if (get_row_index() > 1) : ?>
                                <span class="remove-input icon icon--medium icon--delete pointer">
                                    <?= file_get_contents(get_stylesheet_directory() . '/assets/images/remove.svg') ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                <?php else : ?>
                    <div class="email-row">
                        <input class="input" type="email" name="emails[]" required>
                    </div>
                <?php endif; ?>
            </div>
            <span id="add-email" class="add-input icon icon--medium icon--add pointer">
                <?= file_get_contents(get_stylesheet_directory() . '/assets/images/add.svg'); ?>
            </span>
        </div>
        <div class="form-row form-row--col">
            <label for="tels"><?php pll_e('Αριθμοί τηλεφώνου') ?></label>
            <div id="tels-container">
                <?php if ($post_id && $edit_mode && have_rows('tels', $post_id)) : ?>
                    <?php while (have_rows('tels', $post_id)) : the_row(); ?>
                        <div class="tel-row">
                            <input class="input" value="<?php the_sub_field('tel'); ?>" type="tel" name="tels[]" required>
                            <?php if (get_row_index() > 1) : ?>
                                <span class="remove-input icon icon--medium icon--delete pointer">
                                    <?= file_get_contents(get_stylesheet_directory() . '/assets/images/remove.svg') ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                <?php else : ?>
                    <div class="tel-row">
                        <input class="input" type="tel" name="tels[]" required>
                    </div>
                <?php endif; ?>
            </div>
            <span id="add-tel" class="add-input icon icon--medium icon--add pointer">
                <?= file_get_contents(get_stylesheet_directory() . '/assets/images/add.svg'); ?>
            </span>
        </div>
    </div>
    <div class="form-row form-row--col">
        <div class="social-media-row form-row">
            <div class="form-row form-row--col">
                <label for="facebook_url"><?php pll_e('Διεύθυνση Facebook') ?> (URL)</label>
                <input type="url" value="<?= $post_id && $edit_mode ? get_field('facebook_url', $post_id) : "" ?>" class="input" name="facebook_url" id="facebook_url">
            </div>
            <div class="form-row form-row--col">
                <label for="instagram_url"><?php pll_e('Διεύθυνση Instagram') ?> (URL)</label>
                <input type="url" value="<?= $post_id && $edit_mode ? get_field('instagram_url', $post_id) : "" ?>" class="input" name="instagram_url" id="instagram_url">
            </div>
            <div class="form-row form-row--col">
                <label for="tiktok_url"><?php pll_e('Διεύθυνση TikTok') ?> (URL)</label>
                <input type="url" value="<?= $post_id && $edit_mode ? get_field('tiktok_url', $post_id) : "" ?>" class="input" name="tiktok_url" id="tiktok_url">
            </div>
            <div class="form-row form-row--col">
                <label for="tripadvisor_url"><?php pll_e('Διεύθυνση Tripadvisor') ?> (URL)</label>
                <input type="url" value="<?= $post_id && $edit_mode ? get_field('tripadvisor_url', $post_id) : "" ?>" class="input" name="tripadvisor_url" id="tripadvisor_url">
            </div>
            <div class="form-row form-row--col">
                <label for="booking_url"><?php pll_e('Διεύθυνση Booking') ?> (URL)</label>
                <input type="url" value="<?= $post_id && $edit_mode ? get_field('booking_url', $post_id) : "" ?>" class="input" name="booking_url" id="booking_url">
            </div>
        </div>
    </div>
    <div class="form-row form-row--col">
        <label for="website"><?php pll_e('Ιστοσελίδα') ?> (URL)</label>
        <input class="input" type="url" name="website" id="website" value="<?= $post_id && $edit_mode ? get_field('website', $post_id) : "" ?>">
    </div>
    <input type="hidden" name="action" value="submit_custom_store_form">
    <?php wp_nonce_field('submit_custom_store_form', 'custom_store_form_nonce'); ?>
    <input type="submit" class="btn input pointer" value="<?php pll_e('Καταχώρηση') ?>">
</form>