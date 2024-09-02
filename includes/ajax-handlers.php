<?php
function ivl_check_favorite() {
    if (!is_user_logged_in()) {
        wp_send_json_error('User not logged in.');
        return;
    }

    $post_id = intval($_POST['post_id']);
    $user_id = get_current_user_id();

    $favorites = get_user_meta($user_id, 'ivl_favorites', true);
    if (!is_array($favorites)) {
        $favorites = [];
    }

    $is_favorited = false;
    foreach ($favorites as $favorite) {
        if (isset($favorite['post_id']) && $favorite['post_id'] == $post_id) {
            $is_favorited = true;
            break;
        }
    }

    wp_send_json_success(array('favorited' => $is_favorited));
}
add_action('wp_ajax_ivl_check_favorite', 'ivl_check_favorite');

function ivl_toggle_favorite() {
    if (!is_user_logged_in()) {
        wp_send_json_error('User not logged in.');
        return;
    }

    $post_id = intval($_POST['post_id']);
    $user_id = get_current_user_id();
    $current_time = current_time('mysql');

    $favorites = get_user_meta($user_id, 'ivl_favorites', true);
    if (!is_array($favorites)) {
        $favorites = [];
    }

    $is_favorited = false;
    foreach ($favorites as $key => $favorite) {
        if (isset($favorite['post_id']) && $favorite['post_id'] == $post_id) {
            $is_favorited = true;
            unset($favorites[$key]);
            break;
        }
    }

    if (!$is_favorited) {
        $favorites[] = array(
            'post_id' => $post_id,
            'time' => $current_time
        );
    }

    update_user_meta($user_id, 'ivl_favorites', array_values($favorites));

    wp_send_json_success(array('favorited' => !$is_favorited));
}
add_action('wp_ajax_ivl_toggle_favorite', 'ivl_toggle_favorite');

?>
