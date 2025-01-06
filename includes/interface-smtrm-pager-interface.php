<?php

if (!defined('ABSPATH')) {
    exit;
}
/**
 * Interface for the WP Same Term Pager.
 *
 * This interface defines the necessary method(s) for implementing
 * a pager that can navigate posts within the same category, tag,
 * or taxonomy.
 *
 * @since 0.10.0
 */
if (!interface_exists('Smtrm_Pager_Interface')) {
    interface Smtrm_Pager_Interface
    {
        /**
         * Retrieves the pager area for displaying navigation controls.
         *
         * This method should be implemented to return the HTML for the
         * pager, allowing navigation between posts within the same term.
         *
         * @since 0.10.0
         *
         * @return string HTML content of the pager area.
         */
        public function get_pager_area();
    }
}
