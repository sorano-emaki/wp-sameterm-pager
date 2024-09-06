<?php
if(!defined('ABSPATH')) { exit; }
class Smtrm_Get_Setting {
    private function get_setting($option_name) {
        return esc_attr(get_option($option_name),'');
    }

    function entry_form_value() {
        return $this->get_setting(Smtrm_Activation::SMTRM_ENTRY_FORM);
    }

    function select_box_value() {
        return $this->get_setting(Smtrm_Activation::SMTRM_SELECT);
    }

    function radio_value() {
        return $this->get_setting(Smtrm_Activation::SMTRM_RADIO);
    }

    function pager_top() {
        return $this->get_setting(Smtrm_Activation::SMTRM_TOP) ? 'checked' : '';
    }

    function pager_bottom() {
        return $this->get_setting(Smtrm_Activation::SMTRM_BOTTOM) ? 'checked' : '';
    }
}