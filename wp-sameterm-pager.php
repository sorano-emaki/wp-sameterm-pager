<?php
/*
Plugin Name: WP Same Term Pager
Plugin URI: https://shokizerokara.com/
Description: 移動元のアーカイブページ（カテゴリ・タグ・カスタムタクソノミー）で投稿ページのページ送りを絞り込むプラグインです。
Version: 0.9.6
Author: emaki sorano
Author URI: https://shokizerokara.com/
License: GPLv2
Text Domain:wp-sameterm-pager
*/
if(!defined('ABSPATH')) { exit; }

add_action( 'wp_enqueue_scripts', function(){
  // if(is_category() || is_tag() || is_tax()) {
  // wp_enqueue_script( 'wp_sameterm_pager_scripts',  plugin_dir_url(__FILE__) . 'js/script.js', array( 'jquery' ), '0.9.0' );
  // }
  wp_enqueue_script('jquery');
  if(is_single()){
    wp_enqueue_style( 'wp_sameterm_pager_css',  plugin_dir_url(__FILE__) . 'css/pager.css' );
    }
} );

add_filter('init', function(){
  global $wp;
  $wp->add_query_var( 'smtrm_filter' );
} );
add_action('init', function(){
  foreach ( glob( plugin_dir_path( __FILE__ ) . 'blocks/*' ) as $block ) {
    register_block_type( $block );
  }
});

class Smtrm_Activation{
  function init_option(){
    //初期化の処理を行う
    if(!get_option('smtrm_pager_installed')){
      add_option('smtrm_pager_installed', 1);
      add_option('smtrm_pager_radio',1);
      add_option('smtrm_pager_select',1);
      add_option('smtrm_pager_entry_form', '');
      add_option('smtrm_pager_top', 1);
      add_option('smtrm_pager_bottom', 1);
    }
  }
}
register_activation_hook(__FILE__, array(new Smtrm_Activation,'init_option'));
require_once('class-smtrm-get-setting.php');
require_once('class-smtrm-admin-menu.php');
require_once('class-smtrm-get-link.php');
require_once('class-smtrm-pager.php');
// require_once('class-smtrm-add-param.php');
require_once('class-smtrm-scripts.php');

add_action( 'widgets_init', function(){
  register_sidebar( array(
    'name' => 'Pager Top', // 管理画面のウィジェットエリアの名称
    'id' => 'smtrm-pager-top', // ウィジェットエリアの識別名称（出力時にも使用）
    'description' => 'Pager Top', // 管理画面のウィジェットエリアの説明文
    'before_widget' => '<div id="%1$s" class="smtrm-widget %2$s">', // ウィジェットを囲むdivの開始タグ
    'after_widget' => '</div>', // ウィジェットを囲むdivの終了タグ
    'before_title' => '<h3 class="smtrm-widget-title">', // ウィジェットタイトルを囲むh3の開始タグ
    'after_title' => '</h3>', // ウィジェットタイトルを囲むh3の終了タグ
  ) );
  register_sidebar( array(
    'name' => 'Pager Bottom', // 管理画面のウィジェットエリアの名称
    'id' => 'smtrm-pager-bottom', // ウィジェットエリアの識別名称（出力時にも使用）
    'description' => 'Pager Bottom', // 管理画面のウィジェットエリアの説明文
    'before_widget' => '<div id="%1$s" class="smtrm-widget %2$s">', // ウィジェットを囲むdivの開始タグ
    'after_widget' => '</div>', // ウィジェットを囲むdivの終了タグ
    'before_title' => '<h3 class="smtrm-widget-title">', // ウィジェットタイトルを囲むh3の開始タグ
    'after_title' => '</h3>', // ウィジェットタイトルを囲むh3の終了タグ
  ) );
} );

class Smtrm_Pager_Area{
  function add_pager_area($content){
    $saved_setting = new Smtrm_Get_Setting;
    if(!is_single()){
        return $content;
    }
    $new_content = '';
    if ($saved_setting->pager_top()) {
      $new_content .= $this->get_pager_area();
    }
    $new_content .= $content;
    if ($saved_setting->pager_bottom()) {
      $new_content .= $this->get_pager_area();
    }
    return $new_content;
  }

  function get_pager_area(){
    $pager = new Smtrm_Pager;
    $pager_contents = '';
    ob_start();
    echo $pager->sameterm_pager();
    $pager_contents = ob_get_clean();
    return $pager_contents;
  }
}
add_shortcode('sameterm_pager', array( new Smtrm_Pager_Area(),'get_pager_area'));
add_filter('the_content',array(new Smtrm_Pager_Area,'add_pager_area'));

class Smtrm_Widget_Area{
  function add_widget_area(){
    if(!is_single()){
        return;
    }
    elseif(is_single() && in_the_loop() && is_main_query()){
    $new_content = '';
    $new_content .= $this->get_dynamic_sidebar('smtrm-pager-top');
    // $new_content .= $title;
    // $new_content .= $this->get_dynamic_sidebar('smtrm-pager-bottom');
    echo $new_content;
  }
  }

  //dyndamic_sidebar の文字列化
  function get_dynamic_sidebar($index = 1){
  $sidebar_contents = "";
  ob_start();
  dynamic_sidebar($index);
  $sidebar_contents = ob_get_clean();
  return $sidebar_contents;
  }

  function insert_before_post() {

  if(is_single()){
  $snippets = $this->get_dynamic_sidebar('smtrm-pager-top');
  echo $snippets;
  }
  else{
    return;
  }
  }
  function insert_after_post() {

    if(is_single()){
    $snippets = $this->get_dynamic_sidebar('smtrm-pager-bottom');
    echo $snippets;
    }
    else{
      return;
    }
  }

//   function myplugin_register_my_block_template() {
//     $post_type_object = get_post_type_object( 'post' );
//     $post_type_object->template = array(
//       array( 'core/image' ),
//       array( 'core/heading' ),
//       array( 'core/paragraph' )
//     );
//   }
}
// add_action( 'init',array(new Smtrm_Widget_Area,'myplugin_register_my_block_template') );
  // add_action('get_template_part_content',array(new Smtrm_Widget_Area,'add_widget_area'));
  // add_action('get_footer',array(new Smtrm_Widget_Area,'insert_after_post'));
  add_action('cocoon_part_after__tmp/header-container',array(new Smtrm_Widget_Area,'insert_before_post'));
  // if(! function_exists( 'twentytwentytwo_support' )){
  // $loop_action_start = 'loop_start';
  // $loop_action_end ='loop_end';
  // add_action($loop_action_start,array(new Smtrm_Widget_Area,'insert_before_post'));
  // // add_action($loop_action_end,array(new Smtrm_Widget_Area,'insert_after_post'));
  // }
  // add_action('get_template_part_content',array(new Smtrm_Widget_Area,'add_widget_area'));
  // add_filter('the_title',array(new Smtrm_Widget_Area,'add_widget_area'));
  // add_action( 'the_post', array( new Smtrm_Widget_Area, 'insert_before_post' ), 10, 2 );
// new Smtrm_Widget_Area();

 /**
  * $hooked_blocks (array) – フック（挿入）するブロック
  * $position (string) – ブロックを挿入する場所: before, after, first_child, or last_child.
  * $anchor_block (string) – 挿入先のブロック
  * $context (WP_Block_Template|array) – フック先のテンプレート名、テンプレートパート名、パターン名、アンカーブロック名.
  */
  // function example_block_hooks_001( $hooked_blocks, $position, $anchor_block, $context ) {

  //   if ( $context instanceof WP_Block_Template ) {
  //     if ( 
  //       'core/post-title' === $anchor_block &&
  //       'before' === $position &&
  //       'single' === $context->slug
  //       ) {
  //       // 挿入するダイナミックブロック
  //       $hooked_blocks[] = 'core/post-date';
  //     }
  //   }
  //   return $hooked_blocks;
  // }
  // add_filter( 'hooked_block_types', 'example_block_hooks_001', 10, 4 );


 