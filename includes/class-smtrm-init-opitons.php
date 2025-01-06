<?php

if (!defined('ABSPATH')) {
    exit;
}
if (!class_exists('Smtrm_Init_Options')) {
    class Smtrm_Init_Options
    {
        private static $instance = null;

        private function __construct()
        {
        }

        /**
         * Retrieves the singleton instance of the class.
         *
         * This method ensures that only one instance of the class exists at any time.
         * If the instance does not already exist, it is created.
         *
         * @since 0.10.0
         *
         * @return self The singleton instance of the class.
         */
        public static function get_instance()
        {
            if (self::$instance === null) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        /**
         * Initializes the plugin's default options.
         *
         * This method ensures that all required options are added to the database
         * with their default values if they do not already exist.
         *
         * @since 0.10.0
         */
        public function initialize_options()
        {
            $default_options = array(
                SMTRM_INSTALLED => 1,
                SMTRM_TOP => 1,
                SMTRM_BOTTOM => 1,
                SMTRM_OLDEST_POST => '',
                SMTRM_LATEST_POST => '',
                SMTRM_AP_PARAM_CSS => '',
            );

            foreach ($default_options as $key => $default) {
                if (get_option($key) === false) {
                    add_option($key, $default);
                }
            }
        }
    }
}
