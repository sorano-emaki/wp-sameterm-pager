<?php
if(!defined('ABSPATH')) { exit; } 

class Smtrm_Widget extends WP_Widget {
  private $pager;

  // コンストラクタ
  public function __construct(Smtrm_Pager_Interface $pager) {
    // 親コンストラクタの設定
    parent::__construct(
        // ウィジェットID
        'sameterm_pager_widget',
        // ウィジェット名
        __('WP Same Term Pager', 'wp-sameterm-pager'),
        // ウィジェットの概要
        array('description' => __('Display a pager on posts that can be filtered by category, tags or taxonomy.', 'wp-sameterm-pager'))
    );
    $this->pager = $pager;
  }

  /**
   * ウィジェットの表示用関数
   * ------------------------------------------------------
   * @param array $args      [register_sidebar]で設定した
   *                         「before_title, after_title, 
   *                          before_widget, after_widget」が入る
   * @param array $instance  Widgetの設定項目
   * ------------------------------------------------------
   */
  public function widget($args, $instance) {

    // ウィジェット内容の前に出力
    echo $args['before_widget'];

    // ウィジェットの内容出力
    try {
        echo $this->pager->get_pager_area();
    } catch (\Exception $e) {
        error_log('Pager error: ' . $e->getMessage());
        echo esc_html(__('An error occurred while displaying the pager.', 'wp-sameterm-pager'));
    }

    // ウィジェット内容の後に出力
    echo $args['after_widget'];
  }

  public function form( $instance ) { }

  public function update( $new_instance, $old_instance ) {
    return array();
  }
}

// ウィジェットの登録
function register_smtrm_widget() {
  $pager = new Smtrm_Pager();
  register_widget(new Smtrm_Widget($pager));
}
add_action( 'widgets_init', 'register_smtrm_widget' );
