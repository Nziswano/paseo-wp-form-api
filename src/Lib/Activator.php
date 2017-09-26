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

	// 	global $wpdb;
	// 	$charset_collate = $wpdb->get_charset_collate();
	// 	$table_name = $wpdb->prefix . 'contact_us';

	// 	$sql = "CREATE TABLE $table_name (
	// 	id mediumint(9) NOT NULL AUTO_INCREMENT,
	// 	fingerprint VARCHAR(15) NOT NULL,
	// 	contact_info JSON,
	// 	created TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	// 	UNIQUE KEY id (id)
	// ) $charset_collate;";

	// 	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	// 	dbDelta( $sql );

	}

}
