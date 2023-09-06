<form method="POST" id="register" class="form form--hidden">
    <div class="form-row form-row--col">
        <label for="user_login">Username</label>
        <input type="text" class="input" name="user_login">
    </div>
    <div class="form-row form-row--col">
        <label for="user_email">Email</label>
        <input type="email" class="input" name="user_email">
    </div>
    <div class="form-row form-row--col">
        <label for="user_pass"><?php _e('Κωδικός') ?></label>
        <input type="password" class="input" name="user_pass">
    </div>
    <div class="form-row form-row--col">
        <label for="password"><?php _e('Επιβεβαίωση κωδικού'); ?></label>
        <input type="password" class="input" name="confirm_password">
    </div>
    <p class="message message--register"></p>
    <div class="form-row form-row--submit">
        <input type="checkbox" name="register-terms" id="register-terms" required class="input--checkbox">
        <label class="label--checkbox pointer" for="register-terms"><?php _e('Συμφωνώ με τους όρους & τις προυποθέσεις της παρούσας εφαρμογής'); ?></label>
        <button class="input btn pointer"><?php _e('Εγγραφή'); ?></button>
    </div>
</form>