<?php
/**
 * Created by PhpStorm.
 * User: themartins
 * Date: 2017/09/24
 * Time: 11:38
 */

namespace Paseo\Rest;


class Rest {
	public static function register_route() {
		register_rest_route('paseo/v1', '/post/(?P<id>\d+)',
			array(
				'methods' => 'GET',
				'callback' => array('Paseo\Rest\Rest', 'contact_form')
			)
		);
	}

	public static function contact_form( \WP_REST_Request $request ) {
		$id = $request->get_param('id');
		$post = get_post( $id, 'wporg_meta_key' );
		return $post;
	}
}