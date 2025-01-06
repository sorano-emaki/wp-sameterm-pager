<?php

if (!defined('ABSPATH')) {
    exit;
}
if (!class_exists('Smtrm_Plugin_Activation')) {
    class Smtrm_Plugin_Activation
    {
        /**
         * Handles the initialization of plugin options during activation.
         *
         * This method checks if the plugin's options are already set in the database. If not,
         * it initializes the default options required for the plugin's functionality. These
         * options include settings for displaying the pager and specific CSS selectors.
         *
         * @since 0.10.0
         */
        public function init_option()
        {
            $options = Smtrm_Init_Options::get_instance();
            $options->initialize_options();
        }
    }
    register_activation_hook(SMTRM_PLUGIN_FILE, array(new Smtrm_Plugin_Activation(), 'init_option'));
}
