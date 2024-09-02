<?php
function ivl_favorite_button_shortcode($atts) {
    global $post;
    $post_id = $post->ID;
    $user_id = get_current_user_id();
    $favorites = get_user_meta($user_id, 'ivl_favorites', true);
    if (!is_array($favorites)) {
        $favorites = array();
    }

    $is_favorited = false;
    foreach ($favorites as $favorite) {
        if (isset($favorite['post_id']) && $favorite['post_id'] == $post_id) {
            $is_favorited = true;
            break;
        }
    }

    ob_start();
    ?>
    <div class="elementor-element elementor-element-d2ddc0e elementor-view-stacked elementor-shape-circle elementor-widget elementor-widget-icon" data-id="d2ddc0e" data-element_type="widget" data-post_id="" data-widget_type="icon.default">
		<div class="elementor-widget-container">
			<div class="elementor-icon-wrapper">
			    <button class="elementor-icon ivl-favorite-button" style="border: none;" data-post_id="<?php echo esc_attr($post_id); ?>" data-user_id="<?php echo esc_attr($user_id); ?>">
                    <svg aria-hidden="true" class="e-font-icon-svg e-far-heart" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M458.4 64.3C400.6 15.7 311.3 23 256 79.3 200.7 23 111.4 15.6 53.6 64.3-21.6 127.6-10.6 230.8 43 285.5l175.4 178.7c10 10.2 23.4 15.9 37.6 15.9 14.3 0 27.6-5.6 37.6-15.8L469 285.6c53.5-54.7 64.7-157.9-10.6-221.3zm-23.6 187.5L259.4 430.5c-2.4 2.4-4.4 2.4-6.8 0L77.2 251.8c-36.5-37.2-43.9-107.6 7.3-150.7 38.9-32.7 98.9-27.8 136.5 10.5l35 35.7 35-35.7c37.8-38.5 97.8-43.2 136.5-10.6 51.1 43.1 43.5 113.9 7.3 150.8z"></path></svg>
                </button>
		    </div>
		</div>
	</div>
    <?php
    return ob_get_clean();
}
add_shortcode('ivl_favorite_button', 'ivl_favorite_button_shortcode');

function ivl_user_favorites_shortcode() {
    if (!is_user_logged_in()) return '<p>Please log in to see your favorites.</p>';
    
    $host = $_SERVER['HTTP_HOST'];
    $user_id = get_current_user_id();
    $favorites = get_user_meta($user_id, 'ivl_favorites', true);

    if (!empty($favorites) && is_array($favorites)) {
        $output = '<div class="elementor-element elementor-element-beacb4c elementor-grid-4 elementor-grid-tablet-2 elementor-grid-mobile-1 elementor-widget elementor-widget-loop-grid" data-id="beacb4c" data-element_type="widget" data-settings="{&quot;template_id&quot;:&quot;1579&quot;,&quot;columns&quot;:4,&quot;row_gap&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:24,&quot;sizes&quot;:[]},&quot;_skin&quot;:&quot;post&quot;,&quot;columns_tablet&quot;:&quot;2&quot;,&quot;columns_mobile&quot;:&quot;1&quot;,&quot;edit_handle_selector&quot;:&quot;[data-elementor-type=\&quot;loop-item\&quot;]&quot;,&quot;row_gap_laptop&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;row_gap_tablet_extra&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;row_gap_tablet&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;row_gap_mobile_extra&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;row_gap_mobile&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]}}" data-widget_type="loop-grid.post">
                        <div class="elementor-widget-container">    
                            <link rel="stylesheet" href="https://' . $host . '/wp-content/plugins/elementor-pro/assets/css/widget-loop-builder.min.css?ver=1721276736">
                            <div class="elementor-loop-container elementor-grid">';
        $html_file_path = plugin_dir_path(__FILE__) . '../html/loop1579.html';
        $htmlContent = file_get_contents($html_file_path);
        $output .= $htmlContent;

        foreach ($favorites as $favorite) {
            $post_id = $favorite['post_id'];
            if (get_post_status($post_id)) {
                $post_title = get_the_title($post_id);
                $post_permalink = get_permalink($post_id);
                $post_thumbnail = get_the_post_thumbnail_url($post_id, 'full');
                $post_category = get_the_terms($post_id, 'property_category')[0]->name;
                $post_featured = get_the_terms($post_id, 'property_hilighte')[0]->name;
                $post_price = get_field("property_price", $post_id );
                $post_location = get_field("property_district", $post_id ) . ', ' . get_field("property_subdistricts", $post_id );

                $output .= '
                <div data-elementor-type="loop-item" data-elementor-id="1579" data-elementor-id="1579" class="elementor elementor-1579 e-loop-item e-loop-item-' . $post_id . ' post-' . $post_id . ' property type-property status-publish format-standard has-post-thumbnail hentry property_hilighte-' . $post_featured . '" data-elementor-post-type="elementor_library" data-custom-edit-handle="1">
                    <div class="elementor-element elementor-element-430d831 e-flex e-con-boxed e-con e-parent e-lazyloaded" data-id="430d831" data-element_type="container" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                        <div class="e-con-inner">
                            <div class="elementor-element elementor-element-843fb3d e-con-full e-flex e-con e-child" data-id="843fb3d" data-element_type="container">
                                <div class="elementor-element elementor-element-f12def0 elementor-cta--skin-classic elementor-animated-content elementor-bg-transform elementor-bg-transform-zoom-in elementor-widget elementor-widget-call-to-action" data-id="f12def0" data-element_type="widget" data-widget_type="call-to-action.default">
                                    <div class="elementor-widget-container">
                                        <link rel="stylesheet" href="https://' . $host . '/wp-content/uploads/elementor/css/custom-pro-widget-call-to-action.min.css?ver=1721276869?ver=1721276869">
                                        <a class="elementor-cta" href="' . $post_permalink . '">
                                            <div class="elementor-cta__bg-wrapper">
                                                <div class="elementor-cta__bg elementor-bg" style="background-image: url(' . $post_thumbnail . ');" role="img" aria-label="' . $post_title . '"></div>
                                                <div class="elementor-cta__bg-overlay"></div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="elementor-element elementor-element-e08f43f e-con-full e-flex e-con e-child" data-id="e08f43f" data-element_type="container" data-settings="{&quot;position&quot;:&quot;absolute&quot;}">
                                <div class="elementor-element elementor-element-0383b8d e-con-full e-flex e-con e-child" data-id="0383b8d" data-element_type="container">
                                    <div class="elementor-element elementor-element-c8d43d8 elementor-widget elementor-widget-heading" data-element_type="widget" data-id="c8d43d8" data-widget_type="heading.default">
                                        <div class="elementor-widget-container">
                                            <span class="elementor-heading-title elementor-size-default">
                                                <a href="#" rel="tag">' . $post_featured . '</a>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="elementor-element elementor-element-b496be3 elementor-widget elementor-widget-heading" data-id="b496be3" data-element_type="widget" data-widget_type="heading.default">
                                        <div class="elementor-widget-container">
                                            <span class="elementor-heading-title elementor-size-default">
                                                <a href="#" rel="tag">' . $post_category . '</a></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="elementor-element elementor-element-6727a56 elementor-widget elementor-widget-shortcode" data-element_type="widget" data-id="6727a56" data-widget_type="shortcode.default">
                                    <div class="elementor-widget-container">
                                        <div class="elementor-shortcode">
                                            <div class="elementor-element elementor-element-d2ddc0e elementor-view-stacked elementor-shape-circle elementor-widget elementor-widget-icon" data-id="d2ddc0e" data-element_type="widget" data-widget_type="icon.default" data-post_id>
                                                <div class="elementor-widget-container">
                                                    <div class="elementor-icon-wrapper">
                                                        <button class="elementor-icon ivl-favorite-button" style="border: none; background-color: rgb(255, 105, 180);" data-post_id="' . $post_id . '" data-user_id="' . $user_id . '">
                                                            <svg aria-hidden="true" class="e-font-icon-svg e-far-heart" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" style="fill: rgb(255, 255, 255);"><path d="M458.4 64.3C400.6 15.7 311.3 23 256 79.3 200.7 23 111.4 15.6 53.6 64.3-21.6 127.6-10.6 230.8 43 285.5l175.4 178.7c10 10.2 23.4 15.9 37.6 15.9 14.3 0 27.6-5.6 37.6-15.8L469 285.6c53.5-54.7 64.7-157.9-10.6-221.3zm-23.6 187.5L259.4 430.5c-2.4 2.4-4.4 2.4-6.8 0L77.2 251.8c-36.5-37.2-43.9-107.6 7.3-150.7 38.9-32.7 98.9-27.8 136.5 10.5l35 35.7 35-35.7c37.8-38.5 97.8-43.2 136.5-10.6 51.1 43.1 43.5 113.9 7.3 150.8z"></path></svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a class="elementor-element elementor-element-6241159 e-con-full e-flex e-con e-child" data-id="6241159" data-element_type="container" href="' . $post_permalink . '">
                                <div class="elementor-element elementor-element-034a41d elementor-widget elementor-widget-heading" data-id="034a41d" data-element_type="widget" data-widget_type="heading.default">
                                    <div class="elementor-widget-container">
                                        <span class="elementor-heading-title elementor-size-default">For Sale</span>
                                    </div>
                                </div>
                                <div class="elementor-element elementor-element-34235b9 elementor-widget elementor-widget-theme-post-title elementor-page-title elementor-widget-heading" data-id="34235b9" data-element_type="widget" data-widget_type="theme-post-title.default">
                                    <div class="elementor-widget-container">
                                        <h3 class="elementor-heading-title elementor-size-default">' . $post_title . '</h3>
                                    </div>
                                </div>
                                <div class="elementor-element elementor-element-897087b elementor-icon-list--layout-inline elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list" data-id="897087b" data-element_type="widget" data-widget_type="icon-list.default">
                                    <div class="elementor-widget-container">
                                        <ul class="elementor-icon-list-items elementor-inline-items">
                                            <li class="elementor-icon-list-item elementor-inline-item">
                                                <span class="elementor-icon-list-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="e-font-icon-svg e-fas-tabler-icon-map-pin" viewBox="0 0 24 24"><path d="M12,14.8c-1,0-1.9-0.4-2.7-1.1S8.2,12,8.2,11c0-1,0.4-1.9,1.1-2.7c1.4-1.4,3.9-1.4,5.3,0c0.7,0.7,1.1,1.7,1.1,2.7 s-0.4,1.9-1.1,2.7S13,14.8,12,14.8z M12,8.8c-0.6,0-1.2,0.2-1.6,0.7c-0.4,0.4-0.7,1-0.7,1.6c0,0.6,0.2,1.2,0.7,1.6 c0.8,0.8,2.3,0.8,3.2,0c0.4-0.4,0.7-1,0.7-1.6c0-0.6-0.2-1.2-0.7-1.6C13.2,9,12.6,8.8,12,8.8z M12,22.2c-0.7,0-1.4-0.3-1.9-0.8 l-4.2-4.2c-1.2-1.2-2.1-2.8-2.4-4.5C3.1,11,3.3,9.3,3.9,7.7c0.7-1.6,1.8-3,3.2-3.9c2.9-1.9,6.8-1.9,9.7,0c1.4,1,2.6,2.3,3.2,3.9 c0.7,1.6,0.8,3.4,0.5,5.1c-0.3,1.7-1.2,3.3-2.4,4.5l0,0l-4.2,4.2C13.4,22,12.7,22.2,12,22.2z M12,3.8c-1.4,0-2.8,0.4-4,1.2 S5.9,6.9,5.3,8.2C4.8,9.6,4.6,11,4.9,12.4c0.3,1.4,1,2.7,2,3.7l4.2,4.2c0.5,0.5,1.3,0.5,1.8,0l4.2-4.2c1-1,1.7-2.3,2-3.7 s0.1-2.9-0.4-4.2C18.1,6.9,17.2,5.8,16,5S13.4,3.8,12,3.8z M17.7,16.7L17.7,16.7L17.7,16.7z"></path></svg>
                                                </span>
                                                <span class="elementor-icon-list-text">' . $post_location . '</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="elementor-element elementor-element-edfe604 e-con-full e-flex For Sale e-con e-child" data-id="edfe604" data-element_type="container">
				                    <div class="elementor-element elementor-element-a75ce7e elementor-widget elementor-widget-heading" data-id="a75ce7e" data-element_type="widget" data-widget_type="heading.default">
				                        <div class="elementor-widget-container">
			                                <div class="elementor-heading-title elementor-size-default">฿</div>
                                        </div>
				                    </div>
				                    <div class="elementor-element elementor-element-e62fea6 format_number price-sale elementor-widget elementor-widget-heading" data-id="e62fea6" data-element_type="widget" data-widget_type="heading.default">
				                        <div class="elementor-widget-container">
			                                <div class="elementor-heading-title elementor-size-default">' . $post_price . '</div>
                                        </div>
				                    </div>
				                </div>
                                <div class="elementor-element elementor-element-889d666 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-id="889d666" data-element_type="widget" data-widget_type="divider.default">
				                    <div class="elementor-widget-container">
			                            <style>/*! elementor - v3.23.0 - 15-07-2024 */
                                            .elementor-widget-divider{--divider-border-style:none;--divider-border-width:1px;--divider-color:#0c0d0e;--divider-icon-size:20px;--divider-element-spacing:10px;--divider-pattern-height:24px;--divider-pattern-size:20px;--divider-pattern-url:none;--divider-pattern-repeat:repeat-x}.elementor-widget-divider .elementor-divider{display:flex}.elementor-widget-divider .elementor-divider__text{font-size:15px;line-height:1;max-width:95%}.elementor-widget-divider .elementor-divider__element{margin:0 var(--divider-element-spacing);flex-shrink:0}.elementor-widget-divider .elementor-icon{font-size:var(--divider-icon-size)}.elementor-widget-divider .elementor-divider-separator{display:flex;margin:0;direction:ltr}.elementor-widget-divider--view-line_icon .elementor-divider-separator,.elementor-widget-divider--view-line_text .elementor-divider-separator{align-items:center}.elementor-widget-divider--view-line_icon .elementor-divider-separator:after,.elementor-widget-divider--view-line_icon .elementor-divider-separator:before,.elementor-widget-divider--view-line_text .elementor-divider-separator:after,.elementor-widget-divider--view-line_text .elementor-divider-separator:before{display:block;content:"";border-block-end:0;flex-grow:1;border-block-start:var(--divider-border-width) var(--divider-border-style) var(--divider-color)}.elementor-widget-divider--element-align-left .elementor-divider .elementor-divider-separator>.elementor-divider__svg:first-of-type{flex-grow:0;flex-shrink:100}.elementor-widget-divider--element-align-left .elementor-divider-separator:before{content:none}.elementor-widget-divider--element-align-left .elementor-divider__element{margin-left:0}.elementor-widget-divider--element-align-right .elementor-divider .elementor-divider-separator>.elementor-divider__svg:last-of-type{flex-grow:0;flex-shrink:100}.elementor-widget-divider--element-align-right .elementor-divider-separator:after{content:none}.elementor-widget-divider--element-align-right .elementor-divider__element{margin-right:0}.elementor-widget-divider--element-align-start .elementor-divider .elementor-divider-separator>.elementor-divider__svg:first-of-type{flex-grow:0;flex-shrink:100}.elementor-widget-divider--element-align-start .elementor-divider-separator:before{content:none}.elementor-widget-divider--element-align-start .elementor-divider__element{margin-inline-start:0}.elementor-widget-divider--element-align-end .elementor-divider .elementor-divider-separator>.elementor-divider__svg:last-of-type{flex-grow:0;flex-shrink:100}.elementor-widget-divider--element-align-end .elementor-divider-separator:after{content:none}.elementor-widget-divider--element-align-end .elementor-divider__element{margin-inline-end:0}.elementor-widget-divider:not(.elementor-widget-divider--view-line_text):not(.elementor-widget-divider--view-line_icon) .elementor-divider-separator{border-block-start:var(--divider-border-width) var(--divider-border-style) var(--divider-color)}.elementor-widget-divider--separator-type-pattern{--divider-border-style:none}.elementor-widget-divider--separator-type-pattern.elementor-widget-divider--view-line .elementor-divider-separator,.elementor-widget-divider--separator-type-pattern:not(.elementor-widget-divider--view-line) .elementor-divider-separator:after,.elementor-widget-divider--separator-type-pattern:not(.elementor-widget-divider--view-line) .elementor-divider-separator:before,.elementor-widget-divider--separator-type-pattern:not([class*=elementor-widget-divider--view]) .elementor-divider-separator{width:100%;min-height:var(--divider-pattern-height);-webkit-mask-size:var(--divider-pattern-size) 100%;mask-size:var(--divider-pattern-size) 100%;-webkit-mask-repeat:var(--divider-pattern-repeat);mask-repeat:var(--divider-pattern-repeat);background-color:var(--divider-color);-webkit-mask-image:var(--divider-pattern-url);mask-image:var(--divider-pattern-url)}.elementor-widget-divider--no-spacing{--divider-pattern-size:auto}.elementor-widget-divider--bg-round{--divider-pattern-repeat:round}.rtl .elementor-widget-divider .elementor-divider__text{direction:rtl}.e-con-inner>.elementor-widget-divider,.e-con>.elementor-widget-divider{width:var(--container-widget-width,100%);--flex-grow:var(--container-widget-flex-grow)}
                                        </style>		
                                        <div class="elementor-divider">
			                                <span class="elementor-divider-separator"></span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>';
            }
        }
        $output .= '</div></div></div>';
    } else {
        $output = '<p>No favorites found.</p>';
    }

    return $output;
}
add_shortcode('ivl_user_favorites', 'ivl_user_favorites_shortcode');


?>
