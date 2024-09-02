jQuery(document).ready(function($) {
    function updateButtonStyle(button, favorited) {
        if (favorited) {
            button.css('background-color', '#FF69B4');
            button.find('svg').css('fill', '#FFFFFF');
        } else {
            button.css('background-color', '');
            button.find('svg').css('fill', '');
        }
    }

    $('.ivl-favorite-button').on('click', function(e) {
        e.preventDefault();

        var button = $(this);
        var post_id = button.data('post_id');
        var user_id = button.data('user_id');
        var current_time = new Date().toISOString();

        if(user_id == '0') {
            alert('You must be logged in to favorite this post.');
            $("a:contains('Sign In')").trigger('click');
            return;
        }

        $.ajax({
            url: ivl_favorite.ajaxurl,
            type: 'POST',
            data: {
                action: 'ivl_toggle_favorite',
                post_id: post_id,
                user_id: user_id,
                time: current_time
            },
            success: function(response) {
                console.log('Toggle Favorite Response:', response);
                if (response.success) {
                    updateButtonStyle(button, response.data.favorited);
                } else {
                    alert(response.data.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Toggle Favorite AJAX Error:', status, error);
                // alert('An error occurred while toggling the favorite status.');
            }
        });
    });

    $('.ivl-favorite-button').each(function() {
        var button = $(this);
        var post_id = button.data('post_id');

        $.ajax({
            url: ivl_favorite.ajaxurl,
            type: 'POST',
            data: {
                action: 'ivl_check_favorite',
                post_id: post_id
            },
            success: function(response) {
                console.log('Check Favorite Response:', response);
                if (response.success) {
                    updateButtonStyle(button, response.data.favorited);
                } else {
                    console.error('Check Favorite Error:', response.data.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Check Favorite AJAX Error:', status, error);
                // alert('An error occurred while checking the favorite status.');
            }
        });
    });
});
