<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://center.paseo.org.za
 * @since      1.0.0
 *
 * @package    Paseo_Contact_Us
 * @subpackage Paseo_Contact_Us/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Paseo_Contact_Us
 * @subpackage Paseo_Contact_Us/includes
 * @author     Johan Martin <johan@paseo.org.za>
 */
class Paseo_Contact_Us_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'paseo-contact-us',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
