<?php

class wp_adminkit_walker_menu_sidebar extends Walker_Nav_Menu {

    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        // $item_id = $item->ID;
        // $args->item_id = $item->ID;
        // $type = $item->type;
        $title = $item->title;
        // $description = $item->description;
        $permalink = $item->url;

        // If current page
        if (in_array('current_page_item', $item->classes)) {
            $li_tag = '<li class="sidebar-item active ' .  implode(' ', $item->classes) . '">';
        } else {
            $li_tag = '<li class="sidebar-item ' .  implode(' ', $item->classes) . '">';
        }

        $output .= $li_tag;
        $output .= '<a class="sidebar-link" href="' . $permalink . '"><span class="align-middle">' . $title . '</span></a>';
    }

    public function end_el(&$output, $data_object, $depth = 0, $args = null) {
        $output .= '</li>';
    }
}
