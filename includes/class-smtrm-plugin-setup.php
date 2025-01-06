<?php

if (!defined('ABSPATH')) {
    exit;
}
if (!class_exists('Smtrm_Plugin_Setup')) {
    class Smtrm_Plugin_Setup
    {
        public function __construct()
        {
            add_filter('query_vars', array($this, 'smtrm_query_vars'));
            global $wp_version;
            if (version_compare($wp_version, '6.6', '>=')) {
                add_action('init', array($this, 'smtrm_register_block'));
            }
            add_filter('plugin_row_meta', array($this, 'smtrm_plugin_row_meta'), 10, 2);
        }

        /**
         * Adds a custom query variable.
         *
         * This method adds a custom query variable `smtrm_filter` to be used in the plugin.
         * It allows the plugin to handle custom URL parameters.
         *
         * @since 0.10.0
         *
         * @param array $vars List of current query variables.
         * @return array Modified list of query variables including `smtrm_filter`.
         */
        public function smtrm_query_vars($vars)
        {
            $vars[] = 'smtrm_filter';
            return $vars;
        }

        /**
         * Registers custom blocks for the plugin.
         *
         * This method scans the `dist/blocks` directory to find and register any custom blocks
         * defined in `block.json` files. It also handles localization and passes block-specific data
         * using `wp_localize_script`.
         *
         * @since 0.10.0
         *
         * @throws Exception If block registration fails, an error is logged with details.
         */
        public function smtrm_register_block()
        {
            foreach (glob(SMTRM_DIR_PATH . 'dist/blocks/*') as $block_path) {
                if (is_dir($block_path) && file_exists($block_path . '/block.json')) {
                    try {
                        register_block_type($block_path);
                        $block = wp_json_file_decode($block_path . '/block.json');
                        $block_name = $block->name;
                        $script_handle = generate_block_asset_handle($block_name, 'editorScript');

                        $saved_setting = new Smtrm_Get_Setting();
                        $block_data = $saved_setting->get_block_specific_data($block_name);  // 各ブロック専用のデータを取得するメソッド

                        wp_set_script_translations($script_handle, 'wp-sameterm-pager', SMTRM_DIR_PATH . 'languages');

                        wp_localize_script($script_handle, 'smtrmCustomBlockData', array_merge([
                            'pluginDirectoryUrl' => SMTRM_DIR_URL,
                        ], $block_data));
                    } catch (Exception $e) {
                        error_log('Failed to register block: ' . $block_name . ' Error: ' . $e->getMessage());
                    }
                }
            }
        }

        /**
         * Adds custom links to the plugin row in the Plugins page.
         *
         * This method adds a custom "Settings" link to the plugin's entry
         * in the WordPress Plugins page. The link directs users to the
         * plugin's settings page.
         *
         * @since 0.10.0
         *
         * @param array $links Array of the plugin's existing action links.
         * @param string $file Name of the current plugin's file.
         * @return array Modified array of action links for the plugin.
         */
        public function smtrm_plugin_row_meta($links, $file)
        {
            if ($file == SMTRM_PLUGIN_BASENAME) {
                $settings_page = 'wp_sameterm_pager';
                $links[] = '<a href="admin.php?page=' . $settings_page . '">' . esc_html__('Settings', 'wp-sameterm-pager') . '</a>';
            }
            return $links;
        }
    }
    new Smtrm_Plugin_Setup();
}
