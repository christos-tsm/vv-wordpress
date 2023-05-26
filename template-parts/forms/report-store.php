<?php
global $current_user;
wp_get_current_user();
$user_id = $current_user->ID;
$post_id = get_the_ID();
$post_title = get_the_title();
?>
<form id="report-form" action="<?php echo admin_url('admin-post.php'); ?>" method="post">
    <input type="hidden" name="action" value="report_form">
    <input type="hidden" name="nonce" value="<?php echo wp_create_nonce('report_nonce'); ?>">
    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
    <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
    <input type="hidden" name="post_title" value="<?php echo $post_title; ?>">
    <input type="hidden" name="user_reported_email" value="<?php echo wp_get_current_user()->user_email; ?>">
    <div class="form-row form-row--col">
        <label for="report-case">Επιλέξτε αιτία αναφοράς</label>
        <p class="message message--info">Μπορείτε να διαβάσετε τους κανόνες κοινότητας <a href="#!" target="_blank" rel="noopener noreferrer">εδώ</a>.<br />Δεν θα ειδοποιήσουμε τον χρήστη για το ποιός έκανε την αναφορά.</p>
        <select class="input pointer" name="report_case" id="report-case">
            <option value="community_rules">Παραβίαση κανόνων κοινότητας</option>
            <option value="hate_speech">Ρητορική μίσους</option>
            <option value="false_information">Ψευδείς πληροφορίες</option>
        </select>
    </div>
    <div class="form-row form-row--col">
        <label for="report-notes">Σχόλια αναφοράς</label>
        <p class="message message--info">Εξηγήστε μας τους λόγους για τους οποίους ωθείστε στην αναφορά της συγκεκριμένης επιχειρήσης.</p>
        <textarea name="report_notes" id="report-notes" class="input"></textarea>
    </div>
    <input type="submit" class="btn input pointer" value="Αποστολή αναφοράς">
</form>