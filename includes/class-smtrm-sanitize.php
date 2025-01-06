<?php

if (!defined('ABSPATH')) {
    exit;
}
if (!class_exists('Smtrm_Sanitize')) {
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
         * @since 0.10.0
         *
         * @param string $input The input string containing the CSS selector to be sanitized.
         * @return string The sanitized CSS selector. Returns an empty string if the input does not match the allowed pattern.
         */
        public function sanitize_css_selector($input)
        {
            $allowed_pattern = '/^[a-zA-Z0-9_\-#.,: \[\]="\'^$*|~>+%\/]+$/';

            $input = trim($input);

            if (!preg_match($allowed_pattern, $input)) {
                return '';
            }

            $allowed_html = array();

            $sanitized_input = wp_kses($input, $allowed_html);

            return $sanitized_input;
        }
    }
}
