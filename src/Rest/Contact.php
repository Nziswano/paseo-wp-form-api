<?php
/**
 * Created by PhpStorm.
 * User: themartins
 * Date: 2017/09/24
 * Time: 23:15
 */

namespace Paseo\Rest;

const NONCE_ACTION = 'Contact';

class Contact {

	/**
	 * @param \WP_REST_Request $request
	 *
	 * @return mixed
	 */
	public static function contact_form( \WP_REST_Request $request ) {

		$result = new \WP_REST_Response();
		$db_result = false;

		if ( GET == $request->get_method() )
		{
            $nonce = \wp_create_nonce(NONCE_ACTION);
            $my_key = self::get_hash($request->get_header(\FINGERPRINT));
			$result->header(NONCE_HEADER, $nonce);
			$result->header(PAS_CHECK, $my_key);
			$result->header(\FINGERPRINT, $request->get_header(\FINGERPRINT));
			$result->header( \CAPTCHA, \CAPTCHA_SITE_KEY);
			$result->set_data(
			    array(
			        'captcha_site_key' => CAPTCHA_SITE_KEY
                )
            );
		}

		if ( POST == $request->get_method() )
		{
			$nonce = $request->get_header(NONCE_HEADER );
			$nonce_verify = wp_verify_nonce($nonce, NONCE_ACTION );
			$check_key =  self::verify_hash($request->get_header(\FINGERPRINT), $request->get_header(\PAS_CHECK));
			$fingerprint = $request->get_param('fingerprint');
			$captcha = $request->get_param('captcha');
			$captcha_resolve = self::check_captcha($captcha);
            $is_valid = self::is_valid($nonce_verify, $check_key, $captcha_resolve);
            if( $is_valid ) {
                $db_result = self::save_data($fingerprint, $request);
            }
			$is_valid = ( $is_valid && $db_result );
			$result->set_data(
			    array(
                    'is_valid' => $is_valid
                )
            );
		}
		return $result;
	}

    /**
     * @param $captcha
     * @param url
     * @param secret
     * @return mixed
     */
	public static function check_captcha( $captcha ) {
	    $args = array(
	        'body' => array(
	        'secret' => \CAPTCHA_SECRET,
            'response' => $captcha
            )
        );
        $response = wp_remote_post( \CAPTCHA_URL, $args);
        $data = json_decode(\wp_remote_retrieve_body( $response ));
        return $data;
    }


    /**
     * @param $header - request header
     * @return string
     */
    public static function get_hash($key) {
	    return md5($key + MY_SALT);
    }

    public static function verify_hash($key, $hash) {
        return ( $hash == self::get_hash($key) );
    }

    /**
     * Verify that the data and response is valid.
     * @param $nonce_verify
     * @param $check_key
     * @param $captcha_resolve
     * @return boolean
     */
    public static function is_valid($nonce_verify, $check_key, $captcha_resolve) {
        $result = $nonce_verify && $check_key && $captcha_resolve->success;
        return $result;
    }

    /**
     * @param $request
     * @param $fingerprint
     * @return int
     */
    public static function save_data($fingerprint, $request) {
        global $wpdb;

        $table_name = $wpdb->prefix . DB_TABLE;

        $data = array (
            'fullname' => $request->get_param('fullname'),
            'message' => $request->get_param('message'),
            'email' => $request->get_param('email'),
            'telephone' => $request->get_param('telephone')
        );

        $result = $wpdb->insert($table_name, array('fingerprint' => $fingerprint, 'contact_info' => json_encode($data)));

        if( !$result )
        {
            $result = $wpdb->last_error;
        }
	    return $result;
    }
}
