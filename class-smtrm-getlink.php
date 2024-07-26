<?php
if(!defined('ABSPATH')) { exit; } 
class smtrm_getlink{
  function getlink($param,$id){
    if($param){
      $url = add_query_arg( array( 'filter'=> $param ) , get_permalink($id));
    }
    else{
      $url = get_permalink($id);
    }
    return $url;
  }
}