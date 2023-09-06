<form method="POST" id="login" class="form">
    <div class="form-row form-row--col">
        <label for="email">Email</label>
        <input type="email" class="input" name="user_email">
    </div>
    <div class="form-row form-row--col">
        <label for="password"><?php _e('Κωδικός') ?></label>
        <input type="password" class="input" name="user_pass">
    </div>
    <p class="message message--login"></p>
    <div class="form-row form-row--submit">
        <input type="checkbox" name="rememberme" id="rememberme" class="input--checkbox">
        <label class="label--checkbox pointer" for="rememberme"><?php _e('Να μείνει ο λογαριασμός συνδεδεμένος'); ?></label>
        <button class="input btn pointer ml-auto"><?php _e('Σύνδεση'); ?></button>
    </div>
</form>