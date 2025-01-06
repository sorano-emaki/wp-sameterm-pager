<?php

if (!defined('ABSPATH')) {
    exit;
}
if (!class_exists('Smtrm_Get_Link')) {
    class Smtrm_Get_Link
    {
        /**
     * Retrieves a post link with an optional query parameter.
     *
     * This function generates a permalink for a given post ID. If a parameter
     * is provided, it appends the 'smtrm_filter' query parameter to the URL.
     *
     * @since 0.10.0
     *
     * @param int $param The query parameter to be added to the URL.
     * @param int $id    The ID of the post for which the permalink is generated.
     * @return string The permalink URL with the optional query parameter.
     */
        public function get_link($param, $id)
        {
            if ($param) {
                $url = add_query_arg(array('smtrm_filter' => esc_attr($param)), get_permalink($id));
            } else {
                $url = get_permalink($id);
            }
            return $url;
        }
    }
}
