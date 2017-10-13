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

        /* Set header information */
        remove_filter( 'rest_pre_serve_request', 'rest_send_cors_headers' );
        add_filter( 'rest_pre_serve_request', function( $value ) {
            header( 'Access-Control-Allow-Origin: *' );
            header( 'Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE' );
            header( 'Access-Control-Allow-Credentials: true' );
            header( 'Access-Control-Expose-Headers: X-WP-Total, X-WP-TotalPages, PAS-Fingerprint, PAS-Check, PAS-Nonce, PAS-Captcha');
            header('Access-Control-Allow-Headers: Authorization, Content-Type, PAS-Nonce, PAS-Fingerprint, PAS-Check');
            return $value;
        });
	}

}