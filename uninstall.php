<?php
// WP_UNINSTALL_PLUGINが定義されているかチェック
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}
require_once('globals.php');
// オプション設定の削除
delete_option( SMTRM_INSTALLED );
delete_option( SMTRM_TOP );
delete_option( SMTRM_BOTTOM );
delete_option( SMTRM_AP_PARAM_CSS );
delete_option( SMTRM_OLDEST_POST );
delete_option( SMTRM_LATEST_POST );