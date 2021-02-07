<?php

/*
  Plugin Name: Hasya Katta Live Video Chat
  Plugin URI: https://hasyakattalive.herokuapp.com
  Description: hasyakattalive Widget HTML and JavaScript. It can be addded in a page using the tag [hasyakattalive_widget] or just call do_action('hasyakattalive_widget');
  Version: 1
  Author: Smit Shetye - Hasya Katta Official
  Author URI: https://hasyakattaofficial.github.io/
 */

function html_hasyakattalive_code($names, $avatar, $roomId) {
    $hasyakattalive_css = (get_option('hasyakattalive_css') != '') ? get_option('hasyakattalive_css') : '';
    $message = (get_option('hasyakattalive_front_message') != '') ? get_option('hasyakattalive_front_message') : 'Start Video Chat';
    $names = $names ? $names : get_option('hasyakattalive_names');
    $avatar = $avatar ? $avatar : get_option('hasyakattalive_avatar');
    $hasyakattalive_server_url = (get_option('hasyakattalive_server_url') != '') ? get_option('hasyakattalive_server_url') : '';
    echo '<div id="nd-widget-container" class="nd-widget-container"></div> 
	<script id="newdev-embed-script" data-room-id="'.$roomId.'" data-names="'.$names.'" data-avatar="'.$avatar.'" data-message="'.$message.'" data-button-css="'.$hasyakattalive_css.'" data-source_path="' . $hasyakattalive_server_url . '" src="' . $hasyakattalive_server_url . 'js/widget.js" async></script>';
}

function ls_shortcode($atts = [], $content = null, $tag = '') {
    $names = isset($atts['names']) ? $atts['names'] : '';
    $avatar = isset($atts['avatar']) ? $atts['avatar'] : '';
    $roomId = isset($atts['roomId']) ? $atts['roomId'] : '';
    ob_start();
    html_hasyakattalive_code($names, $avatar, $roomId);

    return ob_get_clean();
}

add_shortcode('hasyakattalive_widget', 'ls_shortcode');

add_action('admin_menu', 'hasyakattalive_plugin_settings');

add_action('hasyakattalive_widget', 'html_hasyakattalive_code');

function hasyakattalive_plugin_settings() {
    add_menu_page('hasyakattalive Settings', 'hasyakattalive Settings', 'administrator', 'fwds_settings', 'hasyakattalive_display_settings');
}

function hasyakattalive_display_settings() {

    $hasyakattalive_server_url = (get_option('hasyakattalive_server_url') != '') ? get_option('hasyakattalive_server_url') : '';
    $hasyakattalive_css = (get_option('hasyakattalive_css') != '') ? get_option('hasyakattalive_css') : '';
    $message = (get_option('hasyakattalive_front_message') != '') ? get_option('hasyakattalive_front_message') : '';
    $names = (get_option('hasyakattalive_names') != '') ? get_option('hasyakattalive_names') : '';
    $avatar = (get_option('hasyakattalive_avatar') != '') ? get_option('hasyakattalive_avatar') : '';
    $html = '<div class="wrap">

            <form method="post" name="options" action="options.php">

            <h2>Select Your Settings</h2>' . wp_nonce_field('update-options') . '
            <table width="300" cellpadding="2" class="form-table">
                <tr>
                    <td align="left" scope="row">
                    <label>Server URL</label>
                    </td> 
                    <td><input type="text" style="width: 400px;" name="hasyakattalive_server_url" 
                    value="' . $hasyakattalive_server_url . '" /></td>
                </tr>      
                <tr>
                    <td align="left" scope="row">
                    <label>Button CSS</label>
                    </td> 
                    <td><input type="text" style="width: 400px;" name="hasyakattalive_css" 
                    value="' . $hasyakattalive_css . '" /></td>
                </tr>
                <tr>
                    <td align="left" scope="row">
                    <label>Button Message</label>
                    </td> 
                    <td><input type="text" style="width: 400px;" name="hasyakattalive_front_message" 
                    value="' . $message . '" /></td>
                </tr>
                <tr>
                    <td align="left" scope="row">
                    <label>Agent Name</label>
                    </td> 
                    <td><input type="text" style="width: 400px;" name="hasyakattalive_names" 
                    value="' . $names . '" /></td>
                </tr>
                <tr>
                    <td align="left" scope="row">
                    <label>Agent Avatar</label>
                    </td> 
                    <td><input type="text" style="width: 400px;" name="hasyakattalive_avatar" 
                    value="' . $avatar . '" /></td>
                </tr>

            </table>
            <p class="submit">
                <input type="hidden" name="action" value="update" />  
                <input type="hidden" name="page_options" value="hasyakattalive_names,hasyakattalive_avatar,hasyakattalive_server_url,hasyakattalive_front_message,hasyakattalive_css" /> 
                <input type="submit" name="Submit" value="Update" />
            </p>
            </form>

        </div>';
    echo $html;
}

?>