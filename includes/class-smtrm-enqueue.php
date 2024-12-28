<?php
if (!defined('ABSPATH')) {
    exit;
}
if ( ! class_exists( 'Smtrm_Enqueue' ) ) {
    class Smtrm_Enqueue
    {
        public function __construct() {
            add_action('wp_enqueue_scripts', array( $this,'smtrm_enqueue_front_content_assets'));
            add_action('wp_enqueue_scripts', array( $this,'pager_scripts'), 99);
            add_action('enqueue_block_assets', array( $this,'smtrm_enqueue_editor_content_assets'));
        }
        /**
         * Enqueues front-end content assets.
         *
         * This function enqueues scripts and styles necessary for the front-end.
         * Specifically, it loads jQuery and, for single post pages, it includes
         * additional styles such as Dashicons and custom pager CSS.
         *
         * @since 0.9.18
         */
        //全体向け コンテンツアセットのエンキュー。
        public function smtrm_enqueue_front_content_assets()
        {
            wp_enqueue_script('jquery');
            if (is_single()) {
                wp_enqueue_style('dashicons');
                wp_enqueue_style('wp_sameterm_pager_css', SMTRM_DIR_URL . 'assets/css/pager.css');
            }
        }

        /**
         * Enqueues block editor preview assets for the admin dashboard.
         *
         * This function enqueues scripts and styles specifically for the block editor
         * preview in the WordPress admin. It includes Dashicons and the custom pager CSS.
         *
         * @since 0.9.18
         */
        //ブロックエディタープレビュー向け コンテンツアセットのエンキュー。管理画面のみ。
        public function smtrm_enqueue_editor_content_assets()
        {
            wp_enqueue_style('dashicons');
            wp_enqueue_style('wp_sameterm_pager_css', SMTRM_DIR_URL . 'assets/css/pager.css');
        }
        
        /**
         * Handles the addition and removal of pager parameters.
         *
         * This function is responsible for managing the addition of query parameters
         * to URLs outside the main loop and for removing invalid URL parameters via JavaScript.
         *
         * @since 0.9.18
         */
        //ページャー用パラメータ付け外し
        public function pager_scripts()
        {
            $saved_setting = new Smtrm_Get_Setting;
            $link_class = $saved_setting->ap_param_css_value();

            /**
             * Adds URL parameters outside the main loop.
             *
             * This function enqueues a JavaScript file to add specific parameters to
             * URL links based on taxonomy conditions if a valid link class is provided.
             *
             * @since 0.9.18
             */
            // メインループ外のURLパラメータ追加用
            if ($link_class) {
                if (is_category() || is_tag() || is_tax()) {
                    wp_enqueue_script('add-smtrm-param', SMTRM_DIR_URL . 'assets/js/addSmtrmParam.js', array( 'jquery' ), SMTRM_VERSION, true);
                    wp_localize_script(
                        'add-smtrm-param',
                        'for_add_smtrm_param',
                        array(
                            'link_class' => $link_class,
                            'queried_object_id' =>  get_queried_object_id()
                            )
                    );
                }
            }
            /**
             * Removes invalid URL parameters via JavaScript.
             *
             * This function checks the current post's term association and, if necessary,
             * enqueues a script to remove invalid parameters from the URL.
             *
             * @since 0.9.18
             */
            //無効なURLパラメータをJavaScriptで外す
            if (is_single()) {
                list($get_filter, $taxonomy, $term_exists, $get_term) = Smtrm_Adjacent_Post::smtrm_param_check();
                if (isset($_GET ['smtrm_filter']) && $term_exists) {
                    if (has_term($get_filter, $taxonomy)) {
                    } else {
                        wp_enqueue_script('remove-smtrm-param', SMTRM_DIR_URL . 'assets/js/removeSmtrmParam.js', array( 'jquery' ), SMTRM_VERSION, true);
                    }
                } elseif (isset($_GET ['smtrm_filter']) && !$term_exists) {
                    wp_enqueue_script('remove-smtrm-param', SMTRM_DIR_URL . 'assets/js/removeSmtrmParam.js', array( 'jquery' ), SMTRM_VERSION, true);
                }
            }
        }
    }
    new Smtrm_Enqueue();
}