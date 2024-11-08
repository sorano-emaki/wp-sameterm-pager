<?php
if(!defined('ABSPATH')) { exit; } 
class Smtrm_Enqueue{
    /**
     * 全体向け コンテンツアセットのエンキュー。
     */
    function smtrm_enqueue_front_content_assets(){
        wp_enqueue_script('jquery');
        if(is_single()){
            wp_enqueue_style('dashicons');
            wp_enqueue_style( 'wp_sameterm_pager_css',  SMTRM_DIR_URL . 'css/pager.css' );
        }
    }

    /**
     * ブロックエディタープレビュー向け コンテンツアセットのエンキュー。管理画面のみ。
     */
    function smtrm_enqueue_editor_content_assets() {
        wp_enqueue_style('dashicons');
        wp_enqueue_style( 'wp_sameterm_pager_css',  SMTRM_DIR_URL . 'css/pager.css' );
    }
    
    /**
     * ページャー用パラメータ付け外し
     */
    function pager_scripts() {
        $saved_setting = new Smtrm_Get_Setting;
        $link_class = $saved_setting->ap_param_css_value();
        /**
         * メインループ外のURLパラメータ追加用
         */
        if($link_class){
            if(is_category() || is_tag() || is_tax()){
                wp_enqueue_script( 'add-smtrm-param', SMTRM_DIR_URL . 'js/addSmtrmParam.js', array( 'jquery' ), SMTRM_VERSION, true);
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
            list($get_filter,$taxonomy,$term_exists,$get_term) = Smtrm_Adjacent_Post::smtrm_param_check();
            if( isset($_GET ['smtrm_filter']) && $term_exists){
                if(has_term($get_filter,$taxonomy)) {
                }
                else{
                    wp_enqueue_script( 'remove-smtrm-param', SMTRM_DIR_URL . 'js/removeSmtrmParam.js', array( 'jquery' ) , SMTRM_VERSION, true );
                }
            }
            elseif( isset($_GET ['smtrm_filter']) && !$term_exists ) {
                wp_enqueue_script( 'remove-smtrm-param', SMTRM_DIR_URL . 'js/removeSmtrmParam.js', array( 'jquery' ), SMTRM_VERSION, true  );
            }
        }
    }
}
$smtrm_enqueue = new Smtrm_Enqueue();
add_action( 'wp_enqueue_scripts', array( $smtrm_enqueue,'smtrm_enqueue_front_content_assets') );
add_action( 'wp_enqueue_scripts', array( $smtrm_enqueue,'pager_scripts'), 99 );
add_action( 'enqueue_block_assets', array( $smtrm_enqueue,'smtrm_enqueue_editor_content_assets') );