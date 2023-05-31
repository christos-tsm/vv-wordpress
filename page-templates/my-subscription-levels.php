<?php

/**
 * Template Name: My Subscription Levels
 */
get_header();
?>
<main class="site-main site-main--account">
    <?php if (is_user_logged_in()) : ?>
        <section class="dashboard__container container container--medium">
            <?php get_template_part('template-parts/account/user-details'); ?>
            <div class="dashboard__content">
                <div class="membership membership__subscription-levels">
                    <?php
                    global $wpdb, $pmpro_msg, $pmpro_msgt, $current_user;

                    $pmpro_levels = pmpro_sort_levels_by_order(pmpro_getAllLevels(false, true));
                    $pmpro_levels = apply_filters('pmpro_levels_array', $pmpro_levels);
                    if ($pmpro_msg) {
                    ?>
                        <div class="<?php echo esc_attr(pmpro_get_element_class('pmpro_message ' . $pmpro_msgt, $pmpro_msgt)); ?>"><?php echo wp_kses_post($pmpro_msg); ?></div>
                    <?php
                    }
                    ?>
                    <table id="pmpro_levels_table" class="<?php echo esc_attr(pmpro_get_element_class('pmpro_table pmpro_checkout', 'pmpro_levels_table')); ?>">
                        <thead>
                            <tr>
                                <th><?php esc_html_e('Level', 'paid-memberships-pro'); ?></th>
                                <th><?php esc_html_e('Price', 'paid-memberships-pro'); ?></th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 0;
                            $has_any_level = false;
                            foreach ($pmpro_levels as $level) {
                                $user_level = pmpro_getSpecificMembershipLevelForUser($current_user->ID, $level->id);
                                $has_level = !empty($user_level);
                                $has_any_level = $has_level ?: $has_any_level;
                            ?>
                                <tr class="<?php if ($count++ % 2 == 0) { ?>odd<?php } ?><?php if ($has_level) { ?> active<?php } ?>">
                                    <td><?php echo $has_level ? "<strong>" . esc_html($level->name) . "</strong>" : esc_html($level->name); ?></td>
                                    <td>
                                        <?php
                                        $cost_text = pmpro_getLevelCost($level, true, true);
                                        $expiration_text = pmpro_getLevelExpiration($level);
                                        if (!empty($cost_text) && !empty($expiration_text))
                                            echo wp_kses_post($cost_text . "<br />" . $expiration_text);
                                        elseif (!empty($cost_text))
                                            echo wp_kses_post($cost_text);
                                        elseif (!empty($expiration_text))
                                            echo wp_kses_post($expiration_text);
                                        ?>
                                    </td>
                                    <td>
                                        <?php if (!$has_level) { ?>
                                            <a class="<?php echo esc_attr(pmpro_get_element_class('pmpro_btn pmpro_btn-select', 'pmpro_btn-select')); ?>" href="<?php echo esc_url(pmpro_url("checkout", "?level=" . $level->id, "https")) ?>"><?php esc_html_e('Select', 'paid-memberships-pro'); ?></a>
                                        <?php } else { ?>
                                            <?php
                                            //if it's a one-time-payment level, offer a link to renew	
                                            if (pmpro_isLevelExpiringSoon($user_level) && $level->allow_signups) {
                                            ?>
                                                <a class="<?php echo esc_attr(pmpro_get_element_class('pmpro_btn pmpro_btn-select', 'pmpro_btn-select')); ?>" href="<?php echo esc_url(pmpro_url("checkout", "?level=" . $level->id, "https")) ?>"><?php esc_html_e('Renew', 'paid-memberships-pro'); ?></a>
                                            <?php
                                            } else {
                                            ?>
                                                <a class="<?php echo esc_attr(pmpro_get_element_class('pmpro_btn disabled', 'pmpro_btn')); ?>" href="<?php echo esc_url(pmpro_url("account")) ?>"><?php esc_html_e('Your&nbsp;Level', 'paid-memberships-pro'); ?></a>
                                            <?php
                                            }
                                            ?>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php
                    foreach ($pmpro_levels as $pmpro_level) :
                        $level_description = apply_filters('pmpro_level_description', $pmpro_level->description, $pmpro_level);
                        if (!empty($level_description)) : ?>
                            <div class="level-description level-description__premium <?php echo esc_attr(pmpro_get_element_class('pmpro_level_description_text')); ?>">
                                <?php echo wp_kses_post($level_description); ?>
                            </div>
                        <?php endif;  ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
</main>
<?php get_footer(); ?>