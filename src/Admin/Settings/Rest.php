<?php
/**
 * Created by IntelliJ IDEA.
 * User: themartins
 * Date: 2017/10/15
 * Time: 23:21
 */

namespace Paseo\Admin\Settings;


class Rest
{
    /**
     * @return bool
     */
    public static function permissions() {
        return current_user_can(Settings::$permissions);
    }

    /**
     * @return array
     */
    public static function get_settings() {
        return Settings::get_settings();
    }

    /**
     * @param \WP_REST_Request $request
     * @return \WP_REST_Response
     */
    public static function update_settings( \WP_REST_Request $request ) {
        $settings = array();
        foreach( Settings::$defaults as $setting => $value ){
            $result = $request->get_param($setting);
            if($result) {
                $settings[$setting] = $result;
            }
        }
        Settings::save_settings($settings);
        $updated_settings = self::get_settings();
        return rest_ensure_response( $updated_settings )->set_status(201);
    }

    /**
     * @param \WP_REST_Request $request
     * @return \WP_REST_Response
     */
    public static function check_settings(\WP_REST_Request $request ) {
        $settings = self::get_settings();
        return \rest_ensure_response($settings);
    }

}