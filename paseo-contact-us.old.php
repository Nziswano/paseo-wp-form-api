<?php

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'PLUGIN_VERSION', '0.0.1' );

// Check Wordpress Version
global $wp_version;
$exit_message = 'Requires Wordpress 4.8 or newer';
if (version_compare($wp_version, "4.7", "<")){
	exit( $exit_message );
}

define( 'PLUGIN_VERSION', '0.0.1' );

require 'vendor/autoload.php';

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-paseo-wp-form-api-activator.php
 */
 function activate_paseo_wp_form_api() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-paseo-wp-form-api-activator.php';
	Paseo_Wp_Form_Api_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-paseo-wp-form-api-deactivator.php
 */
function deactivate_paseo_wp_form_api() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-paseo-wp-form-api-deactivator.php';
	Paseo_Wp_Form_Api_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_paseo_wp_form_api' );
register_deactivation_hook( __FILE__, 'deactivate_paseo_wp_form_api' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
 require plugin_dir_path( __FILE__ ) . 'includes/class-paseo-wp-form-api.php';
 
 /**
	* Begins execution of the plugin.
	*
	* Since everything within the plugin is registered via hooks,
	* then kicking off the plugin from this point in the file does
	* not affect the page life cycle.
	*
	* @since    1.0.0
	*/
 function run_paseo_wp_form_api() {
 
	 $plugin = new Paseo_Wp_Form_Api();
	 $plugin->run();
 
 }
 run_paseo_wp_form_api();









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

