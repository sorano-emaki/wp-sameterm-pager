<?php
class Smtrm_Sanitize{
    // CSSセレクタ専用のカスタムサニタイズ関数
    function sanitize_css_selector( $input ) {
        // 許可するCSSセレクタパターン
        $allowed_pattern = '/^[a-zA-Z0-9_\-#.,: \[\]="\'^$*|~>+]+$/';

        // 空白トリミング
        $input = trim( $input );

        // 正規表現に一致しない場合は空文字を返す
        if ( ! preg_match( $allowed_pattern, $input ) ) {
            return '';
        }

        // wp_ksesで特殊文字のエスケープ処理を回避しつつ、安全なセレクタにフィルタリング
        // ここではHTMLタグは不要なので空配列で制限
        $allowed_html = array(); 

        // wp_ksesを使って安全なフィルタリングを適用
        $sanitized_input = wp_kses( $input, $allowed_html );

        return $sanitized_input;
    }
}