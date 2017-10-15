<?php
/**
 * Created by IntelliJ IDEA.
 * User: themartins
 * Date: 2017/10/15
 * Time: 23:01
 */

namespace Paseo\Admin\Settings;

const SETTINGS_CAPTCHA_PUBLIC_KEY = '6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI';
const SETTINGS_CAPTCHA_PRIVATE_KEY = '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe';
const SETTINGS_CAPTCHA_URL = 'https://www.google.com/recaptcha/api/siteverify';
const SETTINGS_OPTION_KEY = '_paseo_captcha_settings';
const SETTINGS_PERMISSIONS = 'manage_options';


class Settings
{
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
        'captcha_public_key'    => SETTINGS_CAPTCHA_PUBLIC_KEY,
        'captcha_private_key'   => SETTINGS_CAPTCHA_PRIVATE_KEY,
        'captcha_url'           => SETTINGS_CAPTCHA_URL,
        'captcha_enabled'       => true
    );

    /**
     * @var string
     */
    public static $permissions = SETTINGS_PERMISSIONS;

    /**
     * @var string
     */
    private $assets_url;

    /**
     * @var string
     */
    protected static $option_key = SETTINGS_OPTION_KEY;

    public function __construct($assets_url)
    {
        $this->assets_url = $assets_url;
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
     * Render Page
     */
    public function render_admin() {
        echo 'Hello World';
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