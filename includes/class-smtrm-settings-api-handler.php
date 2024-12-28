<?php
if (!defined('ABSPATH')) {
    exit;
}
/**
 * Handles REST API callback and route registration for the plugin.
 *
 * This class manages the REST API integration, including registering routes
 * and handling incoming requests for the plugin's settings.
 *
 * @since 0.9.18
 */
if ( ! class_exists( 'Smtrm_Settings_API_Handler' ) ) {
    class Smtrm_Settings_API_Handler {
        /**
         * Constructor.
         *
         * Registers the REST API routes during the `rest_api_init` action.
         *
         * @since 0.9.18
         */
        public function __construct() {
            add_action('rest_api_init', array($this, 'register_routes'));
        }
        /**
         * Handles saving settings via the REST API.
         *
         * This method retrieves the JSON parameters from the request, validates them,
         * and updates the corresponding options in the WordPress database.
         *
         * @since 0.9.18
         *
         * @param WP_REST_Request $request The REST API request object containing the parameters.
         * @return WP_REST_Response|WP_Error REST response on success, or WP_Error on failure.
         */
        public function handle_settings($request) {
            $options = Smtrm_Init_Options::get_instance();
            $options->initialize_options();
            $params = $request->get_json_params();
        
            if (empty($params)) {
                return new WP_Error(
                    'rest_invalid_params',
                    __('Missing required parameters.', 'wp-sameterm-pager'),
                    array('status' => 400)
                );
            }
        
            foreach ($params as $key => $value) {
                update_option($key, $value);
            }
        
            return rest_ensure_response(array(
                'success' => true,
                'message' => __('Settings updated successfully.', 'wp-sameterm-pager'),
            ));
        }
        /**
         * Registers the REST API routes.
         *
         * This method defines the endpoint for the plugin's settings and specifies
         * the callback function and permission requirements.
         *
         * @since 0.9.18
         */
        public function register_routes(){
            register_rest_route('smtrm/v1', '/settings', array(
                'methods' => 'POST',
                'callback' => array($this, 'handle_settings'),
                'permission_callback' => array($this, 'permissions_check'),
            ));
            register_rest_route('smtrm/v1', '/settings', array(
                'methods' => 'GET',
                'callback' => array($this, 'check_endpoint'),
                'permission_callback' => array($this, 'permissions_check'),
            ));
        }
        public function check_endpoint() {
            return rest_ensure_response(array(
                'success' => true,
                'message' => __('REST API endpoint is accessible.', 'wp-sameterm-pager'),
            ));
        }
        public function permissions_check() {
            return current_user_can('manage_options');
        }
    }
    new Smtrm_Settings_API_Handler();
}