<?php
namespace Paseo\Lib;

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Paseo_Wp_Form_Api
 * @subpackage Paseo_Wp_Form_Api/includes
 * @author     Johan Martin <johan@paseo.org.za>
 */
class Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		global $wpdb;
		$charset_collate = $wpdb->get_charset_collate();
		$table_name = $wpdb->prefix . DB_TABLE;

		$sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		fingerprint VARCHAR(75) NOT NULL,
		contact_info JSON,
		created TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		UNIQUE KEY id (id)
	) $charset_collate;";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );

	}

  /**
   * Update database
   */
	public static function update_db () {

	  $option_key = \DB_TABLE . '_db_version';
	  $db_version = \DB_SCHEMA_VERSION;
	  $current_version = \get_option( $option_key );

	  if ($db_version == $current_version) {
	    return;
    }

	  global $wpdb;

    $charset_collate = $wpdb->get_charset_collate();
    $table_name = $wpdb->prefix . DB_TABLE;

    $sql = "CREATE TABLE $table_name (
    id mediumint(9) NOT NULL AUTO_INCREMENT,
    fingerprint VARCHAR(75) NOT NULL,
    contact_info JSON,
    is_processed BOOLEAN NOT NULL DEFAULT FALSE,
    created TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY id (id)
    ) $charset_collate;";

    require_once(\ABSPATH . 'wp-admin/includes/upgrade.php');
    \dbDelta( $sql );

    update_option( $option_key, $db_version );

  }

  /**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	 public static function deactivate() {

	 }

}
