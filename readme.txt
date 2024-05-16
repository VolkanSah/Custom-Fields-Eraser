=== Custom Fields Eraser ===
Contributors: volkansah
Tags: custom fields, delete, admin tools, database management, security, tuning
Requires at least: 4.6
Tested up to: 5.8
Stable tag: 1.0
Requires PHP: 5.6
License: GPLv3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Custom Fields Eraser allows experienced administrators to view and delete custom fields from the WordPress database.

== Description ==

Custom Fields Eraser is a powerful tool for WordPress administrators to manage and clean up custom fields in the database. It adds a new "Custom Fields" menu item in the WordPress admin menu, allowing users to view and delete custom fields, excluding some internal fields like `_edit_last` and `_edit_lock`.

**Warning: Deleting custom fields can potentially break your site. This plugin is intended for experienced administrators only.**

Over time, as you install and test various plugins and themes, your WordPress database can become cluttered with numerous custom fields. These fields can bloat your database, impacting performance and making it difficult to manage your data. Custom Fields Eraser helps you identify and remove unnecessary custom fields, keeping your database clean and optimized.

= Features =

* Custom Fields Management: View and delete custom fields from the WordPress database.
* Permission Verification: Ensures that only users with `manage_options` capability can access the plugin's functionalities.
* Input Sanitization: Utilizes `sanitize_text_field()` to sanitize the `$meta_key` before it is used in SQL queries or displayed.
* WordPress Functions: Employs WordPress functions like `$wpdb->get_results()` and `$wpdb->delete()` to handle database interactions securely.
* AJAX Security: Uses `check_ajax_referer()` to validate the security token (Nonce) for AJAX requests.

== Installation ==

1. Download the plugin and upload it to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.

== Frequently Asked Questions ==

= Who should use this plugin? =

This plugin is intended for experienced administrators who need to manage custom fields in the WordPress database.

= Can deleting custom fields break my site? =

Yes, deleting certain custom fields can potentially break your site. Ensure you know what you are deleting and why.

== Screenshots ==

1. Screenshot of the plugin interface showing the list of custom fields with delete options.

== Changelog ==

= 1.0 =
* Initial release.

== Upgrade Notice ==

= 1.0 =
Initial release.

== Support ==

For support and feature requests, please open an issue on the [GitHub repository](https://github.com/your-repository).
