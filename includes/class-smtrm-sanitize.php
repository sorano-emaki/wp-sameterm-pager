<?php
if (!defined('ABSPATH')) {
    exit;
}
if ( ! class_exists( 'Smtrm_Sanitize' ) ) {
    class Smtrm_Sanitize
    {
        /**
         * Sanitizes a CSS selector.
         *
         * This method is a custom sanitize function specifically for CSS selectors.
         * It ensures that only valid CSS selector patterns are allowed, filtering out
         * any invalid characters. Special characters are handled without escaping through
         * `wp_kses` to ensure a safe and secure input.
         *
         * @since 0.9.18
         *
         * @param string $input The input string containing the CSS selector to be sanitized.
         * @return string The sanitized CSS selector. Returns an empty string if the input does not match the allowed pattern.
         */
        // CSSセレクタ専用のカスタムサニタイズ関数
        public function sanitize_css_selector($input)
        {
            // 許可するCSSセレクタパターン
            $allowed_pattern = '/^[a-zA-Z0-9_\-#.,: \[\]="\'^$*|~>+%\/]+$/';

            // 空白トリミング
            $input = trim($input);

            // 正規表現に一致しない場合は空文字を返す
            if (! preg_match($allowed_pattern, $input)) {
                return '';
            }

            // wp_ksesで特殊文字のエスケープ処理を回避しつつ、安全なセレクタにフィルタリング
            // ここではHTMLタグは不要なので空配列で制限
            $allowed_html = array();

            // wp_ksesを使って安全なフィルタリングを適用
            $sanitized_input = wp_kses($input, $allowed_html);

            return $sanitized_input;
        }
    }
}