<?php
if(!defined('ABSPATH')) { exit; }
class Smtrm_Plugin_Activation{

  const SMTRM_INSTALLED = 'smtrm_pager_installed';
  const SMTRM_TOP = 'smtrm_pager_top';
  const SMTRM_BOTTOM = 'smtrm_pager_bottom';
  const SMTRM_AP_PARAM_CSS = 'smtrm_archive_post_link_param_css';
  const SMTRM_OLDEST_POST = 'smtrm_oldest_post_text';
  const SMTRM_LATEST_POST = 'smtrm_latest_post_text';
  
  public static function init_option(){
    //初期化の処理を行う
    if(!get_option(self::SMTRM_INSTALLED)){
      add_option(self::SMTRM_INSTALLED, 1);
      add_option(self::SMTRM_TOP, 1);
      add_option(self::SMTRM_BOTTOM, 1);
      add_option(self::SMTRM_AP_PARAM_CSS, '');
      add_option(self::SMTRM_OLDEST_POST, '');
      add_option(self::SMTRM_LATEST_POST, '');
    }
  }
}
register_activation_hook(__FILE__, array('Smtrm_Plugin_Activation','init_option'));