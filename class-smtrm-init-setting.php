<?php
if(!defined('ABSPATH')) { exit; }
class Smtrm_Init_Setting{
  function smtrm_query_var(){
    global $wp;
    $wp->add_query_var( 'smtrm_filter' );
  }
  function smtrm_register_block(){
    foreach ( glob( plugin_dir_path( __FILE__ ) . 'blocks/*' ) as $block ) {
      register_block_type( $block );
    }
  }
}
const SMTRM_INIT_SETTING = new Smtrm_Init_Setting;
add_action('init', array(SMTRM_INIT_SETTING,'smtrm_query_var'));
add_action('init', array(SMTRM_INIT_SETTING,'smtrm_register_block'));