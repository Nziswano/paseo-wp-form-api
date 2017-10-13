<?php

namespace Paseo\Admin;

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Paseo_Wp_Form_Api
 * @subpackage Paseo_Wp_Form_Api/admin
 * @author     Johan Martin <johan@paseo.org.za>
 */
class Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	private $settings = array (
	    'page_title' => 'Paseo Contact Us List',
        'menu_title' => 'Paseo Contact Us',
        'capability' => 'manage_options',
        'menu_slug'  => 'paseo-contact-us-form'
    );

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Paseo_Wp_Form_Api_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Paseo_Wp_Form_Api_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . '../../site/admin/css/paseo-wp-form-api-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Paseo_Wp_Form_Api_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Paseo_Wp_Form_Api_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name,
            plugin_dir_url( __FILE__ ) . '../../site/admin/js/paseo-wp-form-api-admin.js', array( 'jquery' ),
            $this->version, false );

	}

	public function contact_us_form_menu() {
        add_plugins_page( $this->settings['page_title'],
            $this->settings['menu_title'],
            $this->settings['capability'],
            $this->settings['menu_slug'],
            array($this, 'contact_us_form_options') );
    }

    /*
     * Plugin Options
     */
    public function contact_us_form_options() {
        if ( !current_user_can( 'manage_options' ) )  {
            wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
        }
        $data = array('username'=>'jane_doe');
        \Timber::render_string('Hi {{username}} means timber is working ', $data);
?>
        <div class="wrap">
<h2>Contact Us Form Settings</h2>
            <?php
            $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'contact_list';
            ?>
            <h2 class="nav-tab-wrapper">
                <a href="?page=paseo-contact-us-form&tab=contact_list" class="nav-tab <?php echo $active_tab == 'contact_list' ? 'nav-tab-active' : ''; ?>">Contacts List</a>
                <a href="?page=paseo-contact-us-form&tab=settings" class="nav-tab" <?php echo $active_tab == 'settings' ? 'nav-tab-active' : ''; ?>>Settings</a>
            </h2>
<form action="options.php" method="post">

<?php
    if ($active_tab == 'contact_list') {
        echo "contact list";
    } else {
        settings_fields($this->settings['menu_slug']);
        do_settings_sections($this->settings['menu_slug']);
    }
 ?>

<input name="Submit" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" />
</form>
        </div>
<?php

    }


    public function plugin_admin_init()
    {

        add_settings_section(
            'captcha_settings',
            'Captcha Settings',
            array($this,'plugin_section_text'),
            $this->settings['menu_slug']);

        add_settings_field(
            'captcha_key',
            'Captcha Public Key',
            array($this, 'captcha_public_string'),
            $this->settings['menu_slug'],
            'captcha_settings');

        add_settings_field(
            'captcha_secret',
            'Captcha Secret Key',
            array($this, 'captcha_secret_string'),
            $this->settings['menu_slug'],
            'captcha_settings'
        );

        register_setting(
            $this->settings['menu_slug'],
            'captcha_key'
            );

        register_setting(
            $this->settings['menu_slug'],
            'captcha_secret'
        );
    }

    public function plugin_section_text() {
        echo '<p>Captcha Related Settings</p>';
    }

    public function captcha_public_string() {
        $key = get_option('captcha_key');
        echo "<input id='captcha_key' name='captcha_key' size='40' type='text' value='{$key}' />";
    }

    public function captcha_secret_string() {
        $secret = get_option('captcha_secret');
        echo "<input id='captcha_secret' name='captcha_secret' size='40' type='text' value='{$secret}' />";
    }

    public function plugin_options_validate($input) {
        $newinput['text_string'] = trim($input['text_string']);
        if(!preg_match('/^[a-z0-9]{32}$/i', $newinput['text_string'])) {
            $newinput['text_string'] = '';
        }
        return $newinput;
    }

}
