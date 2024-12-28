<?php
if (!defined('ABSPATH')) {
    exit;
}
if ( ! class_exists( 'Smtrm_Admin_Menu' ) ) {
    class Smtrm_Admin_Menu
    {
        /**
         * Adds the main menu and submenu pages for the plugin.
         *
         * This function creates the main menu "Same Term Pager Settings" and the
         * submenus "Advanced Settings" and "Help" within the WordPress admin dashboard.
         *
         * @since 0.9.18
         */
        // メニューの追加
        public function add_menu()
        {
            // メインメニュー: Same Term Pager設定
            add_menu_page(
                __('Same Term Pager Settings', 'wp-sameterm-pager'),
                __('Same Term Pager Settings', 'wp-sameterm-pager'),
                'manage_options',
                'wp_sameterm_pager',
                array($this, 'menu_page'),
                'dashicons-admin-post'
            );

            // サブメニュー: 詳細設定
            add_submenu_page(
                'wp_sameterm_pager',
                __('Advanced Settings', 'wp-sameterm-pager'),
                __('Advanced Settings', 'wp-sameterm-pager'),
                'manage_options',
                'wp_sameterm_pager_advanced',
                array($this, 'advanced_page')
            );

            // サブメニュー: ヘルプページ
            add_submenu_page(
                'wp_sameterm_pager',
                __('Help', 'wp-sameterm-pager'),
                __('Help', 'wp-sameterm-pager'),
                'manage_options',
                'wp_sameterm_pager_help',
                array($this, 'help_page')
            );
        }

        /**
         * Renders the main settings page for the plugin.
         *
         * This function checks if the legacy mode is enabled and displays
         * the legacy settings page if applicable. If not, it loads the React-based
         * settings page.
         *
         * @since 0.9.18
         */
        // メイン設定ページ
        public function menu_page()
        {
            $saved_setting = new Smtrm_Get_Setting();
            $top_checked = $saved_setting->pager_top();
            $bottom_checked = $saved_setting->pager_bottom();
            $oldest_text = $saved_setting->pager_oldest_text();
            $latest_text = $saved_setting->pager_latest_text();
            // URLに ?legacy=1 が含まれているか確認
            if (isset($_GET['legacy']) && $_GET['legacy'] === '1') {
                // レガシー設定画面を表示
                $smtrm_legacy_menu = new Smtrm_Legacy_Menu();
                $smtrm_legacy_menu->legacy_menu_page();
            } else {
                echo '<div id="smtrm-pager-admin"></div>';
            }

            $this->enqueue_script('admin/admin', 'smtrm-pager-admin-js', 'smtrmPagerAdmin', array(
            'nonce' => wp_create_nonce('wp_rest'),
            'top' => $top_checked,
            'bottom' => $bottom_checked,
            'oldestText' => $oldest_text,
            'latestText' => $latest_text,
            ));
        }
        /**
         * Renders the advanced settings page for the plugin.
         *
         * This function checks if the legacy mode is enabled and displays
         * the legacy advanced settings page if applicable. If not, it loads the React-based
         * advanced settings page.
         *
         * @since 0.9.18
         */
        // 詳細設定ページ
        public function advanced_page()
        {
            $saved_setting = new Smtrm_Get_Setting();
            $saved_class = $saved_setting->ap_param_css_value();
            // URLに ?legacy=1 が含まれているか確認
            if (isset($_GET['legacy']) && $_GET['legacy'] === '1') {
                // レガシー設定画面を表示
                $smtrm_legacy_menu = new Smtrm_Legacy_Menu();
                $smtrm_legacy_menu->legacy_menu_page();
            } else {
                echo '<div id="smtrm-pager-advanced"></div>';
            }

            $this->enqueue_script('admin/advanced', 'smtrm-pager-advanced-js', 'smtrmPagerAdmin', array(
            'nonce' => wp_create_nonce('wp_rest'),
            'archive' => $saved_class
            ));
        }
        /**
         * Renders the help page for the plugin.
         *
         * This function displays the help page content and retrieves plugin information.
         *
         * @since 0.9.18
         */
        // ヘルプページ
        public function help_page()
        {
            echo '<div id="smtrm-pager-help"></div>';
            // プラグインファイルのパスを指定
            $plugin_file = SMTRM_DIR_PATH . 'wp-sameterm-pager.php';

            // プラグイン情報を取得
            $plugin_data = get_plugin_data($plugin_file);
            // Description内の<cite>タグを削除
            $description_without_cite = preg_replace('/<cite>.*?<\/cite>/', '', $plugin_data['Description']);

            $this->enqueue_script('admin/help', 'smtrm-pager-help-js', 'wpSametermPluginInfo', array(
            'name'        => $plugin_data['Name'],
            'uri'         => $plugin_data['PluginURI'],
            'description' => $description_without_cite,
            'version'     => $plugin_data['Version'],
            'author'      => $plugin_data['Author'],
            'authorUri'   => $plugin_data['AuthorURI'],
            'requiresWP'  => $plugin_data['RequiresWP'],
            'requiresPHP' => $plugin_data['RequiresPHP'],
            ));
        }
        /**
         * Enqueues admin scripts and styles for the plugin.
         *
         * Depending on the context (legacy mode or modern mode), this function
         * enqueues the necessary JavaScript and CSS files for the plugin's admin pages.
         *
         * @since 0.9.18
         */
        // 共通のスクリプトとスタイルの読み込み
        public function smtrm_admin_scripts($hook_suffix)
        {
            if (strpos($hook_suffix, 'wp_sameterm_pager') !== false) {
                wp_enqueue_style(
                    'smtrm-pager-admin-style',
                    SMTRM_DIR_URL . '/dist/admin/admin.css',
                    array('wp-components'),
                    SMTRM_VERSION
                );
                if (isset($_GET['legacy']) && $_GET['legacy'] === '1') {
                } else {
                    wp_enqueue_script(
                        'smtrm-legacy-support',
                        SMTRM_DIR_URL .'assets/js/smtrmLegacySupport.js',
                        array(),
                        SMTRM_VERSION,
                        true
                    );
                    // 翻訳用のテキストをJavaScriptに渡す
                    $translation_array = array(
                    'unsupportedBrowserMessage' => __('Your browser does not support modern features required for this page.', 'wp-sameterm-pager'),
                    'legacyPageLinkText' => __('Please use the Legacy Settings Page instead.', 'wp-sameterm-pager')
                    );
                    wp_localize_script('smtrm-legacy-support', 'smtrmTranslations', $translation_array);
                }
            }
        }
        /**
         * Registers translation files for the plugin's admin scripts.
         *
         * This function registers translation files for JavaScript-based components
         * of the plugin's admin interface.
         *
         * @since 0.9.18
         */
        // 翻訳ファイルの登録
        public function smtrm_admin_i18n()
        {
            $this->register_translation('smtrm-pager-admin-js', 'dist/admin/admin.js');
            $this->register_translation('smtrm-pager-advanced-js', 'dist/admin/advanced.js');
            $this->register_translation('smtrm-pager-help-js', 'dist/admin/help.js');
        }
        /**
         * Registers plugin settings in WordPress.
         *
         * This function registers all plugin-specific settings, including data validation
         * and sanitization callbacks.
         *
         * @since 0.9.18
         */
        // 設定項目の登録
        public function smtrm_register_settings()
        {
            $smtrm_sanitize = new Smtrm_Sanitize();

            $this->register_setting(SMTRM_TOP, 'integer', 1);
            $this->register_setting(SMTRM_BOTTOM, 'integer', 1);
            $this->register_setting(SMTRM_AP_PARAM_CSS, 'string', '', array($smtrm_sanitize, 'sanitize_css_selector'));
            $this->register_setting(SMTRM_OLDEST_POST, 'string', __('Read the oldest post', 'wp-sameterm-pager'), 'wp_kses_post');
            $this->register_setting(SMTRM_LATEST_POST, 'string', __('Read the latest post', 'wp-sameterm-pager'), 'wp_kses_post');
        }
        /**
         * Enqueues scripts for the specified admin page.
         *
         * @since 0.9.18
         *
         * @param string $script_path Path to the script file (without extension).
         * @param string $handle Unique handle for the script.
         * @param string $localize_name Name used to localize the script.
         * @param array  $localize_data Data to be passed to the localized script.
         */
        // 各ページ用スクリプト読み込み処理
        private function enqueue_script($script_path, $handle, $localize_name, $localize_data = array())
        {
            $asset_file = include(SMTRM_DIR_PATH . "dist/$script_path.asset.php");
            wp_enqueue_script(
                $handle,
                SMTRM_DIR_URL . "dist/$script_path.js",
                $asset_file['dependencies'],
                $asset_file['version'],
                true
            );
            if (!empty($localize_data)) {
                wp_localize_script($handle, $localize_name, $localize_data);
            }
        }
        /**
         * Registers a JavaScript translation file for an admin page.
         *
         * @since 0.9.18
         *
         * @param string $handle Unique handle for the script.
         * @param string $script_path Path to the script file (including extension).
         */
        // 翻訳ファイルの登録処理
        private function register_translation($handle, $script_path)
        {
            wp_register_script(
                $handle,
                SMTRM_DIR_URL . $script_path,
                array('wp-i18n', 'wp-element', 'wp-components', 'wp-api-fetch'),
                SMTRM_VERSION,
                true
            );
            wp_set_script_translations($handle, 'wp-sameterm-pager', SMTRM_DIR_PATH . 'languages');
        }
        /**
         * Registers a plugin setting in WordPress.
         *
         * This function adds a setting to WordPress with the specified parameters.
         * It also handles validation and sanitization callbacks.
         *
         * @since 0.9.18
         *
         * @param string   $option_name Option name to be registered.
         * @param string   $type Type of the option ('string', 'integer', etc.).
         * @param mixed    $default Default value for the option.
         * @param callable $sanitize_callback (Optional) Callback function to sanitize the option.
         */
        // 共通の設定登録処理
        private function register_setting($option_name, $type, $default, $sanitize_callback = null)
        {
            $args = array(
            'type' => $type,
            'show_in_rest' => true,
            'default' => $default,
            );
            if ($sanitize_callback) {
                $args['sanitize_callback'] = $sanitize_callback;
            }
            register_setting('smtrm_pager_settings', $option_name, $args);
        }

    }

    global $wp_version;
    if ( version_compare( $wp_version, '6.6', '>=' ) ) {
        $smtrm_admin_menu = new Smtrm_Admin_Menu();
        add_action('admin_menu', array($smtrm_admin_menu, 'add_menu'));
        add_action('admin_enqueue_scripts', array($smtrm_admin_menu, 'smtrm_admin_scripts'));
        add_action('init', array($smtrm_admin_menu, 'smtrm_register_settings'));
        add_action('init', array($smtrm_admin_menu, 'smtrm_admin_i18n'));
    }
    else{
        $smtrm_legacy_menu = new Smtrm_Legacy_Menu();
        add_action('admin_menu', array($smtrm_legacy_menu, 'add_legacy_menu'));

    }
}