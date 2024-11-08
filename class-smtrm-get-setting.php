<?php
if(!defined('ABSPATH')) { exit; }
class Smtrm_Get_Setting {
    private function get_setting($option_name) {
        return htmlspecialchars(get_option($option_name,''),ENT_NOQUOTES );
    }
    function pager_top() {
        return $this->get_setting(Smtrm_Plugin_Activation::SMTRM_TOP);
    }
    function pager_bottom() {
        return $this->get_setting(Smtrm_Plugin_Activation::SMTRM_BOTTOM);
    }
    function ap_param_css_value() {
        return $this->get_setting(Smtrm_Plugin_Activation::SMTRM_AP_PARAM_CSS);
    }
    function pager_oldest_text() {
        return wp_kses_post(get_option(Smtrm_Plugin_Activation::SMTRM_OLDEST_POST,''));
    }
    function pager_latest_text() {
        return wp_kses_post(get_option(Smtrm_Plugin_Activation::SMTRM_LATEST_POST,''));
    }
    public function get_block_specific_data($block_name) {
        switch ($block_name) {
            case 'smtrm/pager':
                return [
                    'userOldestText' => $this->pager_oldest_text(),
                    'userLatestText' => $this->pager_latest_text(),
                ];
            default:
                return [];
        }
    }
}