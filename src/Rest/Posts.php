<?php
/**
 * Created by PhpStorm.
 * User: themartins
 * Date: 2017/09/24
 * Time: 23:16
 */

namespace Paseo\Rest;


class Posts {

	/**
	 * @return mixed
	 */
	public static function posts(\WP_REST_Request $request ) {
		$nonce_key = 'random_nonce';
		$method = $request->get_method();
		$response = new \WP_REST_Response( $method );
		return $response;

	}

}