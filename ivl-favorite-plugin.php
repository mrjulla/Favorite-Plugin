<?php
/*
Plugin Name: IVL Favorite Plugin
Description: Allows users to add properties to their favorites list.
Version: 2.0
Author: Jull4
*/

include_once plugin_dir_path(__FILE__) . 'includes/enqueue-scripts.php';
include_once plugin_dir_path(__FILE__) . 'includes/meta-box.php';
include_once plugin_dir_path(__FILE__) . 'includes/shortcodes.php';
include_once plugin_dir_path(__FILE__) . 'includes/ajax-handlers.php';
include_once plugin_dir_path(__FILE__) . 'includes/admin-pages.php';

add_action('admin_menu', 'ivl_register_favorite_menu_page');

function ivl_register_favorite_menu_page() {
    add_menu_page(
        'Favorite Posts',
        'Favorites',
        'manage_options',
        'ivl-favorites',
        'ivl_display_favorites_admin_page',
        'dashicons-heart',
        6
    );

    add_submenu_page(
        'ivl-favorites',
        'All Favorites',
        'All Favorites',
        'manage_options',
        'ivl-favorites',
        'ivl_display_favorites_admin_page'
    );

    add_submenu_page(
        'ivl-favorites',
        'Reset Favorites',
        'Reset Favorites',
        'manage_options',
        'ivl-reset-favorites',
        'ivl_reset_favorites_page'
    );
}
?>
