<?php
if (!defined('ABSPATH')) { exit; }

class Smtrm_Admin_Menu {

  // メニューの追加
  function add_menu() {
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

  // メイン設定ページ
  function menu_page() {
    $saved_setting = new Smtrm_Get_Setting;
    $top_checked = $saved_setting->pager_top();
    $bottom_checked = $saved_setting->pager_bottom();
    $oldest_text = $saved_setting->pager_oldest_text();
    $latest_text = $saved_setting->pager_latest_text();
    echo '<div id="smtrm-pager-admin"></div>';

    $this->enqueue_script('admin/admin', 'smtrm-pager-admin-js', 'smtrmPagerAdmin', array(
      'nonce' => wp_create_nonce('wp_rest'),
      'top' => $top_checked,
      'bottom' => $bottom_checked,
      'oldestText' => $oldest_text,
      'latestText' => $latest_text,
    ));
  }

  // 詳細設定ページ
  function advanced_page() {
    $saved_setting = new Smtrm_Get_Setting;
    $saved_class = $saved_setting->ap_param_css_value();
    echo '<div id="smtrm-pager-advanced"></div>';

    $this->enqueue_script('admin/advanced', 'smtrm-pager-advanced-js', 'smtrmPagerAdmin', array(
      'nonce' => wp_create_nonce('wp_rest'),
      'archive' => $saved_class
    ));
  }

  // ヘルプページ
  function help_page() {
    echo '<div id="smtrm-pager-help"></div>';
    // プラグインファイルのパスを指定
    $plugin_file = SMTRM_DIR_PATH . 'wp-sameterm-pager.php';
    
    // プラグイン情報を取得
    $plugin_data = get_plugin_data( $plugin_file );
    // Description内の<cite>タグを削除
    $description_without_cite = preg_replace( '/<cite>.*?<\/cite>/', '', $plugin_data['Description'] );

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
  // スクリプトとスタイルの読み込み
  function smtrm_admin_scripts() {
    wp_enqueue_style(
      'smtrm-pager-admin-style',
      plugin_dir_url(__FILE__) . '/dist/admin/admin.css',
      array('wp-components')
    );
  }

  // 翻訳ファイルの登録
  function smtrm_admin_i18n() {
    $this->register_translation('smtrm-pager-admin-js', 'dist/admin/admin.js');
    $this->register_translation('smtrm-pager-advanced-js', 'dist/admin/advanced.js');
    $this->register_translation('smtrm-pager-help-js', 'dist/admin/help.js');
  }

  // 設定項目の登録
  function smtrm_register_settings() {
    $smtrm_sanitize = new Smtrm_Sanitize;

    $this->register_setting(Smtrm_Plugin_Activation::SMTRM_TOP, 'boolean', true);
    $this->register_setting(Smtrm_Plugin_Activation::SMTRM_BOTTOM, 'boolean', true);
    $this->register_setting(Smtrm_Plugin_Activation::SMTRM_AP_PARAM_CSS, 'string', '', array($smtrm_sanitize, 'sanitize_css_selector'));
    $this->register_setting(Smtrm_Plugin_Activation::SMTRM_OLDEST_POST, 'string', __('Read the oldest post', 'wp-sameterm-pager'), 'wp_kses_post');
    $this->register_setting(Smtrm_Plugin_Activation::SMTRM_LATEST_POST, 'string', __('Read the latest post', 'wp-sameterm-pager'), 'wp_kses_post');
  }

  // 共通のスクリプト読み込み処理
  private function enqueue_script($script_path, $handle, $localize_name, $localize_data = array()) {
    $asset_file = include( SMTRM_DIR_PATH . "dist/$script_path.asset.php");
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

  // 翻訳ファイルの登録処理
  private function register_translation($handle, $script_path) {
    wp_register_script(
      $handle,
      SMTRM_DIR_URL . $script_path,
      array('wp-i18n', 'wp-element', 'wp-components', 'wp-api-fetch'),
      SMTRM_VERSION,
      true
    );
    wp_set_script_translations($handle, 'wp-sameterm-pager', plugin_dir_path(__FILE__) . 'languages');
  }

  // 共通の設定登録処理
  private function register_setting($option_name, $type, $default, $sanitize_callback = null) {
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

$smtrm_admin_menu = new Smtrm_Admin_Menu();
add_action('admin_menu', array($smtrm_admin_menu, 'add_menu'));
add_action('admin_enqueue_scripts', array($smtrm_admin_menu, 'smtrm_admin_scripts'));
add_action('init', array($smtrm_admin_menu, 'smtrm_register_settings'));
add_action('init', array($smtrm_admin_menu, 'smtrm_admin_i18n'));