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
        $link_class = esc_js($saved_setting->entry_form_value());
        /**
         * メインループ外のURLパラメータ追加用
         */
        if($link_class){
            if(is_category() || is_tag() || is_tax()){
                wp_enqueue_script( 'add-smtrm-param', plugin_dir_url(__FILE__) . 'js/addSmtrmParam.js', array( 'jquery' )  );
                wp_localize_script('add-smtrm-param','for_add_smtrm_param',array(
                        'link_class' => $link_class,
                        'queried_object_id' =>  get_queried_object_id()
                        )
                    );
            }
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
const SMTRM_ENQUEUE = new Smtrm_Enqueue();
add_action( 'wp_enqueue_scripts', array( SMTRM_ENQUEUE,'smtrm_enqueue_front_content_assets') );
add_action( 'wp_enqueue_scripts', array( SMTRM_ENQUEUE,'pager_scripts'), 99 );
add_action( 'enqueue_block_assets', array( SMTRM_ENQUEUE,'smtrm_enqueue_editor_content_assets') );
add_action( 'enqueue_block_editor_assets', array( SMTRM_ENQUEUE,'smtrm_custom_block_scripts') );