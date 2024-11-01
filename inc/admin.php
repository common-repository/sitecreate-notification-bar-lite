<?php

//======================================================================
// REGISTER SETTINGS PAGE
//======================================================================
add_action('admin_menu', function() {
    add_options_page( 'SiteCreate Notifications', 'Really Useful Bar Lite', 'manage_options', 'sc-notifications-lite', 'sc_notification_lite_settings_page' );
});
 
 
add_action( 'admin_init', function() {
    register_setting( 'sc-notification-bar-settings', 'sc_notification_options' , 'sitecreate_notifications_lite_sanitize_settings');   
});

//======================================================================
// CREATE SETTINGS PAGE
//======================================================================
function sc_notification_lite_settings_page() {

    $social_icons = array(
        'facebook' => 'Facebook',
        'dribbble' => 'Dribbble',
        'behance' => 'Behance',
        'git' => 'GitHub',
        'google-plus-official' => 'Google+',
        'xing' => 'Xing',
        'instagram' => 'Instagram',
        'twitter' => 'Twitter',
        'youtube' => 'Youtube',
        'slack' => 'Slack',
        'pinterest' => 'Pinterest',
        'tumblr' => 'Tumblr',
        'soundcloud' => 'Soundcloud',
        'skype' => 'Skype',
        'linkedin' => 'LinkedIn',
        'vimeo' => 'Vimeo',
        'flickr' => 'Flickr',
        'vk' => 'VK',
        '500px' => '500px',
        'envelope-o' => 'Email'
    );

  ?>
    <div class="wrap">

    <h2 style="margin-bottom: 20px;"><?php echo __( 'SiteCreate Notification Bar', 'sc-notification-bar' ); ?></h2>

    <h2 class="nav-tab-wrapper" id="sc-admin-tabs">
        <a href="#notifications" class="nav-tab active"><?php echo __( 'Notifications', 'sc-notification-bar' ); ?></a>
        <a href="#social" class="nav-tab"><?php echo __( 'Social Profiles/Extras', 'sc-notification-bar' ); ?></a>
        <a href="#styling" class="nav-tab"><?php echo __( 'Styling', 'sc-notification-bar' ); ?></a>
        <a href="#settings" class="nav-tab"><?php echo __( 'Settings', 'sc-notification-bar' ); ?></a>
        <a href="#upgrade" class="nav-tab"><?php echo __( 'Upgrade To Pro', 'sc-notification-bar' ); ?></a>
    </h2>

  	<form action="options.php" method="post" id="sc-settings-wrapper">
 
        <?php
          settings_fields( 'sc-notification-bar-settings' );
          do_settings_sections( 'sc-notification-bar-settings' );
        ?>
        <div id="sc-submit-wrapper">
     		<?php submit_button(); ?>
        </div>
       
        <table id="notifications">
            <tr>
                <th><?php echo __( 'Manage Notification', 'sc-notification-bar' ); ?><small><?php echo __( 'You can use text as well as shortcodes (for forms etc)', 'sc-notification-bar' ); ?></small></th>
            </tr>                     
        	<tr>  
                <?php $repeatable = get_option('sc_notification_options'); ?>
            	<td>
					<div id="sc-notification-repeater">
    					<p class="sc-notification-repeatable">
                            <label for="p_scnts">
                                <textarea id='sc_notification_options[content]' name='sc_notification_options[content]' rows='4' cols='50' type='textarea'><?php echo wp_kses_post($repeatable['content']); ?></textarea>
                            </label>
                            <label for="p_scnts">
                                <input type="text" id="p_scnt" size="20" name="sc_notification_options[link]" value="<?php echo esc_url($repeatable['link']); ?>" placeholder="URL" />
                            </label>
                            <label for="p_scnts">
                                <input type="text" id="p_scnt" size="20" name="sc_notification_options[label]" value="<?php echo wp_kses_post($repeatable['label']); ?>" placeholder="Label" />
                            </label>
                        </p>
					</div>
				</td>
				
		 	</tr>
        </table>

        <table id="social">
             
            <?php $repeatable = get_option('sc_notification_options'); ?>
            <tr>
                <th><?php echo __( 'Social Icon 1', 'sc-notification-bar' ); ?><small><?php echo __( 'Select a social network', 'sc-notification-bar' ); ?></small></th>
                <td>
                    <select name="sc_notification_options[social_icon_1]">
                        <?php 
                        foreach ($social_icons as $icon => $value) { ?>
                            <option value="<?php echo esc_attr($icon); ?>" <?php selected( $repeatable['social_icon_1'], $icon ); ?>><?php echo esc_attr($value); ?></option>';
                            <?php
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th><?php echo __( 'Social Icon 1 URL', 'sc-notification-bar' ); ?><small><?php echo __( 'Enter your profile URL', 'sc-notification-bar' ); ?></small></th>
                <td><input type="text"  name="sc_notification_options[social_icon_1_url]" value="<?php echo esc_attr($repeatable['social_icon_1_url']); ?>"/></td>
            </tr>  

            <tr>
                <th><?php echo __( 'Social Icon 2', 'sc-notification-bar' ); ?></th>
                <td>
                    <select name="sc_notification_options[social_icon_2]">
                        <?php 
                        foreach ($social_icons as $icon => $value) { ?>
                            <option value="<?php echo esc_attr($icon); ?>" <?php selected( $repeatable['social_icon_2'], $icon ); ?>><?php echo esc_attr($value); ?></option>';
                            <?php
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th><?php echo __( 'Social Icon 2 URL', 'sc-notification-bar' ); ?></th>
                <td><input type="text"  name="sc_notification_options[social_icon_2_url]" value="<?php echo esc_attr($repeatable['social_icon_2_url']); ?>"/></td>
            </tr>  

            <tr>
                <th><?php echo __( 'Social Icon 3', 'sc-notification-bar' ); ?></th>
                <td>
                    <select name="sc_notification_options[social_icon_3]">
                        <?php 
                        foreach ($social_icons as $icon => $value) { ?>
                            <option value="<?php echo esc_attr($icon); ?>" <?php selected( $repeatable['social_icon_3'], $icon ); ?>><?php echo esc_attr($value); ?></option>';
                            <?php
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th><?php echo __( 'Social Icon 3 URL', 'sc-notification-bar' ); ?></th>
                <td><input type="text"  name="sc_notification_options[social_icon_3_url]" value="<?php echo esc_attr($repeatable['social_icon_3_url']); ?>"/></td>
            </tr>   
 
        </table>

        <table id="styling">
             
            <?php $repeatable = get_option('sc_notification_options'); 
            if(!isset($repeatable['bg_colour'])) { $bg_colour = '#f5f5f5'; } else { $bg_colour = $repeatable['bg_colour']; }
            if(!isset($repeatable['text_colour'])) { $text_colour = '#222222'; } else { $text_colour = $repeatable['text_colour']; }
            if(!isset($repeatable['text_font_size'])) { $text_font_size = '14px'; } else { $text_font_size = $repeatable['text_font_size']; }
            if(!isset($repeatable['btn_bg_colour'])) { $btn_bg_colour = '#222222'; } else { $btn_bg_colour = $repeatable['btn_bg_colour']; }
            if(!isset($repeatable['btn_colour'])) { $btn_colour = '#ffffff'; } else { $btn_colour = $repeatable['btn_colour']; }
            if(!isset($repeatable['btn_hover_bg_colour'])) { $btn_hover_bg_colour = '#000000'; } else { $btn_hover_bg_colour = $repeatable['btn_hover_bg_colour']; }
            if(!isset($repeatable['btn_hover_colour'])) { $btn_hover_colour = '#eeeeee'; } else { $btn_hover_colour = $repeatable['btn_hover_colour']; }
            if(!isset($repeatable['btn_border_radius'])) { $btn_border_radius = '30px'; } else { $btn_border_radius = $repeatable['btn_border_radius']; }
            ?>                

            <tr>
                <th><?php echo __( 'Background Colour', 'sc-notification-bar' ); ?><small><?php echo __( 'Enter a background colour for the bar', 'sc-notification-bar' ); ?></small></th>
                <td><input type="text"  name="sc_notification_options[bg_colour]" value="<?php echo esc_attr($bg_colour); ?>" class="wp-color-picker-field" data-default-color="#f5f5f5" data-alpha="true" /></td>
            </tr>     

            <tr>
                <th><?php echo __( 'Text Colour', 'sc-notification-bar' ); ?><small><?php echo __( 'Select the text colour for the content within the bar', 'sc-notification-bar' ); ?></small></th>
                <td><input type="text"  name="sc_notification_options[text_colour]" value="<?php echo esc_attr($text_colour); ?>" class="wp-color-picker-field" data-default-color="#222222"/></td>
            </tr> 
            <tr>
                <th><?php echo __( 'Font Size', 'sc-notification-bar' ); ?><small><?php echo __( 'Enter a font size to suit your themes style', 'sc-notification-bar' ); ?></small></th>
                <td><input type="text"  name="sc_notification_options[text_font_size]" value="<?php echo esc_attr($text_font_size); ?>" placeholder="14px"/></td>
            </tr> 

            <tr>
                <th><?php echo __( 'Button Background Colour', 'sc-notification-bar' ); ?><small><?php echo __( 'Select a background colour for the main notification button', 'sc-notification-bar' ); ?></small></th>
                <td><input type="text"  name="sc_notification_options[btn_bg_colour]" value="<?php echo esc_attr($btn_bg_colour); ?>" class="wp-color-picker-field" data-default-color="#292929"/></td>
            </tr>
            <tr>
                <th><?php echo __( 'Button Label Colour', 'sc-notification-bar' ); ?><small><?php echo __( 'Select a colour for button label/text', 'sc-notification-bar' ); ?></small></th>
                <td><input type="text"  name="sc_notification_options[btn_colour]" value="<?php echo esc_attr($btn_colour); ?>" class="wp-color-picker-field" data-default-color="#ffffff"/></td>
            </tr>
            <tr>
                <th><?php echo __( 'Button Hover Background Colour', 'sc-notification-bar' ); ?><small><?php echo __( 'Select a hover background colour for the main notification button', 'sc-notification-bar' ); ?></small></th>
                <td><input type="text"  name="sc_notification_options[btn_hover_bg_colour]" value="<?php echo esc_attr($btn_hover_bg_colour); ?>" class="wp-color-picker-field" data-default-color="#000000"/></td>
            </tr>
            <tr>
                <th><?php echo __( 'Button Hover Label Colour', 'sc-notification-bar' ); ?><small><?php echo __( 'Select a hover colour for button label/text', 'sc-notification-bar' ); ?></small></th>
                <td><input type="text"  name="sc_notification_options[btn_hover_colour]" value="<?php echo esc_attr($btn_hover_colour); ?>" class="wp-color-picker-field" data-default-color="#eeeeee"/></td>
            </tr>
            <tr>
                <th><?php echo __( 'Button Border Radius', 'sc-notification-bar' ); ?><small><?php echo __( 'Enter a border radius (in px) for the button', 'sc-notification-bar' ); ?></small></th>
                <td><input type="text"  name="sc_notification_options[btn_border_radius]" value="<?php echo esc_attr($btn_border_radius); ?>" placeholder="30px"/></td>
            </tr> 
 
        </table>

        <table id="settings">
             
            <?php 
            $repeatable = get_option('sc_notification_options'); 
            if(!isset($repeatable['cookie_name'])) { $cookie_name = 'sc-bar-closed-cookie'; } else { $cookie_name = $repeatable['cookie_name']; }
            ?>
            <tr>
                <th><?php echo __( 'Bar Position', 'sc-notification-bar' ); ?><small><?php echo __( 'Choose the position for you bar', 'sc-notification-bar' ); ?></small></th>
                <td>
                    <select name="sc_notification_options[position]">
                        <option value="relative" <?php selected( $repeatable['position'], 'relative' ); ?>>Relative Above Header</option>
                        <option value="fixed-top" <?php selected( $repeatable['position'], 'fixed-top' ); ?>>Fixed Top Of Browser</option>
                        <option value="fixed-bottom" <?php selected( $repeatable['position'], 'fixed-bottom' ); ?>>Fixed Bottom Of Browser</option>
                    </select>
                </td>
            </tr>

            <tr>
                <th><?php echo __( 'Cookie ID', 'sc-notification-bar' ); ?><small><?php echo __( 'Change this to create a new cookie ID', 'sc-notification-bar' ); ?></small></th>
                <td><input type="text"  name="sc_notification_options[cookie_name]" value="<?php echo esc_attr($cookie_name); ?>" placeholder="sc-notifications-bar-cookie"/> <a href="#" id="refresh-cookie"><?php echo __( 'Randomize Cookie Name', 'sc-notification-bar' ); ?></a></td> 
            </tr>   

            <tr>
                <th><?php echo __( 'Show Close Button', 'sc-notification-bar' ); ?><small><?php echo __( 'Enable/Disable the close button', 'sc-notification-bar' ); ?></small></th>
                <td>
                    <select name="sc_notification_options[show_close]">
                        <option value="show" <?php selected( $repeatable['show_close'], 'show' ); ?>>Show Close Button</option>
                        <option value="dont_show" <?php selected( $repeatable['show_close'], 'dont_show' ); ?>>Hide Close Button</option>
                    </select>
                </td>
            </tr>
 
        </table>

        <table id="upgrade">
            
            <tr>
                <th><?php echo __( 'Want to add more notification, background images and more? Check out the PRO verison here', 'sc-notification-bar' ); ?></th>
                <td><a href="https://www.sitecreate.io/wordpress-plugins/sitecreate-really-useful-notification-bar-wordpress/?ref=wporg" class="button-primary"><?php echo __( 'Upgrade Now', 'sc-notification-bar' ); ?></a></td> 
            </tr>   
 
        </table>
 
      </form>
    </div>
  <?php
}