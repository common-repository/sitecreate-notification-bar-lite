<?php

/*
Plugin Name: SiteCreate Really Useful Notification Bar Lite
Plugin URI: https://www.sitecreate.io/wordpress-plugins/sitecreate-really-useful-notification-bar-wordpress/
Description: Display a neat, attention grabbing notification bar. Complete with customization options and easy to use settings.
Version: 1.0.1
Author: SiteCreate
Author URI: https://www.sitecreate.io
Text Domain: sc-documentor
Domain Path: /languages
Requires at least: wordpress 4.5.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

require_once('inc/admin.php'); 

//======================================================================
// SANITIZATION
//======================================================================
function sitecreate_notifications_lite_sanitize_settings( $input ) {

    $output = array();
	$repeatable_inputs = array();
	$repeatable_inputs_again = array();

    foreach( $input as $input => $value ) {

        if($input == 'repeatable') {
        	foreach ($value as $name => $value) {
        		foreach ($value as $k => $v) {
        			if($key == 'link') {
        				$value[$key] = esc_url($v);
        			} else {
        				$value[$key] = wp_kses_post($v);
        			}
        		}
        		$repeatable_inputs[$name] = $value;
        	}
        	$output[$input] = $repeatable_inputs;
        } else {
        	$output[$input] = sanitize_text_field($value);
        }        
         
    } 

    return $output;
 
}

//======================================================================
// ADMIN SCRIPTS
//======================================================================
function sc_notifications_lite_enqueue_scripts() {
    wp_register_script( 'sc-notifications-admin-js', plugin_dir_url( __FILE__ ) . 'assets/admin.js', array('jquery','media-upload','thickbox', 'wp-color-picker') );
 
    if ( 'settings_page_sc-notifications-lite' == get_current_screen() -> id ) {
        wp_enqueue_script('jquery'); 
        wp_enqueue_script('thickbox');
        wp_enqueue_style('thickbox');
        wp_enqueue_style( 'wp-color-picker' ); 
        wp_enqueue_script('media-upload');
        wp_enqueue_script('sc-notifications-admin-js');
        wp_enqueue_media();
        wp_enqueue_style( 'sc-notifications-admin-css', plugin_dir_url( __FILE__ ) . 'assets/admin.css' );
 
    }
 
}

add_action('admin_enqueue_scripts', 'sc_notifications_lite_enqueue_scripts');

//======================================================================
// FRONT END SCRIPTS
//======================================================================
function sc_notifications_lite_front_end_enqueue_script() {   
    wp_enqueue_script( 'sc-notifications-js', plugin_dir_url( __FILE__ ) . 'assets/sc-notification-bar.js', array('jquery') );
    wp_enqueue_style( 'sc-notifications-css', plugin_dir_url( __FILE__ ) . 'assets/sc-notification-bar.css' );
}

add_action('wp_enqueue_scripts', 'sc_notifications_lite_front_end_enqueue_script');

//======================================================================
// OUTPUT THE BAR
//======================================================================
function sc_notifications_lite_add_to_footer() {
    $notifications = get_option('sc_notification_options');
    $cookie_name = $notifications['cookie_name'];

    if(!isset($_COOKIE[$cookie_name])) {

    
            echo '
            <div id="sc-notifications-bar" data-scnb-cookie-name="'.esc_attr($notifications['cookie_name']).'" data-scnb-position="'.esc_attr($notifications['position']).'">';

            echo '<div id="sc-notifications-bar-content-wrapper">';

                echo '<div id="sc-notifications-bar-socials">';
                if(isset($notifications['social_icon_1']) && !empty($notifications['social_icon_1_url'])) {
                    echo '<a href="'.esc_url($notifications['social_icon_1_url']).'"><i class="zocial '.esc_attr($notifications['social_icon_1']).'"></i></a>';
                }
                if(isset($notifications['social_icon_2']) && !empty($notifications['social_icon_2_url'])) {
                    echo '<a href="'.esc_url($notifications['social_icon_2_url']).'"><i class="zocial '.esc_attr($notifications['social_icon_2']).'"></i></a>';
                }
                if(isset($notifications['social_icon_3']) && !empty($notifications['social_icon_3_url'])) {
                    echo '<a href="'.esc_url($notifications['social_icon_3_url']).'"><i class="zocial '.esc_attr($notifications['social_icon_3']).'"></i></a>';
                }
                if(isset($notifications['social_icon_4']) && !empty($notifications['social_icon_4_url'])) {
                    echo '<a href="'.esc_url($notifications['social_icon_4_url']).'"><i class="zocial '.esc_attr($notifications['social_icon_4']).'"></i></a>';
                }
                echo '</div>';


                echo '<div class="container">
                        <ul id="ticker">';

                echo '<li>';

                        echo '<span class="sc-notifications-content">'.do_shortcode($notifications['content']).'</span>'; if(!empty($notifications['link'])) { echo '<a class="btn" href="'.esc_url($notifications['link']).'">'.esc_attr($notifications['label']).'</a>'; }

                    echo '</li>';

                echo '  </ul>
                    </div>';

                if($notifications['show_close'] == 'show') { 
                    echo '<a href="#" class="sc-notifications-bar-close"></a>';                    
                }

                echo '</div>';

            echo '
            </div>';
        ?>

        <style type="text/css">
            #sc-notifications-bar {
                background-color: <?php echo esc_attr($notifications["bg_colour"]); ?>;
            }
            #sc-notifications-bar li, #sc-notifications-bar i {
                color: <?php echo esc_attr($notifications["text_colour"]); ?>;
            }
            .sc-notifications-bar-close:before, .sc-notifications-bar-close:after, .sc-search-bar-close:before, .sc-search-bar-close:after {
                background-color: <?php echo esc_attr($notifications["text_colour"]); ?>;                
            }
            #sc-notifications-bar li span, #sc-notifications-bar i {
                font-size: <?php echo esc_attr($notifications["text_font_size"]); ?>;
            }
            #sc-notifications-bar .btn {
                background-color: <?php echo esc_attr($notifications["btn_bg_colour"]); ?>;
                color: <?php echo esc_attr($notifications["btn_colour"]); ?>;
                border-radius: <?php echo esc_attr($notifications["btn_border_radius"]); ?>;
            }
            #sc-notifications-bar .btn * {
                color: <?php echo esc_attr($notifications["btn_colour"]); ?>;
            }
            #sc-notifications-bar .btn:hover {
                background-color: <?php echo esc_attr($notifications["btn_hover_bg_colour"]); ?>;
                color: <?php echo esc_attr($notifications["btn_hover_colour"]); ?>;
            }
            #sc-notifications-bar .btn:hover * {
                color: <?php echo esc_attr($notifications["btn_hover_colour"]); ?>;
            }          
        </style>

        <?php

    }
}

add_action('wp_footer', 'sc_notifications_lite_add_to_footer'); 
