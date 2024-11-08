<?php
// WP_UNINSTALL_PLUGINが定義されているかチェック
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// オプション設定の削除
delete_option(Smtrm_Plugin_Activation::SMTRM_INSTALLED);
delete_option(Smtrm_Plugin_Activation::SMTRM_TOP);
delete_option(Smtrm_Plugin_Activation::SMTRM_BOTTOM);
delete_option(Smtrm_Plugin_Activation::SMTRM_AP_PARAM_CSS);