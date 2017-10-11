<?php
/**
 * Created by PhpStorm.
 * User: themartins
 * Date: 2017/09/24
 * Time: 11:38
 */

namespace Paseo\Rest;



class Routes {
	public static function register_route() {
		register_rest_route(ROUTE, '/contact-us/',
			array(
				'methods' => 'GET, POST',
				'callback' => array('Paseo\Rest\Contact', 'contact_form')
			)
		);

		register_rest_route(ROUTE, '/posts',
			array(
				'methods' => \WP_REST_Server::READABLE,
				'callback' => array('Paseo\Rest\Posts', 'posts')
			)
		);
	}
}