<?php
if(!defined('ABSPATH')) { exit; } 
/**
 * 管理画面にメニューを追加
 *
 * 第1引数：メニューが選択されたとき、ページのタイトルタグに表示されるテキスト
 * 第2引数：メニューとして表示されるテキスト
 * 第3引数：メニューを表示するために必要な権限
 * 第4引数：メニューのスラッグ名
 * 第5引数：（任意）メニューページを表示する際に実行される関数
 * 第6引数：（任意）メニューのアイコンを示す URL
 * 第7引数：（任意）メニューが表示される位置
 */
class Smtrm_Admin_Menu{
  
function add_menu() {
    // メニューに「Same Term Pager設定」を追加
    add_menu_page(
      'Same Term Pager設定',        // ページタイトル
      'Same Term Pager設定',        // メニュー名
      'manage_options',             // 権限
      'wp_sameterm_pager',          // スラッグ
      array( &$this, 'menu_page' ), // コールバック関数
      'dashicons-admin-post'        // アイコン
    );
    // サブメニュー: 追加設定
    add_submenu_page(
      'wp_sameterm_pager',      // 親メニューのスラッグ
      '追加設定',             // ページタイトル
      '追加設定',             // メニュー名
      'manage_options',       // 権限
      'wp_sameterm_pager_additional', // スラッグ
      array( &$this, 'additional_page' ) // コールバック関数
    );

    // サブメニュー: 解説ページ
    add_submenu_page(
        'wp_sameterm_pager',      // 親メニューのスラッグ
        'ヘルプ',           // ページタイトル
        'ヘルプ',           // メニュー名
        'manage_options',       // 権限
        'wp_sameterm_pager_help', // スラッグ
        array( &$this, 'help_page' ) // コールバック関数
    );
  }
  function menu_page(){
    echo '<div id="smtrm-pager-admin"></div>';
    // 依存スクリプト・バージョンが記述されたファイルを読み込み
    $asset_file = include( plugin_dir_path( __FILE__ ) . 'dist/admin/admin.asset.php' );
    // JavaScriptファイルの読み込み
    wp_enqueue_script(
        'smtrm-pager-admin-js',
        plugin_dir_url( __FILE__ ) . '/dist/admin/admin.js',
        $asset_file['dependencies'],
        $asset_file['version'],
        array(
          'in_footer' => false,
          'strategy' => 'defer',
        )// </body>`終了タグの直前でスクリプトを読み込む
    );
    // nonceの生成とJavaScriptへの渡し
    wp_localize_script('smtrm-pager-admin-js', 'smtrmPagerAdmin', array(
        'nonce' => wp_create_nonce('wp_rest')
    ));
  }
  // 追加設定ページの表示
  function additional_page() {
    echo '<div id="smtrm-pager-additional"></div>';
    // 依存スクリプト・バージョンが記述されたファイルを読み込み
    $asset_file = include( plugin_dir_path( __FILE__ ) . 'dist/admin/additional.asset.php' );
    // JavaScriptファイルの読み込み
    wp_enqueue_script(
        'smtrm-pager-additional-js',
        plugin_dir_url( __FILE__ ) . '/dist/admin/additional.js',
        $asset_file['dependencies'],
        $asset_file['version'],
        array(
          'in_footer' => false,
          'strategy' => 'defer',
        )// </body>`終了タグの直前でスクリプトを読み込む
    );
    // nonceの生成とJavaScriptへの渡し
    wp_localize_script('smtrm-pager-additional-js', 'smtrmPagerAdmin', array(
        'nonce' => wp_create_nonce('wp_rest')
    ));
  }

  // 解説ページの表示
  function help_page() {
    echo '<div id="smtrm-pager-help"></div>';
        // 依存スクリプト・バージョンが記述されたファイルを読み込み
        $asset_file = include( plugin_dir_path( __FILE__ ) . 'dist/admin/help.asset.php' );
        // JavaScriptファイルの読み込み
        wp_enqueue_script(
            'smtrm-pager-help-js',
            plugin_dir_url( __FILE__ ) . '/dist/admin/help.js',
            $asset_file['dependencies'],
            $asset_file['version'],
            array(
              'in_footer' => false,
              'strategy' => 'defer',
            )// </body>`終了タグの直前でスクリプトを読み込む
        );
  }
  function smtrm_admin_scripts() {
    // CSSファイルの読み込み
    wp_enqueue_style(
      'smtrm-pager-admin-style',
      plugin_dir_url( __FILE__ ) . '/dist/admin/admin.css',
      array( 'wp-components' ) // ←Gutenbergコンポーネントのデフォルトスタイルを読み込み
  );

}
  // 設定項目の登録
  function smtrm_register_settings() {
    // ページャー上を表示する
    register_setting(
        'smtrm_pager_settings',
        'smtrm_pager_top',
        array(
            'type'         => 'boolean',
            'show_in_rest' => true,
            'default'      => true,
        )
    );
    // ページャー下を表示する
    register_setting(
        'smtrm_pager_settings',
        'smtrm_pager_bottom',
        array(
            'type'         => 'boolean',
            'show_in_rest' => true,
            'default'      => true,
        )
    );
    // テキスト
    register_setting(
        'smtrm_pager_settings',
        'smtrm_pager_entry_form',
        array(
            'type'         => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'show_in_rest' => true,
            'default'      => '',
        )
    );
  }
  function smtrtm_admin_plugin_enqueue_scripts() {

  }
}
$smtrm_admin_menu = new Smtrm_Admin_Menu();
add_action( 'admin_menu', array($smtrm_admin_menu,'add_menu') );
add_action( 'admin_enqueue_scripts', array($smtrm_admin_menu,'smtrm_admin_scripts') );
add_action( 'init', array($smtrm_admin_menu,'smtrm_register_settings' ));
add_action('admin_enqueue_scripts', array($smtrm_admin_menu,'smtrtm_admin_plugin_enqueue_scripts'));