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
        <h2 class="subsection-title"><?php pll_e('Επεξεργαστείτε τα στοιχεία σας'); ?></h2>
    <?php else : ?>
        <h3 class="section-subtitle section-subtitle--dashboard"><?php pll_e('Βήμα 2ο') ?></h3>
        <h2 class="subsection-title"><?php pll_e('Συμπληρώστε τα στοιχεία σας'); ?></h2>
    <?php endif; ?>
</div>
<form id="custom-freelancer-form" class="form form--fluid" method="post" enctype="multipart/form-data" action="<?php echo esc_url(get_permalink()); ?>">
    <?php if ($edit_mode) : ?>
        <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
        <input type="hidden" name="edit_mode" value="1">
    <?php endif; ?>
    <input type="hidden" name="uuid" value="<?= $current_user->ID ?>">
    <input type="hidden" name="post-type" value="freelancers">
    <div class="form-row form-row--col">
        <label for="title"><?php pll_e('Τίτλος'); ?></label>
        <input class="input" type="text" value="<?= $post_id && $edit_mode ? get_the_title($post_id) : "" ?>" name="title" id="title" required>
    </div>
    <div class="form-row form-row--col">
        <label for="description"><?php pll_e('Περιγραφή'); ?></label>
        <textarea class="input" name="description" id="description" cols="30" rows="10" required><?= $post_id && $edit_mode ? get_post_field('post_content', $post_id) : "" ?></textarea>
    </div>
    <div class="form-row form-row--col">
        <label for="municipality"><?php pll_e('Περιοχή'); ?></label>
        <select name="municipality" id="municipality">
            <option <?= get_field('municipality', $post_id) === 'volos' ? "selected" : "" ?> value="volos">Βόλος</option>
            <option <?= get_field('municipality', $post_id) === 'nea-anchialos' ? "selected" : "" ?> value="nea-anchialos">Νέα Αγχίαλος</option>
            <option <?= get_field('municipality', $post_id) === 'agria' ? "selected" : "" ?> value="agria">Αγριά</option>
            <option <?= get_field('municipality', $post_id) === 'anakasia' ? "selected" : "" ?> value="anakasia">Ανακασιά</option>
            <option <?= get_field('municipality', $post_id) === 'artemida' ? "selected" : "" ?> value="artemida">Αρτεμίδα</option>
            <option <?= get_field('municipality', $post_id) === 'kato-lechonia' ? "selected" : "" ?> value="kato-lechonia">Κάτω Λεχώνια</option>
            <option <?= get_field('municipality', $post_id) === 'ano-lechonia' ? "selected" : "" ?> value="ano-lechonia">Άνω Λεχώνια</option>
            <option <?= get_field('municipality', $post_id) === 'makrinitsa' ? "selected" : "" ?> value="makrinitsa">Μακρινίτσα</option>
            <option <?= get_field('municipality', $post_id) === 'portaria' ? "selected" : "" ?> value="portaria">Πορταριά</option>
            <option <?= get_field('municipality', $post_id) === 'nea-ionia' ? "selected" : "" ?> value="nea-ionia">Νέα Ιωνία</option>
            <option <?= get_field('municipality', $post_id) === 'almiros' ? "selected" : "" ?> value="almiros">Αλμυρός</option>
            <option <?= get_field('municipality', $post_id) === 'kala-nera' ? "selected" : "" ?> value="kala-nera">Καλά Νερά</option>
            <option <?= get_field('municipality', $post_id) === 'afissos' ? "selected" : "" ?> value="afissos">Αφυσσος</option>
            <option <?= get_field('municipality', $post_id) === 'milies' ? "selected" : "" ?> value="milies">Μηλιές</option>
            <option <?= get_field('municipality', $post_id) === 'tsagarada' ? "selected" : "" ?> value="tsagarada">Τσαγκαράδα</option>
            <option <?= get_field('municipality', $post_id) === 'zagora' ? "selected" : "" ?> value="zagora">Ζαγορά</option>
            <option <?= get_field('municipality', $post_id) === 'choropi' ? "selected" : "" ?> value="choropi">Χορόπη</option>
            <option <?= get_field('municipality', $post_id) === 'alykes' ? "selected" : "" ?> value="alykes">Αλυκές</option>
            <option <?= get_field('municipality', $post_id) === 'platanidia' ? "selected" : "" ?> value="platanidia">Πλατανίδια</option>
            <option <?= get_field('municipality', $post_id) === 'koropi' ? "selected" : "" ?> value="koropi">Κορόπη</option>
        </select>
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
        <input type="hidden" name="taxonomy" value="freelancer-categories">
        <label for="cat"><?php pll_e('Κατηγορίες'); ?></label>
        <?php
        if ($post_id && $edit_mode) :
            $selected_category = ''; // initialize variable to hold the selected category
            $categories = get_the_terms($post_id, 'freelancer-categories'); // get the categories for the post
            if ($categories && !is_wp_error($categories)) {
                $category_ids = wp_list_pluck($categories, 'term_id'); // get the IDs of the categories
                $args = array(
                    'taxonomy' => 'freelancer-categories',
                    'orderby' => 'name',
                    'hide_empty' => false,
                    'class' => 'freelancer-categories',
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
                'taxonomy' => 'freelancer-categories',
                'orderby' => 'name',
                'hide_empty' => false,
                'class' => 'freelancer-categories',
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