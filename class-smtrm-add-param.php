<?php
if(!defined('ABSPATH')) { exit; } 
// class Smtrm_Add_Param{
//     function add_param_link(){
//         // global $post;
//         if(is_category() || is_tag() || is_tax()){
//             if(!is_admin() && in_the_loop()){
//                 //パラメータを取得
//                 $param = get_queried_object_id();
//                 $new_permalink =  add_query_arg( array( 'smtrm_filter'=> $param ) , get_permalink($post->ID));
//                 return $new_permalink;
//             }
//             $new_permalink = get_permalink($post->ID);
//             return $new_permalink;
//         }
//     }
// }
// add_filter('post_type_link', array(new Smtrm_Addparam, 'add_param_link'), 10, 2);
// add_filter('post_link', array(new Smtrm_Addparam, 'add_param_link'), 10, 2);