<?php
// WP_UNINSTALL_PLUGINが定義されているかチェック
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// オプション設定の削除
delete_option(Smtrm_Activation::SMTRM_INSTALLED);
delete_option(Smtrm_Activation::SMTRM_RADIO);
delete_option(Smtrm_Activation::SMTRM_SELECT);
delete_option(Smtrm_Activation::SMTRM_ENTRY_FORM);
delete_option(Smtrm_Activation::SMTRM_TOP);
delete_option(Smtrm_Activation::SMTRM_BOTTOM);