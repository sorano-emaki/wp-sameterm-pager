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
class Smtrm_Admin_Menu{
  
function add_menu() {
  // メニューに「Same Term Pager設定」を追加
  add_menu_page( 'Same Term Pager設定', 'Same Term Pager設定', 'edit_dashboard', 'wp_sameterm_pager', array( &$this, 'menu_page' ), 'dashicons-admin-post');
}

  private static function radio_swicth($radio){
    switch($radio){
      case 1 :
        $c1 = 'checked';
        $c2 = '';
        $d1 = '';
        $d2 = 'disabled';
        break;
      case 2 :
        $c1 = '';
        $c2 = 'checked';
        $d1 = 'disabled';
        $d2 = '';
        break;
      default :
        $c1 = 'checked';
        $c2 = '';
        $d1 = '';
        $d2 = 'disabled';
        break;
    }
    return [$c1,$c2,$d1,$d2];
  }
  private static function select_swicth($select){
    $selected_array = ['','','','',''];
    $selected_array[$select] = 'selected';
    return $selected_array;
  }
  function menu_page(){
    $text_replase = str_replace( '%7E', '~', $_SERVER['REQUEST_URI']);
    $saved_setting = new Smtrm_Get_Setting;
    $saved_class = $saved_setting->entry_form_value();
    $saved_select = $saved_setting->select_box_value();
    $saved_radio = $saved_setting->radio_value();
    $top_checked = $saved_setting->pager_top();
    $bottom_checked = $saved_setting->pager_bottom();
    list($s0,$s1,$s2,$s3,$s4) = Smtrm_Admin_Menu::select_swicth($saved_select);
    list($checked1,$checked2,$disabled1,$disabled2) = Smtrm_Admin_Menu::radio_swicth($saved_radio);
    if (isset($_POST['posted']) == 'smtrm_save') {
      //設定画面で入力された設定値を保存
      if(isset($_POST['smtrm_pager_entry_form'])){
        update_option('smtrm_pager_entry_form', $_POST['smtrm_pager_entry_form']);
      }
      if(isset($_POST['smtrm_pager_select'])){
        update_option('smtrm_pager_select', $_POST['smtrm_pager_select']);
      }
      if(isset($_POST['smtrm_pager_radio'])){
        update_option('smtrm_pager_radio', $_POST['smtrm_pager_radio']);
      }
      if(isset($_POST['smtrm_pager_top'])){
        update_option('smtrm_pager_top', intval($_POST['smtrm_pager_top']));
      }
      if(isset($_POST['smtrm_pager_bottom'])){
        update_option('smtrm_pager_bottom', intval($_POST['smtrm_pager_bottom']));
      }
      $saved_class = $saved_setting->entry_form_value();
      $saved_select = $saved_setting->select_box_value();
      $saved_radio = $saved_setting->radio_value();
      $top_checked = $saved_setting->pager_top();
      $bottom_checked = $saved_setting->pager_bottom();
      list($s0,$s1,$s2,$s3,$s4) = Smtrm_Admin_Menu::select_swicth($saved_select);
      list($checked1,$checked2,$disabled1,$disabled2) = Smtrm_Admin_Menu::radio_swicth($saved_radio);
      echo '<div><p>設定を保存しました</p></div>';
    }
    echo <<<"EOT"
      <h2>Same Term Pager設定</h2>
      <form method="post" action="${text_replase}">
        <table class="form-table">
          <tr>
            <th scope="row">
            <label>使用するテーマ名<label>
            </th>
            <td><input type="radio" name="smtrm_pager_radio" id="data1" value="1" onclick="changeDisabled()" required ${checked1}></td>
            <td>
              <select name="smtrm_pager_select" id="smtrm_pager_select" ${disabled1}>
                <option value="0" ${s0}></option>
                <option value="1" ${s1}>Cocoon</option>
                <option value="2" ${s2}>Twenty Twenty-Two</option>
                <option value="3" ${s3}>Twenty Twenty-Three</option>
                <option value="4" ${s4}>Twenty-Four</option>
              </select>
            </td>
          </tr>
          <tr valign="top">
          <th scope="row"><label>各投稿ページへのリンクに<br>使用するクラス名<label></th>
          <td><input type="radio" name="smtrm_pager_radio" id="data2" value="2" onclick="changeDisabled()" required ${checked2}></td>
          <td><input type="text" size="50" name="smtrm_pager_entry_form" id="smtrm_pager_entry_form" value="${saved_class}" ${disabled2}>
          <p>例：クラス名が「entry-card-wrap」の場合「.entry-card-wrap」のように半角記号のドットをつけて入力してください。</p></td>
          </tr>
          <tr>
            <th rowspan="2"><p>表示する場所を選択してください</p></th>
            <td>
              <input type="hidden" name="smtrm_pager_top" value="0">
              <input type="checkbox" id="smtrm_pager_top" name="smtrm_pager_top" value="1" ${top_checked}/>
            </td>
            <td>
              <label for="smtrm_pager_top">投稿ページ本文の上</label>
            </td>
          </tr>
          <tr>
            <td>
              <input type="hidden" name="smtrm_pager_bottom" value="0">
              <input type="checkbox" id="smtrm_pager_bottom" name="smtrm_pager_bottom" value="1" ${bottom_checked}/>
            </td>
            <td>
              <label for="smtrm_pager_bottom">投稿ページ本文の下</label>
            </td>
          </tr>
        </table>
        <input type="hidden" name="posted" value="smtrm_save">
        <input type="submit" name="submit" class="submit_btn" value="設定を保存">
      </form>
      <div>
        <h3>Same Term Pagerとは？</h3>
        <p>同じターム（カテゴリーやタグ、カスタムタクソノミーの項目のこと）で絞り込んだ記事を表示できるプラグインです。</p>
        <p>投稿に複数のタームが登録されていても、同じターム内でページ移動をすることができます。</p>
        <h3>タームとは？</h3>
        <p>投稿を分類（タクソノミー）した項目（ターム）のことです。</p>
        <p>例えば、WordPressに最初から用意されているタクソノミーはカテゴリーとタグですが、カテゴリーやタグという分類に所属する項目一つ一つがターム（Term）と呼ばれます。</p>
        <h3>ページャーとは？</h3>
        <p>投稿のページ送り機能です。次の記事へ・前の記事へと移動することができます。</p>
      </div>
      EOT;
  }

  function add_admin_header(){
    ?>
    <script>
        function changeDisabled(){
            if(document.getElementById("data1").checked){
                document.getElementById("smtrm_pager_select").disabled = false;
                document.getElementById("smtrm_pager_entry_form").disabled = true;
            }else if(document.getElementById("data2").checked){
                document.getElementById("smtrm_pager_select").disabled = true;
                document.getElementById("smtrm_pager_entry_form").disabled = false;
            }
        }
    </script>
  <?php
  }
}
add_action( 'admin_head', array(new Smtrm_Admin_Menu,'add_admin_header') );
add_action( 'admin_menu', array(new Smtrm_Admin_Menu,'add_menu') );