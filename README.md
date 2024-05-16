# Custom-Fields-Manager for your WordPress website
Delete custom fields in your WordPress database

This plugin adds a new "Custom Fields" menu item in the WordPress admin menu. When the user clicks on it, the plugin displays a list of all custom fields in the database, excluding some internal fields like _edit_last and _edit_lock.

For each custom field, the plugin provides a "Delete" button that allows you to remove the custom field from the database.

To use this plugin, simply install and activate it in your WordPress site. Then, go to the "Custom Fields" menu item in the admin menu to manage your custom fields.


### erledigt


    Überprüfung der Berechtigungen: Die Funktionen custom_fields_manager_menu() und load_custom_fields_callback() / delete_custom_field_callback() prüfen, ob der Benutzer die erforderlichen Berechtigungen (in diesem Fall manage_options) hat, bevor sie ausgeführt werden.

    Sanitisierung der Eingaben: Die Funktion sanitize_text_field() wird verwendet, um den $meta_key zu bereinigen, bevor er in SQL-Abfragen oder bei der Anzeige verwendet wird.

    Verwendung von WordPress-Funktionen: Anstatt direkt auf die Datenbank zuzugreifen, werden WordPress-Funktionen wie $wpdb->get_results() und $wpdb->delete() verwendet, die automatisch Sicherheitsmaßnahmen wie Escaping und Vorbereitung der Abfragen durchführen.

    Verwendung von AJAX-Sicherheitsmaßnahmen: Die AJAX-Funktionen verwenden check_ajax_referer(), um die Gültigkeit des Sicherheitstokens (Nonce) zu überprüfen, bevor sie ausgeführt werden.

