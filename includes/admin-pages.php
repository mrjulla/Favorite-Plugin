<?php

function ivl_display_favorites_admin_page() {
    ?>
    <div class="wrap">
        <h1>Favorite Posts</h1>
        <?php
        $user_query = new WP_User_Query(['fields' => 'all']);
        $users = $user_query->get_results();
        $all_favorites = [];
        
        // print("<pre>".print_r($users,true)."</pre>");
        
        if ($users) {
            foreach ($users as $user) {
                $favorites = get_user_meta($user->ID, 'ivl_favorites', true);
                // $favorites2 = get_user_meta($user->ID);
                // print("<pre>".print_r($favorites2,true)."</pre>");

                if (!empty($favorites) && is_array($favorites)) {
                    foreach ($favorites as $favorite) {
                        if (isset($favorite['post_id']) && isset($favorite['time'])) {
                            $contact = get_user_meta($user->ID, 'user_phone', true);
                            $fname = get_user_meta($user->ID, 'first_name', true);
                            $lname = get_user_meta($user->ID, 'last_name', true);
                            $fullname = $fname . ' ' . $lname;

                            $all_favorites[] = array(
                                'user_login' => $user->user_login,
                                'post_id' => $favorite['post_id'],
                                'time' => $favorite['time'],
                                'contact' => $contact,
                                'fullname' => $fullname
                            );
                        }
                    }
                }
            }

            if (!empty($all_favorites)) {
                usort($all_favorites, function($a, $b) {
                    return strtotime($b['time']) - strtotime($a['time']);
                });

                echo '<table class="wp-list-table widefat fixed striped">';
                echo '<thead><tr><th>#</th><th>Property</th><th>Username</th><th>Fullname</th><th>Contact</th><th>Date</th></tr></thead><tbody>';
                $index = 1;
                foreach ($all_favorites as $favorite) {
                    $post_title = get_the_title($favorite['post_id']);
                    $post_permalink = get_permalink($favorite['post_id']);
                    echo '<tr>';
                    echo '<td>' . $index . '</td>';
                    // echo '<td>' . esc_html($post_title) . '</td>'; 
                    echo '<td><a href="' . $post_permalink . '">' . esc_html($post_title) . '</td>'; 
                    echo '<td>' . esc_html($favorite['user_login']) . '</td>';
                    echo '<td>' . esc_html($favorite['fullname']) . '</td>';
                    echo '<td>' . esc_html($favorite['contact']) . '</td>';
                    echo '<td>' . esc_html($favorite['time']) . '</td>';
                    echo '</tr>';
                    $index++;
                }
                echo '</tbody></table>';
            } else {
                echo '<p>No favorite posts found.</p>';
            }
        } else {
            echo '<p>No users found.</p>';
        }
        ?>
    </div>
    <?php
}

function ivl_reset_all_favorites() {
    $users = get_users();
    foreach ($users as $user) {
        delete_user_meta($user->ID, 'ivl_favorites');
    }

    $args = array(
        'post_type' => 'property',
        'posts_per_page' => -1,
        'post_status' => 'any',
    );
    $query = new WP_Query($args);
    while ($query->have_posts()) {
        $query->the_post();
        delete_post_meta(get_the_ID(), 'favorite_users');
    }
    wp_reset_postdata();
}

function ivl_reset_favorites_page() {
    if (isset($_POST['ivl_reset_favorites'])) {
        ivl_reset_all_favorites();
        echo '<div class="updated"><p>All favorite data has been reset.</p></div>';
    }
    ?>
    <div class="wrap">
        <h1>Reset Favorites</h1>
        <form method="post">
            <p>Are you sure you want to reset all favorite data? This action cannot be undone.</p>
            <p>
                <input type="submit" name="ivl_reset_favorites" class="button button-primary" value="Reset Favorites">
            </p>
        </form>
    </div>
    <?php
}
?>
