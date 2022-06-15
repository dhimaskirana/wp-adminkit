<?php

add_filter('v_forcelogin_bypass', function ($bypass, $visited_url) {

    // Allow these absolute URLs
    $allowed = array(
        home_url('/lostpassword/'),
    );
    if (get_option('users_can_register') == 1) {
        $allowed[] = home_url('/register/');
    }
    if (!$bypass) {
        $bypass = in_array($visited_url, $allowed);
    }

    return $bypass;
}, 10, 2);
