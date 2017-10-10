<?php
/**
 * Created by PhpStorm.
 * User: themartins
 * Date: 2017/09/24
 * Time: 23:16
 */

namespace Paseo\Rest;


class Posts {

	const LIKE_COUNT = '_like_count';
	const LIKE_USERS = '_like_users';

	/**
	 * @return mixed
	 */
	public static function posts(\WP_REST_Request $request ) {
		$nonce_key = 'random_nonce';
		$method = $request->get_method();
		$response = new \WP_REST_Response( $method );
		return $response;

	}
	
	/**
     * @return mixed
	*/
	public static function update_post_meta($post_id, $user_finger) {
		$result = NULL;

		//retrieve the post meta for LIKE_USERS;
		$users = get_post_meta( $post_id, LIKE_USERS );
		//check to see if $user_finger in $users
		if (in_array( $user_finger, $users ) ) {
			$like_count = get_post_meta( $post_id, LIKE_COUNT, true );
			$like_count = $like_count + 1;
			update_post_meta($post_id, LIKE_COUNT, $like_count, true );
			array_push( $users, $user_finger );
			update_post_meta($post_id, LIKE_USERS, $users );
		}
		//see if the user_finger have already liked the post
		//if not, retrieve the count for the post
		//update the _like_count + 1
		//update_post_meta($post_id, _like_count, update_count)
		return $result;
	}

}
