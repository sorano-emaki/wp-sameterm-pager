<?php
if(!defined('ABSPATH')) { exit; } 
/**
 * 管理画面にメニューを追加
 *
 * 第1引数：メニューが選択されたとき、ページのタイトルタグに表示されるテキスト
 * 第2引数：メニューとして表示されるテキスト
 * 第3引数：メニューを表示するために必要な権限
 * 第4引数：メニューのスラッグ名
 * 第5引数：（任意）メニューページを表示する際に実行される関数
 * 第6引数：（任意）メニューのアイコンを示す URL
 * 第7引数：（任意）メニューが表示される位置
 */
class smtrm_admin_menu{
  
function add_menu() {
  // メニューに「Same Term Pager設定」を追加
  add_menu_page( 'Same Term Pager設定', 'Same Term Pager設定', 'edit_dashboard', 'wp_sameterm_pager', array( &$this, 'menu_page' ), 'dashicons-admin-post', 5 );
}

function menu_page(){
  $text_replase = str_replace( '%7E', '~', $_SERVER['REQUEST_URI']);
  $saved_class = esc_attr(get_option('smtrm_pager_entry_form'));
  if (isset($_POST['posted']) == 'smtrm_save') {
    //設定画面で入力された設定値を保存
    update_option('smtrm_pager_entry_form', $_POST['smtrm_pager_entry_form']);
    $saved_class = esc_attr(get_option('smtrm_pager_entry_form'));
    echo '<div><p>設定を保存しました</p></div>';
   }
  echo <<<"EOT"
    <h2>Same Term Pager設定</h2>
    <p>例：クラス名が「entry-card-wrap」の場合「.entry-card-wrap」のように半角記号のドットをつけて入力</p>
    <form method="post" action="${text_replase}">
      <table class="form-table">
        <tr valign="top">
        <th scope="row"><label>アーカイブページから<br>各投稿ページへのリンクに<br>使用するクラス名<label></th>
        <td><input type="text" size="50" name="smtrm_pager_entry_form" id="smtrm_pager_entry_form" value="${saved_class}"></td>
        </tr>
      </table>
      <input type="hidden" name="posted" value="smtrm_save">
      <input type="submit" name="submit" class="submit_btn" value="設定を保存">
    </form>
    EOT;
}
}
add_action( 'admin_menu', array(new smtrm_admin_menu,'add_menu') );