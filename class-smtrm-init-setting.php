<?php
if(!defined('ABSPATH')) { exit; }
class Smtrm_Init_Setting{
  function smtrm_query_vars( $vars ) {
    $vars[] = 'smtrm_filter';
    return $vars;
  }
  function smtrm_register_block(){
    foreach ( glob( SMTRM_PLUGIN_PATH . 'blocks/*' ) as $block ) {
      if ( is_dir( $block ) && file_exists( $block . '/block.json' ) ) {
        register_block_type( $block );
      }
    }
  }
}
$smtrm_init_setting = new Smtrm_Init_Setting;
add_filter( 'query_vars',array($smtrm_init_setting,'smtrm_query_vars') );
add_action('init', array($smtrm_init_setting,'smtrm_register_block'));