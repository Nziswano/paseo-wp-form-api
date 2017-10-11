<?php
/**
 * Created by PhpStorm.
 * User: themartins
 * Date: 2017/09/24
 * Time: 10:48
 */

namespace Paseo\Metaboxes;


class Metaboxes {

	/*
	 * Create the custom box
	 */
	public static function custom_box() {
		$screens = ['post', 'wporg_cpt'];
		foreach( $screens as $screen ) {
			add_meta_box(
				'paseo_box_id',
				'Custom Meta Box',
				array('Paseo\Metaboxes\Metaboxes','custom_box_html'),
				$screen
			);
		}
	}

	/**
	 * @param $post
	 */
	public static function custom_box_html( $post ) {
		?>
		<label for="wporg_field">Description for this field</label>
		<select name="wporg_field" id="wporg_field" class="postbox">
			<option value="">Select something...</option>
			<option value="something">Something</option>
			<option value="else">Else</option>
			<option value="totall">Totally random</option>
		</select>
		<?php

	}

	/**
	 * @param $post_id
	 */
	public static function save_meta( $post_id ) {
		if (array_key_exists( 'wporg_field', $_POST )) {
			update_post_meta(
				$post_id,
				'wporg_meta_key',
				$_POST['wporg_field']
			);
		}
	}
}