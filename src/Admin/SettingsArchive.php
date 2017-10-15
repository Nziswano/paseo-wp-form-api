<?php
/**
 * Created by IntelliJ IDEA.
 * User: themartins
 * Date: 2017/10/15
 * Time: 18:01
 */

namespace Paseo\Admin;


class SettingsArchive
{
    protected $slug = 'demo-menu';

    protected $assets_url;

    protected static $option_key = '_demo_settings';

    public function __construct($assets_url)
    {
        $this->assets_url = $assets_url;
//        \add_action('admin_menu', array($this, 'add_page'));
//        \add_action('admin_enque_scripts', array($this, 'register_assets'));
    }

    public function add_page(){
        add_menu_page(
            __('Demo Settings Page', 'text-domain'),
            __('Demo Settings Page', 'text-domain'),
            'manage_options',
            $this->slug,
            array($this, 'render_admin')
        );
    }

    /*
     * Register CSS and JS for page
     */
    public function register_assets() {
        \wp_register_script($this->slug, $this->assets_url . '/js/admin.js', array('jquery'));
        \wp_register_style($this->slug, $this->assets_url . '/css/admin.css' );
        \wp_localize_script( $this->slug, 'DEMO', array(
            'strings' => array(
                'saved' => __('Settings Saved', 'text-domain'),
                'error' => __('Error', 'text-domain')
            ),
            'api' => array(
                'url' => esc_url_raw( \rest_url(ROUTE .'/settings')),
                'nonce' => \wp_create_nonce('wp_rest')
            )
            )
        );
    }

    public function enqueue_assets() {
        if (! wp_script_is($this->slug, 'registered')) {
            $this->register_assets();
        }
        \wp_enqueue_script($this->slug);
        \wp_enqueue_style($this->slug);
    }

    public function render_admin(){
        $this->enqueue_assets();
        ?>
        <div class="wrap">
        <form id="demo-form">
            <div id="feedback">
            </div>
            <div>
                <label for="industry">
                    <?php esc_html_e( 'Industry', 'text-domain' ); ?>
                </label>
                <input id="industry" type="text" />
            </div>
            <div>
                <label for="amount">
                    <?php esc_html_e( 'Amount', 'text-domain' ); ?>
                </label>
                <input id="amount" type="number" min="0" max="100" />
            </div>
            <?php submit_button( __( 'Save', 'text-domain' ) ); ?>
        </form>
        </div>

        <?php
    }


    /**
     * Default settings
     *
     * @var array
     */
    protected static $defaults = array(
        'industry' => 'lumber',
        'amount' => 42
    );
    /**
     * Get saved settings
     *
     * @return array
     */
    public static function get_settings(){
        $saved = get_option( self::$option_key, array() );
        if( ! is_array( $saved ) || ! empty( $saved )){
            return self::$defaults;
        }
        return wp_parse_args( $saved, self::$defaults );
    }
    /**
     * Save settings
     *
     * Array keys must be whitelisted (IE must be keys of self::$defaults
     *
     * @param array $settings
     */
    public static function save_settings( array  $settings ){
        //remove any non-allowed indexes before save
        foreach ( $settings as $i => $setting ){
            if( ! array_key_exists( $i, self::$defaults ) ){
                unset( $settings[ $i ] );
            }
        }
        if( get_option())

        update_option( self::$option_key, $settings );
    }

    /**
     * Check request permissions
     *
     * @return bool
     */
    public static function permissions(){
        return current_user_can( 'manage_options' );
    }
    /**
     * Update settings
     *
     * @param WP_REST_Request $request
     */
    public static function update_settings( \WP_REST_Request $request ){
        $settings = array(
            'industry' => $request->get_param( 'industry' ),
            'amount' => $request->get_param( 'amount' )
        );
        SettingsArchive::save_settings( $settings );
        $test_data = SettingsArchive::get_settings();
//        return rest_ensure_response( Settings::get_settings())->set_status( 201 );
//        $response = new \WP_Error(21, 'this is an error');
        $response = new \WP_REST_Response();
        $response->set_data(array('data' => $settings, 'test_data'=> $test_data));
        return $response;
    }
    /**
     * Get settings via API
     *
     * @param WP_REST_Request $request
     * @return \WP_REST_Response
     */
    public static function settings( \WP_REST_Request $request ){
        return rest_ensure_response( SettingsArchive::get_settings());
    }
}