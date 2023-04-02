<?php $current_user = wp_get_current_user(); ?>
<div class="store-form__header">
    <h3 class="section-subtitle section-subtitle--dashboard"><?php pll_e('Βήμα 2ο') ?></h3>
    <h2 class="subsection-title"><?php pll_e('Συμπληρώστε τα στοιχεία της επιχείρησής σας'); ?></h2>
</div>
<form id="custom-hotel-form" class="form form--fluid" method="post" enctype="multipart/form-data" action="<?php echo esc_url(get_permalink()); ?>">
    <input type="hidden" name="uuid" value="<?= $current_user->ID ?>">
    <input type="hidden" name="post-type" value="hotels">
    <div class="form-row form-row--col">
        <label for="title"><?php pll_e('Τίτλος'); ?></label>
        <input class="input" type="text" name="title" id="title" required>
    </div>
    <div class="form-row form-row--col">
        <label for="description"><?php pll_e('Περιγραφή'); ?></label>
        <textarea class="input" name="description" id="description" cols="30" rows="10" required></textarea>
    </div>
    <div class="form-row form-row--col">
        <input type="hidden" name="taxonomy" value="hotel-categories">
        <label for="cat"><?php pll_e('Κατηγορίες'); ?></label>
        <?php
        $args = array(
            'taxonomy' => 'hotel-categories',
            'orderby' => 'name',
            'hide_empty' => false,
            'class' => 'hotel-categories',
            'echo' => false
        );
        $categories = wp_dropdown_categories($args);
        $categories = str_replace('id=', 'class="checkbox input pointer" id=', $categories);
        echo $categories;
        ?>
    </div>
    <div class="form-row">
        <div class="form-row form-row--col">
            <label for="address"><?php pll_e('Διεύθυνση'); ?></label>
            <input class="input" type="text" name="address" id="address" required>
        </div>
        <div class="form-row form-row--col">
            <label for="distance_from_city_center"><?php pll_e('Απόσταση από το κέντρο του Βόλου') ?></label>
            <input class="input" type="text" name="distance_from_city_center" id="distance_from_city_center" required>
        </div>
    </div>
    <div class="form-row form-row--col">
        <div class="acf-label">
            <label for="coordinates"><?php pll_e('Συντεταγμένες'); ?></label>
            <p class="description">
                <?php pll_e('Στην διεύθυνση <a href="https://maps.google.com" target="_blank" rel="noopener">maps.google.com</a>, βάλτε την διεύθυνσή σας και πατήστε δεξί click στο location pin που σας εμφανίζει. Οι τιμές σε μορφή "23,502934, 23,5035525" είναι οι συντεταγμένες της επιχείρησής σας. Αριστερό κλικ σε αυτές για αντιγραφή και έπειτα κάντε επικόλληση εδώ.') ?>
            </p>
        </div>
        <input class="input" type="text" name="coordinates" id="coordinates" required>
    </div>
    <div class="form-row form-row--col">
        <label for="average_price"><?php pll_e('Μέση τιμή δωματίου ανά βραδιά') ?></label>
        <input class="input" type="text" name="average_price" id="average_price" required>
    </div>
    <div class="form-row form-row--col">
        <label for="gallery"><?php pll_e('Προσθήκη φωτογραφιών'); ?></label>
        <label for="gallery" class="label--file input pointer"><?php pll_e('Προσθήκη') ?></label>
        <input class="input input--file" type="file" name="gallery[]" id="gallery" multiple accept="image/*" max="5" />
        <div class="preview-gallery__container"></div>
    </div>
    <div class="form-row">
        <div class="form-row form-row--col">
            <label for="emails"><?php pll_e('Διευθύνσεις email') ?></label>
            <div id="emails-container">
                <div class="email-row">
                    <input class="input" type="email" name="emails[]" required>
                </div>
            </div>
            <span id="add-email" class="add-input icon icon--medium icon--add pointer">
                <?= file_get_contents(get_stylesheet_directory() . '/assets/images/add.svg'); ?>
            </span>
        </div>
        <div class="form-row form-row--col">
            <label for="tels"><?php pll_e('Αριθμοί τηλεφώνου') ?></label>
            <div id="tels-container">
                <div class="tel-row">
                    <input class="input" type="tel" name="tels[]" required>
                </div>
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
                <input type="url" class="input" name="facebook_url" id="facebook_url">
            </div>
            <div class="form-row form-row--col">
                <label for="instagram_url"><?php pll_e('Διεύθυνση Instagram') ?> (URL)</label>
                <input type="url" class="input" name="instagram_url" id="instagram_url">
            </div>
            <div class="form-row form-row--col">
                <label for="tripadvisor_url"><?php pll_e('Διεύθυνση Tripadvisor') ?> (URL)</label>
                <input type="url" class="input" name="tripadvisor_url" id="tripadvisor_url">
            </div>
            <div class="form-row form-row--col">
                <label for="booking_url"><?php pll_e('Διεύθυνση Booking') ?> (URL)</label>
                <input type="url" class="input" name="booking_url" id="booking_url">
            </div>
            <div class="form-row form-row--col">
                <label for="tiktok_url"><?php pll_e('Διεύθυνση TikTok') ?> (URL)</label>
                <input type="url" class="input" name="tiktok_url" id="tiktok_url">
            </div>
        </div>
    </div>
    <div class="form-row form-row--col">
        <label for="website"><?php pll_e('Ιστοσελίδα') ?> (URL)</label>
        <input class="input" type="url" name="website" id="website" required>
    </div>
    <input type="hidden" name="action" value="submit_custom_store_form">
    <?php wp_nonce_field('submit_custom_store_form', 'custom_store_form_nonce'); ?>
    <input type="submit" class="btn input pointer" value="<?php pll_e('Καταχώρηση') ?>">
</form>