<?php
if ( ! function_exists( 'smtrm_option_constant' ) ) {
    function smtrm_option_constant( $name, $value ) {
        if ( ! defined( $name ) ) {
            define( $name, $value );
        }
    }
    smtrm_option_constant( 'SMTRM_INSTALLED' , 'smtrm_pager_installed');
    smtrm_option_constant( 'SMTRM_TOP' , 'smtrm_pager_top' );
    smtrm_option_constant( 'SMTRM_BOTTOM' , 'smtrm_pager_bottom' );
    smtrm_option_constant( 'SMTRM_AP_PARAM_CSS' , 'smtrm_archive_post_link_param_css' );
    smtrm_option_constant( 'SMTRM_OLDEST_POST' , 'smtrm_oldest_post_text' );
    smtrm_option_constant( 'SMTRM_LATEST_POST' , 'smtrm_latest_post_text' );
}