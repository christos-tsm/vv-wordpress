<form method="GET" action="<?php echo esc_url(pll_home_url() . 'profiles/'); ?>">
    <div class="form-row">
        <select class="input pointer" name="profile_category" id="profile_category">
            <option value="idravlikos">Υδραυλικός</option>
            <option value="ilektrologos">Ηλεκτρολόγος</option>
            <option value="dikigoros">Δικηγόρος</option>
        </select>
        <?php get_template_part('template-parts/forms/municipality-areas') ?>
        <button class="input btn pointer" type="submit"><?php pll_e('Αναζήτηση'); ?></button>
    </div>
</form>