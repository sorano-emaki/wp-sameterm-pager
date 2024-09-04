<?php
// WP_UNINSTALL_PLUGINが定義されているかチェック
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// オプション設定の削除
delete_option('smtrm_pager_installed');
delete_option('smtrm_pager_radio');
delete_option('smtrm_pager_select');
delete_option('smtrm_pager_entry_form');
delete_option('smtrm_pager_top');
delete_option('smtrm_pager_bottom');