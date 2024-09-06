<?php
if(!defined('ABSPATH')) { exit; } 
class Smtrm_Get_Link{
  function get_link($param,$id){
    if($param){
      $url = add_query_arg( array( 'smtrm_filter'=> esc_attr($param) ) , get_permalink($id));
    }
    else{
      $url = get_permalink($id);
    }
    return $url;
  }
}