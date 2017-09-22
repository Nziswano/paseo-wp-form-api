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
	$id = $request->get_param('id');
	$post = get_post_meta( $id, "wporg_meta_key" );
	return $post;
}

function paseo_register_route() {
	register_rest_route('paseo/v1', '/post/(?P<id>\d+)',
	array(
		'methods' => 'GET',
		'callback' => 'paseo_contact_form'
	)
	);
}

/* Add Meta Boxes */
function paseo_contact_form_custom_box() {
	$screens = ['post', 'wporg_cpt'];
	foreach( $screens as $screen ) {
		add_meta_box(
			'paseo_box_id',
			'Custom Meta Box',
			'wporg_custom_box_html',
			$screen
		);
	}
}

add_action('add_meta_boxes', 'paseo_contact_form_custom_box');

function wporg_custom_box_html( $post ) {
	?>
	<label for="wporg_field">Description for this field</label>
	<select name="wporg_field" id="wporg_field" class="postbox">
		<option value="">Select something...</option>
		<option value="something">Something</option>
		<option value="else">Else</option>
		<option value="totall">Totally random</option>
	</select>
	<?php
}

function paseo_contact_form_save_meta( $post_id ) {
	if (array_key_exists('wporg_field', $_POST)) {
		update_post_meta(
			$post_id,
			'wporg_meta_key',
			$_POST['wporg_field']
		);
	}
}


add_action('save_post', 'paseo_contact_form_save_meta');

