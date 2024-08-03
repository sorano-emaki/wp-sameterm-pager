<?php
/*
Plugin Name: Wp SameTerm Pager
Plugin URI:
Description: 移動元のアーカイブページ（カテゴリ・タグ・カスタムタクソノミー）で投稿ページのページ送りを絞り込むプラグインです。
Version: 0.9.5
Author: emaki sorano
Author URI: https://shokizerokara.com/
License: GPLv2
*/
if(!defined('ABSPATH')) { exit; }

add_action( 'wp_enqueue_scripts', function(){
  // if(is_category() || is_tag() || is_tax()) {
  // wp_enqueue_script( 'wp_sameterm_pager_scripts',  plugin_dir_url(__FILE__) . 'js/script.js', array( 'jquery' ), '0.9.0' );
  // }
  wp_enqueue_script('jquery');
  if(is_single()){
    wp_enqueue_style( 'wp_sameterm_pager_css',  plugin_dir_url(__FILE__) . 'css/pager.css' );
    }
} );

add_filter('init', function(){
  global $wp;
  $wp->add_query_var( 'smtrm_filter' );
} );

class Smtrm_Activation{
  function init_option(){
    //初期化の処理を行う
    if(!get_option('smtrm_pager_installed')){
      add_option('smtrm_pager_installed', 1);
      add_option('smtrm_pager_radio',1);
      add_option('smtrm_pager_select',1);
      add_option('smtrm_pager_entry_form', '');
    }
  }
}
register_activation_hook(__FILE__, array(new Smtrm_Activation,'init_option'));
require_once('class-smtrm-get-setting.php');
require_once('class-smtrm-admin-menu.php');
require_once('class-smtrm-get-link.php');
require_once('class-smtrm-pager.php');
// require_once('class-smtrm-add-param.php');
require_once('class-smtrm-scripts.php');