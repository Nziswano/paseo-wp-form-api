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
    const SETTINGS_OPTION_KEY = '_paseo_captcha_settings';
    const SETTINGS_PERMISSIONS = 'manage_options';
    const SETTINGS_ASSETS_JS = 'site/admin/js/admin.js';
    const SETTINGS_ASSETS_CSS = 'site/admin/css/admin.css';
    const SETTINGS_VAR = 'PASEOFORM';
    const SETTINGS_ROUTE = '/settings';

    /**
     * @var array
     */
    protected static $settings = array (
        'page_title' => 'Paseo Settings',
        'menu_title' => 'Paseo Settings',
        'capability' => 'manage_options',
        'menu_slug'  => 'paseo-contact-us-form'
    );

    /**
     * Default demo settings for captcha
     * @var array
     */
    public static $defaults = array(
        'captcha_public_key'    => self::SETTINGS_CAPTCHA_PUBLIC_KEY,
        'captcha_private_key'   => self::SETTINGS_CAPTCHA_PRIVATE_KEY,
        'captcha_url'           => self::SETTINGS_CAPTCHA_URL,
        'captcha_enabled'       => true
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

    public function __construct()
    {

    }

    public function add_page(){
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
    protected function register_assets() {
        $settings = self::get_settings();
        \wp_register_style(self::$settings['menu_slug'], \PASEO_WP_FORM_DIR_URL. self::SETTINGS_ASSETS_CSS);
        \wp_register_script(self::$settings['menu_slug'], \PASEO_WP_FORM_DIR_URL . self::SETTINGS_ASSETS_JS, array('wp-api'));
        \wp_localize_script(self::$settings['menu_slug'], self::SETTINGS_VAR, array(
            'settings' => self::get_settings(),
            'api' => array(
                'url' => esc_url_raw( rest_url( ROUTE . self::SETTINGS_ROUTE )),
                'nonce' => \wp_create_nonce('wp_rest')
            )
        ));

    }

    /**
     * add the assets
     */
    protected function enqueue_assets() {
        if( !wp_script_is(self::$settings['menu_slug'], 'registered')) {
            $this->register_assets();
        }
        \wp_enqueue_script(self::$settings['menu_slug']);
        \wp_enqueue_style(self::$settings['menu_slug']);
    }

    /**
     * Render Page
     */
    public function render_admin() {
        $this->enqueue_assets();
        Timber::render('admin.twig');

    }

    /**
     * @return array
     */
    public static function get_settings() {
        $saved = get_option( self::$option_key, array());
        if( !is_array($saved) || empty($saved)) {
            $saved = self::$defaults;
        }
        return \wp_parse_args( $saved, self::$defaults );

    }

    /**
     * Save settings by updating the current array with new settings.
     * @param array $settings
     */
    public static function save_settings( array $settings ){
        $update_settings = self::get_settings();
        foreach( $settings as $i => $setting ) {
            if(array_key_exists( $i, $update_settings )) {
                $update_settings[$i] = $setting;
            }
        }
        update_option( self::$option_key, $update_settings );
    }
}