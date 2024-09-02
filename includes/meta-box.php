<?php
function ivl_add_favorite_meta_box() {
    add_meta_box(
        'ivl_favorite_meta_box',
        'Favorite Users',
        'ivl_display_favorite_meta_box',
        'property',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'ivl_add_favorite_meta_box');

function ivl_display_favorite_meta_box($post) {
    $favorites = get_post_meta($post->ID, 'favorite_users', true);
    if (!is_array($favorites)) {
        $favorites = array();
    }
    echo '<ul>';
    foreach ($favorites as $user_id) {
        $user_info = get_userdata($user_id);
        echo '<li>' . $user_info->user_login . '</li>';
    }
    echo '</ul>';
}
?>
