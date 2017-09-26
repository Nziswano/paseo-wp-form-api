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

		if ( !$nonce_key ) {
			$nonce_key = md5( $_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR'] );
		}

		$result = new \WP_REST_Response();

		if ( GET == $request->get_method() ) {
			$nonce = wp_create_nonce( $nonce_key );
			$result->header(NONCE_HEADER, $nonce_key);
			$result->set_data(array($nonce, "nonce: " . $nonce_key));

		}

		if ( POST == $request->get_method() )
		{

			$nonce = $request->get_header(NONCE_HEADER);
			$nonce_verify = wp_verify_nonce($nonce, $nonce_key );
			$result->set_data( array("hello", $nonce, "nonce: " . $nonce_verify ) );
		}

		return $result;
	}

}