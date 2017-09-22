<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://center.paseo.org.za
 * @since             1.0.0
 * @package           Paseo_Contact_Us
 *
 * @wordpress-plugin
 * Plugin Name:       Paseo Contact Us
 * Plugin URI:        https://github.com/catenare/paseo-wp-form-api
 * Description:       Allow for contact us form submission via Wordpress REST API
 * Version:           0.0.1
 * Author:            Johan Martin
 * Author URI:        http://www.johan-martin.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       paseo-contact-us
 * Domain Path:       /languages
 */

require 'vendor/autoload.php';

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

global $wp_version;

$exit_message = 'Requires Wordpress 4.8 or newer';

if (version_compare($wp_version, "4.7", "<")){
	exit( $exit_message );
}

define( 'PLUGIN_VERSION', '0.0.1' );

add_action( 'rest_api_init', 'paseo_register_route');

function paseo_contact_form( WP_REST_Request $request ) {
	return $request->get_params();
}

function paseo_register_route() {
	register_rest_route('paseo/v1', '/author/(?P<id>\d+)',
	array(
		'methods' => 'GET',
		'callback' => 'paseo_contact_form'
	)
	);
}
