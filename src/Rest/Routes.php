<?php
/**
 * Created by PhpStorm.
 * User: themartins
 * Date: 2017/09/24
 * Time: 11:38
 */

namespace Paseo\Rest;


class Routes
{
  public static function register_route()
  {
    register_rest_route(ROUTE, '/contact-us/',
      array(
        'methods' => 'GET, POST',
        'callback' => array('Paseo\Contact\Contact', 'contact_form')
      )
    );

    register_rest_route(\ROUTE, '/settings',
      array(
        'methods' => 'POST, PUT, PATCH',
        'callback' => array('Paseo\Admin\Settings\Rest', 'update_settings'),
        'permissions_callback' => array('Paseo\Admin\Settings\Settings', 'permissions')
      )
    );
    register_rest_route(ROUTE, '/settings',
      array(
        'methods' => 'GET',
        'callback' => array('Paseo\Admin\Settings\Rest', 'check_settings'),
        'permissions_callback' => array('Paseo\Admin\Settings\Settings', 'permissions')
      )
    );
    register_rest_route(\ROUTE, '/contact-us-admin',
      array(
        'methods' => 'GET, POST, PUT, PATCH',
        'callback' => array('Paseo\Admin\Listings\Listings', 'process_listings'),
        'permissions_callback' => array('Paseo\Admin\Settings\Settings', 'permissions')
      )
    );

    /* Set header information */
    remove_filter('rest_pre_serve_request', 'rest_send_cors_headers');
    add_filter('rest_pre_serve_request', function ($value) {
      header('Access-Control-Allow-Origin: *');
      header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
      header('Access-Control-Allow-Credentials: true');
      header('Access-Control-Expose-Headers: X-WP-Total, X-WP-TotalPages, PAS-Fingerprint, PAS-Check, PAS-Nonce, PAS-Captcha');
      header('Access-Control-Allow-Headers: Authorization, Content-Type, PAS-Nonce, PAS-Fingerprint, PAS-Check');
      return $value;
    });
  }
}
