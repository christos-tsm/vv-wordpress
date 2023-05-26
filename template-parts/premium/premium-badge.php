<?php
$store_user_id = intval(get_field('user_id'));
if (function_exists('pmpro_getMembershipLevelForUser')) :
    $level = pmpro_getMembershipLevelForUser($store_user_id);
    if ($level->name === 'Premium') :
        echo '<span class="badge badge--premium"> ' .  file_get_contents(get_stylesheet_directory() . '/assets/images/star.svg') . ' </span>';
    endif;
endif;
