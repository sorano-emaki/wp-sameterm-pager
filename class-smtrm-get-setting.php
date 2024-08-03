<?php
if(!defined('ABSPATH')) { exit; }
class Smtrm_Get_Setting{
    function entry_form_value(){
        $get_form = esc_attr(get_option('smtrm_pager_entry_form'));
        return $get_form;
    }
    function select_box_value(){
        $get_select = esc_attr(get_option('smtrm_pager_select'));
        return $get_select;
    }
    function radio_value(){
        $get_radio = esc_attr(get_option('smtrm_pager_radio'));
        return $get_radio;
    }
}