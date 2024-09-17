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
  add_menu_page( 'Same Term Pager設定', 'Same Term Pager設定', 'manage_options', 'wp_sameterm_pager', array( &$this, 'menu_page' ), 'dashicons-admin-post');
}
  function menu_page(){
    echo '<div id="smtrm-pager-admin"></div>';
  }
  function smtrm_admin_scripts() {

    // 依存スクリプト・バージョンが記述されたファイルを読み込み
    $asset_file = include( plugin_dir_path( __FILE__ ) . 'dist/admin/admin.asset.php' );

    // CSSファイルの読み込み
    wp_enqueue_style(
        'smtrm-pager-admin--style',
        plugin_dir_url( __FILE__ ) . '/dist/admin/admin.css',
        array( 'wp-components' ) // ←Gutenbergコンポーネントのデフォルトスタイルを読み込み
    );

    // JavaScriptファイルの読み込み
    wp_enqueue_script(
        'smtrm-pager-admin-script',
        plugin_dir_url( __FILE__ ) . '/dist/admin/admin.js',
        $asset_file['dependencies'],
        $asset_file['version'],
        array(
          'in_footer' => false,
          'strategy' => 'defer',
        )// </body>`終了タグの直前でスクリプトを読み込む
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
    // スクリプトの登録
    wp_enqueue_script(
        'smtrm-pager-admin-js',
        plugins_url('admin.js', __FILE__), // スクリプトファイルのパス
        array('wp-api-fetch', 'wp-element', 'wp-components'),
        false,
        true
    );

    // nonceの生成とJavaScriptへの渡し
    wp_localize_script('smtrm-pager-admin-js', 'smtrmPagerAdmin', array(
        'nonce' => wp_create_nonce('wp_rest')
    ));
  }
}
$smtrm_admin_menu = new Smtrm_Admin_Menu();
add_action( 'admin_menu', array($smtrm_admin_menu,'add_menu') );
add_action( 'admin_enqueue_scripts', array($smtrm_admin_menu,'smtrm_admin_scripts') );
add_action( 'init', array($smtrm_admin_menu,'smtrm_register_settings' ));
add_action('admin_enqueue_scripts', array($smtrm_admin_menu,'smtrtm_admin_plugin_enqueue_scripts'));