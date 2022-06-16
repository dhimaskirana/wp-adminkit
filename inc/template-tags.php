<?php

/**
 * Custom template tags for this theme
 */

function wpak_get_username() {
    $current_user = wp_get_current_user();
    echo $current_user->display_name;
}
