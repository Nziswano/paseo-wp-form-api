<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.johan-martin.com
 * @since             0.0.1
 * @package           Paseo_Wp_Form_Api
 *
 * @wordpress-plugin
 * Plugin Name:       Paseo Forms API
 * Plugin URI:        https://github.com/catenare/paseo-wp-form-api
 * Description:       Paseo contact us plugin. Demo plugin for Wordpress.
 * Version:           1.0.0
 * Author:            Johan Martin
 * Author URI:        http://www.johan-martin.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       paseo-wp-form-api
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

$exit_message = 'Requires Wordpress 4.8 or newer or PHP 7+';

// Check PHP Version
if (version_compare( PHP_VERSION, '7.0.0', '<')) {
	exit ($exit_message);
}

// Check Wordpress Version
global $wp_version;
if (version_compare($wp_version, "4.7", "<")){
	exit( $exit_message );
}

require ABSPATH . '../vendor/autoload.php';

const GET = "GET";
const POST = "POST";
const ROUTE = 'paseo/v1';
const FINGERPRINT = 'PAS-Fingerprint';
const CAPTCHA = 'PAS-Captcha';
const DB_TABLE = 'contact_us';
const NONCE_HEADER = 'PAS-Nonce';
const PAS_CHECK = 'PAS-Check';
const CAPTCHA_OPTION_KEY = '_paseo_captcha_settings';
const DB_SCHEMA_VERSION = '1.1.1';

define( 'PASEO_WP_FORM_API_PLUGIN_VERSION', '0.0.1' );
define( 'PASEO_WP_FORM_DIR_URL', plugin_dir_url(__FILE__));
define( 'PASEO_WP_FORM_DIR_PATH', plugin_dir_path(__FILE__));

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-paseo-wp-form-api-activator.php
 */
 register_activation_hook( __FILE__, array('Paseo\Lib\Activator', 'activate') );

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-paseo-wp-form-api-deactivator.php
 */
 register_deactivation_hook( __FILE__, array('Paseo\Lib\Activator', 'deactivate') );

/**
 * Update database
 */
  add_action('plugins_loaded', array('Paseo\Lib\Activator', 'update_db'));

/**
 * uninstall hook
 */
 register_uninstall_hook('uninstall.php', 'paseo_wp_form_api_uninstall');

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
$plugin = new Paseo\Main();
$plugin->run();
