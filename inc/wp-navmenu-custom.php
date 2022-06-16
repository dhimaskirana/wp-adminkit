<?php

/**
 * Add icon field on nav menu item
 */
add_action('wp_nav_menu_item_custom_fields', function ($item_id, $item) {
    $menu_item_icon = get_post_meta($item_id, '_menu_item_icon', true);
?>
    <p>
        <label for="menu_item_icon">
            Menu Icon
            <br>
            <input type="text" class="widefat" name="menu_item_icon[<?php echo $item_id; ?>]" id="menu-item-icon-<?php echo $item_id; ?>" value="<?php echo esc_attr($menu_item_icon); ?>" />
        </label>
    </p>
<?php
}, 10, 2);

add_action('wp_update_nav_menu_item', function ($menu_id, $menu_item_db_id) {
    if (isset($_POST['menu_item_icon'][$menu_item_db_id])) {
        $sanitized_data = sanitize_text_field($_POST['menu_item_icon'][$menu_item_db_id]);
        update_post_meta($menu_item_db_id, '_menu_item_icon', $sanitized_data);
    } else {
        delete_post_meta($menu_item_db_id, '_menu_item_icon');
    }
}, 10, 2);
