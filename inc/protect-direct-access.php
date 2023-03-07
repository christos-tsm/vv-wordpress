<?php
ob_start();
if (!defined('ABSPATH')) {
    wp_die('Not authorized');
}
if (!is_user_logged_in()) {
    wp_redirect('/');
    exit();
}
ob_end_flush();
