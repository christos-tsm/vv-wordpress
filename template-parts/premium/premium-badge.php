<?php
$store_user_id = intval(get_field('user_id'));
if (function_exists('rcp_is_active') && rcp_is_active($store_user_id) && !('post' == get_post_type())) :
    echo '<span class="badge badge--premium"> ' .  file_get_contents(get_stylesheet_directory() . '/assets/images/star.svg') . ' </span>';
endif;
