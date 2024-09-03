<?php
if(!defined('ABSPATH')) { exit; } 
class Smtrm_Enqueue{
    /**
     * 全体向け コンテンツアセットのエンキュー。
     */
    function smtrm_enqueue_front_content_assets(){
        wp_enqueue_script('jquery');
        wp_enqueue_style('dashicons');
        if(is_single()){
        wp_enqueue_style( 'wp_sameterm_pager_css',  plugin_dir_url(__FILE__) . 'css/pager.css' );
        }
    }

    /**
     * ブロックエディタープレビュー向け コンテンツアセットのエンキュー。管理画面のみ。
     */
    function smtrm_enqueue_editor_content_assets() {
        if ( is_admin() ) {
            wp_enqueue_style('dashicons');
            wp_enqueue_style( 'wp_sameterm_pager_css',  plugin_dir_url(__FILE__) . 'css/pager.css' );
        }
    }
    
    /**
     * カスタムブロックにプラグイン保存先パスを渡す。ブロックエディタープレビュー表示時の画像サムネイル用。
     */
    function smtrm_custom_block_scripts() {
        wp_enqueue_script(
            'smtrm-custom-block',
            plugin_dir_url(__FILE__) . '/blocks/smtrm-block/index.js'
        );
    
        wp_localize_script(
            'smtrm-custom-block',
            'pluginDirectoryUrl',
            plugin_dir_url(__FILE__)
        );
    }
    /**
     * ページャー用パラメータ付け外し
     */
    function pager_scripts() {
        $saved_setting = new Smtrm_Get_Setting;
        $link_class = $saved_setting->select_box_value();
        $radio_value = $saved_setting->radio_value();
        if($radio_value == 1){
            switch ($link_class){
                case 0:
                    $link_class = '';
                    break;
                case 1:
                    $link_class = 'a.entry-card-wrap';
                    break;
                case 2:
                    $link_class = 'li.wp-block-post a';
                    break;
                case 3:
                    $link_class = 'li.wp-block-post a';
                    break;
                case 4:
                    $link_class = 'li.wp-block-post a';
                    break;
                default :
                    $link_class = '';
                    break;
            }
        }
        else{
            $link_class = $saved_setting->entry_form_value();
        }
        /**
         * メインループ外のURLパラメータ追加用
         */
        if(is_category() || is_tag() || is_tax()){
            wp_enqueue_script( 'add-smtrm-param', plugin_dir_url(__FILE__) . 'js/addSmtrmParam.js', array( 'jquery' )  );
            wp_localize_script('add-smtrm-param','for_add_smtrm_param',array(
                    'link_class' => $link_class,
                    'queried_object_id' =>  get_queried_object_id()
                    )
                );
        }
        /**
         * 無効なURLパラメータをJavaScriptで外す
         */
        if(is_single()){
            if( isset($_GET ['smtrm_filter']) && is_numeric($_GET ['smtrm_filter'])){
                $get_filter = $_GET ['smtrm_filter']; 
                $get_term = get_term( $get_filter );
                $get_tax = null;
                if(isset( $get_term ) && !is_wp_error( $get_term )){
                    $get_tax = $get_term -> taxonomy;
                }
                if(has_term($get_filter,$get_tax)) {
                }
                else{
                    wp_enqueue_script( 'remove-smtrm-param', plugin_dir_url(__FILE__) . 'js/removeSmtrmParam.js', array( 'jquery' )  );
                }
            }
            elseif( isset($_GET ['smtrm_filter']) && !is_numeric($_GET ['smtrm_filter']) ) {
                wp_enqueue_script( 'remove-smtrm-param', plugin_dir_url(__FILE__) . 'js/removeSmtrmParam.js', array( 'jquery' )  );
            }
        }
    }
}
const smtrm_enqueue = new Smtrm_Enqueue();
add_action( 'wp_enqueue_scripts', array( smtrm_enqueue,'smtrm_enqueue_front_content_assets') );
add_action( 'wp_enqueue_scripts', array( smtrm_enqueue,'pager_scripts'), 99 );
add_action( 'enqueue_block_assets', array( smtrm_enqueue,'smtrm_enqueue_editor_content_assets') );
add_action( 'enqueue_block_editor_assets', array( smtrm_enqueue,'smtrm_custom_block_scripts') );