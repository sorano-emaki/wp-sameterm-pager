<?php
if(!defined('ABSPATH')) { exit; } 
class Smtrm_Widget_Area{
  function smtrtm_register_widget(){
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
}
const SMTRM_WIDGET_AREA = new Smtrm_Widget_Area();
add_action( 'widgets_init',array(SMTRM_WIDGET_AREA,'smtrtm_register_widget'));
add_action('cocoon_part_after__tmp/header-container',array(SMTRM_WIDGET_AREA,'insert_before_post'));
add_action('get_footer',array(SMTRM_WIDGET_AREA,'insert_after_post'));