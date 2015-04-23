<?php

/*
  Plugin Name: LeadSecure Widget
  Plugin URI: http://leadsecure.com
  Description: LeadSecure Widget HTML and JavaScript. It can be addded in a page using the tag [leadsecure_widget] or just call do_action('leadsecure_widget');
  Version: 1.0
  Author: Nikolay Hadjidimitrov
  Author URI: http://leadsecure.com
 */

function html_leadsecure_code() {
    $leadsecure_tennant_id = (get_option('leadsecure_tennant_id') != '') ? get_option('leadsecure_tennant_id') : '';
    $leadsecure_css = (get_option('leadsecure_css') != '') ? get_option('leadsecure_css') : '';
    $message = (get_option('leadsecure_front_message') != '') ? get_option('leadsecure_front_message') : '';
    $leadsecure_server_url = (get_option('leadsecure_server_url') != '') ? get_option('leadsecure_server_url') : 'http://prod.leadsecure.com/static/';
    echo '<div id="instacollab-widget-container"></div>
            <script id="instacollab-embed-script" data-instacollab_css="'.$leadsecure_css.'" data-plugin="wordpress" data-instacollab_message="'.$message.'" data-source-path="' . $leadsecure_server_url . '" data-tenant-id="' . $leadsecure_tennant_id . '" src="' . $leadsecure_server_url . 'widgets/widget.js" async></script>';
}

function ls_shortcode() {
    ob_start();
    html_leadsecure_code();

    return ob_get_clean();
}

add_shortcode('leadsecure_widget', 'ls_shortcode');

add_action('admin_menu', 'leadsecure_plugin_settings');

add_action('leadsecure_widget', 'html_leadsecure_code');

function leadsecure_plugin_settings() {
    add_menu_page('LeadSecure Settings', 'LeadSecure Settings', 'administrator', 'fwds_settings', 'leadsecure_display_settings');
}

function leadsecure_display_settings() {


    $leadsecure_tennant_id = (get_option('leadsecure_tennant_id') != '') ? get_option('leadsecure_tennant_id') : '';
    $leadsecure_server_url = (get_option('leadsecure_server_url') != '') ? get_option('leadsecure_server_url') : 'http://prod.leadsecure.com/static/';
    $leadsecure_css = (get_option('leadsecure_css') != '') ? get_option('leadsecure_css') : '';
    $message = (get_option('leadsecure_front_message') != '') ? get_option('leadsecure_front_message') : '';
    $html = '<div class="wrap">

            <form method="post" name="options" action="options.php">

            <h2>Select Your Settings</h2>' . wp_nonce_field('update-options') . '
            <table width="300" cellpadding="2" class="form-table">
                <tr>
                    <td align="left" scope="row">
                    <label>Server URL</label>
                    </td> 
                    <td><input type="text" style="width: 400px;" name="leadsecure_server_url" 
                    value="' . $leadsecure_server_url . '" /></td>
                </tr>                
                <tr>
                    <td align="left" scope="row">
                    <label>User ID</label>
                    </td> 
                    <td><input type="text" style="width: 400px;" name="leadsecure_tennant_id" 
                    value="' . $leadsecure_tennant_id . '" /></td>
                </tr>
                <tr>
                    <td align="left" scope="row">
                    <label>Front Message</label>
                    </td> 
                    <td><input type="text" style="width: 400px;" name="leadsecure_front_message" 
                    value="' . $message . '" /></td>
                </tr>
                <tr>
                    <td align="left" scope="row">
                    <label>Custom CSS file</label>
                    </td> 
                    <td><input type="text" style="width: 400px;" name="leadsecure_css" 
                    value="' . $leadsecure_css . '" /></td>
                </tr>
            </table>
            <p class="submit">
                <input type="hidden" name="action" value="update" />  
                <input type="hidden" name="page_options" value="leadsecure_tennant_id,leadsecure_server_url,leadsecure_front_message,leadsecure_css" /> 
                <input type="submit" name="Submit" value="Update" />
            </p>
            </form>

        </div>';
    echo $html;
}

?>