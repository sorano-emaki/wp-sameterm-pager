<?php
if (!defined('ABSPATH')) {
    exit;
}
if ( ! class_exists( 'Smtrm_Get_Setting' ) ) {
    class Smtrm_Get_Setting
    {
        /**
         * Retrieves a sanitized setting option value.
         *
         * This method gets the value of a given option from the database and sanitizes it.
         *
         * @since 0.9.18
         *
         * @param string $option_name The name of the option to retrieve.
         * @return string The sanitized option value.
         */
        private function get_setting($option_name)
        {
            return htmlspecialchars(get_option($option_name, ''), ENT_NOQUOTES);
        }
        /**
         * Gets the setting for displaying the pager at the top of the content.
         *
         * @since 0.9.18
         *
         * @return string The setting value for displaying the pager at the top.
         */
        public function pager_top()
        {
            return $this->get_setting(SMTRM_TOP);
        }
        /**
         * Gets the setting for displaying the pager at the bottom of the content.
         *
         * @since 0.9.18
         *
         * @return string The setting value for displaying the pager at the bottom.
         */
        public function pager_bottom()
        {
            return $this->get_setting(SMTRM_BOTTOM);
        }
        /**
         * Retrieves the CSS class selector value for custom parameters.
         *
         * @since 0.9.18
         *
         * @return string The CSS selector for custom parameters.
         */
        public function ap_param_css_value()
        {
            return $this->get_setting(SMTRM_AP_PARAM_CSS);
        }
        /**
         * Retrieves the custom text for the 'Read the oldest post' link.
         *
         * @since 0.9.18
         *
         * @return string The custom text for the 'Read the oldest post' link, with allowed HTML tags.
         */
        public function pager_oldest_text()
        {
            return wp_kses_post(get_option(SMTRM_OLDEST_POST, ''));
        }
        /**
         * Retrieves the custom text for the 'Read the latest post' link.
         *
         * @since 0.9.18
         *
         * @return string The custom text for the 'Read the latest post' link, with allowed HTML tags.
         */
        public function pager_latest_text()
        {
            return wp_kses_post(get_option(SMTRM_LATEST_POST, ''));
        }
        /**
         * Retrieves specific data for a given block.
         *
         * Depending on the block name, this method returns an associative array with
         * the data needed for the block, such as user-customized texts.
         *
         * @since 0.9.18
         *
         * @param string $block_name The name of the block.
         * @return array The data specific to the block, or an empty array if no data is found.
         */
        public function get_block_specific_data($block_name)
        {
            switch ($block_name) {
                case 'smtrm/pager':
                    return [
                        'userOldestText' => $this->pager_oldest_text(),
                        'userLatestText' => $this->pager_latest_text(),
                    ];
                default:
                    return [];
            }
        }
    }
}