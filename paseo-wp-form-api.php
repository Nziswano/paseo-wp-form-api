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
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
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

require __DIR__ . DIRECTORY_SEPARATOR. 'vendor/autoload.php';

const GET = "GET";
const POST = "POST";
const ROUTE = 'paseo/v1';
const FINGERPRINT = 'PAS-Fingerprint';
const DB_TABLE = 'contact_us';
const CAPTCHA_URL = 'https://www.google.com/recaptcha/api/siteverify';
const CAPTCHA_SECRET = '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe';
const NONCE_HEADER = 'PAS-Nonce';
const PAS_CHECK = 'PAS-Check';

define( 'PASEO_WP_FORM_API_PLUGIN_VERSION', '0.0.1' );

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
 * Use * for origin
 */
 add_action( 'rest_api_init', function() {

 remove_filter( 'rest_pre_serve_request', 'rest_send_cors_headers' );
 add_filter( 'rest_pre_serve_request', function( $value ) {
 	header( 'Access-Control-Allow-Origin: *' );
 	header( 'Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE' );
 	header( 'Access-Control-Allow-Credentials: true' );
 	header( 'Access-Control-Expose-Headers: X-WP-Total, X-WP-TotalPages, PAS-Fingerprint, PAS-Check, PAS-Nonce');
 	header('Access-Control-Allow-Headers: Authorization, Content-Type, PAS-Nonce, PAS-Fingerprint, PAS-Check');
 	return $value;
 });
 }, 15 );


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
