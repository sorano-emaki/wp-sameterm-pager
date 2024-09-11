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
        wp_enqueue_style( 'wp_sameterm_pager_css',  SMTRM_PLUGIN_URL . 'css/pager.css' );
        }
    }

    /**
     * ブロックエディタープレビュー向け コンテンツアセットのエンキュー。管理画面のみ。
     */
    function smtrm_enqueue_editor_content_assets() {
        if ( is_admin() ) {
            wp_enqueue_style('dashicons');
            wp_enqueue_style( 'wp_sameterm_pager_css',  SMTRM_PLUGIN_URL . 'css/pager.css' );
        }
    }
    
    /**
     * カスタムブロックにプラグイン保存先パスを渡す。ブロックエディタープレビュー表示時の画像サムネイル用。
     */
    function smtrm_custom_block_scripts() {
        wp_enqueue_script(
            'smtrm-custom-block',
            SMTRM_PLUGIN_URL . '/blocks/smtrm-block/index.js'
        );
    
        wp_localize_script(
            'smtrm-custom-block',
            'pluginDirectoryUrl',
            SMTRM_PLUGIN_URL
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
                wp_enqueue_script( 'add-smtrm-param', SMTRM_PLUGIN_URL . 'js/addSmtrmParam.js', array( 'jquery' )  );
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
            list($get_filter,$taxonomy,$term_exists,$get_term) = SmtrmAdjacentPost::smtrm_param_check();
            if( isset($_GET ['smtrm_filter']) && $term_exists){
                if(has_term($get_filter,$taxonomy)) {
                }
                else{
                    wp_enqueue_script( 'remove-smtrm-param', SMTRM_PLUGIN_URL . 'js/removeSmtrmParam.js', array( 'jquery' )  );
                }
            }
            elseif( isset($_GET ['smtrm_filter']) && !$term_exists ) {
                wp_enqueue_script( 'remove-smtrm-param', SMTRM_PLUGIN_URL . 'js/removeSmtrmParam.js', array( 'jquery' )  );
            }
        }
    }
}
$smtrm_enqueue = new Smtrm_Enqueue();
add_action( 'wp_enqueue_scripts', array( $smtrm_enqueue,'smtrm_enqueue_front_content_assets') );
add_action( 'wp_enqueue_scripts', array( $smtrm_enqueue,'pager_scripts'), 99 );
add_action( 'enqueue_block_assets', array( $smtrm_enqueue,'smtrm_enqueue_editor_content_assets') );
add_action( 'enqueue_block_editor_assets', array( $smtrm_enqueue,'smtrm_custom_block_scripts') );