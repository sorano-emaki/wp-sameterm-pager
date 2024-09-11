<?php
/*
Plugin Name: WP Same Term Pager
Plugin URI: https://shokizerokara.com/
Description: 移動元のアーカイブページ（カテゴリ・タグ・カスタムタクソノミー）で投稿ページのページ送りを絞り込むプラグインです。
Version: 0.9.12
Author: emaki sorano
Author URI: https://shokizerokara.com/
License: GPLv2
Text Domain:wp-sameterm-pager
*/
if(!defined('ABSPATH')) { exit; }

class Smtrm_Activation{

  const SMTRM_INSTALLED = 'smtrm_pager_installed';
  const SMTRM_RADIO = 'smtrm_pager_radio';
  const SMTRM_SELECT = 'smtrm_pager_select';
  const SMTRM_ENTRY_FORM = 'smtrm_pager_entry_form';
  const SMTRM_TOP = 'smtrm_pager_top';
  const SMTRM_BOTTOM = 'smtrm_pager_bottom';

  public static function init_option(){
    //初期化の処理を行う
    if(!get_option(self::SMTRM_INSTALLED)){
      add_option(self::SMTRM_INSTALLED, 1);
      add_option(self::SMTRM_RADIO, 1);
      add_option(self::SMTRM_SELECT, 0);
      add_option(self::SMTRM_ENTRY_FORM, '');
      add_option(self::SMTRM_TOP, 1);
      add_option(self::SMTRM_BOTTOM, 1);
    }
  }
}
register_activation_hook(__FILE__, array(new Smtrm_Activation,'init_option'));
require_once('globals.php');
require_once('class-smtrm-adjacent-post.php');
require_once('class-smtrm-init-setting.php');
require_once('class-smtrm-get-setting.php');
require_once('class-smtrm-enqueue.php');
require_once('class-smtrm-widget.php');
require_once('class-smtrm-widget-area.php');
require_once('class-smtrm-admin-menu.php');
require_once('class-smtrm-get-link.php');
require_once('class-smtrm-pager.php');
require_once('class-smtrm-add-param.php');