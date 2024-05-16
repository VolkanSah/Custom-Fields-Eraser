<?php
/**
 * Plugin Name: Custom Fields Manager
 * Plugin URI:        https://github.com/VolkanSah/Custom-Fields-Manager/
 * Description: Manage custom fields in your WordPress database
 * Version: 2.0
 * Requires at least: 5.2
 * Requires PHP:      7.4
 * Author:            S. Volkan Kücükbudak
 * Author URI:        https://volkansah.github.com
 * License:           GPLv3
 * License URI:       https://aicodecraft.io/license
 * Update URI:        https://github.com/VolkanSah/Custom-Fields-Manager//latest.zip
 * Text Domain:       aicc-cfm
 * Domain Path:       /languages
 */

/// Add the admin menu
add_action('admin_menu', 'custom_fields_manager_menu');

// Add AJAX action
add_action('wp_ajax_delete_custom_field', 'delete_custom_field_callback');

function custom_fields_manager_menu() {
    add_menu_page(
        'Custom Fields Manager',
        'Custom Fields',
        'manage_options',
        'custom-fields-manager',
        'custom_fields_manager_page'
    );
}

function custom_fields_manager_page() {
    // Render the plugin page
    echo '<div class="wrap">';
    echo '<h1>Custom Fields Manager</h1>';
    echo '<p>This plugin allows you to view and delete custom fields in your WordPress database.</p>';
    echo '<table class="wp-list-table widefat striped" id="custom-fields-table">';
    echo '<thead><tr><th>Custom Field</th><th>Action</th></tr></thead>';
    echo '<tbody>';
    echo '</tbody>';
    echo '</table>';
    echo '</div>';

    // Enqueue JavaScript
    wp_enqueue_script('custom-fields-manager', plugin_dir_url(__FILE__) . 'assets/js/custom-fields-manager.js', array('jquery'), '1.0', true);
    wp_localize_script('custom-fields-manager', 'cfmData', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('delete_custom_field')
    ));
}

function delete_custom_field_callback() {
    check_ajax_referer('delete_custom_field', 'security');

    $meta_key = sanitize_text_field($_POST['meta_key']);
    global $wpdb;
    $result = $wpdb->delete($wpdb->postmeta, array('meta_key' => $meta_key), array('%s'));

    if ($result === false) {
        wp_send_json_error(array('message' => 'Error deleting custom field "' . $meta_key . '".'));
    } else {
        wp_send_json_success(array('message' => 'Custom field "' . $meta_key . '" has been deleted.'));
    }
}
