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

define( 'PLUGIN_VERSION', '1.0.0' );

add_action('init', 'register_wp_questions');
function registers_wp_questions() {
		$wpwa_questions = 'wpwa_questions';
	$labels = array(
		'name' => __( 'Questions', $wpwa_questions ),
		'singular_name' => __( 'Add New Question', $wpwa_questions ),
		'add_new' => __( 'Add New', $wpwa_questions ),
		'add_new_item' => __('Add New Question', $wpwa_questions ),
		'edit_item' => __( 'Edit Questions', $wpwa_questions ),
		'new_item' => __( 'New Question', $wpwa_questions ),
		'view_item' => __( 'View Question', $wpwa_questions ),
		'search_items' => __( 'Search Questions', $wpwa_questions ),
		'not_found' => __( 'No Questions Found', $wpwa_questions ),
		'not_found_in_trash' => __( 'No Questions found in Trash', $wpwa_questions ),
		'parent_item_colon' => __( 'Parent Questins: ', $wpwa_questions ),
		'menu_name' => __( 'Questions', $wpwa_questions ),
	);
	$args = array(
		'label' => $labels,
		'hierarchical' => true,
		'description' => __( 'Questions and Answers', $wpwa_questions ),
		'supports' => array( 'title', 'editor', 'comments' ),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'has_archive' => true,
		'query_var' => true,
		'can_export' => true,
		'rewrite' => true,
		'capability_type' => 'post'
	);

	register_post_type( $wpwa_questions, $args );
}



/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-paseo-contact-us-activator.php
 */
// function activate_paseo_contact_us() {
// 	require_once plugin_dir_path( __FILE__ ) . 'includes/class-paseo-contact-us-activator.php';
// 	Paseo_Contact_Us_Activator::activate();
// }

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-paseo-contact-us-deactivator.php
 */
// function deactivate_paseo_contact_us() {
// 	require_once plugin_dir_path( __FILE__ ) . 'includes/class-paseo-contact-us-deactivator.php';
// 	Paseo_Contact_Us_Deactivator::deactivate();
// }

// register_activation_hook( __FILE__, 'activate_paseo_contact_us' );
// register_deactivation_hook( __FILE__, 'deactivate_paseo_contact_us' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
// require plugin_dir_path( __FILE__ ) . 'includes/class-paseo-contact-us.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
// function run_paseo_contact_us() {

// 	$plugin = new Paseo_Contact_Us();
// 	$plugin->run();

// }
// run_paseo_contact_us();
