<?php
$current_user_id = get_current_user_id();
isset($_GET['event_id']) && !empty($_GET['event_id']) ? $post_id = $_GET['event_id'] : $post_id = null;
isset($_GET['type']) && !empty($_GET['type']) ? $type = $_GET['type'] : $type = null;
isset($_GET['edit_mode']) && !empty($_GET['edit_mode']) ? $edit_mode = intval($_GET['edit_mode']) : $edit_mode = 0;
if ($post_id || $type || $edit_mode) {
    if ($current_user_id !== intval(get_field('user_id', $post_id))) {
        wp_die('Unauthorized');
    }
}
?>
<form id="add-event-form" class="form form--fluid" method="post" enctype="multipart/form-data" action="<?php echo esc_url(get_permalink()); ?>">
    <?php if ($edit_mode) :  ?>
        <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
        <input type="hidden" name="edit_mode" value="1">
    <?php endif; ?>
    <input type="hidden" name="uuid" value="<?= $current_user_id ?>">
    <input type="hidden" name="store_id" value="<?= get_field('store_id', $post_id); ?>">
    <input type="hidden" name="post-type" value="events">
    <div class="form-row form-row--col">
        <label for="title"><?php pll_e('Τίτλος εκδήλωσης'); ?></label>
        <input class="input" type="text" value="<?= $post_id && $edit_mode ? get_the_title($post_id) : "" ?>" name="title" id="title" required>
    </div>
    <div class="form-row form-row--col">
        <label for="description"><?php pll_e('Περιγραφή εκδήλωσης'); ?></label>
        <textarea class="input" name="description" id="description" cols="30" rows="10" required><?= $post_id && $edit_mode ? get_post_field('post_content', $post_id) : "" ?></textarea>
    </div>
    <div class="form-row">
        <div class="form-row form-row--col">
            <?php $date = get_field('date', $post_id); ?>
            <label for="date"><?php pll_e('Ημερομηνία'); ?></label>
            <input class="input" type="text" name="date" id="date" value="<?= $date && !empty($date) ? esc_attr($date) : '' ?>">
        </div>
        <div class="form-row form-row--col">
            <label for="time"><?php pll_e('Ώρα'); ?></label>
            <select name="time" id="time">
                <option <?= get_field('time', $post_id) === '07:00' ? 'selected' : '' ?> value="07:00">07:00</option>
                <option <?= get_field('time', $post_id) === '07:15' ? 'selected' : '' ?> value="07:15">07:15</option>
                <option <?= get_field('time', $post_id) === '07:30' ? 'selected' : '' ?> value="07:30">07:30</option>
                <option <?= get_field('time', $post_id) === '07:45' ? 'selected' : '' ?> value="07:45">07:45</option>
                <option <?= get_field('time', $post_id) === '08:00' ? 'selected' : '' ?> value="08:00">08:00</option>
                <option <?= get_field('time', $post_id) === '08:15' ? 'selected' : '' ?> value="08:15">08:15</option>
                <option <?= get_field('time', $post_id) === '08:30' ? 'selected' : '' ?> value="08:30">08:30</option>
                <option <?= get_field('time', $post_id) === '08:45' ? 'selected' : '' ?> value="08:45">08:45</option>
                <option <?= get_field('time', $post_id) === '09:00' ? 'selected' : '' ?> value="09:00">09:00</option>
                <option <?= get_field('time', $post_id) === '09:15' ? 'selected' : '' ?> value="09:15">09:15</option>
                <option <?= get_field('time', $post_id) === '09:30' ? 'selected' : '' ?> value="09:30">09:30</option>
                <option <?= get_field('time', $post_id) === '09:45' ? 'selected' : '' ?> value="09:45">09:45</option>
                <option <?= get_field('time', $post_id) === '10:00' ? 'selected' : '' ?> value="10:00">10:00</option>
                <option <?= get_field('time', $post_id) === '10:15' ? 'selected' : '' ?> value="10:15">10:15</option>
                <option <?= get_field('time', $post_id) === '10:30' ? 'selected' : '' ?> value="10:30">10:30</option>
                <option <?= get_field('time', $post_id) === '10:45' ? 'selected' : '' ?> value="10:45">10:45</option>
                <option <?= get_field('time', $post_id) === '11:00' ? 'selected' : '' ?> value="11:00">11:00</option>
                <option <?= get_field('time', $post_id) === '11:15' ? 'selected' : '' ?> value="11:15">11:15</option>
                <option <?= get_field('time', $post_id) === '11:30' ? 'selected' : '' ?> value="11:30">11:30</option>
                <option <?= get_field('time', $post_id) === '11:45' ? 'selected' : '' ?> value="11:45">11:45</option>
                <option <?= get_field('time', $post_id) === '12:00' ? 'selected' : '' ?> value="12:00">12:00</option>
                <option <?= get_field('time', $post_id) === '12:15' ? 'selected' : '' ?> value="12:15">12:15</option>
                <option <?= get_field('time', $post_id) === '12:30' ? 'selected' : '' ?> value="12:30">12:30</option>
                <option <?= get_field('time', $post_id) === '12:45' ? 'selected' : '' ?> value="12:45">12:45</option>
                <option <?= get_field('time', $post_id) === '13:00' ? 'selected' : '' ?> value="13:00">13:00</option>
                <option <?= get_field('time', $post_id) === '13:15' ? 'selected' : '' ?> value="13:15">13:15</option>
                <option <?= get_field('time', $post_id) === '13:30' ? 'selected' : '' ?> value="13:30">13:30</option>
                <option <?= get_field('time', $post_id) === '13:45' ? 'selected' : '' ?> value="13:45">13:45</option>
                <option <?= get_field('time', $post_id) === '14:00' ? 'selected' : '' ?> value="14:00">14:00</option>
                <option <?= get_field('time', $post_id) === '14:15' ? 'selected' : '' ?> value="14:15">14:15</option>
                <option <?= get_field('time', $post_id) === '14:30' ? 'selected' : '' ?> value="14:30">14:30</option>
                <option <?= get_field('time', $post_id) === '14:45' ? 'selected' : '' ?> value="14:45">14:45</option>
                <option <?= get_field('time', $post_id) === '15:00' ? 'selected' : '' ?> value="15:00">15:00</option>
                <option <?= get_field('time', $post_id) === '15:15' ? 'selected' : '' ?> value="15:15">15:15</option>
                <option <?= get_field('time', $post_id) === '15:30' ? 'selected' : '' ?> value="15:30">15:30</option>
                <option <?= get_field('time', $post_id) === '15:45' ? 'selected' : '' ?> value="15:45">15:45</option>
                <option <?= get_field('time', $post_id) === '16:00' ? 'selected' : '' ?> value="16:00">16:00</option>
                <option <?= get_field('time', $post_id) === '16:15' ? 'selected' : '' ?> value="16:15">16:15</option>
                <option <?= get_field('time', $post_id) === '16:30' ? 'selected' : '' ?> value="16:30">16:30</option>
                <option <?= get_field('time', $post_id) === '16:45' ? 'selected' : '' ?> value="16:45">16:45</option>
                <option <?= get_field('time', $post_id) === '17:00' ? 'selected' : '' ?> value="17:00">17:00</option>
                <option <?= get_field('time', $post_id) === '17:15' ? 'selected' : '' ?> value="17:15">17:15</option>
                <option <?= get_field('time', $post_id) === '17:30' ? 'selected' : '' ?> value="17:30">17:30</option>
                <option <?= get_field('time', $post_id) === '17:45' ? 'selected' : '' ?> value="17:45">17:45</option>
                <option <?= get_field('time', $post_id) === '18:00' ? 'selected' : '' ?> value="18:00">18:00</option>
                <option <?= get_field('time', $post_id) === '18:15' ? 'selected' : '' ?> value="18:15">18:15</option>
                <option <?= get_field('time', $post_id) === '18:30' ? 'selected' : '' ?> value="18:30">18:30</option>
                <option <?= get_field('time', $post_id) === '18:45' ? 'selected' : '' ?> value="18:45">18:45</option>
                <option <?= get_field('time', $post_id) === '19:00' ? 'selected' : '' ?> value="19:00">19:00</option>
                <option <?= get_field('time', $post_id) === '19:15' ? 'selected' : '' ?> value="19:15">19:15</option>
                <option <?= get_field('time', $post_id) === '19:30' ? 'selected' : '' ?> value="19:30">19:30</option>
                <option <?= get_field('time', $post_id) === '19:45' ? 'selected' : '' ?> value="19:45">19:45</option>
                <option <?= get_field('time', $post_id) === '20:00' ? 'selected' : '' ?> value="20:00">20:00</option>
                <option <?= get_field('time', $post_id) === '20:15' ? 'selected' : '' ?> value="20:15">20:15</option>
                <option <?= get_field('time', $post_id) === '20:30' ? 'selected' : '' ?> value="20:30">20:30</option>
                <option <?= get_field('time', $post_id) === '20:45' ? 'selected' : '' ?> value="20:45">20:45</option>
                <option <?= get_field('time', $post_id) === '21:00' ? 'selected' : '' ?> value="21:00">21:00</option>
                <option <?= get_field('time', $post_id) === '21:15' ? 'selected' : '' ?> value="21:15">21:15</option>
                <option <?= get_field('time', $post_id) === '21:30' ? 'selected' : '' ?> value="21:30">21:30</option>
                <option <?= get_field('time', $post_id) === '21:45' ? 'selected' : '' ?> value="21:45">21:45</option>
                <option <?= get_field('time', $post_id) === '22:00' ? 'selected' : '' ?> value="22:00">22:00</option>
                <option <?= get_field('time', $post_id) === '22:15' ? 'selected' : '' ?> value="22:15">22:15</option>
                <option <?= get_field('time', $post_id) === '22:30' ? 'selected' : '' ?> value="22:30">22:30</option>
                <option <?= get_field('time', $post_id) === '22:45' ? 'selected' : '' ?> value="22:45">22:45</option>
                <option <?= get_field('time', $post_id) === '23:00' ? 'selected' : '' ?> value="23:00">23:00</option>
                <option <?= get_field('time', $post_id) === '23:15' ? 'selected' : '' ?> value="23:15">23:15</option>
                <option <?= get_field('time', $post_id) === '23:30' ? 'selected' : '' ?> value="23:30">23:30</option>
                <option <?= get_field('time', $post_id) === '23:45' ? 'selected' : '' ?> value="23:45">23:45</option>
                <option <?= get_field('time', $post_id) === '00:00' ? 'selected' : '' ?> value="00:00">00:00</option>
                <option <?= get_field('time', $post_id) === '00:30' ? 'selected' : '' ?> value="00:30">00:30</option>
                <option <?= get_field('time', $post_id) === '01:00' ? 'selected' : '' ?> value="01:00">01:00</option>
            </select>
        </div>
    </div>
    <div class="form-row form-row--col">
        <input type="hidden" name="taxonomy" value="event-categories">
        <label for="cat"><?php pll_e('Κατηγορίες'); ?></label>
        <?php
        if ($post_id && $edit_mode) :
            $selected_category = ''; // initialize variable to hold the selected category
            $categories = get_the_terms($post_id, 'event-categories'); // get the categories for the post
            if ($categories && !is_wp_error($categories)) {
                $category_ids = wp_list_pluck($categories, 'term_id'); // get the IDs of the categories
                $args = array(
                    'taxonomy' => 'event-categories',
                    'orderby' => 'name',
                    'hide_empty' => false,
                    'class' => 'event-categories',
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
                'taxonomy' => 'event-categories',
                'orderby' => 'name',
                'hide_empty' => false,
                'class' => 'event-categories',
                'echo' => false
            );
            $categories = wp_dropdown_categories($args);
            $categories = str_replace('id=', 'class="" id=', $categories);
        endif;
        echo $categories;
        ?>
    </div>

    <div class="form-row form-row--col">
        <label for="logo"><?php pll_e('Εικόνα εκδήλωσης / Αφίσα'); ?></label>
        <label for="logo" class="label--file input pointer"><?php $post_id && has_post_thumbnail($post_id) ? pll_e('Αλλαγή εικόνας') :  pll_e('Προσθήκη') ?></label>
        <input class="input input--file" type="file" name="logo" id="logo" accept="image/*" />
        <div class="preview-logo__container">
            <?php if ($post_id && has_post_thumbnail($post_id)) : ?>
                <img src="<?= get_the_post_thumbnail_url($post_id, 'medium') ?>" alt="<?php the_title(); ?>">
            <?php endif; ?>
        </div>
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
        <label for="gallery"><?php pll_e('Συλλογή φωτογραφιών'); ?></label>
        <label for="gallery" class="label--file input pointer"><?php $post_id && $edit_mode && get_field('gallery', $post_id) ? pll_e('Αλλαγή φωτογραφιών') : pll_e('Προσθήκη') ?></label>
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

    <div class="form-row form-row--col">
        <div class="social-media-row form-row">
            <div class="form-row form-row--col">
                <label for="facebook_url"><?php pll_e('Διεύθυνση Facebook') ?> (URL)</label>
                <input type="url" value="<?= $post_id && $edit_mode ? get_field('facebook_url', $post_id) : "" ?>" class="input" name="facebook_url" id="facebook_url">
            </div>
        </div>
    </div>
    <input type="hidden" name="action" value="submit_custom_event_form">
    <?php wp_nonce_field('submit_custom_event_form', 'custom_event_form_nonce'); ?>
    <input type="submit" class="btn input pointer" value="<?php pll_e('Καταχώρηση') ?>">
</form>