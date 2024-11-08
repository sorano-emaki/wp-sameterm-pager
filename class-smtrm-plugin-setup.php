<?php
if(!defined('ABSPATH')) { exit; }
class Smtrm_Plugin_Setup{
  function smtrm_query_vars( $vars ) {
    $vars[] = 'smtrm_filter';
    return $vars;
  }
  function smtrm_register_block(){
    foreach ( glob( SMTRM_DIR_PATH . 'dist/blocks/*' ) as $block_path ) {
      if ( is_dir( $block_path ) && file_exists( $block_path . '/block.json' ) ) {
        try {
        register_block_type( $block_path );
        $block = wp_json_file_decode( $block_path . '/block.json' );
        $block_name = $block->name;
        $script_handle = generate_block_asset_handle( $block_name, 'editorScript' );

        // 各ブロックに応じたデータを取得
        $saved_setting = new Smtrm_Get_Setting;
        $block_data = $saved_setting->get_block_specific_data($block_name);  // 各ブロック専用のデータを取得するメソッド

		    wp_set_script_translations( $script_handle, 'wp-sameterm-pager', SMTRM_DIR_PATH . 'languages' );

        // ブロックごとに異なるデータを渡す
        wp_localize_script($script_handle, 'smtrmCustomBlockData', array_merge([
          'pluginDirectoryUrl' => SMTRM_DIR_URL,
      ], $block_data));

        }catch ( Exception $e ) {
          error_log( 'Failed to register block: ' . $block_name . ' Error: ' . $e->getMessage() );
        }
      }
    }
  }
  function smtrm_register_i18n(){
    load_plugin_textdomain('wp-sameterm-pager', false, dirname(plugin_basename(__FILE__)) . '/languages');
  }
}
$smtrm_plugin_setup = new Smtrm_Plugin_Setup;
add_filter( 'query_vars',array($smtrm_plugin_setup,'smtrm_query_vars') );
add_action('init', array($smtrm_plugin_setup,'smtrm_register_block'));
add_action('plugins_loaded', array($smtrm_plugin_setup,'smtrm_register_i18n'));