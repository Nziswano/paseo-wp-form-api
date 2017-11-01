<?php
/**
 * Created by IntelliJ IDEA.
 * User: themartins
 * Date: 2017/10/15
 * Time: 23:01
 */

namespace Paseo\Admin\Settings;

use Timber\Timber;


class Settings
{
  /* Constants */

  const SETTINGS_CAPTCHA_PUBLIC_KEY = '6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI';
  const SETTINGS_CAPTCHA_PRIVATE_KEY = '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe';
  const SETTINGS_CAPTCHA_URL = 'https://www.google.com/recaptcha/api/siteverify';
  const SETTINGS_OPTION_KEY = \CAPTCHA_OPTION_KEY;
  const SETTINGS_PERMISSIONS = 'manage_options';
  const SETTINGS_ASSETS_JS = 'site/admin/js/settings.js';
  const SETTINGS_ASSETS_CSS = 'site/admin/css/settings.css';
  const SETTINGS_VAR = 'PASEOFORM';
  const SETTINGS_ROUTE = '/settings';
  const LISTINGS_ROUTE = '/contact-us-admin';

  /**
   * @var array
   */
  protected static $settings = array(
    'page_title' => 'Paseo Settings',
    'menu_title' => 'Paseo Settings',
    'capability' => 'manage_options',
    'menu_slug' => 'paseo-contact-us-form'
  );

  /**
   * Default demo settings for captcha
   * @var array
   */
  public static $defaults = array(
    'captcha_public_key' => self::SETTINGS_CAPTCHA_PUBLIC_KEY,
    'captcha_private_key' => self::SETTINGS_CAPTCHA_PRIVATE_KEY,
    'captcha_url' => self::SETTINGS_CAPTCHA_URL,
    'captcha_enabled' => true
  );

  /**
   * @var string
   */
  public static $permissions = self::SETTINGS_PERMISSIONS;

  /**
   * @var string
   */
  private $assets_url;


  /**
   * @var string
   */
  protected static $option_key = self::SETTINGS_OPTION_KEY;


  public function add_page()
  {
    \add_plugins_page(
      __(self::$settings['page_title'], 'text-domain'),
      __(self::$settings['page_title'], 'text-domain'),
      self::$settings['capability'],
      self::$settings['menu_slug'],
      array($this, 'render_admin')
    );
  }


  /**
   * Add necessary javascript here.
   */
  protected function register_assets()
  {
    \wp_register_style(self::$settings['menu_slug'],
      \PASEO_WP_FORM_DIR_URL . 'site/assets/paseo-wp-form-api.css', array(),
      \PASEO_WP_FORM_API_PLUGIN_VERSION,
      false);
    \wp_register_script(self::$settings['menu_slug'],
      \PASEO_WP_FORM_DIR_URL . 'site/assets/paseo-wp-form-api.js',
      array('jquery', 'backbone'),
      \PASEO_WP_FORM_API_PLUGIN_VERSION,
      false);

    \wp_localize_script(self::$settings['menu_slug'],
      self::SETTINGS_VAR,
      array(
        'settings' => self::get_settings(),
        'api' => array(
          'settings_url' => esc_url_raw(rest_url(ROUTE . self::SETTINGS_ROUTE)),
          'listings_url' => esc_url_raw(rest_url(ROUTE . self::LISTINGS_ROUTE)),
          'nonce' => \wp_create_nonce('wp_rest')
        )
      ));

  }

  /**
   * add the assets
   */
  protected function enqueue_assets()
  {
    if (!wp_script_is(self::$settings['menu_slug'], 'registered')) {
      $this->register_assets();
    }
    \wp_enqueue_script(self::$settings['menu_slug']);
    \wp_enqueue_style(self::$settings['menu_slug']);
  }

  /**
   * Render Page
   */
  public function render_admin()
  {
    $this->enqueue_assets();
    Timber::render('admin.twig');

  }

  /**
   * Initialize the settings
   * @return array|mixed
   */
  public static function init_settings()
  {
    $saved = get_option(self::$option_key, array());
    if (!is_array($saved) || empty($saved)) {
      $saved = Settings::$defaults;
      update_option(self::$option_key, $saved);
    }
    return $saved;
  }

//  /**
//   * @return array
//   */
//  public static function get_settings()
//  {
//    $saved = Settings::init_settings();
//    return \wp_parse_args($saved, self::$defaults);
//  }


  /**
   * @return array
   */
  public static function get_settings() {
    $saved = get_option( self::$option_key, array());
    if( !is_array($saved) || empty($saved)) {
      $saved = Settings::init_settings();
    }
    return \wp_parse_args( $saved, self::$defaults );

  }


  /**
   * Save settings by updating the current array with new settings.
   * @param array $settings
   */
  public static function save_settings(array $settings)
  {
    $update_settings = self::get_settings();
    foreach ($settings as $i => $setting) {
      if (array_key_exists($i, $update_settings)) {
        $update_settings[$i] = $setting;
      }
    }
    update_option(self::$option_key, $update_settings);
  }
}
