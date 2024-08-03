<?php
if(!defined('ABSPATH')) { exit; } 
class Smtrm_Get_Link{
  function getlink($param,$id){
    if($param){
      $url = add_query_arg( array( 'smtrm_filter'=> $param ) , get_permalink($id));
    }
    else{
      $url = get_permalink($id);
    }
    return $url;
  }
}