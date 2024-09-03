<?php
if(!defined('ABSPATH')) { exit; } 
class Smtrm_Add_Param{
    function add_param_link($permalink){
        if(is_category() || is_tag() || is_tax()){
            if(!is_admin() && is_main_query() && in_the_loop()){
                //パラメータを取得
                $param = get_queried_object_id();
                $new_permalink ='';
                $new_permalink = add_query_arg('smtrm_filter',$param,$permalink);
                return $new_permalink;
            }
        }
        return $permalink;
    }
}
const smtrm_add_param = new Smtrm_Add_Param();
add_filter('post_link', array(smtrm_add_param, 'add_param_link'), 10, 2);
add_filter('post_type_link', array(smtrm_add_param, 'add_param_link'), 10, 2);