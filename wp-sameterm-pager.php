<?php
/*
Plugin Name: WP Same Term Pager
Plugin URI: https://github.com/sorano-emaki/wp-sameterm-pager
Description: Navigate between posts within the same term using pagination.
Version: 0.9.18
Author: Emaki Sorano
Author URI: https://shokizerokara.com/
License: GPLv2
Requires at least: 5.2
Tested up to: 6.7
Requires PHP: 7.3
Text Domain: wp-sameterm-pager
Domain Path: /languages
*/
if (!defined('ABSPATH')) {
    exit;
}
if ( ! function_exists( 'smtrm_define_constant' ) ) {
    /**
     * Define a constant if it is not already defined.
     *
     * @param string $name The name of the constant.
     * @param mixed  $value The value of the constant.
     */
    function smtrm_define_constant( $name, $value ) {
        if ( ! defined( $name ) ) {
            define( $name, $value );
        }
    }

    /* Define constants */
    smtrm_define_constant( 'SMTRM_PLUGIN_FILE', __FILE__ );
    smtrm_define_constant( 'SMTRM_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
    smtrm_define_constant( 'SMTRM_DIR_URL', plugin_dir_url( __FILE__ ) );
    smtrm_define_constant( 'SMTRM_DIR_PATH', plugin_dir_path( __FILE__ ) );

    /* Retrieve plugin data */
    $plugin_data = get_file_data( __FILE__, array(
        'Version'           => 'Version',
        'Requires at least' => 'Requires at least',
        'Requires PHP'      => 'Requires PHP',
    ) );

    /* Define constants using plugin data */
    smtrm_define_constant( 'SMTRM_VERSION', $plugin_data['Version'] );
    smtrm_define_constant( 'SMTRM_MIN_WP', $plugin_data['Requires at least'] );
    smtrm_define_constant( 'SMTRM_MIN_PHP_VERSION', $plugin_data['Requires PHP'] );
}
if ( ! function_exists( 'smtrm_register_i18n' ) ){
    /**
     * Loads the plugin's text domain for translations.
     *
     * This method is responsible for loading the plugin's translation files
     * located in the `languages` directory. This enables the plugin to support
     * internationalization (i18n) for various languages.
     *
     * @since 0.9.18
     */
    function smtrm_register_i18n()
    {
        load_plugin_textdomain('wp-sameterm-pager', false, dirname(SMTRM_PLUGIN_BASENAME) . '/languages');
    }
    add_action('plugins_loaded','smtrm_register_i18n',5);
}
if ( ! function_exists( 'smtrm_stop_plugin_execution' ) ){
    /**
     * Ensures the plugin meets the minimum WordPress and PHP version requirements.
     *
     * This function verifies the minimum WordPress and PHP versions required for the plugin to operate.
     * If the requirements are met, it initializes the plugin's files and options. If not, the plugin is
     * deactivated, and an error message is displayed to the administrator.
     *
     * @since 0.9.18
     * 
     * @global string $wp_version The current WordPress version.
     * @global string $php_version The current PHP version.
     */
    function smtrm_stop_plugin_execution(){
        /* Minimum requirements */
        $min_wp =  SMTRM_MIN_WP;
        $min_php = SMTRM_MIN_PHP_VERSION;

        /* Check WordPress and PHP versions */
        if (version_compare(get_bloginfo('version'), $min_wp, '>=') && version_compare(PHP_VERSION, $min_php, '>=')) {
                smtrm_include_files();
                add_action('plugins_loaded', function () {
                    $options = Smtrm_Init_Options::get_instance();
                    $options->initialize_options();
                }, 15);
        } else {
            /* Deactivate the plugin */
            add_action('admin_init', function ()  use ($min_wp, $min_php) {
                deactivate_plugins(SMTRM_PLUGIN_BASENAME);
                wp_die(
                    sprintf(
                        /* Translators: %1$s: Minimum WordPress version, %2$s: Minimum PHP version */
                        esc_html__('This plugin requires at least WordPress %1$s and PHP %2$s to function properly.', 'wp-sameterm-pager'),
                        esc_html($min_wp),
                        esc_html($min_php)
                    ),
                    __('Plugin Activation Error', 'wp-sameterm-pager'),
                    array('back_link' => true)
                );
            });

            /* Halt further execution */
            return;
        }
    }
    /**
     * Includes the necessary files for the plugin.
     *
     * This function is responsible for requiring all the PHP files
     * that define the plugin's functionality. It ensures that all
     * classes and functions are properly loaded before they are used.
     *
     * @since 0.9.18
     */
    function smtrm_include_files() {
        require_once('globals.php');
        require_once('includes/class-smtrm-init-opitons.php');
        require_once('includes/class-smtrm-plugin-activation.php');
        require_once('includes/class-smtrm-plugin-setup.php');
        require_once('includes/class-smtrm-settings-api-handler.php');
        require_once('includes/interface-smtrm-pager-interface.php');
        require_once('includes/class-smtrm-adjacent-post.php');
        require_once('includes/class-smtrm-get-setting.php');
        require_once('includes/class-smtrm-enqueue.php');
        require_once('includes/class-smtrm-widget.php');
        require_once('includes/class-smtrm-widget-area.php');
        require_once('includes/class-smtrm-sanitize.php');
        require_once('includes/class-smtrm-legacy-menu.php');
        require_once('includes/class-smtrm-admin-menu.php');
        require_once('includes/class-smtrm-get-link.php');
        require_once('includes/class-smtrm-add-param.php');
        require_once('includes/class-smtrm-pager.php');
    }

    smtrm_stop_plugin_execution();
}

