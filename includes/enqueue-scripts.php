<?php
function ivl_enqueue_favorite_scripts() {
    wp_enqueue_script('ivl-favorite-script', plugin_dir_url(__FILE__) . '../js/favorite.js', array('jquery'), null, true);
    wp_localize_script('ivl-favorite-script', 'ivl_favorite', array('ajaxurl' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'ivl_enqueue_favorite_scripts');
?>

<?php
// function ivl_enqueue_favorite_scripts() {
// 	wp_enqueue_style('sweet-alert-styles', plugin_dir_url( __FILE__ ) . '../css/sweetalert2.min.css');

//     wp_enqueue_script('sweetalert2-js', plugin_dir_url( __FILE__ ) . '../js/sweetalert2.all.min.js'array(), null, true);

//     wp_enqueue_script('ivl-favorite-script', plugin_dir_url(__FILE__) . '../js/favorite.js', array('jquery', 'sweetalert2-js'), null, true);

//     wp_localize_script('ivl-favorite-script', 'ivl_favorite', array('ajaxurl' => admin_url('admin-ajax.php')));
// }
// add_action('wp_enqueue_scripts', 'ivl_enqueue_favorite_scripts');
?>
