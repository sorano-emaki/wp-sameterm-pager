
<?php
if(!defined('ABSPATH')) { exit; } 
class Smtrm_Widget extends WP_Widget{

  //コンストラクタ
  function __construct(){
  // 親コンストラクタの設定
      parent::__construct(
    // ウィジェットID 
    'sameterm_pager_widget',
    // ウィジェット名
    'WP Same Term Pager',        
    // ウィジェットの概要
          array('description' => 'カテゴリーやタグで絞り込めるページャーを表示します。')
      );
  }

  /**
   * ウィジェットの表示用関数
   *-------------------------------------------------------
  * @param array $args      [register_sidebar]で設定した
  *                         「before_title, after_title, 
  *                          before_widget, after_widget」が入る
  * @param array $instance  Widgetの設定項目
  * ------------------------------------------------------
  */
  public function widget($args, $instance){

  // ウィジェット内容の前に出力
  echo $args['before_widget'];

  // ウィジェットの内容出力
  global $smtrm_pager;
  echo $smtrm_pager->get_pager_area();

  // ウィジェット内容の後に出力
  echo $args['after_widget'];
  }
}
function register_smtrm_widget() {
  register_widget( 'Smtrm_Widget' );
}
add_action( 'widgets_init', 'register_smtrm_widget' );