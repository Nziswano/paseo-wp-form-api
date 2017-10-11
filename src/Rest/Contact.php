<?php
/**
 * Created by PhpStorm.
 * User: themartins
 * Date: 2017/09/24
 * Time: 23:15
 */

namespace Paseo\Rest;


class Contact {

	/**
	 * @param \WP_REST_Request $request
	 *
	 * @return mixed
	 */
	public static function contact_form( \WP_REST_Request $request ) {
		$nonce_key = $request->get_header(FINGERPRINT);

		if ( !$nonce_key )
		{
			$nonce_key = md5( $_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR'] );
		}

		$result = new \WP_REST_Response();

		if ( GET == $request->get_method() )
		{
			$nonce = wp_create_nonce( $nonce_key );
			$result->header(NONCE_HEADER, $nonce_key);
			$result->set_data(array("nonce" => $nonce_key));
		}

		if ( POST == $request->get_method() )
		{
			$nonce = $request->get_header(NONCE_HEADER );
			$nonce_verify = wp_verify_nonce($nonce, $nonce_key );
//			$data = $request->get_body_params();
			$fingerprint = $request->get_param('fingerprint');
			$captcha = $request->get_param('captcha');
			$captcha_resolve = self::check_captcha($captcha);
			$db_result = self::save_data($fingerprint, $request);
			$result->set_data(
			    array(
			        'nonce' => $nonce_verify,
			        'db_result' => $db_result,
			        'captcha_resolve' => $captcha_resolve
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
        return \wp_remote_retrieve_body( $response );
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