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

// Add the admin menu
add_action('admin_menu', 'custom_fields_manager_menu');

function custom_fields_manager_menu() {
    add_menu_page(
        'Custom Fields Manager',
        'Custom Fields',
        'manage_options',
        'custom-fields-manager',
        'custom_fields_manager_page'
    );
}

// Render the plugin page
function custom_fields_manager_page() {
    global $wpdb;

    // Get all custom fields
    $custom_fields = $wpdb->get_results("
        SELECT DISTINCT meta_key
        FROM {$wpdb->postmeta}
        WHERE meta_key NOT IN ('_edit_last', '_edit_lock')
    ");

    // Display the custom fields
    echo '<div class="wrap">';
    echo '<h1>Custom Fields Manager</h1>';
    echo '<p>This plugin allows you to view and delete custom fields in your WordPress database.</p>';
    echo '<table class="wp-list-table widefat striped">';
    echo '<thead><tr><th>Custom Field</th><th>Action</th></tr></thead>';
    echo '<tbody>';

    foreach ($custom_fields as $field) {
        echo '<tr>';
        echo '<td>' . $field->meta_key . '</td>';
        echo '<td><a href="?page=custom-fields-manager&action=delete&meta_key=' . $field->meta_key . '" class="button button-danger">Delete</a></td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '</div>';

    // Handle delete action
    if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['meta_key'])) {
        $meta_key = sanitize_text_field($_GET['meta_key']);
        $result = $wpdb->delete($wpdb->postmeta, array('meta_key' => $meta_key), array('%s'));
        if ($result === false) {
            echo '<div class="notice notice-error is-dismissible"><p>Error deleting custom field "' . $meta_key . '".</p></div>';
        } else {
            echo '<div class="notice notice-success is-dismissible"><p>Custom field "' . $meta_key . '" has been deleted.</p></div>';
        }
    }
}
