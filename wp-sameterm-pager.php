<?php
/*
Plugin Name: WP Same Term Pager
Plugin URI: https://shokizerokara.com/
Description: 移動元のアーカイブページ（カテゴリ・タグ・カスタムタクソノミー）で投稿ページのページ送りを絞り込むプラグインです。
Version: 0.9.10
Author: emaki sorano
Author URI: https://shokizerokara.com/
License: GPLv2
Text Domain:wp-sameterm-pager
*/
if(!defined('ABSPATH')) { exit; }

class Smtrm_Activation{
  function init_option(){
    //初期化の処理を行う
    if(!get_option('smtrm_pager_installed')){
      add_option('smtrm_pager_installed', 1);
      add_option('smtrm_pager_radio',1);
      add_option('smtrm_pager_select',0);
      add_option('smtrm_pager_entry_form', '');
      add_option('smtrm_pager_top', 1);
      add_option('smtrm_pager_bottom', 1);
    }
  }
}
register_activation_hook(__FILE__, array(new Smtrm_Activation,'init_option'));

require_once('class-smtrm-init-setting.php');
require_once('class-smtrm-get-setting.php');
require_once('class-smtrm-enqueue.php');
require_once('class-smtrm-widget.php');
require_once('class-smtrm-widget-area.php');
require_once('class-smtrm-admin-menu.php');
require_once('class-smtrm-get-link.php');
require_once('class-smtrm-pager.php');
require_once('class-smtrm-add-param.php');